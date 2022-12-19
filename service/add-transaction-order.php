<?php

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

        // header("Location: ../common/error-page.php?error=". $item_id .','. $item_name3.','.$category_name3 .','. $price_item3.','. $qty3);
        // exit();
        $total= $qty3 * $price_item3;
        
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

        // header("Location: ../common/error-page.php?error=". $item_id .','. $item_name3.','.$category_name3 .','. $price_item3.','. $qty3);
        // exit();
        $total= $qty3 * $alkalineprice;

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
        $insert = mysqli_query($con, "INSERT INTO transaction_process VALUES(
                    '',
                    '$item_name3',
                    '$selectwater',
                    '$category_name3',
                    '$qty3',
                    '$mineralprice',
                    '$total',
                    '$user_id',
                    ,'0')");
                if($insert){
                    header("Location: ../pos/point-of-sales.php?update=1");
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

        $update = mysqli_query($con,
        "UPDATE transaction_process SET
        transaction_process.quantity = '$qty3',
        transaction_process.price = '$price',
        transaction_process.total_price = '$total'
        WHERE transaction_process.id='$id'");
                if($update){
                    header("Location: ../pos/point-of-sales.php?");
                }
            }
        } 
        ?>