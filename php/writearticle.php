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
$contenu = $_POST['article'];
$id_jeux=$_POST['id_jeux'];
writeArticle($mysqli,$titre,$note,$id_jeux,$_SESSION['id_user'],$contenu);
closeDB($mysqli);
header("Location: ../article.php?id_article=$_GET[id_article]");
?>