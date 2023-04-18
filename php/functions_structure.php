<?php 

function DisplayJaquette($articles){
    foreach($articles as $data){
        echo "
        <a class='carte' href='article.php?id_article=$data[id_article]'>
            <img src=$data[chemin] alt='jaquette'>
        </a>";
    }
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
                echo"<a class='close_button' href='#'>&times;</a>";
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
        </article>
    ";
    echo"<section>";
    
}

?>