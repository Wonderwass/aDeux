<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/aDeux/model/database.php");


function conversationsNonLues()
{
    if (isset($_GET['idCible'])) {
        $idLiked = $_SESSION['id_user'];
        $db = dbConexion();

        $request = $db->prepare(
            '
        SELECT conversation.*, utilisateur.*, crush.*, COUNT(*) AS count_notifications
        FROM conversation
        JOIN utilisateur ON conversation.id_user = utilisateur.id_utilisateur
        LEFT JOIN crush ON conversation.id_user = crush.id_user AND conversation.id_crush = crush.id_user_cible
        WHERE conversation.statut="non_vu" AND conversation.id_crush = ?
        GROUP BY conversation.id_message, utilisateur.id_utilisateur, crush.id_user_cible LIMIT 1
        '
        );
        try {
            $request->execute([$idLiked]);
            $userNotif = $request->fetchAll(PDO::FETCH_ASSOC);
            return $userNotif;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

function notifCrush($id_user)
{
    $db = dbConexion();

    $request = $db->prepare('SELECT * FROM crush JOIN utilisateur ON crush.id_user = utilisateur.id_utilisateur WHERE id_user_cible = ? AND statut="crush"');
    try {
        $request->execute([$id_user]);

        $crush = $request->fetchAll(PDO::FETCH_ASSOC);
        return $crush;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


if (isset($_GET['notifs']) && isset($_GET['id'])) {
    $idCible = $_GET['id'];
    $notifLue = $_GET['notifs'];
    $idUtilisateurActuel = $_SESSION['id_user'];

    $db = dbConexion();
    $request = $db->prepare('UPDATE conversation SET statut = \'vu\' WHERE (id_user = ? AND id_crush = ?) OR (id_user = ? AND id_crush = ?)');

    try {
        $request->execute([$idUtilisateurActuel, $idCible, $idCible, $idUtilisateurActuel]);
        header('Location: http://localhost/aDeux/view/conversation.php?id=' . $idCible);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
