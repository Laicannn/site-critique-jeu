<?php
//affichage des erreurs côté PHP et côté MYSQLI
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//Import du site - A completer
require_once("../includes/constantes.php");      //constantes du site
require_once("../includes/config-bdd.php");
require_once("functions-DB.php");
require_once("functions_query.php");
require_once("functions_structure.php");
$mysqli = connectionDB();
$user=$_POST['pseudo'];
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$mail=$_POST['mail'];
$mdp=$_POST['mdp'];
$mdp_repete=$_POST['mdp_repete'];

$birthday = $_POST['age'];
$currentDate = new DateTime();
$birthdate = new DateTime($birthday);
$interval = $birthdate->diff($currentDate);
$age = $interval->y;

if (empty(loginunique($mysqli,$user))){
    if ($mdp === $mdp_repete){
        if ($age > 15){
            creation_compte($mysqli,$user,$mdp,$nom,$prenom,$mail,$birthday);
            $connect = connect($mysqli,$user,$mdp);
            session_start();
            $_SESSION['user'] = "$user";
            // $_SESSION['password'] = "$password";
            foreach($connect as $data){
                $PP = getPP($mysqli,$data['id_image']);
                $_SESSION['pp'] = $PP[0]['chemin'];
                $_SESSION['id_user'] = "$data[id_user]";
                $_SESSION['nom'] = "$data[nom]";
                $_SESSION['prenom'] = "$data[prenom]";
                $_SESSION['age'] = $age;
                $_SESSION['date_naissance'] = "$data[date_naissance]";
                $_SESSION['date_creation_compte'] = "$data[date_creation_compte]";
                $_SESSION['date_connexion'] = "$data[date_connexion]";
                $_SESSION['role'] = "$data[rôle]";
            }
            $_SESSION['logged'] = true;
            header('Location: ../index.php');
        } else {
            echo "Vous n'avez pas 15 ans";
            header('Location: ../connection.php#refused');
        }
    } else {
        echo "Les 2 mots de passe entrés sont différents";
        header('Location: ../connection.php#wrong_pwd');
    }
} else{
    echo "Cet identifiant est déjà utilisé";
    header('Location: ../connection.php#already_used');
}

closeDB($mysqli);
?>