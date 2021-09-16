<?php
    session_start();
    if(!isset($_SESSION["nomeutente"])){
        header("Location: login.php");  
    }
    $connection = new mysqli("localhost","root","","pc");

    if(isset($_POST["chosenmobo"])){
        $query = "SELECT * FROM `mobo` WHERE `mobo`.`name` = '$_POST[chosenmobo]'";
        $result = $connection->query($query);

        if ($result->num_rows != 0){
            $_SESSION["mobo"] = $result->fetch_assoc();
            //var_dump($_SESSION["mobo"]);
            header("Location: home.php");
        }

    }else if(isset($_SESSION["cpu"]) && isset($_SESSION["ram"])){
        $memFreq = $_SESSION["ram"]["frequency"];
        $memType = $_SESSION["ram"]["type"];
        $socket = $_SESSION["cpu"]["socket"];

        $query = "SELECT * FROM `mobo` WHERE `mobo`.`max_mem_freq` >= '$memFreq' AND `mobo`.`memory_type` = '$memType' AND `mobo`.`socket` = '$socket'";

    }else if(isset($_SESSION["cpu"])){
        //$memFreq = $_SESSION["cpu"][3];
        $memType = $_SESSION["cpu"]["memory_type"];

        //$query = "SELECT * FROM `mobo` WHERE `mobo`.`memory_type` = '$memType' AND `mobo`.`max_mem_freq` >= '$minMemFreq'";
        $query = "SELECT * FROM `mobo` WHERE `mobo`.`memory_type` = '$memType'";

    }else if(isset($_SESSION["ram"])){
        $memFreq = $_SESSION["ram"]["frequency"];
        $memType = $_SESSION["ram"]["type"];

        $query = "SELECT * FROM `mobo` WHERE `mobo`.`memory_type` = '$memType' AND `mobo`.`max_mem_freq` >= '$memFreq'";

    }else{
        $query = "SELECT * FROM `mobo` WHERE `mobo`.`name` IS NOT NULL";
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOBOs</title>
</head>
<body>
    <table>
        <?php
            $result = $connection->query($query);

            if ($result->num_rows != 0){
                echo "<table border>";
                echo "<tr>";
                echo "<th>nome</th>";
                echo "<th>socket</th>";
                echo "<th>memory type</th>";
                echo "<th>memory frequency</th>";
                echo "</tr>";
    
                while($row = $result->fetch_array()){
                    echo "<tr>";
                    echo "<td>$row[name]</td>";
                    echo "<td>$row[socket]</td>";
                    echo "<td>$row[memory_type]</td>";
                    echo "<td>$row[max_mem_freq]</td>";

                    ?>
				    <td>
					    <form action="mobolist.php" method="post">
						    <input type="hidden" name="chosenmobo" value="<?php echo $row['name'] ?>">
						    <input type="submit" value="ADD">
					    </form>
				    </td>
				<?php
                }
                echo "</tr>";
                echo "</table>";
            }
        ?>
    </table>
</body>
</html>