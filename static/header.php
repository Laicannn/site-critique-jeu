<head>
    <link rel="stylesheet" type="text/css" href="styles/style_static.css">
</head>
<header>
    <a id="banner" href="index.php">
        <div id="logo">
            <img    src ="images/logos/logo_element.svg"
                    alt="element logo"/>
        </div>
        <h1> trikite </h1>
    </a>
    <?php
        if (isset($_SESSION['logged']) && $_SESSION['logged'] === true){
            echo '<div class="double_button">';
                echo'<a id="account_button" href="account.php"><img src="images/bouton_compte.png"></a>';
                echo '<a id="disconnect_button" href="php/logout.php"><img src="images/bouton_disconnect.png"></a>';
            echo'</div>';
        }
        else{
            if (!(str_ends_with($_SERVER['REQUEST_URI'], 'connection.php')) && !(str_ends_with($_SERVER['REQUEST_URI'], '?msg=erreur'))){
                echo '<a id="connection_button" href="connection.php"><img src="images/bouton_connect.png"></a>';
            }
        }
    ?>
</header>