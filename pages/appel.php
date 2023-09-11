<?php
session_start();
require '../bootstrap.php';

if(isset($_GET['ressource']) && isset($_GET['classe']) && isset($_GET['uid']) && isset($_GET['date'])){
    $ressource = $_GET['ressource'];
    $classe = $_GET['classe'];
    $uid = $_GET['uid'];
    $date = $_GET['date'];
    $date = preg_replace('/\s+\d{2}:\d{2}$/', '', $date);
    $dateTime = DateTime::createFromFormat("Y-m-d\TH:i:s", $date);
    // var_dump($dateTime);

    if(strpos($ressource, 'R1') !== false || strpos($ressource, 'R2') !== false || strpos($ressource, 'SAE1') !== false || strpos($ressource, 'SAE2') !== false){
        if(strpos($classe, 'TDA') !== false){
            $sql = "SELECT pname, name, id_user FROM users WHERE edu_group = 'BUT1-TP1' OR edu_group = 'BUT1-TP2' ORDER BY name ASC";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        elseif(strpos($classe, 'TDB') !== false){
            $sql = "SELECT pname, name, id_user FROM users WHERE edu_group = 'BUT1-TP3' OR edu_group = 'BUT1-TP4' ORDER BY name ASC";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        elseif(strpos($classe, 'TP') !== false){
            $classe = "BUT1-" . $classe;
            $sql = "SELECT pname, name, id_user FROM users WHERE edu_group = :classe ORDER BY name ASC";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                'classe' => $classe
            ]);
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }elseif(strpos($ressource, 'R3') !== false || strpos($ressource, 'R4') !== false || strpos($ressource, 'SAE3') !== false || strpos($ressource, 'SAE4') !== false){
        if(strpos($classe, 'TDA') !== false){
            $sql = "SELECT pname, name, id_user FROM users WHERE edu_group = 'BUT2-TP1' OR edu_group = 'BUT2-TP2' ORDER BY name ASC";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        elseif(strpos($classe, 'TDB') !== false){
            $sql = "SELECT pname, name, id_user FROM users WHERE edu_group = 'BUT2-TP3' OR edu_group = 'BUT2-TP4' ORDER BY name ASC";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        elseif(strpos($classe, 'TP') !== false){
            $classe = "BUT2-" . $classe;
            $sql = "SELECT pname, name, id_user FROM users WHERE edu_group = :classe ORDER BY name ASC";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                'classe' => $classe
            ]);
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }elseif(strpos($ressource, 'R5') !== false || strpos($ressource, 'R6') !== false || strpos($ressource, 'SAE5') !== false || strpos($ressource, 'SAE6') !== false){
        if(strpos($classe, 'TDA') !== false){
            $sql = "SELECT pname, name, id_user FROM users WHERE edu_group = 'BUT3-TP1' OR edu_group = 'BUT3-TP2' ORDER BY name ASC";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        elseif(strpos($classe, 'TDB') !== false){
            $sql = "SELECT pname, name, id_user FROM users WHERE edu_group = 'BUT3-TP3' OR edu_group = 'BUT3-TP4' ORDER BY name ASC";
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        elseif(strpos($classe, 'TP') !== false){
            $classe = "BUT3-" . $classe;
            $sql = "SELECT pname, name, id_user FROM users WHERE edu_group = :classe ORDER BY name ASC";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([
                'classe' => $classe
            ]);
            $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

}

echo head('MMI Companion | Faire l\'appel');
$semaine = array(
    " Dimanche ",
    " Lundi ",
    " Mardi ",
    " Mercredi ",
    " Jeudi ",
    " Vendredi ",
    " Samedi "
);
?>
<body>
    <h1>Feuille d'appel du cours de <?php echo $ressource ?></h1>
    <p><?php echo $dateTime->format("l d/m"); ?></p>
    
    <table border="1">
        <tr>
            <th>Nom de l'élève</th>
            <th>Prénom de l'élève</th>
            <th>Présent</th>
        </tr>
        <?php foreach ($students as $student): ?>
        <tr>
            <td><?php echo $student['name']; ?></td>
            <td><?php echo $student['pname']; ?></td>
            <td><input type="checkbox" name="present"></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>