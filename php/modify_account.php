<?php
require_once("../includes/constantes.php");      //constantes du site
require_once("../includes/config-bdd.php");
require_once("functions-DB.php");
require_once("functions_query.php");
require_once("functions_structure.php");
session_start();
$mysqli = connectionDB();

if (!empty($_GET['id_image'])){
    $new_pp = $_GET['id_image'];
    changeProfile($mysqli,$new_pp,$_SESSION['id_user']);
    $PP = getPP($mysqli,$new_pp);
    $_SESSION['pp'] = ($PP[0]['chemin']);
}
if (!empty($_POST)){
    $info_connect = getUser($mysqli,$_SESSION['id_user']);
    $info_modifier = $_POST;
    if (empty($info_modifier['mdp'])){
        $info_modifier['mdp']=$info_connect['mdp'];
    }
    ModifyAccount($mysqli,$info_modifier,$_SESSION['id_user']);
    ModifySESSION($info_modifier);
}
closeDB($mysqli);
header('Location: ../account.php');
?>