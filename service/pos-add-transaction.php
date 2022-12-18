<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'POS';

if (isset($_POST['save-transaction'])) {
    if (isset($_POST['customername'])
        || isset($_POST['paymentoption'])
        || isset($_POST['deliveryoption'])
        || isset($_POST['cashpayment'])
        || isset($_POST['totalamount'])
        || isset($_POST['cashchange'])
        || isset($_POST['note'])) {

        $user_id = $_SESSION['user_user_id'];

        $customer_name = $_POST['customername'];
        $customer_name = filter_var($customer_name, FILTER_SANITIZE_STRING);

        $paymentoption = $_POST['paymentoption'];
        $paymentoption = filter_var($paymentoption, FILTER_SANITIZE_STRING);

        $service = $_POST['deliveryoption'];
        $service = filter_var($service, FILTER_SANITIZE_STRING);

        $cashpayment = $_POST['cashpayment'];
        $cashpayment = filter_var($cashpayment, FILTER_SANITIZE_STRING);

        $cashchange = $_POST['cashchange'];
        $cashchange = filter_var($cashchange, FILTER_SANITIZE_STRING);

        $totalamount = $_POST['totalamount'];
        $totalamount = filter_var($totalamount, FILTER_SANITIZE_STRING);

        $note = $_POST['note'];

        // $status = $_POST['status'];



    
            $insert = mysqli_query($con, "INSERT INTO 'transaction' VALUES(
                             '',
                             '$customer_name', 
                             '', 
                             '', 
                             '', 
                             '', 
                             '$service', 
                             '', 
                             '', 
                             '$totalamount',
                             '$cashchange',
                             '$cashpayment',
                             '$paymentoption',
                             '$note',
                             '',
                             '',
                             '$user_id',
                             '',
                             '',
                             now())");
            if ($insert) {

                if (mysqli_num_rows($select) > 0) {
                    $fetch_data = mysqli_fetch_assoc($select);
                    $fetch_id = $fetch_data['id'];
                    log_audit($con, $user_id, $module, 1, 'Added new transaction with id:' .$fetch_id);
                    header("Location: ../pos/pos-transaction-success.php?success=Transaction Successful!");
                } else {
                    log_audit($con, $user_id, $module, 0, 'Error processing database.');
                    header("Location: ../common/error-page.php?error=" . mysqli_error($con));
                }
            } else {
                log_audit($con, $user_id, $module, 0, 'Error processing database.');
                header("Location: ../common/error-page.php?error=" . mysqli_error($con));
            }
        }
    }


