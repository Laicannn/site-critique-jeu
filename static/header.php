<head>
    <link rel="stylesheet" type="text/css" href="styles/style_static.css">
</head>
<header>
    <a href="index.php">
        <div id="logo">
            <img    src ="images/logo_element.png"
                    alt="element logo"/>
        </div>
        <h1> trikite </h1>
    </a>
    <div id="connection_button">
        <?php
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
                echo '<a href="connection.php"><img src="images/bouton_connect.png"></a>';
            }
        ?>
     </div>
</header>