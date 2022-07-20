<?php
    require_once("../connection.php");

    session_start();
    if(!isset($_SESSION['system-login'])){
        header("Location:../index.php");
        exit();
    }

    $total = 0;
    if(isset($_GET['search-id'])){
        $patientId = $_GET['patient-id'];
        $sql = "SELECT * FROM `clinic_management_system_db`.`patient_table` WHERE `Id` = '$patientId' ";
        $query = $connect->query($sql) or die ($connect->error);
        $row = $query->fetch_assoc();
        $total = $query->num_rows;

        if($total == 0){
            echo "
                <script>
                    alert('You have entered wrong inputs!');
                    window.location.href='view-prescription.php';
                </script>";
        }
    }
    elseif(isset($_GET['add-expenses'])){
        $date = $_GET['date'];
        $patientId = $_GET['patient-id'];
        $name = $_GET['name'];
        $doctor = $_GET['doctor'];
        $particular = $_GET['particular'];
        $costs = $_GET['costs'];

        $sql_1 = "INSERT INTO `clinic_management_system_db`.`patient_billing_table`(`Patient Id`, `Name`, `Doctor`, `Particular`, `Cost`, `Date`) 
                VALUES ('$patientId','$name','$doctor','$particular','$costs','$date')";
        $query_1 = $connect->query($sql_1) or die ($connect->error);
    }

    $sql_0 = "SELECT * FROM `clinic_management_system_db`.`doctor_table`";
    $query_0 = $connect->query($sql_0) or die ($connect->error);
    $row_0 = $query_0->fetch_assoc();
    $total_0 = $query_0->num_rows;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secretary - Management Information System</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/discharge-patient.css">
</head>
<body>

    <!-- Header and Menu Tab -->
    <?php require_once("header.php"); ?>

    <div class="container">
        <div class="wrapper">

            <div><h3>Discharge Patient</h3></div>

            <div class="form-wrapper">

                <form action="" method="GET">

                    <input id="date-input" type="text" style="display:none;" name="date">

                    <label for="">Patient Id</label>
                    <div class="search-id-wrapper">
                        <input id="patient-id" class="search-id-input" type="number" name="patient-id" value="<?php if(isset($_GET['search-id'])){echo $row['Id'];}elseif(isset($_GET['add-expenses'])){echo $patientId;} ?>" required>
                        <input id="search-id-button" type="submit" value="Search" name="search-id"/>
                    </div>

                    <label for="">Name</label>
                    <input type="text" name="name" value="<?php if(isset($_GET['search-id'])){echo $row['Name'];}elseif(isset($_GET['add-expenses'])){echo $name;} ?>">

                    <label for="">Doctor</label>
                    <select name="doctor" id="">
                        <?php
                        if($total_0 > 0){
                            do{
                        ?>
                        <option id="<?php echo $row_0['Id']; ?>" value="<?php echo $row_0['Id']; ?>"><?php echo $row_0['Name']; ?></option>
                        <?php
                            }while($row_0 = $query_0->fetch_assoc());
                        }
                        ?>
                        
                    </select>

                    <div class="expense">
                        <h4>Expense</h4>
                        <div>
                            <label for="">Particular: </label>
                            <input type="text" name="particular" value="">
                        </div>
                        <div>
                            <label for="">Cost: </label>
                            <input type="text" name="costs" value="0">
                        </div>
                        <input id="search-id-button" type="submit" value="Add" name="add-expenses">
                    </div>

                </form>

                    <div>
                        <button onclick="printReceipt()" id="print"><i class="fa-solid fa-print"></i> Print</button>
                    </div>

            </div>

        </div>


    </div>
    
</body>

    <!-- Javascript -->
    <script>
        var d = new Date();
        var n = d.toLocaleDateString();
        document.getElementById('date-input').value = n;

        var doctor = "<?php if(isset($_GET['add-expenses'])){echo $doctor;} ?>";
        if(doctor.length > 0){
            document.getElementById(doctor).selected = true;
        }

        var patientId = document.getElementById('patient-id').value;

        function printReceipt(){
            window.open('print/discharge.php?print-receipt&patient-id='+patientId+'&date='+n,'','width=750,height=500');
        }

        function logout(){
            var permission = window.confirm("Are you sure you want to logout the system?");
            if(permission){
                window.location.href="logout.php";
            }
        }

    </script>

</html>