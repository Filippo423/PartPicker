<?php
    session_start();
    if(isset($_POST['password']) && isset($_POST['nomeutente']) && strlen(trim($_POST['nomeutente'])) > 0 && strlen(trim($_POST['nomeutente'])) > 0){
        $nome = $_POST["nomeutente"];
        $password = $_POST["password"];

        $connection = new mysqli("localhost","root","","utenti");
        $query = "SELECT * FROM `utente` WHERE utente.nome = '$nome' AND utente.password = '$password'";
        $result = $connection->query($query);

        if($result->num_rows == 1){
            $connection->close();
            $_SESSION["nomeutente"] = $_POST["nomeutente"];
            header("Location: home.php");
        }else{
            $query = "SELECT * FROM `utente` WHERE utente.nome = '$nome'";
            $result = $connection->query($query);

            if($result->num_rows != 1){
                $_POST["erroreNOME"] = "Non registrato";
                unset($_POST["errorePW"]);
            }else{
                $_POST["errorePW"] = "Password errata";
                unset($_POST["erroreNOME"]);
            }
        }
        
    }
?>

<html>
    <head>
        <title>LOGIN</title>
        <link rel="stylesheet" href="../css/loginregister.css">
    </head>

    <body>
        <div id="div_form">
            <form class="form" action="login.php" method="POST">
                <div>
                    <p class="error"><?php echo $_POST["erroreNOME"] ?? "<br>"; ?></p>
                    <label for="nomeutente">NOME UTENTE</label>
                    <br><input autofocus="true" required="true" type="text" name="nomeutente" id="nomeutente" value='<?php echo $_POST["nomeutente"] ?? ""; ?>'>
                </div>
            
                <div>
                    <p class="error"><?php echo $_POST["errorePW"] ?? "<br>"; ?></p>
                    <label for="password">PASSWORD</label>
                    <br><input required="true" type="password" name="password" id="password">
                </div>

                <center><br><input class="btn" id="enter" type="submit" value="LOGIN"></center>
                <center><br><button class="btn" id="register"><a href="register.php">REGISTRATI</a></button></center>
            </form>
        </div>
        
    </body>
</html>
