<?php
session_start();
include '../connectionDB.php';

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
            <div class="top-buttons">
                <div class="newUser-button">
                    <a href="../pos/point-of-sales-select-customer.php" id="select-customerbutton" class="add-account">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="m15.896 17.792-5.125-5.125q-.604.375-1.344.593-.739.219-1.594.219-2.271 0-3.875-1.604T2.354 8q0-2.271 1.604-3.875t3.875-1.604q2.271 0 3.875 1.604T13.312 8q0 .875-.218 1.594-.219.718-.594 1.302l5.146 5.166Zm-8.063-6.771q1.271 0 2.146-.875T10.854 8q0-1.271-.875-2.146t-2.146-.875q-1.271 0-2.145.875-.876.875-.876 2.146t.876 2.146q.874.875 2.145.875Z"/></svg>
                        <h3>SELECT CUSTOMER</h3>
                    </a>
                </div>
                <div class="newUser-button">
                    <a href="../pos/point-of-sales-select-customer.php" id="new-customerbutton" class="add-account">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 14h1.5v-3.25H14v-1.5h-3.25V6h-1.5v3.25H6v1.5h3.25Zm.75 4q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                        <h3>ADD NEW CUSTOMER</h3>
                    </a>
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
                    <p class="selectCustomer-text">SELECT CUSTOMER</p>
                    <div class="delivery-options">
                        <select class="select">
                            <option value="Walk In">Walk In</option>
                            <option value="Delivery">Delivery</option>
                            <option value="Pick Up">Pick Up</option>
                        </select>
                    </div>
                    <hr>
                    <div class="form1-ordertype-buttons">
                        <a href="point-of-sales.php" class="refillOrder-button">Refill</a>
                        <a href="point-of-sales-new.php" class="newOrder-button">New</a>
                    </div>

                    <br>

                    <div class="form1-details">
                        <div class="form1-tableoption-buttons">
                            <img class="containerlogo" src="../Pictures and Icons/gallon.png">
                            <button class="containerTable-button">Container</button>
                            <br>
                            <img class="bottlelogo" src="../Pictures and Icons/plastic-bottle.png">
                            <button class="bottleTable-button">Bottle</button>
                            <br>
                            <img class="menulogo" src="../Pictures and Icons/menu.png">
                            <button class="othersTable-button">Others</button>
                        </div>
                        <div class="form1-table">
                            <table class="table" id="myTable">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>WATER</th>
                                    <th>ITEM</th>
                                    <th>Own Gal</th>
                                    <th>Tags Gal</th>
                                    <th>Price</th>
                                    <th>TOTAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                <tr id="selectorder" class="selectorder" style="width:10rem">
                                    <td colspan="7"><input type="button" class="select-order" id="selectOrder" value="ADD ORDER"></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="form1-buttons">
                        <!-- <button class="addDeliveryFee-button">Add Delivery Fee</button> -->
                        <button class="addOrder-button" id="addOrder-form">Place Order</button>
                    </div>
                </div>
            </div>
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
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <hr>
                        <div class="totalOrder-amount">
                            <div class="orderTotal1">
                                <p class="orderTotal-text">Order Total</p>
                            </div>
                            <div class="orderTotal2">
                                <h3 class="peso-sign">PHP</h3>
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
                        <th>Item Name</th>
                        <th>Water</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>QTY</th>
                        <th>Total</th>
                        <th>Change</th>
                        <th>Amount Tentered</th>
                        <th>Payment</th>
                        <th>Service</th>
                        <th>Cashier Name</th>
                        <th>Date/Time</th>
                    </tr>
                    </thead>
                    <?php
                    $dropdown_query2 = "SELECT * FROM transaction";
                    $result4 = mysqli_query($con, $dropdown_query2);
                    while ($rows = mysqli_fetch_assoc($result4))
                    {
                        ?>
                        <tbody>
                        <tr>
                            <td> <?php echo $rows['transaction_id']; ?></td>
                            <td> <?php echo $rows['customer_name']; ?></td>
                            <td> <?php echo $rows['item_name']; ?></td>
                            <td> <?php echo $rows['water_type']; ?></td>
                            <td> <?php echo $rows['water_service']; ?></td>
                            <td> <?php echo $rows['price']; ?></td>
                            <td> <?php echo $rows['quantity']; ?></td>
                            <td> <?php echo $rows['total_amount']; ?></td>
                            <td> <?php echo $rows['customer_change']; ?></td>
                            <td> <?php echo $rows['amount_tentered']; ?></td>
                            <td> <?php echo $rows['payment_option']; ?></td>
                            <td> <?php echo $rows['service_type']; ?></td>
                            <td> <?php echo $_SESSION['user_user_type']; ?></td>
                            <td> <?php echo $rows['date_time']; ?></td>
                        <tr id="noRecordTR" style="display:none">
                            <td colspan="10">No Record Found</td>
                        </tr>
                        </tbody>
                        <?php
                    }
                    ?>
                </table>
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
    $dropdown_query = "SELECT item_name FROM inventory_item";
    $result1 = mysqli_query($con, $dropdown_query);
    ?>

