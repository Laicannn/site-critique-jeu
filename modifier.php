<?php
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
        <link rel="stylesheet" type="text/css" href="styles/style_modify.css">
    </head>
    <body>
        <?php include("static/header.php"); ?>
        <?php include("static/nav.php"); ?>
        <main>
            <?php
                if (!empty($_GET['id_article'])){
                $info_article=getinfoarticleETjeu($mysqli,$_GET['id_article']);
                displayModifyArticle($info_article,$_GET['id_article']);
                }
                if (!empty($_GET['id_avis'])){
                $id_avis=$_GET['id_avis'];
                $info_avis=getInfoAvis($mysqli,$id_avis);
                $info_jeux=getInfoJeu($mysqli,$info_avis['id_jeux']);
                $img=imagesarticles($mysqli,$info_avis['id_jeux']);
                displayModifyAvis($info_avis,$id_avis,$info_jeux,$img);
                }
                if (isset($_SESSION['logged']) && $_SESSION['logged'] === true){
                    displayChangeAccount();
                }
                else{
                    header('Location: account.php');
                }
            ?>
        </main> 
        <?php include("static/footer.php"); ?>
    <?php closeDB($mysqli); ?>
    </body>
</html>