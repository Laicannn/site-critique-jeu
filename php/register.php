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
$age=$_POST['age'];
$mail=$_POST['mail'];
$mdp=$_POST['mdp'];


?>