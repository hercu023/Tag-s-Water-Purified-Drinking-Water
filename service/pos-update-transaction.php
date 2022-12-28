<?php
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'POS';

if (isset($_POST['update-transaction'])) {
    if (isset($_POST['customername'])
        || isset($_POST['totalAmount'])
        || isset($_POST['cashpayment'])
        || isset($_POST['uuid'])
        || isset($_POST['cashbalance'])) {
        
        $transaction_uuid = $_POST['uuid'];
        $user_id = $_SESSION['user_user_id'];

        $customer_name = $_POST['customername'];
        $customer_name = filter_var($customer_name, FILTER_SANITIZE_STRING);

        $cashpayment = $_POST['cashpayment'];
        $cashpayment = filter_var($cashpayment, FILTER_SANITIZE_STRING);

        $cashbalance = $_POST['cashbalance'];
        $cashbalance = filter_var($cashbalance, FILTER_SANITIZE_STRING);

        $totalamount = $_POST['totalAmount'];
        $totalamount = filter_var($totalamount, FILTER_SANITIZE_STRING);

        $previous_balance = $cashbalance;
        $cashchange = $cashpayment - $totalamount;
        $remainingbalance = $cashbalance;
        $unpaid_amount = 0;
        $status = 1;
        
        if($cashpayment < $totalamount){
            $totalbalance = $cashpayment + $cashbalance; 
            if($totalbalance >= $totalamount){
                $unpaid_amount = 0;
                $remainingbalance = $totalbalance - $totalamount;
            }else{
                $unpaid_amount = $totalamount - $totalbalance;
                $remainingbalance = 0;
                $status = 0;
            }
            $update = mysqli_query($con, "UPDATE customers 
                                SET balance = '$remainingbalance' 
                                WHERE id = $customer_name");
            if ($update) {
                $cashchange = 0;
                log_audit($con, $user_id, $module, 1, 'Customer balance adjusted under transaction reference: ' .$transaction_uuid);
            } else {
                log_audit($con, $user_id, $module, 0, 'Error processing database.');
                header("Location: ../common/error-page.php?error=" . mysqli_error($con));
                exit();
            }
        }

        $update_result = mysqli_query($con, "UPDATE transaction SET 
                        updated_at=now(), 
                        updated_by_id='$user_id', 
                        status_id='$status'
                        WHERE transaction.uuid= '$transaction_uuid'");

        if ($update_result) {
            $insert_transaction_history =mysqli_query($con, 
            "INSERT INTO transaction_history 
            VALUES(
            '',
            '$transaction_uuid',
            '$cashpayment',
            '$cashchange',
            '$remainingbalance',
            '$previous_balance',
            '$unpaid_amount',
            '$user_id',
            now()
            )");

            log_audit($con, $user_id, $module, 1, 'Updated transaction with transaction reference:' . $transaction_uuid);
            header("Location: ../pos/point-of-sales.php");
        } else {
            log_audit($con, $user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=" . mysqli_error($con));
        }
    }
}

if (isset($_POST['monitoring-update-transaction'])) {
    if (isset($_POST['customername'])
        || isset($_POST['totalAmount'])
        || isset($_POST['cashpayment'])
        || isset($_POST['uuid'])
        || isset($_POST['cashbalance'])) {
        
        $transaction_uuid = $_POST['uuid'];
        $user_id = $_SESSION['user_user_id'];

        $customer_name = $_POST['customername'];
        $customer_name = filter_var($customer_name, FILTER_SANITIZE_STRING);

        $cashpayment = $_POST['cashpayment'];
        $cashpayment = filter_var($cashpayment, FILTER_SANITIZE_STRING);

        $cashbalance = $_POST['cashbalance'];
        $cashbalance = filter_var($cashbalance, FILTER_SANITIZE_STRING);

        $totalamount = $_POST['totalAmount'];
        $totalamount = filter_var($totalamount, FILTER_SANITIZE_STRING);

        $previous_balance = $cashbalance;
        $cashchange = $cashpayment - $totalamount;
        $remainingbalance = $cashbalance;
        $unpaid_amount = 0;
        $status = 1;
        
        if($cashpayment < $totalamount){
            $totalbalance = $cashpayment + $cashbalance; 
            if($totalbalance >= $totalamount){
                $unpaid_amount = 0;
                $remainingbalance = $totalbalance - $totalamount;
            }else{
                $unpaid_amount = $totalamount - $totalbalance;
                $remainingbalance = 0;
                $status = 0;
            }
            $update = mysqli_query($con, "UPDATE customers 
                                SET balance = '$remainingbalance' 
                                WHERE id = $customer_name");
            if ($update) {
                $cashchange = 0;
                log_audit($con, $user_id, $module, 1, 'Customer balance adjusted under transaction reference: ' .$transaction_uuid);
            } else {
                log_audit($con, $user_id, $module, 0, 'Error processing database.');
                header("Location: ../common/error-page.php?error=" . mysqli_error($con));
                exit();
            }
        }

        $update_result = mysqli_query($con, "UPDATE transaction SET 
                        updated_at=now(), 
                        updated_by_id='$user_id', 
                        status_id='$status'
                        WHERE transaction.uuid= '$transaction_uuid'");

        if ($update_result) {
            $insert_transaction_history =mysqli_query($con, 
            "INSERT INTO transaction_history 
            VALUES(
            '',
            '$transaction_uuid',
            '$cashpayment',
            '$cashchange',
            '$remainingbalance',
            '$previous_balance',
            '$unpaid_amount',
            '$user_id',
            now()
            )");

            log_audit($con, $user_id, $module, 1, 'Updated transaction with transaction reference:' . $transaction_uuid);
            header("Location: ../monitoring/monitoring-point-of-sales-transaction.php");
        } else {
            log_audit($con, $user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=" . mysqli_error($con));
        }
    }
}



