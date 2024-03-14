<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/aDeux/model/database.php");
//unset($_SESSION['utilisateurs_deja_vus']);

function confess()
{
    $db = dbConexion();
    // ICI On le recupere 
    $request = $db->prepare("SELECT * FROM confession");
    try {
        $request->execute();
        $confession = $request->fetchAll(PDO::FETCH_ASSOC);
        return $confession;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function relation()
{
    $db = dbConexion();
    $request = $db->prepare("SELECT * FROM typerelation");
    try {
        $request->execute();
        $relation = $request->fetchAll(PDO::FETCH_ASSOC);
        return $relation;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function aleatUser()
{
    $db = dbConexion();
    $id_user = $_SESSION['id_user'];

    if (!in_array($id_user, $_SESSION['utilisateurs_deja_vus' . $_SESSION['id_user']])) {
        // L'utilisateur n'a pas été vu, faites quelque chose...
        // Ajoutez l'utilisateur à la liste des utilisateurs déjà vus
        $_SESSION['utilisateurs_deja_vus' . $_SESSION['id_user']][] = $id_user;
    }

    $utilisateurs_deja_vus = implode(",", $_SESSION['utilisateurs_deja_vus' . $_SESSION['id_user']]);
    $request = $db->prepare("SELECT utilisateur.*, confession.religion AS religion, typerelation.intitule AS relation
    FROM utilisateur
    JOIN confession ON utilisateur.id_confession = confession.id_confession
    JOIN typerelation ON utilisateur.id_intitule = typerelation.id_typeRelation
    WHERE utilisateur.id_utilisateur NOT IN ($utilisateurs_deja_vus)
    ORDER BY RAND() LIMIT 1");
    try {
        $request->execute();
        $aleatUser = $request->fetch(PDO::FETCH_ASSOC);
        $request = $db->prepare('SELECT id_user_cible from crush');
        return $aleatUser;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


function swipeFin()
{
    $db = dbConexion();

    $totalUserBdd = $db->prepare('SELECT COUNT(*) as total FROM utilisateur WHERE id_utilisateur != ?');
    $totalUserBdd->execute([$_SESSION['id_user']]);
    $totalUserBddrecupere = $totalUserBdd->fetch(PDO::FETCH_ASSOC);
    $totalUsers = $totalUserBddrecupere['total'];

    // Récupérer le nombre d'utilisateurs déjà vus
    $utilisateursDejaVus = count($_SESSION['utilisateurs_deja_vus' . $_SESSION['id_user']]);

    if ($utilisateursDejaVus >= $totalUsers) {
        $pleine = "Vous avez vu tous les profils disponibles";
        $_SESSION['pleine_' . $_SESSION['id_user']][] = $pleine;
        $response = ['vide' => $pleine];

        if (isset($_SESSION['profil_disponible_' . $_SESSION['id_user']])) {
            unset($_SESSION['profil_disponible_' . $_SESSION['id_user']]);
        }
        echo json_encode($response);
    } else {
        $aleatUser = aleatUser();
        $_SESSION['profil_disponible_' . $_SESSION['id_user']][] = true;
        $response = ['aleatUser' => $aleatUser];
        unset($_SESSION['pleine_' . $_SESSION['id_user']]);
        echo json_encode($response);
    }
}

// Pour ajouter dans la base de donées, les utilisteur vu .

function conversations($user_cible)
{
    $db = dbConexion();

    $request = $db->prepare('
    SELECT conversation.*, utilisateur.* 
    FROM conversation
    LEFT JOIN utilisateur ON conversation.id_user = utilisateur.id_utilisateur
    WHERE (conversation.id_user = ? AND conversation.id_crush = ?)
    OR (conversation.id_user = ? AND conversation.id_crush = ?)
');

    try {
        $user_connected = $_SESSION['id_user'];
        $request->execute([$user_connected, $user_cible, $user_cible, $user_connected]);
        $conversations = $request->fetchAll(PDO::FETCH_ASSOC);

        foreach ($conversations as &$conv) {
            $conv['css'] = $conv['id_user'] == $user_connected ? 'right' : 'left';
        }

        return $conversations;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return [];
    }
}

// On récupere tous les utilisateurs avec le statut Crush : 

function crushLiked()
{
    $connected = $_SESSION['id_user'];

    $db = dbConexion();
    $request = $db->prepare('SELECT id_user_cible FROM crush where  id_user = ? AND statut = "crush" ');

    try {
        $request->execute([$connected]);
        $usersCrush = $request->fetchAll(PDO::FETCH_COLUMN);
        return $usersCrush;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
