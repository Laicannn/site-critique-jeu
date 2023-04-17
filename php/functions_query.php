<?php

function getIndexArticle($mysqli){
    $requete = 'SELECT article.id_article,article.titre,article.contenu,article.note,article.date_creation,article.date_modification,
                images.chemin
                FROM article,images
                WHERE images.id_article = article.id_article
                AND images.chemin LIKE "%images/jaquette/%"
                ORDER BY article.date_creation ;';
    $article = readDB($mysqli,$requete);
    return $article;
}

function connect($mysqli,$user,$password){
    $requete2 = 'SELECT *
                FROM utilisateur 
                WHERE login = "'.$user.'" 
                AND mdp = "'.$password.'";';
    $connect = readDB($mysqli,$requete2);
    if(empty($connect['id_image'])){
        $requete3 = "UPDATE utilisateur 
                    SET id_image = 100
                    WHERE login = '$user' ;";
        writeDB($mysqli,$requete3);
    }
    return $connect;
}

function changeDateCo($mysqli,$user){
    $date = date("Y-m-d");
    $requete1 = "UPDATE utilisateur 
                SET date_connexion = '$date'
                WHERE login = '$user';";
    writeDB($mysqli,$requete1);
}

function getPP($mysqli,$id_image){
    $requete="SELECT chemin FROM images WHERE id_image = '$id_image';";
    $PP = readDB($mysqli,$requete);
    return $PP;
}

function getAllPP($mysqli){
    $requete="SELECT id_image,chemin FROM images 
            WHERE chemin LIKE '%profile_picture%' 
            AND chemin NOT LIKE '%.svg';";
    $select = readDB($mysqli,$requete);
    return $select;
}

function changeProfile($mysqli,$id_image,$id_user){
    $requete="UPDATE utilisateur SET id_image = '$id_image' WHERE id_user = '$id_user';";
    writeDB($mysqli,$requete);
}

function loginunique($mysqli,$user){
    $requete = "SELECT * 
                FROM utilisateur 
                WHERE login='$user';";
    $login = readDB($mysqli,$requete);
    return $login;
}

function creation_compte($mysqli,$login,$mdp,$nom,$prenom,$mail,$birthday){
    $date=date("Y-m-d");
    $requete = "INSERT INTO utilisateur(login,mdp,nom,prenom,adresse_mail,date_naissance,date_creation_compte,date_connexion,rôle)
                VALUES ('$login','$mdp','$nom','$prenom','$mail','$birthday','$date','$date','membre')";
    writeDB($mysqli,$requete);
}

?>