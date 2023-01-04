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
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/outfit" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/galhau-display" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/malberg-trial" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/rajdhani" rel="stylesheet">
    <title>Tag's Water Purified Drinking Water</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
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
                                            <td > <img src="<?php echo "../uploaded_image/".$item_sales['image']; ?>" alt='No Image' width="100px"></td>
                                            <td > <?php echo $item_sales['item_name']; ?></td>
                                            <td > <?php echo $item_sales['name']; ?></td>
                                            <td > Alkaline</td>
                                            <td > <?php echo '&#8369'.' '.$item_sales['alkaline_price']; ?></td>
                                            <td>
                                             
                                                <a href="../pos/point-of-sales.php?addalkaline=<?php echo $item_sales['id']; ?>" class="add-rowsButton" class="action-btn" name="action">
                                                   ADD ORDER <!-- <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.521 17.479v-2.437l4.562-4.563 2.438 2.438-4.563 4.562Zm-7-3.958v-2.459h7.271v2.459Zm14.583-1.188-2.437-2.437.666-.667q.355-.354.865-.364.51-.011.864.364l.709.709q.375.354.364.864-.01.51-.364.865ZM2.521 9.75V7.292h9.958V9.75Zm0-3.771V3.521h9.958v2.458Z"/></svg> -->
                                                </a>
                                            <!-- <button type="submit" class="add-rowsButton" id="add-rowsButton" name="add-others">ADD ORDER</a>    -->
                                               
                                            </td>
                                        </tr>
                                        </tbody>
                                    <?php } ?>
                                </form>
                            </table>
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
                                            <td > <img src="<?php echo "../uploaded_image/".$item_sales['image']; ?>" alt='No Image' width="100px"></td>
                                            <td > <?php echo $item_sales['item_name']; ?></td>
                                            <td > <?php echo $item_sales['name']; ?></td>
                                            <td > Mineral</td>
                                            <td > <?php echo '&#8369'.' '.$item_sales['mineral_price']; ?></td>
                                            <td>
                                                <a href="../pos/point-of-sales.php?addmineral=<?php echo $item_sales['id']; ?>" class="add-rowsButton" class="action-btn" name="action">
                                                   ADD ORDER <!-- <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.521 17.479v-2.437l4.562-4.563 2.438 2.438-4.563 4.562Zm-7-3.958v-2.459h7.271v2.459Zm14.583-1.188-2.437-2.437.666-.667q.355-.354.865-.364.51-.011.864.364l.709.709q.375.354.364.864-.01.51-.364.865ZM2.521 9.75V7.292h9.958V9.75Zm0-3.771V3.521h9.958v2.458Z"/></svg> -->
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
                                                <td > <img src="<?php echo "../uploaded_image/".$item_sales['image']; ?>" alt='No Image' width="100px"></td>
                                                <td > <?php echo $item_sales['item_name']; ?></td>
                                                <td > <?php echo $item_sales['name']; ?></td>
                                                <td > Alkaline</td>
                                                <td class="alkaline-price"> <?php echo '&#8369'.' '.$item_sales['alkaline_price']; ?></td>
                                                <td>
                                                
                                                    <a href="../pos/point-of-sales.php?addalkaline=<?php echo $item_sales['id']; ?>" class="add-rowsButton" class="action-btn" name="action">
                                                    ADD ORDER <!-- <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.521 17.479v-2.437l4.562-4.563 2.438 2.438-4.563 4.562Zm-7-3.958v-2.459h7.271v2.459Zm14.583-1.188-2.437-2.437.666-.667q.355-.354.865-.364.51-.011.864.364l.709.709q.375.354.364.864-.01.51-.364.865ZM2.521 9.75V7.292h9.958V9.75Zm0-3.771V3.521h9.958v2.458Z"/></svg> -->
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
                                                <td > <img src="<?php echo "../uploaded_image/".$item_sales['image']; ?>" alt='No Image' width="100px"></td>
                                                <td > <?php echo $item_sales['item_name']; ?></td>
                                                <td > <?php echo $item_sales['name']; ?></td>
                                                <td > Mineral</td>
                                                <td class="mineral-price"> <?php echo '&#8369'.' '.$item_sales['mineral_price']; ?></td>
                                                <td>
                                                
                                                    <a href="../pos/point-of-sales.php?addmineral=<?php echo $item_sales['id']; ?>" class="add-rowsButton" class="action-btn" name="action">
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
                        <div class="form2-table3" id="form-category">
                            <?php
                                $dropdown_query7 = "SELECT * 
                                FROM inventory_item 
                                WHERE category_by_id = 1 OR 2";
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
                                                <td > <img src="<?php echo "../uploaded_image/".$item_sales['image']; ?>" alt='No Image' width="100px"></td>
                                                <td > <?php echo $item_sales['item_name']; ?></td>
                                                <td > <?php echo $item_sales['name']; ?></td>
                                                <td class="mineral-price"> <?php echo '&#8369'.' '.$item_sales['selling_price_item']; ?></td>
                                                <td>
                                                
                                                    <a href="../pos/point-of-sales.php?addothers=<?php echo $item_sales['id']; ?>" class="add-rowsButton" class="action-btn" name="action">
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
                                    $dropdown_query8 = "SELECT * 
                                    FROM inventory_item 
                                    WHERE category_by_id = 5 OR 7";
                                    $result8 = mysqli_query($con, $dropdown_query8);
                                ?>
                                <table class="table3" id="myTable3">
                                    <thead class="form-table">
                                        <th></th>
                                        <th>ITEM</th>
                                        <th>TYPE</th>
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
                                                <td > <img src="<?php echo "../uploaded_image/".$item_sales['image']; ?>" alt='No Image' width="100px"></td>
                                                <td > <?php echo $item_sales['item_name']; ?></td>
                                                <td > <?php echo $item_sales['name']; ?></td>
                                                <td > <?php echo '&#8369'.' '.$item_sales['selling_price_item']; ?></td>
                                                <td>
                                                
                                                    <a href="../pos/point-of-sales.php?addothers=<?php echo $item_sales['id']; ?>" class="add-rowsButton" class="action-btn" name="action">
                                                    ADD ORDER <!-- <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.521 17.479v-2.437l4.562-4.563 2.438 2.438-4.563 4.562Zm-7-3.958v-2.459h7.271v2.459Zm14.583-1.188-2.437-2.437.666-.667q.355-.354.865-.364.51-.011.864.364l.709.709q.375.354.364.864-.01.51-.364.865ZM2.521 9.75V7.292h9.958V9.75Zm0-3.771V3.521h9.958v2.458Z"/></svg> -->
                                                    </a>
                                                <!-- <button type="submit" class="add-rowsButton" id="add-rowsButton" name="add-others">ADD ORDER</a>    -->
                                                
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
            <!-- ------------------------------------------------------------------------------------------------------------------- -->
           
            <!-- ---------------------------------------------------- Order Summary ------------------------------------------------- -->

            <div class="form-container-2">
                <div class="totalOrder">
                    <header class="company-name">Tag's Water Purified Drinking Water</header>
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
                                    <th>ITEM</th>
                                    <th>Water</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>QTY</th>
                                    <th>TOTAL</th>
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
                                                <td name="itemname_transaction"> <?php echo $transactions['item_name']; ?></td>
                                                <td name="watertype_transaction"> <?php echo $transactions['water_type']; ?></td>
                                                <td name="categorytype_transaction"> <?php echo $transactions['category_type']; ?></td>
                                                <td name="price_transaction"> <?php echo '&#8369'.' '. $transactions['price']; ?></td>
                                                <td class="quantity-td" > 
                                                    <a href="../pos/point-of-sales.php?editquantity=<?php echo $transactions['id']; ?>" class="addquantity" name="addquantity">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.708 17.958q-1.125 0-1.896-.77-.77-.771-.77-1.896V4.708q0-1.125.77-1.895.771-.771 1.896-.771h10.584q1.125 0 1.896.771.77.77.77 1.895v10.584q0 1.125-.77 1.896-.771.77-1.896.77Zm0-2.666h10.584V4.708L4.708 15.292Zm6.73-.875v-1.521H9.917v-1.458h1.521V9.917h1.458v1.521h1.521v1.458h-1.521v1.521ZM5.229 8.208h4.479V6.729H5.229Z"/></svg>
                                                    </a>
                                                    <?php echo $transactions['quantity'];?>
                                                </td>
                                                <td> <?php echo '&#8369'.' '. number_format($transactions['total_price'], '2','.',','); ?></td>
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
                                &#8369<input type="number" id="deliveryfee_amount" class="deliveryamount_fee" step=".01" min="0" value="0.00" onkeyup="deliveryFee();" >
                            </div>
                            <div id="delivery-fee1"> 
                             <label id="deliveryfee_amount1" class="deliveryamount_fee1" min="0" value="0.00"onkeyup="deliveryFee1();">&#8369 0.00</label>
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
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Order Details</th>
                            <th>Total Amount</th>
                            <th>Payment Option</th>
                            <th>Service</th>
                            <th>Note</th>
                            <th>Payment Status</th>
                            <th>Cashier Name</th>
                            <th>Date/Time</th>
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
                                <td> <?php echo $rows['id']; ?></td>
                                <td> <?php if($rows['customer_name']){
                                    echo $rows['customer_name'];
                                    }else{
                                        echo 'GUEST';
                                    }
                                 ?></td>
                                <td> <a class="viewTransaction" href="../pos/point-of-sales-viewdetails.php?view=<?php echo $rows['uuid'];?>">View Details</a></td>

                                <td> <?php echo '<span>&#8369;</span>'.' '.number_format($rows['total_amount'], '2','.',','); ?></td> 
                                <td> <?php echo $rows['option_name']; ?></td>
                                <td> <?php echo $rows['service_type']; ?></td>
                                <td> <?php echo $rows['note']; ?></td>
                                <td> 
                                    <?php 
                                    if($rows['status_id'] == 0){
                                        echo '<span class="outofstock">Unpaid</span>';
                                    }else{
                                        echo '<span class="instock">Paid</span>';
                                    } ?>
                                </td>
                                <td> <?php echo $rows['first_name'] .' '. $rows['last_name'] ; ?></td>
                                <td> <?php echo $rows['created_at_date'] .' '. $rows['created_at_time']; ?></td>
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
    
    <?php
    include('../common/top-menu.php')
    ?>
            
