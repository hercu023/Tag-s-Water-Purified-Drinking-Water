<?php 
include '../database/connection-db.php';
if (isset($_POST['print-pos'])) {
    if(isset($_POST['uuid'])
    ||(isset($_POST['totalAmount'])
    ||(isset($_POST['user_id'])))){
        $uuid = $_POST['uuid'];
        header("Location: ../common/error.php?error=".$uuid);
        exit();

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
?>