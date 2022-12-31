<?php
@session_start();
require_once "../audit/audit-logger.php";

function record_inventory_log($con, $item_id, $action, $quantity, $amount, $details) {

    $user_id = $_SESSION['user_user_id'];

    $update_inventory = "INSERT INTO inventory_log VALUES(
                              '',
                              '$item_id',
                              '$details',
                              '$quantity',
                              '$amount',
                              now(),
                              '$user_id',
                              '$action')";

    $result = mysqli_query($con, $update_inventory);

    $module = "MONITORING-ITEM_HISTORY";
    
    if ($result) {
        log_audit($con, $user_id, $module, 1, 'Updated stocks with id:' .$item_id);
    } else {
        log_audit($con, $user_id, $module, 0, 'Error processing database.');
    }
}
