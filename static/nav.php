<head>
    <link rel="stylesheet" type="text/css" href="styles/style_static.css">
</head>
<nav>
    <div id="nav">
        <?php
        if (str_ends_with($_SERVER['REQUEST_URI'], 'index.php')){
            echo'<a href="index.php">AVENTURE</a>';
            echo'<a href="index.php">RPG</a>';
            echo'<a href="index.php">OPEN WORLD</a>';
        }
        ?>
    </div>
</nav>