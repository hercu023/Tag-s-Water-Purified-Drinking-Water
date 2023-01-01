<?php
include '../database/connection-db.php';
require_once '../service/pos-update-transaction.php';

date_default_timezone_set("Asia/Manila");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!-- <link rel="stylesheet" type="text/css" href="../CSS/point-of-sales.css"> -->
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/outfit" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/galhau-display" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/malberg-trial" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/rajdhani" rel="stylesheet">
    <title>Tag's Water Purified Drinking Water</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> -->
</head>
<body>

<div class="container">

    <?php
    include('../common/side-menu.php')
    ?>

    <main>
        <div class="main-pos">
            <h1 class="posTitle">POINT OF SALES</h1>

            <!-- ---------------------------------------------------- ORDER DETAILS ------------------------------------------------- -->
            <div class="form-container">
                <div class="form1">
                    <!-- <p class="selectCustomer-text" id="selectCustomer-text">SELECT CUSTOMER</p>
                    -->
                    <div class="form1-ordertype-buttons">
                        <button type="button" class="refillOrder-button" onclick="refillFunction();">Refill</button>
                        <button type="button" class="newOrder-button" onclick="orderFunction();">New</button>
                        <button type="button" class="otherOrder-button" onclick="otherFunction();">Others</button>
                    </div>
                    <hr>

                    <!-- <br> -->
             
                    <div class="form1-table-water">
                        <label class="selectlabel"> Select Water</label>
                        <div class="select-dropdown">
                            <select class='selectTable-water1' id="selectTable-water1" name="select-water" onchange="waterChange(this)">
                                <option value='Alkaline'>Alkaline</option>
                                <option value='Mineral'>Mineral</option>
                            </select>
                         </div>
                        <div class="form1-table1" id="form-water1">
                            <?php
                                        $dropdown_query1 = "SELECT * FROM inventory_item WHERE category_by_id LIKE '%1' OR category_by_id LIKE '%2' OR  category_by_id LIKE '%10'";
                                        $result1 = mysqli_query($con, $dropdown_query1);
                                ?>
                            <table class="table1" id="myTable1">
                                <thead class="form-table">
                                <tr>
                                    <th></th>
                                    <th>ITEM</th>
                                    <th>TYPE</th>
                                    <th>WATER</th>
                                    <th>PRICE</th>
                                    <!-- <th>MINERAL PRICE</th> -->
                                    <th></th>
                                </tr>
                                </thead>
                                
                                        <tbody>
                                        <tr>
                                            <td > </td>
                                            <td > </td>
                                            <td > </td>
                                            <td > </td>
                                            <td > </td>
                                            <td>
                                             
                                                <a href="../pos/point-of-sales-edit-alkaline-water.php?edit=<?php echo $item_sales['id']; ?>" class="add-rowsButton" class="action-btn" name="action">
                                                   ADD ORDER <!-- <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.521 17.479v-2.437l4.562-4.563 2.438 2.438-4.563 4.562Zm-7-3.958v-2.459h7.271v2.459Zm14.583-1.188-2.437-2.437.666-.667q.355-.354.865-.364.51-.011.864.364l.709.709q.375.354.364.864-.01.51-.364.865ZM2.521 9.75V7.292h9.958V9.75Zm0-3.771V3.521h9.958v2.458Z"/></svg> -->
                                                </a>
                                            <!-- <button type="submit" class="add-rowsButton" id="add-rowsButton" name="add-others">ADD ORDER</a>    -->
                                               
                                            </td>
                                        </tr>
                                        </tbody>
                                    
                                </form>
                            </table>
                        </div>
                        <div class="form1-table2" id="form-water2">
                           
                            <table class="table1" id="myTable2">
                                <thead class="form-table">
                                <tr>
                                    <th></th>
                                    <th>ITEM</th>
                                    <th>TYPE</th>
                                    <th>WATER</th>
                                    <th>PRICE</th>
                                    <!-- <th>MINERAL PRICE</th> -->
                                    <th></th>
                                </tr>
                                </thead>
                                <form action="../service/add-transaction-order.php" method="post" enctype="multipart/form-data" id="addcustomerFrm">
                                
                                        <tbody>
                                        <tr>
                                            <td ></td>
                                            <td > </td>
                                            <td > </td>
                                            <td ></td>
                                            <td > </td>
                                            <td>
                                                <a href="../pos/point-of-sales-edit-mineral-water.php?edit=<?php echo $item_sales['id']; ?>" class="add-rowsButton" class="action-btn" name="action">
                                                   ADD ORDER <!-- <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.521 17.479v-2.437l4.562-4.563 2.438 2.438-4.563 4.562Zm-7-3.958v-2.459h7.271v2.459Zm14.583-1.188-2.437-2.437.666-.667q.355-.354.865-.364.51-.011.864.364l.709.709q.375.354.364.864-.01.51-.364.865ZM2.521 9.75V7.292h9.958V9.75Zm0-3.771V3.521h9.958v2.458Z"/></svg> -->
                                                </a>
                                            </td>
                                        </tr>
                                        
                                                <tr id="noRecordTR">
                                                    <td colspan="7">No Item(s) Found</td>
                                                </tr>
                                            
                                        </tbody>
                                    
                                </form>
                            </table>
                        </div>
                    </div>
                    <div class="form2-table-water">
                        <label class="selectlabel"> Select Water</label>
                        <div class="select-dropdown">
                            <select class='selectTable-water1' id="selectTable-water1" name="select-water" onchange="waterChange(this)">
                                <option value='Alkaline'>Alkaline</option>
                                <option value='Mineral'>Mineral</option>
                            </select>
                         </div>
                        <div class="form2-table1" id="form-water3">
                            <?php
                                $dropdown_query7 = "SELECT * FROM inventory_item WHERE category_by_id LIKE '%1' OR category_by_id LIKE '%2'";
                                $result7 = mysqli_query($con, $dropdown_query7);
                            ?>
                            <!-- <div class="selectItem">
                                <select id='selectTable-water2'class='selectTable-water2'>
                                    <option value='Alkaline'>Alkaline</option>
                                    <option value='Mineral'>Mineral</option>
                                </select>
                            </div> -->
                            <table class="table2" id="myTable2">
                                <thead class="form-table">
                                <tr>
                                    <th></th>
                                    <th>ITEM</th>
                                    <th>TYPE</th>
                                    <th>WATER</th>
                                    <th>PRICE</th>
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
                                                    WHERE category_by_id LIKE '%1' 
                                                    OR category_by_id LIKE '%2' 
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
                                                <td > <img src="<?php echo "../uploaded_image/".$item_sales['image']; ?>" alt='No Image' width="100px"></td>
                                                <td > <?php echo $item_sales['item_name']; ?></td>
                                                <td > <?php echo $item_sales['name']; ?></td>
                                                <td > Alkaline</td>
                                                <td class="alkaline-price"> <?php echo '&#8369'.' '.$item_sales['alkaline_price']; ?></td>
                                                <td>
                                                
                                                    <a href="../pos/point-of-sales-edit-mineral-water.php?edit=<?php echo $item_sales['id']; ?>" class="add-rowsButton" class="action-btn" name="action">
                                                    ADD ORDER <!-- <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.521 17.479v-2.437l4.562-4.563 2.438 2.438-4.563 4.562Zm-7-3.958v-2.459h7.271v2.459Zm14.583-1.188-2.437-2.437.666-.667q.355-.354.865-.364.51-.011.864.364l.709.709q.375.354.364.864-.01.51-.364.865ZM2.521 9.75V7.292h9.958V9.75Zm0-3.771V3.521h9.958v2.458Z"/></svg> -->
                                                    </a>
                                                <!-- <button type="submit" class="add-rowsButton" id="add-rowsButton" name="add-others">ADD ORDER</a>    -->
                                                
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
                                $dropdown_query7 = "SELECT * FROM inventory_item WHERE category_by_id LIKE '%1' OR category_by_id LIKE '%2'";
                                $result7 = mysqli_query($con, $dropdown_query7);
                            ?>
                            <!-- <div class="selectItem">
                                <select id='selectTable-water2'class='selectTable-water2'>
                                    <option value='Alkaline'>Alkaline</option>
                                    <option value='Mineral'>Mineral</option>
                                </select>
                            </div> -->
                            <table class="table2" id="myTable2">
                                <thead class="form-table">
                                <tr>
                                    <th></th>
                                    <th>ITEM</th>
                                    <th>TYPE</th>
                                    <th>WATER</th>
                                    <th>PRICE</th>
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
                                                    WHERE category_by_id LIKE '%1' 
                                                    OR category_by_id LIKE '%2' 
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
                                                <td > <img src="<?php echo "../uploaded_image/".$item_sales['image']; ?>" alt='No Image' width="100px"></td>
                                                <td > <?php echo $item_sales['item_name']; ?></td>
                                                <td > <?php echo $item_sales['name']; ?></td>
                                                <td > Mineral</td>
                                                <td class="mineral-price"> <?php echo '&#8369'.' '.$item_sales['mineral_price']; ?></td>
                                                <td>
                                                
                                                    <a href="../pos/point-of-sales-edit-mineral-water.php?edit=<?php echo $item_sales['id']; ?>" class="add-rowsButton" class="action-btn" name="action">
                                                    ADD ORDER <!-- <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.521 17.479v-2.437l4.562-4.563 2.438 2.438-4.563 4.562Zm-7-3.958v-2.459h7.271v2.459Zm14.583-1.188-2.437-2.437.666-.667q.355-.354.865-.364.51-.011.864.364l.709.709q.375.354.364.864-.01.51-.364.865ZM2.521 9.75V7.292h9.958V9.75Zm0-3.771V3.521h9.958v2.458Z"/></svg> -->
                                                    </a>
                                                <!-- <button type="submit" class="add-rowsButton" id="add-rowsButton" name="add-others">ADD ORDER</a>    -->
                                                
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
                                    $dropdown_query8 = "SELECT * FROM inventory_item WHERE category_by_id LIKE '%5' OR category_by_id LIKE '%7'";
                                    $result8 = mysqli_query($con, $dropdown_query8);
                                ?>
                                <table class="table3" id="myTable3">
                                    <thead class="form-table">
                                        <th></th>
                                        <th>ITEM</th>
                                        <th>TYPE</th>
                                        <th>Price</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <form action="../service/add-transaction-order.php" method="post" enctype="multipart/form-data" id="addcustomerFrm">
                                        
                                            <tbody>
                                            <tr>
                                                <td > </td>
                                                <td ></td>
                                                <td > </td>
                                                <td > </td>
                                                <td>
                                                
                                                    <a href="../pos/point-of-sales-edit.php?edit=<?php echo $item_sales['id']; ?>" class="add-rowsButton" class="action-btn" name="action">
                                                    ADD ORDER <!-- <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.521 17.479v-2.437l4.562-4.563 2.438 2.438-4.563 4.562Zm-7-3.958v-2.459h7.271v2.459Zm14.583-1.188-2.437-2.437.666-.667q.355-.354.865-.364.51-.011.864.364l.709.709q.375.354.364.864-.01.51-.364.865ZM2.521 9.75V7.292h9.958V9.75Zm0-3.771V3.521h9.958v2.458Z"/></svg> -->
                                                    </a>
                                                <!-- <button type="submit" class="add-rowsButton" id="add-rowsButton" name="add-others">ADD ORDER</a>    -->
                                                
                                                </td>
                                            </tr>
                                           
                                                <tr id="noRecordTR">
                                                    <td colspan="5">No Item(s) Found</td>
                                                </tr>
                                            
                                            </tbody>
                                        
                                    </form>

                                </table>
                            </div>
                    
                    <!-- </div> -->
                     <!-- <div class="form1-buttons">
                        <button class="addDeliveryFee-button">Add Delivery Fee</button>
                        <button class="addOrder-button" id="addOrder-form">Place Order</button>
                    </div> -->
                </div>
            </div>
            <!-- ------------------------------------------------------------------------------------------------------------------- -->
           
            <!-- ---------------------------------------------------- Order Summary ------------------------------------------------- -->

            
            <div class="form-container-2">
                
            <div class="totalOrder">
                    <header class="company-name">Tag's Water Purified Drinking Water</header>
                    <body>
                        <div class="date-payment">
                            <div class="dateandtime">
                                <p class="date-Text">Date and Time:
                                    <div class="card">
                                        <h1 id="time" class="time">00:00:00</h1>
                                        <h1 class="dash">-</h1>
                                        <h1 id="date" class="date">00/00/0000</h1>
                                        <h1 class="day"><?php echo date("l") ?></h1>
                                    </div>
                                </p>
                            </div>
                            <div class="delivery-options">
                                <p class="paymentOptions-text">Service</p>
                                <select class="paymentOptions-dropdown" onchange="deliveryOption(this)" name="option">
                                    <option value="Walk In">Walk In</option>
                                    <option value="Delivery">Delivery</option>
                                    <option value="Pick Up">Pick Up</option>
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
                                    <th>ITEM</th>
                                    <th>Water</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>QTY</th>
                                    <th>TOTAL</th>
                                </tr>
                                </thead>
                            <form action="" method="post" enctype="multipart/form-data" id="addcustomerFrm">
                                    <?php
                                
                                            ?>
                                            <!-- while ($transactions = mysqli_fetch_assoc($transaction_order)) {?> -->
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <a href="../service/delete-transaction-order.php?delete-order=" class="delete-rowsButton" class="action-btn" name="action">
                                                        X<!-- <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M6.271 17.708q-1.042 0-1.75-.708-.709-.708-.709-1.75V5.729H2.333V3.271h5.188V1.792h4.917v1.479h5.229v2.458h-1.479v9.521q0 1.042-.709 1.75-.708.708-1.75.708Zm1.354-3.729h1.979v-7H7.625Zm2.771 0h1.979v-7h-1.979Z"/></svg> -->
                                                    </a>
                                                </td>
                                                <td name="itemname_transaction"></td>
                                                <td name="watertype_transaction"> </td>
                                                <td name="categorytype_transaction"></td>
                                                <td name="price_transaction"> </td>
                                                <td class="quantity-td" > 
                                                    <a href="../pos/point-of-sales-edit-quantity.php?editquantity=" class="addquantity" name="addquantity">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.708 17.958q-1.125 0-1.896-.77-.77-.771-.77-1.896V4.708q0-1.125.77-1.895.771-.771 1.896-.771h10.584q1.125 0 1.896.771.77.77.77 1.895v10.584q0 1.125-.77 1.896-.771.77-1.896.77Zm0-2.666h10.584V4.708L4.708 15.292Zm6.73-.875v-1.521H9.917v-1.458h1.521V9.917h1.458v1.521h1.521v1.458h-1.521v1.521ZM5.229 8.208h4.479V6.729H5.229Z"/></svg>
                                                    </a>
                                                    
                                                </td>
                                                <td> </td>
                                            </tr>
                                                <tr id="noRecordTR">
                                                    <td colspan="7">No Order(s) Added</td>
                                                </tr>
                                            </tbody>
                                        
                                      

                                            <tfoot>
                                            <?php $transaction_order1 = mysqli_query($con, "SELECT
                                                    sum(transaction_process.total_price)
                                                    FROM transaction_process"); 
                                                    while ($transactions1 = mysqli_fetch_array($transaction_order1)) {?>
                                                <tr class="trdelivery">
                                                    <th colspan="6" class="deliveryfee">
                                                        <!-- <button type="button" id="Delivery-Button" class="addDelivery-fee">Add Delivery Fee</button> -->
                                                        <div class="gender-category" >
                                                            <label class="delivery-lbl" id="delivery-lbl">Service Fee</label>    
                                                            <input type="radio" name="pos_item" id="Yes" value="1" required="required" onclick="mainForm1()">
                                                            <label class="delivery-yes" id="delivery-yes"for="Yes">Delivery Only</label>
                                                            <input type="radio" name="pos_item" id="Maybe" value="2" required="required" onclick="mainForm1()">
                                                            <label class="delivery-yes" id="pickup-yes" for="Yes">Delivery/Pick Up</label>
                                                            <input type="radio" name="pos_item" id="No" value="3" onclick="mainForm2()">
                                                            <label class="delivery-no" id="delivery-no" for="No">None</label>
                                                        </div>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="6" class="totalamount"><p class="orderTotal-text">Order Subtotal</p></th>
                                                    <!-- <th id="total_order1"> </th> -->
                                                    <th id="total_order"> <?php echo '&#8369'.' '.number_format($transactions1['sum(transaction_process.total_price)'], '2','.',',');  ?></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="6" class="totaldelivery"><p class="orderTotal-text">Delivery Fee</p></th>
                                                    <!-- <th id="total_order1"> </th> -->
                                                    <th id="total_order"> <?php echo '&#8369'.' '.'0.00';  ?></th>
                                                </tr>     
                                                <tr>
                                                    <th colspan="6" class="totaldelivery"><p class="totalAmount-text">TOTAL AMOUNT</p></th>
                                                    
                                                    <th><label id="total_order1">&#8369</label><input type="text" name="totalAmount" readonly id="totalAmount_order" value="<?php echo number_format($transactions1['sum(transaction_process.total_price)'], '2','.',','); ?>"></th>
                                                </tr>
                                            </tfoot>
                                </table>
                            </form>
                        </div>
                        <hr>
                        <?php }?>

                        <div class="receipt-buttons">
                            <!-- <a href="point-of-sales.php" id="cancel">CANCEL</a> -->
                            <a href="../pos/point-of-sales-placeorder.php" class="confirmOrder-button" name="placeorder">
                                PLACE ORDER
                            </a>
                        </div>
                    </body>
                </div>
            </div>
        <!-- ---------------------------------------------------- PREVIOUS TRANSACTIONS ------------------------------------------------- -->
            <div class="form3">
                <div class="previous-transaction">
                    <br>
                    <header class="previous-transaction-header">Previous Transaction</header>
                    <hr>
                    <table class="previous-transaction-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Order Details</th>
                            <th>Change</th>
                            <th>Amount Tendered</th>
                            <th>Payment</th>
                            <th>Service</th>
                            <th>Cashier Name</th>
                            <th>Date/Time</th>
                        </tr>
                        </thead>
                   
                            <tbody>
                            <tr>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td> </td>
                                <td></td>
                            <tr id="noRecordTR" style="display:none">
                                <td colspan="10">No Record Found</td>
                            </tr>
                            </tbody>
                        
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
                                <input type="checkbox" class="checkbox" id="checkbox">
                                <label for="checkbox" class="theme-dark">
                                    <svg class="moon" xmlns="http://www.w3.org/2000/svg" height="18" width="18"><path d="M10 17q-2.917 0-4.958-2.042Q3 12.917 3 10q0-2.917 2.042-4.958Q7.083 3 10 3q.271 0 .531.021.261.021.531.062-.812.605-1.291 1.5-.479.896-.479 1.917 0 1.771 1.218 2.99 1.219 1.218 2.99 1.218 1.021 0 1.917-.479.895-.479 1.5-1.291.041.27.062.531.021.26.021.531 0 2.917-2.042 4.958Q12.917 17 10 17Z"/></svg>
                                    <svg class="sun" xmlns="http://www.w3.org/2000/svg" height="18" width="18"><path d="M10 14q-1.667 0-2.833-1.167Q6 11.667 6 10q0-1.667 1.167-2.833Q8.333 6 10 6q1.667 0 2.833 1.167Q14 8.333 14 10q0 1.667-1.167 2.833Q11.667 14 10 14Zm-8.25-3.25q-.312 0-.531-.219Q1 10.312 1 10q0-.312.219-.531.219-.219.531-.219h2q.312 0 .531.219.219.219.219.531 0 .312-.219.531-.219.219-.531.219Zm14.5 0q-.312 0-.531-.219-.219-.219-.219-.531 0-.312.219-.531.219-.219.531-.219h2q.312 0 .531.219Q19 9.688 19 10q0 .312-.219.531-.219.219-.531.219ZM10 4.5q-.312 0-.531-.219-.219-.219-.219-.531v-2q0-.312.219-.531Q9.688 1 10 1q.312 0 .531.219.219.219.219.531v2q0 .312-.219.531-.219.219-.531.219ZM10 19q-.312 0-.531-.219-.219-.219-.219-.531v-2q0-.312.219-.531.219-.219.531-.219.312 0 .531.219.219.219.219.531v2q0 .312-.219.531Q10.312 19 10 19ZM5.042 6.104 4 5.042q-.229-.209-.229-.511 0-.302.229-.531.208-.229.521-.229.312 0 .521.229l1.062 1.042q.229.229.229.531 0 .302-.229.531-.208.229-.521.229-.312 0-.541-.229ZM14.958 16l-1.062-1.042q-.229-.229-.229-.531 0-.302.229-.531.208-.229.521-.229.312 0 .541.229L16 14.958q.229.209.229.511 0 .302-.229.531-.229.229-.521.229-.291 0-.521-.229Zm-1.062-9.896q-.229-.208-.229-.521 0-.312.229-.541L14.958 4q.23-.229.521-.219.292.011.521.219.229.229.229.521 0 .291-.229.521l-1.042 1.062q-.229.229-.531.229-.302 0-.531-.229ZM4 16q-.229-.208-.229-.521 0-.312.229-.521l1.042-1.062q.229-.208.531-.208.302 0 .531.208.229.229.219.531-.011.302-.219.531L5.042 16q-.209.229-.511.229-.302 0-.531-.229Z"/></svg>
                                    <div class="ball"></div>
                                </label>
                                </input>
                                <a href="#" class="account">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.917 14.167q1.062-.875 2.364-1.313 1.302-.437 2.719-.437 1.417 0 2.719.437 1.302.438 2.385 1.313.688-.855 1.084-1.907.395-1.052.395-2.26 0-2.75-1.916-4.667Q12.75 3.417 10 3.417T5.333 5.333Q3.417 7.25 3.417 10q0 1.208.406 2.26.406 1.052 1.094 1.907ZM10 10.854q-1.229 0-2.073-.844-.844-.843-.844-2.072 0-1.23.844-2.073.844-.844 2.073-.844t2.073.844q.844.843.844 2.073 0 1.229-.844 2.072-.844.844-2.073.844Zm0 7.479q-1.729 0-3.25-.656t-2.646-1.781q-1.125-1.125-1.781-2.646-.656-1.521-.656-3.25t.656-3.25q.656-1.521 1.781-2.646T6.75 2.323q1.521-.656 3.25-.656t3.25.656q1.521.656 2.646 1.781t1.781 2.646q.656 1.521.656 3.25t-.656 3.25q-.656 1.521-1.781 2.646t-2.646 1.781q-1.521.656-3.25.656Zm.021-1.75q1.021 0 2-.312.979-.313 1.771-.896-.771-.604-1.75-.906-.98-.302-2.042-.302-1.062 0-2.031.302-.969.302-1.761.906.792.583 1.782.896.989.312 2.031.312ZM10 9.104q.521 0 .844-.323.323-.323.323-.843 0-.521-.323-.844-.323-.323-.844-.323-.521 0-.844.323-.323.323-.323.844 0 .52.323.843.323.323.844.323Zm0-1.166Zm0 7.437Z"/></svg>
                                    <h4>My Account</h4>
                                </a>
                                <a href="#" class="help">
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
</div>
<?php
    if(isset($_GET['uuid'])){
        $uuid = $_GET['uuid'];
    $result = mysqli_query($con, "SELECT
                                customers.id AS customerid,
                                customers.customer_name,
                                customers.balance,
                                transaction.total_amount,
                                payment_option.option_name,
                                transaction.service_type,
                                transaction.created_at_date,
                                transaction.created_at_time
                                FROM transaction 
                                LEFT JOIN customers  
                                ON transaction.customer_name_id = customers.id 
                                LEFT JOIN payment_option  
                                ON transaction.payment_option = payment_option.id   
                                WHERE transaction.uuid='$uuid'");
        $transaction = mysqli_fetch_assoc($result);
        ?>
    <form action="" method="post" enctype="multipart/form-data" id="placeorderFrm">
        <div class="bg-placeorderform" id="bg-placeform">
            <input type="hidden" name="uuid" value="<?php echo $uuid; ?>">
            <div class="container1">
                <h1 class="addnew-title">PAYMENT DETAILS</h1>
                <?php
                    if (isset($_GET['error'])) {
                            echo '<p id="myerror" class="error-error" > '.$_GET['error'].' </p>';
                    }
                ?>
                <form action="#">
                    <div class="main-user-info">
                        <div class="customerName">
                            <label for="contact_num2">Customer Name</label>
                            <input type="hidden" name="customername" value="<?php echo $transaction['customerid']?>"/>
                            <span class="customer_name"><?php echo $transaction['customer_name']?></span>
                        </div>
                            <div class="payment-options1">
                                <p class="paymentOptions-text">Payment Option</p>
                                <input type="text" name="serviceoption" readonly class="service-options"value="<?php echo $transaction['option_name']?>"></input>
                            </div>
                            <div class="payment-options2">
                                <p class="paymentOptions-text">Service</p>
                                <input name="serviceoption" readonly class="service-options"value="<?php echo $transaction['service_type']?>">
                            </div>
                            <?php 
                                    $transaction_unpaid = "SELECT
                                    transaction_history.unpaid_amount
                                    FROM transaction_history
                                    WHERE transaction_uuid = '$uuid'
                                    ORDER BY transaction_history.created_at DESC 
                                    LIMIT 1";
                                    $transaction_unpaid_history = mysqli_query($con, $transaction_unpaid);
                                    if(mysqli_num_rows($transaction_unpaid_history) > 0)
                                    {
                                        $unpaid_amount = mysqli_fetch_assoc($transaction_unpaid_history)['unpaid_amount'];
                                ?>
                        <div class="payment-section">
                            <div class="user-input-box-totalamount">
                                <label for="total-amount2">TOTAL UNPAID AMOUNT</label>
                                <input type="text" id="total-amount2" class="total-amount2" onkeypress="return isNumberKey(event)"name="totalAmount" value="<?php echo $unpaid_amount ?>"readonly/>
                            </div>
                            
                            <div class="user-input-box-cashpayment">
                                <label for="cash-payment2">Cash Payment</label>
                                <input type="text" id="cash-payment2"class="cash-payment2" required onkeypress="return isNumberKey(event)" name="cashpayment" placeholder="0.00" onkeyup="cashChange();"/>
                            </div>
                        <?php }?>
                            
                            <div class="user-input-box-cashpayment">
                        
                            </div>
                            <div class="user-input-box-cashpayment">
                                <label for="cash-payment2">Available Balance</label>
                                <input type="text" id="cash-balance"class="cash-balance" value="<?php echo $transaction['balance']; ?>" readonly onkeypress="return isNumberKey(event)"name="cashbalance"/>
                            </div>
                        </div>
                        <?php }?>
                        
                       
                        <div class="line"></div>

                        <div class="bot-buttons">
                            <div class="CancelButton">
                                <a href="../pos/point-of-sales.php" id="cancel">CANCEL</a>
                            </div>
                            <div class="AddButton">
                                <button type="submit" id="addcustomerBtn" name="update-transaction">SAVE ONLY</button>
                            </div>
                            <div class="AddPrintButton">
                                <button type="submit" id="addcustomerBtn" name="update-transaction" onclick="print();">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M15 6H5V3h10Zm-.25 4.5q.312 0 .531-.219.219-.219.219-.531 0-.312-.219-.531Q15.062 9 14.75 9q-.312 0-.531.219Q14 9.438 14 9.75q0 .312.219.531.219.219.531.219Zm-1.25 5v-3h-7v3ZM15 17H5v-3H2V9q0-.833.583-1.417Q3.167 7 4 7h12q.833 0 1.417.583Q18 8.167 18 9v5h-3Z"/></svg>
                                    SAVE AND PRINT
                                </button>
                            </div>
                        </div>
                        

                    </div>
                </form>
            </div>
        </div>
    </form>

 
                <form action="#">
                                     
                </form>
</body>
<script src="../javascript/side-menu-toggle.js"></script>
<!-- <script src="../javascript/top-menu-toggle.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script> -->
<script src="https://code.jquery.com/jquery.min.js"></script>
<!-- <script src="../javascript/point-of-sales.js"></script> -->

<script>
    setTimeout(function() {
        $('#myerror').fadeOut('fast');
    }, 10000);

    function cashChange(){
        console.log('bal');
        try{
            console.log('try');
            let totalamountvalue = parseFloat(document.getElementById("total-amount2").value);
            var deliveryfee_value = document.getElementById("cash-payment2").value;
            let deliveryfee = 0.00;
            if(!isNaN(deliveryfee_value) && deliveryfee_value !== ''){
                deliveryfee = parseFloat(document.getElementById("cash-payment2").value);
            }

            let totalAmount = totalamountvalue;
            let total = deliveryfee - totalAmount; 
            document.getElementById("cash-change").value = total.toFixed(2),'.',',';
            // if(deliveryfee_value == ''){
            //     document.getElementById("deliveryfee_amount").value = 0.00.toFixed(2);
            // }
        }catch(err){
            console.log('catch');
    
        }
    }

    function customerBal() {
        console.log('bal');
        var selectElement = document.querySelector('#chosen');
        var id = selectElement.value;
        let name = 'customerbalance' + id;
        let balance = document.querySelector('#' + name).value;
        document.querySelector('#cash-balance').value = balance;
    }

    new TomSelect("#chosen",{
            create: false,
            sortField: {
            field: "text",
            direction: "asc"
        }
    });
    
    function guestCustomer(){
        var guestTxt = document.getElementById("guest-button");
        var selectLbl = document.getElementById("selectCustomer-text");
        container2 = document.querySelector(".bg-selectcustomerform");

        selectLbl.innerHTML = guestTxt.value;
        container2.style.display = 'none';
    }
    
    // function selectCus(){
       
            // }
    // -----------------------------SEARCH BAR

 
// ----------------------------------------------------------DROP DOWN PROFILE
    function menuToggle(){
    const toggleMenu = document.querySelector('.drop-menu');
    toggleMenu.classList.toggle('user2')
}

// -----------------------------date and time
var today = new Date();
var day = today.getDate();
var month = today.getMonth() + 1;

function appendZero(value) {
    return "0" + value;
}

function theTime() {
    var d = new Date();
    document.getElementById("time").innerHTML = d.toLocaleTimeString("en-US");
}

if (day < 10) {
    day = appendZero(day);
}

if (month < 10) {
    month = appendZero(month);
}

today = day + "/" + month + "/" + today.getFullYear();

document.getElementById("date").innerHTML = today;

var myVar = setInterval(function () {
    theTime();
}, 1000);
//    --------------------------------------------------------------------
const closeBtn = document.querySelector('#close-btn');
closeBtn.addEventListener('click', () =>{
    sideMenu.style.display = 'none';
})
const checkbox = document.getElementById('checkbox');

checkbox.addEventListener( 'change', () =>{
    document.body.classList.toggle('dark-theme');
});
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function tableSearch(){
    let input, filter, table, tr,
    customername, address, contactnum1, contactnum2, note; i;

    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("customerTable");
    tr = table.getElementsByTagName("tr");


        for(i = 0; i < tr.length; i++){
           
            customername = tr[i].getElementsByTagName("td")[1];
            address = tr[i].getElementsByTagName("td")[2];
            contactnum1 = tr[i].getElementsByTagName("td")[3];
            contactnum2 = tr[i].getElementsByTagName("td")[4];
            note = tr[i].getElementsByTagName("td")[6];

            if(customername || address || contactnum1 || contactnum2 || note){
                var customername_value = customername.textContent || customername.innerText;
                var address_value = address.textContent || address.innerText;
                var contactnum1_value = contactnum1.textContent || contactnum1.innerText;
                var contactnum2_value = contactnum2.textContent || contactnum2.innerText;
                var note_value = note.textContent || note.innerText;

                if(customername_value.toUpperCase().indexOf(filter) > -1||
                address_value.toUpperCase().indexOf(filter) > -1 ||
                contactnum1_value.toUpperCase().indexOf(filter) > -1 ||
                contactnum2_value.toUpperCase().indexOf(filter) > -1 ||
                note_value.toUpperCase().indexOf(filter) > -1){
                    tr[i].style.display ="";
                }
                else{
                    tr[i].style.display = "none";
                }
                if($('#customerTable tbody tr:visible').length === 0) {
                document.getElementById('noRecordTR').style.display = "";
            }else{
                document.getElementById('noRecordTR').style.display = "none";
            }
            }
            if($('#customerTable tbody tr:visible').length === 0) {
                document.getElementById('noRecordTR').style.display = "";
            }else{
                document.getElementById('noRecordTR').style.display = "none";
            }
        }   
}
</script>
</html>
<style>
    :root{
    --color-main: rgb(2, 80, 2);
    --color-white: white;
    --color-white-secondary: white;
    --color-tertiary: hsl(0, 0%, 57%);
    --color-black: rgb(49, 49, 49);
    --color-maroon: rgb(136, 0, 0);
    --color-total-amount: #FFCFCF;
    --color-secondary-main: rgb(244, 255, 246);
    --color-background: rgb(235, 235, 235);
    --color-solid-gray: rgb(126, 126, 126);
    --color-td:rgb(100, 100, 100);
    --color-blue-button: rgb(62, 178, 255);
    --color-button: rgb(117, 117, 117);
    --color-table-shadow: rgb(244, 255, 246);
    --color-shadow-shadow: rgb(116, 116, 116);
    --color-table-hover: rgb(244, 255, 246);
    --color-aside-mobile-focus: rgb(78, 150, 78);
    --color-aside-mobile-text: hsl(0, 0%, 57%);
    --color-select-customer:rgb(9, 138, 107);
    --color-new-customer:rgb(169, 109,5);
    --color-return-container:rgb(54, 85, 225);
    --color-table-title:rgb(0, 197, 145);
    --color-table-border:rgb(226, 226, 229);
    --color-secondary-background:rgb(244, 244, 244);
    --color-lightest-gray:rgb(250,250,250);
    --color-light-blue: #E0FFFF;
}
.dark-theme{
    --color-white: rgb(48, 48, 48);
    --color-tertiary: hsl(0, 0%, 25%);
    --color-black: white;
    --color-total-amount: #B22222;
    --color-light-blue: #4682B4;
    --color-shadow-shadow: rgb(32, 32, 32);
    --color-aside-mobile-focus: rgb(244, 255, 246);
    --color-table-shadow: rgb(131, 131, 131);
    --color-maroon: rgb(255, 130, 130);
    --color-blue-button: rgb(164, 219, 255);
    --color-white-secondary: rgb(235, 235, 235);
    --color-main: rgb(244, 255, 246);
    --color-secondary-main: rgb(97, 172, 111);
    --color-background: rgb(80, 80, 80);
    --color-solid-gray: rgb(231, 231, 231);
    --color-td: rgb(231, 231, 231);
    --color-button: rgb(202, 202, 202);
    --color-table-hover: rgb(112, 112, 112);
    --color-aside-mobile-text:hsl(0, 0%, 88%);
}

BODY{
    background: var(--color-background);
    margin: 0;
    padding: 0;
    height: 100%;
    overflow-x: hidden;
    font-family: Arial, Helvetica, sans-serif;
    background-position: center;
    background-size: cover;
    background-attachment: fixed;
}
.customer_name{
    color: var(--color-main);
    text-transform: uppercase;
    margin-left: 1.5rem;
    font-family: 'Cocogoose', sans-serif;
    font-size: 1rem;
}
.deliveryfee{
    text-align: left;
    align-items: left;
}
.delivery-no{
    display: none;
}
.delivery-yes{
    display: none;
}
#Yes{
    display: none;
}
#Maybe{
    display: none;
}
#No{
    display: none;
}
.delivery-lbl{
    color: var(--color-black);
    border-bottom: 2px solid var(--color-solid-gray);
    font-weight: 800;
    font-size: .8rem;
    margin-right: 1rem;
    display: none;
}
.addquantity{
    border: none;
    font-weight: 700;
    fill: var(--color-solid-gray);
    border-radius: 5px;
    color: var(--color-solid-gray);
}
.minusquantity{
    position: relative;
    display: inline-block;
    border: none;
    border-radius: 3px;
    font-weight: 600;
    background-color: none;
    color: var(--color-solid-gray);
}
.quantity-td{
    min-width: 5rem;
    width: 10%;
    gap: 1rem;
    justify-content: center;
}
.quantity-tbl{
    width: 30%;
    color: var(--color-solid-gray);
    background: none;
    outline: none;
    display: inline-block;
    text-align: center;
    align-items: center;
    border: none;
}
.quantity-tbl:focus{
    outline: none;
}
.select-dropdown{
    align-items: left;
    margin-bottom: 1rem;
    text-align: left;
    position: relative;
    display: inline-block;
    margin-left:2rem;
}
.iprice{
    border: none;
    width: 5rem;
    text-align: center;
    align-items: center;
    font-family: 'Switzer', sans-serif;
    color: var(--color-td);
    font-size: .67rem;
}
.iquantity{
    border: none;
    align-items: center;
    width: 2rem;
    text-align: center;
    margin-left: 1rem;
    font-family: 'Switzer', sans-serif;
    color: var(--color-td);
    font-size: .67rem;
}
.iprice:focus{
    outline: none;
}
.itotal{
    border: none;
    align-items: center;
    width: 2rem;
    text-align: center;
    margin-left: 1rem;
    font-family: 'Switzer', sans-serif;
    color: var(--color-td);
    font-size: .67rem;
}
.itotal:focus{
    outline: none;
}

