<?php

    require_once("../connection.php");

    session_start();
    if(!isset($_SESSION['system-login'])){
        header("Location:../index.php");
        exit();
    }
    
    if(isset($_POST['submit'])){
        $oldPassword = $_POST['old-password'];
        $newPassword = $_POST['new-password'];
        $retypePassword = $_POST['re-type-password'];
        $secretary = $_SESSION['userId'];

        $sql = "SELECT * FROM `clinic_management_system_db`.`secretary_table` WHERE `Id` = '$secretary'";
        $query = $connect->query($sql) or die ($connect->error);
        $row = $query->fetch_assoc();
        $secretary_password = $row['Password'];

        if($oldPassword != $secretary_password){
            echo "
                <script>
                    alert('You have entered incorrect password!');
                    window.location.href='change-password.php';
                </script>
            ";
        }
        elseif($newPassword != $retypePassword){
            echo "
                <script>
                    alert('Please recheck your password!');
                    window.location.href='change-password.php';
                </script>
            ";
        }
        else{
            $sql = "UPDATE `clinic_management_system_db`.`secretary_table` 
                    SET `Password`='$newPassword'";
            $query = $connect->query($sql) or die ($connect->error);

            echo "
                <script>
                    alert('Your password has been updated!');
                    window.location.href='change-password.php';
                </script>
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
    <title>Secretary - Management Information System</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/change-password.css">
</head>
<body>

    <!-- Header and Menu Tab -->
    <?php require_once("header.php"); ?>

    <div class="container">
        <div class="wrapper">

            <div><h3>Change Password</h3></div>

            <div class="form-wrapper">
                <form action="" method="POST">

                    <label for="">Old Password</label>
                    <input type="password" name="old-password">

                    <label for="">New Password</label>
                    <input type="password" name="new-password" required>

                    <label for="">Re-Type Password</label>
                    <input type="password" name="re-type-password" required>

                    <button type="submit" name="submit">Submit</button>
                </form>
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