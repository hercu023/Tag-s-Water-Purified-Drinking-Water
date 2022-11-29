<?php 
session_start();
require "connectionDB.php";
$email = "";
$name = "";
$lastname= "";
$firstname= "";
$middlename= "";
$email= "";
$contactnum= "";


 // if(isset($_POST['submit'])){
if(isset($_POST['submit'])){
    if(isset($_POST['itemname']) || isset($_POST['inventorytype']) || isset($_POST['reorder'])
    || isset($_POST['sellingprice']) || isset($_POST['alkalineprice'])|| isset($_POST['mineralprice'])
    || isset($_POST['firstname'])|| isset($_POST['positem']) || isset($_POST['image_item'])){
        
        // $status = 0;
        $id = $_POST['id'];

        $datetime = date("Y-m-d h:i:s");
        $itemname = $_POST['itemname'];
        $itemname = filter_var($itemname, FILTER_SANITIZE_STRING);
        $reorder = $_POST['reorder'];
        $reorder = filter_var($reorder, FILTER_SANITIZE_STRING);
        $sellingprice = $_POST['sellingprice'];
        $sellingprice = filter_var($sellingprice, FILTER_SANITIZE_STRING);
        $alkalineprice = $_POST['alkalineprice'];
        $alkalineprice = filter_var($alkalineprice, FILTER_SANITIZE_STRING);
        $mineralprice = $_POST['mineralprice'];
        $mineralprice = filter_var($mineralprice, FILTER_SANITIZE_STRING);

        $positem = $_POST['positem'];
        $positem = filter_var($positem, FILTER_SANITIZE_STRING);
        $inventorytype = $_POST['inventorytype'];

        // $status = $_POST['status'];
        $image = $_FILES['image_item']['name'];
        $image_tmp_name = $_FILES['image_item']['tmp_name'];
        $image_size = $_FILES['image_item']['size'];
        $image_folder = '../uploaded_image/'.$image;

        $select = $conn->prepare("SELECT * FROM `inventory_item` WHERE item_name = ?");
        $select->execute([$itemname]);

        // $qry="SELECT * FROM category_type WHERE id=$inventorytype";
        // $result = mysqli_query($qry);
        // $num_rows = mysqli_num_rows($result);

        // if($select->rowCount() > 0){
        //     header("Location: ../inventory/inventory_item.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Inventory item already exist.");
        // }else{
            if($image_size > 2000000){
                header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Image is too large.");
            }else{
                $insert = mysqli_query($con, 
                    "UPDATE inventory_item SET 
                    inventory_item.item_name=$itemname, 
                    category_type.name=$inventorytype, 
                    inventory_item.reorder_level=$reorder, 
                    inventory_item.pos_item=$positem,
                    inventory_item.selling_price_item =$sellingprice,
                    inventory_item.alkaline_item_price =$alkalineprice,
                    inventory_item.mineral_item_price =$mineralprice,
                    inventory_item.image = $image
                    -- '' = '',
                    -- '' = '',
                    -- '' = '',
                    -- '' = '',
                    -- '' = '',
                    -- '' = ''
                    FROM inventory_item
                    INNER JOIN category_type  
                    ON inventory_item.category_by_id = category_type.id
                    WHERE inventory_item.id='$id'");

                if($insert){
                    move_uploaded_file($image_tmp_name, $image_folder);
                    header("Location: ../inventory/inventory-details.php?success=Update Inventory Successful!");
                } else {
                    header("Location: ../common/error-page.php?error=".mysqli_error($con));
                }
            }
     
        }
    }

?>