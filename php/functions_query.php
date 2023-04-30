<?php

function getIndexArticle($mysqli){
    $requete = 'SELECT article.*,jeux.id_jeux,images.chemin
                FROM article,images,jeux
                WHERE images.id_article = article.id_article
                AND images.chemin LIKE "%images/jaquette/%"
                AND jeux.id_article = article.id_article
                ORDER BY article.date_creation DESC;';
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
                FROM article,images,jeux,support,estsupport,categories,estcategories,avis
                WHERE images.id_article = article.id_article
                AND (
                    (support.nom_support LIKE '%$search%' AND support.id_support = estsupport.id_support)
                    OR (categories.nom_categorie LIKE '%$search%' AND categories.id_categorie = estcategories.id_categorie)
                    OR article.titre LIKE '%$search%'
                    OR article.contenu LIKE '%$search%'
                    OR jeux.nom LIKE '%$search%'
                    OR avis.texte LIKE '%$search%'
                    OR avis.titre LIKE '%$search%')
                AND avis.id_jeux=jeux.id_jeux
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
    $requete = "SELECT article.id_user,article.titre,article.contenu,article.note,article.date_creation,article.date_modification, jeux.id_jeux, jeux.nom, jeux.prix, jeux.date_sortie, jeux.synopsis,images.chemin 
                FROM article,jeux,images 
                WHERE article.id_article=$id_article AND article.id_article=jeux.id_article AND images.id_article = article.id_article AND images.chemin LIKE '%images/jaquette/%'";
    $info=readDB($mysqli,$requete);
    return $info[0];
}

function imagesarticles($mysqli,$id_jeux){
    $requete="SELECT images.chemin 
                FROM images
                WHERE images.id_jeux = $id_jeux
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
    $requete = "INSERT INTO avis (titre,note,date_creation,id_jeux,id_user,texte) 
                VALUES ('$titre','$note','$date','$id_jeux','$id_user','$texte');";
    writeDB($mysqli,$requete);
}

function writeArticle($mysqli,$titre,$note,$id_user,$contenu){
    $date=date("Y-m-d");
    $requete="INSERT INTO article(titre,contenu,note,date_creation,id_user)
                VALUES ('$titre','$contenu','$note','$date','$id_user');";
    writeDB($mysqli,$requete);
}

function getIdNewArticle($mysqli,$titre,$note,$contenu){
    $requete="SELECT article.id_article 
                FROM article 
                WHERE article.contenu='$contenu' AND article.titre='$titre' AND article.note=$note;";
    $id_article=readDB($mysqli,$requete);
    return $id_article[0];
}

function ChangeArticle($mysqli,$id_article,$id_jeux){
    $requete1="UPDATE jeux 
                SET jeux.id_article=$id_article
                WHERE jeux.id_jeux=$id_jeux;";
    writeDB($mysqli,$requete1);
    $requete2="UPDATE images 
                SET images.id_article=$id_article
                WHERE images.id_jeux=$id_jeux;";
    writeDB($mysqli,$requete2);
}

function getJeuDispo($mysqli){
    $requete="SELECT images.chemin,jeux.id_jeux 
                FROM images,jeux
                WHERE images.id_article IS NULL AND images.chemin LIKE '%images/jaquette/%' AND jeux.id_jeux=images.id_jeux;";
    $jeux=readDB($mysqli,$requete);
    return $jeux;
}

function getAvisAndUser($mysqli,$id_user,$id_jeux){
    $requete="SELECT * 
                FROM avis
                WHERE avis.id_user=$id_user AND avis.id_jeux=$id_jeux;";
    $info=readDB($mysqli,$requete);
    return $info;
}

function getWriterArticle($mysqli,$id_user,$id_jeux){
    $requete="SELECT * 
                FROM article,jeux
                WHERE article.id_user=$id_user AND jeux.id_article=article.id_article AND jeux.id_jeux=$id_jeux;";
    $info=readDB($mysqli,$requete);
    return $info;
}

function ModifyArticle($mysqli,$id_article,$titre,$contenu,$note){
    $date_modif=date("Y-m-d");
    $requete1="UPDATE article
            SET titre='$titre'
            WHERE id_article=$id_article;";
    writeDB($mysqli,$requete1);
    $requete2="UPDATE article
            SET contenu='$contenu'
            WHERE id_article=$id_article;";
    writeDB($mysqli,$requete2);
    $requete3="UPDATE article
            SET note='$note'
            WHERE id_article=$id_article;";
    writeDB($mysqli,$requete3);
    $requete4="UPDATE article
            SET date_modification='$date_modif'
            WHERE id_article=$id_article;";
    writeDB($mysqli,$requete4);
}

function getInfoJeu($mysqli,$id_jeux){
    $requete="SELECT jeux.*,images.chemin
            FROM jeux,images
            WHERE jeux.id_jeux=$id_jeux AND images.id_jeux=jeux.id_jeux AND images.chemin NOT LIKE '%images/jaquette/%';";
    $info=readDB($mysqli,$requete);
    return $info[0];
}

