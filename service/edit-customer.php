<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'CUSTOMER';

if (isset($_POST['edit-customer'])) {
    if(isset($_POST['user_id'])
        || isset($_POST['customer_name'])
        || isset($_POST['address'])
        || isset($_POST['contact_num1'])
        || isset($_POST['contact_num2'])
        || isset($_POST['note'])){

        $user_id = $_SESSION['user_user_id'];

        $customer_id = $_POST['customer_id'];

        $customer_name = $_POST['customer_name'];
        $customer_name = filter_var($customer_name, FILTER_SANITIZE_STRING);

        $address = $_POST['address'];
        $address = filter_var($address, FILTER_SANITIZE_STRING);

        $contact_num1 = $_POST['contact_num1'];
        $contact_num1 = filter_var($contact_num1, FILTER_SANITIZE_STRING);

        $contact_num2 = $_POST['contact_num2'];
        $contact_num2 = filter_var($contact_num2, FILTER_SANITIZE_STRING);

        $note = $_POST['note'];

        $update =mysqli_query($con, "UPDATE customers SET 
                     customer_name='$customer_name', 
                     address='$address', 
                     contact_number1='$contact_num1', 
                     contact_number2='$contact_num2',
                     note='$note'
                 WHERE id='$customer_id'");
        if($update){
            log_audit($con, $user_id, $module, 1, 'Updated customer with id:' .$customer_id);
            header("Location: ../customers/customer-success.php?success=Update Customer Successful!");
        } else {
            log_audit($con, $user_id, $module, 0, 'Customer name cannot be a duplicate');
            header("Location: ../customers/customer.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Customer name cannot be a duplicate");
        }
    }
}
