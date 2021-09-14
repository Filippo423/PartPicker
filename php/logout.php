<?php
    if(!isset($_SESSION["nomeutente"])){
        header("Location: login.php");
    }
    session_destroy();
    header("Location: login1.php");
?>