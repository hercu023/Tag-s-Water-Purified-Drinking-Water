<?php
session_start();
require "../database/connection-db.php";
require_once "../service/update-inventory-log.php";
require_once "../service/validate-stock-quantity.php";
require_once "../audit/audit-logger.php";
$module = 'INVENTORY-STOCKS';

if(isset($_POST['deduct-stocks'])) {
    if(isset($_POST['item_id']) 
    || isset($_POST['item_name']) 
    || isset($_POST['quantity'])
    || isset($_POST['note'])) {

        $item_name = $_POST['item_name'];
        $item_id = $_POST['item_id'];
        $quantity = $_POST['quantity'];
        $note = $_POST['note'];            

        //Validate stock quantity of item if sufficient for deduction
        if(validate_quantity($con, $item_name, $quantity)) {

            //Get Item details
            $select_stock = "SELECT *
            FROM inventory_stock
            WHERE id = $item_id";
            $select_result = mysqli_query($con, $select_stock);

            //Validate if item exists
            if(mysqli_num_rows($select_result) > 0) {

                //Set item details and compute for onhand and outgoing
                $stock = mysqli_fetch_assoc($select_result);
                $name = $stock['item_name_id'];
                $onhand = $stock['on_hand'];
                $out_going = $stock['out_going'];

                $deducted_onhand = $onhand - $quantity;
                $totaloutgoing = $out_going + $quantity;

                //Update stock table
                $update_result = mysqli_query($con, "UPDATE inventory_stock SET 
                    out_going = '$totaloutgoing', 
                    on_hand = '$deducted_onhand'
                    WHERE inventory_stock.id = '$item_id'");

                //Validate if stock update is succcessful
                if ($update_result) {
                   
                    record_inventory_log($con, $item_id, "OUT", $quantity, 0, "Description: ".$note);
                    log_audit($con, $user_id, $module, 1, 'Deducted stocks for item:' .$item_id);
                    header("Location: ../inventory/inventory-success-stocks.php?success=Deduct Stocks Successful!");
                    exit();
                } else {
                    header("Location: ../inventory/inventory-stocks.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed updating item stock information. Try again.");
                    exit();
                }
            } else {
                header("Location: ../inventory/inventory-stocks.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed retrieving item stock information. Try again.");
                exit();
            }
        } else {
            header("Location: ../inventory/inventory-stocks.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Stocks quantity not sufficient for deduction.");
            exit();
        }
    }
}