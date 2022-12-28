<?php
session_start();
require_once "../database/connection-db.php";
require_once "../service/update-inventory-log.php";
require_once "../service/validate-stock-quantity.php";
require_once "../audit/audit-logger.php";
$module = 'POS';

if (isset($_POST['save-transaction'])) {
    if (isset($_POST['customername'])
        || isset($_POST['option'])
        || isset($_POST['totalAmount'])
        || isset($_POST['paymentoption'])
        || isset($_POST['serviceoption'])
        || isset($_POST['cashpayment'])
        || isset($_POST['cashbalance'])
        || isset($_POST['note'])
        || isset($_POST['unpaid'])) {

        $transaction_uuid = uniqid('', true);
        $user_id = $_SESSION['user_user_id'];

        $customer_name = $_POST['customername'];
        $customer_name = filter_var($customer_name, FILTER_SANITIZE_STRING);

        $paymentoption = $_POST['paymentoption'];
        $paymentoption = filter_var($paymentoption, FILTER_SANITIZE_STRING);

        $service = $_POST['serviceoption'];
        $service = filter_var($service, FILTER_SANITIZE_STRING);

        $cashpayment = filter_var($_POST['cashpayment'], FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

        $cashbalance = filter_var($_POST['cashbalance'], FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

        $totalamount = filter_var($_POST['totalAmount'], FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

        $cashchange = ($cashpayment - $totalamount);

        $note = $_POST['note'];
        $previous_balance = $cashbalance;

        $remainingbalance = $cashbalance;
        $unpaid_amount = 0;
        $status = 1;

        if(isset($_POST['unpaid'])){
            if($_POST['unpaid'] == 1){
                $status = 0;
            }
        }

        if($customer_name == 'GUEST'){
            if($cashpayment < $totalamount){
                header("Location: ../pos/point-of-sales-placeorder.php?option=".$_POST['option'].'&totalAmount=' .$_POST['totalAmount']. "&error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Insufficient Cash Amount.");
                exit();
            }
        }else{
            // if customer is not guest
            if($cashpayment < $totalamount){
                $totalbalance = $cashpayment + $cashbalance;
                if(!isset($_POST['unpaid']) && $totalbalance < $totalamount){
                    header("Location: ../pos/point-of-sales-placeorder-unpaid-confirm.php?option=".$_POST['option'].'&totalAmount='.$_POST['totalAmount'].'&paymentoption='.$_POST['paymentoption'].'&serviceoption='.$_POST['serviceoption'].'&cashpayment='.$_POST['cashpayment'].'&cashbalance='.$_POST['cashbalance'].'&customername='.$_POST['customername'].'&note='.$_POST['note']);
                    exit();
                }else{
                    if($totalbalance >= $totalamount){
                        $unpaid_amount = 0;
                        $remainingbalance = $totalbalance - $totalamount;
                    }else{
                        $unpaid_amount = $totalamount - $totalbalance;
                        $remainingbalance = 0;
                    }
                    $update = mysqli_query($con, "UPDATE customers 
                                                SET balance = '$remainingbalance' 
                                                WHERE id = $customer_name");
                    if ($update) {
                        $cashchange = 0;
                        log_audit($con, $user_id, $module, 1, 'Customer balance adjusted under transaction reference: ' .$transaction_uuid);
                    } else {
                        log_audit($con, $user_id, $module, 0, 'Error processing database.');
                        header("Location: ../common/error-page.php?error=" . mysqli_error($con));
                        exit();
                    }
                }
            }
        }

        $select_transaction_items1 = mysqli_query($con, "SELECT transaction_process.item_name,
                        inventory_item.id,
                        SUM(transaction_process.quantity) as quantity
                        FROM transaction_process
                        INNER JOIN inventory_item
                        ON transaction_process.item_name = inventory_item.item_name 
                        WHERE user_id = '$user_id' 
                        AND transaction_id = '0'
                        GROUP BY transaction_process.item_name");

        if(mysqli_num_rows($select_transaction_items1) > 0) {

            $consolidated_validation = false;
            while ($item1 = mysqli_fetch_assoc($select_transaction_items1)) {
                $item_name = $item1['item_name'];
                $quantity = $item1['quantity'];
                if (validate_quantity($con, $item_name, $quantity)) {
                    $consolidated_validation = true;
                } else {
                    header("Location: ../pos/point-of-sales-placeorder.php?option=".$_POST['option'].'&totalAmount=' .$_POST['totalAmount']. "&error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Insufficient Stock for Item: " .$item_name);
                    exit();
                }
            }

            //If all stocks are sufficient
            if ($consolidated_validation) {

                $select_transaction_items2 = mysqli_query($con, "SELECT transaction_process.item_name,
                        inventory_item.id,
                        SUM(transaction_process.quantity) as quantity
                        FROM transaction_process
                        INNER JOIN inventory_item
                        ON transaction_process.item_name = inventory_item.item_name 
                        WHERE user_id = '$user_id' 
                        AND transaction_id = '0'
                        GROUP BY transaction_process.item_name");

                while ($item2 = mysqli_fetch_assoc($select_transaction_items2)) {

                    $item_id = $item2['id'];

                    //Get and update stocks
                    $select_stock = "SELECT *
                        FROM inventory_stock
                        WHERE item_name_id = $item_id";
                    $select_result = mysqli_query($con, $select_stock);

                    if(mysqli_num_rows($select_result)) {
                        $stock = mysqli_fetch_assoc($select_result);
                        $onhand = $stock['on_hand'];
                        $out_going = $stock['out_going'];

                        $deducted_onhand = $onhand - $quantity;
                        $totaloutgoing = $out_going + $quantity;

                        $update_result = mysqli_query($con, "UPDATE inventory_stock SET 
                            out_going = '$totaloutgoing', 
                            on_hand = '$deducted_onhand'
                            WHERE inventory_stock.item_name_id = '$item_id'");

                        if ($update_result) {
                            log_audit($con, $user_id, $module, 1, 'Successfully deducted stocks for item:' .$item_id);

                            //Add record to inventory log
                            $item_name = $item2['item_name'];
                            $quantity = $item2['quantity'];
                            $action = "OUT";
                            $details = "POS Transaction Reference: " . $transaction_uuid;
                            record_inventory_log($con, $item_id, $action, $quantity, $details);
                        } else {
                            header("Location: ../pos/point-of-sales-placeorder.php?option=".$_POST['option'].'&totalAmount=' .$_POST['totalAmount']. "&error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Error updating stocks...");
                            exit();
                        }
                    }
                }

                $insert = mysqli_query($con, "INSERT INTO transaction VALUES(
                             '',
                             '$transaction_uuid',
                             '$customer_name', 
                             '$service', 
                             '$totalamount',
                             '$paymentoption',
                             '$note',
                             '$status',
                             '$user_id',
                             '$user_id',
                             now(),
                             now(),
                             now())");

                if ($insert) {

                    $insert_transaction_history =mysqli_query($con,
                        "INSERT INTO transaction_history 
                VALUES(
                '',
                '$transaction_uuid',
                '$cashpayment',
                '$cashchange',
                '$remainingbalance',
                '$previous_balance',
                '$unpaid_amount',
                '$user_id',
                now()
                )");

                    $update_ordersummary = mysqli_query($con, "UPDATE transaction_process 
                SET transaction_id = '$transaction_uuid'
                WHERE user_id = '$user_id' 
                AND transaction_id = '0'");

                    if($update_ordersummary){
                        log_audit($con, $user_id, $module, 1, 'Added new transaction with transaction reference:' . $transaction_uuid);
                        header("Location: ../pos/point-of-sales-viewdetails.php?view=".$transaction_uuid.'&message=TRANSACTION SUCCESSFUL!');
                    }else{
                        log_audit($con, $user_id, $module, 0, 'Error processing database.');
                        header("Location: ../common/error-page.php?error3=" . mysqli_error($con));
                    }
                } else {
                    log_audit($con, $user_id, $module, 0, 'Error processing database.');
                    header("Location: ../common/error-page.php?error2=" . mysqli_error($con));
                }
            }
        } else {
            log_audit($con, $user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error1=" . mysqli_error($con));
        }
    }
}


