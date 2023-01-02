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
                <p class="address">17 M. Santos St., Brgy. San Jose, Antipolo City<p>
                <p class="lineast">*******************************************<p>

                <p class="contact1">Tel No.: 8-630-2271 / 8-806-0990 / 8-697-4627<p>
                <p class="contact">Cel No.: 0917-149-8014 / 0918-947-3532<p>
                <p class="customer-name">Customer: <?= $transaction['customer_name'];?><p>
                <p class="service">Service: <?= $transaction['service_type'];?><p>
                <p class="payment-method">Payment Option: <?= $transaction['option_name'];?><p>
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
                                "<p class='font'>".$transactions['quantity'].' '.'X '.' &#8369'.' '. $transactions['price']."</p>";
                                ?>
                            </td>
                            
                            <td> <?php 
                            echo "<p class='total'>".'P'.number_format($transactions['total_price'], '2','.',',')."</p>"; 
                            ?></td>
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
                        <p class="totalAmt"><?php echo 'P'.number_format($transaction['total_amount'], '2','.',','); ?></p>
                        <p class="totalLabel1">Remaining Unpaid Amount </p>
                        <p class="totalAmt1"><?php echo 'P'.number_format($unpaid_amount, '2','.',','); ?></p>
                        <p class="lineast">*******************************************<p>
                        <h4 class="addnew-title2">TRANSACTION HISTORY</h4>
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
                        
                        <p class="datetime">DATE/TIME:<?= $transactions_history['created_at'];?><p>
                        <br >
                        <p class="change1Lbl">Change</p>
                        <p class="change1"><?php echo 'P'.number_format($transactions_history['customer_change'], '2','.',','); ?></p>
                        <br >
                        <p class="change2Lbl">Amount Tendered</p>
                        <p class="change2"><?php echo 'P'.number_format($transactions_history['amount_tendered'], '2','.',','); ?></p>
                        <br >
                        <?php if($transactions_history['remaining_balance'] != $transactions_history['previous_balance']){ ?>
                        <p class="change2Lbl">Customer Remaining Balance</p>
                        <p class="change2"><?php echo 'P'.number_format($transactions_history['remaining_balance'], '2','.',','); ?></p>
                        <?php }}} ?>
                        <p class="lineast">*******************************************<p>
                        <p class="service">Order ID: <?php echo $uuid; ?> <p>
                        <p class="payment-method">Cashier:<?= $transaction['first_name'].' '.$transaction['last_name'];?><p>
                        <p class="service">DATE/TIME:<?= $transaction['created_at_date'].' '.$transaction['created_at_time'];?><p>
                        <h4 class="addnew-title2">--THIS IS YOUR OFFICIAL RECEIPT--</h4>

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
<style>
    @media print {
    .container1{
        background-color: white;
        height: 100%;
        width: 100%;
        position: fixed;
    }
    .bot-buttons{
        display: none;
    }
}
    :root{
    --color-main: rgb(2, 80, 2);
    --color-white: white;
    --color-total-amount: #FFCFCF;
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
    --color-total-amount: #B22222;
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
.transaction_success{
    background-color: var(--color-background);
    color: var(--color-main);
    padding-top: 12px;
    position: relative;
    padding-bottom: 15px;
    width: 100%;
    border-radius: 6px;
    margin-top: 1rem;
    align-items: center;
    text-align: center;
    justify: center;
    font-size: 1rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    border-bottom: 5px solid var(--color-main);
    font-family: 'calibri', sans-serif;
}
.payment-section{
    width: 100%;
    align-items: center;
    padding: 20px;
    margin-top: 1rem;
    justify-content: center;
    background-color: var(--color-secondary-main);
    border-top: 5px solid var(--color-main);
    border-radius: 0 0 10px 10px;
}
.user-input-box-totalamount label{
    color: var(--color-black);
    text-align: right;
    font-size: 25px;
    /* margin-left: .2rem; */
    font-family: 'century gothic', sans-serif;
    font-weight: 750;
    /* margin: 5px 0; */
}
.user-input-box-totalamount .remaining-amountLbl{
    font-family: 'arial', sans-serif;
    font-weight: 500;
    color: var(--color-solid-gray);
    font-size: 15px;
}
.remaining-amount2{
    color: var(--color-solid-gray);
    font-family: 'calibri', sans-serif;
    font-size: 15px;
    font-weight: 700;
    float: right;
}
.total-amount2{
    color: var(--color-black);
    font-family: 'calibri', sans-serif;
    font-size: 25px;
    float: right;
}
.user-input-box-totalamount{
    margin-bottom: 1rem;
    /* display: inline-block; */

}
.user-input-box-cashpayment{
    display: inline-block;
    margin-top: 1rem;
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

.user-input-box-cashpayment .cash-payment2{
    display: inline-block;
    text-align: right;
    height: 2.5rem;
    outline: none;
    margin-right: 1rem;
    margin-left: 1rem;
    font-size: .8em;
    color: var(--color-black);
}
.user-input-box-cashpayment .cash-change{
    display: inline-block;
    text-align: right;
    height: 2.5rem;
    margin-left: 1rem;
    outline: none;
    font-size: .8em;
    color: var(--color-black);

}
.createdatLbl{
    font-size: .9rem;
    /* width: 100%; */
    display: inline-block;
    margin-top: 1rem;
    border-top: 1px solid var(--color-main);
    border-bottom: 1px solid var(--color-main);
    text-align: center;
    margin-left: 2rem;
    color: var(--color-main);
    font-weight: 600;
}
.datetimeLbl{
        text-align: center;

    }
.customernameLbl{
    margin-left: 1rem;
    font-size: .9rem;
    margin-top: 1rem;
    color: var(--color-solid-gray);
    font-weight: 600;
}
.paymentoptionLbl{
    margin-left: 1rem;
    font-size: .9rem;
    width: 100%;
    margin-top: 2rem;
    color: var(--color-solid-gray);
    font-weight: 600;
}

.customer_name{
    color: var(--color-main);
    text-transform: uppercase;
    margin-left: 1.5rem;
    font-family: 'Cocogoose', sans-serif;
    font-size: 1rem;
}
.deliveryamount_fee{
    border: none;
    background-color: var(--color-background);
    height: 1.5rem;
    text-align: right;
    margin-right: 2rem;  
    font-family: 'century-gothic', sans-serif;
    font-size: .9rem;
    width: 6rem;
    color: var(--color-solid-gray);
    margin-left: 1rem;
    border-radius: 5px;
}
.viewTransaction{
    font-family: 'century-gothic', sans-serif;
    font-size: .7rem;
    color: var(--color-main);
    text-transform: uppercase;
    border-bottom: 1px solid var(--color-main);
    cursor: pointer;
}
.viewTransaction:hover{
    color: var(--color-maroon);
    border-bottom: 1px solid var(--color-maroon);
}
.deliveryfee{
    text-align: left;
    height: 1rem;
    margin-left: 2rem;
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
.deliveryfee_amount{
    width: 5rem;
    position: relative; 
  
    display: inline-block;
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
    background-color: var(--color-maroon);
    color: var(--color-white);
    width: 4rem;
    height: 1.5rem;
    text-align: center;
    padding:2rem;
    border-radius: 1rem;
    align-items:center;
    cursor: pointer;
}

.close:hover{
    filter: brightness(1.5);
    transition: 0.5s;
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
.bg-placeorderform{
    height: 100%;
    width: 100%;
    background: rgba(0,0,0,0.7);
    top: 0;
    position: fixed;
    display: flex;
    align-items: center;
    justify-content: center;
    /* display: flex; */
}
.container1{
    width: 100%;
    max-width: 189px;
    padding: 28px;
    overflow: auto;
    margin: 0 28px;
    background-color: var(--color-white);
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
            margin-bottom: 1rem;
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


.bot-buttons{
    align-items: center;
    text-align: center;
}
.AddButton1 button{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    width: 10rem;
    height: 10rem;
    outline: none;
    justify-content: center;
    align-items: center;
    border: none;
    gap: .5rem;
    border-radius: 10px;
    font-size: 1.2rem;
    color: white;
    background:  var(--color-mainbutton);
    cursor: pointer;
    transition: 0.5s;
    /* margin-left: 1rem; */
    display: flex;
    fill: white;
    background: var(--color-solid-gray);
}
.AddButton1 button:hover{
    background: var(--color-secondary-main);
    box-shadow: 1px 3px 3px 0px var(--color-shadow-shadow);
    fill: var(--color-main);
    color: var(--color-main);
}
.AddButton2 button{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    width: 13rem;
    font-size: .7rem;
    justify-content: center;
    border: none;
    gap: .5rem;
    border-radius: 10px;
    color: white;
    background:  var(--color-mainbutton);
    cursor: pointer;
    transition: 0.5s;
    /* margin-left: 1rem; */
    display: flex;
    fill: white;
    background: var(--color-main);
}
.AddButton2 button:hover{
    background: var(--color-secondary-main);
    box-shadow: 1px 3px 3px 0px var(--color-shadow-shadow);
    color: var(--color-main);
    fill: var(--color-main);
}
.CancelButton{
    display: inline-block;
}
.CancelButton-add{
    display: inline-block;
}
.AddButton1{
        display: inline-block;
}
.AddButton2{
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
    .AddButton1 button:hover{
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
    .AddButton1{
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
    height: 100%;
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
    /* margin-bottom: .5rem; */
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
    font-family: 'Switzer', sans-serif;
    width: 100%;
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
    height: 1.8rem;
    border-bottom: 1px solid var(--color-main);
    color: var(--color-main);
    font-size: .67rem;
}
th{
    height: 1.8rem;
    color: var(--color-black);
    /* margin:1rem; */
    font-size: .7rem;
    letter-spacing: 0.02rem;
    border-bottom: 2px solid var(--color-solid-gray);
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
.payment-service{
    width: 100%;
    text-align: center;
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
    width: 15rem;
    padding: 10px;
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

.delivery-options{
    display: inline-block;
    position: relative;
    margin-left:1rem;

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
    float: left;
    margin-left: 1rem;
    margin-top: 1rem;
}
.ordersum-text{
    display: inline-block;
}
.cashiersum-text{
    display: inline-block;
    float: right;
    /* position: absolute; */
    /* right: 5%;   */
    padding-top: .5rem;
    margin-right: 2rem;
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
    background: none;
    margin-bottom: -1rem;
}
.name-cashier:focus{
    outline: none;
}
.orderSum-Details{
    background-color: var(--color-white);
    padding: 1rem;
    width:100%;
    overflow:auto;
    /* display: inline-block; */
    box-shadow: 2px 2px 2px 1px var(--color-tertiary);
    /* margin-left: 1.1rem; */
    max-height: 8rem;
    height: 8rem;
    margin-top: 1rem;
    /* text-align: right; */
    /* display: flex; */
    border-top: 2px solid var(--color-solid-gray);
    position: relative;
    border-radius: 10px;
}
.orderSum-Details .tableCheckout td{
    color: var(--color-solid-gray);

}
.totalamount-Details{
    background-color: var(--color-background);
    padding-top: 1.5rem;
    width:100%;
    overflow:auto;
    max-height: 7rem;
    height: 7rem;
    margin-top: 1rem;
    border-radius: 5px;
    border-left: 1px solid var(--color-main);
    border-right: 1px solid var(--color-main);
    position: relative;
}
.orderSum-table{
    background-color: var(--color-white);
    padding: 1rem;
    overflow:auto;
    max-height: 12rem;
    height: 12rem;
    border-top: 2px solid var(--color-solid-gray);
    position: relative;
    border-radius: 10px;
}

.tableCheckout table{
    background: var(--color-white);
    font-family: 'Switzer', sans-serif;
    width: 100%;
    font-size: 0.7rem;
    border-radius: 0px 0px 10px 10px;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    /* padding-bottom: 2.5rem; */
    text-align: center;
    transition: all 700ms ease;
    overflow: auto;
    margin-top: -1rem;
}

.tableCheckout th{
    height: 1.8rem;
    color: var(--color-solid-gray);
    /* margin:1rem; */
    font-size: .75rem;
    border: none;
    text-transform: uppercase;
    /* border-bottom: 2px solid var(--color-solid-gray); */
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
    /* margin-top: -39rem; */
    width: 100%;
    /* height: 100%; */
    /* display: inline-block;
    position: relative; */
}
.previous-transaction{
    background-color: var(--color-white);
    padding-left: 2rem;
    padding-right: 2rem;
    width: 95%;
    /* max-height: 30%; */
    /* margin-bottom: 2rem; */
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
.customerName{
    align-items:center;
    width: 100%;
    margin-top: -1rem;
    margin-left: 1rem;
    margin-right: 1rem;
}
/* ------------------------------------------------receipt--------------------------------------- */
.titlelogo{
    text-align: center;
    gap: 0.8rem;
}
.titlelogo img{
    width: 3.5rem;
    margin-bottom: 1rem;
    margin-top: 2rem;
}
.address{
    font-size: 11px;
    font-family: 'Malberg Trial', sans-serif;
    color: black;
    margin-top: -.5rem;
    margin-bottom: -.7rem;
    text-align: center;
}
.lineast{
    font-size: 11px;
    font-family: 'Malberg Trial', sans-serif;
    color: black;
    margin-top: -.7rem;
    margin-bottom: -.7rem;
    text-align: center;
}
.contact1{
    font-size: 9px;
    font-weight: 500;
    font-family: 'Malberg Trial', sans-serif;
    margin-top: -.2rem;
    color: black;
    text-align: center;
}
.contact{
    font-size: 9px;
    font-weight: 500;
    font-family: 'Malberg Trial', sans-serif;
    color: black;
    margin-top: -.9rem;
    text-align: center;
}
.service{
    font-size: 9px;
    margin-top: -.95rem;
    font-weight: 500;
    text-transform: uppercase;
    font-family: 'Malberg Trial', sans-serif;
    color: black;
    text-align: left;
}
.payment-method{
    font-size: 9px;
    margin-top: -.95rem;

    font-weight: 500;
    font-family: 'Malberg Trial', sans-serif;
    color: black;
    text-align: left;
}
.customer-name{
    font-size: 9px;
    font-weight: 500;
    font-family: 'Malberg Trial', sans-serif;
    color: black;
    text-align: left;
}
.total{
    font-size: 8px;
    color: black;
    font-weight: 500;
    margin-top: -1.5rem;
    float: right;
    font-family: 'Malberg Trial', sans-serif;
}
.font{
    font-size: 8px;
    color: black;
    margin-top: -.5rem;
    font-weight: 500;
    font-family: 'Malberg Trial', sans-serif;
}

.itemwater{
    font-size: 8px;
    font-weight: 500;
    font-family: 'Malberg Trial', sans-serif;
    color: black;

}
.totalAmt1{
    font-size: 9px;
    font-weight: 800;
    float: right;
    font-family: 'Malberg Trial', sans-serif;
}
.totalLabel1{
    font-size: 9px;
    font-weight: 800;
    float: left;
    font-family: 'Malberg Trial', sans-serif;
}
.totalAmt{
    font-size: 9px;
    font-weight: 800;
    margin-top: -.5rem;
    float: right;
    font-family: 'Malberg Trial', sans-serif;
}
.totalLabel{
    font-size: 9px;
    font-weight: 800;
    margin-top: -.5rem;
    float: left;
    font-family: 'Malberg Trial', sans-serif;
}
.change1Lbl{
    font-family: 'Malberg Trial', sans-serif;
    font-size: 9px;
    margin-top: -2rem;

    float: left;
}
.change1{
    font-family: 'Malberg Trial', sans-serif;
    margin-top: -2rem;


    float: right;
    font-size: 9px;
}
.change2Lbl{
    font-family: 'Malberg Trial', sans-serif;
    font-size: 9px;
    float: left;
    margin-top: -.7rem;
}
.datetime{
    font-family: 'Malberg Trial', sans-serif;
    font-size: 9px;
    float: left;
    margin-top: -1rem;

}
.change2{
    font-family: 'Malberg Trial', sans-serif;
    margin-top: -.7rem;

    float: right;
    font-size: 9px;
}
.addnew-title{
    font-size: 12px;
    color: black;
    font-family: 'Malberg Trial', sans-serif;
    /* letter-spacing: .09rem; */
    display: flex;
    margin-top: -.5rem;
    justify-content: center;
    /* border-bottom: 1px solid var(--color-solid-gray); */
    width: 100%;
    padding-bottom: 2px;
}
.addnew-title2{
    font-size: 10px;
    color: black;
    font-family: 'Malberg Trial', sans-serif;
    /* letter-spacing: .09rem; */
    margin-top: -.5rem;
    text-align: center;
    /* border-bottom: 1px solid var(--color-solid-gray); */
    width: 100%;
    padding-bottom: 2px;
}
</style>
