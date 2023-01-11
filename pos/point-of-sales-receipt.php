<?php
include '../database/connection-db.php';
require_once '../service/pos-placeorder.php';

date_default_timezone_set("Asia/Manila");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="../CSS/point-of-sales-receipt.css">
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
<style>
        .container1{
    width: 100%;
    max-width: 120px;
    padding: 8px;
    overflow: auto;
    margin: 0 28px;
    background-color: var(--color-white);
}

.contact{
    font-size: 7px;
    font-weight: 500;
    font-family: 'Malberg Trial', sans-serif;
    color: black;
    margin-top: -.9rem;
    text-align: left;
}
.addnew-title{
    font-size: 9px;
    color: black;
    font-family: 'Malberg Trial', sans-serif;
    /* letter-spacing: .09rem; */
    display: flex;
    margin-top: -.5rem;
    justify-content: left;
    /* border-bottom: 1px solid var(--color-solid-gray); */
    width: 100%;
    padding-bottom: 6px;
}
.titlelogo{
    text-align: left;
}
.titlelogo img{
    width: 2.5rem;
    margin-bottom: 1rem;
    margin-top: 2rem;
}
.address{
    font-size: 8px;
    font-family: 'Malberg Trial', sans-serif;
    color: black;
    margin-top: -1rem;
    margin-bottom: -1rem;
    text-align: left;
}
</style>
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
    </main>


    <?php
