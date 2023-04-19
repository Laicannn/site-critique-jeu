<?php

function getIndexArticle($mysqli){
    $requete = 'SELECT article.id_article,article.titre,article.contenu,article.note,article.date_creation,article.date_modification,jeux.id_jeux,
                images.chemin
                FROM article,images,jeux
                WHERE images.id_article = article.id_article
                AND images.chemin LIKE "%images/jaquette/%"
                AND jeux.id_article = article.id_article
                ORDER BY article.date_creation ;';
    $article = readDB($mysqli,$requete);
    return $article;
}

function getCategorie($mysqli,$id_jeux){
    $requete = "SELECT nom_categorie FROM categories,estcategories
                WHERE '$id_jeux' = estcategories.id_jeux 
                AND estcategories.id_categorie = categories.id_categorie;";
    $categorie = readDB($mysqli,$requete);
    return $categorie;
}

function getSupport($mysqli,$id_jeux){
    $requete = "SELECT nom_support FROM support,estsupport
                WHERE '$id_jeux' = estsupport.id_jeux
                AND estsupport.id_support = support.id_support;";
    $categorie = readDB($mysqli,$requete);
    return $categorie;
}

function connect($mysqli,$user,$password){
    $requete1 = 'SELECT *
                FROM utilisateur 
                WHERE login = "'.$user.'" 
                AND mdp = "'.$password.'";';
    $connect = readDB($mysqli,$requete1);
    if(empty($connect['0']['id_image'])){
        $requete3 = "UPDATE utilisateur 
                    SET id_image = 100
                    WHERE login = '$user' ;";
        writeDB($mysqli,$requete3);
        $connect['0']['id_image']=100;
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