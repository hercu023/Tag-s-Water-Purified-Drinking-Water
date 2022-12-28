<?php

function validate_quantity($con, $item_name, $quantity) {

    $select_item = mysqli_query($con, "SELECT 
                            inventory_item.id,
                            inventory_stock.on_hand,
                            category_type.name
                            FROM inventory_item 
                            INNER JOIN inventory_stock
                            ON inventory_item.id = inventory_stock.item_name_id
                            INNER JOIN category_type
                            ON inventory_item.category_by_id = category_type.id
                            WHERE item_name = '$item_name' 
                            AND status_archive_id = 1");

    if(mysqli_num_rows($select_item) > 0) {
        $item = mysqli_fetch_assoc($select_item);
        $on_hand = $item['on_hand'];
        $category_type = $item['name'];

        //Return true if for refill only
        if ($category_type == 'For Refill') {
            return true;
        }

        //If quantity is greater than stock on hand return false otherwise true
        if($quantity > $on_hand) {
            return false;
        } else {
            return true;
        }
    } else{

        $validate_category_type = mysqli_query($con, "SELECT 
                            inventory_item.id,
                            category_type.name
                            FROM inventory_item 
                            INNER JOIN category_type
                            ON inventory_item.category_by_id = category_type.id
                            WHERE item_name = '$item_name' 
                            AND status_archive_id = 1");

        if(mysqli_num_rows($validate_category_type) > 0) {
            $validate_item = mysqli_fetch_assoc($validate_category_type);
            $validate_category_type = $validate_item['name'];

            //Return true if for refill only
            if ($validate_category_type == 'For Refill') {
                return true;
            }
        }
        header("Location: ../common/error-page.php?error=Item is not available");
        exit();
    }
}
