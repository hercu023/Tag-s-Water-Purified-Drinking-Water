<?php
require_once '../database/connection-db.php';
require_once "../service/user-access.php";
require_once "../service/add-delivery.php";
require_once "../service/delete-transaction-order.php";

date_default_timezone_set("Asia/Manila");

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'MONITORING-DELIVERY_PICKUP')) {
    header("Location: ../common/error-page.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i>You are not authorized to access this page.");
    exit();
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" type="text/css" href="../CSS/monitoring-delivery-pickup.css">
        <title>Tag's Water Purified Drinking Water</title>
  
        <script src="../index.js"></script>
    </head>

    <body>
    
        <div class="container">
            <?php
                include('../common/side-menu.php')
            ?>
            <main>
                <div class="main-dashboard">
                    <h1 class="dashTitle">MONITORING</h1> 
                    <?php
                    if (isset($_GET['success'])) {
                        echo '<p id="myerror" class="success-success"> '.$_GET['success'].' </p>';
                    }
                    ?>
                    <?php
                    if (isset($_GET['error'])) {
                        echo '<p id="myerror" class="error-error"> '.$_GET['error'].' </p>';
                    }
                    ?>
                    <div class="sub-tab">
                        <div class="user-title">
                            <h2>DELIVERY/PICK UP</h2>
                        </div>
                        <div class="sub-tab-container">
                            <div class="newUser-button2"> 
                                <div id="add-userbutton" class="add-account2">
                                    <?php
                                        $delivery_query = "SELECT 
                                        count(transaction.id) as count
                                        FROM transaction
                                        WHERE transaction.service_type = 'Delivery'
                                        AND transaction.uuid NOT IN (SELECT uuid FROM delivery_list)";
                                        $delivery_result = mysqli_query($con, $delivery_query);
                                        $delivery = mysqli_fetch_assoc($delivery_result);
                                        $count_of_for_delivery = $delivery['count'];
                                    
                                    ?>
                                    <h3 class="deliveries">For Delivery</h3>
                                    <span class="total-deliveries"><?php echo $count_of_for_delivery ?></span>
                                </div>
                            </div>
                            <div class="newUser-button1"> 
                                <div id="add-userbutton" class="add-account1">
                                    <?php
                                        $delivery_pickup_query = "SELECT 
                                        count(transaction.id) as count
                                        FROM transaction
                                        WHERE transaction.service_type = 'Delivery/Pick Up'
                                        AND transaction.uuid NOT IN (SELECT uuid FROM delivery_list)";
                                        $delivery_pickup_result = mysqli_query($con, $delivery_pickup_query);
                                        $delivery_pickup = mysqli_fetch_assoc($delivery_pickup_result);
                                        $count_of_for_delivery_pickup = $delivery_pickup['count'];
                                    
                                    ?>
                                    <h3 class="deliveries">For Pick Up</h3>
                                    <span class="total-deliveries"><?php echo $count_of_for_delivery_pickup ?></span>
                                </div>
                            </div>
                        <!-- </div> -->
                        <!-- <div class="sub-tab-container1"> -->
                            <div class="createDelivery">
                                <a href="../monitoring/monitoring-delivery-pickup-delivered.php" id="add-userbutton" class="batchlist">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M5 16q-1.042 0-1.771-.729Q2.5 14.542 2.5 13.5H1V5q0-.625.438-1.062Q1.875 3.5 2.5 3.5H14v3h2.5L19 10v3.5h-1.5q0 1.042-.729 1.771Q16.042 16 15 16q-1.042 0-1.771-.729-.729-.729-.729-1.771h-5q0 1.042-.729 1.771Q6.042 16 5 16Zm0-1.5q.417 0 .708-.292Q6 13.917 6 13.5t-.292-.708Q5.417 12.5 5 12.5t-.708.292Q4 13.083 4 13.5t.292.708q.291.292.708.292Zm10 0q.417 0 .708-.292.292-.291.292-.708t-.292-.708Q15.417 12.5 15 12.5t-.708.292Q14 13.083 14 13.5t.292.708q.291.292.708.292Zm-1-4 3.5-.021L15.729 8H14Z"/></svg>
                                    <h3 class="deliveries">DELIVERED CUSTOMERS LIST</h3>
                                </a>
                            </div>
                            <div class="pickup">
                                <a href="../monitoring/monitoring-delivery-pickup-list.php" id="add-userbutton" class="pickuplist">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="m7 16.5-1.062-1.062 2.187-2.188H2v-1.5h6.125L5.938 9.562 7 8.5l4 4Zm6-5-4-4 4-4 1.062 1.062-2.187 2.188H18v1.5h-6.125l2.187 2.188Z"/></svg>
                                    <h3 class="deliveries">PICK UP LIST</h3>
                                </a>
                            </div>
                        </div>
                    </div> 

                    <div class="customer-container" id="customerTable">
                                <br>
                   
                                <div class="card">
                                     <h1 class="day"><?php echo date("l")?></h1>
                                    <h1 class="dash">-</h1>
                                    <h1 class="date"><?php echo ' '.date("F j, Y")?></h1>
                                </div>
                                <hr>
                                <table class="table" id="myTable">
                                <thead>
                                        <tr>
                                            <th ><span class="statusLbl">STATUS</span></th>
                                            <th>ID</th>
                                            <th>Customer Name</th>
                                            <!-- <th>Address</th>
                                            <th>Contact Number</th> -->
                                            <th>Payment Status</th>
                                            <th>Date/Time Listed</th>
                                            <th>Transaction Details</th>
                                        </tr>
                                </thead>
                            <?php
                            $dropdown_query2 = "SELECT 
                            transaction.id,
                            transaction.uuid,
                            customers.customer_name,
                            transaction.status_id,
                            users.first_name,
                            users.last_name,
                            transaction.created_at_date,
                            transaction.service_type,
                            transaction.created_at_time
                            FROM transaction
                            INNER JOIN users
                            ON transaction.created_by_id = users.user_id
                            INNER JOIN payment_option
                            ON transaction.payment_option = payment_option.id
                            LEFT JOIN customers
                            ON transaction.customer_name_id = customers.id
                            WHERE transaction.service_type != 'Walk In'
                            AND transaction.uuid NOT IN (SELECT uuid FROM delivery_list)
                            ORDER BY transaction.created_at_time";
                            $result = mysqli_query($con, $dropdown_query2);
                            if(mysqli_num_rows($result) > 0)
                            {
                            foreach($result as $rows)
                            {?>
                        <tbody>
                            <form action="" method="post" enctype="multipart/form-data" id="addorderFrm">
                                <td data-label="STATUS">
                                    <?php 
                                        if($rows['service_type'] == 'Delivery/Pick Up'){
                                    ?>
                                        <button type="submit" name="add-for-pickup" class="status2">ADD FOR PICK UP</button>
                                    <?php
                                        }else{
                                    ?>
                                            <button type="submit" name="add-for-delivery" class="status3">ADD FOR DELIVERY</button>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td data-label="ID"> <?php echo $rows['id']; ?></td>
                                            <td data-label="Customer Name">
                                                <input type="hidden" name="customername" value="<?php echo $rows['customer_name']; ?>"/>
                                                <?php echo $rows['customer_name'];?>
                                            </td>

                                            <td data-label="Payment Status">
                                                <input type="hidden" name="status" value="<?php echo $rows['status_id']; ?>"/>
                                                <?php
                                                     if($rows['status_id'] == 0){
                                                        echo '<span class="outofstock">Unpaid</span>';
                                                    }else{
                                                        echo '<span class="instock">Paid</span>';
                                                    } 
                                                ?>
                                            </td>     
                                            <td data-label="Date/Time Listed"> 
                                                <?php echo $rows['created_at_date'].' '.$rows['created_at_time']; ?></td>
                                            <td data-label="Transaction Details">
                                                <input type="hidden" name="uuid" value="<?php echo $rows['uuid'];?>"/>
                                                <a class="viewTransaction" href="../monitoring/monitoring-delivery-pickup.php?view=<?php echo $rows['uuid'];?>">View Details</a>
                                            </td>
                                   
                            </form>
                        </tbody>
                        <?php  }}else { ?>
                                <tr id="noRecordTR">
                                    <td colspan="6">No Delivery/Pick Up Added</td>
                                </tr>
                            <?php } ?>
                                </table>
                    </div>

                        <div class="delivery-container" id="customerTable">
                        
                            <div class="dateandtime">
                                <p class="date-Text">Date/Time:</p>
                                <div class="card-live">
                                    <h1 id="time" class="time">00:00:00</h1>
                                    <h1 class="dash">-</h1>
                                    <h1 id="date" class="date-live">00/00/0000</h1>
                                </div>
                            </div>
                            <hr>
                            <div class="deliveryLbl">
                                <h2>- DELIVERY LIST -</h2>
                            </div>
                    <form action="" method="post" enctype="multipart/form-data" id="addorderFrm">
                            <div class="deliveryboys">
                                <h4>COURIER</h4>
                                <div class="usertype-dropdown1">
                                    <?php
                                    $dropdown_query = "SELECT * FROM employee WHERE position_id LIKE '%2'";
                                    $result_category = mysqli_query($con, $dropdown_query);
                                    ?>
                                    <select class="select1" name="delivery_boy" required="" >
                                        <option selected disabled value="">SELECT DELIVERY BOY</option>
                                        <?php while($category = mysqli_fetch_array($result_category)):;?>
                                            <option value="<?php echo $category['id']?>">
                                                <?php echo $category['first_name'].' '.$category['last_name'];?></option>
                                        <?php endwhile;?>
                                    </select>
                                </div>
                            </div>
        
                            <div class="deliverylist-table">
                            <?php 
                            // per customer
                                    $user_id = $_SESSION['user_user_id'];
                            
                                    $transaction_process = "SELECT
                                                customers.customer_name,
                                                customers.id,
                                                sum(transaction.total_amount) AS total
                                                FROM delivery_list
                                                INNER JOIN transaction
                                                ON delivery_list.uuid = transaction.uuid
                                                INNER JOIN customers
                                                ON transaction.customer_name_id = customers.id
                                                WHERE delivery_list.user_id = '$user_id'
                                                AND delivery_list.delivery_status = 1
                                                GROUP BY customers.customer_name";
                                    $transaction_order = mysqli_query($con, $transaction_process);
                                    if(mysqli_num_rows($transaction_order) > 0)
                                    { 
                                        foreach($transaction_order as $transaction_name)
                                        {
                            ?>
                                <table class="tableCheckout" id="sumTable">
                                    <thead>
                                        <tr>
                                            <th class="th-name"><span class="nameTd">Name</span></th>
                                            <td colspan="3"><?php echo $transaction_name['customer_name'];?></td>
                                        </tr>
                                        <tr>
                                            <th class="th-name"><span class="nameTd">Total Amount</span></th>
                                            <td colspan="3"><?php echo $transaction_name['total'];?></td>
                                        </tr>
                                    <?php 
                                    $customer_id = $transaction_name['id'];
                                    $total_unpaid = "SELECT 
                                    t.id,
                                    t.customer_name,
                                    t.contact_number1,
                                    t.address, 
                                    t.balance,
                                    SUM(t.unpaid_amount) as credit
                                    FROM
                                    (SELECT
                                    customers.id,
                                    customers.customer_name,
                                    customers.contact_number1,
                                    customers.address, 
                                    customers.balance,
                                    transaction_history.transaction_uuid,
                                    MIN(transaction_history.unpaid_amount) as unpaid_amount
                                    FROM transaction_history
                                    INNER JOIN transaction
                                    ON transaction.uuid = transaction_history.transaction_uuid
                                    INNER JOIN delivery_list 
                                    ON transaction.uuid = delivery_list.uuid
                                    INNER JOIN customers
                                    on transaction.customer_name_id = customers.id
                                    WHERE customers.status_archive_id = 1
                                    AND delivery_list.delivery_status = 1
                                    AND delivery_list.user_id = '$user_id'
                                    GROUP BY transaction_history.transaction_uuid) 
                                    t 
                                    WHERE t.id = '$customer_id'
                                    GROUP BY t.customer_name
                                    HAVING SUM(t.unpaid_amount) > 0";
                                    $transaction_unpaid_result = mysqli_query($con, $total_unpaid);
                                    if(mysqli_num_rows($transaction_unpaid_result) > 0)
                                     { 
                                    $transaction_unpaid = mysqli_fetch_assoc($transaction_unpaid_result);
                                    ?>
                                    
                                        <tr>
                                            <th class="th-name"><span class="nameTd">Total Unpaid Amount</span></th>
                                            <td colspan="3"><?php echo $transaction_unpaid['credit'];?></td>
                                        </tr>
                                    <?php } ?>
                                    </thead>
                                    <?php  
                                    // per uuid per customer 
                                        $customer_name = $transaction_name['customer_name'];    
                                                $transaction_uuid = "SELECT
                                                        delivery_list.uuid
                                                        FROM delivery_list
                                                        INNER JOIN transaction
                                                        ON delivery_list.uuid = transaction.uuid
                                                        INNER JOIN customers
                                                        ON transaction.customer_name_id = customers.id
                                                        WHERE customers.customer_name = '$customer_name'
                                                        AND delivery_list.delivery_status = 1
                                                        AND delivery_list.user_id = $user_id";
                                                $transaction_uuid_result = mysqli_query($con, $transaction_uuid);
                                                if(mysqli_num_rows($transaction_uuid_result) > 0)
                                                {?>
                                    <tbody>
                                        <?php
                                        foreach($transaction_uuid_result as $transactions_uuid)
                                        {
                                        ?>  
                                        <thead>
                                            <tr>
                                                <th>ORDER</th>
                                                <th>WATER</th>
                                                <th>QTY</th>
                                                <th>AMOUNT</th>
                                                <th>     
                                                    <a href="../service/delete-transaction-order.php?delete-list=<?php echo $transactions_uuid['uuid']; ?>" class="delete-rowsButton" name="action">
                                                        X
                                                    </a>
                                                </th>
                                            </tr>
                                        </thead> 
                                        <?php
                                            $uuid = $transactions_uuid['uuid'];
                                            $transaction_process = "SELECT
                                            transaction_process.item_name, 
                                            transaction_process.water_type,
                                            transaction_process.category_type,
                                            transaction_process.quantity,
                                            transaction_process.price,
                                            transaction_process.total_price
                                            FROM transaction_process
                                            INNER JOIN transaction
                                            ON transaction_process.transaction_id = transaction.uuid
                                            INNER JOIN delivery_list
                                            ON delivery_list.uuid = transaction.uuid
                                            WHERE transaction_id = '$uuid'
                                            AND delivery_list.delivery_status = 1
                                            AND delivery_list.user_id = '$user_id'";
                                            $transaction_order = mysqli_query($con, $transaction_process);
                                            if(mysqli_num_rows($transaction_order) > 0)
                                            {
                                        foreach($transaction_order as $transactions){
                                        ?>  
                                                    <tr>
                                                        <td name="itemname_transaction"> <?php echo $transactions['item_name']; ?></td>
                                                        <td name="watertype_transaction"> <?php echo $transactions['water_type']; ?></td>
                                                        <td name="categorytype_transaction"> <?php echo $transactions['quantity']; ?></td>
                                                        <td> <?php echo '&#8369'.' '. number_format($transactions['total_price'], '2','.',','); ?></td>
                                                    </tr>
                                                    <?php } ?> 
                                      
                                                    <?php }}}} } else { ?> 
                                                        <tr id="noRecordTR"><td > <span class="nodelivers" >No Deliveries Added</span></td></tr>
                                                    <?php } ?> 

                                                </tbody>
                                                
                                </table>
                            </div>
                            <div>
                            <?php
                            $transaction_order1 = mysqli_query($con, "SELECT sum(transaction.total_amount) 
                            AS total
                            FROM transaction
                            INNER JOIN delivery_list 
                            ON transaction.uuid = delivery_list.uuid
                            WHERE delivery_list.user_id = '$user_id'
                            AND delivery_list.delivery_status = 1"); 
                                                
                                                $transactions1 = mysqli_fetch_assoc($transaction_order1);

                                                            ?>

                            <hr>
                                <div class="totaldelivery1"><p class="totalAmount-text">TOTAL PAYMENTS</p></div>
                                <div class="total-amount">
                                    <label id="total_order1">&#8369</label>
                                    <input type="text" name="totalAmount" readonly id="totalAmount_order" value="<?php echo number_format($transactions1['total'], '2','.',','); ?>">
                                </div>
                            </div>
                            
        
                            <div class="receipt-buttons">
                                <button type="submit" name="print-delivery" id="addcustomerBtn" class="confirmOrder-button">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M15 6H5V3h10Zm-.25 4.5q.312 0 .531-.219.219-.219.219-.531 0-.312-.219-.531Q15.062 9 14.75 9q-.312 0-.531.219Q14 9.438 14 9.75q0 .312.219.531.219.219.531.219Zm-1.25 5v-3h-7v3ZM15 17H5v-3H2V9q0-.833.583-1.417Q3.167 7 4 7h12q.833 0 1.417.583Q18 8.167 18 9v5h-3Z"/></svg>
                                    Print
                                </button>
                                
                                <button type="submit" class="confirmOrder-button2" name="deliver">
                                    DELIVER
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="form3">
                <div class="todeliver-transaction">
                    <br>
                    <header class="todeliver-transaction-header">ONGOING DELIVERY ORDERS</header>
                    <hr>
                    <table class="todeliver-transaction-table">
                        <thead>
                        <tr>
                            <th scope="col"><span class="statusLbl">STATUS</span></th>
                            <th scope="col">ID</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Order Details</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Delivery Boy</th>
                            <th scope="col">Date/Time Added</th>
                        </tr>
                        </thead>
                        <?php
                            $dropdown_query2 = "SELECT 
                            transaction.id,
                            transaction.uuid,
                            customers.customer_name,
                            transaction.status_id,
                            transaction.total_amount,
                            delivery_list.updated_at,
                            employee.first_name,
                            employee.last_name
                            FROM transaction
                            INNER JOIN delivery_list
                            ON transaction.uuid = delivery_list.uuid
                            INNER JOIN employee
                            ON delivery_list.delivery_boy_id = employee.id
                            INNER JOIN payment_option
                            ON transaction.payment_option = payment_option.id
                            LEFT JOIN customers
                            ON transaction.customer_name_id = customers.id
                            WHERE transaction.service_type != 'Walk In'
                            AND transaction.uuid IN (SELECT uuid FROM delivery_list)
                            AND delivery_list.delivery_status = 2
                            ORDER BY transaction.created_at_time";
                        $result4 = mysqli_query($con, $dropdown_query2);
                        if(mysqli_num_rows($result4) > 0)
                        {
                        foreach($result4 as $rows)
                        {?>
                            <tbody>
                            <tr>
                            <!-- <form action="" method="post" enctype="multipart/form-data" id="addorderFrm"> -->
                                <td data-label="STATUS"> <a href="../monitoring/monitoring-delivery-pickup.php?confirm=<?php echo $rows['id'];?>" type="submit" class="status1">ADD AS DELIVERED</a></td>
                                <!-- <input type="hidden" value="<?php echo $rows['uuid'];?>" name="uuid"> -->
                            <!-- </form> -->
                                <td data-label="ID"> <?php echo $rows['id']; ?></td>
                                <td data-label="Customer Name"> <?php if($rows['customer_name']){
                                    echo $rows['customer_name'];
                                    }else{
                                        echo 'GUEST';
                                    }
                                 ?></td>
                                <td data-label="Order Details"> <a class="viewTransaction" href="../monitoring/monitoring-delivery-pickup.php?view=<?php echo $rows['uuid'];?>">View Details</a></td>
                                <td data-label="Total Amount"> <?php echo '<span>&#8369;</span>'.' '.number_format($rows['total_amount'], '2','.',','); ?></td> 
                                <td data-label="Payment Status">         
                                    <?php
                                         if($rows['status_id'] == 0){
                                            echo '<span class="outofstock">Unpaid</span>';
                                        }else{
                                            echo '<span class="instock">Paid</span>';
                                        }
                                    ?>
                                </td>
                                <td data-label="Delivery Boy"> <?php echo $rows['first_name'] .' '. $rows['last_name'] ; ?></td>
                                <td data-label="Date/Time Added"> <?php echo $rows['updated_at'] ?></td>
                                <td >    <a href="../service/delete-transaction-order.php?delete-list=<?php echo $rows['uuid']; ?>" class="delete-rowsButton" class="action-btn" name="action">
                                            X
                                        </a>
                                </td>
            
                            </tbody>
                            <?php  }}else { ?>
                        <tr id="noRecordTR">
                            <td colspan="8">No Ongoing Deliveries Added</td>
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
                    <h2 class="Title-top">MONITORING</h2>
                    <h4 class="subTitle-top">DELIVERY/PICK UP</h2>
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
        
<?php
if(isset($_GET['confirm']))
{
    $id = $_GET['confirm'];
    $result = mysqli_query($con, "SELECT 
                transaction.id,
                transaction.uuid,
                customers.customer_name
                FROM transaction 
                INNER JOIN delivery_list
                ON transaction.uuid = delivery_list.uuid
                LEFT JOIN customers
                ON transaction.customer_name_id = customers.id
                WHERE transaction.id='$id'");
    if(mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result); ?>

        <form action="" method="post" enctype="multipart/form-data" id="addcustomerFrm">
            <div class="bg-editDropdown" id="edit-bgdrop">
                <div class="container1">
                    <h1 class="addnew-title">DELIVERED CUSTOMER</h1>
                    <form action="#">
                        <input type="hidden" required="required" name="uuid" value="<?=$user['uuid'];?>">
                        <div class="a-header">
                            <label class="archive-header"> Do you want to proceed Customer <?=$user['customer_name'];?> as Delivered ?</label>
                        </div>
                        <div class="bot-buttons">
                            <div class="CancelButton">
                                <a href="../monitoring/monitoring-delivery-pickup.php" id="cancel">CANCEL</a>
                            </div>
                            <div class="AddButton1">
                                <button type="submit" id="addcustomerBtn" name="add-as-delivered">CONFIRM</button>
                            </div>
                        </div>
                </div>
        </form>
    <?php }} ?>

    <?php
if(isset($_GET['view']))
{
    $uuid = $_GET['view'];
    $result = mysqli_query($con, "SELECT
                                customers.customer_name,
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
    if (mysqli_num_rows($result) > 0) {
    $transaction = mysqli_fetch_assoc($result);
    ?>
    <form action="" method="post" enctype="multipart/form-data" id="placeorderFrm">
        <div class="bg-placeorderform" id="bg-placeform">
            <div class="container1">
                <a href="../monitoring/monitoring-delivery-pickup.php" class="close">X</a>
                <h1 class="addnew-title">TRANSACTION DETAILS</h1>
                <form action="#">
                    <div class="main-user-info">
                        <div class="customerName">
                            <label class="customernameLbl">Customer</label>
                            <span class="customer_name"><?php if($transaction['customer_name']){
                                    echo $transaction['customer_name'];
                                    }else{
                                        echo 'GUEST';
                                    }?></span>
                            <div class="datetimeLbl">
                                <span class="createdatLbl"><?= 'DATE :'.' '. $transaction['created_at_date'];?></span>
                                <span class="createdatLbl"><?=  'TIME :'.' '.$transaction['created_at_time'];?></span>
                            </div>
                        </div>

                         
                        <div class="payment-service">
                            <div class="payment-options1">
                                <p class="paymentOptions-text">Payment Option</p>
                                <label class="service-options"><?=$transaction['option_name'];?> </label>
                            </div>
                            <div class="payment-options2">
                                <p class="paymentOptions-text">Service</p>
                                <label class="service-options"><?=$transaction['service_type'];?> </label>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                         <div class="orderSum-Details">
                            <table class="tableCheckout" id="sumTable">
                                <thead>
                                <tr>
                                    <th>ITEM</th>
                                    <th>Water</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>QTY</th>
                                    <th>TOTAL</th>
                                </tr>
                                </thead>
                                    <?php           
                                            $transaction_process = "SELECT
                                                    transaction_process.item_name, 
                                                    transaction_process.water_type,
                                                    transaction_process.category_type,
                                                    transaction_process.quantity,
                                                    transaction_process.price,
                                                    transaction_process.total_price
                                                    FROM transaction_process
                                                    WHERE transaction_id = '$uuid'";
                                            $transaction_order = mysqli_query($con, $transaction_process);
                                            if(mysqli_num_rows($transaction_order) > 0)
                                            {
                                            foreach($transaction_order as $transactions)
                                            {
                                            ?>

                                            <tbody>
                                            <tr>
                                                <td name="itemname_transaction"> <?php echo $transactions['item_name']; ?></td>
                                                <td name="watertype_transaction"> <?php echo $transactions['water_type']; ?></td>
                                                <td name="categorytype_transaction"> <?php echo $transactions['category_type']; ?></td>
                                                <td name="price_transaction"> <?php echo '&#8369'.' '. $transactions['price']; ?></td>
                                                <td class="quantity-td" > 
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
                        <?php $transaction_history = "SELECT
                                                    transaction_history.amount_tendered, 
                                                    transaction_history.customer_change,
                                                    transaction_history.remaining_balance,
                                                    transaction_history.previous_balance,
                                                    transaction_history.unpaid_amount,
                                                    transaction_history.created_at
                                                    FROM transaction_history
                                                    WHERE transaction_uuid = '$uuid'";
                                            $transaction_order_history = mysqli_query($con, $transaction_history);
                                            if(mysqli_num_rows($transaction_order_history) > 0)
                                            {
                                            foreach($transaction_order_history as $transactions_history)
                                            {
                                                ?>
                        <div class="payment-section">
                            <div class="user-input-box-totalamount">
                                <label for="total-amount2">TOTAL AMOUNT</label>
                                <span id="total-amount2" class="total-amount2"><?php echo '&#8369'.' '.number_format($transaction['total_amount'], '2','.',','); ?></span>
                            </div>
                            
                            <div class="user-input-box-cashpayment">
                                <label for="cash-payment2">Cash Payment</label>
                                <span id="cash-payment2" class="remaining-amount2"><?php echo '&#8369'.' '.number_format($transactions_history['amount_tendered'], '2','.',','); ?></span>
                            </div>

                            <div class="user-input-box-cashpayment">
                                <label for="cash-payment2">Change</label>
                                <span id="cash-change"class="remaining-amount2"><?php echo '&#8369'.' '.number_format($transactions_history['customer_change'], '2','.',','); ?></span>
                            </div>
                        </div>
                        <?php }} ?>

                    </div>
                </form>
            </div>
        </div>
    </form> 
    <?php }?>
    </body>
</html>

<script src="https://code.jquery.com/jquery.min.js"></script>
<script src="../javascript/monitoring-delivery-pickup.js"></script>

