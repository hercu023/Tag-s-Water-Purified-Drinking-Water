<?php

function validate_quantity($con, $item_name, $quantity) {

    //Get item details according to params
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

    //Validate if item exists on stock table, if true proceed.
    //Otherwise validate if category type is 'for refill' only
    if(mysqli_num_rows($select_item) > 0) {

        //Get item details
        $item = mysqli_fetch_assoc($select_item);
        $on_hand = $item['on_hand'];
        $category_type = $item['name'];

        //Return true if 'for refill' only
        if ($category_type == 'For Refill') {
            return true;
        }

        //If quantity is greater than stock on hand return false otherwise true
        if($quantity > $on_hand) {
            return false;
        } else {
            return true;
        }
    } else {
        //Query to validate category type
        $validate_category_type = mysqli_query($con, "SELECT 
                            inventory_item.id,
                            category_type.name
                            FROM inventory_item 
                            INNER JOIN category_type
                            ON inventory_item.category_by_id = category_type.id
                            WHERE item_name = '$item_name' 
                            AND status_archive_id = 1");

        //Validate if item exists
        if(mysqli_num_rows($validate_category_type) > 0) {

            //Get category type name of item
            $validate_item = mysqli_fetch_assoc($validate_category_type);
            $validate_category_type = $validate_item['name'];

            //Return true if category is 'for refill' only
            if ($validate_category_type == 'For Refill') {
                return true;
            }

        } else {
            header("Location: ../common/error-page.php?error=Error reading database. Retrieving item details failed. Try again.");
            exit();
        }
    }
}
