<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'POS';

if (isset($_POST['save-transaction'])) {
    if (isset($_POST['customername'])
        || isset($_POST['option'])
        || isset($_POST['totalAmount'])
        || isset($_POST['paymentoption'])
        || isset($_POST['serviceoption'])
        || isset($_POST['cashpayment'])
        || isset($_POST['cashbalance'])
        || isset($_POST['note'])
        || isset($_POST['unpaid'])) {
        
        $transaction_uuid = uniqid('', true);
        $user_id = $_SESSION['user_user_id'];

        $customer_name = $_POST['customername'];
        $customer_name = filter_var($customer_name, FILTER_SANITIZE_STRING);

        $paymentoption = $_POST['paymentoption'];
        $paymentoption = filter_var($paymentoption, FILTER_SANITIZE_STRING);

        $service = $_POST['serviceoption'];
        $service = filter_var($service, FILTER_SANITIZE_STRING);

        $cashpayment = $_POST['cashpayment'];
        $cashpayment = filter_var($cashpayment, FILTER_SANITIZE_STRING);

        $cashbalance = $_POST['cashbalance'];
        $cashbalance = filter_var($cashbalance, FILTER_SANITIZE_STRING);

        $totalamount = $_POST['totalAmount'];
        $totalamount = filter_var($totalamount, FILTER_SANITIZE_STRING);

        $note = $_POST['note'];
        $cashchange = $cashpayment - $totalamount;
        
        $status = 1;

        if(isset($_POST['unpaid'])){
            if($_POST['unpaid'] == 1){
                $status = 0;
            }
        }

        if($customer_name == 'GUEST'){
            if($cashpayment < $totalamount){
                header("Location: ../pos/point-of-sales-placeorder.php?option=".$_POST['option'].'&totalAmount=' .$_POST['totalAmount']. "&error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Insufficient Cash Amount.");
                exit();
            }
        }else{
            if($cashpayment < $totalamount){
                $totalbalance = $cashpayment + $cashbalance; 
                if(!isset($_POST['unpaid']) && $totalbalance < $totalamount){
                        header("Location: ../pos/point-of-sales-placeorder-unpaid-confirm.php?option=".$_POST['option'].'&totalAmount='.$_POST['totalAmount'].'&paymentoption='.$_POST['paymentoption'].'&serviceoption='.$_POST['serviceoption'].'&cashpayment='.$_POST['cashpayment'].'&cashbalance='.$_POST['cashbalance'].'&customername='.$_POST['customername'].'&note='.$_POST['note']);
                        exit();
                }else{
                    $remainingbalance = $totalbalance - $totalamount;
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
            }
        }

            $insert = mysqli_query($con, "INSERT INTO transaction VALUES(
                             '',
                             '$transaction_uuid',
                             '$customer_name', 
                             '$service', 
                             '$totalamount',
                             '$cashchange',
                             '$cashpayment',
                             '$paymentoption',
                             '$note',
                             '$status',
                             '$user_id',
                             '$user_id',
                             now(),
                             now())");
            if ($insert) {
                $update_ordersummary = mysqli_query($con, 
                "UPDATE transaction_process 
                SET transaction_id = '$transaction_uuid'
                WHERE user_id = '$user_id'");
                if($update_ordersummary){
                    log_audit($con, $user_id, $module, 1, 'Added new transaction with transaction reference:' . $transaction_uuid);
                    header("Location: ../pos/pos-transaction-success.php?success=Transaction Successful!");
                }else{
                    log_audit($con, $user_id, $module, 0, 'Error processing database.');
                    header("Location: ../common/error-page.php?error=" . mysqli_error($con));
                }
            
            } else {
                log_audit($con, $user_id, $module, 0, 'Error processing database.');
                header("Location: ../common/error-page.php?error=" . mysqli_error($con));
            }
        }
    }


