<?php include_once($_SERVER['DOCUMENT_ROOT'].'/adeux/view/traitement/action.php') ; 
//$_SERVER['DOCUMENT_ROOT']envoie le répertoire racine du serveur web, est rajouter le chemin du fichier à inclure.
$confession = confess(); 
$typeRelation = relation(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="./assets/CSS/style.css">
    <script src="https://kit.fontawesome.com/c2e186b2d4.js" crossorigin="anonymous"></script>
    <script src="http://localhost/aDeux/js.js" defer></script>
    <title>Document</title>
   
</head>
<body class="pink">

<a href="index.php">
<i class="fa-solid fa-circle-arrow-left" id="fleche"></i>
</a>

<div class="logo"><img src="./view/assets/img/adeuximg.png" alt=""></div> 

<div class="container">

<form action="./traitement/traitement.inscription.php" method="POST" enctype="multipart/form-data" id="form" >

<div class="cubemail">
    <div class="margin">

<p id="textmail"class="textmail">Quelle est votre adresse e-mail ?</p>        
<input class="champs" name="email"type="email" placeholder="Email" id="email" value="">

<p id="textmdp">Saisis ton mot de passe!</p>
<input class="champs"  type="password" name="password"placeholder="Mot de passe" id="password" value="">

<p id="txtnom1">Quel est ton nom?</p>
<input class="champs" type="text" name="nom" placeholder="nom" id="txtnom" value="">

<p id="txtprenom1">Quel est ton prenom?</p>
<input class="champs" type="text" name="prenom"placeholder="Prenom"id="prenom" value="">

<p id="txtpseudo">Choisis un pseudo?</p>
<input type="text" class="champs" name="pseudo" placeholder="Pseudo" id="pseudo" value="">

<p id="txtage">Quel est ton age ?</p>
<input type="number" class="champs" name="age" id="age" placeholder="age" value="">

<p id="txtsex">Vous etes?</p>
<select class="champs"name="sex" id="sex" placeholder="sex">
    <option value="Homme">Homme</option>
    <option value="Femme">Femme</option>
</select>

<p id="txtpoids">Indique ton poids</p>
<input type="text" class="champs" name="poids" id="poids" placeholder="70" value="">

<p id="txtyeux">Quelle est la couleur de tes yeux?</p>
<select  type="text" id="yeux" class="champs" name="yeux">
    <option value="noisette">Noisette</option>
    <option value="vert">Vert</option>
    <option value="noir">Noir</option>
    <option value="bleu">Bleu</option>

</select>

<p id="txttaille">Quelle est ta taille?</p>
<input type="text" id="taille" class="champs" name="taille"  placeholder="1m70" value="1">

<p id="txtcheveux">Selectionne ta couleur de cheveux</p>
<select type="text" id="cheveux" class="champs" name="cheveux" placeholder="brune">
    <option value="brun">brun(e)</option>
    <option value="blond">blond(e)</option>
    <option value="roux">roux</option>
</select>

<p id="txtorigine">Ton origine?</p>
<input type="text" id="origine" class="champs" name="origine" placeholder="Marocain" value="">

<p id="txtville">De quelle ville es tu ?</p>
<input type="text" id="ville" class="champs" name="ville" placeholder="Paris" value="">

<p id="txtrelation">Quel type de relation recherches-tu?</p>
<!--<input type="text" id="relation" class="champs" name="intitule" placeholder="Du sérieux" value="">-->
<select type="text" id="relation" class="champs" name="intitule" placeholder="Du sérieux">
<?php foreach($typeRelation as $intitule){ ?>
        <!-- pour chaque elément dans confession il crée une balise option jusqu'au dernier élément -->
        <option value="<?= $intitule['id_typeRelation'] ?>"><?= $intitule['intitule'] ?></option>
 <?php } ?>

</select>


<p id="txtreligion">De quelle confession es-tu?</p>
<!--<input type="text" id="religion" class="champs" name="religion" placeholder="religion" value="">-->
<select name="religion" id="religion" class="champs">
    <?php foreach($confession as $religion){ ?>
        <!-- pour chaque elément dans confession il crée une balise option jusqu'au dernier élément -->
        <option value="<?= $religion['id_confession'] ?>"><?= $religion['religion'] ?></option>
    <?php } ?>
</select>

<p id="txtimg">Télécharger une photo de profil :</p>
<input type="file" name="photo" id="photo" class="champs" placeholder="T'as photo">


<button class="jecontinue1" type="submit" value="submit" id="submit" name="inscription">Je continue</button>
</div>
</div>
</form>

</div>
</body>
</html>

