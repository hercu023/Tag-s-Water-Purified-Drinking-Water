<?php
require_once '../database/connection-db.php';
require_once "../service/user-access.php";

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
        <link rel="stylesheet" type="text/css" href="../CSS/monitoring-delivery-pickup-delivered.css">
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
                                        <?php $delivered_query = "SELECT 
                                            count(delivery_list.id) as count
                                            FROM delivery_list
                                            WHERE delivery_list.delivery_status = 3";
                                            $delivered_result = mysqli_query($con, $delivered_query);
                                            $delivered = mysqli_fetch_assoc($delivered_result);
                                            $count_of_delivered = $delivered['count'];
                                        ?>
                                        <h3 class="deliveries">TOTAL DELIVERED ORDERS</h3>
                                        <span class="total-deliveries"><?php echo $count_of_delivered ?></span>
                                    </div>
                                </div>
                                <div class="newUser-button3"> 
                                    <a href="../monitoring/monitoring-delivery-pickup.php" id="add-userbutton" class="batchlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M14 18q-1.667 0-2.833-1.167Q10 15.667 10 14q0-1.667 1.167-2.833Q12.333 10 14 10q1.667 0 2.833 1.167Q18 12.333 18 14q0 1.667-1.167 2.833Q15.667 18 14 18Zm1.146-2.146.708-.708-1.354-1.354V12h-1v2.208ZM4.5 17q-.625 0-1.062-.438Q3 16.125 3 15.5v-11q0-.625.448-1.062Q3.896 3 4.5 3h3.562q.209-.708.709-1.104Q9.271 1.5 10 1.5q.75 0 1.25.396T11.938 3H15.5q.604 0 1.052.438Q17 3.875 17 4.5v4.896q-.354-.229-.719-.406-.364-.178-.781-.282V4.5H14V7H6V4.5H4.5v11h4.208q.146.438.292.792.146.354.396.708ZM10 4.5q.312 0 .531-.219.219-.219.219-.531 0-.312-.219-.531Q10.312 3 10 3q-.312 0-.531.219-.219.219-.219.531 0 .312.219.531.219.219.531.219Z"/></svg>
                                        <h3 class="deliveries">PENDING DELIVERY and PICK UP</h3>
                                    </a>
                                </div>
                        </div> 
                </div>
        
                    
                    <div class="account-container" id="customerTable">
                    <br>
                            <header class="previous-transaction-header">DELIVERED ORDERS</header>
                            <hr>
                            <table class="table" id="myTable">
                            <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Order Details</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Delivery Boy</th>
                            <th scope="col">Date/Time Listed</th>
                            <th scope="col">Date/Time Delivered</th>
                    </tr>
                    </thead>

                    <?php
                            $dropdown_query2 = "SELECT 
                            transaction.id,
                            transaction.uuid,
                            customers.customer_name,
                            transaction.status_id,
                            transaction.total_amount,
                            transaction.created_at_date,
                            transaction.created_at_time,
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
                            AND delivery_list.delivery_status = 3
                            ORDER BY transaction.created_at_time";
                        $result4 = mysqli_query($con, $dropdown_query2);
                        while ($rows = mysqli_fetch_assoc($result4))
                        {
                    ?>
                     <tbody>
                            <tr>
                                <td data-label="ID"> <?php echo $rows['id']; ?></td>
                                <td data-label="Customer Name"> <?php if($rows['customer_name']){
                                    echo $rows['customer_name'];
                                    }else{
                                        echo 'GUEST';
                                    }
                                 ?></td>
                                <td data-label="Order Details"> <a class="viewTransaction" href="../monitoring/monitoring-delivery-pickup-delivered-viewdetails.php?view=<?php echo $rows['uuid'];?>">View Details</a></td>
                                <td data-label="Total Amount"> <?php echo '<span>&#8369;</span>'.' '.number_format($rows['total_amount'], '2','.',','); ?></td> 
                                <td data-label="Payment Status"> 
                                    <?php 
                                    if($rows['status_id'] == 0){
                                        echo '<span class="outofstock">Unpaid</span>';
                                    }else{
                                        echo '<span class="instock">Paid</span>';
                                    } ?>
                                </td>
                                <td data-label="Delivery Boy"> <?php echo $rows['first_name'] .' '. $rows['last_name'] ; ?></td>
                                <td data-label="Date/Time Listed"> <?php echo $rows['created_at_date'] .' '. $rows['created_at_time']; ?></td>
                                <td data-label="Date/Time Delivered"> <?php echo $rows['updated_at']?></td>
                            <tr id="noRecordTR" style="display:none">
                                <td colspan="7">No Record Found</td>
                            </tr>
                            </tbody>
                            <?php
                        }
                        ?>
                            </table>
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

    </body>
<script src="../javascript/monitoring-delivery-pickup-delivered.js"></script>
</html>
