 <?php
//session_start(); 
echo "<pre>";
var_dump($_FILES);
echo "</pre>"; die;
include_once("./inc/header.php");
include_once($_SERVER["DOCUMENT_ROOT"]."/aDeux/view/traitement/traitement.connexion.php");
include_once("../model/database.php");
?>

<body class="pink">

    <div class="FndBlancProfil">
        <!--Affichez les données du profil-->
        <?php
        // Assurez-vous que la session est démarrée
        if (isset($_SESSION['pseudo'])) {
            $pseudo = $_SESSION['pseudo'];
            $age = $_SESSION['age'];
            $photo = $_SESSION['photo'];
            echo $pseudo . "," . " " . $age;
            echo $photo;
        } else {
            echo "Erreur : Pseudo non défini dans la session.";
        }



        $img_name = $_FILES['photo']; // on stock dans  $img_name image
        
        $img_tmp = $_FILES['photo']; // stock la destination temporaire de l'image dans le server  
        

        // dans htdox: dans le projet dans dossier image : prendre :'\ESPACE_MEMBRES\img'+le nom de 'image
        $destination = $_SERVER['DOCUMENT_ROOT'] . '/adeux/views/assets/img/' . $img_name;

        move_uploaded_file($img_tmp, $destination); //une fonction qui enregistre l'image dans le dossier img
        


        ?>