if(isset($_GET['uuid']))
{
    $uuid = $_GET['uuid'];
    $result = mysqli_query($con, "SELECT
                                IF(customers.customer_name IS NULL or customers.customer_name = '', 'GUEST', customers.customer_name) as customer_name,
                                transaction.total_amount,
                                payment_option.option_name,
                                transaction.service_type,
                                transaction.created_at_date,
                                transaction.created_at_time,
                                users.first_name,
                                users.last_name
                                FROM transaction 
                                INNER JOIN users  
                                ON transaction.created_by_id = users.user_id 
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
                <a href="../pos/point-of-sales.php" class="close">CANCEL</a>
            <div class="container1">
                <div class="titlelogo">
                    <img class="tagslogo" src="../Pictures and Icons/tags logo.png" >
                </div>
                <!-- <a href="../pos/point-of-sales.php" class="close">X</a> -->
                <h1 class="addnew-title">TAG'S WATER</h1>
                <h1 class="addnew-title">PURIFIED DRINKING WATER</h1>
                <br >
                <p class="address">17 M. Santos St., <p>
                <p class="address">Brgy. San Jose, <p>
                <p class="address"> Antipolo City<p>
                <p class="lineast">*******************************************<p>

                <p class="contact">Tel No.:<p>
                <p class="contact">8-630-2271 / 8-806-0990 / 8-697-4627<p>
                <p class="contact"><p>
                <p class="contact"><p>
                <p class="lineast">*******************************************<p>
                <p class="contact">Cel No.:<p>
                <p class="contact">0917-149-8014 / <p>
                <p class="contact">0918-947-3532<p>
                <p class="customer-name">Customer: <?= $transaction['customer_name'];?><p>
                <p class="service">Service: <?= $transaction['service_type'];?><p>
                <p class="payment-method">Payment Option: <p>
                <p class="payment-method"><?= $transaction['option_name'];?><p>
                <p class="lineast">*******************************************<p>
                <?php           
                    $transaction_process = "SELECT
                    transaction_process.transaction_id,
                    transaction_process.item_name, 
                    transaction_process.water_type,
                    transaction_process.category_type,
                    transaction_process.quantity,
                    transaction_process.price,
                    transaction_process.total_price
                    FROM transaction_process
                    WHERE transaction_process.transaction_id = '$uuid'";
                    $transaction_order = mysqli_query($con, $transaction_process);
                    if(mysqli_num_rows($transaction_order) > 0)
                    {
                    foreach($transaction_order as $transactions)
                    {
                ?>

                    <tbody>
                        <tr>
                            <td name="itemname_transaction"> 
                                <?php echo "<p class='itemwater'>".$transactions['item_name'].'-'.$transactions['water_type']."</p>"; ?>
                            </td>
                        
                            <td class="quantity-td" > 
                                <?php echo
                                "<p class='font'>".$transactions['quantity'].' '.'X '.' &#8369'.' '. $transactions['price']."</p>"."<p class='font'>".'=P'.number_format($transactions['total_price'], '2','.',',')."</p>";
                                ?>
                   
                            </td>
                            
                            </tr>
                    </tbody>
                        <?php
                        }}
                    }}
                    ?>
                    
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
                                <input type="hidden" name="user_id" value="<?php echo $user_id?>">
                        <input type="hidden" id="totalamount_value"  value="<?php echo $transactions1['sum(transaction_process.total_price)']; ?>">
                        <input type="hidden" class="deliveryoption_class" name="option" value="Walk In">
                        <p class="totalLabel">TOTAL</p>
                        <br >
                        <p class="totalLabel">--<?php echo 'P'.number_format($transaction['total_amount'], '2','.',','); ?></p>
                        <br >
                        <p class="totalLabel">Remaining Balance</p>
                        <br >
                        <p class="totalLabel"><?php echo ' --P'.number_format($unpaid_amount, '2','.',','); ?> </p>
                        <br >
                        <p class="lineast">*******************************************<p>
                        <h4 class="totalLabel">TRANSACTION HISTORY</h4>
                        <br >
                        <br >
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
                        
                        <p class="payment-method">DATE/TIME:<p>
                        <p class="payment-method"><?= '--'.$transactions_history['created_at'];?><p>
                        <br >
                        <p class="change1Lbl">CHANGE</p>
                        <p class="payment-method"><?php echo '--P'.number_format($transactions_history['customer_change'], '2','.',','); ?></p>
                        <br >
                        <br >
                        <p class="change1Lbl">AMOUNT TENDERED</p>
                        <p class="payment-method"><?php echo '--P'.number_format($transactions_history['amount_tendered'], '2','.',','); ?></p>
                        <br >
                        <?php if($transactions_history['remaining_balance'] != $transactions_history['previous_balance']){ ?>
                        <p class="change2Lbl">Customer Remaining Balance</p>
                        <p class="change2"><?php echo 'P'.number_format($transactions_history['remaining_balance'], '2','.',','); ?></p>
                        <?php }}} ?>
                        <p class="lineast">*******************************************<p>
                        <p class="service">Order ID:  <p>
                        <p class="service"><?php echo $uuid; ?> <p>
                        <p class="payment-method">Cashier:<?= $transaction['first_name'].' '.$transaction['last_name'];?><p>
                        <p class="service">DATE/TIME:<p>
                        <p class="service"><?= $transaction['created_at_date'].' '.$transaction['created_at_time'];?><p>
                        <h4 class="totalLabel">--THIS IS YOUR OFFICIAL</h4>
                        <br >
                        <h4 class="totalLabel"> RECEIPT--</h4>

            </div>
            <?php }?>
            <!-- <p class="totalLabel1">Amount Tendered</p>
                        <p class="totalAmt1"><?php echo 'P'.number_format($transactions1['sum(transaction_process.total_price)'], '2','.',','); ?></p> -->
            <div class="bot-buttons">
                <div class="AddButton1">
                    <button type="submit" id="addcustomerBtn" name="print-pos" onclick="print();">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M15 6H5V3h10Zm-.25 4.5q.312 0 .531-.219.219-.219.219-.531 0-.312-.219-.531Q15.062 9 14.75 9q-.312 0-.531.219Q14 9.438 14 9.75q0 .312.219.531.219.219.531.219Zm-1.25 5v-3h-7v3ZM15 17H5v-3H2V9q0-.833.583-1.417Q3.167 7 4 7h12q.833 0 1.417.583Q18 8.167 18 9v5h-3Z"/></svg>
                        PRINT
                    </button>
                </div>
            </div>
        </div>
       
    </form> 

    <!-- </form> -->
</body>
<script src="../javascript/side-menu-toggle.js"></script>
<!-- <script src="../javascript/top-menu-toggle.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script src="https://code.jquery.com/jquery.min.js"></script>
<!-- <script src="../javascript/point-of-sales.js"></script> -->

</html>