<!-- =======================================================add alkaline refill===================================================== -->

<?php
if(isset($_GET['addalkaline']))
{
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
        $item = mysqli_fetch_assoc($result); ?>

        <form action="" method="post" enctype="multipart/form-data" id="addorderFrm">
            <div class="bg-adduserform" id="bg-addform">
                <div class="message"></div>
                <div class="container1">
                   
                    <h1 class="addnew-title">ADD ORDER</h1>
                    <form action="#">
                        <input type="hidden" required="required" name="user_id" value="<?=$item['id'];?>">
                        <div class="main-user-info">
                        <div class="profile-pic">
                            <img src="../uploaded_image/<?=$item['image'];?>" name="image" alt="">
                        </div>    
                            <div class="user-input-box">
                                <input type="hidden" required="required" name="itemname" value="<?=$item['item_name'];?>">
                                <input type="hidden" required="required" name="alkalineprice" value="<?=$item['alkaline_price'];?>">
                                <input type="hidden" required="required" name="categorytype" value="<?=$item['name'];?>">
                                <input type="hidden" required="required" name="alkaline-label" value="Alkaline">
                                <span type="text" class="label-item2" value="Alkaline">Alkaline</span>
                                <label for="lastname" class="label-item"><?=$item['item_name'];?></label>
                            </div>
                            <div class="user-input-box">
                                <label for="quantity" class="quantity-label">Quantity</label>
                                <input type="number" min='1' onkeypress='return isNumberKey(event)'
                                       id="quantity"
                                       name="quantity"
                                       value='1'
                                       required="required">
                                       
                            </div>
                            <div class="line"></div>

                            <div class="bot-buttons">
                                <div class="CancelButton">
                                    <a href="../pos/point-of-sales.php" id="cancel">CANCEL</a>
                                </div>
                                <div class="AddButton">
                                    <button type="submit" id="adduserBtn" name="add-alkaline-water">SAVE</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </form>
        <?php 
    }} ?>
        <div class="bg-selectcustomerform" id="bg-selectform">
            <div class="container2">
    
                <form action="#">
                    <div class="customer-container">
                        <table class="table" id="customerTable">
                        
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </form>
<!-- =======================================================add mineral refill===================================================== -->
    <?php
