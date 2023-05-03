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
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8"/>
        <title>MD trikite</title>
        <link rel="icon" href="images/logos/logo_head.png" />
        <meta name="keywords" content="MD TRIKITE"/>
        <meta name="author" content="La MD Corp"/>
        <link rel="stylesheet" type="text/css" href="styles/style_account.css">
    </head>
    <body>
        <?php include("static/header.php"); ?>
        <?php include("static/nav.php"); ?>
        <main>
            <?php 
            if (isset($_SESSION['logged']) && $_SESSION['logged'] === true && (!($_GET) || !(isset($_GET['account']) && $_GET) || (isset($_GET['account']) && $_GET['account'] == $_SESSION['id_user'] ))){
                $liste = getAllPP($mysqli);
                displaySelfAccount($liste);

                $liste_article=getArticleAccount($mysqli,$_SESSION['id_user']);
                displayArticleAccount($liste_article);
                
                $liste_avis = getAvisofUser($mysqli,$_SESSION['id_user']);
                displayAvisAccount($liste_avis,$_SESSION['pp']);
            }
            else{
                $id_user=$_GET['account'];
                $info_member=getInfoMember($mysqli,$id_user);
                $pp=getPP($mysqli,$info_member['id_image']);
                $role=['administrateur','redacteur','membre'];
                displayPublicAccount($info_member,$pp[0],$role);

                $liste_article=getArticleAccount($mysqli,$id_user);
                displayArticleAccount($liste_article);
                
                $liste_avis = getAvisofUser($mysqli,$id_user);
                displayAvisAccount($liste_avis,$pp[0]['chemin']);
            }
            ?>
        </main> 
        <?php include("static/footer.php"); ?>
    <?php closeDB($mysqli); ?>
    </body>
</html>