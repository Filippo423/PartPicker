<?php
    session_start(); 
    if(!isset($_SESSION["nomeutente"])){
        header("Location: login.php");
    }
    $connection = new mysqli("localhost","root","","pc");

    if(isset($_POST["chosenram"])){
        $query = "SELECT * FROM `ram` WHERE `ram`.`name` = '$_POST[chosenram]'";
        $result = $connection->query($query);

        if ($result->num_rows != 0){
            $_SESSION["ram"] = $result->fetch_assoc();
            header("Location: home.php");
        }

    }else{
        if(isset($_SESSION["cpu"]) && isset($_SESSION["mobo"])){
            $maxMemFreq = min($_SESSION["cpu"]["max_mem_freq"], $_SESSION["mobo"]["max_mem_freq"]);
            //echo "$maxMemFreq";
            $memType = $_SESSION["mobo"]["memory_type"];
            //echo "$memType";
            
            $query = "SELECT * FROM `ram` WHERE `ram`.`type` = '$memType' AND `ram`.`frequency` <= '$maxMemFreq'";

        }else if(isset($_SESSION["cpu"])){
            $maxMemFreq = $_SESSION["cpu"]["max_mem_freq"];
            $memType = $_SESSION["cpu"]["memory_type"];

            $query = "SELECT * FROM `ram` WHERE `ram`.`type` = '$memType' AND `ram`.`frequency` <= '$maxMemFreq'";

        }else if(isset($_SESSION["mobo"])){
            $maxMemFreq = $_SESSION["mobo"]["max_mem_freq"];
            $memType = $_SESSION["mobo"]["memory_type"];
            
            $query = "SELECT * FROM `ram` WHERE `ram`.`type` = '$memType' AND `ram`.`frequency` <= '$maxMemFreq'";

        }else{
            $query = "SELECT * FROM `ram` WHERE `ram`.`name` IS NOT NULL";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RAM</title>
</head>
<body>
    <table>
        <?php
            $result = $connection->query($query);

            if ($result->num_rows != 0){
                echo "<table border>";
                echo "<tr>";
                echo "<th>name</th>";
                echo "<th>type</th>";
                echo "<th>frequency</th>";
                echo "</tr>";
    
                while($row = $result->fetch_array()){
                    echo "<tr>";
                    echo "<td>$row[name]</td>";
                    echo "<td>$row[type]</td>";
                    echo "<td>$row[frequency]</td>";

                    ?>
				    <td>
					    <form action="ramlist.php" method="post">
						    <input type="hidden" name="chosenram" value="<?php echo $row['name'] ?>">
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