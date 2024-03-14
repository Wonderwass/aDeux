<?php
session_start();
include_once("inc/header.php");
include_once("./view/traitement/traitement.connexion.php");
include_once('./view/traitement/traitement.conv.php');
include_once("./traitement/action.php");
include_once("./model/database.php");
require_once("./traitement/notifications.php");
$id = $_SESSION['id_user'];
$listNotif = conversationsNonLues();
$notifsCrush = notifCrush($id);
//var_dump($listNotif);
// Pour rediriger l'utilisateur vers la page connexion si mon utilisateur n'es pas connecté 
if (empty($_SESSION["id_user"])) {
    header("Location:connexion.php");
}
?>

<body class="pink">
    <div class="FndBlancProfilnotif">
        <?php
        // Vérifiez si $listNotif est défini et n'est pas vide
        if (!empty($notifsCrush)) {
            foreach ($notifsCrush as $notif) { ?>
                <p>Vous avez un nouveau crush avec <?= $notif['pseudo'] ?> </p>
                <hr>
            <?php }
        }
        if (!empty($listNotif)) {
            foreach ($listNotif as $notif) { ?>
                <div onclick="window.location.href='conversation.php?id=<?= $notif['id_utilisateur']; ?>&notifs=true';">
                    <p>Vous avez <?= $notif['count_notifications'] ?> message de <?= $notif['pseudo']; ?></p>
                    <hr>
                </div>
        <?php
            }
        } else if (empty($notifsCrush) && empty($listNotif)) {
            // Affichez un message s'il n'y a pas de notifications
            echo "<p>Aucune notification.</p>";
        }
        ?>
    </div>
</body>