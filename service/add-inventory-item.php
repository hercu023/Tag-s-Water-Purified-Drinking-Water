<?php
session_start();
require "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'INVENTORY-ITEM';

if(isset($_POST['add-inventory'])){
    if(isset($_POST['item_name'])
        || isset($_POST['category_type'])
        || isset($_POST['re_order'])
        || isset($_POST['selling_price'])
        || isset($_POST['alkaline_price'])
        || isset($_POST['mineral_price'])
        || isset($_POST['first_name'])
        || isset($_POST['pos_item'])
        || isset($_POST['image_item'])) {

        $created_by = $_SESSION['user_user_id'];
        $user_id = $_SESSION['user_user_id'];

        $item_name = filter_var($_POST['item_name'], FILTER_SANITIZE_STRING);

        $re_order = filter_var($_POST['re_order'], FILTER_SANITIZE_STRING);

        $selling_price = filter_var($_POST['selling_price'], FILTER_SANITIZE_STRING);

        $alkaline_price = filter_var($_POST['alkaline_price'], FILTER_SANITIZE_STRING);

        $mineral_price = filter_var($_POST['mineral_price'], FILTER_SANITIZE_STRING);

        $pos_item = filter_var($_POST['pos_item'], FILTER_SANITIZE_STRING);

        $category_type = $_POST['category_type'];

        $status = $_POST['status'];

        $image = $_FILES['image_item']['name'];
        $image_tmp_name = $_FILES['image_item']['tmp_name'];
        $image_size = $_FILES['image_item']['size'];
        $image_folder = '../uploaded_image/'.$image;

        if ($image_size > 2000000) {
            header("Location: ../inventory/inventory-details.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Image is too large.");
        } else {
            //Check if item name already exists.
            $item_check = "SELECT * FROM `inventory_item` WHERE item_name = '$item_name'";
            $result_check = mysqli_query($con, $item_check);

            if (mysqli_num_rows($result_check) > 0) {
                header("Location: ../inventory/inventory-details.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Item already exist.");
            } else {
                $insert = mysqli_query($con, "INSERT INTO inventory_item VALUES(
                    '',
                    '$item_name',
                    '$category_type',
                    '$re_order',
                    '$pos_item',
                    '$selling_price',
                    '$alkaline_price',
                    '$mineral_price',
                    '$image',
                    now(),
                    '$status',
                    now(),
                    '$created_by',
                    '$created_by')");
                if($insert){

                    $select = mysqli_query($con, "SELECT * FROM inventory_item WHERE 
                           item_name = '$item_name' AND 
                           status_archive_id = 1");

                    if (mysqli_num_rows($select) > 0) {
                        $fetch_data = mysqli_fetch_assoc($select);
                        $fetch_id = $fetch_data['id'];

                        //Add stock item reference to stock table
                        $insert_stock = mysqli_query($con, "INSERT INTO inventory_stock VALUES(
                                    '',
                                    '$fetch_id',
                                    0,
                                    0,
                                    0)");

                        if($insert_stock) {
                            log_audit($con, $user_id, $module, 1, 'Added new inventory with id:' .$fetch_id);
                            move_uploaded_file($image_tmp_name, $image_folder);
                            header("Location: ../inventory/inventory-success.php?success=Add New Item Successful!");
                        } else {
                            log_audit($con, $user_id, $module, 0, 'Error processing database.');
                            header("Location: ../common/error-page.php?error=" . mysqli_error($con));
                        }
                    } else {
                        log_audit($con, $user_id, $module, 0, 'Error processing database.');
                        header("Location: ../common/error-page.php?error=" . mysqli_error($con));
                    }
                } else {
                    header("Location: ../common/error-page.php?error=".mysqli_error($con));
                }
            }
        }
    }
}

if(isset($_POST['add-refill'])){
    if(isset($_POST['item_name'])
        || isset($_POST['category_type'])
        || isset($_POST['alkaline_price'])
        || isset($_POST['mineral_price'])
        || isset($_POST['first_name'])
        || isset($_POST['pos_item'])
        || isset($_POST['image_item'])) {

        $created_by = $_SESSION['user_user_id'];
        $user_id = $_SESSION['user_user_id'];

        $item_name = filter_var($_POST['item_name'], FILTER_SANITIZE_STRING);

        $alkaline_price = filter_var($_POST['alkaline_price'], FILTER_SANITIZE_STRING);

        $mineral_price = filter_var($_POST['mineral_price'], FILTER_SANITIZE_STRING);

        $pos_item = filter_var($_POST['pos_item'], FILTER_SANITIZE_STRING);

        $category_type = $_POST['category_type'];

        $status = $_POST['status'];

        $image = $_FILES['image_item']['name'];
        $image_tmp_name = $_FILES['image_item']['tmp_name'];
        $image_size = $_FILES['image_item']['size'];
        $image_folder = '../uploaded_image/'.$image;

        if ($image_size > 2000000) {
            header("Location: ../inventory/inventory-details.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Image is too large.");
        } else {
            //Check if item name already exists.
            $item_check = "SELECT * FROM `inventory_item` WHERE item_name = '$item_name'";
            $result_check = mysqli_query($con, $item_check);

            if (mysqli_num_rows($result_check) > 0) {
                header("Location: ../inventory/inventory-details.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Item already exist.");
            } else {
                $insert = mysqli_query($con, "INSERT INTO inventory_item VALUES(
                    '',
                    '$item_name',
                    '10',
                    '',
                    '$pos_item',
                    '',
                    '$alkaline_price',
                    '$mineral_price',
                    '$image',
                    now(),
                    '$status',
                    now(),
                    '$created_by',
                    '$created_by')");
                if($insert){

                    $select = mysqli_query($con, "SELECT * FROM inventory_item WHERE 
                           item_name = '$item_name' AND 
                           status_archive_id = 1");

                    if (mysqli_num_rows($select) > 0) {
                        $fetch_data = mysqli_fetch_assoc($select);
                        $fetch_id = $fetch_data['id'];
                        log_audit($con, $user_id, $module, 1, 'Added new inventory with id:' .$fetch_id);

                        move_uploaded_file($image_tmp_name, $image_folder);
                        header("Location: ../inventory/inventory-success.php?success=Add New Item Successful!");
                    } else {
                        log_audit($con, $user_id, $module, 0, 'Error processing database.');
                        header("Location: ../common/error-page.php?error=" . mysqli_error($con));
                    }
                } else {
                    header("Location: ../common/error-page.php?error=".mysqli_error($con));
                }
            }
        }
    }
}
