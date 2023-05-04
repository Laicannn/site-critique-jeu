<?php
require_once("../includes/constantes.php");      //constantes du site
require_once("../includes/config-bdd.php");
require_once("functions-DB.php");
require_once("functions_query.php");
require_once("functions_structure.php");
$mysqli = connectionDB();
session_start();

AddJeu($mysqli,$_POST['nom'],$_POST['prix'],$_POST['date_sortie'],$_POST['synopsis']);
$id_jeux=getIdJeuxAvecNom($mysqli,$_POST['nom']);

$emplacement_jaquette='images/jaquette/'.basename($_FILES['jaquette']['name']);
header("Location: ../redige.php?id_jeux=$id_jeux&chemin=$emplacement_jaquette");
move_uploaded_file($_FILES['jaquette']['tmp_name'],$emplacement_jaquette);
AddImage($mysqli,$emplacement_jaquette,$id_jeux);

$categories = array();
if(isset($_POST['RPG'])){$categories[]='1';}
if(isset($_POST['Openworld'])){$categories[]='2';}
if(isset($_POST['Aventure'])){$categories[]='3';}
if(isset($_POST['Sandbox'])){$categories[]='4';}
if(isset($_POST['Narratif'])){$categories[]='5';}
if(isset($_POST['Puzzle'])){$categories[]='6';}
if(isset($_POST['Action'])){$categories[]='7';}

$supports = array();
if(isset($_POST['XBOX360'])){$supports[]='1';}
if(isset($_POST['XBOXone'])){$supports[]='2';}
if(isset($_POST['PS1'])){$supports[]='3';}
if(isset($_POST['Switch'])){$supports[]='4';}
if(isset($_POST['Ordinateur'])){$supports[]='5';}
if(isset($_POST['PS2'])){$supports[]='6';}
if(isset($_POST['PS3'])){$supports[]='7';}
if(isset($_POST['PS4'])){$supports[]='8';}
if(isset($_POST['PS5'])){$supports[]='9';}

print_r($categories);

foreach($categories as $id_categ){
    AttributeCategories($mysqli,$id_jeux,$id_categ);
}

foreach($supports as $id_support){
    AttributeSupports($mysqli,$id_jeux,$id_support);
}

closeDB($mysqli);

?>