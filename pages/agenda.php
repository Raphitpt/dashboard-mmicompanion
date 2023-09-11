<?php
session_start();
require '../bootstrap.php';


// La on récupère le cookie que l'on à crée à la connection, voir login.php et fonction.php
// --------------------
$jwt = $_COOKIE['jwt'];
$secret_key = $_ENV['SECRET_KEY']; // La variable est une variable d'environnement qui est dans le fichier .env
$user = decodeJWT($jwt, $secret_key);

if (isset($_POST['submit']) && !empty($_POST['title']) && !empty($_POST['date']) && !empty($_POST['school_subject'])&& !empty($_POST['but'])&& !empty($_POST['tp'])) {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $edu_group = $_POST['but'] . '-' . $_POST['tp'];
    if (isset($_POST['type'])) {
        $type = $_POST['type'];
    } else {
        $type = "autre";
    }
    $school_subject = $_POST['school_subject'];
    $sql = "INSERT INTO agenda (title, date_finish, type, id_user, id_subject, edu_group) VALUES (:title, :date, :type, :id_user, :id_subject, :edu_group)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([
        'title' => $title,
        'date' => $date,
        'id_user' => $user['id_user'],
        'type' => $type,
        'id_subject' => $school_subject,
        'edu_group' => $edu_group
    ]);
    header('Location: ./agenda.php');
    exit();
}

// Petit bout de code pour récupérer les matières dans la base de donnée et les utiliser dans le select du formulaire
// --------------------
$sql_subject = "SELECT * FROM sch_subject ORDER BY name_subject ASC";
$stmt_subject = $dbh->prepare($sql_subject);
$stmt_subject->execute();
$subject = $stmt_subject->fetchAll(PDO::FETCH_ASSOC);

echo head("Agenda");
?>

<body>
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
    <section class="add-agenda">
        <div style="height:30px"></div>
        <div class="title_trait">
            <h1>Ajouter une tâche</h1>
            <div></div>
        </div>
        <div style="height:25px"></div>
        <div class="agenda-agenda_add">
            <!-- Formualaire d'ajout d'une tache, comme on peut le voir, l'envoi de ce formulaire ajoute 30 points à la personne grâce au code -->
            <form class="form-agenda_add" method="POST" action="" onsubmit="updatePoints(30)">

                <input type="text" name="title" class="input_title-agenda_add" placeholder="Ajouter un titre" required>
                <div class="trait_agenda_add"></div>

                <label for="date" class="label-agenda_add">
                    <h2>Ajouter une date</h2>
                </label>
                <div style="height:5px"></div>
                <div class="container_input-agenda_add">
                    <i class="fi fi-br-calendar"></i>
                    <input type="date" name="date" class="input_date-agenda_add input-agenda_add" value="<?php echo date('Y-m-d'); ?>" placeholder="yyyy-mm-dd" min="<?php echo date("Y-m-d") ?>" required>
                </div>
                <div style="height:15px"></div>
                <label for="type" class="label-agenda_add">
                    <h2>Type de tâche</h2>
                </label>
                <div style="height:5px"></div>
                <div class="container_input-agenda_add">
                    <i class="fi fi-br-list"></i>
                    <select name="type" class="input_select-agenda_add input-agenda_add" required>
                        <option value="eval">Évaluation</option>
                        <option value="devoir">Devoir à rendre</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>
                <div class="trait_agenda_add"></div>
                <label for="type" class="label-agenda_add">
                    <h2>Ajouter une matière</h2>
                </label>
                <div style="height:5px"></div>
                
                <div class="container_input-agenda_add">
                    <i class="fi fi-br-graduation-cap"></i>
                    <select name="school_subject" class="input_select-agenda_add input-agenda_add" required>
                        <?php
                        foreach ($subject as $subjects) {
                            echo "<option value='" . $subjects['id_subject'] . "'>" . $subjects['name_subject'] . "</option>";
                        }; ?>
                    </select>
                </div>
                <div class="select_but_agenda">
                    <label for="but" class="label-agenda_add">
                        <h2>Ajouter une classe</h2>
                    </label>
                    <div style="height:5px"></div>
                    <div class="container_input-agenda_add">
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
                </div>
                
                <div style="height:25px"></div>
                <div class="form_button-agenda">
                    <a role="button" href='./agenda.php'>Annuler</a>
                    <input type="submit" name="submit" value="Valider">
                </div>

            </form>
        </div>

    </section>
</body>
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
        xhr.onreadystatechange = function() {
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