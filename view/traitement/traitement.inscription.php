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
    $passworHash=password_hash($password, PASSWORD_DEFAULT);

    //etablir la connexion avec la base de données
    $dbConexion = dbConexion();
    //preparer la requete
    $request = $dbConexion->prepare("INSERT INTO utilisateur (email, pseudo, password,nom, prenom, age, sex, poids, yeux, taille, cheveux, origine, ville) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?, ?)");
    //executer la requete
    try{
        $request->execute(array($email, $pseudo, $passworHash, $nom, $prenom, $age, $sex, $poids, $yeux, $taille, $cheveux, $origine, $ville));
                // Redirection vers index.php après l'inscription réussie
                header("Location: index.php");
                exit; // Assure que le script s'arrête après la redirection
        
    }catch(PDOException $e){
        echo "Erreur SQL: " . $e->getMessage();
    }

}
