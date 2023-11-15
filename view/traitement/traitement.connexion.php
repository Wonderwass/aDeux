<?php 
session_start();
var_dump($_POST);die("ok");
if (isset($_POST["connexion"])) {
    die("ok");
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Établir la connexion avec la base de données
    $dbConexion = dbConexion();

    // Préparer la requête pour récupérer l'utilisateur par son email
    $request = $dbConexion->prepare('SELECT * FROM utilisateur WHERE email = ?');
    var_dump($user);die;
    try {
        $request->execute(array($email));
        $user = $request->fetch(PDO::FETCH_ASSOC);
var_dump($user);die;
        // Vérifier si l'utilisateur existe
        if (!empty($user)) {
            // Vérifier si le mot de passe est correct
            if (password_verify($password, $user['password'])) {
                // Mot de passe correct, vous pouvez rediriger vers la page d'accueil ou effectuer d'autres actions
                // Exemple de redirection vers la page d'accueil :
                header("Location: index.php");
                exit();  // Assurez-vous de terminer le script après la redirection
            } else {
                $_SESSION["error"] = "Mot de passe incorrect";
            }
        } else {
            $_SESSION["error"] = "Utilisateur inconnu";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        
        // Rediriger vers la page d'accueil en cas d'erreur
        header("Location: index.php");
        exit();
    }
    ?>

}