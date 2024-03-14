<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/aDeux/model/database.php");
include_once("action.php");
const HTTP_OK = 200;
const HTTP_BAD_REQUEST = 400;
const HTTP_METHOD_NOT_ALLOWED = 405;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === "like") {
    $db = dbConexion();
    $idUtilisateurActuel = isset($_SESSION["id_user"]) ? $_SESSION["id_user"] : null;
    $idUtilisateurCible = isset($_POST['idUtilisateurCible']) ? $_POST['idUtilisateurCible'] : null;

    try {
        // Insertion dans la table crush
        $request = $db->prepare('INSERT INTO crush (id_user, id_user_cible, statut) VALUES(?,?,?)');
        $request->execute(array($idUtilisateurActuel, $idUtilisateurCible, 'En Attente'));

        // Vérifier si une correspondance existe
        $request = $db->prepare('
            SELECT * FROM crush
            WHERE 
                (id_user = ? AND id_user_cible = ? AND statut = "En Attente") 
                AND 
                EXISTS (
                    SELECT * FROM crush 
                    WHERE id_user = ? AND id_user_cible = ? AND statut = "En Attente"
                )
        ');
        $request->execute([$idUtilisateurActuel, $idUtilisateurCible, $idUtilisateurCible, $idUtilisateurActuel]);
        $crush = $request->fetchAll(PDO::FETCH_ASSOC);
        if ($crush) {
            // Mise à jour du statut en "Crush"
            $request = $db->prepare('UPDATE crush SET statut = "Crush" WHERE (id_user = ? AND id_user_cible = ?) OR (id_user = ? AND id_user_cible = ?)');
            $request->execute(array($idUtilisateurActuel, $idUtilisateurCible, $idUtilisateurCible, $idUtilisateurActuel));
            $_SESSION['utilisateurs_deja_vus' . $_SESSION['id_user']][] = $idUtilisateurCible;
            // Obtenir un nouvel utilisateur aléatoire
            echo swipeFin();
        } else {
            $_SESSION['utilisateurs_deja_vus' . $_SESSION['id_user']][] = $idUtilisateurCible;
            // Obtenir un nouvel utilisateur aléatoire
            echo swipeFin();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == "recal") {
    // Gestion de l'action "recal"
    $idUtilisateurActuel = isset($_SESSION["id_user"]) ? $_SESSION["id_user"] : null;
    $idUtilisateurCible = isset($_POST['idUtilisateurCible']) ? $_POST['idUtilisateurCible'] : null;
    // if isset($POST){
    //bkabka
    //} else {
    // blbal
    //}
    $db = dbConexion();

    try {
        // Insertion dans la table crush avec le statut "Recal"
        $request = $db->prepare('INSERT INTO crush (id_user, id_user_cible, statut) VALUES(?,?,?)');
        $request->execute(array($idUtilisateurActuel, $idUtilisateurCible, 'Recal'));
        // Vous pouvez ajouter d'autres actions ici si nécessaire
        $_SESSION['utilisateurs_deja_vus' . $_SESSION['id_user']][] = $idUtilisateurCible;
        echo swipeFin();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} else {
    // Si la méthode n'est pas POST, retournez une réponse d'erreur
    echo "Erreur : Méthode non autorisée.";
}
