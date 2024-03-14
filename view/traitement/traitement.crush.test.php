<?php 
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . "/aDeux/model/database.php");
include_once("action.php");
const HTTP_OK = 200;
const HTTP_BAD_REQUEST = 400; 
const HTTP_METHOD_NOT_ALLOWED = 405;

    // Récupérer les données envoyées via la requête AJAX
    //Utilisateur actuelpour utilisateur connecté si il n'es pas connecté il me met la valeur en null 
    $idUtilisateurActuel = isset($_SESSION["id_user"]) ? $_SESSION["id_user"] : null;
    //Pour l'utilisateur liké
    $idUtilisateurCible = isset($_GET['id_cible']) ? $_GET['id_cible'] : null;

        //echo "ok1 <br>";

    $db = dbConexion();
    

    $request = $db->prepare('INSERT INTO crush (id_user, id_user_cible, statut) VALUES(?,?,?)');
    
    try {
        $request->execute(array($idUtilisateurActuel, $idUtilisateurCible, 'En Attente'));
        //echo "ok2 <br>";
        //echo "ok3 <br>";
        $request = $db->prepare('SELECT * FROM crush WHERE (id_user = ? AND id_user_cible = ?) AND (id_user = ? AND id_user_cible = ?)');
            $request->execute([$idUtilisateurActuel, $idUtilisateurCible, $idUtilisateurCible, $idUtilisateurActuel]);  
            $crush = $request->fetchAll(PDO::FETCH_ASSOC);
            var_dump($crush);

            if($crush){
                $request = $db->prepare('UPDATE crush SET statut = "Crush" WHERE (id_user = ? AND id_user_cible = ?) OR (id_user = ? AND id_user_cible = ?)');
                $request->execute(array($idUtilisateurActuel,$idUtilisateurCible, $idUtilisateurCible, $idUtilisateurActuel));
            }
    } catch (Exception $e) {
        echo $e->getMessage();
    }      
    //die("ok final");
    // cettte ligne permet de charger les valeur  ( envoyer a javascript)
                $aleatUser = aleatUser();
                $response_code = HTTP_OK;
                    $responseTab = [
                    "response_code" => HTTP_OK,
                    "aleatuser"=> $aleatUser,      
                ];
        json_encode($responseTab);

if($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] == "recal"){

    $db = dbConexion();
//il cherche dans la base de donnée
// il ajoute la ligne statut 
            $request = $db->prepare('INSERT INTO crush (id_user, id_recal, statut) VALUES(?,?,"Recal")');
            try {
                $request->execute(array($idUtilisateurActuel,$idUtilisateurCible));
                $aleatUser= aleatUser();
                $response_code = HTTP_OK;
                    $responseTab = [
                    "response_code" => HTTP_OK,
                    "aleatuser"=> $aleatUser,      
                ];
        reponse($response_code, $responseTab);
            } catch (Exception $e) {
                echo $e->getMessage();
            }  
    // cettte ligne permet de charger les valeur (pou envoyer a javascript)

}else {
    // Si la méthode n'est pas POST, retournez une réponse d'erreur par exemple
    echo "Erreur : Méthode non autorisée.";
}
function reponse($response_code, $response){
    header('Content-Type: application/json');
    http_response_code($response_code);
    echo json_encode($response);

}

?>