.iquantity:focus{
    outline: none;

}
.selectItem{
    margin-bottom: 1rem;
    align-items: left;
    text-align: left;
}
.form-table{
    /* background-color: var(--color-solid-gray); */
}
/* ----------------------------------------------SELECT CUSTOMER------------------------------------- */

.bg-selectcustomerform{
    height: 100%;
    width: 100%;
    background: rgba(0,0,0,0.7);
    top: 0;
    position: absolute;
    display: none;
    align-items: center;
    justify-content: center;
    /* display: flex; */
}
.selectnew-title{
    font-size: min(max(1.9rem, 1.1vw), 2rem);
    color: var(--color-main);
    font-family: 'Malberg Trial', sans-serif;
    letter-spacing: .09rem;
    display: inline-block;
    padding-top: 1rem;
    margin-bottom: 3rem;
    margin-left: 2rem;
    justify-content: left;
    border-bottom: 2px solid var(--color-main);
    width: 50%;
}
.guest-button{
    background: var(--color-main);
    /* padding: 1rem; */
    padding: .68rem 1rem;
    margin-left: 1rem;
    border-radius: 5rem;
    font-size: 1rem;
    color: var(--color-white);
    border: none;
    height: 3rem;
    font-family: 'Outfit', sans-serif;
    width: 15rem;
    box-shadow: 0px 3px 0px 0px var(--color-shadow-shadow);
    margin-top: .2rem;
    cursor: pointer;
}
.guest-button:hover{
    background: var(--color-secondary-main);
    color: var(--color-main);

}
.close{
    text-align: right;
    
}
.close-a{
    fill: var(--color-maroon);
    cursor: pointer;
    font-size: 1rem;
}
.close:hover{
    filter: brightness(1.75);
}
.search{
    position: relative;
    display: inline-block;
    gap: 2rem;
    right: -5%;
}
.search-bar{
    width: 18rem;
    background: var(--color-white);
    display: flex;
    position: relative;
    align-items: center;
    border-radius: 60px;
    padding: 10px 20px;
    height: 1.8rem;
    backdrop-filter: blur(4px) saturate(180%);
}
.search-bar input{
    background: transparent;
    flex: 1;
    border: 0;
    outline: none;
    padding: 24px 20px;
    font-size: .8rem;
    color: var(--color-black);
    margin-left: -0.95rem;
}
::placeholder{
    color: var(--color-solid-gray);

}
.search-bar button svg{
    width: 20px;
    fill: var(--color-white);
}
.search-bar button{
    border: 0;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    background: var(--color-main);
    margin-right: -0.55rem;
}
.customer-container .select-label{
    font-family: 'outfit', sans-serif;
    font-size: 15px;
    color: var(--color-main);
}
.customer-container .selectCus{
    border: none;
    border-radius: 15px;
    fill: var(--color-secondary-main);
    background-color: var(--color-solid-gray);
    cursor: pointer;
}
.customer-container .selectCus:hover{
    fill: var(--color-white);
    background-color: var(--color-main);
}
.container2{
    width: 100%;
    max-width: 1500px;
    padding: 38px;
    margin: 0 28px;
    max-height: 1000px;
    border-radius:  0px 0px 20px 20px;
    background-color: var(--color-background);
    box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
    border-top: 10px solid var(--color-solid-gray);
}
.customer-container{
    margin-top: -1rem;
    max-height: 650px;
    overflow: auto;
    width: 100%;
    /* position: absolute; */
    border: 8px solid var(--color-solid-gray);
    border-radius: 10px;

}
.customer-container table{
    background: var(--color-white);
    font-family: 'Switzer', sans-serif;
    width: 100%;
    font-size: 1rem;
    padding-left: 2.5rem;
    padding-right: 2.5rem;
    padding-bottom: 2.5rem;
    padding-top: 1rem;
    text-align: center;
    transition: all 700ms ease;
    /* margin-top: -1rem; */
}
.customer-container table:hover{
    box-shadow: none;
    /* border-top: 8px solid var(--color-main); */
}

