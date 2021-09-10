<?php
    session_start();
    if(isset($_POST["nomeutente"]) && isset($_POST["password"]) && isset($_POST["password2"])){

        //validazione
        if($_POST["password"] != $_POST["password2"]){
            $_SESSION["errorePW2"] = "Le password non corrispondono";

        }else{
            $nome = $_POST["nomeutente"];
            $password = $_POST["password"];
            $password2 = $_POST["password2"];

            $connection = new mysqli("localhost","root","","utenti");
            $query = "SELECT * FROM `utente` WHERE utente.nome = '$nome'";
            $result = $connection->query($query);

            if($result->num_rows > 0){
                $_SESSION["erroreNOME"] = "utente gia registrato <br> <a class='btn' href='login1.php'>LOGIN</a>";

            }else{
                $query = "INSERT INTO `utente` VALUES ('$nome', '$password')";
                $connection->query($query);
                $_SESSION["successo"] = "registrazione completata <br> <a class='btn' href='login1.php'>LOGIN</a>";
            }

            $connection->close();

            header("HTTP/1.1 303 See Other");
            header("Location: register.php");
            die();
        }
    }
    
?>

<html>
    <head>
        <title>REGISTER</title>
        <link rel="stylesheet" href="loginregister.css">
    </head>

    <body>
        <div id="div_form">
            <form class="form" action="register.php" method="POST">
                <div>
                    <br>
                    <label for="nomeutente">NOME UTENTE</label>
                    <br><input autofocus="true" required="true" type="text" name="nomeutente" id="nomeutente" value='<?php echo $_POST["nomeutente"] ?? ""; ?>'>
                </div>
            
                <div>
                    <br>
                    <label for="password">PASSWORD</label>
                    <br><input required="true" type="password" name="password" id="password"> 
                </div>

                <div>
                    <br>
                    <label for="password2">CONFERMA PASSWORD</label>
                    <br><input required="true" type="password" name="password2" id="password2">
                </div>

                <p><?php
                        if(isset($_SESSION["successo"])){
                            echo $_SESSION["successo"];
                            unset($_SESSION["successo"]);

                        }else if(isset($_SESSION["errorePW2"])){
                            echo $_SESSION["errorePW2"];
                            unset($_SESSION["errorePW2"]);
                        }else if(isset($_SESSION["erroreNOME"])){
                            echo $_SESSION["erroreNOME"];
                            unset($_SESSION["erroreNOME"]);
                        }
                    ?></p>
                <center><br><input class="btn" id="enter" type="submit" value="REGISTRATI"></center>
                
            </form>
        </div>
        
    </body>
</html>