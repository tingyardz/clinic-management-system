<?php
    require_once("../connection.php");

    session_start();
    if(!isset($_SESSION['system-login'])){
        header("Location:../index.php");
        exit();
    }

    $doctor = $_SESSION['userId'];
    $date = $_SESSION['date'];
    
    $sql = "SELECT * FROM `clinic_management_system_db`.`token_table` WHERE `Doctor` = '$doctor' AND `Date` = '$date'";
    $query = $connect->query($sql) or die ($connect->error);
    $row = $query->fetch_assoc();
    $total = $query->num_rows;

    if(isset($_GET['search'])){
        $patient = $_GET['patient'];
        $sql_0 = "SELECT * FROM `clinic_management_system_db`.`patient_history_table` WHERE `Patient Id` = '$patient' ORDER BY `Id` DESC";
        $query_0 = $connect->query($sql_0) or die ($connect->error);
        $row_0 = $query_0->fetch_assoc();
        $total_0 = $query_0->num_rows;

        if($total_0 == 0){
            echo "
                <script>
                    alert('The patient you have entered has no history!');
                    window.location.href='index.php';
                </script>;
            ";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor - Management Information System</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

    <!-- Header and Menu Tab -->
    <?php require_once("header.php"); ?>

    <div class="container">

        <div class="wrapper">
            <h2>View Patient</h2>
        </div>

        <div class="wrapper1">

            <div class="search-wrapper">
                <form action="">
                    <input type="text" name="patient" placeholder="Enter Patient Id">
                    <button type="submit" name="search">Search</button>
                </form>
            </div>

            <div class="subwrapper">
                <h3>Patient Details</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Patient Id</th>
                            <th>Name</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                        if($total > 0){
                            do{
                    ?>
                        <tr>
                            <td><?php echo $row['Patient Id']; ?></td>
                            <td><?php echo $row['Name']; ?></td>
                        </tr>
                    <?php
                            }while($row = $query->fetch_assoc());
                        }
                    ?>
                    </tbody>
                </table>

            </div>

            <div class="subwrapper1">

                <h3>Patient History</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Disease</th>
                            <th>Medicine</th>
                            <th>Date</th>
                            <th>Doctor</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                        if(isset($_GET['search'])){
                            if($total_0 > 0){
                                do{
                    ?>
                        <tr>
                            <td><?php echo $row_0['Patient Id']; ?></td>
                            <td><?php echo $row_0['Name']; ?></td>
                            <td><?php echo $row_0['Disease']; ?></td>
                            <td><?php echo $row_0['Medicine']; ?></td>
                            <td><?php echo $row_0['Date']; ?></td>
                            <td><?php echo $row_0['Doctor']; ?></td>
                        </tr>
                    <?php
                                }while($row_09 = $query->fetch_assoc());
                            }
                        }
                    ?>
                    </tbody>
                </table>

            </div>

        </div>





    </div>


    
</body>

    <!-- Javascript -->
    <script>
        var inputs = document.querySelectorAll('input');

        for(var i = 0; i < inputs.length; i++){
            inputs[i].addEventListener('focusin', function(){
                this.style = "outline: solid 1px cornflowerblue";
            });
            inputs[i].addEventListener('focusout', function(){
                this.style = "outline: none";
            });
        }
        
        function logout(){
            var permission = window.confirm("Are you sure you want to logout the system?");
            if(permission){
                window.location.href="logout.php";
            }
        }
    </script>

</html>