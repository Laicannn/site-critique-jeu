<?php
echo(isset($_SESSION['logged']) && $_SESSION['logged'] === true);
session_start();
//affichage des erreurs côté PHP et côté MYSQLI
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//Import du site - A completer
require_once("includes/constantes.php");      //constantes du site
require_once("includes/config-bdd.php");
require_once("php/functions-DB.php");
require_once("php/functions_query.php");
require_once("php/functions_structure.php");
$mysqli = connectionDB();

// if (isset($_SESSION['logged']) && $_SESSION['logged'] === true){
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>MD trikite</title>
        <link rel="icon" href="images/logos/logo_head.png" />
        <meta name="keywords" content="MD TRIKITE"/>
        <meta name="author" content="La MD Corp"/>
        <link rel="stylesheet" type="text/css" href="styles/style_index.css">
    </head>
    <body>
        <?php include("static/header.php"); ?>
        <?php include("static/nav.php"); ?>
        <main>
            <?php 
                if($_GET){
                    if(isset($_GET['search'])){
                        $liste = getIndedexSearch($mysqli,$_GET['search']);
                    }
                    elseif(isset($_GET['categorie'])){
                        $liste = getIndexCateg($mysqli,$_GET['categorie']);
                    }
                    elseif(isset($_GET['support'])){
                        $liste = getIndexSupp($mysqli,$_GET['support']);
                    }
                    else {
                        echo"<h1> Aucun résultat </h1>";
                    }
                }
                else {
                    $liste = getIndexArticle($mysqli);
                }
                if($liste){
                    $nombre_article = count($liste,0);
                    $nombre_page = $nombre_article / 5 ;
                    foreach($liste as $article){
                        $categories = getCategorie($mysqli,$article['id_jeux']);
                        $supports = getSupport($mysqli,$article['id_jeux']);
                        displayJaquette($article,$supports,$categories);
                    }
                }
                else {
                    echo"<h1> Aucun résultat </h1>";
                }
                if (isset($_SESSION['role']) && ($_SESSION['role'] == 'administrateur' || $_SESSION['role'] == 'redacteur')){
                    echo"<a href='redige.php' id='button_redige'><img src='images/buttons/button_redige.svg'></a>";
                }
            ?>
        </main> 
        <?php include("static/footer.php"); ?>
    <?php closeDB($mysqli); ?>
    </body>
</html>