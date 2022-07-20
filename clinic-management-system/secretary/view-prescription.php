<?php
    require_once("../connection.php");

    // session_start();
    // if(!isset($_SESSION['system-login'])){
    //     header("Location:../index.php");
    //     exit();
    // }
    $total = 0;
    if(isset($_GET['search-id'])){
        $patientId = $_GET['patient-id'];
        $sql = "SELECT * FROM `clinic_management_system_db`.`patient_history_table` WHERE `Patient Id` = '$patientId' ORDER BY `Id` DESC LIMIT 1";
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secretary - Management Information System</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/view-prescription.css">
</head>
<body>

    <!-- Header and Menu Tab -->
    <?php require_once("header.php"); ?>

    <div class="container">
        <div class="wrapper">

            <div><h3>View Prescription</h3></div>

            <div class="form-wrapper">

                <form action="" method="GET">

                    <label for="">Patient Id</label>
                    <div class="search-id-wrapper">
                        <input class="search-id-input" type="number" name="patient-id" value="<?php if(isset($_GET['search-id'])){echo $row['Patient Id'];} ?>" required>
                        <input id="search-id-button" type="submit" value="Search" name="search-id"/>
                    </div>
                    <label for="">Name</label>
                    <input disabled type="text" name="Name" value="<?php if(isset($_GET['search-id'])){echo $row['Name'];} ?>">

                    <label for="">Desease</label>
                    <input disabled type="text" name="desease" value="<?php if(isset($_GET['search-id'])){echo $row['Disease'];} ?>">

                    <label for="">Prescription</label>
                    <textarea disabled rows="10"><?php if(isset($_GET['search-id'])){echo $row['Medicine'];} ?></textarea>

                </form>

                    <div>
                        <a href="view-prescription.php"><button><i class="fa-solid fa-trash-can"></i> Clear</button></a>
                        <button onclick="window.open('print/view-prescription.php?patient-id=<?php if(isset($_GET['search-id'])){echo $row['Patient Id'];} ?>','','width=750,height=500')"><i class="fa-solid fa-print"></i> Print</button>
                    </div>

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
function logout(){
    var permission = window.confirm("Are you sure you want to logout the system?");
    if(permission){
        window.location.href="logout.php";
    }
}
</script>

</html>