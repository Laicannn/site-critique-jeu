<?php 

//        PAGE INDEX
//        PAGE INDEX
//        PAGE INDEX

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

function DisplayPageButton($nombre_page,$indice_page){
    echo"<section id='boutons_pages'>";
    for ($i=1; $i<=$nombre_page; $i++){
        if ($i == $indice_page) {
            echo"<a href='?page=$i' class='page_now'>$i</a>";
        }
        else {
            echo"<a href='?page=$i' class='page_pas_now'>$i</a>";
        }   
    }
    echo"</section>";
}





//        PAGE CONNEXION
//        PAGE CONNEXION
//        PAGE CONNEXION

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
                <input type="text" name="nom" id="name" maxlength="20" required>
                <label for="forname">Prénom</label>
                <input type="text" name="prenom" id="forname" maxlength="20" required>
                <label for="old">Âge</label>
                <div id="refused">
                    <label for="old">Vous n\'avez pas l\'âge requis</label>
                    <input type="date" name="age" id="old" required>
                </div>
                <label for="mail">Adresse mail</label>
                <input type="email" name="mail" id="mail" required>
                <label for="username">Identifiant</label>
                <div id="already_used">
                    <label for="username">Cet identifiant n\'est pas disponible</label>
                    <input type="text" name="pseudo" id="username" maxlength="20" required>
                </div>
                <label for="password">Mot de passe</label>
                <div id="wrong_pwd">
                    <label for="password" class="error_mdp">Mots de passe entrés différents</label>
                    <input type="password" name="mdp" id="password" required>
                    <label for="password_repete">Confirmer mot de passe</label>
                    <input type="password_repete" name="mdp_repete" id="password_repete" required>
                </div>
                <br>
                <input type="submit" value="inscription" id="bouton_submit" required>
            </form>
        </div>
    </section>';
}





//        PAGE SON COMPTE
//        PAGE SON COMPTE
//        PAGE SON COMPTE

function displaySelfAccount($liste){
    echo"<section id='profil'>";
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
            <div id='dates_account'>
                Dernière connexion : <p>$_SESSION[date_connexion]</p><br>
                Inscrit(e) le : <p>$_SESSION[date_creation_compte]</p>
            </div>
        </article>
        <a href='modifier.php' id='button_modification'><img src='images/buttons/button_modifier.svg'></a>
    </section>";
}

function displayAvisAccount($liste_avis,$pp){
    echo "
    <section id='liste_avis'>
        <h2> avis écrits </h2>";
        foreach($liste_avis as $avis){
            echo"
            <a id='gotojeux' href='article.php?id_article=$avis[id_article]'>
                <article class='avis'>
                    <div class='entete'>
                        <img class=user src=$pp>  $avis[login]
                        <aside class='date'>$avis[date_creation]</aside>
                        <aside class='note_avis'>$avis[note] / 10</aside>
                    </div>
                    <div class='titre_avis'>
                        $avis[titre]
                    </div>
                    <p>$avis[texte]</p>
                </article>
            </a>";
        }
    echo"</section>";
}

function displayArticleAccount($liste_article){
    echo "<section id=liste_article>
    <h2> articles écrits </h2>";
        foreach($liste_article as $info){
            echo "
            <a href='article.php?id_article=$info[id_article]'>
                <div class='degrade'>
                    <div class='article_account'>
                        <img class='jacquette_article' alt='jaquette du jeu' src=$info[chemin]>
                        <div class=contenu>
                            <div class='titre_article'> $info[titre] </div>
                            <div class='note_article'>$info[note] / 10</div>
                        </div>
                        <p>Create : $info[date_creation] </p>";
                        if (!empty($info['date_modification'])){
                            echo "<p>Édité : $info[date_modification] </p>";
                        }
                    echo"
                    </div>
                </div>
            </a>";
        }
    echo"</section>";
}

function displayPublicAccount($info,$PP,$role){
    echo"<section id=section_public_account>
            <div id='popup4' class='overlay_role'>
                <div class='popup'>
                    <h4>Changer le rôle</h4><br>
                    <a class='close' href='#'>&times;</a>
                    <div class='choix_role'>";
                    foreach ($role as $ex_role){
                        if($ex_role != $info['rôle']){
                            echo "<a href='php/modify_account.php?id_user=$info[id_user]&role=$ex_role' class='$ex_role'> $ex_role </a>";
                        }
                    }
                    echo "</div>
                </div>
            </div>
            <div>
                <img class='avatar_public' src=$PP[chemin] alt='avatar'>
            </div>
            <h2>$info[login]</h2>
            <article class='gauche'>
                <div id='name'>
                    <h3> $info[prenom] ";
                    echo substr($info['nom'],0,1);
                    echo ".</h3>";
                    if ((isset($_SESSION['logged']) && $_SESSION['role'] == 'administrateur' )){
                        echo "<a href='#popup4' id='role_button' class='{$info['rôle']}'>$info[rôle]</a>";
                    }
                    else{
                        echo "<div id='role' class='{$info['rôle']}'>$info[rôle]</div>";
                    }
                echo "</div>
                <div id='dates_account'>
                    Inscrit(e) le : <p>$info[date_creation_compte]</p>
                </div>
            </article>
    </section>";
}



