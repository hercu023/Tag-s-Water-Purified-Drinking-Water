<?php
require_once "../database/connection-db.php";
require_once "../service/validate-stock-quantity.php";
require_once "../audit/audit-logger.php";
$module = 'MONITORING-DELIVERY_PICKUP';
if(isset($_POST['add-for-pickup'])){
    if(isset($_POST['uuid'])) {
       
        $user_id = $_SESSION['user_user_id'];
        $uuid = $_POST['uuid'];
      

        $insert = mysqli_query($con, "INSERT INTO delivery_list VALUES(
                '',
                '$uuid',
                '4',
                '$user_id',
                '0')");
            if($insert){
                log_audit($con, $user_id, $module, 1, 'Transaction Added');

                header("Location: ../monitoring/monitoring-delivery-pickup.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Transaction Added for Pick up.");
                exit();

            } else {
                log_audit($con, $user_id, $module, 0, 'Customer name already exist');
                header("Location: ../monitoring/monitoring-delivery-pickup.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Error Inserting Record to Database.");
                exit();
            }
    }

}

if(isset($_POST['add-to-ongoing-pickup'])){

    if(isset($_POST['uuid'])
    ||isset($_POST['delivery_boy'])) {
    
            $user_id = $_SESSION['user_user_id'];
            $uuid = $_POST['uuid'];
            $delivery_boy = $_POST['delivery_boy'];
   
    
            $update = mysqli_query($con, "UPDATE delivery_list SET 
                delivery_status = '5',
                delivery_boy_id = '$delivery_boy'
                WHERE user_id = '$user_id'
                AND uuid = '$uuid'
                AND delivery_status = '4'");
                if($update){
                    header("Location: ../monitoring/monitoring-delivery-pickup-list.php");
                }
    
            } else {
                header("Location: ../monitoring/monitoring-delivery-pickup.php?error=Failed add order. Insufficient inventory stock.");
            }
        }

if(isset($_POST['add-as-already-pickup'])){

    if(isset($_POST['uuid'])) {
            
            $user_id = $_SESSION['user_user_id'];
            $uuid = $_POST['uuid'];
                    // header("Location: ../common/error-page.php?error=$delivery_boy. $uuid");
                    // exit();
            
            $delete = "DELETE FROM delivery_list WHERE uuid='$uuid'";
            $delete_run = mysqli_query($con, $delete);
            if($delete_run){

                $update = mysqli_query($con, "UPDATE transaction 
                SET service_type = 'Delivery'
                WHERE uuid = '$uuid'");
                header("Location: ../monitoring/monitoring-delivery-pickup.php");

            }
            } else {
                header("Location: ../monitoring/monitoring-delivery-pickup.php?error=Failed add order. Insufficient inventory stock.");
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
                '0')");
            if($insert){
                header("Location: ../monitoring/monitoring-delivery-pickup.php");
            }

        } else {
            header("Location: ../monitoring/monitoring-delivery-pickup.php?error=Failed add order. Insufficient inventory stock.");
        }
    }
    if(isset($_POST['add-as-delivered'])){
        if(isset($_POST['uuid'])) {
    
            $user_id = $_SESSION['user_user_id'];
            $uuid = $_POST['uuid'];
    
    
            $update = mysqli_query($con, "UPDATE delivery_list SET 
                delivery_status = '3'
                WHERE user_id = '$user_id'
                AND uuid = '$uuid'
                AND delivery_status = '2'");
                if($update){
                    header("Location: ../monitoring/monitoring-delivery-pickup.php");
                }
    
            } else {
                header("Location: ../monitoring/monitoring-delivery-pickup.php?error=Failed add order. Insufficient inventory stock.");
            }
        }

        
    if(isset($_POST['deliver'])){

        if(isset($_POST['delivery_boy'])
        ) {
         
            $user_id = $_SESSION['user_user_id'];
            $delivery_boy = $_POST['delivery_boy'];

            $update = mysqli_query($con, "UPDATE delivery_list SET 
                delivery_status = '2',
                delivery_boy_id = '$delivery_boy'
                WHERE user_id = '$user_id'
                AND delivery_status = '1'");
                if($update){
                    header("Location: ../monitoring/monitoring-delivery-pickup.php");
                }
    
            } else {
                header("Location: ../monitoring/monitoring-delivery-pickup.php?error=Failed add order. Insufficient inventory stock.");
            }
        }
?>