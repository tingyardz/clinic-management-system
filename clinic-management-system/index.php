<?php
    require_once("connection.php");
    require_once("create.php");

    //create Database
        $create->database($connect);

    //create TokenTable
        $create->tokenTable($connect);

    //Create doctor table
        $create->doctorsTable($connect);

    //Create secretary table
        $create->secretaryTable($connect);

    //Create patient table
        $create->patientsTable($connect);

    //Create patient history table
        $create->patientsHistoryTable($connect);

    //Create admin table
        $create->adminTable($connect);

    //Create Patient Billing Table
        $create->patient_billing_table($connect);

    if(isset($_POST['login'])){

        $userId = $_POST['userId'];
        $password = $_POST['password'];
        $type = $_POST['type'];
        $error = false;

        if($type == "admin"){

            $sql = "SELECT * FROM `clinic_management_system_db`.`admin_table`";
            $query = $connect->query($sql) or die ($connect->error);
            $row = $query->fetch_assoc();
            $admin_userId = $row['Id'];
            $admin_password = $row['Password'];


            if($userId == "$admin_userId" && $password == "$admin_password"){
                session_start();
                $_SESSION['system-login'] = true;
                $_SESSION['user'] = "admin";
                header("Location:admin");
                exit();
            }
            else{
                $error = true;
            }
        }
        elseif($type == "secretary"){

            $sql = "SELECT * FROM `clinic_management_system_db`.`secretary_table` WHERE `Id` = '$userId' AND `Password` = '$password'";
            $query = $connect->query($sql) or die ($connect->error);
            $row = $query->fetch_assoc();
            $total = $query->num_rows;

            if($total == 1){
                session_start();
                $_SESSION['system-login'] = true;
                $_SESSION['user'] = "secretary";
                $_SESSION['userId'] = $userId;
                header("Location:secretary");
                exit();
            }
            else{
                $error = true;
            }
        }
        elseif($type == "doctor"){
            $userId = $_POST['userId'];
            $date = $_POST['date'];
            $sql = "SELECT * FROM `clinic_management_system_db`.`doctor_table` WHERE `Id` = '$userId' AND `Password` = '$password'";
            $query = $connect->query($sql) or die ($connect->error);
            $row = $query->fetch_assoc();
            $total = $query->num_rows;

            if($total == 1){
                session_start();
                $_SESSION['system-login'] = true;
                $_SESSION['user'] = "doctor";
                $_SESSION['userId'] = $userId;
                $_SESSION['date'] = $date;
                header("Location:doctor");
                exit();
            }
            else{
                $error = true;
            }
        }


    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Golden City Medical Clinic</title>
    <link rel="stylesheet" href="login.css">
    <script>
        function loginAlert(){
            document.querySelector('#error-alert').style = "display:block;";
            setTimeout(() => {
                document.querySelector('#error-alert').style = "display:none;";
            }, 3000);
        }
    </script>
</head>
<body>

    <div class="container">
        <div class="wrapper">
            <div class="sub-wrapper1">
                <h1>Golden City Medical Clinic</h1>
            </div>

            <div class="sub-wrapper2">
                <h2>Login</h2>
                <h5 id="error-alert">Your User Id or Password is incorrect!</h5>
                <form action="" method="POST">
                    <input style="display:none" id="date-input" type="text" name="date">
                    <label for="">User Id</label>
                    <input type="text" name="userId" required>

                    <label for="">Password</label>
                    <input type="password" name="password">

                    <label for="">Type</label>
                    <select name="type" id="">
                        <option value="admin" selected>Admin</option>
                        <option value="secretary">Secretary</option>
                        <option value="doctor">Doctor</option>
                    </select>

                    <button type="submit" name="login">Login</button>
                </form>
            </div>

        </div>
    </div>

    <?php
        if(isset($_POST['login'])){
            if($error){
                echo "
                    <script>
                        loginAlert();
                    </script>
                ";
            }
        }
    ?>

</body>

    <script>
        var d = new Date();
        var n = d.toLocaleDateString();
        document.getElementById('date-input').value = n;
    </script>

</html>