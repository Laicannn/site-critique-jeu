<?php
require_once("../includes/constantes.php");      //constantes du site
require_once("../includes/config-bdd.php");
require_once("functions-DB.php");
require_once("functions_query.php");
require_once("functions_structure.php");
$mysqli = connectionDB();
$user=$_POST['pseudo'];
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$mail=$_POST['mail'];
$mdp=$_POST['mdp'];

$birthday = $_POST['age'];
$currentDate = new DateTime();
$birthdate = new DateTime($birthday);
$interval = $birthdate->diff($currentDate);
$age = $interval->y;

if (empty(loginunique($mysqli,$user)) && ($age > 15)){
    creation_compte($mysqli,$user,$mdp,$nom,$prenom,$mail,$birthday);
}
else{
    echo "Tu n'a pas 15 ans";
}
?>