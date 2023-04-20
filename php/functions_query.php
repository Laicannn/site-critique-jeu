<?php

function getIndexArticle($mysqli){
    $requete = 'SELECT article.*,jeux.id_jeux,images.chemin
                FROM article,images,jeux
                WHERE images.id_article = article.id_article
                AND images.chemin LIKE "%images/jaquette/%"
                AND jeux.id_article = article.id_article
                ORDER BY article.date_creation ;';
    $liste_article = readDB($mysqli,$requete);
    return $liste_article;
}

function getIndexCateg($mysqli,$categorie){
    $requete = "SELECT article.*,jeux.id_jeux,images.chemin
                FROM article,images,jeux,categories,estcategories
                WHERE images.id_article = article.id_article
                AND '$categorie' = categories.nom_categorie
                AND categories.id_categorie = estcategories.id_categorie
                AND estcategories.id_jeux = jeux.id_jeux
                AND jeux.id_article = article.id_article
                AND images.chemin LIKE '%images/jaquette/%'
                ORDER BY article.date_creation ;";
    $liste_article = readDB($mysqli,$requete);
    return $liste_article;
}

function getIndexSupp($mysqli,$support){
    $requete = "SELECT article.*,jeux.id_jeux,images.chemin
                FROM article,images,jeux,support,estsupport
                WHERE images.id_article = article.id_article
                AND '$support' = support.nom_support
                AND support.id_support = estsupport.id_support
                AND estsupport.id_jeux = jeux.id_jeux
                AND jeux.id_article = article.id_article
                AND images.chemin LIKE '%images/jaquette/%'
                ORDER BY article.date_creation ;";
    $liste_article = readDB($mysqli,$requete);
    return $liste_article;
}

function getIndedexSearch($mysqli,$search){
    $requete = "SELECT DISTINCT article.*,jeux.id_jeux,images.chemin
                FROM article,images,jeux,support,estsupport,categories,estcategories
                WHERE images.id_article = article.id_article
                AND (
                    (support.nom_support LIKE '%$search%' AND support.id_support = estsupport.id_support)
                    OR (categories.nom_categorie LIKE '%$search%' AND categories.id_categorie = estcategories.id_categorie)
                    OR article.titre LIKE '%$search%'
                    OR article.contenu LIKE '%$search%'
                    OR jeux.nom LIKE '%$search%')
                AND images.chemin LIKE '%images/jaquette/%'
                AND jeux.id_article = article.id_article
                ORDER BY article.date_creation ;";
    $liste_article = readDB($mysqli,$requete);
    return $liste_article;
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

function getinfoarticleETjeu($mysqli,$id_article){
    $requete = "SELECT article.titre,article.contenu,article.note,article.date_creation,article.date_modification, jeux.id_jeux, jeux.nom, jeux.prix, jeux.date_sortie, jeux.synopsis,images.chemin 
                FROM article,jeux,images 
                WHERE article.id_article=$id_article AND article.id_article=jeux.id_article AND images.id_article = article.id_article AND images.chemin LIKE '%images/jaquette/%'";
    $info=readDB($mysqli,$requete);
    return $info[0];
}
function imagesarticles($mysqli,$id_article){
    $requete="SELECT images.chemin 
                FROM images
                WHERE images.id_article = $id_article
                AND images.chemin NOT LIKE '%images/jaquette/%'";
    $image=readDB($mysqli,$requete);
    return $image;
}

function getAvis($mysqli,$id_jeux){
    $requete= "SELECT avis.*,utilisateur.login,utilisateur.id_image,utilisateur.id_user  FROM avis,utilisateur 
                WHERE avis.id_jeux=$id_jeux AND avis.id_user=utilisateur.id_user;";
    $avis=readDB($mysqli,$requete);
    return $avis;
}

function writeAvis($mysqli,$titre,$note,$id_jeux,$id_user,$texte){
    $date=date("Y-m-d");
    $requete1= "SELECT id_avis FROM avis";
    $id_avis = count(readDB($mysqli,$requete1),1)-1;
    $requete2 = "INSERT INTO avis (id_avis,titre,note,date_creation,id_jeux,id_user,texte) 
                VALUES ('$id_avis','$titre','$note','$date','$id_jeux','$id_user','$texte');";
    writeDB($mysqli,$requete2);
}
?>