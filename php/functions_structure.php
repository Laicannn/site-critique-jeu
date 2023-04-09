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
    echo'<section>
        <form action="php/login.php" method="POST" name="register">
            <img src="images/user_image.png" id="user_image">
            <br>
            <label for="username">Identifiant</label>
            <input type="text" name="nom" id="username">
            <label for="password">Mot de passe</label>
            <input type="password" name="mdp" id="password">
            <input type="submit" value="se connecter" id="bouton_submit">
        </form>
    </section>';
}

?>