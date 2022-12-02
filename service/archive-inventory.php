<?php
session_start();
require "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'INVENTORY';

if (isset($_POST['archive-inventory'])) {
    if(isset($_POST['id'])){

        $user_id = $_SESSION['user_user_id'];
        $item_id = $_POST['id'];

        $result =mysqli_query($con, "UPDATE inventory_item 
                                        SET status_archive_id = '2' 
                                        WHERE inventory_item.id = $item_id");
        if($result){
            log_audit($con, $user_id, $module, 1, 'Archived inventory item with id: '.$item_id);
            header("Location: inventory-success.php?archive_success=Inventory Item Archived Successful");
        } else {
            log_audit($con, $user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=".mysqli_error($con));
        }    
    }
}
