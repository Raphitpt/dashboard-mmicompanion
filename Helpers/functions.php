<?php

/*

    Fichier : /Helpers/functions.php
 */
require __DIR__ . '/../vendor/autoload.php';



/**
 * Retourne le contenu HTML du bloc d'en tête d'une page.
 * Deux CSS sont automatiquement intégré :
 *   - pico.css
 *   - custom.css
 *
 * @param string title le titre de la page.
 * @return string
 */
function head(string $title = ''): string
{
    return  <<<HTML_HEAD
<!DOCTYPE html>
<html lang="fr">

<head>
<!-- Google tag (gtag.js) -->

<script async src="https://www.googletagmanager.com/gtag/js?id=G-FX70LE2MCM"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-FX70LE2MCM');
</script>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/svg" href="../assets/img/mmicompanion_512.svg" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../assets/css/style.css" rel="stylesheet"">
  <link href="../assets/css/uicons-bold-rounded.css" rel="stylesheet"">
  <link rel="manifest" href="../manifest.webmanifest" />
  <script async src="https://unpkg.com/pwacompat" crossorigin="anonymous"></script>
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

  <script src="./../assets/js/jquery-3.7.1.min.js"></script>

  <link rel="apple-touch-startup-image" media="screen and (device-width: 430px) and (device-height: 932px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="../splash_screens/iPhone_14_Pro_Max_landscape.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 393px) and (device-height: 852px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="../splash_screens/iPhone_14_Pro_landscape.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="../splash_screens/iPhone_14_Plus__iPhone_13_Pro_Max__iPhone_12_Pro_Max_landscape.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="../splash_screens/iPhone_14__iPhone_13_Pro__iPhone_13__iPhone_12_Pro__iPhone_12_landscape.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="../splash_screens/iPhone_13_mini__iPhone_12_mini__iPhone_11_Pro__iPhone_XS__iPhone_X_landscape.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="../splash_screens/iPhone_11_Pro_Max__iPhone_XS_Max_landscape.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="../splash_screens/iPhone_11__iPhone_XR_landscape.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)" href="../splash_screens/iPhone_8_Plus__iPhone_7_Plus__iPhone_6s_Plus__iPhone_6_Plus_landscape.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="../splash_screens/iPhone_8__iPhone_7__iPhone_6s__iPhone_6__4.7__iPhone_SE_landscape.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="../splash_screens/4__iPhone_SE__iPod_touch_5th_generation_and_later_landscape.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="../splash_screens/12.9__iPad_Pro_landscape.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="../splash_screens/11__iPad_Pro__10.5__iPad_Pro_landscape.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 820px) and (device-height: 1180px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="../splash_screens/10.9__iPad_Air_landscape.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="../splash_screens/10.5__iPad_Air_landscape.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 810px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="../splash_screens/10.2__iPad_landscape.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="../splash_screens/9.7__iPad_Pro__7.9__iPad_mini__9.7__iPad_Air__9.7__iPad_landscape.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 744px) and (device-height: 1133px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)" href="../splash_screens/8.3__iPad_Mini_landscape.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 430px) and (device-height: 932px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="../splash_screens/iPhone_14_Pro_Max_portrait.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 393px) and (device-height: 852px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="../splash_screens/iPhone_14_Pro_portrait.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="../splash_screens/iPhone_14_Plus__iPhone_13_Pro_Max__iPhone_12_Pro_Max_portrait.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="../splash_screens/iPhone_14__iPhone_13_Pro__iPhone_13__iPhone_12_Pro__iPhone_12_portrait.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="../splash_screens/iPhone_13_mini__iPhone_12_mini__iPhone_11_Pro__iPhone_XS__iPhone_X_portrait.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="../splash_screens/iPhone_11_Pro_Max__iPhone_XS_Max_portrait.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="../splash_screens/iPhone_11__iPhone_XR_portrait.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)" href="../splash_screens/iPhone_8_Plus__iPhone_7_Plus__iPhone_6s_Plus__iPhone_6_Plus_portrait.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="../splash_screens/iPhone_8__iPhone_7__iPhone_6s__iPhone_6__4.7__iPhone_SE_portrait.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="../splash_screens/4__iPhone_SE__iPod_touch_5th_generation_and_later_portrait.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="../splash_screens/12.9__iPad_Pro_portrait.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="../splash_screens/11__iPad_Pro__10.5__iPad_Pro_portrait.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 820px) and (device-height: 1180px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="../splash_screens/10.9__iPad_Air_portrait.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="../splash_screens/10.5__iPad_Air_portrait.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 810px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="../splash_screens/10.2__iPad_portrait.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="../splash_screens/9.7__iPad_Pro__7.9__iPad_mini__9.7__iPad_Air__9.7__iPad_portrait.png">
<link rel="apple-touch-startup-image" media="screen and (device-width: 744px) and (device-height: 1133px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)" href="../splash_screens/8.3__iPad_Mini_portrait.png">
  <title>$title</title>
</head>
HTML_HEAD;
}