.customer-container table tbody td{
    height: 2.8rem;
    border-bottom: 1px solid var(--color-solid-gray);
    color: var(--color-td);
    font-size: .8rem;
}
.customer-container th{
    height: 2.8rem;
    color: var(--color-black);
    margin:1rem;
    padding-top: 10px;
    font-size: 1rem;
    letter-spacing: 0.02rem;
}
.customer-container tr:hover td{
    color: var(--color-main);
    cursor: pointer;
    background-color: var(--color-table-hover);
}
/* ----------------------------------------------ADD CUSTOMER------------------------------------- */
.error-error{
    background-color: hsl(0, 100%, 77%);
    color: #ffffff;
    display: relative;
    padding: 11px;
    width: 96%;
    border-radius: 6px;
    align-items: center;
    text-align: center;
    margin-bottom: 2rem;
    /* margin-left: 3.55rem; */
    font-size: min(max(9px, 1.2vw), 11px);
    letter-spacing: 0.5px;
    font-family: Helvetica, sans-serif;
}
.bg-addcustomerform{
    height: 100%;
    width: 100%;
    background: rgba(0,0,0,0.7);
    top: 0;
    position: fixed;
    /* display: none; */
    align-items: center;
    justify-content: center;
    display: flex;
}
.bg-placeorderform{
    height: 100%;
    width: 100%;
    background: rgba(0,0,0,0.7);
    top: 0;
    position: fixed;

    /* display: nfne; */
    align-items: center;
    justify-content: center;
    display: flex;
}

