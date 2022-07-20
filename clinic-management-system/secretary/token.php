<?php
    require_once("../connection.php");

    session_start();
    if(!isset($_SESSION['system-login'])){
        header("Location:../index.php");
        exit();
    }
    
    if(isset($_GET['submit'])){
        $patientId = $_GET['patient-id'];
        //check the patient id
        $sql_2 = "SELECT * FROM `clinic_management_system_db`.`patient_table` WHERE `Id` = $patientId";
        $query_2 = $connect->query($sql_2) or die ($connect->error);
        $row_2 = $query_2->fetch_assoc();
        $total_2 = $query_2->num_rows;

        if($total_2 == 0){
            echo "
                <script>
                    alert('The patient Id is incorrect!');
                    window.location.href='token.php';
                </script>;
                ";

        }else{
            $name = $_GET['name'];
            $doctorId = $_GET['doctor-id'];
            $date = $_GET['date'];
            $sql = "INSERT INTO `clinic_management_system_db`.`token_table`(`Patient Id`, `Name`, `Doctor`, `Date`) 
                    VALUES ('$patientId','$name','$doctorId','$date')";
            $query = $connect->query($sql) or die ($connect->error);
            echo "
                    <script>
                        alert('New patient has been added in the list!');
                        window.location.href='token.php';
                    </script>;
                ";
        }
    }
    elseif(isset($_GET['search-id'])){
        $patientId = $_GET['patient-id'];
        $sql_2 = "SELECT * FROM `clinic_management_system_db`.`patient_table` WHERE `Id` = $patientId";
        $query_2 = $connect->query($sql_2) or die ($connect->error);
        $row_2 = $query_2->fetch_assoc();
        $total_2 = $query_2->num_rows;

        if($total_2 == 0){
            echo "
                <script>
                    alert('The patient Id is incorrect!');
                    window.location.href='token.php';
                </script>;
                ";

        }
    }

    $sql = "SELECT * FROM `clinic_management_system_db`.`token_table` ORDER BY `Id` DESC LIMIT 1";
    $query = $connect->query($sql) or die ($connect->error);
    $row = $query->fetch_assoc();
    $total = $query->num_rows;
    $tokenId = 0;

    if($total > 0){
        $tokenId = $row['Id'] + 1;
    }
    elseif($total == 0){
        $tokenId++;
    }


    $sql_1 = "SELECT * FROM `clinic_management_system_db`.`doctor_table`";
    $query_1 = $connect->query($sql_1) or die ($connect->error);
    $row_1 = $query_1->fetch_assoc();
    $total_1 = $query_1->num_rows;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secretary - Management Information System</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/token.css">
</head>
<body>

    <!-- Header and Menu Tab -->
    <?php require_once("header.php"); ?>

    <div class="container">
        <div class="wrapper">

            <div><h3>Create Token</h3></div>

            <div class="form-wrapper">
                <form action="" method="GET">

                    <label for="">Token Id</label>
                    <input type="number" name="token-id" value="<?php echo $tokenId; ?>" disabled> 

                    <label for="">Patient Id</label>
                    <div class="search-id-wrapper">
                        <input class="search-id-input" type="number" name="patient-id" value="<?php if(isset($_GET['search-id']) && $total_2 > 0){echo $row_2['Id'];} ?>" autofocus required>
                        <input id="search-id-button" type="submit" value="Search" name="search-id"/>
                    </div>

                    <label for="">Name</label>
                    <input id="name-input" type="text" name="name" value="<?php if(isset($_GET['search-id']) && $total_2 > 0){echo $row_2['Name'];} ?>">

                    <label for="">Doctor</label>
                    <select name="doctor-id" id="">
                        <?php 
                            if($total_1 > 0){
                                do{
                        ?>
                        <option value="<?php echo $row_1['Id']; ?>"><?php echo $row_1['Name']; ?></option>
                        <?php
                                }while($row_1 = $query_1->fetch_assoc());
                            }
                        ?>
                    </select>

                    <input type="text" name="date" id="date" style="display:none;">

                    <button type="submit" name="submit" onclick="return check()">Submit</button>
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

function check(){
    var name = document.querySelector('#name-input');
    if(name.value.length == 0){
        name.focus();
        return false;
    }
}

const d = new Date();
const n = d.toLocaleDateString();
document.querySelector('#date').value = n;
</script>

</html>