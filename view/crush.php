<?php
session_start();
// on à nimporté le fichier js.js dans le fichier header grace à cette action le fichier js est crush .php peuvent échanger les informations
require_once("inc/header.php");
include_once("./view/traitement/traitement.connexion.php");
include_once("./traitement/action.php");
include_once("./model/database.php");
$id = $_SESSION['id_user'];
$profilAleat = aleatUser();
$likedId = crushLiked();
// Pour rediriger l'utilisateur vers la page connexion si mon utilisateur n'es pas connecté (la fonction empty(). Si elle est vide)
if (empty($_SESSION["id_user"])) {
    header("Location:connexion.php");
}

?>
<body class="pink">

    <div class="FndBlancProfil">
            <!--si l'utilisateur est connecté , execute le code -->
             <?php if (isset($_SESSION['pleine_' . $_SESSION['id_user']])) { ?>
            <!--Ici on redirige ver la page notif-->
            
            <div class="conversations_crush">  
                <button class="logout"> 
                <a href="connexion.php" class="gg-log-off"></a>
                </button>
                 <!--Ici on redirige vers la page de conversation -->
                <a href="notif.php?idCible=<?= implode(',', $likedId) ?>" class="notif"><i class="gg-bell"></i> </a>
                <a class="notifMessage" href="list_crush_conv.php?idCible=<?= implode(',', $likedId) ?>">
                    <i class="gg-comment"></i>
                </a>
                <!--Ici on redirige avec le bouton redirectionProfil , vers le profil de l'utilisateur connecté 
                 href redirige vers la page profil, grace a $_SESSION il recupere l& photo de l'utilisateur connecté-->
                <a href="profil.php" class="redirectionProfil" style="background-image: url('assets/img/<?= $_SESSION['photo'] ?>');"></a>
            </div>
            <div class="FinSwipe">
                <img src="assets/img/robot.rose-removebg-preview.png" alt="icons-robot">
                <h1 id="phrase_robot"></h1>
            </div>
             <?php } else if ($_SESSION['profil_disponible_' . $_SESSION['id_user']]) {  

?>

            <!--Ici on redirige ver la page notif-->
                <button class="logout">
                <a href="connexion.php" class="gg-log-off"></a>
                </button>
            <a href="notif.php?idCible=<?= implode(',', $likedId) ?>" class="notif"><i class="gg-bell"></i> </a>
            <!--Ici on redirige vers la page de conversation -->
            <a class="notifMessage" href="list_crush_conv.php?idCible=<?= implode(',', $likedId) ?>">
                <i class="gg-comment"></i>
            </a>
            <!--Ici on redirige avec le bouton redirectionProfil , vers le profil de l'utilisateur connecté 
            href redirige vers la page profil, grace a $_SESSION il recupere l& photo de l'utilisateur connecté-->
            <a href="profil.php" class="redirectionProfil" style="background-image: url('assets/img/<?= $_SESSION['photo'] ?>');"></a>

            <div class="age">
                <?= $profilAleat['pseudo'] . "," . " " . $profilAleat['age'] . " ans";
                ?>
            </div>
            <div class=imgprofil style='background-image : url("assets/img/<?= $profilAleat['photo'] ?>")'>
            </div>

            <p class="txtPk">Pourquoi <span id="pk"><?= $profilAleat['pseudo'] ?></span> est ici</p>
            <div class="relationProfil">
                <div class="intitule">
                    <p>
                        <i class="fa-solid fa-heart" style="color: #1a1919;"></i>
                        <span id="txtpk"><?= $profilAleat['relation'] ?></span>
                    </p>
                </div>
            </div>
            <p class="txtPk">Son profil</p>
            <div class="snprofil" id="religionjs"><?= $profilAleat['religion']; ?></div>
            <div class="snprofil" id="cheveuxjs"> <?= $profilAleat['cheveux']; ?> </div>
            <div class="snprofil"><span id="poid"><?= $profilAleat['poids'] ?></span> kg</div>
            <div class="snprofil" id="taillejs"> <?= $profilAleat['taille']; ?> </div>
            <div class="snprofil" id="yeuxjs"> <?= "Yeux" . " " . $profilAleat['yeux']; ?> </div>
            <div class="snprofil" id="originejs"> <?= $profilAleat['origine']; ?> </div>
            <p class="txtPk"><span id="ouhabite"><?= "Où habite" . " " . $profilAleat['pseudo'] ?><span></p>
            <div class="snprofil" id="villejs"> <?= $profilAleat['ville']; ?> </div>

            <div class="crushCubec">
                <a href="#" data-user-crush=<?= $profilAleat["id_utilisateur"] ?> id="coeur-coeur"><i class="fa-solid fa-heart fa-beat-fade" id="coeur" style="color: #f1c9fe;font-size:50px"></i></a>
            </div>
            <div class="crushCuber">
                <a href="#" data-user-crush=<?= $profilAleat["id_utilisateur"] ?> id="recal"><i class="fa-solid fa-xmark" id="recal" style="color: #f1c9fe; font-size:50px"></i>
            </div>

        <?php  }; ?>


    </div>

    <?php
    include_once("inc/footer.php");
?>  