.container1{
    width: 100%;
    max-width: 600px;
    padding: 28px;
    margin: 0 28px;
    border-radius:  0px 0px 20px 20px;
    background-color: var(--color-white);
    box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
    border-top: 10px solid var(--color-solid-gray);
}


.form-title{
    font-size: 26px;
    font-weight: 600;
    text-align: center;
    padding-bottom: 6px;
    color: white;
    text-shadow: 2px 2px 2px black;
    border-bottom: solid 1px white;
}

.main-user-info{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 20px 0;
}
.customerName{
    align-items:center;
    width: 100%;
    margin-top: -1rem;
    margin-left: 1rem;
    margin-right: 1rem;
}
.customerName label{
    /* width: 95%; */
    color: var(--color-solid-gray);
    font-size: 16px;
    display: inline-block;
    /* margin-left: .2rem; */
    margin-bottom: 0.5rem;
    font-family: 'Malberg Trial', sans-serif;
    font-weight: 550;
    /* margin: 5px 0; */
}

.select-customer{
    /* background: var(--color-solid-gray); */
    color: var(--color-white);
    align-items: center;
    border-radius: 13px;
    /* padding: 8px 12px; */
    height: 40px;
    width: 100%;
    cursor: pointer;
    transition: 0.3s;
}
.select{
            background: var(--color-solid-gray);
            color: var(--color-white);
            align-items: center;
            border-radius: 13px;
            padding: 8px 12px;
            height: 40px;
            width: 100%;
            cursor: pointer;
            transition: 0.3s;
        }
.payment-section{
    width: 100%;
    align-items: center;
    padding: 20px;
    margin-top: 1rem;
    justify-content: center;
    background-color: var(--color-background);
    border: none;
    border-radius: 20px;
}
#addcustomer{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    display: flex;
    position: relative;
    /* padding-bottom: -15px; */
    justify-content: center;
    text-align: center;
    width: 100%;
    align-items: center;
    outline: none;
    border: none;
    margin-top: 1rem;
    font-size: min(max(9px, 1.1vw), 11px);
    border-radius: 5px;
    color: var(--color-solid-gray);
    fill: var(--color-solid-gray);
    background: var(--color-background);
    cursor: pointer;
    transition: 0.5s;
    box-shadow: 1px 2px 5px 1px var(--color-solid-gray);
    border: none;
}
#addcustomer:hover{
    background: var(--color-main);
    color: var(--color-secondary-main);
    fill: var(--color-secondary-main);
    box-shadow: none;
    transition: 0.5s;
}

.user-input-box:nth-child(2n){
    justify-content: end;
}
.user-input-box-note{
    display: flex;
    flex-wrap: wrap;
    width: 48%;
    margin-top: -.5rem;
    padding-bottom: 1rem;
}

.user-input-box-note label{
    width: 95%;
    color: var(--color-solid-gray);
    font-size: 16px;
    margin-top: 1rem;
    /* margin-left: .2rem; */
    margin-bottom: 0.5rem;
    font-family: 'Malberg Trial', sans-serif;
    font-weight: 550;
    /* margin: 5px 0; */
}
.user-input-box-note label:focus{
    border: 2px solid var(--color-main-3);
    font-size: 17px;
    font-weight: 600;
}
.user-input-box-note input::placeholder{
    font-size: .8em;
    color:var(--color-solid-gray);
}
/* ::placeholder:focus{
    border: 2px solid var(--color-main-3);
} */
.user-input-box-note input:focus{
    border: 2px solid var(--color-main);
    background: var(--color-white);
}

