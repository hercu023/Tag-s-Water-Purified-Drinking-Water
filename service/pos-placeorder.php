<?php
include '../database/connection-db.php';
if (isset($_POST['place-order'])) {
    if(isset($_POST['option'])
    ||(isset($_POST['totalAmount'])
    ||(isset($_POST['user_id'])))){

        $user_id =  $_POST['user_id'];
        $transaction_process = "SELECT *
        FROM transaction_process
        WHERE user_id = '$user_id' 
        AND transaction_id = '0'";
        $transaction_order = mysqli_query($con, $transaction_process);
        if(mysqli_num_rows($transaction_order) > 0)
        {
            header("Location: ../pos/point-of-sales-placeorder.php?option=".$_POST['option'].'&totalAmount=' .$_POST['totalAmount']);
            exit();
        }else{
            header("Location: ../pos/point-of-sales.php?error= <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Order Summary is Empty.");
        }

    }

}

if (isset($_POST['place-order-unpaid'])) {
    if(isset($_POST['uuid'])){
        
        $uuid = $_POST['uuid'];
        $transaction_process = "SELECT *
        FROM transaction
        WHERE uuid = '$uuid' 
        AND status_id = 0";
        $transaction_status = mysqli_query($con, $transaction_process);
        if(mysqli_num_rows($transaction_status) > 0){

            header("Location: ../pos/point-of-sales-placeorder-update.php?uuid=".$_POST['uuid']);
            exit();
        }else{
            header("Location: ../pos/point-of-sales.php?error= <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Cannot Process, Transaction Already Paid.");
        
        }
        

    }

}
if (isset($_POST['monitoring-pos-unpaid'])) {
    if(isset($_POST['uuid'])){
        
        $uuid = $_POST['uuid'];
        $transaction_process = "SELECT *
        FROM transaction
        WHERE uuid = '$uuid' 
        AND status_id = 0";
        $transaction_status = mysqli_query($con, $transaction_process);
        if(mysqli_num_rows($transaction_status) > 0){

            header("Location: ../monitoring/monitoring-point-of-sales-transaction-update.php?uuid=".$_POST['uuid']);
            exit();
        }else{
            header("Location: ../monitoring/monitoring-point-of-sales-transaction.php?error= <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Cannot Process, Transaction Already Paid.");
        
        }
        

    }

}
if (isset($_POST['place-order-unpaid-monitoring'])) {
    if(isset($_POST['uuid'])){
        
        $uuid = $_POST['uuid'];
        $transaction_process = "SELECT *
        FROM transaction
        WHERE uuid = '$uuid' 
        AND status_id = 0";
        $transaction_status = mysqli_query($con, $transaction_process);
        if(mysqli_num_rows($transaction_status) > 0){

            header("Location: ../pos/point-of-sales-placeorder-update.php?uuid=".$_POST['uuid']);
            exit();
        }else{
            header("Location: ../monitoring/monitoring-point-of-sales-transaction.php?error= <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Cannot Process, Transaction Already Paid.");
        
        }
        

    }

}
// header("Location: ../common/error-page.php?error=yes");
//     exit();
?>