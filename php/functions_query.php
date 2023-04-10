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
    $requete = 'SELECT id_user,login,mdp,nom,prenom,rôle
                FROM utilisateur 
                WHERE login = "'.$user.'" 
                AND utilisateur.mdp = "'.$password.'";';
    $connect = readDB($mysqli,$requete);
    return $connect;
}

?>