.user-input-box-note input{
    height: 40px;
    /* margin-bottom: 1rem; */
    width: 100%;
    border: 2px solid var(--color-solid-gray);
    border-radius: 15px;
    outline: none;
    font-size: 1em;
    background: var(--color-white);
    color: var(--color-black);
    padding: 0 10px;
}
.user-input-box-totalamount{
    display: inline-block;
    flex-wrap: wrap;
    text-align: right;
    width: 49%;
    padding-bottom: 15px;
}
.user-input-box-cashpayment{
    display: inline-block;
    flex-wrap: wrap;
    text-align: right;
    width: 49%;
    padding-bottom: 15px;
}
.user-input-box-cashpayment label{
    width: 95%;
    color: var(--color-solid-gray);
    font-size: 12px;
    text-align: right;
    /* margin-left: .2rem; */
    margin-bottom: 0.5rem;
    font-family: 'Malberg Trial', sans-serif;
    font-weight: 550;
    /* margin: 5px 0; */
}
.user-input-box-totalamount label{
    width: 95%;
    color: var(--color-solid-gray);
    text-align: right;
    font-size: 16px;
    /* margin-left: .2rem; */
    margin-bottom: 0.5rem;
    font-family: 'Malberg Trial', sans-serif;
    font-weight: 550;
    /* margin: 5px 0; */
}
.user-input-box-totalamount .total-amount2{
    width: 90%;
    border-radius: 10px;
    display: inline-block;
    text-align: right;
    height: 3rem;
    border: 2px solid var(--color-solid-gray);
    outline: none;
    font-size: 1em;
    background: var(--color-solid-gray);
    color: var(--color-white);
    padding: 0 10px;
}
.user-input-box-cashpayment .cash-payment2{
    width: 50%;
    display: inline-block;
    text-align: right;
    border-radius: 10px;
    height: 2.5rem;
    border: 2px solid var(--color-solid-gray);
    outline: none;
    font-size: 1em;
    background: var(--color-white);
    color: var(--color-black);
    padding: 0 10px;
}
.user-input-box-cashpayment .cash-change{
    width: 50%;
    display: inline-block;
    text-align: right;
    border-radius: 10px;
    height: 2.5rem;
    border: 2px solid var(--color-solid-gray);
    outline: none;
    font-size: 1em;
    background: var(--color-background);
    color: var(--color-solid-gray);
    padding: 0 10px;
}
.user-input-box-cashpayment .cash-balance{
    width: 50%;
    display: inline-block;
    text-align: right;
    border-radius: 10px;
    height: 2.5rem;
    border: 2px solid var(--color-main);
    outline: none;
    font-size: 1em;
    background: var(--color-secondary-main);
    color: var(--color-main);
    padding: 0 10px;
}
#note-box{
    /* position: relative; */
    width: 100%;
    height: 1.32rem;
    margin-bottom: 2rem;
    color: var(--color-white);
    border-radius: 10px;
    font-family: 'COCOGOOSE', sans-serif;
}
#address-box{
    /* position: relative; */
    width: 100%;
    height: 1.32rem;
    margin-bottom: 3rem;
    color: var(--color-white);
    border-radius: 10px;
    font-family: 'COCOGOOSE', sans-serif;
}
#address-box label{
    width: 100%;
}
#note-box label{
    width: 100%;
}

.user-input-box{
    display: flex;
    flex-wrap: wrap;
    width: 48%;
    padding-bottom: 15px;
}

.user-input-box label{
    width: 95%;
    color: var(--color-solid-gray);
    font-size: 16px;
    /* margin-left: .2rem; */
    margin-bottom: 0.5rem;
    font-family: 'Malberg Trial', sans-serif;
    font-weight: 550;
    /* margin: 5px 0; */
}
.user-input-box label:focus{
    border: 2px solid var(--color-main-3);
    font-size: 17px;
    font-weight: 600;
}
.user-input-box input::placeholder{
    font-size: .8em;
    color:var(--color-solid-gray);
}
/* ::placeholder:focus{
    border: 2px solid var(--color-main-3);
} */
.user-input-box input:focus{
    border: 2px solid var(--color-main);
    background: var(--color-white);
}

.user-input-box input{
    height: 40px;
    width: 100%;
    border: 2px solid var(--color-solid-gray);
    border-radius: 15px;
    outline: none;
    font-size: 1em;
    background: var(--color-white);
    color: var(--color-black);
    padding: 0 10px;
}
.line{
    width:100%;
    margin-top: 2rem;
    margin-bottom: 1rem;
    border-bottom: 2px solid var(--color-solid-gray);
}
.profile-picture1 h4{
    display: flex;
    position: relative;
    text-align: center;
    font-size: 1rem;
    font-family: 'Calibri', sans-serif;
    color: var(--color-solid-gray);
    width: 100%;
    border-bottom: 2px solid var(--color-solid-gray);
    /* margin-bottom: -5rem; */
}


.addnew-title{
    font-size: min(max(1.9rem, 1.1vw), 2rem);
    color: var(--color-solid-gray);
    font-family: 'Malberg Trial', sans-serif;
    letter-spacing: .09rem;
    display: flex;
    padding-top: 1rem;
    justify-content: center;
    border-bottom: 2px solid var(--color-solid-gray);
    width: 100%;
    padding-bottom: 2px;
}
.bot-buttons{
    width: 100%;
    align-items: center;
    text-align: center;
    /* display: inline-block; */
    margin-top: 1.3rem;
    margin-bottom: -1rem;
}
.AddButton button{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    width: 15rem;
    max-height: 60px;
    outline: none;
    border: none;
    font-size: min(max(9px, 1.1vw), 11px);
    border-radius: 20px;
    color: white;
    justify-content: center;
    background:  var(--color-mainbutton);
    cursor: pointer;
    transition: 0.5s;
    margin-left: 1rem;
    position: relative;
    display: flex;
    background: var(--color-solid-gray);
}
.AddButton button:hover{
    background: var(--color-secondary-main);
    box-shadow: 1px 3px 3px 0px var(--color-shadow-shadow);
    color: var(--color-main);
    fill: var(--color-main);
}
.or{
    /* margin: 1rem; */
    margin-top: 1rem;
    color: var(--color-solid-gray);
    font-weight: 600;
    text-align: center;
    justify-content: center;
    align-items: center;
    left: 50%;
    position: relative;
}
.AddPrintButton{
    /* width: 100%;     */
    align-items: center;
    justify-content: center;
    display: inline-block;
    text-align: center;
}
.AddPrintButton button{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    width: 10rem;
    font-size: .7rem;
    justify-content: center;
    border: none;
    gap: .5rem;
    border-radius: 20px;
    color: white;
    margin-top: 1rem;
    background:  var(--color-mainbutton);
    cursor: pointer;
    transition: 0.5s;
    /* margin-left: 1rem; */
    display: flex;
    fill: white;
    background: var(--color-main);
}
.AddPrintButton button:hover{
    background: var(--color-secondary-main);
    box-shadow: 1px 3px 3px 0px var(--color-shadow-shadow);
    color: var(--color-main);
    fill: var(--color-main);
}
.CancelButton{
    display: inline-block;
}
.AddButton{
    display: inline-block;
}

/* .CloseButton{
    margin-top: 5.2vh;
    margin-left: 2.4em;
    margin-bottom: -2rem;
} */

@media(max-width: 600px){
    .container1{
        min-width: 280px;
    }
    .user-input-box .cost{
        position: absolute;
        display: none;
        left: 10.65%;
    }
    .user-input-box .srp{
        position: absolute;
        display: none;
        left: 10.65%;
    }
    .user-input-box{
        margin-bottom: 12px;
        width: 100%;
    }

    .user-input-box:nth-child(2n){
        justify-content: space-between;
    }
    .usertype-dropdown{
        width: 99%;
        margin-bottom: 1rem;
        margin-top: -.3rem;
    }

    .main-user-info{
        max-height: 380px;
        overflow: auto;
    }

    .main-user-info::-webkit-scrollbar{
        width: 0;
    }
    .bot-buttons{
        width: 100%;
        align-items: center;
        text-align: center;
        margin-top: 1.3rem;
    }
    .AddButton button:hover{
        background: var(--color-button-hover);

    }
    .CancelButton{
        position: relative;
        align-items: center;
        /* padding-top: 4rem; */
    }
    #note-box{
        margin-bottom: 2rem;
    }
    .line{
        margin-bottom: 3rem;
    }
    .AddButton{
        position: relative;
        margin-top: -4rem;
        margin-left: -1em;
        z-index: 1000;
    }
    #cancel{
        width: 100rem;
    }

}
/* -----------------------------------------------Side Menu---------------------------------------- */

/* ----------------------------------------Top bar menu----------------------------------------  */
.top-menu{
    margin-top: .7rem;
    position: absolute;
    display: grid;
    right: 3%;
    width:100%;
}
.top-menu .menu-bar{
    display: flex;
    justify-content: end;
    gap: 2rem;
    position:relative;
}
.top-menu .menu-bar button{
    display: none;
}
.top-menu .menu-bar .user1{
    gap: 2rem;
    align-items: right;
    text-align: right;
}
.top-menu .menu-bar .user2{
    display: flex;
    gap: 2rem;
    align-items: right;
    text-align: right;
}
.Title-top{
    display: none;
}
.subTitle-top{
    display: none;
}
.top-menu .menu-bar .posTitle-top{
    font-size: min(max(1.2rem, 0.4vw), 1.3rem);
    color: var(--color-main);
    font-family: 'COCOGOOSE', sans-serif;
    letter-spacing: .03rem;
    display: none;
    text-align: center;
    align-items: center;
}

.user-type{
    font-family: 'switzer', sans-serif;
    font-size: 7.5px;
    color: var(--color-black);
    letter-spacing: 1px;
    border-top: 2px solid var(--color-main);
    margin-top: -0.97rem;
    width: 7vw;
    text-transform: uppercase;
}
h1{
    margin-top: 6px;
}
.welcome{
    font-family: 'Calibri', sans-serif;
    font-size: 11px;
    /* margin-right: -7.3rem;*/
    margin-top: -0.6rem;
    letter-spacing: 2px;
    color: var(--color-main);
}
.user-name{
    font-family: 'Switzer', sans-serif;
    font-size: 12px;
    margin-top: -1rem;
    text-transform: uppercase;
    margin-bottom: 0;
    color: var(--color-maroon);
}
.profile img{
    background: var(--color-white);
    border-radius: 30%;
    width: 50px;
    padding: 4px;
}
#menu-button{
    border: none;
    background: none;
}
a{
    text-decoration:none;
    font-family: 'COCOGOOSE', sans-serif;
}
.user2 a{
    font-family: 'Malberg Trial', sans-serif;
    color: rgb(68, 68, 68);
}
.todeliver{
    margin-bottom: -2.2rem;
    margin-top: 2rem;
    color: rgb(117, 117, 117);
    font-size: 1.3rem;
    letter-spacing: .1rem;
    font-family: 'Galhau Display', sans-serif;
}
h3{
    font-size: 0.87rem;
}
.user2 .profile{
    position: relative;
    cursor: pointer;
}
.user2 .drop-menu{
    position: absolute;
    top: 120px;
    right: 15px;
    padding: 10px 20px;
    background: var(--color-white);
    width: 110px;
    box-sizing: 0 5px 25px rgba(0,0,0,0.1);
    border-radius: 7px;
    transition: 0.5s;
    visibility: hidden;
    opacity: 0;
}
.user2 .drop-menu.user2{
    top: 80px;
    visibility: visible;
    opacity: 1;
}
.user2 .drop-menu::before{
    content:'';
    position: absolute;
    top: -5px;
    right: 33px;
    width: 15px;
    height: 20px;
    background: var(--color-white);
    transform: rotate(45deg);
    transition: 0.5s;
}
.drop-menu .ul .user-type3{
    font-family: 'PHANTOM', sans-serif;
    font-size: 7.5px;
    color: var(--color-main);
    letter-spacing: .2rem;
    display: none;
}

