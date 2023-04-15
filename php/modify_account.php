<?php
require_once("../includes/constantes.php");      //constantes du site
require_once("../includes/config-bdd.php");
require_once("functions-DB.php");
require_once("functions_query.php");
require_once("functions_structure.php");
session_start();
$mysqli = connectionDB();
$new_pp = $_GET['id_image'];
changeProfile($mysqli,$new_pp,$_SESSION['id_user']);
$PP = getPP($mysqli,$new_pp);
$_SESSION['pp'] = ($PP[0]['chemin']);
header('Location: ../account.php#popup');


closeDB($mysqli);
?>