if(isset($_GET['addmineral']))
{
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
        $item = mysqli_fetch_assoc($result); ?>

        <form action="" method="post" enctype="multipart/form-data" id="addorderFrm">
            <div class="bg-adduserform" id="bg-addform">
                <div class="message"></div>
                <div class="container1">
                   
                    <h1 class="addnew-title">ADD ORDER</h1>
                    <form action="#">
                        <input type="hidden" required="required" name="user_id" value="<?=$item['id'];?>">
                        <div class="main-user-info">
                        <div class="profile-pic">
                            <img src="../uploaded_image/<?=$item['image'];?>" name="image" alt="">
                        </div>    
                        <div class="user-input-box">

                            <input type="hidden" required="required" name="itemname" value="<?=$item['item_name'];?>">
                            <input type="hidden" required="required" name="mineralprice" value="<?=$item['mineral_price'];?>">
                            <input type="hidden" required="required" name="categorytype" value="<?=$item['name'];?>">
                            <input type="hidden" required="required" name="mineral-label" value="Mineral">
                            <label type="text" class="label-item2"  name="mineral-label" value="Mineral">Mineral</label>
                            <label for="lastname" class="label-item"><?=$item['item_name'];?></label>
                        </div>
                            
                            <div class="user-input-box">
                                <label for="quantity" class="quantity-label">Quantity</label>
                                <input type="number" min='1' onkeypress='return isNumberKey(event)'
                                       id="quantity"
                                       name="quantity"
                                       value='1'
                                       required="required">
                                       
                            </div>
                            <div class="line"></div>

                            <div class="bot-buttons">
                                <div class="CancelButton">
                                    <a href="../pos/point-of-sales.php" id="cancel">CANCEL</a>
                                </div>
                                <div class="AddButton">
                                    <button type="submit" id="adduserBtn" name="add-mineral-water">SAVE</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </form>
        <?php 
    }} ?>
        <div class="bg-selectcustomerform" id="bg-selectform">
            <div class="container2">
    
                <form action="#">
                    <div class="customer-container">
                        <table class="table" id="customerTable">
                        
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </form>

    <!-- =======================================================add others===================================================== -->
    <?php
