<?php
    session_start();
    if(isset($_POST["deletepiece"])){
        unset($_SESSION[$_POST["deletepiece"]]);
        header("Location: home.php");
    }
?>