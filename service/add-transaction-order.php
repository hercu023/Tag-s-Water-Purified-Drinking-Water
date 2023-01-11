<?php
require_once "../database/connection-db.php";
require_once "../service/validate-stock-quantity.php";

if(isset($_POST['add-others'])){
    if(isset($_POST['quantity'])
        || isset($_POST['PRICE'])
        || isset($_POST['categorytype'])
        || isset($_POST['itemname'])
    ) {

        $item_name3 = filter_var($_POST['itemname'], FILTER_SANITIZE_STRING);
        $category_name3 = filter_var($_POST['categorytype'], FILTER_SANITIZE_STRING);
        $price_item3 = filter_var($_POST['PRICE'], FILTER_SANITIZE_STRING);
        $user_id = $_SESSION['user_user_id'];
        $qty3 = filter_var($_POST['quantity'], FILTER_SANITIZE_STRING);

        $total= $qty3 * $price_item3;


        if (validate_quantity($con, $item_name3, $qty3)) {
            $insert = mysqli_query($con, "INSERT INTO transaction_process VALUES(
                    '',
                    '$item_name3',
                    '',
                    '$category_name3',
                    '$qty3',
                    '$price_item3',
                    '$total',
                    '$user_id',
                    '0')");
            if($insert){
                header("Location: ../pos/point-of-sales.php?update=1");
            }
        } else {
            header("Location: ../pos/point-of-sales.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed add order. Insufficient inventory stock.");
        }

    }
}

