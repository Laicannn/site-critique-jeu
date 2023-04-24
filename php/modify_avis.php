<?php
require_once("../includes/constantes.php");      //constantes du site
require_once("../includes/config-bdd.php");
require_once("functions-DB.php");
require_once("functions_query.php");
require_once("functions_structure.php");
$mysqli = connectionDB();
session_start();

$id_avis=$_GET['id_avis'];
$info=getInfoAvis($mysqli,$id_avis);
$id_article=$info['id_article'];

if (empty($_POST['titre']))
{$titre = $info['titre'];}
else {$titre = $_POST['titre'];}

$titre=htmlspecialchars($titre, ENT_QUOTES);

if (empty($_POST['note']))
{$note = $info['note'];}
else {$note = $_POST['note'];}

if (empty($_POST['avis']))
{$texte = $info['texte'];}
else {$texte = $_POST['avis'];}

$blabla=htmlspecialchars($texte, ENT_QUOTES);

ModifyAvis($mysqli,$id_avis,$titre,$blabla,$note);
closeDB($mysqli);
header("Location: ../article.php?id_article=$id_article");
?>