.drop-menu .ul{
    margin-top: 2rem;
    display: flex;
    flex-direction: column;
    height: 9vh;
    position: relative;
    margin-bottom: 0.5rem;
}
.drop-menu h4{
    font-weight: 400;
    font-size: 12px;
}
.drop-menu .ul a{
    display: flex;
    color: hsl(0, 0%, 69%);
    fill: hsl(0, 0%, 69%);
    margin-left: -1.26rem;
    padding-left: 1rem;
    gap: 1rem;
    height: 1rem;
    width: 8.5rem;
    align-items: center;
    position: relative;
    height: 1.7rem;
    transition: all 300ms ease;
}
.drop-menu .ul a:hover {
    background:  rgb(190, 190, 190);
    transition: 0.6s;
    color: var(--color-white);
    fill: var(--color-white);
    padding-left: .9rem;
    content: "";
    margin-bottom: 6px;
    font-size: 15px;
    border-radius: 0px 0px 10px 10px;
    cursor: pointer;
}
.checkbox{
    opacity: 0;
    position: absolute;
}
.checkbox:checked + .theme-dark .ball{
    transform: translateX(28px);
}
.drop-menu .theme-dark{
    background: hsl(0, 0%, 69%);
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 14.5px;
    width: 42.5px;
    cursor: pointer;
    border-radius: 50px;
    position: relative;
    padding: 5px;
    margin-top: -30px;
    margin-bottom: 8px;
    margin-left: 2rem;
}
.sun{
    fill: yellow;
}
.moon{
    fill: white;
}
.ball{
    background: white;
    position: absolute;
    border-radius: 50%;
    top: 2px;
    left: 2px;
    height: 21px;
    width: 21px;
    transition: transform 0.2s linear;
}
/* ----------------------------------------MAIN---------------------------------------- */
.main-pos{
    width:100%;
    margin-top: 2rem;
}
.posTitle{
    margin-top: 1rem;
    font-size: min(max(1.9rem, 1.1vw), 2rem);
    color: var(--color-main);
    font-family: 'outfit', sans-serif;
    letter-spacing: .03rem;
    border-bottom: 2px solid var(--color-main);
    width: 65%;
}

/* ----------------------------------------Add Button---------------------------------------- */
.newUser-button{
    position: relative;
    margin-top: .5rem;
    display: inline-block;
    margin-left: 1rem;
}
#select-customerbutton:hover{
    background: var(--color-select-customer);
    color: var(--color-white);
    fill: var(--color-white);
}
#return-containerbutton:hover{
    background: var(--color-return-container);
    color: var(--color-white);
    fill: var(--color-white);
}
#new-customerbutton:hover{
    background: var(--color-new-customer);
    color: var(--color-white);
    fill: var(--color-white);
}
.add-account{
    display: flex;
    border: none;
    background-color: var(--color-white);
    align-items: center;
    color: var(--color-button);
    fill: var(--color-button);
    width: 13rem;
    /* max-height: 46px; */
    border-radius: 20px;
    /* padding: .68rem 1rem; */
    font-family: 'Outfit', sans-serif;
    cursor: pointer;
    gap: 1rem;
    height: 3.7rem;
    transition: all 300ms ease;
    margin-top: .2rem;
    text-transform: uppercase;
    /* padding: 1px; */
    padding-left: 20px;
    margin-left: 1rem;
    font-size: 1rem;
    height: 3rem;
    box-shadow: 0px 2px 0px 0px var(--color-shadow-shadow);
}
.add-account h3{
    font-size: .8rem;
}
.add-account:hover{
    background-color: var(--color-table-hover);
    color: var(--color-main);
    fill: var(--color-main);
    padding-top: -.2px;
    transition: 0.3s;
    border-bottom: 4px solid var(--color-maroon);
}
/* ----------------------------------------Dashboard Table---------------------------------------- */
/* main .account-container{
   margin-top: 2rem;
   height: 500px;

}*/

table{
    background: var(--color-white);
    font-family: 'Switzer', sans-serif;
    width: 100%;
    font-size: 0.8rem;
    border-radius: 0px 0px 10px 10px;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    padding-bottom: 2.5rem;
    text-align: center;
    transition: all 700ms ease;
    overflow: auto;
    margin-top: -1rem;
}

table tbody td{
    height: 2.8rem;
    border-bottom: 1px solid var(--color-solid-gray);
    color: var(--color-td);
    font-size: .67rem;
}
th{
    height: 1.8rem;
    color: var(--color-black);
    /* margin:1rem; */
    font-size: .8rem;
    letter-spacing: 0.02rem;
    border-bottom: 2px solid var(--color-solid-gray);
}
tr:hover td{
    color: var(--color-main);
    /* cursor: pointer; */
    /* background-color: var(--color-table-hover); */
}
.php{
    display: inline-block;
    margin-right: 5px;
    font-size: 20px;
    font-weight: 700;
    color: var(--color-black);
}
/* ----------------------------------------ASIDE---------------------------------------- */
.container{
    display: grid;
    width: 98%;
    /* margin: 0 auto; */
    background: var(--color-background);
    gap: 1.8rem;
    grid-template-columns: 16rem auto;
}
#menu-button{
    display: none;
}
@media screen and (max-width: 1600px){
    .container{
        width: 94%;
        grid-template-columns: 16rem auto;
    }

    #aside .titlelogo2 img{
        margin-left: 1.8rem;
        width: 40%;
    }

    #aside .sidebar2 a{
        width: 5.95rem;
    }
    #aside .sidebar2 a:focus{
        padding-left: 2rem;
        width: 4rem;
    }
    .top-menu{
        width: 370px;
    }
    .main-dashboard{
        position: relative;
        left: -5%;
    }
    main .account-container{
        margin: 2rem 0 0 8.8rem;
        width: 94%;
        position: absolute;
        left: 0;
        margin-left: 52%;
        transform: translateX(-50%);
        margin-top: 3%;
    }
    main .account-container table{
        width: 65vw;
        padding-left:30px;
        padding-right:30px;
    }
    .dashTitle{
        margin-left: 5%;
        width: 78%;
        margin-top: 3.2rem;
    }
    main  h2{
        margin-left: 10%;
    }
    main .sub-tab{
        margin-bottom: 4rem;
    }
    .newUser-button{
        margin-left: 1rem;
    }
    .search{
        left: 55%;
    }
    .search-bar{
        width: 17vw;
    }
}
@media screen and (max-width: 1400px){
    .container{
        width: 94%;
        grid-template-columns: 4rem auto;
    }
    .side-bar{
        z-index: 3;
        position: fixed;
        left: -100%;
    }
    .close-btn{
        display: flex;
    }

    .top-menu{
        width: 370px;
    }
    .main-dashboard{
        position: relative;
        left: -5%;
    }
    main .account-container{
        margin: 2rem 0 0 8.8rem;
        width: 94%;
        position: absolute;
        left: 0;
        margin-left: 52%;
        transform: translateX(-50%);
        margin-top: 3%;
    }
    main .account-container table{
        width: 65vw;
        padding-left:30px;
        padding-right:30px;
    }
    .dashTitle{
        margin-left: 5%;
        /* margin-top: 3.5rem; */
        width: 60vw;

    }
    main  h2{
        margin-left: 10%;
    }
    main .sub-tab{
        margin-bottom: 4rem;
    }

    .search{
        left: 55%;
    }
    .search-bar{
        width: 17vw;
    }
}
@media screen and (max-width: 1200px){
    .container{
        width: 94%;
        grid-template-columns: 4rem auto;
    }

    .top-menu{
        width: 370px;
    }
    .main-dashboard{
        position: relative;
        left: -5%;
    }
    main .account-container{
        margin: 2rem 0 0 8.8rem;
        width: 94%;
        position: absolute;
        left: 0;
        margin-left: 50%;
        transform: translateX(-50%);
        margin-top: 3%;
    }
    main .account-container table{
        width: 80vw;
        padding-left:30px;
        padding-right:30px;
    }
    .dashTitle{
        margin-left: 5%;
        width: 60vw;
    }
    main  h2{
        margin-left: 10%;
    }
    main .sub-tab{
        margin-bottom: 4rem;
    }
    .newUser-button{
        left: 137%;
    }
    .search{
        left: 77%;
    }
    .search-bar{
        width: 20vw;
    }
    .user2 .drop-menu{
        right: 13px;
        margin-top: 2px;
    }
    .user2 .drop-menu::before{
        right: 25px;
    }
    .drop-menu .ul{
        width: 8.5rem;
        height: 5rem;
    }
    .drop-menu .ul a{
        width: 8.5rem;
    }
}

@media screen and (max-width: 768px){
    .containter{
        width: 100%;
    }

    .menu-btn2{
        display: flex;
    }
    .top-menu{
        width: 94%;
        margin: 0 auto 4rem;
    }
    .top-menu .menu-bar{
        position: fixed;
        top: 0;
        left: 0;
        align-items: center;
        padding: 0 0.8rem;
        height: 4rem;
        background: var(--color-white);
        width: 100%;
        margin: 0;
        z-index: 2;
        box-shadow: 0px 1px 14px var(--color-shadow-shadow);
    }
    .top-menu .menu-bar .dashTitle-top{
        display: block;
        left: 0;
        margin-left: 4rem;
        position: absolute;
    }
    .profile{
        margin-right: 1.4rem;
    }
    .top-menu .menu-bar .user1{
        display: none;
    }
    .drop-menu .ul .user-type3{
        display: block;
        left:22.5%;
        position: absolute;
        margin-top: -2.3rem;
        margin-bottom: 1.9rem;
    }
    .dashTitle{
        display:none;
    }
    .user2 .drop-menu{
        right: 40px;
        height: 9.3rem;
        margin-top: 2px;
    }
    .user2 .drop-menu::before{
        right: 17px;
    }
    .drop-menu .ul{
        width: 8.5rem;
        height: 5rem;
    }
    .drop-menu .ul .theme-dark{
        margin-top: -.3rem;
    }

    .drop-menu .ul a{
        width: 8.5rem;
    }
    .main-dashboard{
        position: relative;
        left: -5%;
    }
    main .account-container{
        margin: 2rem 0 0 8.8rem;
        width: 94%;
        position: absolute;
        display:none;
        left: 0;
        margin-left: 50%;
        transform: translateX(-50%);
        margin-top: 3%;
    }
    main .account-container table{
        width: 80vw;
        padding-left:30px;
        padding-right:30px;
    }
    main  h2{
        margin-left: 10%;
        display:none;
    }
    main .sub-tab{
        margin-bottom: 4rem;
    }
    .newUser-button{
        left: 137%;
        display:none;
    }
    .search{
        left: 77%;
        display:none;
    }
    .search-bar{
        width: 20vw;
    }
}


.menu-tab p{
    font-size: 20px;
    font-weight: lighter;
    margin-left: 10px;
}

.menu-tab img{
    width: 15px;
    margin-right: 10px;
    margin-left: 20px;
}
.menu-tab a:hover{
    background:  rgb(250, 255, 251);
    transition: 0.6s;
    margin-left: 0rem;
    color: rgb(187, 187, 187);
    fill: rgb(187, 187, 187);
    font-weight: bold;
    padding-left: 1rem;
    content: "";
    margin-bottom: 6px;
    font-size: 9px;
    border-radius: 0 10px 10px 0 ;
    box-shadow: 1px 1px 1px rgb(224, 224, 224);
}

/*------------------------------------------------CONTAINER----------------------------------------------------*/

/* GENERAL -----------------------------------------------------------------------------------------*/
button:active {
    background-color: var(--color-blue-button);
}
button:hover {
    background-color: var(--color-main);
    color: var(--color-white);
    transition: 0.3s;
}

hr{
    width: 95%;
}

/* TOP BUTTONS -------------------------------------------------------------------------------------*/
.top-buttons{
    /* display: inline-block; */
    position: relative;
    /* width: 100%; */

}