if(isset($_GET['addothers']) && isset($_GET['user_id']) ){
    
    $id = $_GET['addothers'];
    $result = mysqli_query($con,"SELECT
            inventory_item.id, 
            inventory_item.image, 
            inventory_item.item_name,
            category_type.name,
            inventory_item.selling_price_item
            FROM inventory_item 
            INNER JOIN category_type  
            ON inventory_item.category_by_id = category_type.id  
            WHERE inventory_item.id = '$id'");
    if (mysqli_num_rows($result) > 0) {

    $item = mysqli_fetch_assoc($result);
    
    $user_id = $_GET['user_id'];
    
    $item_name3 = $item['item_name'];
    $category_name3 = $item['name'];
    $price_item3 = $item['selling_price_item'];
    $qty3 = 1;

    $total= $qty3 * $price_item3;

    if (validate_quantity($con, $item_name3, $qty3)) {
        $insert = mysqli_query($con, "INSERT INTO transaction_process VALUES(
                '',
                '$item_name3',
                '',
                '$category_name3',
                '$qty3',
                '$price_item3',
                '$total',
                '$user_id',
                '0')");
        if($insert){
            header("Location: ../pos/point-of-sales.php?update=1");
        }
    } else {
        header("Location: ../pos/point-of-sales.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed add order. Insufficient inventory stock.");
    }
}
}
?>
<?php
if(isset($_POST['add-alkaline-water'])){
    if(isset($_POST['quantity'])
        || isset($_POST['alkalineprice'])
        // || isset($_POST['mineralprice'])
        || isset($_POST['alkaline-label'])
        || isset($_POST['categorytype'])
        || isset($_POST['itemname'])
    ) {

        $item_name3 = filter_var($_POST['itemname'], FILTER_SANITIZE_STRING);
        $category_name3 = filter_var($_POST['categorytype'], FILTER_SANITIZE_STRING);
        $selectwater = filter_var($_POST['alkaline-label'], FILTER_SANITIZE_STRING);
        $alkalineprice = filter_var($_POST['alkalineprice'], FILTER_SANITIZE_STRING);
        // $mineralprice = filter_var($_POST['mineralprice'], FILTER_SANITIZE_STRING);
        $user_id = $_SESSION['user_user_id'];
        $qty3 = filter_var($_POST['quantity'], FILTER_SANITIZE_STRING);

        $total= $qty3 * $alkalineprice;

        if (validate_quantity($con, $item_name3, $qty3)) {
            $insert = mysqli_query($con, "INSERT INTO transaction_process VALUES(
                    '',
                    '$item_name3',
                    '$selectwater',
                    '$category_name3',
                    '$qty3',
                    '$alkalineprice',
                    '$total',
                    '$user_id',
                    '0')");
            if($insert){
                header("Location: ../pos/point-of-sales.php?update=1");
            }
        } else {
            header("Location: ../pos/point-of-sales.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed add order. Insufficient inventory stock.");
        }
    }
}

if(isset($_GET['addalkaline']) && isset($_GET['user_id']) ){
    
        $id = $_GET['addalkaline'];
            $result = mysqli_query($con,"SELECT
            inventory_item.id, 
            inventory_item.image, 
            inventory_item.item_name,
            category_type.name,
            inventory_item.alkaline_price
            FROM inventory_item 
            INNER JOIN category_type  
            ON inventory_item.category_by_id = category_type.id  
            WHERE inventory_item.id = '$id'");
        if (mysqli_num_rows($result) > 0) {

        $item = mysqli_fetch_assoc($result);

        $user_id = $_GET['user_id'];
        
        $item_name3 = $item['item_name'];
        $category_name3 = $item['name'];
        $selectwater = 'Alkaline';
        $alkalineprice = $item['alkaline_price'];
        $qty3 = 1;

        $total= $qty3 * $alkalineprice;

        if (validate_quantity($con, $item_name3, $qty3)) {
            $insert = mysqli_query($con, "INSERT INTO transaction_process VALUES(
                    '',
                    '$item_name3',
                    '$selectwater',
                    '$category_name3',
                    '$qty3',
                    '$alkalineprice',
                    '$total',
                    '$user_id',
                    '0')");
            if($insert){
                header("Location: ../pos/point-of-sales.php?update=1");
            }
        } else {
            header("Location: ../pos/point-of-sales.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed add order. Insufficient inventory stock.");
        }
    }
}

?>
<?php
if(isset($_POST['add-mineral-water'])){
    if(isset($_POST['quantity'])
        // || isset($_POST['alkalineprice'])
        || isset($_POST['mineralprice'])
        || isset($_POST['mineral-label'])
        || isset($_POST['categorytype'])
        || isset($_POST['itemname'])
    ) {

        $item_name3 = filter_var($_POST['itemname'], FILTER_SANITIZE_STRING);
        $category_name3 = filter_var($_POST['categorytype'], FILTER_SANITIZE_STRING);
        $selectwater = filter_var($_POST['mineral-label'], FILTER_SANITIZE_STRING);
        // $alkalineprice = filter_var($_POST['alkalineprice'], FILTER_SANITIZE_STRING);
        $mineralprice = filter_var($_POST['mineralprice'], FILTER_SANITIZE_STRING);
        $user_id = $_SESSION['user_user_id'];
        $qty3 = filter_var($_POST['quantity'], FILTER_SANITIZE_STRING);

        $total= $qty3 * $mineralprice;

        // header("Location: ../common/error-page.php?error=". $item_id .','. $item_name3.','.$category_name3 .','. $price_item3.','. $qty3);
        // exit();

        if (validate_quantity($con, $item_name3, $qty3)) {
            $insert = mysqli_query($con, "INSERT INTO transaction_process VALUES(
                    '',
                    '$item_name3',
                    '$selectwater',
                    '$category_name3',
                    '$qty3',
                    '$mineralprice',
                    '$total',
                    '$user_id',
                    '0')");
            if($insert){
                header("Location: ../pos/point-of-sales.php?update=1");
            }
        } else {
            header("Location: ../pos/point-of-sales.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed add order. Insufficient inventory stock.");
        }
    }
}

if(isset($_GET['addmineral']) && isset($_GET['user_id']) ){

    $id = $_GET['addmineral'];
    $result = mysqli_query($con,"SELECT
            inventory_item.id, 
            inventory_item.image, 
            inventory_item.item_name,
            category_type.name,
            inventory_item.mineral_price
            FROM inventory_item 
            INNER JOIN category_type  
            ON inventory_item.category_by_id = category_type.id  
            WHERE inventory_item.id = '$id'");

    if (mysqli_num_rows($result) > 0) {

    $item = mysqli_fetch_assoc($result); 

    $user_id = $_GET['user_id'];

    $item_name3 = $item['item_name'];
    $category_name3 = $item['name'];
    $selectwater = 'Mineral';
    $mineralprice = $item['mineral_price'];
    $qty3 = 1;

    $total= $qty3 * $mineralprice;

    if (validate_quantity($con, $item_name3, $qty3)) {
        $insert = mysqli_query($con, "INSERT INTO transaction_process VALUES(
                '',
                '$item_name3',
                '$selectwater',
                '$category_name3',
                '$qty3',
                '$mineralprice',
                '$total',
                '$user_id',
                '0')");
        if($insert){
            header("Location: ../pos/point-of-sales.php?update=1");
        }
    } else {
        header("Location: ../pos/point-of-sales.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed add order. Insufficient inventory stock.");
    }
    }
}
?>

<?php
if(isset($_POST['edit-quantity'])){
    if(isset($_POST['quantity'])
        ||isset($_POST['PRICE'])
        ||isset($_POST['total_price'])) {
        $id = $_POST['id'];

        $user_id = $_SESSION['user_user_id'];
        $qty3 = filter_var($_POST['quantity'], FILTER_SANITIZE_STRING);
        $total = filter_var($_POST['total_price'], FILTER_SANITIZE_STRING);
        $price = filter_var($_POST['PRICE'], FILTER_SANITIZE_STRING);
        $total= $qty3 * $price;
        // header("Location: ../common/error-page.php?error=".$qty3);
        // exit();
        $validate_item = mysqli_query($con, "SELECT item_name
                            FROM transaction_process 
                            WHERE id = $id");
        if (mysqli_num_rows($validate_item) > 0) {
            $item_name = mysqli_fetch_assoc($validate_item);
            $item_name3 = $item_name['item_name'];

            if (validate_quantity($con, $item_name3, $qty3)) {
                $update = mysqli_query($con,
                    "UPDATE transaction_process SET
                        transaction_process.quantity = '$qty3',
                        transaction_process.price = '$price',
                        transaction_process.total_price = '$total'
                        WHERE transaction_process.id='$id'");

                if($update){
                    header("Location: ../pos/point-of-sales.php?");
                }
            } else {
                header("Location: ../pos/point-of-sales.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed add order. Insufficient inventory stock.");
            }

        } else {

        }

    }
}
?>