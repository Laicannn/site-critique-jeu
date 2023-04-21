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

if (empty($_SESSION['id_jeux'])){
    $_SESSION['id_jeux']=$_GET['id_jeux'];
    closeDB($mysqli);
    header("Location: ../redige.php");
}
else{
    writeArticle($mysqli,$titre,$note,$_SESSION['id_jeux'],$_SESSION['id_user'],$contenu);
    $_SESSION['id_jeux']=[];
    $id_article=getidnewarticle($mysqli,$contenu);
    closeDB($mysqli);
    header("Location: ../article.php?id_article=$id_article");
}
?>