.selectCustomer-button{
    background: var(--color-select-customer);
    padding: 1rem;
    margin-left: 1rem;
    border-radius: 5rem;
    font-size: 1rem;
    color: white;
    border: none;
    height: 3rem;
    width: 15rem;
    font-family: 'Outfit', sans-serif;
    box-shadow: 0px 3px 0px 0px var(--color-shadow-shadow);
    margin-top: .2rem;
}
.newCustomer-button{
    background: var(--color-new-customer);
    padding: 1rem;
    /* padding: .68rem 1rem; */
    margin-left: 1rem;
    border-radius: 5rem;
    font-size: 1rem;
    color: white;
    border: none;
    height: 3rem;
    width: 15rem;
    font-family: 'Outfit', sans-serif;
    box-shadow: 0px 3px 0px 0px var(--color-shadow-shadow);
    margin-top: .2rem;
}
.returnContainer-button{
    background: var(--color-return-container);
    /* padding: 1rem; */
    padding: .68rem 1rem;
    margin-left: 1rem;
    border-radius: 5rem;
    font-size: 1rem;
    color: white;
    border: none;
    height: 3rem;
    font-family: 'Outfit', sans-serif;
    width: 15rem;
    box-shadow: 0px 3px 0px 0px var(--color-shadow-shadow);
    margin-top: .2rem;
}
.date-payment{
    width: 100%;
    align-items: center;
    text-align: center;
    /* margin-bottom: 2rem; */
    /* height: 7rem; */
}
.dateandtime{
    /* width: 100%; */
    text-align: left;
    margin-bottom: 1rem;
    position: relative;
    display: inline-block;
}
.payment-options1{
    background-color: none;
    /* width: 100%; */
    /* margin-left:.5rem; */
    /* position: absolute; */
    display: inline-block;
    position: relative;
    /* padding-top: 1rem; */
    /* right: 8%; */
}
.payment-options2{
    background-color: none;
    /* width: 100%; */
    /* margin-left:.5rem; */
    /* position: absolute; */
    display: inline-block;
    position: relative;
    /* padding-top: 1rem; */
    /* right: 8%; */
}
.service-options{
    position: relative;
    border: none;
    width: 11rem;
    align-items: center;
    text-align: center;
    margin-right: 2rem;
    font-family: 'cocogoose', sans-serif;
    font-size: .8rem;
    color: var(--color-secondary-main);
    border-radius: 10px;
    margin-top: 1rem;
    border-bottom: 2px solid var(--color-main);
    text-transform: uppercase;
    background-color: var(--color-solid-gray);
}
.service-options:focus{
    outline: none;
}
.paymentOptions-text{
    font-weight: 700;
    font-size: 13px;
    /* margin-left: 1rem; */
    margin-top:1.7rem;
    color: var(--color-black);
    display: inline-block;
    position: relative;
    font-family: arial, sans-serif;

}
.paymentOptions-dropdown{
    background-color: var(--color-secondary-main);
    /* padding: 0.5rem; */
    color: var(--color-main);
    border: none;
    border-radius: 10px;
    display: inline-block;
    align-items: center;
    text-align: center;
    box-shadow: 1px 2px 5px 1px var(--color-solid-gray);
    width: 10rem;
    margin-left: 1rem;
    height: 2rem;
    cursor: pointer;
}


/* ORDER FORM -------------------------------------------------------------------------------*/
.form-container-2{
    position: relative;
    display: inline-block;
    width: 43%;
    /* height: 50%; */
    /* margin-top: -10rem; */
    margin-left:1rem;
}
.form1{
    background-color: var(--color-white);
    border: none;
    height: 65%;
    width: 100%;
    border-radius: 10px;
    position: relative;
    padding-top: 1rem;
}

.delivery-options{
    display: inline-block;
    position: relative;
    margin-left:1rem;

}

.selectTable-water{
    background: none;
    color: var(--color-tertiary);
    height: 2.9em;
    width: 4vw;
    font-size: 14px;
    cursor: pointer;
    border: none;
}
.selectCustomer-text{
    display: inline-block;
    color: var(--color-solid-gray);
    font-weight: bold;
    margin-left: 5rem;
    font-size: 25px;
}
.selectCustomer-text:hover{
    filter: brightness(50%);
    cursor: pointer;
}
.form1-ordertype-buttons{
    margin-top: 1rem;
    padding-bottom: 1.5rem;
    width: 100%;
    /* margin-left: 2rem; */
    /* height: 10rem; */
    /* position: relative; */
    text-align: center;
}
.refillOrder-button{
    background-color: var(--color-background);
    color: var(--color-main);
    display: inline-block;
    height: 3rem;
    width: 18rem;
    font-family: 'calibri', sans-serif;
    text-transform: uppercase;
    font-size: 1rem;
    font-weight: 900;
    /* padding-top: .7rem; */
    border-radius: 10px;
    border: none;
    align-items: center;
    text-align: center;
    border-color: var(--color-lightest-gray);
    box-shadow: 1px 0px 3px 1px var(--color-tertiary);
}
.a .refillOrder-button{
    text-align: center;
    align-items: center;
}
.refillOrder-button:hover{
    background-color: var(--color-blue-button);
    color: var(--color-white);
    transition: 0.3s;
}
.refillOrder-button:focus{
    color: var(--color-white);
    transition: 0.3s;
    background-color: var(--color-blue-button);
}

.newOrder-button{
    background-color: var(--color-background);
    color: var(--color-main);
    display: inline-block;
    padding: 0rem;
    height: 3rem;
    width: 18rem;
    font-family: 'calibri', sans-serif;
    text-transform: uppercase;
    font-size: 1rem;
    font-weight: 900;
    border-radius: 10px;
    border: none;
    margin-left: 1rem;
    border-color: var(--color-lightest-gray);
    box-shadow: 1px 0px 3px 1px var(--color-tertiary);
    text-align: center;
    align-items: center;
}
.newOrder-button:hover{
    color: var(--color-white);
    transition: 0.3s;
    background-color: var(--color-blue-button);
}
.newOrder-button:focus{
    color: var(--color-white);
    transition: 0.3s;
    background-color: var(--color-blue-button);
}
.otherOrder-button{
    background-color: var(--color-solid-gray);
    color: var(--color-white);
    display: inline-block;
    padding: 0rem;
    height: 3rem;
    width: 10rem;
    font-family: 'calibri', sans-serif;
    text-transform: uppercase;
    font-size: 1rem;
    font-weight: 900;
    border-radius: 15px;
    border: none;
    margin-left: 1rem;
    border-color: var(--color-lightest-gray);
    box-shadow: 1px 0px 3px 1px var(--color-tertiary);
    text-align: center;
    align-items: center;
}
.otherOrder-button:hover{
    color: var(--color-white);
    transition: 0.3s;
    background-color: var(--color-blue-button);
}
.otherOrder-button:focus{
    color: var(--color-white);
    transition: 0.3s;
    background-color: var(--color-blue-button);
}
.form1-tableoption-buttons{
    background-color: none;
    width: 20%;
    float: left;
    text-align: right;
    font-family: 'outfit', sans-serif;
    border: none;
}

.form1-table-water{
    display: block;

}
.form1-table1{
    background-color: var(--color-white);
    padding: 1rem;
    width:92.5%;
    overflow:auto;
    /* margin-top: -rem; */
    height: 25rem;
    border: 1px solid var(--color-tertiary);
    margin-left: 1rem;
    border-radius: 10px;
}
.form1-table2{
    background-color: var(--color-white);
    padding: 1rem;
    width:92.5%;
    overflow:auto;
    display: none;
    /* margin-top: -rem; */
    height: 25rem;
    border: 1px solid var(--color-tertiary);
    margin-left: 1rem;
    border-radius: 10px;
}
.form2-table-water{
    display: none;

}
.form2-table1{
    background-color: var(--color-white);
    padding: 1rem;
    width:92.5%;
    overflow:auto;
    height: 25rem;
    border: 1px solid var(--color-tertiary);
    margin-left: 1rem;
    border-radius: 10px;
}
.form2-table2{
    background-color: var(--color-white);
    padding: 1rem;
    width:92.5%;
    overflow:auto;
    display: none;
    height: 25rem;
    border: 1px solid var(--color-tertiary);
    margin-left: 1rem;
    border-radius: 10px;
}
.form3-table{
    background-color: var(--color-white);
    padding: 1rem;
    width:92.5%;
    overflow:auto;
    display: none;
    height: 28rem;
    border: 1px solid var(--color-tertiary);
    margin-left: 1rem;
    border-radius: 10px;
}
.textBox-table{
    width:3rem;
    background-color: var(--color-background);
    border-radius: 5px;
}
.removeBtn{
    background: none;
    border: none;
    font-weight: 600;
    color: var(--color-maroon);
    font-family: 'COCOGOOSE', sans-serif;
}
.removeBtn:hover{
    background: var(--color-maroon);
    border: none;
    font-weight: 600;
    border-radius: 15px;
    color: var(--color-white);
}
.select-order1{
    width: 36rem;
    font-weight: 900;
    height: 2rem;
    background: var(--color-secondary-main);
    color: var(--color-tertiary);
    border: none;
    font-family: 'outfit', sans-serif;
    box-shadow: 0px 0px 2px 1px var(--color-tertiary);
    border-radius: 15px;
    cursor: pointer;
}
.select-order1:hover{
    background: var(--color-main);
    color: var(--color-white);
}
.select-order2{
    width: 36rem;
    font-weight: 900;
    height: 2rem;
    background: var(--color-secondary-main);
    color: var(--color-tertiary);
    border: none;
    font-family: 'outfit', sans-serif;
    box-shadow: 0px 0px 2px 1px var(--color-tertiary);
    border-radius: 15px;
    cursor: pointer;
}
.select-order2:hover{
    background: var(--color-main);
    color: var(--color-white);
}
.selectlabel{
    display: inline-block;
    margin-left: 3rem;
    color: var(--color-solid-gray);
    font-weight: 600;
    font-family: 'century-gothic', sans-serif;
}
.selectTable-water1{
    width: 12rem;
    font-weight: 900;
    align-items: left;
    display: inline-block;
    height: 2rem;
    font-size: 15px;
    background: var(--color-light-blue);
    color: var(--color-black);
    border: none;
    font-family: 'outfit', sans-serif;
    box-shadow: 0px 0px 2px 1px var(--color-tertiary);
    border-radius: 5px;
    text-transform: uppercase;
    cursor: pointer;
}
.selectTable-water1:hover{
    background: var(--color-solid-gray);
    transition: 0.5s;
    color: var(--color-white);
}
.selectTable-water2{
    width: 5rem;
    font-weight: 700;
    align-items: left;
    height: 2rem;
    font-size: 15px;
    background: var(--color-light-blue);
    color: var(--color-black);
    border: none;
    font-family: 'outfit', sans-serif;
    box-shadow: 0px 0px 2px 1px var(--color-tertiary);
    border-radius: 5px;
    cursor: pointer;
}
.selectTable-water2:hover{
    background: var(--color-solid-gray);
    transition: 0.5s;
    color: var(--color-white);
}
.select-order3{
    width: 30rem;
    font-weight: 500;
    align-items: center;
    height: 2rem;
    display: inline-block;
    font-size: 15px;
    background: var(--color-secondary-main);
    color: var(--color-black);
    border: none;
    font-family: 'outfit', sans-serif;
    box-shadow: 0px 0px 2px 1px var(--color-tertiary);
    border-radius: 5px;
    cursor: pointer;
}
.select-order3:hover{
    background: var(--color-solid-gray);
    transition: 0.5s;
    color: var(--color-white);
}
.qty-label{
    margin-left:2rem;
    font-family: 'Calibri', sans-serif;
    font-weight: 600;
    color: var(--color-black);
}
.qty3{
    width: 5rem;
    height: 2.3rem;
    border-radius: 15px;
    align-items: center;
    text-align: center;
    border-color: var(--color-solid-gray);
    background-color: var(--color-white);
    color: var(--color-black);
}
.add-rowsButton{
    border: none;
    border-bottom: 5px solid var(--color-blue-button);
    background-color: var(--color-solid-gray);
    color: var(--color-white);
    /* align-items: center; */
    fill: var(--color-white);
    gap: .5rem;
    padding:5px;
    font-size: 15px;
    font-weight: 500;
    border-radius: 10px;
    font-family: 'calibri', sans-serif;
    cursor: pointer;
}
.add-rowsButton:hover{
    filter: brightness(1.2);
    transition: 0.5s;
    border-bottom: 5px solid var(--color-tertiary);
}
.delete-rowsButton{
    border: none;
    background-color: var(--color-maroon);
    color: var(--color-white);
    /* align-items: center; */
    fill: var(--color-white);
    gap: .5rem;
    padding:5px;
    
    font-size: 15px;
    font-weight: 500;
    border-radius: 5px;
    font-family: 'calibri', sans-serif;
    cursor: pointer;
}
.delete-rowsButton:hover{
    filter: brightness(1.8);
    transition: 0.2s;
    /* border-bottom: 5px solid var(--color-tertiary); */
}
.form1-buttons{
    /* margin-top: 6rem; */
    align-items: center;
    text-align: center;
    background-color: none;
    position: relative;
    padding: 1rem;
    width: 97%;
    display: inline-block;
    /* right: 5rem; */
}
.addOrder-button{
    background-color: var(--color-background);
    padding: 0rem;
    height: 4rem;
    width: 100%;
    font-size: 1rem;
    border-radius: 50px;
    color: var(--color-black);
    display: inline-block;
    font-weight: 600;
    text-transform: uppercase;
    font-family: 'outfit', sans-serif;
    border-color: var(--color-lightest-gray);
    box-shadow: 0px 1px 0px 0px var(--color-shadow-shadow);
    cursor: pointer;
}

