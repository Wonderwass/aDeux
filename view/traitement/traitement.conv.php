<?php
session_start();
require_once('../../model/database.php');
if (isset($_POST['inputMessage']) && isset($_POST['idCrush'])) {
    $message = $_POST['inputMessage'];
    $idCrush = $_POST['idCrush'];
    $id_user = $_SESSION["id_user"];

    $db = dbConexion();

    $request = $db->prepare('INSERT INTO conversation (message,date_message,id_user,id_crush) VALUES (?,NOW(),?,?)');

    try {
        $request->execute([$message, $id_user, $idCrush]);
        echo json_encode(['inputMessage' => $message]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function getNewMessages($lastMessageId, $idCible) {
    $db = dbConexion();

    $request = $db->prepare('SELECT * FROM conversation WHERE id > ? AND (id_user = ? AND id_crush = ?) OR (id_cible = ? AND id_crush = ?)');

    try {
        $request->execute([$lastMessageId, $_SESSION['id_user'], $idCible, $idCible, $_SESSION['id_user']]);
        $newMessages = $request->fetchAll(PDO::FETCH_ASSOC);

        return $newMessages;
    } catch (PDOException $e) {
        return [];
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'getNewMessages') {
    $lastMessageId = $_GET['lastMessageId'];
    $idCible = $_GET['idCible'];

    $newMessages = getNewMessages($lastMessageId, $idCible);

    // Retourne les nouveaux messages en format JSON
    echo json_encode($newMessages);
}
