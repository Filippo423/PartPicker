<?php
    session_start();
    $connection = new mysqli("localhost","root","","pc");
    if(!isset($_SESSION["nomeutente"])){
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Build Your PC</title>
</head>
<body>
    <div id="welcome">Welcome Back <?php echo $_SESSION["nomeutente"] ?></div>
    <br>
    <div>CPU</div>
    <table border="1">
        <?php
            if(!isset($_SESSION["cpu"])){
                echo "<tr><td><button id='cpubtn'><a href='cpulist.php'>aggiungi CPU</a></button></td></tr>";

            }else{
                echo "<tr><th>name</th>";
                echo "<th>socket</th>";
                echo "<th>memory type</th>";
                echo "<th>memory frequency</th></tr>";
                
                echo "<tr>";
                $cpuInfo = array_values($_SESSION["cpu"]);
                for($i=0; $i<count($cpuInfo); $i++){
                    echo "<td>".$cpuInfo[$i]."</td>";
                }

                ?>
				    <td>
					    <form action="delete.php" method="post">
						    <input type="hidden" name="deletepiece" value="<?php echo "cpu" ?>">
						    <input type="submit" value="X">
					    </form>
				    </td>
				<?php
                echo "</tr>";
            }
        ?>
    </table>
    <hr>
    <br>
    <div>MOTHERBOARD</div>
    <table border="1">
        <?php
            if(!isset($_SESSION["mobo"])){
                echo "<tr><td><button id='mobobtn'><a href='mobolist.php'>aggiungi MOBO</a></button></td></tr>";

            }else{
                echo "<tr><th>name</th>";
                echo "<th>socket</th>";
                echo "<th>memory type</th>";
                echo "<th>memory frequency</th></tr>";
                
                echo "<tr>";
                $moboInfo = array_values($_SESSION["mobo"]);
                for($i=0; $i<count($moboInfo); $i++){
                    echo "<td>".$moboInfo[$i]."</td>";
                }
                ?>
				    <td>
					    <form action="delete.php" method="post">
						    <input type="hidden" name="deletepiece" value="<?php echo "mobo" ?>">
						    <input type="submit" value="X">
					    </form>
				    </td>
				<?php
                echo "</tr>";
            }
        ?>
    </table>
    <hr>
    <br>
    <div>RAM</div>
    <table border="1">
        <?php
            if(!isset($_SESSION["ram"])){
                echo "<tr><td><button id='rambtn'><a href='ramlist.php'>aggiungi RAM</a></button></td></tr>";

            }else{
                echo "<tr><th>name</th>";
                echo "<th>type</th>";
                echo "<th>frequency</th></tr>";
                
                echo "<tr>";
                $ramInfo = array_values($_SESSION["ram"]);
                for($i=0; $i<count($ramInfo); $i++){
                    echo "<td>".$ramInfo[$i]."</td>";
                }
                ?>
				    <td>
					    <form action="delete.php" method="post">
						    <input type="hidden" name="deletepiece" value="<?php echo "ram" ?>">
						    <input type="submit" value="X">
					    </form>
				    </td>
				<?php
                echo "</tr>";
            }
        ?>
    </table>

</body>
</html>