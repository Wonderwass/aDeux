<?php

function dbConnexion(){
    $connexion = null;
    try{
        $connexion = new PDO("mysql:host=localhost;dbname=id21228714_site_rencontre", "id21228714_root", "");
    }catch(PDOException $e){
        $connexion = $e->getMessage();
    }
    return $connexion;
}