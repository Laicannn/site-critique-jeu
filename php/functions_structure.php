<?php 

function DisplayJaquette($articles){
    echo "<section>";
        foreach($articles as $data){
            echo "
            <a class='carte' href='article.php?id_article=$data[id_article]'>
                <img src=$data[chemin]>
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

function displayAccount(){
    echo'
    <section>
    </section>';
}

?>