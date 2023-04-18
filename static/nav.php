<head>
    <link rel="stylesheet" type="text/css" href="styles/style_static.css">
</head>
<nav>
    
    <?php
    if (str_ends_with($_SERVER['REQUEST_URI'], 'index.php') or str_ends_with($_SERVER['REQUEST_URI'], 'site-critique-jeu/')){
        echo'<form action="php/search.php" method="POST" name="search">
            <input type="text" name="search_query" id="recherche" placeholder="Rechercher">
            <input type="image" src="images/loupe.svg" id="loupe">
        </form>
        <div id="nav">';
            echo'<a href="index.php">AVENTURE</a>';
            echo'<a href="index.php">RPG</a>';
            echo'<a href="index.php">OPEN WORLD</a>';
        echo'</div>
        <aside id="compense"></aside>';
    }
    ?>
</nav>