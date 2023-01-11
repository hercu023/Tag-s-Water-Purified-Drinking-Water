<?php
include '../database/connection-db.php';
require_once '../service/pos-add-transaction.php';

date_default_timezone_set("Asia/Manila");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="../CSS/point-of-sales-placeorder.css">
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
</div>
            <!-- ---------------------------------------------------- ORDER DETAILS ------------------------------------------------- -->
         
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
</div>
<?php
    if(isset($_GET['option'])
    || isset($_GET['totalAmount'])){
        ?>
    <form action="" method="post" enctype="multipart/form-data" id="placeorderFrm">
        <div class="bg-placeorderform" id="bg-placeform">
            <input type="hidden" name="option" value="<?php echo $_GET['option'];?>">
            <input type="hidden" name="totalAmount" value="<?php echo $_GET['totalAmount'];?>">
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
                            <div class="usertype-dropdown">
                                <?php
                                $dropdown_customers = "SELECT * FROM customers";
                                $result_customers = mysqli_query($con, $dropdown_customers);
                                ?>
                                <select id="chosen" class="select-customer" name="customername" required="" onchange="customerBal();">
                                    <option selected value="GUEST">GUEST</option>
                                    <?php while($customers = mysqli_fetch_array($result_customers)){?>
                                        <option value="<?php echo $customers['id']?>">
                                            <?php echo $customers['customer_name'];?>                                        
                                        </option>
                                    <?php }?>
                                    <!-- <option class="guest-option"value="Guest">GUEST</option> -->
                                </select>
                                <?php
                                $dropdown_customers1 = "SELECT * FROM customers";
                                $result_customers1 = mysqli_query($con, $dropdown_customers1);
                                ?>
                                <?php while($customers1 = mysqli_fetch_array($result_customers1)){?>
                                    <?php $customers_balance_id = 'customerbalance' . $customers1['id'];?>        
                                    <input type="hidden"  id="<?php echo $customers_balance_id ?>" value="<?php echo $customers1['balance'];?>">
                                <?php }?>
                            </div>
                        </div>
                            <a href="../pos/point-of-sales-addcustomer.php" id="addcustomer" class="addcustomer">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 15v-4.25H5v-1.5h4.25V5h1.5v4.25H15v1.5h-4.25V15Z"/></svg>
                                ADD NEW CUSTOMER
                            </a>
                            <div class="payment-options">
                                <?php
                                    $dropdown_query1 = "SELECT * FROM payment_option";
                                    $result3 = mysqli_query($con, $dropdown_query1);
                                ?>
                                <p class="paymentOptions-text">Payment Option</p>
                                <select class="paymentOptions-dropdown" name="paymentoption" required="" >
                                    <?php while($row3 = mysqli_fetch_array($result3)):;?>
                                        <option value="<?php echo $row3['id']?>"><?php echo $row3['option_name'];?></option>
                                    <?php endwhile;?>
                                </select>
                            </div>
                            <div class="payment-options">
                                <input name="serviceoption" readonly class="service-options"value="<?php echo $_GET['option']?>">
                            </div>
                        <div class="payment-section">
                            <div class="user-input-box-totalamount">
                                <label for="total-amount2">TOTAL AMOUNT</label>
                                <input type="text" id="total-amount2" class="total-amount2" onkeypress="return isNumberKey(event)"name="totalamount" value="<?php echo '&#8369'.' '.$_GET['totalAmount']; ?>"readonly/>
                            </div>
                            
                            <div class="user-input-box-cashpayment">
                                <label for="cash-payment2">Cash Payment</label>
                                <input type="text" id="cash-payment2"class="cash-payment2" required onkeypress="return isNumberKey(event)" name="cashpayment" placeholder="0.00" onkeyup="cashChange();"/>
                            </div>
                            <?php 
                            $user_id =  $_SESSION['user_user_id'];
                            $transaction_order1 = mysqli_query($con, "SELECT
                                                    sum(transaction_process.total_price)
                                                    FROM transaction_process
                                                    WHERE user_id = '$user_id' 
                                                    AND transaction_id = '0'"); 
                                                    while ($transactions1 = mysqli_fetch_array($transaction_order1)) {?>
                            
                            <div class="user-input-box-cashpayment">
                                <!-- <label for="cash-payment2">Change</label>
                                <input type="text" id="cash-change"class="cash-change" readonly onkeypress="return isNumberKey(event)"name="cashchange" value="0.00"/> -->
                            </div>
                            <div class="user-input-box-cashpayment">
                                <label for="cash-payment2">Available Balance</label>
                                <input type="hidden" id="totalamount_value"  value="<?php echo $transactions1['sum(transaction_process.total_price)']; ?>">
                                <input type="text" id="cash-balance"class="cash-balance" readonly onkeypress="return isNumberKey(event)"name="cashbalance" value="0.00"/>
                            </div>
                        </div>
                        <?php }?>
                        
                        
                        <div class="line"></div>

                        <div class="user-input-box-note" id="note-box">
                            <label for="note">Note</label>
                            <input type="text"
                                id="note" class="note" name="note" placeholder="Enter a Note"/>
                        </div>
                        <div class="line"></div>

                        <div class="bot-buttons">
                            <div class="CancelButton">
                                <a href="../pos/point-of-sales.php" id="cancel">CANCEL</a>
                            </div>
                            <div class="AddButton">
                                <button type="submit" id="addcustomerBtn" name="save-transaction">PAY ONLY</button>
                            </div>
                            <div class="AddPrintButton">
                                <button type="submit" id="addcustomerBtn" name="save-transaction" onclick="print();">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M15 6H5V3h10Zm-.25 4.5q.312 0 .531-.219.219-.219.219-.531 0-.312-.219-.531Q15.062 9 14.75 9q-.312 0-.531.219Q14 9.438 14 9.75q0 .312.219.531.219.219.531.219Zm-1.25 5v-3h-7v3ZM15 17H5v-3H2V9q0-.833.583-1.417Q3.167 7 4 7h12q.833 0 1.417.583Q18 8.167 18 9v5h-3Z"/></svg>
                                    PAY AND PRINT
                                </button>
                            </div>
                        </div>
                        <?php }else{
           echo '<script> location.replace("../pos/point-of-sales.php"); </script>';
    } ?>
                    </div>
                </form>
            </div>
        </div>
    </form>

 
                <form action="#">
                                     
                </form>
</body>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="https://code.jquery.com/jquery.min.js"></script>
</html>