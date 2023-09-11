<!-- Fichier index.php qui gère tout, ne pas cassez SVP 😂 -->
<?php
session_start();
require '../bootstrap.php';

// si le cookie n'existe pas, on redirige vers la page d'accueil
if (!isset($_COOKIE['jwt'])) {
  header('Location: ./accueil.php');
  exit;
}

// La on récupère le cookie que l'on à crée à la connection, voir login.php et fonction.php
// --------------------
$jwt = $_COOKIE['jwt'];
$secret_key = $_ENV['SECRET_KEY']; // La variable est une variable d'environnement qui est dans le fichier .env
$user = decodeJWT($jwt, $secret_key);
setlocale(LC_TIME, 'fr_FR.UTF-8'); // Définit la locale en français mais ne me semble pas fonctionner
// --------------------
// Fin de la récupération du cookie


// Récupèration des données de l'utilisateur directement en base de données et non pas dans le cookie, ce qui permet d'avoir les données à jour sans deconnection
$user_data = "SELECT * FROM users WHERE id_user = :id_user";
$stmt = $dbh->prepare($user_data);
$stmt->execute([
  'id_user' => $user['id_user']
]);
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);

// On récupère le lien de l'emploi du temps de l'utilisateur via la base de données
$cal_link = calendar($user_data['edu_group']);

// On récupère les données du formulaire du tutoriel pour ajouter l'année et le tp de l'utilisateur à la base de données
if (isset($_POST['annee']) && isset($_POST['tp'])) {
  $annee = $_POST['annee'];
  $tp = $_POST['tp'];
  $update_user = "UPDATE users SET edu_group = :edu_group WHERE id_user = :id_user";
  $stmt = $dbh->prepare($update_user);
  $stmt->execute([
    'edu_group' => $annee . "-" . $tp,
    'id_user' => $user['id_user']
  ]);
  header('Location: ./index.php');
  exit();
}

$color_subjects = "SELECT * FROM sch_ressource";
$stmt = $dbh->prepare($color_subjects);
$stmt->execute();
$color_subjects = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo head('MMI Companion | Emploi du temps');
?>
<style>
  .custom-event-button {
    position: absolute;
    top: 5px;
    right: 5px;
    color: #fff;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
  }
</style>

<body class="body-all">

  <header class="header-index">
    <div class="header-index-content">
      <h2>Bonjour </h2>
      <h1><?php echo ucfirst($user['pname']) ?>.<?php echo ucfirst($user['name']) ?></h1>
    </div>
      <p>Bienvenue sur le tableau de bord professeur</p>

  </header>

  <main class="main-index">
    <div style="height:30px"></div>
    <section class="section_calendar-index">
      <div class="title_trait">
        <h1>L'emploi du temps</h1>
        <div></div>
      </div>
      <div style="height:15px"></div>
      <div id="calendar"></div>
    </section>

    <div style="height:30px"></div>

    <section class="section_agenda-index">
      <div class="title_trait">
        <h1>L'agenda</h1>
        <div>
          <?php
          // if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
          //   $activation_code = generate_activation_code();
          //   send_activation_email($_POST['mail'], $activation_code);
          // }
          ?>
          <form method="post">
            <input type="text" name="mail">
            <input type="submit" value="Envoyer" name="submit">
          </form>
        </div>
      </div>


    </section>

  </main>

</body>

<script src="https://cdn.jsdelivr.net/npm/ical.js@1.5.0/build/ical.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="./../assets/js/icalendar.js"></script>
<script src="../assets/js/menu-navigation.js"></script>
<script src="../assets/js/app.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Gestion et affichage de l'emploi du temps en utilisant FullCalendar
    const url1 = 'https://corsproxy.io/?' + encodeURIComponent('https://upplanning.appli.univ-poitiers.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=1706&projectId=14&calType=ical&nbWeeks=15');
    let calendarEl = document.querySelector("#calendar");
    let eventColors = {

      <?php
      foreach ($color_subjects as $color_subject) {
        echo "'" . $color_subject['code_ressource'] . "': '" . $color_subject['color_ressource'] . "',";
      }
      ?>
    };
    let calendar = new FullCalendar.Calendar(calendarEl, {
      locale: 'fr',
      buttonText: {
        today: 'Aujourd\'hui',
        month: 'Mois',
        week: 'Semaine',
        day: 'Jour',
        list: 'Liste'
      },
      slotMinTime: '08:00',
      slotMaxTime: '18:30',
      hiddenDays: [0, 6],
      allDaySlot: false,
      eventMinHeight: 75,
      height: '70vh',
      nowIndicator: true,
      initialView: "timeGridDay",
      headerToolbar: {
        left: "prev",
        center: "title",
        right: "today next",
      },
      // plugins: [DayGridPlugin, iCalendarPlugin],
      events: {
        url: url1,
        format: "ics",
      },
      eventContent: function(arg) {
        let eventLocation = arg.event.extendedProps.location;
        let eventDescription = arg.event.extendedProps.description;
        let eventDescriptionModifie = eventDescription.replace(/\([^)]*\)/g, '');
        let test = eventDescriptionModifie.replace(/(CM|TDA|TDB|TP1|TP2|TP3|TP4) /g, '$1<br>');
        let eventContent = '<div class="fc-title">' + arg.event.title + '</div>';
        let date = arg.event.startStr;

        if (eventDescription) {
          eventContent += '<div class="fc-description">' + test + '</div>';
        }

        if (eventLocation) {
          eventContent += '<div class="fc-location">' + eventLocation + '</div>';
        }
        if (test.includes('TD') || test.includes('TP')) {
          eventContent += '<button class="custom-event-button" onclick="./pages/appel.php?ressource=' + arg.event.title.replace(/\s/g, '') + '&classe=' + eventDescriptionModifie.replace(/\n/g, '').replace(/\s/g, '').substring(0, 3) + '&date=' + date + '&uid='+ arg.event.extendedProps.uid +'">a</button>';
        }
        return {
          html: eventContent
        };
      },
      eventDidMount: function(arg) {
        let eventTitle = arg.event.title;
        let eventColor = null;

        // Recherchez une correspondance partielle entre le titre de l'événement et les clés de l'objet eventColors
        for (let key in eventColors) {
          if (eventTitle.includes(key)) {
            eventColor = eventColors[key];
            break; // Sortez de la boucle dès qu'une correspondance est trouvée
          }
        }

        if (eventColor) {
          arg.el.style.backgroundColor = eventColor;
        }
      }
    });

    calendar.render();
  });
</script>

</html>