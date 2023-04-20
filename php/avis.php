<?php
require_once("../includes/constantes.php");      //constantes du site
require_once("../includes/config-bdd.php");
require_once("functions-DB.php");
require_once("functions_query.php");
require_once("functions_structure.php");
$mysqli = connectionDB();
session_start();
$titre = $_POST['titre'];
$note = $_POST['note'];
$avis = $_POST['avis'];
writeAvis($mysqli,$titre,$note,$_GET['id_jeux'],$_SESSION['id_user'],$avis);
header("Location: ../article.php?id_article=$_GET[id_article]");
?>