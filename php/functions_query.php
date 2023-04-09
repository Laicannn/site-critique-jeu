<?php

function getIndexArticle($mysqli){
    $requete = 'SELECT article.id_article,article.titre,article.contenu,article.note,article.date_creation,article.date_modification,
                images.chemin
                FROM article,images
                WHERE images.id_article = article.id_article
                AND images.chemin LIKE "%images/jaquette/%";';
    $article = readDB($mysqli,$requete);
    return $article;
}

?>