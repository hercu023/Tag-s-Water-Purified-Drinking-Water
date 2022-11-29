<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'CUSTOMER';

if (isset($_POST['archive-customer'])) {
    if(isset($_POST['id'])){

        $user_id = $_SESSION['user_user_id'];
        $customer_id = $_POST['id'];

        $result =mysqli_query($con, "UPDATE customers SET status_archive_id = '2' WHERE id = '$customer_id'");
        if($result){
            log_audit($con, $user_id, $module, 1, 'Archived customer with id: '.$customer_id);
            header("Location: customer-success.php?archive_success=Customer Archived Successful");
        } else {
            log_audit($con, $user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=" . mysqli_error($con));
        }
    }
}
