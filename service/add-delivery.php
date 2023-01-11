<?php
require_once "../database/connection-db.php";
require_once "../service/validate-stock-quantity.php";
require_once "../audit/audit-logger.php";
$module = 'MONITORING-DELIVERY_PICKUP';
if(isset($_POST['print-delivery'])) {
    if(isset($_POST['delivery_boy'])) {
        $delivery_boy_id = $_POST['delivery_boy'];
        header("Location: ../monitoring/monitoring-delivery-pickup-list-receipt.php?delivery_boy_id=".$delivery_boy_id);
        exit();
    }
}
if(isset($_POST['add-for-pickup'])) {
    if(isset($_POST['uuid'])) {
       
        $user_id = $_SESSION['user_user_id'];
        $uuid = $_POST['uuid'];
      
        $insert = mysqli_query($con, "INSERT INTO delivery_list VALUES(
                '',
                '$uuid',
                '4',
                '$user_id',
                '0',
                now())");

        if($insert){
            log_audit($con, $user_id, $module, 1, 'Transaction added to For Pick up. Reference: '.get_transaction_id($con, $uuid));
            header("Location: ../monitoring/monitoring-delivery-pickup.php?success=<i class='fa fa-check' style='font-size:14px'></i> Transaction added to For Pick Up.");
            exit();
        } else {
            log_audit($con, $user_id, $module, 0, 'Failed adding transaction to For Pick Up. Reference: '.get_transaction_id($con, $uuid));
            header("Location: ../monitoring/monitoring-delivery-pickup.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed transaction update. Try again.");
            exit();
        }
    }
}

if(isset($_POST['add-to-ongoing-pickup'])) {
    if(isset($_POST['uuid']) ||isset($_POST['delivery_boy'])) {
    
        $user_id = $_SESSION['user_user_id'];
        $uuid = $_POST['uuid'];
        $delivery_boy = $_POST['delivery_boy'];
   
        $update = mysqli_query($con, "UPDATE delivery_list SET 
            delivery_status = '5',
            delivery_boy_id = '$delivery_boy',
            updated_at = now()
            WHERE user_id = '$user_id'
            AND uuid = '$uuid'
            AND delivery_status = '4'");

        if($update){
            log_audit($con, $user_id, $module, 1, 'Transaction updated to Ongoing Pick Up. Reference: '.get_transaction_id($con, $uuid));
            header("Location: ../monitoring/monitoring-delivery-pickup-list.php?success=<i class='fa fa-check' style='font-size:14px'></i> Transaction update to Ongoing Pick Up.");
            exit();
        } else {
            log_audit($con, $user_id, $module, 0, 'Failed transaction update to Ongoing Pick Up. Reference: '.get_transaction_id($con, $uuid));
            header("Location: ../monitoring/monitoring-delivery-pickup-list.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed transaction update. Try again.");
            exit();
        }
    }
}

if(isset($_POST['add-as-already-pickup'])) {
    if(isset($_POST['uuid'])) {
            
        $user_id = $_SESSION['user_user_id'];
        $uuid = $_POST['uuid'];
            
        $delete = "DELETE FROM delivery_list WHERE uuid='$uuid'";
        $delete_run = mysqli_query($con, $delete);
            
        if($delete_run){
            
            $update = mysqli_query($con, "UPDATE transaction 
            SET service_type = 'Delivery'
            WHERE uuid = '$uuid'");

            log_audit($con, $user_id, $module, 1, 'Transaction updated to Already Pick Up. Reference: '.get_transaction_id($con, $uuid));
            header("Location: ../monitoring/monitoring-delivery-pickup-list.php?success=<i class='fa fa-check' style='font-size:14px'></i> Transaction updated to Deliveries.");
            exit();
        } else {
            log_audit($con, $user_id, $module, 0, 'Failed transaction update to Already Pick Up. Reference: '.get_transaction_id($con, $uuid));
            header("Location: ../monitoring/monitoring-delivery-pickup-list.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed transaction update. Try again.");
            exit();
        }
    } else {
        
    }
}
        
if(isset($_POST['add-for-delivery'])){
    if(isset($_POST['uuid'])) {

        $user_id = $_SESSION['user_user_id'];
        $uuid = $_POST['uuid'];

        $insert = mysqli_query($con, "INSERT INTO delivery_list VALUES(
            '',
            '$uuid',
            '1',
            '$user_id',
            '0',
            now())");

        if($insert){
            log_audit($con, $user_id, $module, 1, 'Transaction updated to For Delivery. Reference: '.get_transaction_id($con, $uuid));
            header("Location: ../monitoring/monitoring-delivery-pickup.php?success=<i class='fa fa-check' style='font-size:14px'></i> Transaction updated to For Delivery.");
            exit();
        } else {
            log_audit($con, $user_id, $module, 0, 'Failed transaction update to For Delivery. Reference: '.get_transaction_id($con, $uuid));
            header("Location: ../monitoring/monitoring-delivery-pickup.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed transaction update. Try again.");
            exit();
        }
    } 
}

if(isset($_POST['deliver'])) {
    if(isset($_POST['delivery_boy'])) {
     
        $user_id = $_SESSION['user_user_id'];
        $delivery_boy = $_POST['delivery_boy'];

        $update = mysqli_query($con, "UPDATE delivery_list SET 
            delivery_status = '2',
            delivery_boy_id = '$delivery_boy',
            updated_at = now()
            WHERE user_id = '$user_id'
            AND delivery_status = '1'");

        if($update){
            log_audit($con, $user_id, $module, 1, 'Transaction updated to Ongoing Delivery. Reference: '.get_transaction_id($con, $uuid));
            header("Location: ../monitoring/monitoring-delivery-pickup.php?success=<i class='fa fa-check' style='font-size:14px'></i> Transaction updated to Ongoing Delivery.");
            exit();
        } else {
            log_audit($con, $user_id, $module, 0, 'Failed transaction update to Ongoing Delivery. Reference: '.get_transaction_id($con, $uuid));
            header("Location: ../monitoring/monitoring-delivery-pickup.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed transaction update. Try again.");
            exit();
        }
    } 
}

if(isset($_POST['add-as-delivered'])){
    if(isset($_POST['uuid'])) {
    
        $user_id = $_SESSION['user_user_id'];
        $uuid = $_POST['uuid'];
    
        $update = mysqli_query($con, "UPDATE delivery_list SET 
            delivery_status = '3',
            updated_at = now()
            WHERE user_id = '$user_id'
            AND uuid = '$uuid'
            AND delivery_status = '2'");

        if($update){
            log_audit($con, $user_id, $module, 1, 'Transaction updated to Delivered. Reference: '.get_transaction_id($con, $uuid));
            header("Location: ../monitoring/monitoring-delivery-pickup.php?success=<i class='fa fa-check' style='font-size:14px'></i> Transaction updated to Delivered.");
            exit();
        } else {
            log_audit($con, $user_id, $module, 0, 'Failed transaction update to Delivered. Reference: '.get_transaction_id($con, $uuid));
            header("Location: ../monitoring/monitoring-delivery-pickup.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed transaction update. Try again.");
            exit();
        }
    }
}

function get_transaction_id($con, $uuid) {

    $transaction_query = mysqli_query($con, "SELECT id from transaction
        WHERE uuid = '$uuid'");
    
    $transaction = mysqli_fetch_assoc($transaction_query);
    $transaction_id = $transaction['id'];

    return $transaction_id;
}
?>