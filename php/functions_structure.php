<?php 

function DisplayJaquette($article,$supports,$categories){
    echo "
    <a class='carte' href='article.php?id_article=$article[id_article]'>
        <div class='degrade'>
            <img src=$article[chemin] alt='jaquette'>
        </div>
        <h2>$article[titre]</h2>
        <h3>$article[date_creation]</h3>";
        echo"<div class='tags'>";
        foreach($categories as $data){
            echo"<div><p class='categ'>$data[nom_categorie]</p></div>";
        }
        foreach($supports as $data){
            echo"<div><p class='support'>$data[nom_support]</p></div>";
        }
        echo"</div>";
    echo"</a>";
}

function displayConnect(){
    echo'<section>
        <div id="connecter">
            <h1>Se connecter</h1>
            <form action="php/login.php" method="POST" name="connecte">
                <label for="username">Identifiant</label>
                <input type="text" name="pseudo" id="username">
                <label for="password">Mot de passe</label>
                <input type="password" name="mdp" id="password">
                <br>
                <input type="submit" value="connexion" id="bouton_submit">
            </form>
        </div>
        <div id="inscrire">
            <h1>S\'inscrire</h1>
            <form action="php/register.php" method="POST" name="inscrire">
                <label for="name">Nom</label>
                <input type="text" name="nom" id="name">
                <label for="forname">Prénom</label>
                <input type="text" name="prenom" id="forname">
                <label for="old">Âge</label>
                <div id="refused">
                    <label for="old">Vous n\'avez pas l\'âge requis</label>
                    <input type="date" name="age" id="old" required>
                </div>
                <label for="mail">Adresse mail</label>
                <input type="email" name="mail" id="mail">
                <label for="username">Identifiant</label>
                <div id="already_used">
                    <label for="username">Cet identifiant n\'est pas disponible</label>
                    <input type="text" name="pseudo" id="username" required>
                </div>
                <label for="password">Mot de passe</label>
                <input type="password" name="mdp" id="password">
                <br>
                <input type="submit" value="inscription" id="bouton_submit">
            </form>
        </div>
    </section>';
}

function displaySelfAccount($liste){
    echo"<section>";
        echo"<a class='button' href='#popup'>";
            echo"<div class='photo_profil'>";
                echo"<img class='avatar' src=$_SESSION[pp] alt='avatar'>";
            echo"</div>";
        echo"</a>";
        echo"<div id='popup' class='overlay'>";
            echo"<div class='selection_pp'>";
                echo"<img class='pp_now' src='$_SESSION[pp]' alt='pp actuelle'>";
                echo"<a class='close_button' href=''>&times;</a>";
                echo"<div>";
                    foreach($liste as $data){
                        echo"<a href='php/modify_account.php?id_image=$data[id_image]'><img class='liste_pp' src='$data[chemin]' alt='pp proposée'></a>";
                    }
                echo"</div>";
            echo"</div>";
        echo"</div>";
        echo"
        <h2>$_SESSION[user]</h2>
        <article class='gauche'>
            <div id='name'>
                <h3>$_SESSION[prenom] $_SESSION[nom]</h3>
                <div id='role' class='{$_SESSION['role']}'>$_SESSION[role]</div>
            </div>
            <div id='old'>
                $_SESSION[age] • $_SESSION[date_naissance]
            </div>
        </article>
    ";
    echo"<section>";
    
}

