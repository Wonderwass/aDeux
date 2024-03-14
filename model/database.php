<?php 

function dbConexion() 
{
    //variable qui doit stocker notre instance de conexion a la base de données
    $conexionDb = null; 
    //try essaye de se connecter a la de données 
    try{
    $conexionDb = new PDO("mysql:host=localhost;dbname=site_rencontre", "root","");
    //si ces faux il releve une erreur
}   catch(PDOException $e){
   echo $conexionDb = $e;
}
//retour de l'objet de conexion ou un erreur 
return $conexionDb;
}
