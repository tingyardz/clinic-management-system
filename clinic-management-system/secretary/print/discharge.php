<?php
    require_once("../../connection.php");

    if(isset($_GET['print-receipt'])){
        $patientId = $_GET['patient-id'];
        $date = $_GET['date'];

        $sql = "SELECT * FROM `clinic_management_system_db`.`patient_billing_table` WHERE `Patient Id` = '$patientId' AND `Date` = '$date'";
        $query = $connect->query($sql) or die ($connect->error);
        $row = $query->fetch_assoc();
        $total = $query->num_rows;

    }

    $totalAmount = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="discharge.css">
</head>
<body>

<div class="container">
    <div class="wrapper">
        <h2 style="text-align:center;">Golden City Medical Clinic</h2>
        <div style="margin-top: 32px">
            <h4 style="display:inline-block;">Name: <u><?php if(isset($_GET['print-receipt']) && $total > 0){echo $row['Name'];} ?></u></h4>
            <h4 style="display:inline-block;margin-left:58px;">Date: <u><?php if(isset($_GET['print-receipt']) && $total > 0){echo $row['Date'];} ?></u></h4>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Particular</th>
                    <th>Amount</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    if(isset($_GET['print-receipt']) && $total > 0){
                        do{
                            $totalAmount = $totalAmount + $row['Cost'];

                ?>
                <tr>
                    <td><?php echo $row['Particular']; ?></td>
                    <td><?php echo '₱'.$row['Cost']; ?></td>
                </tr>

                <?php
                        }while($row = $query->fetch_assoc());
                    }
                ?>

                <tr>
                    <td></td>
                    <td><strong>Total Amount:</strong> <?php echo '₱'.$totalAmount; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


    
</body>

    <script>
        window.print();
        setTimeout(() => {
            window.close();
        }, 1000);
    </script>

</html>