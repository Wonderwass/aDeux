<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("inc/header.php");
require_once("./traitement/action.php");
require_once("../model/Repository/CrushRepository.php");
$id = $_SESSION['id_user'];
// Pour rediriger l'utilisateur vers la page connexion si mon utilisateur n'est pas connecté 
if (empty($_SESSION["id_user"])) {
    header("Location: connexion.php");
}

$listCrush = crush();


//echo '<pre>';
//var_dump($listCrush);
//echo '</pre>';
//xvar_dump('ciyciy');

?>

<body class="pink">
    <div class="FndBlancProfilList">
        <?php foreach ($listCrush as $crush) : ?>
            <?php if (isset($crush['id_user_cible'])) : ?>
                <?php $photoURL = "./assets/img/" . $crush['photo']; ?>

                <div class='cursor' style='cursor: pointer;' onclick="window.location.href='./traitement/notifications.php?id=<?= $crush['id_user_cible']; ?>&notifs=true';">
                    <!-- Afficher la photo de l'utilisateur cible -->
                    <div id="list_crush_conv">
                        <div class='bull-conv' style='background-image: url(<?php echo $photoURL; ?>);'></div>
                        <p>Appuyez pour chatter avec <span><?= $crush['pseudo']; ?></span></p>
                    </div>
                    <br>
                    <!-- ID User Cible: <?= $crush['id_user_cible']; ?></a><br> -->
                </div>
                <hr> <!-- Une ligne horizontale pour séparer chaque utilisateur -->
            <?php else : ?>
                La clé 'id_user_cible' n'existe pas ou est invalide.<br>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</body>