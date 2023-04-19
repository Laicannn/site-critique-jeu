<head>
    <link rel="stylesheet" type="text/css" href="styles/style_static.css">
</head>
<nav>
    
    <?php
    if (str_contains($_SERVER['REQUEST_URI'], "index.php") or str_ends_with($_SERVER['REQUEST_URI'], 'site-critique-jeu/')){
        echo'<form action="php/search.php" method="POST" name="search">
            <input type="text" name="search_query" id="recherche" placeholder="Rechercher">
            <input type="image" src="images/buttons/loupe.svg" id="loupe">
        </form>
        <div id="nav">';
            if(str_ends_with($_SERVER['REQUEST_URI'], '?categorie=Aventure')){
                echo'<a class="active" href="index.php">AVENTURE</a>';
            } else {echo'<a href="index.php?categorie=Aventure">AVENTURE</a>';}

            if(str_ends_with($_SERVER['REQUEST_URI'], '?categorie=RPG')){
                echo'<a class="active" href="index.php">RPG</a>';
            } else {echo'<a href="index.php?categorie=RPG">RPG</a>';}

            if(str_ends_with($_SERVER['REQUEST_URI'], '?categorie=Openworld')){
                echo'<a class="active" href="index.php">OPEN WORLD</a>';
            } else {echo'<a href="index.php?categorie=Openworld">OPEN WORLD</a>';}

        echo'</div>
        <aside id="compense"></aside>';
    }
    ?>
</nav>