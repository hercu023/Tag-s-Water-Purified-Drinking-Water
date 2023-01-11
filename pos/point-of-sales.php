<?php
include '../database/connection-db.php';
require_once '../service/pos-add-customer.php';
require_once '../service/add-transaction-order.php';
        
date_default_timezone_set("Asia/Manila");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="../CSS/point-of-sales.css">
    <title>Tag's Water Purified Drinking Water</title>
</head>

<body>
<div class="container">

    <?php
    include('../common/side-menu.php')
    ?>

    <main>
        <div class="main-pos">
            <h1 class="posTitle">POINT OF SALES</h1>
            <?php
            if (isset($_GET['error'])) {
                echo '<p id="myerror" class="error-error"> '.$_GET['error'].' </p>';
            }
            ?>
              
            <!-- </div> -->


            <!-- ---------------------------------------------------- ORDER DETAILS ------------------------------------------------- -->
            <div class="form-container">
                <div class="form1">
                    <div class="form1-ordertype-buttons">
                        <button type="button" class="refillOrder-button" onclick="refillFunction();">Refill</button>
                        <button type="button" class="newOrder-button" onclick="orderFunction();">New</button>
                        <button type="button" class="otherOrder-button" onclick="otherFunction();">Others</button>
                    </div>
                    <hr>
             
                    <div class="form1-table-water">
                        <label class="selectlabel"> Select Water</label>
                        <div class="select-dropdown">
                            <select class='selectTable-water1' id="selectTable-water1" name="select-water" onchange="waterChange(this)">
                                <option value='Alkaline'>Alkaline</option>
                                <option value='Mineral'>Mineral</option>
                            </select>
                         </div>
                        <div class="formTable">
                            <div class="form1-table1" id="form-water1">
                                <?php
                                            $dropdown_query1 = "SELECT * 
                                            FROM inventory_item 
                                            WHERE category_by_id = 1 OR 2 OR 10";
                                            $result1 = mysqli_query($con, $dropdown_query1);
                                    ?>
                                <table class="table1" id="myTable1">
                                    <thead class="form-table">
                                    <tr>

                                        <th scope="col">ITEM</th>
                                        <th scope="col">TYPE</th>
                                        <th scope="col">WATER</th>
                                        <th scope="col">PRICE</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <form action="../service/add-transaction-order.php" method="post" enctype="multipart/form-data" id="addcustomerFrm">
                                        <?php
                                            $query = "SELECT
                                                    inventory_item.id, 
                                                    inventory_item.image, 
                                                    inventory_item.item_name,
                                                    pos_item.pos_type,
                                                    category_type.name,
                                                    inventory_item.alkaline_price,
                                                    status_archive.status
                                                    FROM inventory_item 
                                                    INNER JOIN category_type  
                                                    ON inventory_item.category_by_id = category_type.id  
                                                    INNER JOIN pos_item  
                                                    ON inventory_item.pos_item_id = pos_item.id  
                                                    INNER JOIN status_archive 
                                                    ON inventory_item.status_archive_id = status_archive.id
                                                    WHERE category_by_id = 10
                                                    AND inventory_item.status_archive_id = '1'
                                                    AND inventory_item.pos_item_id = '1'";
                                            $inventory_order = mysqli_query($con, $query);
                                            while ($item_sales = mysqli_fetch_assoc($inventory_order)) {?>
                                            <tbody>
                                            <tr>
                            
                                                <td data-label="ITEM"> <?php echo $item_sales['item_name']; ?></td>
                                                <td data-label="TYPE"> <?php echo $item_sales['name']; ?></td>
                                                <td data-label="WATER"> Alkaline</td>
                                                <td data-label="PRICE"> <?php echo '&#8369'.' '.$item_sales['alkaline_price']; ?></td>
                                                <td>
                                                
                                                    <a href="../service/add-transaction-order.php?addalkaline=<?php echo $item_sales['id'].'&user_id='.$_SESSION['user_user_id']; ?>" class="add-rowsButton" class="action-btn" name="action">
                                                    ADD ORDER 
                                                    </a>
                                                
                                                </td>
                                            </tr>
                                            </tbody>
                                        <?php } ?>
                                    </form>
                                </table>
                            </div>
                        </div>
                        <div class="form1-table2" id="form-water2">
                            <?php
                                        $dropdown_query1 = "SELECT * 
                                        FROM inventory_item 
                                        WHERE category_by_id = 1 OR 2 OR 10";
                                        $result1 = mysqli_query($con, $dropdown_query1);
                                ?>
                            <table class="table1" id="myTable2">
                                <thead class="form-table">
                                <tr>
                        
                                    <th scope="col">ITEM</th>
                                    <th scope="col">TYPE</th>
                                    <th scope="col">WATER</th>
                                    <th scope="col">PRICE</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <form action="../service/add-transaction-order.php" method="post" enctype="multipart/form-data" id="addcustomerFrm">
                                    <?php
                                        $query = "SELECT
                                                inventory_item.id, 
                                                inventory_item.image, 
                                                inventory_item.item_name,
                                                pos_item.pos_type,
                                                category_type.name,
                                                inventory_item.mineral_price,
                                                status_archive.status
                                                FROM inventory_item 
                                                INNER JOIN category_type  
                                                ON inventory_item.category_by_id = category_type.id  
                                                INNER JOIN pos_item  
                                                ON inventory_item.pos_item_id = pos_item.id  
                                                INNER JOIN status_archive 
                                                ON inventory_item.status_archive_id = status_archive.id
                                                WHERE category_by_id = 10
                                                AND inventory_item.status_archive_id = '1'
                                                AND inventory_item.pos_item_id = '1'";
                                        $inventory_order = mysqli_query($con, $query);
                                        if(mysqli_num_rows($inventory_order) > 0)
                                            {
                                            foreach($inventory_order as $item_sales)
                                            {
                                            ?>
                                        <tbody>
                                        <tr>
                             
                                            <td data-label="ITEM"> <?php echo $item_sales['item_name']; ?></td>
                                            <td data-label="TYPE"> <?php echo $item_sales['name']; ?></td>
                                            <td data-label="WATER"> Mineral</td>
                                            <td data-label="PRICE"> <?php echo '&#8369'.' '.$item_sales['mineral_price']; ?></td>
                                            <td>
                                                <a href="../service/add-transaction-order.php?addmineral=<?php echo $item_sales['id'].'&user_id='.$_SESSION['user_user_id']; ?>" class="add-rowsButton" class="action-btn" name="action">
                                                   ADD ORDER 
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                            <?php } else { ?>
                                                <tr id="noRecordTR">
                                                    <td colspan="7">No Item(s) Found</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    
                                </form>
                            </table>
                        </div>
                    </div>
                    <div class="form2-table-water">
                        <label class="selectlabel"> Select Category</label>
                        <div class="select-dropdown">
                            <select class='selectTable-water1' id="selectTable-water1" name="select-water" onchange="waterChange(this)">
                                <option value='Alkaline'>Alkaline</option>
                                <option value='Mineral'>Mineral</option>
                                <option value='Container/Bottle Only'>Container/Bottle Only</option>
                            </select>
                         </div>
                        <div class="form2-table1" id="form-water3">
                            <?php
                                $dropdown_query7 = "SELECT * 
                                FROM inventory_item 
                                WHERE category_by_id = 1 OR 2";
                                $result7 = mysqli_query($con, $dropdown_query7);
                            ?>

                            <table class="table2" id="myTable2">
                                <thead class="form-table">
                                <tr>
                              
                                    <th scope="col">ITEM</th>
                                    <th scope="col">TYPE</th>
                                    <th scope="col">WATER</th>
                                    <th scope="col">PRICE</th>
                                    <th></th>
                                </tr>
                                </thead>
                                    <form action="../service/add-transaction-order.php" method="post" enctype="multipart/form-data" id="addcustomerFrm">
                                        <?php
                                            $query = "SELECT
                                                    inventory_item.id, 
                                                    inventory_item.image, 
                                                    inventory_item.item_name,
                                                    pos_item.pos_type,
                                                    category_type.name,
                                                    inventory_item.selling_price_item,
                                                    inventory_item.alkaline_price,
                                                    status_archive.status
                                                    FROM inventory_item 
                                                    INNER JOIN category_type  
                                                    ON inventory_item.category_by_id = category_type.id  
                                                    INNER JOIN pos_item  
                                                    ON inventory_item.pos_item_id = pos_item.id  
                                                    INNER JOIN status_archive 
                                                    ON inventory_item.status_archive_id = status_archive.id
                                                    WHERE category_by_id = 1
                                                    OR category_by_id = 2
                                                    AND inventory_item.status_archive_id = '1'
                                                    AND inventory_item.pos_item_id = '1'";
                                            $inventory_order = mysqli_query($con, $query);
                                            if(mysqli_num_rows($inventory_order) > 0)
                                            {
                                            foreach($inventory_order as $item_sales)
                                            {
                                            ?>
                                            <tbody>
                                            <tr>
                      
                                            <td data-label="ITEM"> <?php echo $item_sales['item_name']; ?></td>
                                            <td data-label="TYPE"> <?php echo $item_sales['name']; ?></td>
                                            <td data-label="WATER"> Alkaline</td>
                                            <td data-label="PRICE"> <?php echo '&#8369'.' '.$item_sales['alkaline_price']; ?></td>
                                                <td>
                                                
                                                    <a href="../service/add-transaction-order.php?addalkaline=<?php echo $item_sales['id'].'&user_id='.$_SESSION['user_user_id']; ?>" class="add-rowsButton" class="action-btn" name="action">
                                                    ADD ORDER 
                                                    </a>

                                                
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php } else { ?>
                                                <tr id="noRecordTR">
                                                    <td colspan="7">No Item(s) Found</td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                    </form>
                            </table>
                        </div>
                        <div class="form2-table2" id="form-water4">
                            <?php
                                $dropdown_query7 = "SELECT * 
                                FROM inventory_item 
                                WHERE category_by_id = 1 OR 2";
                                $result7 = mysqli_query($con, $dropdown_query7);
                            ?>

                            <table class="table2" id="myTable2">
                                <thead class="form-table">
                                <tr>
                      
                                    <th scope="col">ITEM</th>
                                    <th scope="col">TYPE</th>
                                    <th scope="col">WATER</th>
                                    <th scope="col">PRICE</th>
                                    <th></th>
                                </tr>
                                </thead>
                                    <form action="../service/add-transaction-order.php" method="post" enctype="multipart/form-data" id="addcustomerFrm">
                                        <?php
                                            $query = "SELECT
                                                    inventory_item.id, 
                                                    inventory_item.image, 
                                                    inventory_item.item_name,
                                                    pos_item.pos_type,
                                                    category_type.name,
                                                    inventory_item.selling_price_item,
                                                    inventory_item.mineral_price,
                                                    status_archive.status
                                                    FROM inventory_item 
                                                    INNER JOIN category_type  
                                                    ON inventory_item.category_by_id = category_type.id  
                                                    INNER JOIN pos_item  
                                                    ON inventory_item.pos_item_id = pos_item.id  
                                                    INNER JOIN status_archive 
                                                    ON inventory_item.status_archive_id = status_archive.id
                                                    WHERE category_by_id = 1
                                                    OR category_by_id = 2
                                                    AND inventory_item.status_archive_id = '1'
                                                    AND inventory_item.pos_item_id = '1'";
                                            $inventory_order = mysqli_query($con, $query);
                                            if(mysqli_num_rows($inventory_order) > 0)
                                            {
                                            foreach($inventory_order as $item_sales)
                                            {
                                            ?>
                                            <tbody>
                                            <tr>
                                              
                                                <td data-label="ITEM"> <?php echo $item_sales['item_name']; ?></td>
                                                <td data-label="TYPE"> <?php echo $item_sales['name']; ?></td>
                                                <td data-label="WATER"> Mineral</td>
                                                <td data-label="PRICE"> <?php echo '&#8369'.' '.$item_sales['mineral_price']; ?></td>
                                                <td>
                                                
                                                    <a href="../service/add-transaction-order.php?addmineral=<?php echo $item_sales['id'].'&user_id='.$_SESSION['user_user_id']; ?>" class="add-rowsButton" class="action-btn" name="action">
                                                    ADD ORDER 
                                                    </a>
                                                
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php } else { ?>
                                                <tr id="noRecordTR">
                                                    <td colspan="7">No Item(s) Found</td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        
                                    </form>
                            </table>
                        </div>
                        <div class="form2-table3" id="form-category">
                            <?php
                                $dropdown_query7 = "SELECT * 
                                FROM inventory_item 
                                WHERE category_by_id = 1 OR 2";
                                $result7 = mysqli_query($con, $dropdown_query7);
                            ?>

                            <table class="table2" id="myTable2">
                                <thead class="form-table">
                                <tr>
                                  
                                    <th scope="col">ITEM</th>
                                    <th scope="col">TYPE</th>
                                    <th scope="col">PRICE</th>
                                    <th></th>
                                </tr>
                                </thead>
                                    <form action="../service/add-transaction-order.php" method="post" enctype="multipart/form-data" id="addcustomerFrm">
                                        <?php
                                            $query = "SELECT
                                                    inventory_item.id, 
                                                    inventory_item.image, 
                                                    inventory_item.item_name,
                                                    pos_item.pos_type,
                                                    category_type.name,
                                                    inventory_item.selling_price_item,
                                                    status_archive.status
                                                    FROM inventory_item 
                                                    INNER JOIN category_type  
                                                    ON inventory_item.category_by_id = category_type.id  
                                                    INNER JOIN pos_item  
                                                    ON inventory_item.pos_item_id = pos_item.id  
                                                    INNER JOIN status_archive 
                                                    ON inventory_item.status_archive_id = status_archive.id
                                                    WHERE category_by_id = 1
                                                    OR category_by_id = 2
                                                    AND inventory_item.status_archive_id = '1'
                                                    AND inventory_item.pos_item_id = '1'";
                                            $inventory_order = mysqli_query($con, $query);
                                            if(mysqli_num_rows($inventory_order) > 0)
                                            {
                                            foreach($inventory_order as $item_sales)
                                            {
                                            ?>
                                            <tbody>
                                            <tr>
                                                <td data-label="ITEM"> <?php echo $item_sales['item_name']; ?></td>
                                                <td data-label="TYPE"> <?php echo $item_sales['name']; ?></td>
                                                <td data-label="PRICE" class="mineral-price"> <?php echo '&#8369'.' '.$item_sales['selling_price_item']; ?></td>
                                                <td>
                                                
                                                    <a href="../service/add-transaction-order.php?addothers=<?php echo $item_sales['id'].'&user_id='.$_SESSION['user_user_id']; ?>" class="add-rowsButton" class="action-btn" name="action">
                                                    ADD ORDER
                                                    </a>
                                                
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php } else { ?>
                                                <tr id="noRecordTR">
                                                    <td colspan="7">No Item(s) Found</td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        
                                    </form>
                            </table>
                        </div>
                    </div>

                            <div class="form3-table">
                                <?php
                                    $dropdown_query8 = "SELECT * 
                                    FROM inventory_item 
                                    WHERE category_by_id = 5 OR 7";
                                    $result8 = mysqli_query($con, $dropdown_query8);
                                ?>
                                <table class="table3" id="myTable3">
                                    <thead class="form-table">
                              
                                        <th scope="col">ITEM</th>
                                        <th scope="col">TYPE</th>
                                        <th scope="col">PRICE</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <form action="../service/add-transaction-order.php" method="post" enctype="multipart/form-data" id="addcustomerFrm">
                                        <?php
                                            $query = "SELECT
                                                    inventory_item.id, 
                                                    inventory_item.image, 
                                                    inventory_item.item_name,
                                                    pos_item.pos_type,
                                                    category_type.name,
                                                    inventory_item.selling_price_item,
                                                    status_archive.status
                                                    FROM inventory_item 
                                                    INNER JOIN category_type  
                                                    ON inventory_item.category_by_id = category_type.id  
                                                    INNER JOIN pos_item  
                                                    ON inventory_item.pos_item_id = pos_item.id  
                                                    INNER JOIN status_archive 
                                                    ON inventory_item.status_archive_id = status_archive.id
                                                    WHERE category_by_id = 5
                                                    OR category_by_id = 7
                                                    AND inventory_item.status_archive_id = '1'
                                                    AND inventory_item.pos_item_id = '1'";
                                            $inventory_order = mysqli_query($con, $query);
                                            if(mysqli_num_rows($inventory_order) > 0)
                                            {
                                            foreach($inventory_order as $item_sales)
                                            {
                                            ?>
                                            <tbody>
                                            <tr>
                                            
                                                <td data-label="ITEM"> <?php echo $item_sales['item_name']; ?></td>
                                                <td data-label="TYPE"> <?php echo $item_sales['name']; ?></td>
                                                <td data-label="PRICE" > <?php echo '&#8369'.' '.$item_sales['selling_price_item']; ?></td>
                                                <td>
                                                
                                                    <a href="../service/add-transaction-order.php?addothers=<?php echo $item_sales['id'].'&user_id='.$_SESSION['user_user_id']; ?>" class="add-rowsButton" class="action-btn" name="action">
                                                    ADD ORDER 
                                                    </a>
                                                
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php } else { ?>
                                                <tr id="noRecordTR">
                                                    <td colspan="5">No Item(s) Found</td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        
                                    </form>

                                </table>
                            </div>

                </div>
            </div>
          
            <!-- ---------------------------------------------------- Order Summary ------------------------------------------------- -->

            <div class="form-container-2">
                <div class="totalOrder">
                    <header class="company-name">Tag's Water Purified Drinking Water</header>
                        <div class="date-payment">
                            <div class="dateandtime">
                                <p class="date-Text">Date/Time:
                                    <div class="card">
                                        <h1 id="time" class="time">00:00:00</h1>
                                        <h1 class="dash">-</h1>
                                        <h1 id="date" class="date">00/00/0000</h1>
                                    </div>
                                </p>
                            </div>
                            <div class="delivery-options">
                                <p class="paymentOptions-text">Service</p>
                                <select class="paymentOptions-dropdown" onchange="deliveryOption(this)" id="deliveryoption" name="deliveryoption">
                                    <option value="Walk In">Walk In</option>
                                    <option value="Delivery">Delivery</option>
                                    <option value="Delivery/Pick Up">Delivery/Pick Up</option>
                                </select>
                            </div>
                        </div>

                        <hr class="hr1">
                        <div class="order-sum">
                            <div class="ordersum-text">
                                <p class="orderSummary-text">Order Summary</p>
                            </div>
                            <div class="cashiersum-text">
                                <p class="cashier-text">Cashier: <span id="cashier-name"><input type="text" class="name-cashier" readonly name="cashiername" value="<?php echo $_SESSION['user_first_name']; ?>"></span></p>
                            </div>     
                        </div>
                        <div class="orderSum-table">
                            <table class="tableCheckout" id="sumTable">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th scope="col">ITEM</th>
                                    <th scope="col">Water</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">QTY</th>
                                    <th scope="col">TOTAL</th>
                                </tr>
                                </thead>
                                    <?php           
                                           $user_id =  $_SESSION['user_user_id'];
                                            $transaction_process = "SELECT
                                                    transaction_process.id, 
                                                    transaction_process.item_name, 
                                                    transaction_process.water_type,
                                                    transaction_process.category_type,
                                                    transaction_process.quantity,
                                                    transaction_process.price,
                                                    transaction_process.total_price
                                                    FROM transaction_process
                                                    WHERE user_id = '$user_id' 
                                                    AND transaction_id = '0'";
                                            $transaction_order = mysqli_query($con, $transaction_process);
                                            if(mysqli_num_rows($transaction_order) > 0)
                                            {
                                            foreach($transaction_order as $transactions)
                                            {
                                            ?>

                                            <tbody>
                                            <tr>
                                                <td>
                                                    <a href="../service/delete-transaction-order.php?delete-order=<?php echo $transactions['id']; ?>" class="delete-rowsButton" class="action-btn" name="action">
                                                        X
                                                    </a>
                                                </td>
                                                <td data-label="ITEM" name="itemname_transaction"> <?php echo $transactions['item_name']; ?></td>
                                                <td data-label="WATER" name="watertype_transaction"> <?php echo $transactions['water_type']; ?></td>
                                                <td data-label="TYPE" name="categorytype_transaction"> <?php echo $transactions['category_type']; ?></td>
                                                <td data-label="PRICE" name="price_transaction"> <?php echo '&#8369'.' '. $transactions['price']; ?></td>
                                            <form action="" method="post" enctype="multipart/form-data" id="addqty-<?php echo $transactions['id'] ?>">
                                                <td data-label="QTY" class="quantity-td" > 
                                                    <input type="hidden" name="PRICE" value="<?php echo $transactions['price']; ?>">
                                                    <input type="hidden" name="total_price" value="<?php echo $transactions['total_price']; ?>">
                                                    <input type="hidden" name="id" value="<?php echo $transactions['id']; ?>">
                                                    <input type="hidden" name="edit-quantity" value="">
                                                    <div class="quantity-div">
                                                        <button type="button" class="decrease-btn" onClick="decreaseButton(<?php echo $transactions['id'] ?>)">-</button>
                                                        <input type="text" id="item-quantity-<?php echo $transactions['id'] ?>" onkeyup="this.form.submit();" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode))) return false;" class="item-quantity" min="1" name="quantity" value="<?php echo $transactions['quantity'];?>">
                                                        <button type="button" class="increase-btn" onClick="increaseButton(<?php echo $transactions['id'] ?>)"> +</button>
                                                    </div>
                                                </td>
                                            </form>
                                                <td data-label="TOTAL" > <?php echo '&#8369'.' '. number_format($transactions['total_price'], '2','.',','); ?></td>
                                            </tr>
                                            <?php } ?>
                                            <?php } else { ?>
                                                <tr id="noRecordTR">
                                                    <td colspan="7">No Order(s) Added</td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        
                                      

                                            <tfoot>
                                           
                                            </tfoot>
                                            
                                </table>
                        </div>
                        <div>
                        <?php $transaction_order1 = mysqli_query($con, "SELECT
                                                    sum(transaction_process.total_price)
                                                    FROM transaction_process
                                                    WHERE user_id = '$user_id' 
                                                    AND transaction_id = '0'"); 
                                                    while ($transactions1 = mysqli_fetch_array($transaction_order1)) {?>

            <form action="../service/pos-placeorder.php" method="post" enctype="multipart/form-data" >
                        <hr>
                            <div class="totalamount">
                                <div class="orderTotal-text">Order Subtotal</div>
                                <div id="orderTotal">  <?php echo '&#8369'.' '.number_format($transactions1['sum(transaction_process.total_price)'], '2','.',',');  ?> </div>
                            </div>
                            <div class="totaldelivery">
                                <div class="orderTotal-text">Delivery Fee</div>
                            </div>
                            <div id="delivery-fee"> 
                                <?php
                                    $dropdown_query1 = "SELECT 
                                    delivery_fee.id,
                                    delivery_fee.fee,
                                    delivery_fee.description
                                     FROM delivery_fee";
                                    $result3 = mysqli_query($con, $dropdown_query1);
                                ?>
                                <select class="deliveryfee-dropdown" onchange="deliveryFee(this.value)" required="required">
                                <option selected value="0.00"> 0.00 - No Delivery Fee</option>
                                    <?php while($row3 = mysqli_fetch_array($result3)):;?>
                                        <option value="<?php echo $row3['fee'];?>"><?php echo $row3['fee'].' - '.$row3['description'];?></option>
                                    <?php endwhile;?>
                                </select>
                            </div>
                            <div id="delivery-fee1"> 
                             <label id="deliveryfee_amount1" class="deliveryamount_fee1" min="0" value="0.00"onkeyup="deliveryFee();">----</label>
                            </div>
                        </div>
                        <div>
                            <div class="totaldelivery1"><p class="totalAmount-text">TOTAL AMOUNT</p></div>
                            <div class="total-amount">
                                <input type="hidden" name="user_id" value="<?php echo $user_id?>">
                                <input type="hidden" id="totalamount_value"  value="<?php echo $transactions1['sum(transaction_process.total_price)']; ?>">
                                <input type="hidden" class="deliveryoption_class" name="option" value="Walk In">
                                <label id="total_order1">&#8369</label>
                                <input type="text" name="totalAmount" readonly id="totalAmount_order" value="<?php echo number_format($transactions1['sum(transaction_process.total_price)'], '2','.',','); ?>">
                            </div>
                        </div>
                           
                        <hr>
                        <?php }?>
                        <div class="receipt-buttons">
                            <button type="submit" class="confirmOrder-button" name="place-order">
                                PLACE ORDER
                            </button>
                        </div>
            </form>
                </div>
            </div>
        <!------------------------------------------------------ PREVIOUS TRANSACTIONS ------------------------------------------------- -->
            <div class="form3">
                <div class="previous-transaction">
                    <br>
                    <header class="previous-transaction-header">Previous Transaction</header>
                    <hr>
                    <table class="previous-transaction-table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Order Details</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Payment Option</th>
                                <th scope="col">Service</th>
                                <th scope="col">Note</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Cashier Name</th>
                                <th scope="col">Date/Time</th>
                            </tr>
                        </thead>
                        <?php
                        $dropdown_query2 = "SELECT 
                            transaction.id,
                            transaction.uuid,
                            customers.customer_name,
                            transaction.total_amount,
                            payment_option.option_name,
                            transaction.service_type,
                            transaction.note,
                            transaction.status_id,
                            users.first_name,
                            users.last_name,
                            transaction.created_at_date,
                            transaction.created_at_time
                            FROM transaction
                            INNER JOIN users
                            ON transaction.created_by_id = users.user_id
                            INNER JOIN payment_option
                            ON transaction.payment_option = payment_option.id
                            LEFT JOIN customers
                            ON transaction.customer_name_id = customers.id
                            ORDER BY transaction.created_at_date DESC,
                            transaction.created_at_time DESC
                            LIMIT 5";
                        $result4 = mysqli_query($con, $dropdown_query2);
                        if(mysqli_num_rows($result4) > 0)
                        {
                        foreach($result4 as $rows)
                        {
                            ?>
                            <tbody>
                            <tr>
                                <td data-label="ID"> <?php echo $rows['id']; ?></td>
                                <td data-label="Customer Name"> <?php if($rows['customer_name']){
                                    echo $rows['customer_name'];
                                    }else{
                                        echo 'GUEST';
                                    }
                                 ?></td>
                                <td data-label="Order Details"> <a class="viewTransaction" href="../pos/point-of-sales-viewdetails.php?view=<?php echo $rows['uuid'];?>">View Details</a></td>

                                <td data-label="Total Amount"> <?php echo '<span>&#8369;</span>'.' '.number_format($rows['total_amount'], '2','.',','); ?></td> 
                                <td data-label="Payment Option"> <?php echo $rows['option_name']; ?></td>
                                <td data-label="Service"> <?php echo $rows['service_type']; ?></td>
                                <td data-label="Note"> <?php echo $rows['note']; ?></td>
                                <td data-label="Payment Status"> 
                                    <?php 
                                    if($rows['status_id'] == 0){
                                        echo '<span class="outofstock">Unpaid</span>';
                                    }else{
                                        echo '<span class="instock">Paid</span>';
                                    } ?>
                                </td>
                                <td data-label="Cashier Name"> <?php echo $rows['first_name'] .' '. $rows['last_name'] ; ?></td>
                                <td data-label="Date/Time"> <?php echo $rows['created_at_date'] .' '. $rows['created_at_time']; ?></td>
                            <tr id="noRecordTR" style="display:none">
                                <td colspan="10">No Record Found</td>
                            </tr>
                            </tbody>
                            <?php
                             }}else { ?>
                            <tr id="noRecordTR">
                                <td colspan="10">No Transaction(s) Added</td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>

    </main>
    <div class="top-menu">
                <div class="menu-bar">
                    <div class="menu-btn2">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h2 class="Title-top">POINT OF SALES</h2>
                    <div class="user1">
                        <div class="welcome">
                            <h4 > Welcome, </h4>
                        </div>
                        <div class="user-name">
                            <h4><?php echo $_SESSION['user_first_name']; ?> </h4>
                        </div>
                        <div class="user-type">
                            <h1><?php echo $_SESSION['user_user_type']; ?> </h1>
                        </div>
                    </div>
                    <div class="user2">
                        <div class="profile" onclick="menuToggle();">
                            <img src="../uploaded_image/<?= $_SESSION['user_profile_image']; ?>" alt="">
                        </div>
                        <div class="drop-menu" >
                            <div class="ul">
                                <div class="user-type3">
                                    <h1><?php echo $_SESSION['user_user_type']; ?> </h1>
                                </div>
                                <div class="user-type4">
                                    <?php
                                    $query = "SELECT 
                                    users.user_id,
                                    users.last_name,
                                    users.first_name,
                                    users.middle_name,
                                    users.email,
                                    users.contact_number, 
                                    users.profile_image, 
                                    account_type.user_type, 
                                    status_archive.status 
                                    FROM users 
                                    INNER JOIN account_type 
                                    ON users.account_type_id = account_type.id 
                                    INNER JOIN status_archive 
                                    ON users.status_archive_id = status_archive.id
                                    WHERE users.status_archive_id = '1'
                                    ORDER BY users.user_id";
                                    $result = mysqli_query($con, $query);
                                    if ($rows = mysqli_fetch_assoc($result))
                                    {
                                        ?>
                                    <a href="../accounts/account-view.php?view=<?php echo $_SESSION['user_user_id']; ?>" class="account">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.917 14.167q1.062-.875 2.364-1.313 1.302-.437 2.719-.437 1.417 0 2.719.437 1.302.438 2.385 1.313.688-.855 1.084-1.907.395-1.052.395-2.26 0-2.75-1.916-4.667Q12.75 3.417 10 3.417T5.333 5.333Q3.417 7.25 3.417 10q0 1.208.406 2.26.406 1.052 1.094 1.907ZM10 10.854q-1.229 0-2.073-.844-.844-.843-.844-2.072 0-1.23.844-2.073.844-.844 2.073-.844t2.073.844q.844.843.844 2.073 0 1.229-.844 2.072-.844.844-2.073.844Zm0 7.479q-1.729 0-3.25-.656t-2.646-1.781q-1.125-1.125-1.781-2.646-.656-1.521-.656-3.25t.656-3.25q.656-1.521 1.781-2.646T6.75 2.323q1.521-.656 3.25-.656t3.25.656q1.521.656 2.646 1.781t1.781 2.646q.656 1.521.656 3.25t-.656 3.25q-.656 1.521-1.781 2.646t-2.646 1.781q-1.521.656-3.25.656Zm.021-1.75q1.021 0 2-.312.979-.313 1.771-.896-.771-.604-1.75-.906-.98-.302-2.042-.302-1.062 0-2.031.302-.969.302-1.761.906.792.583 1.782.896.989.312 2.031.312ZM10 9.104q.521 0 .844-.323.323-.323.323-.843 0-.521-.323-.844-.323-.323-.844-.323-.521 0-.844.323-.323.323-.323.844 0 .52.323.843.323.323.844.323Zm0-1.166Zm0 7.437Z"/></svg>
                                        <h4>My Account</h4>
                                    </a>
                                <?php }?>

                                    <a href="../settings/settings-help.php" class="help">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M10 15q.417 0 .708-.292Q11 14.417 11 14t-.292-.708Q10.417 13 10 13t-.708.292Q9 13.583 9 14t.292.708Q9.583 15 10 15Zm-.75-3.188h1.521q0-.77.135-1.093.136-.323.656-.823.73-.708 1.011-1.208.281-.5.281-1.105 0-1.145-.781-1.864Q11.292 5 10.083 5q-1.062 0-1.843.562-.782.563-1.094 1.521l1.354.563q.188-.584.594-.906.406-.323.948-.323.583 0 .958.333t.375.875q0 .479-.323.854t-.719.729q-.729.667-.906 1.094-.177.427-.177 1.51ZM10 18q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                                        <h4>Help</h4>
                                    </a>
                                    <a href="../auth/logout.php" class="logout">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.5 17q-.625 0-1.062-.438Q3 16.125 3 15.5v-11q0-.625.438-1.062Q3.875 3 4.5 3H10v1.5H4.5v11H10V17Zm9-3.5-1.062-1.062 1.687-1.688H8v-1.5h6.125l-1.687-1.688L13.5 6.5 17 10Z"/></svg>
                                        <h4>Logout</h4>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> 
    <!-- =======================================================edit quantity===================================================== -->

    <?php
if(isset($_GET['editquantity']))
{
    $id = $_GET['editquantity'];
    $result = mysqli_query($con,"SELECT
               transaction_process.id, 
               transaction_process.item_name, 
               transaction_process.water_type,
               transaction_process.price,
               transaction_process.category_type,
               transaction_process.quantity,
               transaction_process.total_price
            FROM transaction_process 
            WHERE transaction_process.id = '$id'");

    if (mysqli_num_rows($result) > 0) {
        $item = mysqli_fetch_assoc($result); ?>

        <form action="" method="post" enctype="multipart/form-data" id="addorderFrm">
            <div class="bg-adduserform" id="bg-addform">
                <div class="message"></div>
                <div class="container1">
                   
                    <h1 class="addnew-title">EDIT QUANTITY</h1>
                    <form action="#">
                        <input type="hidden" required="required" name="id" value="<?=$item['id'];?>">
                        <div class="main-user-info">
                            
                            <input type="hidden" required="required" name="itemname" value="<?=$item['item_name'];?>">
                            <input type="hidden" required="required" class="iprice" name="PRICE" value="<?=$item['price'];?>">
                            <input type="hidden" required="required" name="categorytype" value="<?=$item['water_type'];?>">
                            <input type="hidden"  name="TOTAL" class="itotal" value="<?=$item['total_price'];?>">
                            <label for="lastname" class="label-item"><?=$item['item_name'];?></label>

                            <div class="user-input-box">
                                <label for="quantity">Quantity</label>
                                <input type="number" min='1' 
                                       id="quantity" onkeyup="subTotal();"
                                       class="iquantity" value="<?=$item['quantity'];?>"
                                       name="quantity"
                                       
                                       required="required">
                            </div>
                            <div class="line"></div>

                            <div class="bot-buttons">
                                <div class="CancelButton">
                                    <a href="../pos/point-of-sales.php" id="cancel">CANCEL</a>
                                </div>
                                <div class="AddButton">
                                    <button type="submit" id="adduserBtn" name="edit-quantity" >SAVE</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </form>
        <?php 
    }} ?>
  <div id="loading" class="loading">
            <div class="loader"></div>
        </div>
</body>

<script src="../javascript/side-menu-toggle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script src="https://code.jquery.com/jquery.min.js"></script>
<script src="../javascript/point-of-sales-datetime.js"></script>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/point-of-sales.js"></script>
</html>
