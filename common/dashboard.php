<?php
@session_start();
require_once '../database/connection-db.php';
require_once "../service/user-access.php";
require_once "../service/pie-graph-data.php";
require_once "../service/bar-graph-data.php";

date_default_timezone_set("Asia/Manila");

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'DASHBOARD')) {
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
        <link rel="stylesheet" type="text/css" href="../CSS/dashboard.css">
        <title>Tag's Water Purified Drinking Water</title>
    </head>
    <body>
        <div class="container">
            <?php
            include('../common/side-menu.php')
            ?>
            <main>
                <div class="main-dashboard">
                    <h1 class="dashTitle">DASHBOARD</h1> 
                    <div class="user-title">
                            <h2>Today's Summary</h2>
                        </div>
                    <div class="sub-tab">
                        <div class="newUser-button"> 
                            <div id="add-userbutton" class="widget1">
                                <div class="icon-widget">
                                    <img  src="../Pictures and Icons/icons8-total-sales-48.png" >
                                </div>
                                <div class="text-widget">
                                    <?php
                                        $date = date("Y-m-d");
                                        $total_sales_query = "SELECT
                                            IF(SUM(transaction.total_amount) IS NULL or SUM(transaction.total_amount) = '', 0, SUM(transaction.total_amount)) as total
                                            FROM transaction
                                            WHERE transaction.status_id = '1'
                                            AND transaction.created_at_date = '$date'";
                                        $total_sales_result = mysqli_query($con, $total_sales_query);
                                        $total_sales = mysqli_fetch_assoc($total_sales_result);
                                    ?>
                                    <span class="total-deliveries">
                                        <span class="peso-sign">&#8369</span>
                                        <?php echo number_format($total_sales['total'], '2','.',','); ?>
                                    </span>
                                    <h3 class="deliveries">TOTAL SALES</h3>
                                </div>
                            </div>
                        </div>
                        <div class="newUser-button"> 
                            <div id="add-userbutton" class="widget2">
                                <div class="icon-widget">
                                    <img width="45" src="../Pictures and Icons/icons8-expense-64.png" >
                                </div>
                                <div class="text-widget">
                                    <?php
                                        $date = date("Y-m-d");
                                        $total_expense_query = "SELECT
                                            IF(SUM(expense.amount) IS NULL or SUM(expense.amount) = '', 0, SUM(expense.amount)) as total
                                            FROM expense
                                            WHERE expense.status_archive_id = '1'
                                            AND expense.date = '$date'";
                                        $total_expense_result = mysqli_query($con, $total_expense_query);
                                        $total_expense = mysqli_fetch_assoc($total_expense_result);
                                    ?>
                                    <span class="total-deliveries">
                                        <span class="peso-sign">&#8369</span>
                                        <?php echo number_format($total_expense['total'], '2','.',','); ?>
                                    </span>
                                    <h3 class="deliveries">TOTAL EXPENSE</h3>
                                </div>
                            </div>
                        </div>
                        <div class="newUser-button"> 
                            <div id="add-userbutton" class="widget3">
                                <div class="icon-widget">
                                    <img width="45" src="../Pictures and Icons/icons8-transaction-48.png" >
                                </div>
                                <div class="text-widget">
                                    <?php
                                        $date = date("Y-m-d");
                                        $total_transaction_query = "SELECT
                                            COUNT(transaction.id) as total
                                            FROM transaction
                                            WHERE transaction.created_at_date = '$date'";
                                        $total_transaction_result = mysqli_query($con, $total_transaction_query);
                                        $total_transaction = mysqli_fetch_assoc($total_transaction_result);
                                    ?>
                                    <span class="total-deliveries"><?php echo $total_transaction['total'];?></span>
                                    <h3 class="deliveries">TOTAL TRANSACTION</h3>
                                </div>
                            </div>
                        </div>
                        <div class="newUser-button"> 
                            <div id="add-userbutton" class="widget4">
                                <div class="icon-widget">
                                    <img width="55" src="../Pictures and Icons/icons8-customer-64.png" >
                                </div>
                                <div class="text-widget">

                                    <?php
                                        $total_unpaid_customers_query = "SELECT
                                            COUNT(DISTINCT transaction.customer_name_id) as total
                                            FROM transaction";
                                        $total_unpaid_customers_result = mysqli_query($con, $total_unpaid_customers_query);
                                        $total_unpaid_customers = mysqli_fetch_assoc($total_unpaid_customers_result);
                                    ?>
                                    <span class="total-deliveries"><?php echo $total_unpaid_customers['total'];?></span>
                                    <h3 class="deliveries">UNPAID CUSTOMERS</h3>

                                </div>
                            </div>
                        </div>
                        
                        <div class="transactions-total">
                            <div class="newUser-button1"> 
                                <div id="add-userbutton" class="widget5">
                                <?php
                                    $date = date("Y-m-d");
                                    $total_delivery_query = "SELECT
                                        COUNT(transaction.id) as total
                                        FROM transaction
                                        WHERE transaction.created_at_date = '$date'
                                        AND transaction.service_type != 'Walk In'";
                                    $total_delivery_result = mysqli_query($con, $total_delivery_query);
                                    $total_delivery = mysqli_fetch_assoc($total_delivery_result);
                                ?>
                                    <h4 class="deliveries-transaction">DELIVERIES</h4>
                                    <span class="total-transaction1"><?php echo $total_delivery['total'];?></span>
                                </div>
                            </div>
                            <div class="newUser-button1">
                                <?php
                                    $date = date("Y-m-d");
                                    $total_walkin_query = "SELECT
                                        COUNT(transaction.id) as total
                                        FROM transaction
                                        WHERE transaction.created_at_date = '$date'
                                        AND transaction.service_type = 'Walk In'";
                                    $total_walkin_result = mysqli_query($con, $total_walkin_query);
                                    $total_walkin = mysqli_fetch_assoc($total_walkin_result);
                                ?>
                                <div id="add-userbutton" class="widget6">
                                    <h4 class="deliveries-transaction">WALK IN</h4>
                                    <span class="total-transaction2"><?php echo $total_walkin['total'];?></span>
                                </div>
                            </div>
                            <div class="newUser-button1"> 
                                <div id="add-userbutton" class="widget7">
                                <?php
                                    $total_critical_stock_query = "SELECT 
                                    COUNT(inventory_item.id) as total
                                    FROM inventory_item
                                    INNER JOIN inventory_stock
                                    ON inventory_item.id = inventory_stock.item_name_id
                                    WHERE inventory_stock.on_hand <= inventory_item.reorder_level
                                    AND inventory_item.status_archive_id = 1";
                                    $total_critical_stock_result = mysqli_query($con, $total_critical_stock_query);
                                    $total_critical_stock = mysqli_fetch_assoc($total_critical_stock_result);
                                ?>
                                    <h4 class="deliveries-transaction">CRITICAL STOCK</h4>
                                    <span class="total-transaction3"><?php echo $total_critical_stock['total'];?></span>
                                </div>
                            </div>
                            <div class="newUser-button1"> 
                                <div id="add-userbutton" class="widget8">
                                <?php
                                    $date = date("Y-m-d");
                                    $total_new_customer_query = "SELECT 
                                        COUNT(customers.id) as total
                                        FROM customers 
                                        WHERE DATE(customers.created_at) = '$date'";
                                    $total_new_customer_result = mysqli_query($con, $total_new_customer_query);
                                    $total_new_customer = mysqli_fetch_assoc($total_new_customer_result);
                                ?>
                                    <h4 class="deliveries-transaction">NEW CUSTOMERS</h4>
                                    <span class="total-transaction4"><?php echo $total_new_customer['total'];;?></span>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="graph-table">
                        <div class="bar-graph1">
                                <header class="caption">Monthly Sales <?php echo ' '.date("Y")?></header>
                                <div class="bar1" >
                                    <canvas id="myChart1"></canvas>
                                </div>
                        </div>

                        <div class="bar-graph2">
                                <header class="caption">Monthly Expenses (<?php echo date("F Y")?>)</header>
                                <div class="bar2">
                                    <canvas id="myChart2"></canvas>
                                </div>
                        </div>
                        <div class="container-table2">
                            <div class="main-container">
                                <div class="sub-tab-container">
                                    <header class="previous-transaction-header">RECENT TRANSACTION</header>
                                    <div class="card">
                                        <h1 class="day"><?php echo date("l")?></h1>
                                        <h1 class="dash">-</h1>
                                        <h1 class="date"><?php echo ' '.date("F j, Y")?></h1>
                                    </div>
                                </div>
                            </div>
                            <div class="customer-container" id="customerTable">
                                <table class="previous-transaction-table">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Order Details</th>
                                        <th scope="col">Service</th>
                                        <th scope="col">Payment Status</th>
                                        <th scope="col">Cashier Name</th>
                                        <th scope="col">Time</th>
                                    </tr>
                                    </thead>
                                    <?php
                                    $date = date("Y-m-d");
                                    $dropdown_query2 = "SELECT 
                                        transaction.id,
                                        transaction.uuid,
                                        customers.customer_name,
                                        transaction.service_type,
                                        transaction.status_id,
                                        users.first_name,
                                        users.last_name,
                                        transaction.created_at_time,
                                        transaction.created_at_date
                                        FROM transaction
                                        INNER JOIN users
                                        ON transaction.created_by_id = users.user_id
                                        LEFT JOIN customers
                                        ON transaction.customer_name_id = customers.id
                                        WHERE transaction.created_at_date = '$date'
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
                                            <td data-label="ID"> <?php echo $rows['id']; ?></td>
                                            <td data-label="Customer Name"> <?php if($rows['customer_name']){
                                                echo $rows['customer_name'];
                                                }else{
                                                    echo 'GUEST';
                                                }
                                            ?></td>
                                            <td data-label="Order Details"> <a class="viewTransaction" href="../pos/point-of-sales-viewdetails.php?view=<?php echo $rows['uuid'];?>">View Details</a></td>

                                            <td data-label="Service"> <?php echo $rows['service_type']; ?></td>
                                            <td data-label="Payment Status"> 
                                                <?php 
                                                if($rows['status_id'] == 0){
                                                    echo '<span class="outofstock">Unpaid</span>';
                                                }else{
                                                    echo '<span class="instock">Paid</span>';
                                                } ?>
                                            </td>
                                            <td data-label="Cashier Name"> <?php echo $rows['first_name'] .' '. $rows['last_name'] ; ?></td>
                                            <td data-label="Time"> <?php echo $rows['created_at_time']; ?></td>
                                        <tr id="noRecordTR" style="display:none">
                                            <td colspan="7">No Transaction(s) Found</td>
                                        </tr>
                                        </tbody>
                                        <?php
                                            }}else { ?>
                                            <tr id="noRecordTR">
                                                <td colspan="7">No Transaction(s) Added</td>
                                            </tr>
                                        <?php } ?>
                                </table>
                            </div>
                        </div>
                        <div class="container-table1">
                                <div class="main-container1">
                                    <div class="sub-tab-container1">
                                        <header class="previous-transaction-header1">TODAY' ATTENDANCE</header>
                                    </div>
                                </div>
                                <div class="customer-container1" id="customerTable">
                                    <table class="previous-transaction-table">
                                        <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Employee Name</th>
                                            <th scope="col">Time IN</th>
                                            <th scope="col">Time OUT</th>
                                        </tr>
                                        </thead>
                                        <?php
                                        $date = date("Y-m-d");
                                        $dropdown_query2 = "SELECT 
                                            attendance.id,
                                            attendance.time_in,
                                            attendance.time_out, 
                                            employee.first_name as emp_first_name,
                                            employee.last_name as emp_last_name
                                            FROM attendance 
                                            INNER JOIN employee 
                                            ON attendance.employee_id = employee.id
                                            WHERE attendance.status_archive_id = 1
                                            and attendance.date = '$date'";
                                        $result4 = mysqli_query($con, $dropdown_query2);
                                        if(mysqli_num_rows($result4) > 0)
                                        {
                                        foreach($result4 as $rows)
                                        {   
                                            ?>
                                            <tbody>
                                            <tr>
                                                <td data-label="ID"> <?php echo $rows['id']; ?></td>
                                                <td data-label="Employee Name"> <?php echo $rows['emp_first_name'].' '.$rows['emp_last_name'] ; ?></td>
                                                <td data-label="Time IN"> <?php echo $rows['time_in']; ?></td>
                                                <td data-label="Time OUT"> <?php echo $rows['time_out']; ?></td></td>
                                            <tr id="noRecordTR" style="display:none">
                                                <td colspan="4">No Record Found</td>
                                            </tr>
                                            </tbody>
                                            <?php
                                                }}else { ?>
                                                <tr id="noRecordTR">
                                                    <td colspan="7">No Record(s) Added</td>
                                                </tr>
                                            <?php } ?>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
             
            </main>

            <div class="top-menu">
                <div class="menu-bar">
                    <div class="menu-btn2">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h2 class="Title-top">DASHBOARD</h2>
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

