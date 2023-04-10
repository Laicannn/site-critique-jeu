<?php
require_once("../includes/constantes.php");      //constantes du site
require_once("../includes/config-bdd.php");
require_once("functions-DB.php");
require_once("functions_query.php");
require_once("functions_structure.php");
$mysqli = connectionDB();
$user = $_POST['pseudo'];
$password = $_POST['mdp'];
$connect = connect($mysqli,$user,$password);
session_start();
if ($connect){
    $_SESSION['user'] = "$user";
    $_SESSION['password'] = "$password";
    foreach($connect as $data){
        $_SESSION['id'] = "$data[id_dresseur]";
    }
    $_SESSION['logged'] = true;
    header('Location: ../index.php');
}
else {
    // header('Location: ../connection.php');
}

closeDB($mysqli);
?>