<?php
require_once("../includes/constantes.php");      //constantes du site
require_once("../includes/config-bdd.php");
require_once("functions-DB.php");
require_once("functions_query.php");
require_once("functions_structure.php");
$mysqli = connectionDB();
session_start();

$titre = $_POST['titre'];
$titre=htmlspecialchars($titre, ENT_QUOTES);
$note = $_POST['note'];
$contenu = $_POST['article'];
$contenu=htmlspecialchars($contenu, ENT_QUOTES);

writeArticle($mysqli,$titre,$note,$_SESSION['id_user'],$contenu);
$id_article=getIdNewArticle($mysqli,$contenu);
ChangeArticle($mysqli,$id_article['id_article'],$_GET['id_jeux']);
closeDB($mysqli);
header("Location: ../index.php");

?>