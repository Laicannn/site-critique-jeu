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
            if(isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'],$_SERVER['PHP_SELF'])){
                echo '<div class="double_button">';
                    echo'<a id="account_button" href="account.php"><img src="images/buttons/bouton_compte.png"></a>';
                    echo '<a id="disconnect_button" href="php/logout.php"><img src="images/buttons/bouton_disconnect.png"></a>';
                echo'</div>';
            } else {
                echo '<div class="double_button_anime">';
                    echo'<a id="account_button" href="account.php"><img src="images/buttons/bouton_compte.png"></a>';
                    echo '<a id="disconnect_button" href="php/logout.php"><img src="images/buttons/bouton_disconnect.png"></a>';
                echo'</div>';
            }
            
        }
        else{
            if (!(str_ends_with($_SERVER['REQUEST_URI'], 'connection.php')) && !(str_ends_with($_SERVER['REQUEST_URI'], '?msg=erreur'))){
                if(isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'],$_SERVER['PHP_SELF'])){
                    echo '<a id="connection_button" class="connection_button_class" href="connection.php"><img src="images/buttons/bouton_connect.png"></a>';
                }
                else {
                    echo '<a id="connection_button_anime" class="connection_button_class" href="connection.php"><img src="images/buttons/bouton_connect.png"></a>';
                }
            }
        }
    ?>
</header>