/* form2 ------------------------------------------------------------------------------ */
.form-container-2{
    position: relative;
    display: inline-block;
    width: 43%;
    /* height: 50%; */
    /* margin-top: -10rem; */
    margin-left:1rem;
}
.form-container{
    display: inline-block;
    /* position: relative; */
    width: 55%;
    /* height:75rem; */
    margin-top: 1rem;    /* align-items: left; */
}
.form1{
    background-color: var(--color-white);
    border: none;
    height: 40rem;
    width: 100%;
    border-radius: 10px;
    display: inline-block;
    position: relative;
    padding-top: 1rem;
}

/* RECEIPT --------------------------------------------------------------------------------------*/


.totalOrder{
    background-color: var(--color-white);
    border-color: var(--color-table-border);
    box-shadow: 0px 5px 0px 0px var(--color-shadow-shadow);
    width: 100%;
    border-radius: 10px;
    position: relative;
    /* height: 60%; */

}
.company-name{
    color: var(--color-solid-gray);
    font-size: 1rem;
    font-weight: bold;
    text-align: center;
    margin-top: 2rem;
    padding-bottom: 1.2rem;
    padding-top: 1.3rem;
    border-bottom: 2px solid var(--color-solid-gray);
    /* height: 5%; */
    text-transform: uppercase;
}
.date-Text{
    font-weight: 900;
    font-size: 13px;
    /* margin-left: 2rem; */
    /* margin-top:1.7rem; */
    color: var(--color-black);
    display: inline-block;
    position: relative;
}
.card {
    display: inline-block;
    /* padding-bottom: 1rem; */
    /* padding-bottom: 1.6rem; */
    /* box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15), 0 3px 6px rgba(0, 0, 0, 0.2); */
    border-radius: 0.1rem;
    text-align: center;
    height: 1rem;
    margin-left: .5rem;
    border: transparent;
    font-family: 'Rajdhani', sans-serif;
    /* left: 25vw;      */
    /* margin-top: rem; */
    /* position: absolute; */
}
.time{
    /* background-color: var(--color-black); */
    color: var(--color-solid-gray);
    font-size: 1rem;
    font-weight: 500;
    display: inline-block;
}
.date {
    color: var(--color-solid-gray);
    font-size: 1rem;
    font-weight: 500;
    display: inline-block;
}
.day {
    color: var(--color-solid-gray);
    font-size: 1rem;
    font-weight: 900;
    margin-left: 1rem;
    display: inline-block;
}
.dash{
    display: inline-block;
    color: var(--color-tertiary);
}
.hr1{
    margin-top: -1rem;
    margin-bottom: -1rem;
}
.order-sum{
    width: 100%;
    margin-top: 1rem;
}
.ordersum-text{
    display: inline-block;
}
.cashiersum-text{
    display: inline-block;
    align-items: right;
    position: absolute;
    text-align: right;
    right: 5%;  
    padding-top: .5rem;
}
.orderSummary-text{
    color: var(--color-solid-gray);
    font-weight: bolder;
    margin-left: 1rem;
    font-size: 1.4rem;
    text-align: left;
    font-family: 'rajdhani', sans-serif;
    text-transform: uppercase;
}
.cashier-text{
    color: var(--color-black);
    font-weight: lighter;
    display: inline-block;
    margin-top: 1rem;
    font-size: .8rem;
    text-align: right;
    right: 0;
}

.name-cashier{
    display: inline-block;
    color: var(--color-black);
    /* margin-left: rem; */
    width: 6rem;
    border:none;
    font-weight: 700;
    text-align: center;
    margin-bottom: -1rem;
}
.name-cashier:focus{
    outline: none;
}
.orderSum-table{
    background-color: var(--color-white);
    padding: 1rem;
    /* width:100%; */
    overflow:auto;
    /* display: inline-block; */
    /* margin-left: 1.1rem; */
    max-height: 12rem;
    height: 12rem;
    /* margin-top: -1rem; */
    /* text-align: right; */
    /* display: flex; */
    border-top: 2px solid var(--color-solid-gray);
    position: relative;
    border-radius: 10px;
}
.tableCheckout table{
    background: var(--color-white);
    font-family: 'Switzer', sans-serif;
    width: 100%;
    font-size: 0.8rem;
    border-radius: 0px 0px 10px 10px;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    padding-bottom: 2.5rem;
    text-align: center;
    transition: all 700ms ease;
    overflow: auto;
    margin-top: -1rem;
}

.tableCheckout th{
    height: 1.8rem;
    color: var(--color-solid-gray);
    /* margin:1rem; */
    font-size: .8rem;
    letter-spacing: 0.02rem;
    border: none;
    /* border-bottom: 2px solid var(--color-solid-gray); */
}

.totalOrder-amount{
    /* width: 100%; */
    position: static;
}
.orderTotal1{
    display: inline-block;
    position: relative;
}
.totalamount{
    align-items: left;
    text-align: left;
    margin-left: 2rem;
    margin-bottom: .5rem;
}
.totaldelivery{
    /* align-items: left;
    float: left;
    display: inline-block;*/
    margin-left: 2rem; 
    margin-top: .2rem;
    display: inline-block;
    /* margin-bottom: */
}
.totaldelivery1{
    /* align-items: left; */
    float: left;
    display: inline-block;
    margin-left: 1rem;
    /* margin-bottom: */
}
.total-amount{
    float: right;
    display: inline-block;
    /* margin-right: 1rem; */
}
#delivery-fee{
    /* background-color: #FFCFCF;
    padding-left: 20px;
    padding-right: 20px;
    border-radius: 1rem; */
    font-family: 'century-gothic', sans-serif;
    /* margin-right: 6rem; */
    float: right;
    /* margin-top: 1.1rem; */
    /* text-align: right; */
    display: none;
    /* margin-top: 1rem; */
    font-size: .9rem;
    color: var(--color-solid-gray);
}
#delivery-fee1{
    /* background-color: #FFCFCF;
    padding-left: 20px;
    padding-right: 20px;
    border-radius: 1rem; */
    font-family: 'century-gothic', sans-serif;
    margin-right: 2rem;
    float: right;
    margin-top: .2rem;
    /* text-align: right; */
    /* display: inline-block; */
    /* margin-top: 1rem; */
    font-size: .9rem;
    color: var(--color-solid-gray);
}
#orderTotal{
    /* background-color: #FFCFCF;
    padding-left: 20px;
    padding-right: 20px;
    border-radius: 1rem; */
    font-family: 'century-gothic', sans-serif;
    margin-right: 2rem;
    /* right: 5%; */
    float: right;
    /* margin-top: 1.2rem; */
    display: inline-block;
    /* margin-top: 1rem; */
    font-size: .9rem;
    color: var(--color-solid-gray);
}
#totalAmount_order{
    background-color: var(--color-total-amount);
    /* padding-left: 20px;*/
    margin-right: 20px; 
    text-align: center;
    border-radius: 1rem;
    width: 10rem;
    font-family: 'century-gothic', sans-serif;
    font-size: 1.5rem;
    color: var(--color-black);
}

#total_order1{
    /* background-color: #FFCFCF; */
    /* padding-left: 20px; */
    padding-right: 20px;
    font-size:1.5rem;
    font-family: 'century-gothic', sans-serif;
    color: var(--color-black);
}
.orderTotal-text{
    color: var(--color-black);
    font-weight: 500;
    /* margin-top: 1rem; */
    /* margin-left: 1rem; */
    display:inline-block;
    font-size: 1rem;
    /* display: inline-block; */
}
.totalAmount-text{
    color: var(--color-black);
    font-weight: bolder;
    font-size: 1rem;    
    margin-top: 1rem;
    margin-left: 1rem;
    font-size: 1rem;
    display: inline-block;
}
.orderTotal2{
    display: inline-block;
    align-items: right;
    position: absolute;
    text-align: right;
    right: 5%;  
}
.peso-sign{
    /* margin-left: 9rem; */
    display: inline-block;
    position: relative;
    color: var(--color-solid-gray);
}
.input-total-amount{
    display: inline-block;
    position: relative;
}
.total-order{
    margin-left: 1rem;
    border: none;
    padding: 7px;
    border-radius: 10px;
    background-color: #FFCFCF;
    font-family: 'Calibri', sans-serif;
    font-size: 20px;
    font-weight: 900;
    text-align: right;
    color: var(--color-tertiary);
} 
.receipt-buttons{
    text-align: center;
    margin-top: 1.3rem;
    padding-bottom: 1.2rem;
}

.confirmOrder-button{
    font-family: 'COCOGOOSE', sans-serif;
    /* padding: 20px; */
    display: inline-block;
    /* padding-bottom: -70px; */
    text-align: center;
    outline: none;
    color: var(--color-white);
    fill: var(--color-white);
    cursor: pointer;
    transition: 0.5s;
    background: var(--color-solid-gray);
    border-radius: 5rem;
    font-size: .8rem;
    border: none;
    position: relative;
    height: 2.6rem;
    width: 90%;
    text-transform: uppercase;

}
.confirmOrder-button:hover{
    filter: brightness(120%);
    background: var(--color-tertiary);
    transition: 0.5s;
}
#cancel{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    padding-left: 70px;
    position: relative;
    padding-right: 70px;
    text-align: center;
    width: 1rem;
    height: 2rem;
    outline: none;
    border: none;
    font-size: min(max(9px, 1.1vw), 11px);
    border-radius: 20px;
    color: white;
    background: #c44242;
    cursor: pointer;
    transition: 0.5s;
}
#cancel:hover{
    box-shadow: 1px 3px 3px 0px var(--color-shadow-shadow);
    background-color: rgb(158, 0, 0);
    transition: 0.5s;
}

/* PREVIOUS TRANSACTIONS ------------------------------------------------------------------------------- */
.form3{
    /* margin-top: -39rem; */
    width: 100%;
    /* height: 50rem; */
    display: inline-block;
    position: relative;
}
.previous-transaction{
    background-color: var(--color-white);
    padding-left: 2rem;
    width: 97%;
    /* max-height: 600px; */
    margin-bottom: 2rem;
    margin-top: 2rem;
    border: 1px solid;
    border-color: var(--color-table-border);
    /* position: relative; */
    overflow:auto;
    border-top: 8px solid var(--color-table-hover);
    border-radius: 0px 0px 20px 20px;
}
.previous-transaction-header{
    color: var(--color-black);
    font-weight: bold;
    font-size: 1rem;
    text-align: center;
    margin-left: 1rem;
    text-transform: uppercase;
    font-family: 'COCOGOOSE', sans-serif;
    letter-spacing: 1px;
    /* margin-bottom:1.5rem; */
}
.previous-transaction-table table tbody td{
    height: 3.3rem;
    border-bottom: 1px solid var(--color-border-bottom);
    color: var(--color-td);
    font-size: .8rem;
}
.previous-transaction-table th{
    height: 4rem;
    /* padding: 1rem; */
    color: var(--color-black);
    /* margin:1rem; */
    font-size: .8rem;
    letter-spacing: 0.02rem;
    border: none;
}
.previous-transaction-table tr:hover td{
    color: var(--color-main);
    cursor: pointer;
    background-color: var(--color-table-hover);
}
</style>
