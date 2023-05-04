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
        <link rel="stylesheet" type="text/css" href="styles/style_connect.css">
    </head>
    <body>
        <?php include("static/header.php"); ?>
        <?php include("static/nav.php"); ?>
        <main>
            <?php 
            if (isset($_SESSION['logged']) && $_SESSION['logged'] === true){
                header('Location: ../index.php');
            }
            else{
                displayConnect();
            }
            ?>
        </main> 
        <?php include("static/footer.php"); ?>
    <?php closeDB($mysqli); ?>
    </body>
</html>