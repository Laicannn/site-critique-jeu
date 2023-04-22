<?php
require_once("../includes/constantes.php");      //constantes du site
require_once("../includes/config-bdd.php");
require_once("functions-DB.php");
require_once("functions_query.php");
require_once("functions_structure.php");
$mysqli = connectionDB();
session_start();


if (empty($_SESSION['id_jeux']) || ($_GET)){
    $_SESSION['id_jeux']=$_GET['id_jeux'];
    $_SESSION['chemin']=$_GET['chemin'];
    echo "perdu";
    closeDB($mysqli);
    header("Location: ../redige.php");
}
else{
    $titre = $_POST['titre'];
    $note = $_POST['note'];
    $contenu = $_POST['article'];
    writeArticle($mysqli,$titre,$note,$_SESSION['id_user'],$contenu);
    $id_article=getIdNewArticle($mysqli,$contenu);
    ChangeArticle($mysqli,$id_article['id_article'],$_SESSION['id_jeux']);
    $_SESSION['id_jeux']=[];
    $_SESSION['chemin']=[];
    closeDB($mysqli);
    header("Location: ../article.php?id_article=$id_article[id_article]");
}
?>