function generateBurgerMenuContent()
{
    // Le code HTML du menu burger
    $menuHtmlFinal = '
    <div class="burger_content-header" id="burger_content-header">
        <div style="height:60px"></div>
        <div class="burger_content_title-header">
            <img src="./../assets/img/mmicompanion.svg" alt="">
            <h1>MMI Companion</h1>
        </div>
        <div class="burger_content_content-header">
            <div class="burger_content_trait_header"></div>
            <a href="./index.php">
                <div class="burger_content_link-header">
                    <i class="fi fi-br-home"></i>
                    <p>Vue d\'ensemble</p>
                    <div id="select_background_index-header" class=""></div>
                </div>
            </a>
            <a href="./agenda.php">
                <div class="burger_content_link-header">
                    <i class="fi fi-br-calendar"></i>
                    <p>Agenda</p>
                    <div id="select_background_agenda-header" class=""></div>
                </div>
            </a>
            <div class="burger_content_trait_header"></div>
            <a href="./messages.php">
                <div class="burger_content_link-header">
                    <i class="fi fi-br-comment-alt"></i>
                    <p>Messages</p>
                    <div id="select_background_messages-header" class=""></div>
                </div>
            </a>
            <a href="./mail.php">
                <div class="burger_content_link-header">
                    <i class="fi fi-br-envelope"></i>
                    <p>Boite mail</p>
                    <div id="select_background_mail-header" class=""></div>
                </div>
            </a>
            <div class="burger_content_trait_header"></div>
            <a href="./sante.php">
                <div class="burger_content_link-header">
                    <i class="fi fi-br-doctor"></i>
                    <p>Mon bien être</p>
                    <div id="select_background_sante-header" class=""></div>
                </div>
            </a>
            <a href="./profil.php">
                <div class="burger_content_link-header">
                    <i class="fi fi-br-user"></i>
                    <p>Mon profil</p>
                    <div id="select_background_profil-header" class=""></div>
                </div>
            </a>
            <div class="burger_content_trait_header"></div>
            <a href="./logout.php">
                <div class="burger_content_link-header logout-header">
                    <i class="fi fi-br-delete-user"></i>
                    <p>Se déconnecter</p>
                </div>
            </a>
        </div>
    </div>';

    $menuHtml = '
    <div class="burger_content-header" id="burger_content-header">
        <div style="height:60px"></div>
        <div class="burger_content_title-header">
            <img src="./../assets/img/mmicompanion.svg" alt="">
            <h1>MMI Companion</h1>
        </div>
        <div class="burger_content_content-header">
            <div class="burger_content_trait_header"></div>
            <a href="./index.php">
                <div class="burger_content_link-header">
                    <i class="fi fi-br-calendar-lines"></i>
                    <p>Emploi du temps</p>
                    <div id="select_background_index-header" class=""></div>
                </div>
            </a>
            <a href="./agenda.php">
                <div class="burger_content_link-header">
                    <i class="fi fi-br-book-bookmark"></i>
                    <p>Agenda</p>
                    <div id="select_background_agenda-header" class=""></div>
                </div>
            </a>
            <div class="burger_content_trait_header"></div>
            <a href="./profil.php">
                <div class="burger_content_link-header">
                    <i class="fi fi-br-user"></i>
                    <p>Mon profil</p>
                    <div id="select_background_profil-header" class=""></div>
                </div>
            </a>
            <div class="burger_content_trait_header"></div>
            <a href="./logout.php">
                <div class="burger_content_link-header logout-header">
                    <i class="fi fi-br-delete-user"></i>
                    <p>Se déconnecter</p>
                </div>
            </a>
        </div>
    </div>';

    echo $menuHtml; // Affiche le menu HTML
}


