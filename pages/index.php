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

$sql_information = "SELECT informations.*, users.role FROM informations INNER JOIN users ON informations.id_user = users.id_user ORDER BY date DESC";
$stmt_information = $dbh->prepare($sql_information);
$stmt_information->execute();
$informations = $stmt_information->fetchAll(PDO::FETCH_ASSOC);

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
        <div></div>
      </div>
      <div class="select_but_agenda">
          <select name="but" id="but">
            <option value="BUT1">BUT1</option>
            <option value="BUT2">BUT2</option>
            <option value="BUT3">BUT3</option>
          </select>
          <select name="tp" id="tp">
            <option value="TP1">TP1</option>
            <option value="TP2">TP2</option>
            <option value="TP3">TP3</option>
            <option value="TP4">TP4</option>
          </select>
        </div>
      <div class="agenda_content-agenda"></div>


    </section>
    
    <section class="main-outils">
    <div class="title_trait">
        <h1>Outils supplémentaires</h1>
        <div></div>
      </div>
      <div style="height:30px"></div>
    <div class="container-outils">
            <a href="https://zimbra.univ-poitiers.fr" target="_blank">
                <div class="item-outils red">
                    <div class="item_flextop-outils">
                        <h1>Messagerie
                        <br>(webmail)
                        </h1>
                        <img src="./../assets/img/messagerie.webp" alt="Une personne envoyant un email">
                    </div>
                    <div class="item_flexbottom-outils">
                        <p>Ta messagerie de l’université de Poitiers</p>
                    </div>
                </div>
            </a>
            <a href="https://cas.univ-poitiers.fr/cas/login?service=https://ent.univ-poitiers.fr/uPortal/Login" target="_blank">
                <div class="item-outils purple">
                    <div class="item_flextop-outils">
                        <h1>ENT</h1>
                        <img src="./../assets/img/ENT.webp" alt="Une personne qui travaille">
                    </div>
                    <div class="item_flexbottom-outils">
                        <p>Ton espace numérique de travail</p>
                    </div>
                </div>
            </a>
            <a href="https://auth.univ-poitiers.fr/cas/login?service=https%3A%2F%2Fupdago.univ-poitiers.fr%2Flogin%2Findex.php%3FauthCAS%3DCAS" target="_blank">
                <div class="item-outils orange">
                    <div class="item_flextop-outils updago_img">
                        <h1>UPdago</h1>
                        <img src="./../assets/img/UPdago.webp" alt="Logo de UPdago">
                    </div>
                    <div class="item_flexbottom-outils">
                        <p>Ta plateforme d’enseignement en ligne</p>
                    </div>
                </div>
            </a>
            
        </div>
    </section>
    <section class="main-informations">
        <div style="height:30px"></div>
        <div class="title_trait">
            <h1>Informations</h1>
            <div></div>
        </div>
        <div style="height:20px"></div>
        <div class="container-informations">
            <?php foreach ($informations as $information) : 
                $name_color = "";
                if ($information['role'] == "eleve") {
                    $name_color = "#FFB141";
                } elseif ($information['role'] == "prof") {
                    $name_color = "#5cceff";
                } elseif ($information['role'] == "admin") {
                    $name_color = "#6C757D";
                }elseif ($information['role'] == "chef") {
                        $name_color = "#6C757D";
                } elseif (strpos($information['role'], 'BDE') !== false) {
                    $name_color = "#bca5ff";
                }
                ?>
                <div class="item-information">
                    <div class="item_content_title-information">
                        <div class="item_content_title_flexleft-information">
                            <h2><?= $information['titre'] ?></h2>
                            <p><?= $information['date'] ?></p>
                        </div>
                        <div class="item_content_title_flexright-information" style="background-color : <?php echo $name_color ?>">
                            <p><?= $information['user'] ?></p>
                        </div>
                    </div>
                    <div class="item_content_text-information">
                        <p><?= $information['content'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
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
<script>
        const butSelect = document.getElementById('but');
        const tpSelect = document.getElementById('tp');
        const agendaMain = document.querySelector('.agenda_content-agenda');

        // Fonction pour effectuer la requête XHR en utilisant POST
        function loadAgenda() {
            const selectedBut = butSelect.value;
            const selectedTp = tpSelect.value;

            let edu_group = selectedBut + '-' + selectedTp;

            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // const response = JSON.parse();
                    agendaMain.innerHTML = xhr.responseText;
                }
            };

            // Préparez les données à envoyer en tant que paramètres POST
            const data = new FormData();
            data.append('edu_group', edu_group);

            // Envoyer la requête POST vers agenda.php
            xhr.open('POST', 'agenda_index.php', true);
            xhr.send(data);
        }

        // Écouteurs d'événements pour les changements d'options
        butSelect.addEventListener('change', loadAgenda);
        tpSelect.addEventListener('change', loadAgenda);
    </script>

</html>