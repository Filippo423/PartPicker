<?php
    session_start();
    if(!isset($_SESSION["nomeutente"])){
        header("Location: login.php");
    }
    $connection = new mysqli("localhost","root","","pc");

    if(isset($_POST["chosencpu"])){
        $query = "SELECT * FROM `cpu` WHERE `cpu`.`name` = '$_POST[chosencpu]'";
        $result = $connection->query($query);

        if ($result->num_rows != 0){
            $_SESSION["cpu"] = $result->fetch_assoc();
            header("Location: home.php");
        }

    }else if(isset($_SESSION["mobo"]) && isset($_SESSION["ram"])){
        $memFreq = $_SESSION["ram"]["frequency"];
        $memType = $_SESSION["ram"]["type"];
        $socket = $_SESSION["mobo"]["socket"];

        $query = "SELECT * FROM `cpu` WHERE `cpu`.`memory_type` = '$memType' AND `cpu`.`max_mem_freq` >= '$memFreq' AND `cpu`.`socket` = '$socket'";

    }else if(isset($_SESSION["mobo"])){
        //$memFreq = $_SESSION["mobo"][3];
        $memType = $_SESSION["mobo"]["memory_type"];
        $socket = $_SESSION["mobo"]["socket"];

        //$query = "SELECT * FROM `cpu` WHERE `cpu`.`memory_type` = '$memType' AND `cpu`.`max_mem_freq` >= '$memFreq' AND `cpu`.`socket` = '$socket'";
        $query = "SELECT * FROM `cpu` WHERE `cpu`.`memory_type` = '$memType' AND `cpu`.`socket` = '$socket'";

    }else if(isset($_SESSION["ram"])){
        $memFreq = $_SESSION["ram"]["frequency"];
        $memType = $_SESSION["ram"]["type"];

        $query = "SELECT * FROM `cpu` WHERE `cpu`.`memory_type` = '$memType' AND `cpu`.`max_mem_freq` >= '$memFreq'";

    }else{
        $query = "SELECT * FROM `cpu` WHERE `cpu`.`name` IS NOT NULL";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPUs</title>
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
					    <form action="cpulist.php" method="post">
						    <input type="hidden" name="chosencpu" value="<?php echo $row['name'] ?>">
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