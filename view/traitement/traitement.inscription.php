<?php

require_once("../../model/database.php");

if (isset($_POST["inscription"])) {
   
    // Récupérer les informations saisies par l'utilisateur
    //htmlspecialchars permet de traduire en text  , une fonction par defaut et de type tableau associatif 
    $email = htmlspecialchars($_POST["email"]);
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $password = htmlspecialchars($_POST["password"]);
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $sex = htmlspecialchars($_POST["sex"]);
    $age = htmlspecialchars($_POST["age"]);
    $poids = htmlspecialchars($_POST["poids"]);
    $yeux = htmlspecialchars($_POST["yeux"]);
    $taille = htmlspecialchars($_POST["taille"]);
    $cheveux = htmlspecialchars($_POST["cheveux"]);
    $origine = htmlspecialchars($_POST["origine"]);
    $ville = htmlspecialchars($_POST["ville"]);
    //$_FILES cette superglobal permet de recuperer limage , et le mettre dans un fichier temporaire dans l'application xampp
    $photo = $_FILES["photo"];
    $passworHash = password_hash($password, PASSWORD_DEFAULT);
    $intitule=htmlspecialchars($_POST["intitule"]);
    $religion=htmlspecialchars($_POST["religion"]);

    //traitement de l'image
    //il refupere le nom de l'image 
    $imgName = $photo['name'];
    //il recupere sont emplacement 
    $tmpName = $photo['tmp_name'];
    //var_dump($tmpName);die;
    //var_dump($_POST);
    //var_dump($photo);
    // ici on lui indique l'emplacement de l'image 
    $destination = $_SERVER["DOCUMENT_ROOT"] .
        '/aDeux/view/assets/img/' . $imgName;
        // move_uploaded_file est une fonction qui permet de  deplacer l'image d'un emplaceemnt un à un autre 
        move_uploaded_file($tmpName, $destination);
 
        //etablir la connexion avec la base de données
        
        // die('ok');
        //}
        //executer la requete
        $dbConexion = dbConexion();
        //preparer la requete
        $request = $dbConexion->prepare("INSERT INTO utilisateur (email, pseudo, password, nom, prenom, age, sex, poids, yeux, taille, cheveux, origine, ville, photo, id_confession, id_intitule) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
        try{
            $request->execute([$email, $pseudo, $passworHash, $nom, $prenom, $age, $sex, $poids, $yeux, $taille, $cheveux, $origine, $ville, $imgName, $religion , $intitule]);
            // On détruit la clé vide de la session avec unset car l'utilisateur qui s'inscrit devra apparaitre dans la liste des profils des autres utilisateurs.
            unset($_SESSION['vide']);
            //unset est une fonction qui permet de supprimer une valeur 
            header("Location: http://localhost/aDeux/view/connexion.php");

        } catch(PDOException $e) {
            echo "". $e->getMessage() ."";
        }
}