if(isset($_GET['addothers']))
{
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
        $item = mysqli_fetch_assoc($result); ?>

        <form action="" method="post" enctype="multipart/form-data" id="addorderFrm">
            <div class="bg-adduserform" id="bg-addform">
                <div class="message"></div>
                <div class="container1">
                   
                    <h1 class="addnew-title">ADD ORDER</h1>
                    <form action="#">
                        <input type="hidden" required="required" name="user_id" value="<?=$item['id'];?>">
                        <div class="main-user-info">
                        <div class="profile-pic">
                            <img src="../uploaded_image/<?=$item['image'];?>" name="image" alt="">
                        </div>    
                        <div class="user-input-box">
                            <input type="hidden" required="required" name="itemname" value="<?=$item['item_name'];?>">
                            <input type="hidden" required="required" name="PRICE" value="<?=$item['selling_price_item'];?>">
                            <input type="hidden" required="required" name="categorytype" value="<?=$item['name'];?>">
                            <label for="lastname" class="label-item3"><?=$item['item_name'];?></label>
                        </div>
                            
                            <div class="user-input-box">
                                <label for="quantity" class="quantity-label">Quantity</label>
                                <input type="number" min='1' onkeypress='return isNumberKey(event)'
                                       id="quantity"
                                       name="quantity"
                                       value='1'
                                       required="required">
                                       
                            </div>
                            <div class="line"></div>

                            <div class="bot-buttons">
                                <div class="CancelButton">
                                    <a href="../pos/point-of-sales.php" id="cancel">CANCEL</a>
                                </div>
                                <div class="AddButton">
                                    <button type="submit" id="adduserBtn" name="add-others">SAVE</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </form>
        <?php 
    }} ?>
        <div class="bg-selectcustomerform" id="bg-selectform">
            <div class="container2">
    
                <form action="#">
                    <div class="customer-container">
                        <table class="table" id="customerTable">
                        
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </form>
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
<!-- <script src="../javascript/top-menu-toggle.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script src="https://code.jquery.com/jquery.min.js"></script>
<!-- <script src="../javascript/point-of-sales.js"></script> -->
<script>
  
    function loading() {
        document.querySelector(".loading").style.display = "flex";
        document.querySelector(".loader").style.display = "flex";
    }
    function deliveryFee(){       
        try{
            let totalamountvalue = document.getElementById("totalamount_value").value;
            let totalAmount = 0.00;
            if(!isNaN(totalamountvalue) && totalamountvalue !== ''){
                totalAmount = parseFloat(document.getElementById("totalamount_value").value);
            }
            var deliveryfee_value = document.getElementById("deliveryfee_amount").value;
            let deliveryfee = 0.00;
            if(!isNaN(deliveryfee_value) && deliveryfee_value !== ''){
                deliveryfee = parseFloat(document.getElementById("deliveryfee_amount").value);
            }
            
            let total = deliveryfee + totalAmount; 
            document.getElementById("totalAmount_order").value = numberWithCommas(total.toFixed(2));
        }catch(err){
    
        }

        
    }
    function deliveryOption(delivery){
        if(delivery.value == 'Delivery'){
            document.getElementById("deliveryfee_amount1").style.display = 'none';
            document.getElementById("delivery-fee").style.display = 'inline-block';
        }else if(delivery.value == 'Delivery/Pick Up'){
            document.getElementById("deliveryfee_amount1").style.display = 'none';
            document.getElementById("delivery-fee").style.display = 'inline-block';
            
        }else if(delivery.value == 'Walk In'){
            document.getElementById("deliveryfee_amount1").style.display = 'inline-block';
            document.getElementById("delivery-fee").style.display = 'none';
            document.getElementById("deliveryfee_amount").value = 0;
            var ele = document.getElementsByName("pos_item");
            for(var i=0;i<ele.length;i++)
                ele[i].checked = false;
        }
        selectElement = document.querySelector('#deliveryoption');
        output = selectElement.value;
        document.querySelector('.deliveryoption_class').value = output;
    }
    function waterChange(answer){
        if(answer.value == 'Alkaline'){
            document.getElementById("form-water1").style.display = 'block';
            document.getElementById("form-water2").style.display = 'none';
            document.getElementById("form-water3").style.display = 'block';
            document.getElementById("form-category").style.display = 'none';
            document.getElementById("form-water4").style.display = 'none';

        }else if(answer.value == 'Mineral'){
            document.getElementById("form-water1").style.display = 'none';
            document.getElementById("form-water2").style.display = 'block';
            document.getElementById("form-category").style.display = 'none';
            document.getElementById("form-water3").style.display = 'none';
            document.getElementById("form-water4").style.display = 'block';
        }else if(answer.value == 'Container/Bottle Only'){
            document.getElementById("form-water1").style.display = 'block';
            document.getElementById("form-water2").style.display = 'none';
            document.getElementById("form-category").style.display = 'block';
            document.getElementById("form-water3").style.display = 'none';
            document.getElementById("form-water4").style.display = 'none';
        }
        
    }
  
    function guestCustomer(){
        var guestTxt = document.getElementById("guest-button");
        var selectLbl = document.getElementById("selectCustomer-text");
        container2 = document.querySelector(".bg-selectcustomerform");

        selectLbl.innerHTML = guestTxt.value;
        container2.style.display = 'none';
    }
    
    // function selectCus(){
        var table = document.getElementById('customerTable');
        container2 = document.querySelector(".bg-selectcustomerform");
    
            for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                        console.log('hello');

                        document.getElementById("selectCustomer-text").innerHTML = this.cells[2].innerHTML;
                         container2.style.display = 'none';
                         //rIndex = this.rowIndex;
                    };
                }
            // }
    // -----------------------------SEARCH BAR
    const form3Table = document.querySelector(".form3-table");
    const form2Table = document.querySelector(".form2-table-water");
    const form1Table = document.querySelector(".form1-table-water");
    function refillFunction(){
        form1Table.style.display = 'block';
        form2Table.style.display = 'none';
        form3Table.style.display = 'none';
    }
    function orderFunction(){
        form1Table.style.display = 'none';
        form2Table.style.display = 'block';
        form3Table.style.display = 'none';
    }
    function otherFunction(){
        form1Table.style.display = 'none';
        form2Table.style.display = 'none';
        form3Table.style.display = 'inline-block';
    }
    // -----------------------------Automatic close message
    setTimeout(function() {
        $('#myerror').fadeOut('fast');
    }, 10000);
    // -----------------------------SELECT CUSTOMER
    const selectForm = document.querySelector(".bg-selectcustomerform");
    function selectcustomer(){
        selectForm.style.display = 'flex';
    }
    const addForm = document.querySelector(".bg-addcustomerform");
    function addcustomer(){
        addForm.style.display = 'flex';
        cusForm.style.display = 'none';
    }
    // -----------------------------ADD CUSTOMER
    const cusForm = document.querySelector(".bg-placeorderform");
    function placeorder(){
        cusForm.style.display = 'flex';
    }
    // const cusForm = document.querySelector(".bg-placeorderform");
    const canceladdForm = document.querySelector(".bg-addcustomerform");
    function cancelAddCustomer(){
        canceladdForm.style.display = 'none';
        cusForm.style.display = 'flex';

    }
 
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
