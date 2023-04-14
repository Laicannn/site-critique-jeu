<?php 

function DisplayJaquette($articles){
    echo "<section>";
        foreach($articles as $data){
            echo "
            <a class='carte' href='article.php?id_article=$data[id_article]'>
                <img src=$data[chemin] alt='jaquette'>
            </a>";
        }
    echo "</section>";
}

function displayConnect(){
    echo'
    <section>
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
                <input type="date" name="age" id="old">
                <label for="mail">Adresse mail</label>
                <input type="email" name="mail" id="mail">
                <label for="username">Identifiant</label>
                <input type="text" name="pseudo" id="username">
                <label for="password">Mot de passe</label>
                <input type="password" name="mdp" id="password">
                <br>
                <input type="submit" value="inscription" id="bouton_submit">
            </form>
        </div>
    </section>';
}

function displayAccount($liste){
    echo"<section>";
        echo"<a class='button' href='#popup'>";
            echo"<div class='photo_profil'>";
                echo"<img class='avatar' src=$_SESSION[pp] alt='avatar'>";
            echo"</div>";
        echo"</a>";
        echo"<div id='popup' class='overlay'>";
            echo"<div class='selection_pp'>";
                echo"<a class='close_button' href='#'>&times;</a>";
                foreach($liste as $data){
                    echo"<img class='liste_pp' src='$data[chemin]' alt='pp'>";
                }
            echo"</div>";
        echo"</div>";
    echo"</section>";
}

?>