/**
 * Retourne vrai si la méthode d'appel est GET.
 */

function isGetMethod(): bool
{
    return ($_SERVER['REQUEST_METHOD'] === 'GET');
}

/**
 * Retourne vrai si la méthode d'appel est POST.
 */
function isPostMethod(): bool
{
    return ($_SERVER['REQUEST_METHOD'] === 'POST');
}

function calendar($group = '')
{
    $calendar_link = '';
    if ($group == "BUT1-TP1") {
        $calendar_link = 'https://upplanning.appli.univ-poitiers.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=21314&projectId=14&calType=ical&nbWeeks=15';
    }
    if ($group == "BUT1-TP2") {
        $calendar_link = 'https://upplanning.appli.univ-poitiers.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=21315&projectId=14&calType=ical&nbWeeks=15';
    }
    if ($group == "BUT1-TP3") {
        $calendar_link = 'https://upplanning.appli.univ-poitiers.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=21470&projectId=14&calType=ical&nbWeeks=15';
    }
    if ($group == "BUT1-TP4") {
        $calendar_link = 'https://upplanning.appli.univ-poitiers.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=24826&projectId=14&calType=ical&nbWeeks=15';
    }
    if ($group == "BUT2-TP1") {
        $calendar_link = 'https://upplanning.appli.univ-poitiers.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=24827&projectId=14&calType=ical&nbWeeks=15';
    }
    if ($group == "BUT2-TP2") {
        $calendar_link = 'https://upplanning.appli.univ-poitiers.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=24834&projectId=14&calType=ical&nbWeeks=15';
    }
    if ($group == "BUT2-TP3") {
        $calendar_link = 'https://upplanning.appli.univ-poitiers.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=24835&projectId=14&calType=ical&nbWeeks=15';
    }
    if ($group == "BUT2-TP4") {
        $calendar_link = 'https://upplanning.appli.univ-poitiers.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=24836&projectId=14&calType=ical&nbWeeks=15';
    }
    if ($group == "BUT3-TP1") {
        $calendar_link = 'https://upplanning.appli.univ-poitiers.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=2465&projectId=14&calType=ical&nbWeeks=15';
    }
    if ($group == "BUT3-TP2") {
        $calendar_link = 'https://upplanning.appli.univ-poitiers.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=2454&projectId=14&calType=ical&nbWeeks=15';
    }
    if ($group == "BUT3-TP3") {
        $calendar_link = 'https://upplanning.appli.univ-poitiers.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=2452&projectId=14&calType=ical&nbWeeks=15';
    }
    if ($group == "BUT3-TP4") {
        $calendar_link = 'https://upplanning.appli.univ-poitiers.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=2451&projectId=14&calType=ical&nbWeeks=15';
    }
    return $calendar_link;
}
// on initialise la bibliothèque Firebase JWT pour PHP avec Composer et on y ajoute la clé secrète qui est dans le fichier .env
use \Firebase\JWT\JWT;
use Firebase\JWT\Key;

// La c'est la fonction qui décode le JWT, oui le cookie est encodé pour plus de sécurité,
// Il faut que le tableau ci-dessous soit identique à celui du fichier login.php, sinon on perd des données
// Si on ajoute un champs dans le cookie il faut l'ajouter dans le tableau ci-dessous puis dans le fichier login.php
// La clé secrète est dans le fichier .env, ne pas toucher
function decodeJWT($jwt, $secret_key)
{

    try {
        // Décoder le JWT avec la clé secrète

        $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));

        // Accéder aux valeurs du payload du JWT
        $pname = $decoded->pname;
        $name = $decoded->name;
        $edu_group = $decoded->edu_group;
        $id_user = $decoded->id_user;
        $edu_mail = $decoded->edu_mail;
        $role = $decoded->role;

        // Retourner les valeurs sous forme d'un tableau associatif
        return array(
            'edu_group' => $edu_group,
            'pname' => $pname,
            'name' => $name,
            'id_user' => $id_user,
            'edu_mail' => $edu_mail,
            'role' => $role
        );
    } catch (Exception $e) {
        // Gérer les erreurs de décodage du JWT ici
        echo "Erreur de décodage du JWT : " . $e->getMessage();
    }
}

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

