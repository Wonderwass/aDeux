<?php
session_start();
include_once("inc/header.php");
include_once("./view/traitement/traitement.connexion.php");
include_once("../model/Repository/CrushRepository.php");
include_once("./model/database.php");
include_once('./view/traitement/traitement.conv.php');
include_once('../view/traitement/action.php');
// si get id existe $id_cible prendra sa valeur sinon elle sera null
$idCible = isset($_GET['id']) ? $_GET['id'] : null;
$messageConv = conversations($idCible);
$profilCrush = profilCrushConv($idCible);
//var_dump($profilCrush);
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
?>

<body class="pink">
    <div class="FndBlancProfil FndChat">
        <div id="messages-conv">

        <a href="profil.php" class="redirectionProfil" style="background-image: url('assets/img/<?= $_SESSION['photo'] ?>');"></a>
        
            
            <img class="bulleConv" src="./assets/img/<?= $profilCrush['photo']; ?>" alt="photo du crush">
            <?= $profilCrush["pseudo"]; ?>
            <hr>
            <?php foreach ($messageConv as $message) { ?>
                <div class="other<?= $message['css']; ?> <?= $message['css']; ?>" data-user = <?= $_SESSION['id_user'] ?> data-cible = <?=$idCible ?>>
                    <p id="chatmarg" class="bulle"><?= $message["message"]; ?></p>                    
                </div>
            <?php } ?>
        </div>
        <div class="texto">
           <div> <input type="text" id="conversation-<?= $idCible ?>" class="conversation" onkeydown="handleKeyDown(event, <?= $idCible ?>)"></div>
           <div> <button type="button" id="bouton-conv-<?= $idCible ?>" class="bouton-conv" onclick="sendMessage(<?= $idCible ?>)">Envoyer</button></div>
        </div>
    </div>