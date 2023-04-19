<?php
$requete = $_POST['search_query'];
header("Location: ../index.php?search=$requete");
?>