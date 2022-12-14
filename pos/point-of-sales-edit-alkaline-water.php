<?php
include '../connectionDB.php';
require_once '../service/pos-add-customer.php';
require_once '../service/add-transaction-order.php';

date_default_timezone_set("Asia/Manila");

        
if(isset($_POST['delete-order'])){
    $id=$_POST['id-delete'];
        
    $query = "DELETE FROM transaction_process WHERE id='$id'";
        $query_run = mysqli_query($con, $query);
}

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
            <div class="top-buttons">
                <div class="newUser-button">
                    <button type="button" id="select-customerbutton" class="add-account" onclick="selectcustomer();">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="m15.896 17.792-5.125-5.125q-.604.375-1.344.593-.739.219-1.594.219-2.271 0-3.875-1.604T2.354 8q0-2.271 1.604-3.875t3.875-1.604q2.271 0 3.875 1.604T13.312 8q0 .875-.218 1.594-.219.718-.594 1.302l5.146 5.166Zm-8.063-6.771q1.271 0 2.146-.875T10.854 8q0-1.271-.875-2.146t-2.146-.875q-1.271 0-2.145.875-.876.875-.876 2.146t.876 2.146q.874.875 2.145.875Z"/></svg>
                        <h3>SELECT CUSTOMER</h3>
                    </button>
                </div>
                <div class="newUser-button">
                    <button type="button" id="new-customerbutton" class="add-account" onclick="addcustomer();">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 14h1.5v-3.25H14v-1.5h-3.25V6h-1.5v3.25H6v1.5h3.25Zm.75 4q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                        <h3>ADD NEW CUSTOMER</h3>
                    </button>
                </div>
                <div class="newUser-button">
                    <a href="../pos/point-of-sales-add-customer.php" id="return-containerbutton" class="add-account" onclick="addnewuser();">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M7.479 15.042 2.417 10l5.062-5.042 1.729 1.73-2.083 2.083h7v-2.25h2.458v4.708H7.125l2.083 2.083Z"/></svg>
                        <h3>RETURN CONTAINER</h3>
                    </a>
                </div>
                <div class="payment-options">
                    <?php
                        $dropdown_query1 = "SELECT * FROM payment_option";
                        $result3 = mysqli_query($con, $dropdown_query1);
                    ?>
                    <p class="paymentOptions-text">Payment Option</p>
                    <select class="paymentOptions-dropdown">
                        <?php while($row3 = mysqli_fetch_array($result3)):;?>
                            <option><?php echo $row3[1];?></option>
                        <?php endwhile;?>
                    </select>
                </div>
            </div>


            <!-- ---------------------------------------------------- ORDER DETAILS ------------------------------------------------- -->
            <div class="form-container">
                <div class="form1">
                    <p class="selectCustomer-text" id="selectCustomer-text">SELECT CUSTOMER</p>
                    <div class="delivery-options">
                        <select class="select">
                            <option value="Walk In">Walk In</option>
                            <option value="Delivery">Delivery</option>
                            <option value="Pick Up">Pick Up</option>
                        </select>
                    </div>
                    <hr>
                    <div class="form1-ordertype-buttons">
                        <button type="button" class="refillOrder-button" onclick="refillFunction();">Refill</button>
                        <button type="button" class="newOrder-button" onclick="orderFunction();">New</button>
                        <button type="button" class="otherOrder-button" onclick="otherFunction();">Others</button>
                    </div>

                    <br>
             
                    <div class="form1-details">
                        <div class="form1-table">
                        <?php
                                        $dropdown_query1 = "SELECT * FROM inventory_item WHERE category_by_id LIKE '%1' OR category_by_id LIKE '%2' OR  category_by_id LIKE '%10'";
                                        $result1 = mysqli_query($con, $dropdown_query1);
                                ?>
                            <div class="selectItem">
                                <select class='selectTable-water1' id="selectTable-water1"><option value='Alkaline'>Alkaline</option><option value='Mineral'>Mineral</option></select>
                                <select id='selectOrder3' name='' class='select-order3'><?php while($row1 = mysqli_fetch_array($result1)):;?><option><?php echo $row1[1];?></option><?php endwhile;?></select>
                                <label class="qty-label">QTY</label>
                                <input type='number'id='qty3' class='qty3' min='0' placeholder='0' onkeypress='return isNumberKey(event)'>
                                <button class="add-rowsButton" id="add-rowsButton">ADD ORDER</button>   
                            </div>
                            <table class="table1" id="myTable1">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>IMAGE</th>
                                    <th>ITEM</th>
                                    <th>WATER</th>
                                    <th>TYPE</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>TOTAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="form2-table">
                            <?php
                                $dropdown_query7 = "SELECT * FROM inventory_item WHERE category_by_id LIKE '%1' OR category_by_id LIKE '%2'";
                                $result7 = mysqli_query($con, $dropdown_query7);
                            ?>
                            <div class="selectItem">
                                <select id='selectTable-water2'class='selectTable-water2'>
                                    <option value='Alkaline'>Alkaline</option>
                                    <option value='Mineral'>Mineral</option>
                                </select>
                            </div>
                            <table class="table2" id="myTable2">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>ITEM</th>
                                    <th>WATER</th>
                                    <th>TYPE</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>TOTAL</th>
                                </tr>
                                </thead>
                                <?php
                                    $query = "SELECT
                                            inventory_item.image, 
                                            inventory_item.item_name,
                                            category_type.name,
                                            inventory_item.selling_price_item,
                                            status_archive.status, 
                                            inventory_item.alkaline_price,
                                            inventory_item.mineral_price
                                            FROM inventory_item 
                                            INNER JOIN category_type  
                                            ON inventory_item.category_by_id = category_type.id  
                                            INNER JOIN status_archive 
                                            ON inventory_item.status_archive_id = status_archive.id
                                            WHERE category_by_id LIKE '%1' OR category_by_id LIKE '%2'";
                                    $inventory_order = mysqli_query($con, $query);
                                    while ($item_sales = mysqli_fetch_assoc($inventory_order)) {?>
                                    <tbody>
                                        <tr>
                                            <td> <img src="<?php echo "../uploaded_image/".$item_sales['image']; ?>" alt='No Image' width="50px"></td>
                                            <td> <?php echo $item_sales['item_name']; ?></td>
                                            <td><input type="label" id="txt-Water2"></td>
                                            <td> <?php echo $item_sales['name']; ?></td>
                                            <td>
                                                <input type='number'id='qty3' class='qty3' name="qty2" min='0' placeholder='0' onkeypress='return isNumberKey(event)'>
                                            </td>
                                            <td> <?php echo '<span>&#8369;</span>'.' '.$item_sales['selling_price_item']; ?></td>
                                            <td>
                                                <button class="add-rowsButton" id="add-rowsButton">ADD ORDER</button>   
                                            </td>
                                        </tr>
                                        </tbody>
                                    <?php } ?>
                            </table>
                        </div>
                            <div class="form3-table">
                                <?php
                                    $dropdown_query8 = "SELECT * FROM inventory_item WHERE category_by_id LIKE '%5' OR category_by_id LIKE '%7'";
                                    $result8 = mysqli_query($con, $dropdown_query8);
                                ?>

                                    

                                <table class="table3" id="myTable3">
                                    <thead>
                                        <th></th>
                                        <th>ITEM</th>
                                        <th>TYPE</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                        <form action="../service/add-transaction-order.php" method="post" enctype="multipart/form-data" id="addcustomerFrm">
                                    <?php
                                        

                                        $query = "SELECT
                                                inventory_item.id, 
                                                inventory_item.image, 
                                                inventory_item.item_name,
                                                category_type.name,
                                                inventory_item.selling_price_item,
                                                status_archive.status
                                                FROM inventory_item 
                                                INNER JOIN category_type  
                                                ON inventory_item.category_by_id = category_type.id  
                                                INNER JOIN status_archive 
                                                ON inventory_item.status_archive_id = status_archive.id
                                                WHERE category_by_id LIKE '%5' 
                                                OR category_by_id LIKE '%7' 
                                                AND inventory_item.status_archive_id = '1'";
                                        $inventory_order = mysqli_query($con, $query);
                                        while ($item_sales = mysqli_fetch_assoc($inventory_order)) {?>
                                        <tbody>
                                        <tr>
                                            <td > <img src="<?php echo "../uploaded_image/".$item_sales['image']; ?>" alt='No Image' width="50px"></td>
                                            <td > <input type='text' class='' name="item_name3" value="<?php echo $item_sales['item_name']; ?>"></td>
                                            <td > <input type='text' class='' name="category_name3" value="<?php echo $item_sales['name']; ?>"></td>
                                            <td >
                                                <input type='number'id='qty3' class='qty3' min='1' value='1' name="qty3" onkeypress='return isNumberKey(event)'>
                                            </td>
                                            <td > <input type='text' class='' name="price_item3" value="<?php echo '&#8369'.' '.$item_sales['selling_price_item']; ?>"></td>
                                            <td>
                                            <button type="submit" class="add-rowsButton" id="add-rowsButton" name="add-others">ADD ORDER</a>   
                                               
                                            <!-- <a href="../service/add-transaction-order.php?add=<?php echo $item_sales['id']; ?>" class="add-rowsButton" id="add-rowsButton" name="action">ADD ORDER</a>    -->
                                            </td>
                                        </tr>
                                        </tbody>
                                    <?php } ?>
                                </table>
                            </div>
                    
                        </form>
                    </div>
                    <div class="form1-buttons">
                        <!-- <button class="addDeliveryFee-button">Add Delivery Fee</button> -->
                        <button class="addOrder-button" id="addOrder-form">Place Order</button>
                    </div>
                </div>
            </div>
            <!-- ===================================================================================================================== -->
            
            <!-- ---------------------------------------------------- Order Summary ------------------------------------------------- -->

            <div class="form-container-2">
                
                <div class="totalOrder">
                    <header class="company-name">Tag's Water Purified Drinking Water</header>
                    <body>
                        <p class="date-Text">Date and Time:
                        <div class="card">
                            <h1 id="time" class="time">00:00:00</h1>
                            <h1 class="dash">-</h1>
                            <h1 id="date" class="date">00/00/0000</h1>
                        </div>
                        </p>
                        <hr class="hr1">
                        <div class="order-sum">
                            <div class="ordersum-text">
                                <p class="orderSummary-text">Order Summary</p>
                            </div>
                            <div class="cashiersum-text">
                                <p class="cashier-text">Cashier: <span id="cashier-name"><h5 class="name-cashier"><?php echo $_SESSION['user_first_name']; ?></h5></span></p>
                            </div>     
                        </div>
                        <div class="orderSum-table">
                            <table class="tableCheckout" id="sumTable">
                                <thead>
                                <tr>
                                    <th>ITEM</th>
                                    <th>Water</th>
                                    <th>Type</th>
                                    <th>QTY</th>
                                    <th>Price</th>
                                    <th></th>
                                </tr>
                                </thead>
                            <form action="" method="post" enctype="multipart/form-data" id="addcustomerFrm">
                                    <?php
                                        if (isset($_GET['update'])) {                   
                                           $user_id =  $_SESSION['user_user_id'];
                                            $transaction_process = "SELECT
                                                    transaction_process.id, 
                                                    transaction_process.item_name, 
                                                    transaction_process.water_type,
                                                    transaction_process.category_type,
                                                    transaction_process.quantity,
                                                    transaction_process.price
                                                    FROM transaction_process
                                                    WHERE user_id = '$user_id'";
                                            $transaction_order = mysqli_query($con, $transaction_process);
                                            while ($transactions = mysqli_fetch_assoc($transaction_order)) {?>
                                            <tbody>
                                            <tr>
                                                <td> <?php echo $transactions['item_name']; ?></td>
                                                <td> <?php echo $transactions['water_type']; ?></td>
                                                <td> <?php echo $transactions['category_type']; ?></td>
                                                <td> <?php echo $transactions['quantity']; ?></td>
                                                <td> <?php echo '<span>&#8369;</span>'.' '.$transactions['price']; ?></td>

                                                <td>
                                                    <input type='hidden'name="id-delete" value="<?php echo $transactions['id']; ?>">  
                                                    <input type='submit'name="delete-order" class='removeBtn' value="X">  
                                                </td>
                                            </tr>
                                            </tbody>
                                        <?php }} ?>
                                </table>
                            </form>
                        </div>
                        <hr>
                        <div class="totalOrder-amount">
                            <div class="orderTotal1">
                                <p class="orderTotal-text">Order Total</p>
                            </div>
                            <div class="orderTotal2">
                                <span class="php">&#8369;</span>
                                <div class="input-total-amount">
                                    <input type="text" class="total-order" value="0.00" readonly/>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="receipt-buttons">
                            <a href="point-of-sales.php" id="cancel">CANCEL</a>
                            <input type="button" class="confirmOrder-button" value="CONFIRM">
                        </div>
                    </body>
                </div>
            </div>
        </div>
        <!-- ---------------------------------------------------- PREVIOUS TRANSACTIONS ------------------------------------------------- -->
        
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


