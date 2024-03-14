<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/aDeux/model/database.php");
require_once('action.php');

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
            //ici traitement
            if (password_verify($password, $user['password'])) {
                $_SESSION['id_user'] =  $user['id_utilisateur'];
                if(!isset($_SESSION['utilisateurs_deja_vus' . $_SESSION["id_user"]])){
                    $_SESSION['utilisateurs_deja_vus' . $_SESSION['id_user']] = array();
                }
                $_SESSION['sex'] = $user['sex'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['pseudo'] = $user['pseudo'];
                $_SESSION['taille'] = $user['taille'];
                $_SESSION['ville'] = $user['ville'];
                $_SESSION['age'] = $user['age'];
                $_SESSION['origine'] = $user['origine'];
                $_SESSION['cheveux'] = $user['cheveux'];
                $_SESSION['yeux'] = $user['yeux'];
                $_SESSION['poids'] = $user['poids'];
                $_SESSION['photo'] = $user['photo'];
                $request = $dbConexion->prepare('SELECT * FROM confession WHERE id_confession = ?');
                // fin traitement 
                try {
                    $request->execute(array($user['id_confession']));
                    $religion = $request->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['nom_religion'] = $religion['religion'];
                    
                    $request = $dbConexion->prepare('SELECT * FROM typerelation WHERE id_typeRelation = ?');
                    try {
                        $request->execute(array($user['id_intitule']));
                        $relation = $request->fetch(PDO::FETCH_ASSOC);
                        $_SESSION['intitule'] = $relation['intitule'];
                        swipeFin();
                        header("Location: http://localhost/aDeux/view/crush.php");
                        exit();
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
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
