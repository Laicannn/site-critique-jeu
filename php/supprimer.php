<?php
require_once("../includes/constantes.php");      //constantes du site
require_once("../includes/config-bdd.php");
require_once("functions-DB.php");
require_once("functions_query.php");
require_once("functions_structure.php");
$mysqli = connectionDB();
session_start();

if (!empty($_GET['id_avis'])){
$id_avis=$_GET['id_avis'];
$info=getInfoAvis($mysqli,$id_avis);
$id_article=$info['id_article'];
deleteAvis($mysqli,$id_avis);
}

if (!empty($_GET['id_article'])){
$id_article=$_GET['id_article'];
$id_jeux=getIdJeux($mysqli,$id_article);
$avis=getAvis($mysqli,$id_jeux);
foreach($avis as $av){
    deleteAvis($mysqli,$av['id_avis']);
}
deleteArticle($mysqli,$id_article);
}
closeDB($mysqli);
header("Location: ../index.php");
?>