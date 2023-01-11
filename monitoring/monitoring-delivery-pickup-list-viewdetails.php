<?php
require_once '../database/connection-db.php';
require_once "../service/user-access.php";
require_once "../service/pos-placeorder.php";

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
        <title>Tag's Water Purified Drinking Water</title>
        <link rel="stylesheet" type="text/css" href="../CSS/monitoring-pos-transaction-viewdetails.css">
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
                <a href="../monitoring/monitoring-delivery-pickup-list.php" class="close">X</a>
                <h1 class="addnew-title">TRANSACTION DETAILS</h1>
                <?php
                    if (isset($_GET['message'])) {
                        echo '<p class="transaction_success"> '.$_GET['message'].' </p>';
                    }
                ?>
                <form action="#">
                    <div class="main-user-info">
                        <div class="customerName">
                            <label class="customernameLbl">Customer</label>
                            <span class="customer_name"><?php if($transaction['customer_name']){
                                    echo $transaction['customer_name'];
                                    }else{
                                        echo 'GUEST';
                                    }?></span>
                        </div>
                        <div class="datetimeLbl">
                            <label class="createdatLbl"><?= 'DATE :'.' '. $transaction['created_at_date'];?></label>
                            <label class="createdatLbl"><?=  'TIME :'.' '.$transaction['created_at_time'];?></label>
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
                                    <th scope="col">ITEM</th>
                                    <th scope="col">Water</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">QTY</th>
                                    <th scope="col">TOTAL</th>
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
                                                <td data-label="ITEM" name="itemname_transaction"> <?php echo $transactions['item_name']; ?></td>
                                                <td data-label="Water" name="watertype_transaction"> <?php echo $transactions['water_type']; ?></td>
                                                <td data-label="Type" name="categorytype_transaction"> <?php echo $transactions['category_type']; ?></td>
                                                <td data-label="Price" name="price_transaction"> <?php echo '&#8369'.' '. $transactions['price']; ?></td>
                                                <td data-label="QTY" class="quantity-td" > 
                                                    <?php echo $transactions['quantity'];?>
                                                </td>
                                                <td data-label="TOTAL"> <?php echo '&#8369'.' '. number_format($transactions['total_price'], '2','.',','); ?></td>
                                            </tr>
                                            <?php } ?>
                                            <?php } else { ?>
                                                <tr id="noRecordTR">
                                                    <td colspan="6">No Order(s) Added</td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        
                                      

                                            <tfoot>
                                           
                                            </tfoot>
                                            
                                </table>
                        </div>
                        <div class="totalamount-Details">
                            <table class="tableCheckout" id="sumTable">
                                <thead>
                                <tr>
                                    <th scope="col">Amount Tendered</th>
                                    <th scope="col">Change</th>
                                    <th scope="col">Previous Balance</th>
                                    <th scope="col">Remaining Balance</th>
                                    <th scope="col">Unpaid Amount</th>
                                    <th scope="col">Date Created</th>
                                </tr>
                                </thead>
                                    <?php           
                                            $transaction_history = "SELECT
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

                                            <tbody>
                                            <tr>
                                                <td data-label="Amount Tendered"> <?php echo '&#8369'.' '.$transactions_history['amount_tendered']; ?></td>
                                                <td data-label="Change"> <?php echo '&#8369'.' '.$transactions_history['customer_change']; ?></td>
                                                <td data-label="Previous Balance"> <?php echo '&#8369'.' '.$transactions_history['previous_balance']; ?></td>
                                                <td data-label="Remaining Balance"> <?php echo '&#8369'.' '.$transactions_history['remaining_balance']; ?></td>
                                                <td data-label="Unpaid Amount"> <?php echo '&#8369'.' '. $transactions_history['unpaid_amount']; ?></td>
                                                <td data-label="Date Created"> <?php echo $transactions_history['created_at']; ?></td>
                                            </tr>
                                            <?php } ?>
                                            <?php } else { ?>
                                                <tr id="noRecordTR">
                                                    <td colspan="5">No Order(s) Added</td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        
                                      

                                            <tfoot>
                                           
                                            </tfoot>
                                            
                                </table>
                        </div>
                        <div class="payment-section">
                            <div class="user-input-box-totalamount">
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
                                        $total_paid_amount = $transaction['total_amount'] - $unpaid_amount;
                                ?>
                                <label class="remaining-amountLbl">Remaining Unpaid Amount</label>
                                <span id="remaining-amount2" class="remaining-amount2"><?php echo '&#8369'.' '.number_format($unpaid_amount, '2','.',','); ?></span>
                            </div>
                            <div class="user-input-box-totalamount">
                         
                                <label for="total-amount2">TOTAL PAID AMOUNT</label>
                                <span id="total-amount2" class="total-amount2"><?php echo '&#8369'.' '.number_format($total_paid_amount, '2','.',','); ?></span>
                            </div>
                            
                        </div>
                        <?php } ?>
                        
                        <div class="line"></div>

                        <div class="bot-buttons">
                            <div class="AddButton1">
                                <a href="../pos/point-of-sales-receipt.php?uuid=<?php echo $uuid?>" id="addcustomerBtn">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M15 6H5V3h10Zm-.25 4.5q.312 0 .531-.219.219-.219.219-.531 0-.312-.219-.531Q15.062 9 14.75 9q-.312 0-.531.219Q14 9.438 14 9.75q0 .312.219.531.219.219.531.219Zm-1.25 5v-3h-7v3ZM15 17H5v-3H2V9q0-.833.583-1.417Q3.167 7 4 7h12q.833 0 1.417.583Q18 8.167 18 9v5h-3Z"/></svg>
                                    PRINT
                                </a>
                            </div>
                            <input type="hidden" name="uuid" value="<?php echo $uuid?>">
                            <div class="AddButton2">
                                <button type="submit" id="addcustomerBtn" name="monitoring-pos-unpaid">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M2.5 16q-.625 0-1.062-.438Q1 15.125 1 14.5V6h1.5v8.5h14V16Zm3-3q-.625 0-1.062-.438Q4 12.125 4 11.5v-6q0-.604.438-1.052Q4.875 4 5.5 4h12q.604 0 1.052.448Q19 4.896 19 5.5v6q0 .625-.448 1.062Q18.104 13 17.5 13ZM7 11.5q0-.604-.448-1.052Q6.104 10 5.5 10v1.5Zm9 0h1.5V10q-.625 0-1.062.448Q16 10.896 16 11.5Zm-4.5-.5q1.042 0 1.771-.719Q14 9.562 14 8.5q0-1.042-.729-1.771Q12.542 6 11.5 6q-1.062 0-1.781.729Q9 7.458 9 8.5q0 1.062.719 1.781.719.719 1.781.719Zm-6-4q.604 0 1.052-.438Q7 6.125 7 5.5H5.5Zm12 0V5.5H16q0 .625.438 1.062Q16.875 7 17.5 7Z"/></svg>
                                PAYMENT
                                </button>
                            </div>
                        </div>
                        

                    </div>
                </form>
            </div>
        </div>
    </form> 
    <?php }else{
           echo '<script> location.replace("../monitoring/monitoring-point-of-sales-transaction.php"); </script>';
    } ?>
    </body>
</html>