function getInfoAvis($mysqli,$id_avis){
    $requete="SELECT avis.*,article.id_article 
                FROM avis,article,jeux 
                WHERE avis.id_avis=$id_avis
                    AND avis.id_jeux=jeux.id_jeux 
                    AND jeux.id_article=article.id_article;";
    $info=readDB($mysqli,$requete);
    return $info[0];
}

function ModifyAvis($mysqli,$id_avis,$titre,$texte,$note){
    $requete1="UPDATE avis
            SET titre='$titre'
            WHERE id_avis=$id_avis;";
    writeDB($mysqli,$requete1);
    $requete2="UPDATE avis
            SET texte='$texte'
            WHERE id_avis=$id_avis;";
    writeDB($mysqli,$requete2);
    $requete3="UPDATE avis
            SET note='$note'
            WHERE id_avis=$id_avis;";
    writeDB($mysqli,$requete3);
}

function deleteAvis($mysqli,$id_avis){
    $requete="DELETE FROM avis WHERE avis.id_avis=$id_avis";
    writeDB($mysqli,$requete);
}

function deleteArticle($mysqli,$id_article){
    $requete1="UPDATE jeux SET jeux.id_article=NULL WHERE jeux.id_article=$id_article;";
    writeDB($mysqli,$requete1);
    $requete2="UPDATE images SET images.id_article=NULL WHERE images.id_article=$id_article;";
    writeDB($mysqli,$requete2);
    $requete3="DELETE FROM article WHERE article.id_article=$id_article";
    writeDB($mysqli,$requete3);
}

function getIdJeux($mysqli,$id_article){
    $requete="SELECT id_jeux
                FROM jeux,article
                WHERE jeux.id_article=$id_article;";
    $id_jeux=readDB($mysqli,$requete);
    return $id_jeux[0]['id_jeux'];
}

function getAvisofUser($mysqli,$id_user){
    $requete="SELECT avis.*,jeux.nom,jeux.id_article 
                FROM avis,jeux
                WHERE avis.id_user=$id_user AND avis.id_jeux=jeux.id_jeux;";
    $liste_avis=readDB($mysqli,$requete);
    return $liste_avis;
}

function getArticleAccount($mysqli,$id_user){
    $requete="SELECT article.*,jeux.id_jeux,images.chemin
                FROM article,jeux,images
                WHERE article.id_user=$id_user 
                AND article.id_article=jeux.id_article 
                AND images.id_article = article.id_article 
                AND images.chemin LIKE '%images/jaquette/%';";
    $liste_article=readDB($mysqli,$requete);
    return $liste_article;
}

function getNoteAvis($mysqli,$id_jeux){
    $requete="SELECT avis.note
                FROM avis
                WHERE avis.id_jeux=$id_jeux;";
    $note_avis=readDB($mysqli,$requete);
    return $note_avis;           
}

function getUser($mysqli,$id_user){
    $requete="SELECT utilisateur.*
                FROM utilisateur
                WHERE utilisateur.id_user=$id_user;";
    $info=readDB($mysqli,$requete);
    return $info[0];
}

function ModifyAccount($mysqli,$info_modifier,$id_user){
    $requete1="UPDATE utilisateur
                SET utilisateur.login='$info_modifier[pseudo]'
                WHERE id_user=$id_user;";
    writeDB($mysqli,$requete1);
    $requete2="UPDATE utilisateur
                SET mdp='$info_modifier[mdp]'
                WHERE id_user=$id_user;";
    writeDB($mysqli,$requete2);
    $requete3="UPDATE utilisateur
                SET nom='$info_modifier[nom]'
                WHERE id_user=$id_user;";
    writeDB($mysqli,$requete3);
    $requete4="UPDATE utilisateur
                SET prenom='$info_modifier[prenom]'
                WHERE id_user=$id_user;";
    writeDB($mysqli,$requete4);
    $requete5="UPDATE utilisateur
                SET adresse_mail='$info_modifier[mail]'
                WHERE id_user=$id_user;";
    writeDB($mysqli,$requete5);
    $requete6="UPDATE utilisateur
                SET date_naissance='$info_modifier[age]'
                WHERE id_user=$id_user;";
    writeDB($mysqli,$requete6);
}

function ModifySESSION($info_modifier){
    $currentDate = new DateTime();
    $birthdate = new DateTime($info_modifier['age']);
    $_SESSION['age'] = $birthdate->diff($currentDate)->y;
    $_SESSION['nom'] = "$info_modifier[nom]";
    $_SESSION['prenom'] = "$info_modifier[prenom]";
    $_SESSION['date_naissance'] = "$info_modifier[age]";
    $_SESSION['mail'] = "$info_modifier[mail]";
    $_SESSION['user'] = "$info_modifier[pseudo]";
}

function getInfoMember($mysqli,$id_user){
    $requete="SELECT utilisateur.*
                FROM utilisateur
                WHERE utilisateur.id_user=$id_user;";
    $info=readDB($mysqli,$requete);
    return $info[0];
}

?>