<?php
    require_once("../connection.php");

    session_start();
    if(!isset($_SESSION['system-login'])){
        header("Location:../index.php");
        exit();
    }
    
    if(isset($_GET['add-secretary'])){
        $name = $_GET['name'];
        $mobile = $_GET['mobile'];
        $address = $_GET['address'];
        $password = "";
        $sql = "INSERT INTO `clinic_management_system_db`.`secretary_table`(`Name`, `Mobile`, `Address`, `Password`) 
                VALUES ('$name','$mobile','$address','$password')";
        $query = $connect->query($sql) or die ($connect->error);
        echo "
                <script>
                    alert('New secretary has been successfully added!');
                    window.location.href='add-secretary.php';
                </script>;
            ";
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
    <link rel="stylesheet" href="css/add-secretary.css">
</head>
<body>

    <!-- Header and Menu Tab -->
    <?php require_once("header.php"); ?>

    <div class="container">
        <div class="wrapper">

            <div><h3>Add Secretary</h3></div>

            <div class="form-wrapper">
                <form action="">

                    <label for="">Name</label>
                    <input type="text" name="name" required> 

                    <label for="">Mobile</label>
                    <input type="text" name="mobile" required>

                    <label for="">Address</label>
                    <input type="text" name="address" required>

                    <button type="submit" name="add-secretary">Add Secretary</button>
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