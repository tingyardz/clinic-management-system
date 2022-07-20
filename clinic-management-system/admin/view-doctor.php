<?php
    require_once("../connection.php");

    session_start();
    if(!isset($_SESSION['system-login'])){
        header("Location:../index.php");
        exit();
    }
    
    $sql = "SELECT * FROM `clinic_management_system_db`.`doctor_table`";
    $query = $connect->query($sql) or die ($connect->error);
    $row = $query->fetch_assoc();
    $total = $query->num_rows;

    if(isset($_GET['search'])){
        $doctor = $_GET['doctor'];
        $sql = "SELECT * FROM `clinic_management_system_db`.`doctor_table` WHERE `Id` = '$doctor'";
        $query = $connect->query($sql) or die ($connect->error);
        $row = $query->fetch_assoc();
        $total = $query->num_rows;

        if($total == 0){
            echo "
                <script>
                    alert('No doctor in the list!');
                    window.location.href='view-doctor.php';
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
    <title>Admin - Management Information System</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/view-doctor.css">
</head>
<body>

    <!-- Header and Menu Tab -->
    <?php require_once("header.php"); ?>

    <div class="container">

        <div class="wrapper">
            <h2>View Doctor</h2>
        </div>

        <div class="wrapper1">

            <div class="search-wrapper">
                <form action="">
                    <input type="text" name="doctor" placeholder="Enter the doctor's Id">
                    <button type="submit" name="search">Search</button>
                </form>
            </div>

            <div class="subwrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Mobile</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                        if($total > 0){
                            do{
                    ?>
                        <tr>
                            <td><?php echo $row['Id']; ?></td>
                            <td><?php echo $row['Name']; ?></td>
                            <td><?php echo $row['Address']; ?></td>
                            <td><?php echo $row['Mobile']; ?></td>
                        </tr>
                    <?php
                            }while($row = $query->fetch_assoc());
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