function displayArticle($info,$image,$categories,$support,$avis,$id_article){
    $somme=0.0;
    $nombre=0.0;
    echo "<section id=infoarticle>
            <div id='image_tags'>
                <img id='jacquette_article' alt='jaquette du jeu' src=$info[chemin]>
                <aside id='tags'>";
                    foreach($categories as $cate){
                        echo "<div><p class='categorie'>$cate[nom_categorie]</p></div>";
                    }
                    foreach($support as $sup){
                        echo "<div><p class='support'>$sup[nom_support]</p></div>";
                    }
                    foreach($avis as $avions){
                        $somme=$somme + $avions['note'];
                        $nombre=$nombre + 1.0;
                    }
                    $moyenne = fdiv($somme,$nombre);
                    echo"</aside>
                <div id='note_moyenne'><p>Communauté :</p>$moyenne / 10</div>
            </div>
            <div id=contenu>
                <h1> $info[titre] </h1> 
                $info[contenu]
                <div id='note'>$info[note] / 10</div>
            </div>
        </section>
        <section id='infojeux'>
            <div id='texte'>
                <h2>$info[nom]</h2>
                <h3>Synopsis : </h3>
                <p>$info[synopsis]</p>
                <h3>Date de sortie : </h3>
                <p>$info[date_sortie]</p>
                <h3>Prix : </h3>
                <p>$info[prix]</p>
            </div>
            <div id='liste_image'>";
                $i=-1;
                foreach($image as $img){
                    $i=$i+1;
                    echo "<a href='?id_article=$id_article&img=$i#popup'><img class=image_jeu alt='image du jeu' src=$img[chemin] ></a>";
                }
        echo "
            </div>
            <div id='popup' class='overlay'>
                <div class='liste_photos_grandes'>
                    <a class='close_button' href='?id_article=$id_article'>&times;</a>";
                    $link=$image[$_GET['img']]['chemin'];
                    if($_GET['img'] == 0){
                        echo"<a href='?id_article=$id_article&img=".($i-1)."#popup'>
                            <img class='arrow' src='images/buttons/arrow_button_left.svg'>
                        </a>";
                        }
                    else {
                        echo"<a href='?id_article=$id_article&img=".($_GET['img']-1)."#popup'>
                            <img class='arrow' src='images/buttons/arrow_button_left.svg'>
                        </a>";
                    }
                    echo"<img class='grand_photo' alt='image du jeu' src='$link'>";
                    if($_GET['img']+1 > $i){
                    echo"<a href='?id_article=$id_article&img=0#popup'>
                        <img class='arrow' src='images/buttons/arrow_button_right.svg'>
                    </a>";
                    }
                    else{
                    echo"<a href='?id_article=$id_article&img=".($_GET['img']+1)."#popup'>
                        <img class='arrow' src='images/buttons/arrow_button_right.svg'>
                    </a>";
                    }
                echo"</div>
            </div>
        </section>";
}

function displayAvis($avions,$pp){
    echo "<section id='liste_avis'>
        <article class='avis'>
            <div class='entete'>
                <a href='account.php?account=$avions[id_user]' class='user'>
                    <img src='$pp[chemin]'>  $avions[login]
                </a>
                <aside class='date'>$avions[date_creation]</aside>
                <aside class='note_avis'>$avions[note] / 10</aside>
            </div>
            <div class='titre'>
                $avions[titre]
            </div>
            <p>$avions[texte]</p>
        </article>
    </section>";
}

function displayDonneAvis($id_jeu){
    echo "<section id='liste_avis'>
        <article class='avis'>
            <div class='profil'>
                <a href='account.php?account=$_SESSION[id_user]' class='user'>
                    <img src='$_SESSION[pp]'>  $_SESSION[user]
                </a>
            </div>
            <form action='php/avis.php?id_article=$_GET[id_article]&id_jeux=$id_jeu' method='POST' name='redigeAvis'>
                <div class='entete'>
                    <input type='text' name='titre' id='title' placeholder='Titre' required maxlength='20'>
                    <aside class='note_avis'>
                        <input type='number' min=1 max=10 id='notation' name='note' required><label for='note'>/10</label>
                    </aside>
                </div>
                <textarea type='text' name='avis' id='redaction' placeholder='Rédiger son avis...' required maxlength='100'></textarea>
                <input type='submit' value='envoyer' id='bouton_submit'>
            </form>
        </article>
    </section>";
}

function displayWriteArticle($jeuxdispo){
    echo "<section id='new_article'>
        <article class='article'>
            <div id='boite_popup'>
                <a class='button' href='#popup'> Choix  du jeu </a>
            </div>
            <div id='popup' class='overlay'>
                <div class='selection_jeu'>
                    <h2> Choisissez un jeu pour votre article </h2>
                    <a class='close_button' href=''>&times;</a>
                    <div>";
                        foreach($jeuxdispo as $data){
                            echo"<a href='php/writearticle.php?id_jeux=$data[id_jeux]&amp;chemin=$data[chemin]'><img class='liste_jeu' src='$data[chemin]' alt='jeux proposé'></a>";
                        }
                echo"</div>
                </div>
            </div>";
            if (!empty($_SESSION['id_jeux'])){
                    echo "<img id='jeu_choisi' src='$_SESSION[chemin]' alt='jeux choisi'>";
            }
        echo "<form action='php/writearticle.php' method='POST' name='redigeArticle'>
                <div class='entete'>
                    <input type='text' name='titre' id='title' placeholder='Titre' required maxlength='20'>
                    
                    <aside class='note_article'>
                        <input type='number' min=1 max=10 id='notation' name='note' required><label for='note'>/10</label>
                    </aside>
                </div>
                <textarea type='text' name='article' id='redaction' placeholder='Rédiger votre article...' required maxlength='100'></textarea>
                <input type='submit' value='envoyer' id='bouton_submit'>
            </form>
        </article>
    </section>";
}

?>