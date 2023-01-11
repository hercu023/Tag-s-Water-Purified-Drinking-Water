<?php
include '../database/connection-db.php';
require_once '../service/pos-placeorder.php';

date_default_timezone_set("Asia/Manila");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="../CSS/point-of-sales-receipt.css">
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/outfit" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/galhau-display" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/malberg-trial" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/rajdhani" rel="stylesheet">
    <title>Tag's Water Purified Drinking Water</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<style>
    .customer-name{
        text-transform: uppercase; 
        font-weight: bold;
    }
    .customer-name2{
        text-transform: uppercase; 
        font-size: 10px;
    }
    .container1{
    width: 100%;
    max-width: 180px;
    padding: 8px;
    overflow: auto;
    margin: 0 28px;
    background-color: var(--color-white);
}
.contact1{
    font-size: 14px;
    font-weight: 500;
    font-family: 'Malberg Trial', sans-serif;
    margin-top: -.2rem;
    color: black;
    text-align: left;
}
</style>
<body>

<div class="container">

    <?php
    include('../common/side-menu.php')
    ?>

    <main>
        <div class="main-pos">
            <h1 class="posTitle">EMPLOYEE</h1>
            <?php
            if (isset($_GET['error'])) {
                echo '<p id="myerror" class="error-error"> '.$_GET['error'].' </p>';
            }
            ?>
              
            <!-- </div> -->
    </main>


    <?php
if(isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = mysqli_query($con, "SELECT 
    attendance.id,
    attendance.date,
    attendance.time_in,
    attendance.time_out,
    attendance.deduction,
    attendance.bonus,
    attendance.with_uniform,
    attendance.total_amount,
    attendance.added_by,
    employee.first_name as emp_first_name,
    employee.last_name as emp_last_name,
    employee.middle_name as emp_middle_name,
    position_type.name as position_type,
    users.first_name as usr_first_name,
    users.last_name as usr_last_name
    FROM attendance
    INNER JOIN employee 
    ON attendance.employee_id = employee.id
    INNER JOIN position_type
    ON employee.position_id = position_type.id
    INNER JOIN users
    ON attendance.added_by = users.user_id 
    WHERE attendance.id='$id'");
    if (mysqli_num_rows($result) > 0) {
    $employee = mysqli_fetch_assoc($result);
    ?>
    <form action="" method="post" enctype="multipart/form-data" id="placeorderFrm">
        <div class="bg-placeorderform" id="bg-placeform">
                <a href="../employee/employee-attendance.php" class="close">CANCEL</a>
            <div class="container1">

                <p class="contact1">PAY SLIP<p>

                                           
                <p class="customer-name">Employee Name:<p  class="customer-name2"> <?php echo $employee['emp_first_name'].' '.$employee['emp_middle_name'].' '.$employee['emp_last_name'];?></p></p>
                <br>
                <p class="payment-method">POSITION:<p>
                <p class="payment-method">--<?= $employee['position_type'];?><p>
                <p class="payment-method">DATE OF ATTENDANCE: <p>
                <p class="payment-method">-- <?= $employee['date'];?><p>
                <p class="payment-method">TIME IN:<p>
                <p class="payment-method">--<?= $employee['time_in'];?><p>
                <p class="payment-method">TIME OUT:<p>
                <p class="payment-method">--<?= $employee['time_out'];?><p>
            
                <p class="lineast">*******************************************<p>

                <p class="payment-method">DEDUCTION: P<?= $employee['deduction'];?><p>
                <p class="payment-method">BONUS: P<?= $employee['bonus'];?><p>
                <p class="payment-method">PROCESSED BY: <p>
                <p class="payment-method">--<?= $employee['usr_first_name'].' '.$employee['usr_last_name'];?><p>

                   
                
                        <p class="totalLabel">TOTAL SALARY</p>
                        <br >
                        <p class="totalLabel"><?php echo 'P'.number_format($employee['total_amount'], '2','.',','); ?></p>
                        <br >
                    
            </div>
            <?php
                        }}
                    
                    ?>
            <!-- <p class="totalLabel1">Amount Tendered</p>
                        <p class="totalAmt1"><?php echo 'P'.number_format($transactions1['sum(transaction_process.total_price)'], '2','.',','); ?></p> -->
            <div class="bot-buttons">
                <div class="AddButton1">
                    <button type="submit" id="addcustomerBtn" name="print-pos" onclick="print();">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M15 6H5V3h10Zm-.25 4.5q.312 0 .531-.219.219-.219.219-.531 0-.312-.219-.531Q15.062 9 14.75 9q-.312 0-.531.219Q14 9.438 14 9.75q0 .312.219.531.219.219.531.219Zm-1.25 5v-3h-7v3ZM15 17H5v-3H2V9q0-.833.583-1.417Q3.167 7 4 7h12q.833 0 1.417.583Q18 8.167 18 9v5h-3Z"/></svg>
                        PRINT
                    </button>
                </div>
            </div>
        </div>
       
    </form> 

    <!-- </form> -->
</body>
<script src="../javascript/side-menu-toggle.js"></script>
<!-- <script src="../javascript/top-menu-toggle.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script src="https://code.jquery.com/jquery.min.js"></script>
<!-- <script src="../javascript/point-of-sales.js"></script> -->

</html>