</body>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script src="https://code.jquery.com/jquery.min.js"></script>
<script src="../javascript/point-of-sales.js"></script>
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
}
.dark-theme{
    --color-white: rgb(48, 48, 48);
    --color-tertiary: hsl(0, 0%, 25%);
    --color-black: white;
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

/* -----------------------------------------------Side Menu---------------------------------------- */
.side-bar{
    background: var(--color-table-hover);
    backdrop-filter: blur(15px);
    width: 15.5rem;
    height: 100vh;
    position: fixed;
    top: 0;
    /* left: -100%; */
    overflow-y: auto;
    transition: 0.6s ease;
    transition-property: left;
}
.side-bar .title{
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: -1.9rem;
}
.side-bar .titlelogo{
    display: flex;
    gap: 0.8rem;
}
.side-bar .titlelogo img{
    width: 5rem;
    margin-top: -1rem;
    margin-bottom: 1rem;
    margin-left: 5.5rem;
}
.side-bar .close{
    display: none;
    font-size: 1rem;
}
.side-bar.active{
    left: 0;
}

.side-bar .menu{
    width: 100%;
    margin-top: 80px;
}

.side-bar .menu .item{
    position: relative;
    cursor: pointer;
}

.side-bar .menu .item a{
    color: var(--color-tertiary);
    font-size: 13px;
    text-decoration: none;
    display: flex;
    fill: var(--color-tertiary);
    margin-left: .5rem;
    gap: 1rem;
    align-items: center;
    position: relative;
    padding: 0px 20px;
    line-height: 60px;
    height: 3.7rem;
    transition: all 300ms ease;
}
.side-bar .menu .item .sub-item{
    height: 2.9rem;

}
#pointofsales{
    background: var(--color-white);
    transition: 0.6s;
    color: var(--color-solid-gray);
    fill: var(--color-solid-gray);
    margin-left: 0;
    padding-left: 1rem;
    content: "";
    margin-bottom: 6px;
    font-size: 15px;
    border-radius: 0 0 10px 0 ;
    box-shadow: 1px 3px 1px var(--color-background);
}
.side-bar .menu .item a:hover{
    background: var(--color-table-hover);
    transition: 0.6s;
    margin-left: 0rem;
    border-radius: 0 10px 10px 0 ;
    box-shadow: 2px 2px 2px rgb(224, 224, 224);
}

.side-bar .menu .item a .dropdown{
    position: absolute;
    right: 0;
    margin: 20px;
    transition: 0.3s ease;
}

.side-bar .menu .item .sub-menu{
    background: var(--color-background);
    display: none;

}

.side-bar .menu .item .sub-menu a{
    padding-left: 90px;
    font-size: 13px;
    font-weight: 500;
    font-family: 'switzer', sans-serif;
    box-shadow: 0px 1px 1px rgb(224, 224, 224);

}

.rotate{
    transform: rotate(90deg);
}

.close-btn{
    position: absolute;
    color: var(--color-tertiary);
    font-size: 14px;
    right: 0;
    margin: 25px;
    margin-top: 50px;
    display: none;
    cursor: pointer;
}

