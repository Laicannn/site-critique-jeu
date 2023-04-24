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
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>MD trikite</title>
        <link rel="icon" href="images/logos/logo_head.png" />
        <meta name="keywords" content="MD TRIKITE"/>
        <meta name="author" content="La MD Corp"/>
        <link rel="stylesheet" type="text/css" href="styles/style_article.css">
    </head>
    <body>
        <?php include("static/header.php"); ?>
        <?php include("static/nav.php"); ?>
        <main>
            <?php 
                $info=getinfoarticleETjeu($mysqli,$_GET['id_article']);
                $img=imagesarticles($mysqli,$info['id_jeux']);
                $categorie=getCategorie($mysqli,$info['id_jeux']);
                $support=getSupport($mysqli,$info['id_jeux']);
                $avis=getAvis($mysqli,$info['id_jeux']);
                displayArticle($info,$img,$categorie,$support,$avis,$_GET['id_article']);
                foreach($avis as $avions){
                    $pp=getPP($mysqli,$avions['id_image']);
                    displayAvis($avions,$pp['0'],$info['id_jeux']);
                }
                if ((isset($_SESSION['role']) && (empty(getAvisAndUser($mysqli,$_SESSION['id_user'],$info['id_jeux']))))){
                    displayDonneAvis($info['id_jeux']);
                }          
                if ($_SESSION && !empty(getWriterArticle($mysqli,$_SESSION['id_user'],$info['id_jeux']))){
                    echo"<a href='modifier.php?id_article=$_GET[id_article]' id='button_modification'><img src='images/buttons/button_modifier.svg'></a>";
                }      
            ?>
        </main> 
        <?php include("static/footer.php"); ?>
    <?php closeDB($mysqli); ?>
    </body>
</html>