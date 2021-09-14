<?php
    session_start();
    if(!isset($_SESSION["nomeutente"])){
        header("Location: login.php");
    }
    if(isset($_POST["deletepiece"])){
        unset($_SESSION[$_POST["deletepiece"]]);
        header("Location: home.php");
    }
?>