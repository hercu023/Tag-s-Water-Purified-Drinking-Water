<?php
require "../database/connection-db.php";
require_once "../audit/audit-logger.php";

$module = "SETTINGS-DELIVERY_FEE";

if(isset($_POST['add-delivery-settings'])) {
    if(isset($_POST['fee'])
    || isset($_POST['description'])
    ) {

        $fee = $_POST['fee'];
        $description = $_POST['description'];

        $user_user_id = $_SESSION['user_user_id'];

        $insert = mysqli_query($con, "INSERT INTO delivery_fee VALUES(
                        '',
                        '$fee',
                        '$description')");

        if($insert) {
            log_audit($con, $_user_user_id, $module, 1, 'Added delivery fee setting.');
            header("Location: ../settings/settings-delivery-success.php?success=Add Delivery Fee Successful!");
            exit();
        } else {
            log_audit($con, $_user_user_id, $module, 1, 'Error adding delivery fee setting.');
            header("Location: ../settings/settings-delivery-fee.php?error= <i class='fas fa-exclamation-triangle' style='font-size:14px'></i>Failed adding delivery settings. Try again.");
            exit();
        }
    }
}

if(isset($_POST['edit-delivery-settings'])) {
    if(isset($_POST['id'])
    || isset($_POST['fee'])
    || isset($_POST['description'])
    ) {

        $id = $_POST['id'];
        $fee = $_POST['fee'];
        $description = $_POST['description'];

        $user_user_id = $_SESSION['user_user_id'];

        $update = mysqli_query($con, "UPDATE delivery_fee SET
                        fee = '$fee',
                        description = '$description'
                        WHERE id = $id");

        if($update) {
            log_audit($con, $_user_user_id, $module, 1, 'Updated delivery fee setting with id:'.$id);
            header("Location: ../settings/settings-delivery-success.php?success=Update Delivery Fee Successful!");
            exit();
        } else {
            log_audit($con, $_user_user_id, $module, 1, 'Error updating delivery fee setting with id:'.$id);
            header("Location: ../settings/settings-delivery-fee.php?error= <i class='fas fa-exclamation-triangle' style='font-size:14px'></i>Failed updating delivery settings. Try again.");
            exit();
        }
    }
}

if(isset($_POST['remove-delivery-settings'])) {
    if(isset($_POST['id'])) {

        $id = $_POST['id'];
        
        $user_user_id = $_SESSION['user_user_id'];
        
        $delete = mysqli_query($con, "DELETE FROM delivery_fee WHERE id = '$id'");

        if($delete) {
            log_audit($con, $_user_user_id, $module, 1, 'Deleted delivery fee setting with id:'.$id);
            header("Location: ../settings/settings-delivery-success.php?success=Remove Delivery Fee Successful!");
            exit();
        } else {
            log_audit($con, $_user_user_id, $module, 1, 'Error deleting delivery fee setting with id:'.$id);
            header("Location: ../settings/settings-delivery-fee.php?error= <i class='fas fa-exclamation-triangle' style='font-size:14px'></i>Failed updating delivery settings. Try again.");
            exit();
        }
    }
}

?>