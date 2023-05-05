<?php
require_once("../includes/constantes.php");      //constantes du site
require_once("../includes/config-bdd.php");
require_once("functions-DB.php");
require_once("functions_query.php");
require_once("functions_structure.php");
$mysqli = connectionDB();
session_start();

$id_article=$_GET['id_article'];
$info=getinfoarticleETjeu($mysqli,$id_article);

if (empty($_POST['titre'])){$titre = $info['titre'];}
else {$titre = $_POST['titre'];}

$titre=htmlspecialchars($titre, ENT_QUOTES);

if (empty($_POST['note'])){$note = $info['note'];}
else {$note = $_POST['note'];}

if (empty($_POST['article'])){$contenu = $info['contenu'];}
else {$contenu = $_POST['article'];}

$blabla=htmlspecialchars($contenu, ENT_QUOTES);

ModifyArticle($mysqli,$id_article,$titre,$blabla,$note);
closeDB($mysqli);
header("Location: ../index.php");
?>