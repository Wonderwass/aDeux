<?php
// A mettre avant le html c'est pour démarer la session
session_start();
?>
<?php include_once "inc/header.php"?>
<body class="fond">
    <div>
    <button onclick="window.location.href='connexion.php'"class="connecter" type="button">Se connecter</button>
    </div>
    <div>
    <button onclick="window.location.href='inscription.php'"class="inscription" type="button">Inscription</button>
    </div>
</body>
<?php include_once "inc/footer.php"?>


