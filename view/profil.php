<?php 
include_once("inc/header.php");
include_once("./view/traitement/traitement.connexion.php");
include_once("./model/database.php");
session_start();
?>
<body class="pink">
  
<div class="FndBlancProfil">
    <!--Affichez les données du profil-->
   <?php 
        
        // Assurez-vous que la session est démarrée
        if(isset($_SESSION['pseudo'])) {
        
            $pseudo = $_SESSION['pseudo'];
            $age = $_SESSION['age'];
            $intitule = $_SESSION['intitule'];
            $religion = $_SESSION['nom_religion'];
            $cheveux = $_SESSION['cheveux'];
            $poids = $_SESSION['poids'];
            $taille = $_SESSION['taille'];
            $yeux = $_SESSION['yeux'];
            $ville = $_SESSION['ville'];
            $origine = $_SESSION['origine'];
            ?>

            <div class="age">
            <?php 
            echo $pseudo ."," . " ".$age." ans" ;
            ?>
            </div>
            <!--<img class="imgprofil" src="assets/img/<?= $_SESSION['photo'] ?>" >-->
            <div class=imgprofil style='background-image : url("assets/img/<?= $_SESSION['photo']?>")'></div>
            <p class="txtPk">Pourquoi <?php echo $pseudo?> est ici</p>
            <div class="relationProfil">
            <div class="intitule">
                <p>
                <i class="fa-solid fa-heart" style="color: #1a1919;"></i>
            <?php
             echo $intitule;
            ?>      
                </p>
            </div>
            </div>

            <p class="txtPk">Son profil</p>
            
            <div class="snprofil"><?php echo $religion; ?></div>
            <div class="snprofil"> <?php echo $cheveux;?> </div> 
            <div class="snprofil"> <?php echo $poids." ","kg";?> </div>
            <div class="snprofil"> <?php echo $taille;?> </div>
            <div class="snprofil"> <?php echo "Yeux" . " ".$yeux;?> </div>
            <div class="snprofil"> <?php echo $origine;?> </div>
            <p class="txtPk"><?php echo "Où habite". " " . $pseudo?></p>
            <div class="snprofil"> <?php echo $ville;?> </div>
        
            <?php   
        } else {
            echo "Erreur : Pseudo non défini dans la session.";
        }


      
      
      
      
    ?>
</div>
</body>
<?php 
include_once("inc/footer.php");
?>