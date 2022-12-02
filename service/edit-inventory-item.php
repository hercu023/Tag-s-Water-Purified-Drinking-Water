<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'INVENTORY';

if(isset($_POST['submit'])) {
    if (isset($_POST['item_name'])
        || isset($_POST['category_type'])
        || isset($_POST['re_order'])
        || isset($_POST['selling_price'])
        || isset($_POST['alkaline_price'])
        || isset($_POST['mineral_price'])
        || isset($_POST['pos_item'])
        || isset($_POST['image_item'])) {

        $updated_by = $_SESSION['user_user_id'];
        $user_id = $_SESSION['user_user_id'];

        $item_id = $_POST['id'];

        $item_name = filter_var($_POST['item_name'], FILTER_SANITIZE_STRING);

        $re_order = filter_var($_POST['re_order'], FILTER_SANITIZE_STRING);

        $selling_price = filter_var($_POST['selling_price'], FILTER_SANITIZE_STRING);

        $alkaline_price = filter_var($_POST['alkaline_price'], FILTER_SANITIZE_STRING);

        $mineral_price = filter_var($_POST['mineral_price'], FILTER_SANITIZE_STRING);

        $pos_item = filter_var($_POST['pos_item'], FILTER_SANITIZE_STRING);

        $category_type = $_POST['category_type'];

        $image = $_FILES['image_item']['name'];
        $image_tmp_name = $_FILES['image_item']['tmp_name'];
        $image_size = $_FILES['image_item']['size'];
        $image_folder = '../uploaded_image/' . $image;

        if ($image_size > 2000000) {
            header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Image is too large.");
        } else {

            //Check if an item with the same name but different id exists.
            $item_check = "SELECT item_name FROM inventory_item WHERE item_name = '$item_name' and id != '$item_id'";
            $result_check = mysqli_query($con, $item_check);

            if (mysqli_num_rows($result_check) > 0) {
                header("Location: ../inventory/inventory-details.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Item name cannot be a duplicate");
            } else {

                //If image is empty replace it with the saved image name from inventory item table.
                if (empty($image)) {
                    $item_image_query = "SELECT image FROM inventory_item WHERE id = '$item_id'";
                    $result_image = mysqli_query($con, $item_image_query);
                    $image = mysqli_fetch_assoc($result_image)['image'];
                }

                $update = mysqli_query($con,
                    "UPDATE inventory_item SET
                    inventory_item.item_name='$item_name',
                    inventory_item.category_by_id ='$category_type',
                    inventory_item.reorder_level='$re_order',
                    inventory_item.pos_item_id='$pos_item',
                    inventory_item.selling_price_item ='$selling_price',
                    inventory_item.alkaline_price ='$alkaline_price',
                    inventory_item.mineral_price ='$mineral_price',
                    inventory_item.image = '$image',
                    inventory_item.updated_at = now(),
                    inventory_item.updated_by_id = '$updated_by'
                    WHERE inventory_item.id='$item_id'");
                if ($update) {
                    move_uploaded_file($image_tmp_name, $image_folder);
                    log_audit($con, $user_id, $module, 1, 'Updated inventory item with id:' .$item_id);
                    header("Location: ../inventory/inventory-success.php?success=Update Inventory Item Successful!");
                } else {
                    log_audit($con, $user_id, $module, 0, 'Error processing database.');
                    header("Location: ../common/error-page.php?error=".mysqli_error($con));
                }
            }
        }
    }
}