</div>
                        

        </div> 
    </body>
</html>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>   
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/dashboard.js"></script>
<?php
$year = date("Y");
$jan = get_month_sales_data($con, "January", $year);
$feb = get_month_sales_data($con, "February", $year);
$mar = get_month_sales_data($con, "March", $year);
$apr = get_month_sales_data($con, "April", $year);
$may = get_month_sales_data($con, "May", $year);
$jun = get_month_sales_data($con, "June", $year);
$jul = get_month_sales_data($con, "July", $year);
$aug = get_month_sales_data($con, "August", $year);
$sep = get_month_sales_data($con, "September", $year);
$oct = get_month_sales_data($con, "October", $year);
$nov = get_month_sales_data($con, "November", $year);
$dec = get_month_sales_data($con, "December", $year);

echo '
<script type="text/JavaScript"> 

    var config1 = {
        type: "bar",
        data: {
        datasets: [{
        label: ["Total Sales Per Month"],
        data: [
            '.$jan.',
            '.$feb.',
            '.$mar.',
            '.$apr.',
            '.$may.',
            '.$jun.',
            '.$jul.',
            '.$aug.',
            '.$sep.',
            '.$oct.',
            '.$nov.',
            '.$dec.'],

        backgroundColor: [
            "rgba(255, 51, 51, 0.7)",
            "rgba(255, 131, 51, 0.7)",
            "rgba(255, 218, 51, 0.7)",
            "rgba(144, 255, 51, 0.7)",
            "rgba(51, 255, 150, 0.7)",
            "rgba(51, 252, 255 , 0.7)",
            "rgba(51, 131, 255, 0.7)",
            "rgba(134, 51, 255, 0.7)",
            "rgba(255, 51, 255, 0.7)",
            "rgba(255, 51, 144, 0.7)",
            "rgba(255, 51, 82, 0.7)",
            "rgba(201, 203, 207, 0.7)"
        ],
        borderColor: [
            "rgb(255, 51, 51 )",
            "rgb(255, 131, 51 )",
            "rgb(255, 218, 51 )",
            "rgb(144, 255, 51 )",
            "rgb(51, 255, 150 )",
            "rgb(51, 252, 255 )",
            "rgb(51, 131, 255 )",
            "rgb(134, 51, 255 )",
            "rgb(255, 51, 255 )",
            "rgb(255, 51, 144 )",
            "rgb(255, 51, 82 )",
            "rgb(201, 203, 207 )"
        ],
        borderWidth: 1
        }],
        labels: ["January","February","March","April","May","June","July","August","September","October","November","December"]

    },
    options: {
            responsive: true,
            legend: {
                position: "top",
            },
            title: {
                display: true,
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };

    var myChart1 = new Chart(
        document.getElementById("myChart1"),
        config1
    );
</script>
';
?>

    <?php
    $maintenace = get_maintenance_count($con);
    $utilities = get_utilities_count($con);
    $salaries = get_salaries_count($con);
    $other_expenses = get_other_expenses_count($con);
    echo '

    
    <script type="text/JavaScript"> 

    var config2 = {
        type: "pie",
        data: {
        datasets: [{
        data: [
            '.$maintenace.',
            '.$utilities.',
            '.$salaries.',
            '.$other_expenses.'
        ],

        backgroundColor: [
            "rgba(255, 51, 51, 0.7)",
            "rgba(255, 131, 51, 0.7)",
            "rgba(255, 218, 51, 0.7)",
            "rgba(144, 255, 51, 0.7)"
        ],
        borderColor: [
            "rgb(255, 255, 255 )",
            "rgb(255, 255, 255 )",
            "rgb(255, 255, 255 )",
            "rgb(255, 255, 255 )"
        ],
        borderWidth: 1
        }],
        labels: [
            "Maintenance", 
            "Utilities", 
            "Salaries", 
            "Others"]
    },
    options: {
            responsive: true,
            legend: {
                position: "top",
            },
            title: {
                display: true,
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };

    var myChart2 = new Chart(
        document.getElementById("myChart2"),
        config2
    );
    </script>
';
?>
