<?php
    session_start();
    session_unset();
    session_destroy();
    if(!isset($_SESSION["nomeutente"])){
        header("Location: login.php");
    }
    header("Location: home.php");
?>