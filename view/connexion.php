
<?php include_once "inc/header.php"?>
<body class="pink">
<a href="index.php">
<i class="fa-solid fa-circle-arrow-left" id="fleche"></i>
</a>
<div class="logo"></div> 

<div class="cubconnexion">
<form action="traitement/traitement.connexion.php" method="post">
<input type="text" id="" name="" class="champsC" placeholder="E-mail">
<input type="password" id="" name="" class="champsC" placeholder="Mot de passe">

<button class="jecontinue" type="submit" value="submit" name="connexion" id="submit">connexion</button>
 </form>  
</div>
 
</body>

<?php include_once "inc/footer.php"?>