//        PAGE ARTICLE
//        PAGE ARTICLE
//        PAGE ARTICLE

function displayArticle($info,$image,$categories,$support,$avis,$id_article){
    $somme=0.0;
    $nombre=0.0;
    echo "<section id=infoarticle>";
        if ((isset($_SESSION['logged']) && $_SESSION['id_user'] == $info['id_user'] && $_SESSION['role']=='redacteur') || (isset($_SESSION['logged']) && $_SESSION['role']=='administrateur')){
            echo "<div class='ligne_boutons'><a class='button_agir' href='#popup3'>Supprimer</a></div>";
        } echo"
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
                    $moyenne = number_format($moyenne,2);
                    if ($moyenne='nan'){$moyenne='-';}
                    echo"</aside>
                <div id='note_moyenne'><p>Communauté :</p>$moyenne / 10</div>
            </div>
            <div id=contenu>
                <h1> $info[titre] </h1>
                <div id='popup3' class='overlay_delete'>
                    <div class='popup'>
                        <h2>Supprimer l'article ?</h2>
                        <a class='close' href='#'>&times;</a>
                        <div class='delete_box'>
                            <a href='article.php?id_article=$id_article' class='no'>Non</a>
                            <a href='php/supprimer.php?id_article=$id_article' class='yes'>Oui</a>
                        </div>
                    </div>
                </div>
                $info[contenu]
                <div id='note'>$info[note] / 10</div>
            </div>
            <div id='date_article'>
                <p><span>Create : </span>$info[date_creation] </p>";
                if (!empty($info['date_modification'])){
                    echo "<p><span>Edit : </span>$info[date_modification] </p>";
                }
            echo"</div>";
    echo "</section>
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
                    <div id='popup2' class='overlay_delete'>
                        <div class='popup'>
                            <h2>Supprimer l'avis ?</h2>
                            <a class='close' href='#'>&times;</a>
                            <div class='delete_box'>
                                <a href='' class='no'>Non</a>
                                <a href='php/supprimer.php?id_avis=$avions[id_avis]' class='yes'>Oui</a>
                            </div>
                        </div>
                    </div>
                <aside class='note_avis'>$avions[note] / 10</aside>
            </div>
            <div class='titre'>
                $avions[titre]
            </div>
            <p>$avions[texte]</p>
            <div class=ligne_boutons>";
                if (isset($_SESSION['logged']) && $_SESSION['id_user'] == $avions['id_user']){
                    echo"<a class='button_agir' href='modifier.php?id_avis=$avions[id_avis]'>Modifier</a>";
                }
                if ((isset($_SESSION['logged']) && $_SESSION['id_user']== $avions['id_user']) || (isset($_SESSION['logged']) && $_SESSION['role']=='administrateur')){
                    echo"<a class='button_agir' href='#popup2'>Supprimer</a>";
                } echo"
            </div>
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
                    <input type='text' name='titre' id='title' placeholder='Titre' required maxlength='50'>
                    <aside class='note_avis'>
                        <input type='number' min=1 max=10 id='notation' name='note' required><label for='note'>/10</label>
                    </aside>
                </div>
                <textarea type='text' name='avis' id='redaction' placeholder='Rédiger son avis...' required maxlength='255'></textarea>
                <input type='submit' value='envoyer' id='bouton_submit'>
            </form>
        </article>
    </section>";
}




//        PAGE ECRIRE ARTICLE
//        PAGE ECRIRE ARTICLE
//        PAGE ECRIRE ARTICLE

function displayChooseGame($jeuxdispo){
    echo "<section id=infoarticle>
        <article>
            <div id='boite_popup'>
                <a class='button' href='#popup'> Choix  du jeu </a>
            </div>
            <div id='popup' class='overlay'>
                <div class='selection_jeu'>
                    <h2> Choisissez un jeu pour votre article </h2>
                    <a class='close_button' href=''>&times;</a>
                    <div>";
                        foreach($jeuxdispo as $data){
                            echo"<a href='redige.php?id_jeux=$data[id_jeux]&amp;chemin=$data[chemin]'><img class='liste_jeu' src='$data[chemin]' alt='jeux proposé'></a>";
                        }
                    echo"</div>
                </div>
            </div>
        </article>
    </section>";
}

