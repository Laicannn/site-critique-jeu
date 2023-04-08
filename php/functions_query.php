<?php

function getIndexArticle($mysqli){
    $requete = 'SELECT article.id_article,article.titre,images.chemin
                FROM article,images
                WHERE article.id_articles = images.id_article';
    $article = readDB($mysqli,$requete);
    return $article;
}

?>