<?php
    require_once("../../connection.php");

    // session_start();
    // if(!isset($_SESSION['system-login'])){
    //     header("Location:../index.php");
    //     exit();
    // }

    if(isset($_GET['patient-id'])){
        $patientId = $_GET['patient-id'];
        if($patientId > 0){
            $sql = "SELECT * FROM `clinic_management_system_db`.`patient_history_table` WHERE `Patient Id` = '$patientId' ORDER BY `Id` DESC LIMIT 1";
            $query = $connect->query($sql) or die ($connect->error);
            $row = $query->fetch_assoc();

            $name = $row['Name'];
            $disease = $row['Disease'];
            $medicine = $row['Medicine'];
            $date = $row['Date'];
            $doctor = $row['Doctor'];
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print | Prescription</title>
    <link rel="stylesheet" href="view-prescription.css">

</head>
<body onload="window.print()">


    <?php
        if(isset($_GET['patient-id'])){
            if($patientId > 0){
    ?>


    <div class="container">
        <div class="wrapper-page">
            <div class="clinic-name"><h2>Golden City Medical Clinic</h2></div>
            <table>
                <tbody>
                    <tr>
                        <td class="left">Date: </td>
                        <td class="right"><?php echo $date; ?></td>
                    </tr>

                    <tr>
                        <td class="left">Patient Name: </td>
                        <td class="right"><?php echo $name; ?></td>
                    </tr>

                    <tr>
                        <td class="left">Disease: </td>
                        <td class="right"><?php echo $disease; ?></td>
                    </tr>

                    <tr>
                        <td class="left">Prescription: </td>
                        <td class="right"><?php echo $medicine; ?></td>
                    </tr>

                    <tr>
                        <td class="left">Doctor: </td>
                        <td class="right"><?php echo $doctor; ?></td>
                    </tr>
                </tbody>
            </table>

            <div class="sign">___________________________<h4>Authorized Sign & Stamp</h4></div>
        </div>
    </div>

    <?php
            }
        }
    ?>


</body>

    <script>
        window.print();
        setTimeout(() => {
            window.close();
        }, 1000);
    </script>

</html>