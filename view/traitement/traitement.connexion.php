<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/aDeux/model/database.php");

if (isset($_POST["connexion"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Établir la connexion avec la base de données
    $dbConexion = dbConexion();

    // Préparer la requête pour récupérer l'utilisateur par son email
    $request = $dbConexion->prepare('SELECT * FROM utilisateur WHERE email = ?');
    try {
        $request->execute(array($email));
        $user = $request->fetch(PDO::FETCH_ASSOC);
        // Vérifier si l'utilisateur existe
        if (!empty($user)) {
            echo 'utilisateur inconnu';
            // Vérifier si le mot de passe est correct
            if (password_verify($password, $user['password'])) {
                $_SESSION['sex'] = $user['sex'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['pseudo'] = $user['pseudo'];
                $_SESSION['intitulé'] = $user['intitulé'];
                $_SESSION['religion'] = $user['religion'];
                $_SESSION['taille'] = $user['taille'];
                $_SESSION['ville'] = $user['ville'];
                $_SESSION['age'] = $user['age'];
                $_SESSION['origine'] = $user['origine'];
                $_SESSION['cheveux'] = $user['cheveux'];
                $_SESSION['yeux'] = $user['yeux'];
                $_SESSION['poids'] = $user['poids'];
                $_SESSION['photo'] = $user['photo'];

                header("Location: http://localhost/aDeux/view/profil.php");
                exit;

            } else {
                $_SESSION["error"] = "Mot de passe incorrect";
            }
        } else {
            $_SESSION["error"] = "Utilisateur inconnu";
            echo 'mdp inconnu';
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}
?>