function sendNotification($message, $body, $group)
{
    $dbh = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'] . '', $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    // Assuming you already have a valid $dbh connection to your database
    if ($group != null) {
        $query = "SELECT s.* FROM subscriptions s
                  INNER JOIN users u ON s.edu_mail = u.edu_mail
                  WHERE u.edu_group = :group";
        $stmt = $dbh->prepare($query);
        $stmt->execute(['group' => $group]);
        $subscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $query = "SELECT * FROM subscriptions";
        $stmt = $dbh->query($query);
        $subscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    $auth = array(
        'VAPID' => array(
            'subject' => 'mailto:rtiphonet@gmail.com',
            'publicKey' => $_ENV['VAPID_PUBLIC_KEY'],
            'privateKey' => $_ENV['VAPID_PRIVATE_KEY'],
        ),
    );

    $webPush = new WebPush($auth);

    foreach ($subscriptions as $subscriptionData) {
        $subscription = Subscription::create([
            'endpoint' => $subscriptionData['endpoint'],
            'keys' => [
                'p256dh' => $subscriptionData['p256dh'],
                'auth' => $subscriptionData['auth'],
            ],
            // You can add additional properties if needed, e.g., 'contentEncoding', 'expirationTime', etc.
        ]);

        $payload = json_encode([
            'body' => $body,
            'title' => $message
        ]);

        $webPush->queueNotification($subscription, $payload);
    }

    $webPush->flush();

    foreach ($webPush->flush() as $report) {
        $endpoint = $report->getRequest()->getUri()->__toString();

        if ($report->isSuccess()) {
            echo "[v] Le message à bien été envoyer à {$endpoint}.\n";
        } else {
            echo "[x] Le message n'a pas réussi à être envoyer {$endpoint}: {$report->getReason()}\n";
            // Handle the failure, remove the subscription from your server, etc.
        }
    }
}
function generate_activation_code(): string
{
    return bin2hex(random_bytes(16));
}

const APP_URL = 'https://app.mmi-companion.fr/pages';
const SENDER_EMAIL_ADDRESS = 'no-reply@mmi-companion.fr';
function send_activation_email(string $email, string $activation_code)
{
    // create the activation link
    $activation_link = APP_URL . "/verify_mail.php?email=$email&activation_code=$activation_code";

    // set email subject & body
    $subject = 'Active ton compte dès maintenant !';
    $message = <<<MESSAGE
            Salut,
            Clique sur le lien pour activer ton compte MMI Companion:
            $activation_link
            MESSAGE;
    // email header
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'From: MMI Companion <' . SENDER_EMAIL_ADDRESS . '>' . "\r\n" .
        'Reply-To:' . SENDER_EMAIL_ADDRESS . "\r\n" .
        'Content-Type: text/plain; charset="utf-8"; DelSp="Yes"; format=flowed ' . "\r\n" .
        'Content-Disposition: inline' . "\r\n" .
        'Content-Transfer-Encoding: 7bit' . " \r\n" .
        'X-Mailer:PHP/' . phpversion();

    // send the email
    $_SESSION['mail_message'] = "";
    if (mail($email, $subject, nl2br($message), $headers)) {
        $_SESSION['mail_message'] = "Le mail vient de t'être envoyé, penses à regarder dans tes spams si besoin.";
    } else {
        $_SESSION['mail_message'] = "Une erreur vient de survenir lors de l'envoi du mail, réessaye plus tard.";
        error_log("Error sending activation email to $email");
    }
}

function send_reset_password(string $email, string $activation_code)
{
    // create the activation link
    $activation_link = APP_URL . "/verify_password.php?email=$email&activation_code=$activation_code";

    // set email subject & body
    $subject = 'Réinitialise ton mot de passe dès maintenant !';
    $message = <<<HTML
<!DOCTYPE html>
<html lang="en" style="margin: 0; padding: 0; box-sizing: border-box;">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Email</title>
    <style>
.button:hover {
  background-color: #458ea4;
}
</style>
</head>
<body style="margin: 0; padding: 0; box-sizing: border-box; background-color: #f2f2f2;">
    <div class="container" style="box-sizing: border-box; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #B9E0FF; border-radius: 5px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        <div class="logo" style="margin: 0; padding: 0; box-sizing: border-box; text-align: center; margin-bottom: 20px;">
            <img src="https://dev.mmi-companion.fr/mmicompanion/assets/img/mmicompanion.svg" alt="logo mmi" style="margin: 0; padding: 0; box-sizing: border-box; max-width: 80%;">
            <h1 style="margin: 0; padding: 0; box-sizing: border-box; color: #56B8D6; font-family: Montserrat, sans-serif; font-size: 1.6rem; font-weight: 800;">MMI Companion</h1>
        </div>

        <table style="margin: 0; padding: 0; box-sizing: border-box; width: 100%; border-collapse: collapse; margin-bottom: 20px;" width="100%">
            <tbody style="margin: 0; padding: 0; box-sizing: border-box;">
                <tr style="margin: 0; padding: 0; box-sizing: border-box;">
                    <td style="margin: 0; box-sizing: border-box; padding: 10px; text-align: left; border-bottom: 1px solid #ccc;" align="left">
                        <img src="https://dev.mmi-companion.fr/mmicompanion/assets/img/verif_mail.svg" style="margin: 0; padding: 0; box-sizing: border-box; width: 100%;" alt="email">
                    </td>
                </tr>
                <tr style="margin: 0; padding: 0; box-sizing: border-box;">
                    <td style="margin: 0; box-sizing: border-box; padding: 10px; text-align: left; border-bottom: 1px solid #ccc;" align="left">
                        <p style="margin: 0; padding: 0; box-sizing: border-box; color: #004A5A; font-family: Montserrat, sans-serif; font-size: 1.2rem; font-weight: 500; text-align: center;">
                            Bonjour, <br style="margin: 0; padding: 0; box-sizing: border-box;"><br style="margin: 0; padding: 0; box-sizing: border-box;">
                            Merci de confirmer votre email en cliquant sur le lien ci-dessous.
                        </p>
                    </td>
                </tr>
                <tr style="margin: 0; padding: 0; box-sizing: border-box;">
                    <td style="margin: 0; box-sizing: border-box; padding: 10px; text-align: left; border-bottom: 1px solid #ccc;" align="left">
                        <a href="$activation_link" class="button" style="margin: 0; box-sizing: border-box; background-color: #56B8D6; color: #004A5A; border: none; border-radius: 25px; padding: 10px 60px; font-size: 13px; font-weight: 800; cursor: pointer; font-family: Montserrat, sans-serif; text-decoration: none; display: block; width: 100%; text-align: center;">Confirmer votre email</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>

HTML;

    // email header
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'From: MMI Companion <' . SENDER_EMAIL_ADDRESS . '>' . "\r\n" .
        'Reply-To:' . SENDER_EMAIL_ADDRESS . "\r\n" .
        'Content-Type: text/html; charset="utf-8"' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    // send the email
    $_SESSION['mail_message'] = "";
    if (mail($email, $subject, nl2br($message), $headers)) {
        $_SESSION['mail_message'] = "Le mail vient de t'être envoyé, penses à regarder dans tes spams si besoin.";
    } else {
        $_SESSION['mail_message'] = "Une erreur vient de survenir lors de l'envoi du mail, réessaye plus tard.";
        error_log("Error sending activation email to $email");
    }
}

function compareDates($a, $b)
{
    $dateA = strtotime($a['date_finish']);
    $dateB = strtotime($b['date_finish']);

    if ($dateA == $dateB) {
        return 0;
    }
    return ($dateA < $dateB) ? -1 : 1;
}
