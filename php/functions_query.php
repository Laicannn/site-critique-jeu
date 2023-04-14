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
    $date = date("Y-m-d");
    $requete1 = "UPDATE utilisateur 
                SET date_connexion = '$date'
                WHERE login = '$user';";
    writeDB($mysqli,$requete1);
    $requete2 = 'SELECT id_user,login,mdp,nom,prenom,rôle,id_image
                FROM utilisateur 
                WHERE login = "'.$user.'" 
                AND mdp = "'.$password.'";';
    $connect = readDB($mysqli,$requete2);
    return $connect;
}

function loginunique($mysqli,$user){
    $requete = "SELECT * 
                FROM utilisateur 
                WHERE login='$user';"
    $login = readDB($mysqli,$requete);
    return $login;
}

?>