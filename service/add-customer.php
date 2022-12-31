<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'CUSTOMER';

if (isset($_POST['save-customer'])) {
    if (isset($_POST['customer_name'])
        || isset($_POST['address'])
        || isset($_POST['contact_num1'])
        || isset($_POST['contact_num2'])
        || isset($_POST['note'])) {

        $user_id = $_SESSION['user_user_id'];

        $customer_name = $_POST['customer_name'];
        $customer_name = filter_var($customer_name, FILTER_SANITIZE_STRING);

        $address = $_POST['address'];
        $address = filter_var($address, FILTER_SANITIZE_STRING);

        $contact_num1 = $_POST['contact_num1'];
        $contact_num1 = filter_var($contact_num1, FILTER_SANITIZE_STRING);

        $contact_num2 = $_POST['contact_num2'];
        $contact_num2 = filter_var($contact_num2, FILTER_SANITIZE_STRING);

        $note = $_POST['note'];

        $status = $_POST['status'];

        $check_query = mysqli_query($con, "SELECT * FROM `customers` WHERE customer_name = '$customer_name'");

        if (mysqli_num_rows($check_query) > 0) {
            log_audit($con, $user_id, $module, 0, 'Validation error: customer name already exist.');
            header("Location: ../customers/customer.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Customer name already exist!");
            exit();
        } else {
            $insert = mysqli_query($con, "INSERT INTO customers VALUES(
                             '',
                             '$customer_name', 
                             '$address', 
                             '$contact_num1', 
                             '$contact_num2', 
                             '$note', 
                             '',
                             '1',
                             '$user_id',
                             now())");
            if ($insert) {
                $select = mysqli_query($con, "SELECT * FROM customers WHERE 
                           customer_name = '$customer_name' AND 
                           status_archive_id = 1");

                if (mysqli_num_rows($select) > 0) {
                    $fetch_data = mysqli_fetch_assoc($select);
                    $fetch_id = $fetch_data['id'];
                    log_audit($con, $user_id, $module, 1, 'Added new customer id:' .$fetch_id);
                    header("Location: ../customers/customer-success.php?success=Add New Customer Successful!");
                    exit();
                } else {
                    log_audit($con, $user_id, $module, 0, 'Failed retrieving customer.');
                    header("Location: ../common/error-page.php?error=".'Something went wrong. Failed retrieving customer information.');
                    exit();
                }
            } else {
                log_audit($con, $user_id, $module, 0, 'Failed adding new customer.');
                header("Location: ../common/error-page.php?error=".'Something went wrong. Failed adding customer to database.');
                exit();
            }
        }
    }
}