</body>
<script src="../javascript/side-menu-toggle.js"></script>
<!-- <script src="../javascript/top-menu-toggle.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script src="https://code.jquery.com/jquery.min.js"></script>
<!-- <script src="../javascript/point-of-sales.js"></script> -->
<script>
    // $(function(){
    //     $("#selectTable-water2").change(function(){
    //         var tdWater = $("#selectTable-water2 option:selected").text();
    //         $("#txt-Water2").val(tdWater);
    //     });
    // });


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
    const form2Table = document.querySelector(".form2-table");
    const form1Table = document.querySelector(".form1-table");
    function refillFunction(){
        form1Table.style.display = 'inline-block';
        form2Table.style.display = 'none';
        form3Table.style.display = 'none';
    }
    function orderFunction(){
        form1Table.style.display = 'none';
        form2Table.style.display = 'inline-block';
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
    }, 3000);
    // -----------------------------SELECT CUSTOMER
    const selectForm = document.querySelector(".bg-selectcustomerform");
    function selectcustomer(){
        selectForm.style.display = 'flex';
    }
    // -----------------------------ADD CUSTOMER
    const addForm = document.querySelector(".bg-addcustomerform");
    function addcustomer(){
        addForm.style.display = 'flex';
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
<style>
    :root{
    --color-main: rgb(2, 80, 2);
    --color-white: white;
    --color-white-secondary: white;
    --color-tertiary: hsl(0, 0%, 57%);
    --color-black: rgb(49, 49, 49);
    --color-maroon: rgb(136, 0, 0);
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

.select-dropdown{
    position: relative;
    margin-top: 3.1rem;   
}
.profile-pic{
    align-items: center;
    text-align: center;
    justify-content: center;
    margin-top: 1rem;
}
.profile-pic img{
    background: var(--color-solid-gray);
    border-radius: 10%;
    width: 100px;
    padding: 3px;
}
.label-item2{
    font-family: 'calibri', sans-serif;
    font-size: 2rem;
    font-weight:900;
    margin-top: 1.1rem;
    border: none;
    width: 10rem;
    justify-content: center;
    color: var(--color-solid-gray);
}
.label-item2:focus{
    border: none;
    outline: none;
}
.label-item{
    /* height: 100%; */
    font-family: 'calibri', sans-serif;
    font-size: 20px;
    font-weight:900;
    margin-top: 3.1rem;

    justify-content: center;
    color: var(--color-main);
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
.usertype-dropdown{
    width: 48%;
    margin-top: 1.6rem;
    display: flex;
    flex-wrap: wrap;
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
.action-dropdown{
    position: relative;
    margin-top: .5rem;
    /* left: 10%; */
    margin-bottom: .5rem
}
.user-input-box:nth-child(2n){
    justify-content: end;
}

.checker {
    /* display: flex; */
    flex-wrap: wrap;
    width: 100%;
    padding-bottom: 15px;
    gap: 5px;
    text-align: right;
    align-items: right;
}
.checker span {
    text-decoration: none;
    color: var(--color-solid-gray);
    top: 0;
    font-size: min(max(10px, 1.2vw), 12px);
    font-family: 'Switzer', sans-serif;
}
.user-input-box{
    display: flex;
    flex-wrap: wrap;
    width: 48%;
    padding-bottom: 15px;
}
#email-box input{
    background-color: var(--color-tertiary);
    color: var(--color-white);
}
#email-box input:hover{
    border: 2px solid var(--color-maroon);
}
.not-edit{
    font-family: 'Calibri', sans-serif;
    font-size: 12px;
    color: var(--color-maroon);
    display: inline-block;
    position: static;
    /* position: relative; */
    /* padding-bottom: 2rem; */
    /* left: 0; */
}
.user-input-box label{
    width: 100%;
    color: var(--color-solid-gray);
    font-size: 16px;
    /* margin-left: .2rem; */
    margin-bottom: 0.5rem;
    font-family: 'Malberg Trial', sans-serif;
    font-weight: 550;
    display: inline-block;
    position: relative;
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
    border: 2px solid var(--color-main-3);
    background: var(--color-white);
}

.user-input-box input{
    height: 40px;
    display: inline-block;
    position: relative;
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
    margin-top: 1rem;
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

.choose-profile{
    /* position: relative; */
    width: 97%;
    height: 1.32rem;
    padding: 10px;
    margin-top: 1rem;
    background: var(--color-solid-gray);
    color: var(--color-white);
    border-radius: 10px;
    transition: 0.5s;
    font-family: 'COCOGOOSE', sans-serif;
    cursor: pointer;
}

#image-profile{
    cursor: pointer;
    text-align: center;
    align-items: center;
}
.gender-title{
    /* margin-top: rem; */
    font-family: 'Calibri', sans-serif;
    color: var(--color-solid-gray);
    width: 100%;
    font-size: 20px;
    margin-left: .2rem;
    font-family: 'Malberg Trial', sans-serif;
    font-weight: 550;
    /* border-bottom: 2px solid var(--color-solid-gray); */
}

.gender-category{
    margin: 15px 0;
    color:  var(--color-solid-gray);
}

.gender-category label{
    padding: 0 20px 0 5px;
}

.gender-category label,
.gender-category input,
.form-submit-btn input{
    cursor: pointer;
}

.form-submit-btn{
    margin-top: 40px;
}

.form-submit-btn input{
    display: block;
    width: 100%;
    margin-top: 10px;
    font-size: 20px;
    padding: 10px;
    border:none;
    border-radius: 3px;
    color: rgb(209, 209, 209);
    background: rgba(63, 114, 76, 0.7);
}

.form-submit-btn input:hover{
    background: rgba(56, 204, 93, 0.7);
    color: rgb(255, 255, 255);
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
    display: inline-block;
    margin-top: 1.3rem;
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
    background:  var(--color-mainbutton);
    cursor: pointer;
    transition: 0.5s;
    margin-left: 1rem;
}
.AddButton button:hover{
    background: var(--color-button-hover);
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
#cancel{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    padding-left: 80px;
    padding-right: 80px;
    text-align: center;
    width: 30rem;
    max-height: 70px;
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
    background-color: rgb(158, 0, 0);
    transition: 0.5s;
}

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
        width: 95%;
        margin-bottom: 1rem;
        margin-top: -.3rem;
    }
    .gender-category{
        display: flex;
        /* justify-content: space-between; */
        width: 100%;
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
        margin-top: 4.3rem;
    }
    .AddButton button:hover{
        background: var(--color-button-hover);
    }
    .CancelButton{
        position: relative;
        margin-top: 3rem;
        padding-top: 2rem;
        /* padding-right: 2rem; */
    }
    .AddButton{
        position: relative;
        margin-top: -4rem;
        margin-left: -1em;

    }
    /* .CloseButton{
        margin-top: 5.2vh;
        margin-left: 2.4em;
        margin-bottom: -2rem;
    } */
    #cancel{
        width: 100%;
    }
}
.block{
    width: 5rem;
    height: 2rem;
    background-color: var(--color-background);
    position: fixed;
    display: flex;
    top: 0;
}
/* -----------------------------------------Adduserform------------------------------------------ */
.bg-adduserform{
    height: 100%;
    width: 100%;
    background: rgba(0,0,0,0.7);
    top: 0;
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    /* display: none; */
}
.selectItem{
    margin-bottom: 1rem;
    align-items: left;
    text-align: left;
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
    width: 70%;
    border-radius: 6px;
    align-items: center;
    text-align: center;
    margin-left: 3.55rem;
    font-size: min(max(9px, 1.2vw), 11px);
    letter-spacing: 0.5px;
    font-family: Helvetica, sans-serif;
}
.bg-addcustomerform{
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
.select{
    background: var(--color-solid-gray);
    color: var(--color-white);
    align-items: center;
    border-radius: 13px;
    padding: 8px 12px;
    height: 40px;
    width: 96%;
    cursor: pointer;
    transition: 0.3s;
}
.action-dropdown{
    position: relative;
    margin-top: .5rem;
    margin-bottom: .5rem
}
.user-input-box:nth-child(2n){
    justify-content: end;
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
    width: 20%;
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
    margin-top: 1rem;
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
    display: inline-block;
    margin-top: 1.3rem;
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
    background:  var(--color-mainbutton);
    cursor: pointer;
    transition: 0.5s;
    margin-left: 1rem;
    display: inline-block;
    background: var(--color-solid-gray);
}
.AddButton button:hover{
    background: var(--color-main);
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
#cancel{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    padding-left: 90px;
    padding-right: 90px;
    text-align: center;
    width: 15rem;
    max-height: 70px;
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
    background-color: rgb(158, 0, 0);
    transition: 0.5s;
}

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
    font-family: 'COCOGOOSE', sans-serif;
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
    margin:1rem;
    font-size: .8rem;
    letter-spacing: 0.02rem;
    border-bottom: 2px solid var(--color-solid-gray);
}
tr:hover td{
    color: var(--color-main);
    cursor: pointer;
    background-color: var(--color-table-hover);
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
/* button:hover{
    filter: brightness(100%);
    transition: 0.3s;
    /* font-weight: bolder; */
/* font-size: 110%; */
/* } */
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
.payment-options{
    background-color: none;
    position: absolute;
    display: inline-block;
    padding-top: 1rem;
    right: 8%;
}
.paymentOptions-text{
    font-size: 1rem;
    color: var(--color-solid-gray);
    font-weight: bold;
    margin-top: .5rem;
    display: inline-block;
    text-align: center;
    margin-right:4px;

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
    width: 10rem;
    height: 2rem;
    cursor: pointer;
}

/* ORDER FORM -------------------------------------------------------------------------------*/
.form-container{
    display: inline-block;
    position: relative;
    width: 65%;
    /* align-items: left; */
}
.form1{
    background-color: var(--color-white);
    margin-top: 2rem;
    border: none;
    display: inline-block;
    height: 71%;
    width: 100%;
    border-radius: 10px;
    position: relative;
    padding-top: 1rem;
}

.delivery-options{
    display: inline-block;
    position: relative;
    margin-left: 5rem;
    margin-top: -.7rem;
}
.select{
    background: var(--color-solid-gray);
    color: var(--color-white);
    border-radius: 15px;
    width: 12rem;
    padding: 10px 13px;
    font-size: 14px;
    cursor: pointer;
    transition: 0.3s;
    border: none;
}
.select:hover{
    background: var(--color-main);
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
    width: 100%;
    /* margin-left: 2rem; */
    height: 2rem;
    position: relative;
    text-align: center;
}
.refillOrder-button{
    background-color: var(--color-background);
    color: var(--color-main);
    display: inline-block;
    height: 2rem;
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
    height: 2rem;
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
    height: 2rem;
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
.form1-details{
    width: 100%;
    margin-top: 0.5rem;
    margin-left: 1rem;
    margin-bottom: 1rem;
    display: inline-block;
}
.form1-tableoption-buttons{
    background-color: none;
    width: 20%;
    float: left;
    text-align: right;
    font-family: 'outfit', sans-serif;
    border: none;
}
/* .containerlogo{
    height: 2rem;
    gap: 0.8rem;
    position: relative;
    display: inline-block;
    padding-top:0.5rem;
    padding-right: 0.2rem;
    margin-bottom: -0.5rem;
}
.containerTable-button{
    background: var(--color-solid-gray);
    color: var(--color-white);
    font-weight: 600;
    display: inline-block;
    font-family: 'arial', sans-serif;
    padding: 1rem;
    height: 3rem;
    width: 78%;
    position: relative;
    border: none;
    text-transform: uppercase;
    border-radius: 0 15px 15px 0;
    font-size: .7rem;
    cursor: pointer;
    margin: 1px;
}
.containerTable-button:focus{
    background-color: var(--color-blue-button);
    color: var(--color-white);
}
.bottlelogo{
    position: relative;
    height: 2rem;
    gap: 0.8rem;
    display: inline-block;
    padding-top:0.4rem;
    margin-bottom: -0.5rem;
    padding-right: 0.2rem;
}
.bottleTable-button{
    background: var(--color-solid-gray);
    color: var(--color-white);
    font-weight: 600;
    font-family: 'arial', sans-serif;
    padding: 1rem;
    height: 3rem;
    border-radius: 0 15px 15px 0;
    border: none;
    width: 78%;
    text-transform: uppercase;
    font-size: .7rem;
    cursor: pointer;
    margin: 1px;
}
.bottleTable-button:focus{
    background-color: var(--color-blue-button);
    color: var(--color-white);
}
.menulogo{
    display: flex;
    height: 1.4rem;
    gap: 0.8rem;
    display: inline-block;
    padding-top:0.5rem;
    margin-bottom: -0.3rem;
    padding-right: 0.5rem;
    padding-left: 0.3rem;

}
.othersTable-button{
    background: var(--color-solid-gray);
    color: var(--color-white);
    font-weight: 600;
    font-family: 'arial', sans-serif;
    padding: 1rem;
    height: 3rem;
    width: 78%;
    border: none;
    text-transform: uppercase;
    font-size: .7rem;
    border-radius: 0 15px 15px 0;
    margin-left: 1px;
    margin-right: 1px;
    margin-bottom: 1px;
    cursor: pointer;
    margin-top: 2.5px;
}
.othersTable-button:focus{
    background-color: var(--color-blue-button);
    color: var(--color-white);
} */
.form1-table{
    background-color: var(--color-white);
    padding: 1rem;
    width:94%;
    overflow:auto;
    margin-bottom: -1rem;
    display: inline-block;
    height: 15rem;
    align-items: right;
    text-align: right;
    border: 1px solid var(--color-tertiary);
    position: relative;
    border-radius: 10px;
}
.form2-table{
    background-color: var(--color-white);
    padding: 1rem;
    width:94%;
    overflow:auto;
    margin-bottom: -1rem;
    display: none;
    height: 15rem;
    align-items: right;
    text-align: right;
    border: 1px solid var(--color-tertiary);
    position: relative;
    border-radius: 10px;
}
.form3-table{
    background-color: var(--color-white);
    padding: 1rem;
    width:94%;
    overflow:auto;
    margin-bottom: -1rem;
    display: none;
    height: 15rem;
    align-items: right;
    text-align: right;
    border: 1px solid var(--color-tertiary);
    position: relative;
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
.selectTable-water1{
    width: 10rem;
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
    position: relative;
    display: flex;
}
.selectTable-water1:hover{
    background: var(--color-solid-gray);
    transition: 0.5s;
    color: var(--color-white);
}
.selectTable-water2{
    width: 10rem;
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
    width: 33%;
    margin-left:1rem;
}

/* RECEIPT --------------------------------------------------------------------------------------*/

.totalOrder{
    background-color: var(--color-white);
    border-color: var(--color-table-border);
    box-shadow: 0px 5px 0px 0px var(--color-shadow-shadow);
    width: 100%;
    border-radius: 10px;
    position: relative;

}
.company-name{
    color: var(--color-solid-gray);
    font-size: 0.8rem;
    font-weight: bold;
    text-align: center;
    margin-top: .7rem;
    padding-top: 1rem;
    text-transform: uppercase;
}
.date-Text{
    font-weight: 900;
    font-size: 13px;
    margin-left: 1rem;
    margin-top:1.7rem;
    color: var(--color-black);
    display: inline-block;
}
.card {
    display: inline-block;
    /* padding-bottom: 1rem; */
    /* padding-bottom: 1.6rem; */
    /* box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15), 0 3px 6px rgba(0, 0, 0, 0.2); */
    border-radius: 0.1rem;
    height: 1rem;
    margin-left: 2rem;
    border: transparent;
    font-size: 10px;
    font-family: 'Rajdhani', sans-serif;
    /* left: 25vw;      */
    /* margin-top: rem; */
    /* position: absolute; */
}
.time{
    /* background-color: var(--color-black); */
    color: var(--color-solid-gray);
    font-size: 1.5rem;
    font-weight: 500;
    display: inline-block;
}
.date {
    color: var(--color-solid-gray);
    font-size: 1.5rem;
    font-weight: 500;
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
    margin-left: 1rem;
    margin-bottom: -1rem;
}
.orderSum-table{
    background-color: var(--color-white);
    padding: 1rem;
    /* width:100%; */
    overflow:auto;
    /* display: inline-block; */
    /* margin-left: 1.1rem; */
    height: 13rem;
    margin-top: -1rem;
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

table tbody td{
    height: 2.8rem;
    border-bottom: 1px solid var(--color-solid-gray);
    color: var(--color-td);
    font-size: .67rem;
}
.tableCheckout th{
    height: 1.8rem;
    color: var(--color-solid-gray);
    margin:1rem;
    font-size: .8rem;
    letter-spacing: 0.02rem;
    border: none;
    /* border-bottom: 2px solid var(--color-solid-gray); */
}
tr:hover td{
    color: var(--color-main);
    cursor: pointer;
    background-color: var(--color-table-hover);
}
.totalOrder-amount{
    /* width: 100%; */
    position: static;
}
.orderTotal1{
    display: inline-block;
    position: relative;
}
.orderTotal-text{
    color: var(--color-black);
    font-weight: bolder;
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
    background: var(--color-solid-gray);
    border-radius: 5rem;
    font-size: min(max(9px, 1.1vw), 11px);
    color: var(--color-white);
    border: none;
    position: relative;
    height: 2.3rem;
    width: 15rem;
    margin-left: 1rem;
    font-family: 'COCOGOOSE', sans-serif;
    text-transform: uppercase;
    cursor: pointer;
}
.confirmOrder-button:hover{
    filter: brightness(120%);
    background: var(--color-tertiary);
    transition: 0.5s;
}

#cancel{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    padding-left: 60px;
    position: relative;
    padding-right: 60px;
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
    background-color: rgb(158, 0, 0);
    transition: 0.5s;
}

/* PREVIOUS TRANSACTIONS ------------------------------------------------------------------------------- */
.form3{
    width: 100%;
    position: relative;
}
.previous-transaction{
    background-color: var(--color-white);
    padding-left: 2rem;
    width: 97%;
    max-height: 600px;
    margin-bottom: 2rem;
    margin-top: 2rem;
    border: 1px solid;
    border-color: var(--color-table-border);
    position: absolute;
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
    height: 3.3rem;
    /* padding: 1rem; */
    color: var(--color-black);
    margin:1rem;
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
