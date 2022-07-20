<?php
    require_once("../connection.php");

    // session_start();
    // if(!isset($_SESSION['system-login'])){
    //     header("Location:../index.php");
    //     exit();
    // }
    if(isset($_GET['submit'])){

        $patientId = $_GET['patient-id'];
        $name = $_GET['name'];
        $desease = $_GET['desease'];
        $prescription = $_GET['prescription'];
        $date = $_GET['date'];
        $doctor = $_GET['doctor'];

        $sql = "INSERT INTO `clinic_management_system_db`.`patient_history_table`(`Patient Id`, `Name`, `Disease`, `Medicine`, `Date`, `Doctor`) 
                VALUES ('$patientId','$name','$desease','$prescription','$date','$doctor')";
        $query = $connect->query($sql) or die ($connect->error);
            echo "
                <script>
                    alert('Successfully added.');
                    window.location.href='add-prescription.php';
                </script>";
    }

    $doctor = "20000000";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor - Management Information System</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/add-prescription.css">
</head>
<body>

    <!-- Header and Menu Tab -->
    <?php require_once("header.php"); ?>

    <div class="container">
        <div class="wrapper">

            <div><h3>Add Prescription</h3></div>

            <div class="form-wrapper">

                <form action="" method="GET">

                    <label for="">Patient Id</label>
                        <input class="search-id-input" type="number" name="patient-id" required>
                    <label for="">Name</label>
                    <input type="text" name="name">

                    <label for="">Desease</label>
                    <input type="text" name="desease">

                    <label for="">Prescription</label>
                    <textarea rows="10" name="prescription"></textarea>

                    <input id="date-input" type="text" name="date" style="display:none;">
                    <input type="text" name="doctor" value="<?php echo $doctor; ?>" style="display:none;">

                    <button type="submit" name="submit">Submit</button>

                </form>


            </div>

        </div>


    </div>
    
</body>

    <!-- Javascript -->
    <script src="js/add-secretary.js"></script>
    <?php
        if(isset($_GET['search-id'])){
    ?>
    <script>document.querySelector('#print').target = "_blank"</script>
    <?php
        }
    ?>

    <script>
        var d = new Date();
        var n = d.toLocaleDateString();
        document.getElementById('date-input').value = n;

        function logout(){
            var permission = window.confirm("Are you sure you want to logout the system?");
            if(permission){
                window.location.href="logout.php";
            }
        }
    </script>

</html>