<?php
session_start();
include 'connectionDB.php';
if (isset($_POST['email']) && isset($_POST['password'])){

    $email = $_POST['email'];
    $pass = $_POST['password'];

    if (empty($email)){
        // header("Location: login.php?error=Email is required");
    }else if (empty($pass)){
        // header("Location: login.php?error=Password is required");
    }else{
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() === 1){
            $user = $stmt->fetch();

            $user_id = $user['id'];
            $user_email = $user['email'];
            $user_password = $user['password'];
            $user_first_name = $user['first_name'];
            $user_user_type = $user['user_type'];
            $user_profile_image = $user['profile_image'];
            if ($email === $user_email){
                if (password_verify($pass, $user_password)){
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_email'] = $user_email;
                    $_SESSION['user_first_name'] =  $user_first_name;
                    $_SESSION['user_user_type'] =  $user_user_type;
                    $_SESSION['user_profile_image'] =  $user_profile_image;
                }else{
                    header("Location: login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> The password you've entered is incorrect");
                }
            }else {
                header("Location: login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> The email you entered is not connected to the system");
            }
        }else{
            header("Location: login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> The email you entered is not connected to the system");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="../CSS/point-of-sales-new.css">
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
    include('common/side-menu.php')
    ?>

    <main>
        <div class="main-pos">
            <h1 class="posTitle">POINT OF SALES</h1>
            <div class="top-buttons">
                <div class="newUser-button">
                    <button type="submit" id="select-customerbutton" class="add-account" onclick="addnewuser();">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="m15.896 17.792-5.125-5.125q-.604.375-1.344.593-.739.219-1.594.219-2.271 0-3.875-1.604T2.354 8q0-2.271 1.604-3.875t3.875-1.604q2.271 0 3.875 1.604T13.312 8q0 .875-.218 1.594-.219.718-.594 1.302l5.146 5.166Zm-8.063-6.771q1.271 0 2.146-.875T10.854 8q0-1.271-.875-2.146t-2.146-.875q-1.271 0-2.145.875-.876.875-.876 2.146t.876 2.146q.874.875 2.145.875Z"/></svg>
                        <h3>SELECT CUSTOMER</h3>
                    </button>
                </div>
                <div class="newUser-button">
                    <button type="submit" id="new-customerbutton" class="add-account" onclick="addnewuser();">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 14h1.5v-3.25H14v-1.5h-3.25V6h-1.5v3.25H6v1.5h3.25Zm.75 4q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                        <h3>ADD NEW CUSTOMER</h3>
                    </button>
                </div>
                <div class="newUser-button">
                    <button type="submit" id="return-containerbutton" class="add-account" onclick="addnewuser();">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M7.479 15.042 2.417 10l5.062-5.042 1.729 1.73-2.083 2.083h7v-2.25h2.458v4.708H7.125l2.083 2.083Z"/></svg>
                        <h3>RETURN CONTAINER</h3>
                    </button>
                </div>
            </div>
            <!-- <div class="top-buttons">
                <button class="selectCustomer-button">
                    <h3>SELECT CUSTOMER</h3>
                </button>
                <button class="newCustomer-button">
                    <h3>NEW CUSTOMER</h3>
                </button>
                <button class="returnContainer-button">
                    <h3>RETURN CONTAINER</h3>
                </button>
            </div> -->

            <!-- ---------------------------------------------------- ORDER DETAILS ------------------------------------------------- -->
            <!-- <div class="form-container"> -->
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
                        <img class="containerlogo" src="../../Tag-s-Water-Purified-Drinking-Water/Pictures%20and%20Icons/gallon.png">
                        <button class="containerTable-button">Container</button>
                        <br>
                        <img class="bottlelogo" src="../../Tag-s-Water-Purified-Drinking-Water/Pictures%20and%20Icons/plastic-bottle.png">
                        <button class="bottleTable-button">Bottle</button>
                        <br>
                        <img class="menulogo" src="../../Tag-s-Water-Purified-Drinking-Water/Pictures%20and%20Icons/menu.png">
                        <button class="othersTable-button">Others</button>
                    </div>
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
                <div class="form1-buttons">
                    <button class="addDeliveryFee-button">Add Delivery Fee</button>
                    <button class="addOrder-button" id="addOrder-form">Add Order</button>
                </div>
            </div>


            <!-- CONTAINER END ---------------------------------------------------------------------------------------- -->
            <!--------------------------------------------------------------------------------------------------------- -->


        </div>
    </main>
    <div class="top-menu">
        <div class="menu-bar">
            <div class="menu-btn2">
                <i class="fas fa-bars"></i>
            </div>
            <h2 class="posTitle-top">POINT OF SALES</h2>
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
                    <img src="uploaded_image/<?= $_SESSION['user_profile_image']; ?>" alt="">
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
            <!-- <div class="form2"> -->
            <div class="payment-options">
                <?php
                $dropdown_query1 = "SELECT * FROM payment_option";
                $result3 = mysqli_query($con, $dropdown_query1);
                ?>
                <p class="paymentOptions-text">Payment Options</p>
                <select class="paymentOptions-dropdown">
                    <?php while($row3 = mysqli_fetch_array($result3)):;?>
                        <option><?php echo $row3[1];?></option>
                    <?php endwhile;?>
                </select>
            </div>
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
                <p class="orderSummary-text">Order Summary</p>
                <p class="cashier-text">Cashier: <span id="cashier-name"><h5 class="name-cashier"><?php echo $_SESSION['user_first_name']; ?></h5></span></p>
                <div class="orderSum-table">
                    <table class="tableCheckout" id="myTable">
                        <thead>
                        <tr>
                            <th>ITEM</th>
                            <th>Water</th>
                            <th>Type</th>
                            <th>QTY</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <hr>
                <p class="orderTotal-text">Order Total</p>
                <h3 class="peso-sign">PHP</h3>
                <input type="text" class="total-order" value="0.00" readonly>
                <hr>
                <div class="receipt-buttons">
                    <a href="point-of-sales.php" id="cancel">CANCEL</a>
                    <input type="button" class="confirmOrder-button" value="CONFIRM">
                </div>
                </body>
            </div>
            <!-- </div>  -->
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
                            <td> <?php echo $rows['cashier_name']; ?></td>
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
    </div>

    <!-- CONTAINER START -------------------------------------------------------------------------------------- -->
    <!--------------------------------------------------------------------------------------------------------- -->

    <?php
    $dropdown_query = "SELECT item_name FROM inventory_item";
    $result1 = mysqli_query($con, $dropdown_query);
    ?>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="../javascript/point-of-sales-new.js"></script>
</html>
