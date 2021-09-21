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
    <link rel="stylesheet" href="../css/header&footer.css">
    <link rel="stylesheet" href="../css/home.css">
    <script src="../Javascript/home.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Build Your PC</title>
</head>
<body>
    <section id="section_header">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div id="welcome">Welcome Back <?php echo $_SESSION["nomeutente"] ?></div>
                </div>
                <div class="col-sm-1">
                    <input type="button" value="Login" class="button">
                </div>
                <div class="col-sm-1">
                    <input type="button" value="Register" class="button">
                </div>
                <div class="col-sm-1">
                    <input type="button" value="Logout" class="button">
                </div>
            </div>
        </div>
    </section>
    <br>
    <section>
        <div class="container">
            <div class="row"><!-- apertura riga -->
                <?php
                if(!isset($_SESSION["cpu"])){
                ?>
                <div class='d-grid gap-2 col-10 mx-auto'>
                <button class='btn-primary btn-lg' onclick="goToCpu()">Add CPU</button>
                </div>
            </div><!-- chiusura riga riga -->
            <?php               
            }else{
            ?>
                <div class="col-sm-2 table_up_list">
                    <p class="list_par">Component</p>
                </div>
                <div class='col-sm-2 table_up_list'><p class='list_par'>Name</p></div>
                <div class='col-sm-2 table_up_list'><p class='list_par'>Socket</p></div>
                <div class='col-sm-2 table_up_list'><p class='list_par'>Memory type</p></div>
                <div class='col-sm-2 table_up_list table_end_list'><p class='list_par'>Memory frequency</p></div>
                <div class='col-sm-2'>
					<form action='delete.php' method='post'>
						<input type='hidden' name='deletepiece' value='cpu'>
						<input class="btn btn-danger" type='submit' value='X'>
					</form>
                </div>
            </div><!-- chiusura riga -->   
            <div class='row'><?php
                $cpuInfo = array_values($_SESSION["cpu"]);
                echo "<div class='col-sm-2 table_down_list'><p class='cont_par'>CPU</p></div>";
                for($i=0; $i<count($cpuInfo)-1; $i++){
                    echo "<div class='col-sm-2 table_down_list'> <p class='cont_par'>".$cpuInfo[$i]."</p></div>";
                }
                echo "<div class='col-sm-2 table_down_list table_end_list'> <p class='cont_par'>".$cpuInfo[count($cpuInfo)-1]."</p></div>";
            }
            ?>
            </div>
    </section>
    <hr>
    <br>

    <section>
        <div class="container">
            <div class="row"><!-- apertura riga -->
                <?php
                if(!isset($_SESSION["mobo"])){
                ?>
                <div class='d-grid gap-2 col-10 mx-auto'>
                <button class='btn-primary btn-lg' onclick="goToMobo()">Add Motherboard</button>
                </div>
            </div><!-- chiusura riga -->
            <?php
            }else{
                ?>
                <div class="col-sm-2 table_up_list">
                    <p class="list_par">Component</p>
                </div>
                <div class='col-sm-2 table_up_list'><p class='list_par'>Name</p></div>
                <div class='col-sm-2 table_up_list'><p class='list_par'>Socket</p></div>
                <div class='col-sm-2 table_up_list'><p class='list_par'>Memory type</p></div>
                <div class='col-sm-2 table_up_list table_end_list'><p class='list_par'>Memory frequency</p></div>
                <div class='col-sm-2'>
					<form action='delete.php' method='post'>
						<input type='hidden' name='deletepiece' value='mobo'>
						<input class="btn btn-danger" type='submit' value='X'> 
					</form>
                </div>
            </div><!-- chiusura riga -->
            <?php
            echo "<div class='row'>";
            $moboInfo = array_values($_SESSION["mobo"]);
            echo "<div class='col-sm-2 table_down_list'><p class='cont_par'>Mobo</p></div>";
            for($i=0; $i<count($moboInfo)-1; $i++){
                echo "<div class='col-sm-2 table_down_list'><p class='cont_par'>".$moboInfo[$i]."</p></div>";
            }
            echo "<div class='col-sm-2 table_down_list table_end_list'> <p class='cont_par'>".$moboInfo[count($moboInfo)-1]."</p></div>";
        }
        ?>
        </div>
    </section>
    <hr>
    <br>
    <section>
        <div class="container">
            <div class="row"><!-- apertura riga -->
                <?php
                if(!isset($_SESSION["ram"])){
                ?>
                <div class='d-grid gap-2 col-10 mx-auto'>
                    <button class='btn-primary btn-lg' onclick="goToRam()">Add RAM</button>
                </div>
            </div><!-- chiusura riga -->
            <?php
            }else{
                ?>
                <div class="col-sm-2 table_up_list" >
                    <p class="list_par">Component</p>
                </div>
                <div class='col-sm-2 table_up_list'><p class='list_par'>Name</p></div>
                <div class='col-sm-2 table_up_list'><p class='list_par'>Type</p></div>
                <div class='col-sm-2 table_up_list table_end_list'><p class='list_par'>Frequency</p></div>
                <div class='col-sm-2'>
				    <form action='delete.php' method='post'>
					    <input type='hidden' name='deletepiece' value='ram'>
					    <input class="btn btn-danger"type='submit' value='X'>
				    </form>
                </div>
            </div><!-- chiusura riga -->
            <?php    
                echo "<div class='row'>";
                $ramInfo = array_values($_SESSION["ram"]);
                echo "<div class='col-sm-2 table_down_list'><p class='cont_par'>RAM</p></div>";
                for($i=0; $i<count($ramInfo)-1; $i++){
                    echo "<div class='col-sm-2 table_down_list'> <p class='cont_par'>".$ramInfo[$i]."</p></div>";
                }
                echo "<div class='col-sm-2 table_down_list table_end_list'> <p class='cont_par'>".$ramInfo[count($ramInfo)-1]."</p></div>";
            }
            ?>
        </div>
    </section>
</body>
</html>