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
    closeDB($mysqli);
    header('Location: ../account.php');
}
if(!empty($_GET['id_user']) && (!empty($_GET['role']))){
    $id_user=$_GET['id_user'];
    $role=$_GET['role'];
    Modifyrole($mysqli,$id_user,$role);
    closeDB($mysqli);
    header('Location: ../index.php');
}
if (!empty($_POST)){
    $info_modifier = $_POST;
    if (($_SESSION['user']==$info_modifier['pseudo']) || empty(loginunique($mysqli,$info_modifier['pseudo']))){
        $birthday = $info_modifier['age'];
        $currentDate = new DateTime();
        $birthdate = new DateTime($birthday);
        $interval = $birthdate->diff($currentDate);
        $age = $interval->y;
        if ($age > 15){
            $info_connect = getUser($mysqli,$_SESSION['id_user']);
            if (empty($info_modifier['mdp'])){
                $info_modifier['mdp']=$info_connect['mdp'];
            }
            ModifyAccount($mysqli,$info_modifier,$_SESSION['id_user']);
            ModifySESSION($info_modifier);
            closeDB($mysqli);
            header('Location: ../account.php');
        }
        else{
            closeDB($mysqli);
            echo "Vous n'avez pas 15 ans";
            header('Location: ../modifier.php#refused');
        }
    }
    else{
    closeDB($mysqli);
    echo "Cet identifiant est déjà utilisé";
    header('Location: ../modifier.php#already_used');
    }
}


?>