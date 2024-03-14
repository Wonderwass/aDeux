<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/aDeux/model/database.php");

function crush()
{
    $dbConexion = dbConexion();

    $idUtilisateurActuel = $_SESSION['id_user'];

    $query = "SELECT u.*, c.*
    FROM utilisateur u
    JOIN crush c ON u.id_utilisateur = c.id_user_cible
    WHERE c.id_user = ? AND c.statut = 'Crush'";


    try {
        $request = $dbConexion->prepare($query);
        $request->execute([$idUtilisateurActuel]);
        $crush = $request->fetchAll(PDO::FETCH_ASSOC);

        return $crush;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

function profilCrushConv($id_cible)
{
    $dbConexion = dbConexion();

    $query = "SELECT * FROM utilisateur WHERE id_utilisateur = ?";


    try {
        $request = $dbConexion->prepare($query);
        $request->execute([$id_cible]);
        $profilCrush = $request->fetch(PDO::FETCH_ASSOC);

        return $profilCrush;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
