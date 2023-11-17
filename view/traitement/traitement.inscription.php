<?php
session_start();
require_once("../../model/database.php");
 
if (isset($_POST["inscription"])) {
    //recuperer les info saisies par le user
 
    // Récupérer les informations saisies par l'utilisateur
    $email = htmlspecialchars($_POST["email"]);
    $pseudo = htmlspecialchars($_POST["pseudo"]);
    $password = htmlspecialchars($_POST["password"]);
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom =htmlspecialchars( $_POST["prenom"]);
    $sex = htmlspecialchars($_POST["sex"]);
    $age = htmlspecialchars($_POST["age"]);
    $poids = htmlspecialchars($_POST["poids"]);
    $yeux = htmlspecialchars($_POST["yeux"]);
    $taille =htmlspecialchars( $_POST["taille"]);
    $cheveux = htmlspecialchars($_POST["cheveux"]);
    $origine = htmlspecialchars($_POST["origine"]);
    $ville = htmlspecialchars($_POST["ville"]);
    $photo = $_FILES["photo"];
    $passworHash=password_hash($password, PASSWORD_DEFAULT);
    //traitement de l'image
    $imgName = $photo['name'];
    $tmpName = $photo['tmp_name'];

    $destination = $_SERVER["DOCUMENT_ROOT"] .
        '/aDeux/view/assets/img/' . $imgName;
    if (move_uploaded_file($tmpName, $destination)) {
        //etablir la connexion avec la base de données
        $dbConexion = dbConexion();
        //preparer la requete
        $request = $dbConexion->prepare("INSERT INTO utilisateur (email, pseudo, password, nom, prenom, age, sex, poids, yeux, taille, cheveux, origine, ville, photo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    }
    //executer la requete
    try{
        $request->execute([$email, $pseudo, $passworHash, $nom, $prenom, $age, $sex, $poids, $yeux, $taille, $cheveux, $origine, $ville, $imgName]);
                // Redirection vers index.php après l'inscription réussie
                header("Location: http://localhost/aDeux/view/connexion.php");
                exit; // Assure que le script s'arrête après la redirection
        
    }catch(PDOException $e){
        echo "Erreur SQL: " . $e->getMessage();
    }
 
}
 
