<head>
    <link rel="stylesheet" type="text/css" href="styles/style_static.css">
</head>
<nav>
    <div id="bande">
        <div id="nav">
            <?php
                if (str_ends_with($_SERVER['REQUEST_URI'], 'index.php')){
                    echo"<a class='active' href='index.php'>pokedex</a>";
                }
                else {
                    echo'<a href="index.php">pokedex</a>';
                }
                if (isset($_SESSION['logged']) && $_SESSION['logged'] === true){
                    if (str_ends_with($_SERVER['REQUEST_URI'], 'modify.php')){
                        echo'<a class="active" href="modify.php">modifier</a>';
                    }
                    else {
                        echo'<a href="modify.php">modifier</a>';
                    }
                    echo '<a href="php/logout.php">déconnexion</a>';
                }
                else{
                    if (str_ends_with($_SERVER['REQUEST_URI'], 'connection.php')){
                        echo '<a class="active" href="connection.php">connexion</a>';
                    }
                    else {
                        echo '<a href="connection.php">connexion</a>';
                    }
                }
            ?>
        </div>
    </div>
</nav>