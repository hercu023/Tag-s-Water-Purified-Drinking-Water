<?php

require "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'MONITORING-CUSTOMER_BALANCE';

if(isset($_POST['add-balance'])) {
    if (isset($_POST['customername'])
        || isset($_POST['balance'])) {

            $user_user_id = $_SESSION['user_user_id'];

            $customer_id = $_POST['customername'];
            $balance = filter_var($_POST['balance'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            
            $get_balance = mysqli_query($con, "SELECT balance 
                                        FROM customers 
                                        WHERE id = '$customer_id'");
            if(mysqli_num_rows($get_balance) > 0) {
                $get_balance_result = mysqli_fetch_assoc($get_balance);
                $current_balance = $get_balance_result['balance'];
                $current_balance = filter_var($current_balance, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            
                $total_balance = $current_balance + $balance;

                $update_balance = mysqli_query($con, "UPDATE customers 
                                                SET balance = '$total_balance'
                                                WHERE id = $customer_id");

                if($update_balance) {
                    log_audit($con, $user_user_id, $module, 1, 'Succesfully added customer balance for customer: '.$customer_id);
                    header("Location: ../monitoring/monitoring-customer-balance-success.php?add_success=Add Balance Successful");
                    exit();
                } else {
                    header("Location: ../common/error-page.php?error=Error updating balance for customer id: ".$customer_id);
                    exit();
                }
            } else {
                header("Location: ../common/error-page.php?error=Error retrieving balance for customer id".$customer_id);
                exit();
            }
    }
}