.menu-btn{
    position: absolute;
    color: var(--color-tertiary);
    font-size: 20px;
    margin: 25px;
    cursor: pointer;
}
.menu-btn:hover{
    color: var(--color-main);
}
.menu-btn2{
    position: absolute;
    color: var(--color-tertiary);
    font-size: 20px;
    margin: 25px;
    display: none;
    left: 0;
    cursor: pointer;
}
.menu-btn2:hover{
    /* position: absolute; */
    color: var(--color-main);
    /* font-size: 25px;
    margin: 30px;
    cursor: pointer; */
}
/* ----------------------------------------Top bar menu----------------------------------------  */
.top-menu{
    /* margin-top: .7rem; */
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
    margin-top: 3rem;
}
.posTitle{
    margin-top: 2rem;
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
    width: 12rem;
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
    background-color: var(--color-blue-button);
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
    width: 100%;

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
}

/* ORDER FORM -------------------------------------------------------------------------------*/
.form-container{
    display: inline-block;
    position: relative;
    width: 65%;
    align-items: left;
}
.form1{
    background-color: var(--color-white);
    margin-top: 2rem;
    border: none;
    display: inline-block;
    height: 33%;
    width: 100%;
    border-radius: 1rem;
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
    right: 3%;
    height: 2rem;
    position: relative;
    text-align: right;
}
.refillOrder-button{
    background-color: var(--color-secondary-main);
    color: var(--color-tertiary);
    display: inline-block;
    height: 2rem;
    width: 18rem;
    font-family: 'calibri', sans-serif;
    text-transform: uppercase;
    font-size: 1rem;
    font-weight: 900;
    padding-top: .7rem;
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
    color: var(--color-white);
    background-color: var(--color-blue-button);
    display: inline-block;
    padding: 0rem;
    height: 2rem;
    width: 18rem;
    font-family: 'calibri', sans-serif;
    text-transform: uppercase;
    font-size: 1rem;
    font-weight: 900;
    padding-top: .7rem;
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
.containerlogo{
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
    margin-top: 2.5px;
}
.othersTable-button:focus{
    background-color: var(--color-blue-button);
    color: var(--color-white);
}
.form1-table{
    background-color: var(--color-white);
    padding: 1rem;
    width:72%;
    overflow:auto;
    margin-left: 1rem;
    display: inline-block;
    height: 15rem;
    align-items: right;
    text-align: right;
    border: 1px solid var(--color-tertiary);
    position: absolute;
    border-radius: 10px;
}
.textBox-table{
    width:2rem;
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
.select-order{
    width: 36rem;
    font-weight: 900;
    height: 2rem;
    background: var(--color-secondary-main);
    color: var(--color-tertiary);
    border: none;
    font-family: 'outfit', sans-serif;
    box-shadow: 0px 0px 2px 1px var(--color-tertiary);
    border-radius: 15px;
}
.select-order:hover{
    background: var(--color-main);
    color: var(--color-white);
}
.form1-buttons{
    margin-top: 6rem;
    align-items: right;
    text-align: right;
    background-color: none;
    position: relative;
    padding: 1rem;
    width: 100%;
    right: 5rem;
}
.addDeliveryFee-button{
    background-color: var(--color-white);
    padding: 0rem;
    height: 3rem;
    width: 14rem;
    font-size: 1rem;
    border-radius: 50px;
    font-weight: 600;
    font-family: 'outfit', sans-serif;
    text-transform: uppercase;
    border-color: var(--color-lightest-gray);
    box-shadow: 0px 1px 0px 0px var(--color-shadow-shadow);
    margin: 1rem;
}
.addOrder-button{
    background-color: var(--color-background);
    padding: 0rem;
    height: 3rem;
    width: 20%;
    font-size: 1rem;
    border-radius: 50px;
    color: var(--color-black);
    font-weight: 600;
    text-transform: uppercase;
    font-family: 'outfit', sans-serif;
    border-color: var(--color-lightest-gray);
    box-shadow: 0px 1px 0px 0px var(--color-shadow-shadow);
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
    width: 100%;
    border-radius: 20px;
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
