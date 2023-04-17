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
    // $_SESSION['password'] = "$password";
    foreach($connect as $data){
        $PP = getPP($mysqli,$data['id_image']);
        $_SESSION['pp'] = $PP[0]['chemin'];
        $_SESSION['id_user'] = "$data[id_user]";
        $_SESSION['nom'] = "$data[nom]";
        $_SESSION['prenom'] = "$data[prenom]";
        $_SESSION['date_de_naissance'] = "$data[date_de_naissance]";
        $_SESSION['date_creation_compte'] = "$data[date_creation_compte]";
        $_SESSION['date_connexion'] = "$data[date_connexion]";
        $_SESSION['role'] = "$data[rôle]";
    }
    $_SESSION['logged'] = true;
    header('Location: ../index.php');
}
else {
    header('Location: ../connection.php?msg=erreur');
}

closeDB($mysqli);
?>