function displayWriteArticle($id_jeux,$jaquette,$categorie,$support){
    echo "<section id=infoarticle>
            <div id='image_tags'>
                <img id='jacquette_article' alt='jaquette du jeu' src=$jaquette>
                <aside id='tags'>";
                    foreach($categorie as $cate){
                        echo "<div><p class='categorie'>$cate[nom_categorie]</p></div>";
                    }
                    foreach($support as $sup){
                        echo "<div><p class='support'>$sup[nom_support]</p></div>";
                    }
                    echo"</aside>
            </div>
            <form id=contenu action='php/writearticle.php?id_jeux=$id_jeux' method='POST' name='redigeArticle'>
                <input id=title name=titre placeholder='Titre' maxlength='50'>
                <textarea type='text' name='article' id='redaction' placeholder='Rédiger votre article...' required maxlength='1000'></textarea>
                <aside class='note_article'>
                    <input type='number' min=1 max=10 id='notation' name='note' required><label for='note'>/10</label>
                </aside>
                <input type='submit' value='valider' id='bouton_submit'>
            </form>
    </section>";
}



//        PAGE MODIFIER
//        PAGE MODIFIER
//        PAGE MODIFIER

function displayModifyArticle($info,$image,$categories,$support,$id_article){
    echo "<section id=new_article>";
        echo"
            <div id='image_tags'>
                <img id='jacquette_article' alt='jaquette du jeu' src=$info[chemin]>
                <aside id='tags'>";
                    foreach($categories as $cate){
                        echo "<div><p class='categorie'>$cate[nom_categorie]</p></div>";
                    }
                    foreach($support as $sup){
                        echo "<div><p class='support'>$sup[nom_support]</p></div>";
                    }
                echo"</aside>
            </div>
            <form id=contenu>
                <input id=title_article type='text' name='titre' placeholder='$info[titre]' maxlength='50'>
                <textarea type='text' name='article' id='redaction_article' placeholder='$info[contenu]' maxlength='1000'></textarea>
                <div id=note_modif><input type='number' value='$info[note]' min=1 max=10 name='note'><label for='note'>/10</label></div>
                <input type='submit' value='modifier' id='bouton_submit'>
            </form>";
    echo "</section>
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
                    echo "<img class=image_jeu alt='image du jeu' src=$img[chemin] >";
                } echo "
            </div>
        </section>";
}

function displayModifyAvis($info_avis,$id_avis){
    echo "<section id='new_avis'>
        <article class='article'>
            <form action='php/modify_avis.php?id_avis=$id_avis' method='POST' name='modifyAvis'>
                <div class='entete'>
                    <input type='text' name='titre' id='title_avis' placeholder='$info_avis[titre]' maxlength='50'>
                    <aside class='note_article'>
                        <input type='number' value='$info_avis[note]' min=1 max=10 class='note_article' name='note'><label for='note'>/10</label>
                    </aside>
                </div>
                <textarea type='text' name='avis' id='redaction_avis' placeholder='$info_avis[texte]' maxlength='255'></textarea>
                <input type='submit' value='modifier' id='bouton_submit'>
            </form>
        </article>
    </section>";
}

function displayChangeAccount(){
    echo "<section>
        <h1>Modifier</h1>
        <form action='php/modify_account.php' method='POST' name='inscrire'>
            <div id='modify_account'>
                <label for='name'>Nom</label>
                <input type='text' name='nom' value='$_SESSION[nom]' id='name'>
                <label for='forname'>Prénom</label>
                <input type='text' name='prenom' value='$_SESSION[prenom]' id='forname'>
                <label for='old'>Âge</label>
                <div id='refused'>
                    <label for='old'>Vous n\'avez pas l\'âge requis</label>
                    <input type='date' name='age' id='old' value='$_SESSION[date_naissance]' required>
                </div>
                <label for='mail'>Adresse mail</label>
                <input type='email' name='mail' value='$_SESSION[mail]' id='mail'>
                <label for='username'>Identifiant</label>
                <div id='already_used'>
                    <label for='username'>Cet identifiant n\'est pas disponible</label>
                    <input type='text' name='pseudo' value='$_SESSION[user]' id='username' required>
                </div>
                <label for='password'>Mot de passe</label>
                <div id='wrong_pwd'>
                    <label for='password' class='error_mdp'>Mots de passe entrés différents</label>
                    <input type='password' name='mdp' id='password' >
                    <label for='password_repete'>Confirmer mot de passe</label>
                    <input type='password' name='mdp_repete' id='password_repete'>
                </div>
            </div>
                <br>
                <input type='submit' value='modifier' id='bouton_submit'>
        </form>
    </section>";
}

?>