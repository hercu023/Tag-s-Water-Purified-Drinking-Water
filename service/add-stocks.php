<?php
session_start();
require "../database/connection-db.php";
require_once "../service/update-inventory-log.php";
require_once "../audit/audit-logger.php";
$module = 'INVENTORY-STOCKS';

if(isset($_POST['add-inventory-stocks'])){

    if(isset($_POST['supplier'])
        ||isset($_POST['purchaseamount'])
        ||isset($_POST['quantity'])
        ||isset($_POST['id'])){

        $user_id = $_SESSION['user_user_id'];
        $id = $_POST['id'];

        $supplier = $_POST['supplier'];
        $supplier = filter_var($supplier, FILTER_SANITIZE_STRING);

        $purchaseamount = $_POST['purchaseamount'];
        $purchaseamount = filter_var($purchaseamount, FILTER_SANITIZE_STRING);

        $quantity = $_POST['quantity'];
        $quantity = filter_var($quantity, FILTER_SANITIZE_STRING);

        $select_stock = "SELECT *
        FROM inventory_stock
        WHERE item_name_id = $id";
        $select_result = mysqli_query($con, $select_stock);

        if(mysqli_num_rows($select_result)) {
            $stock = mysqli_fetch_assoc($select_result);
            $onhand = $stock['on_hand'];
            $ingoing = $stock['in_going'];

            $totalonhand = $onhand + $quantity;
            $totalingoing = $ingoing + $quantity;

            $update_result = mysqli_query($con, "UPDATE inventory_stock SET 
                            in_going = '$totalingoing', 
                            on_hand = '$totalonhand'
                            WHERE inventory_stock.item_name_id = '$id'");

            if($update_result) {

                //Add to expense
                $expense_result = mysqli_query($con, "SELECT * FROM expense_type 
                                            WHERE name = 'Other Expenses'");

                if (mysqli_num_rows($expense_result) > 0) {
                    $expense_type = mysqli_fetch_assoc($expense_result);
                    $expense_id = $expense_type['id'];
                    $description = "Purchased inventory stocks for item id: ".$id.', quantity: '. $quantity;

                    $insert = mysqli_query($con, "INSERT INTO `expense` VALUES(
                             '',
                             '$expense_id',
                             now(),
                             '$purchaseamount',
                             '$description',
                             '$user_id',
                              now(),
                             '$user_id',
                             now(),
                             0,
                             1)");

                    log_audit($con, $user_id, 'EXPENSE', 1, $description);

                    if($insert) {
                        record_inventory_log($con, $id, "IN", $quantity, "Supplier Details: ".$supplier);
                        log_audit($con, $user_id, $module, 1, 'Successfully added new stocks for item:' .$id);
                        header("Location: ../inventory/inventory-success-stocks.php?success=Add Stocks Successful!");
                        exit();
                    }
                }
            }
        }
    }
}

?>
