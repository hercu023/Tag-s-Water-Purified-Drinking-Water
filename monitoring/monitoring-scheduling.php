<?php
require_once '../database/connection-db.php';
require_once "../service/user-access.php";
require_once "../service/save-weekly-schedule.php";
require_once "../service/save-date-schedule.php";

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'MONITORING-SCHEDULING')) {
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
        <link rel="stylesheet" type="text/css" href="../CSS/monitoring-scheduling.css">
        <link rel="stylesheet" type="text/css" href="../CSS/pagination.css">
        <script src="../index.js"></script>
    </head>
 <style>
   
 </style>
    <body>
    
        <div class="container">
        <?php
            include('../common/side-menu.php')
        ?>
            <?php  
                if(isset($_GET['records']) && isset($_GET['page'])) {
                    $per_page_record = $_GET['records'];
                    $page = $_GET['page'];
                } else {
                    $per_page_record = 5;
                    $page = 1;
                }

                $query = "SELECT COUNT(*) FROM customers
                INNER JOIN date_scheduling
                ON customers.id = date_scheduling.customer_id
                WHERE customers.status_archive_id = 1";   
                $rs_result = mysqli_query($con, $query);     
                $row = mysqli_fetch_row($rs_result);     
                $total_records = $row[0];     
                $page_location = '../monitoring/monitoring-scheduling.php';
                $start_from = ($page - 1) * $per_page_record;  
                    
            ?>
            <main>
                <div class="main-dashboard">
                    <h1 class="dashTitle">MONITORING</h1> 
                    <div class="sub-tab">
                        <div class="user-title">
                            <h2>SCHEDULING</h2>
                        </div>
                        <div class="sub-tab2">
                            <div class="newUser-button">
                                <button type="button" id="add-userbutton" class="add-customer1" onclick="addnewuser1();">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M6.75 11.5q-.312 0-.531-.219Q6 11.062 6 10.75q0-.312.219-.531Q6.438 10 6.75 10q.312 0 .531.219.219.219.219.531 0 .312-.219.531-.219.219-.531.219Zm3.25 0q-.312 0-.531-.219-.219-.219-.219-.531 0-.312.219-.531Q9.688 10 10 10q.312 0 .531.219.219.219.219.531 0 .312-.219.531-.219.219-.531.219Zm3.25 0q-.312 0-.531-.219-.219-.219-.219-.531 0-.312.219-.531.219-.219.531-.219.312 0 .531.219.219.219.219.531 0 .312-.219.531-.219.219-.531.219ZM4.5 18q-.625 0-1.062-.448Q3 17.104 3 16.5v-11q0-.604.438-1.052Q3.875 4 4.5 4H6V2h1.5v2h5V2H14v2h1.5q.625 0 1.062.448Q17 4.896 17 5.5v11q0 .604-.438 1.052Q16.125 18 15.5 18Zm0-1.5h11V9h-11v7.5Z"/></svg>
                                    <h3>WEEKLY SCHEDULE</h3>
                                </button>
                            </div>
                            <div class="newUser-button">
                                <button type="button" id="add-userbutton" class="add-customer2" onclick="addnewuser2();">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M12 15q-.833 0-1.417-.583Q10 13.833 10 13q0-.833.583-1.417Q11.167 11 12 11q.833 0 1.417.583Q14 12.167 14 13q0 .833-.583 1.417Q12.833 15 12 15Zm-7.5 3q-.625 0-1.062-.448Q3 17.104 3 16.5v-11q0-.604.438-1.052Q3.875 4 4.5 4H6V2h1.5v2h5V2H14v2h1.5q.625 0 1.062.448Q17 4.896 17 5.5v11q0 .604-.438 1.052Q16.125 18 15.5 18Zm0-1.5h11V9h-11v7.5Z"/></svg>
                                    <h3>DATE SCHEDULE</h3>
                                </button>
                            </div>
                            <div class="newUser-button1"> 
                                    <div id="add-userbutton" class="add-account1">
                                        <h3 class="deliveries">Today's Scheduled Delivery</h3>
                                        <span class="total-deliveries">1</span>
                                    </div>
                                </div>
                        </div>
                    </div> 
                </div>
                    <div class="account-container" id="customerTable">
                            <br>
                            <form method="POST" action="">
                                <div class="select-dropdown">
                                    <select name="option" class="select" onchange="this.form.submit()">
                                        <option selected disabled value="">SELECT DAY</option>
                                        <option value="ALL" <?php if(isset($_POST['option']) && $_POST['option'] == "ALL") { echo 'selected'; }?>>ALL</option>
                                        <option value="MONDAY" <?php if(isset($_POST['option']) && $_POST['option'] == "MONDAY") { echo 'selected'; }?>>MONDAY</option>
                                        <option value="TUESDAY" <?php if(isset($_POST['option']) && $_POST['option'] == "TUESDAY") { echo 'selected'; }?>>TUESDAY</option>
                                        <option value="WEDNESDAY" <?php if(isset($_POST['option']) && $_POST['option'] == "WEDNESDAY") { echo 'selected'; }?>>WEDNESDAY</option>
                                        <option value="THURSDAY" <?php if(isset($_POST['option']) && $_POST['option'] == "THURSDAY") { echo 'selected'; }?>>THURSDAY</option>
                                        <option value="FRIDAY" <?php if(isset($_POST['option']) && $_POST['option'] == "FRIDAY") { echo 'selected'; }?>>FRIDAY</option>
                                        <option value="SATURDAY" <?php if(isset($_POST['option']) && $_POST['option'] == "SATURDAY") { echo 'selected'; }?>>SATURDAY</option>
                                        <option value="SUNDAY" <?php if(isset($_POST['option']) && $_POST['option'] == "SUNDAY") { echo 'selected'; }?>>SUNDAY</option>
                                    </select>
                                </div>
                            </form>
         
                            <header class="previous-transaction-header">SCHEDULED DATE OF DELIVERY(DAY OF THE WEEK)</header>
                            <hr>
                            <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col" ><span class="statusLbl">DAY(s) of DELIVERY</span></th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">Address</th>
                                </tr>
                            </thead>
                            <?php

                                if(isset($_POST['option']) && $_POST['option'] != 'ALL') {
                                $day = $_POST['option'];
                                $query = "SELECT 
                                        weekly_scheduling.day,
                                        customers.customer_name,
                                        customers.contact_number1,
                                        customers.address, 
                                        customers.balance
                                        FROM customers
                                        INNER JOIN weekly_scheduling
                                        ON customers.id = weekly_scheduling.customer_id
                                        WHERE weekly_scheduling.day = '$day'
                                        AND customers.status_archive_id = 1";

                                } else {
                                    $query = "SELECT 
                                    weekly_scheduling.day,
                                    customers.customer_name,
                                    customers.contact_number1,
                                    customers.address, 
                                    customers.balance
                                    FROM customers
                                    INNER JOIN weekly_scheduling
                                    ON customers.id = weekly_scheduling.customer_id
                                    WHERE customers.status_archive_id = 1";
                                }

                                $result = mysqli_query($con, $query);
                                if(mysqli_num_rows($result) > 0)
                                {
                                foreach($result as $rows)
                                {
                                ?>
                                <tbody>
                                <tr>
                                    <td data-label="DAY(s) of DELIVERY"> <?php echo $rows['day']; ?></td>
                                    <td data-label="Customer Name"> <?php echo $rows['customer_name']; ?></td>
                                    <td data-label="Contact Number"> <?php echo $rows['contact_number1']; ?></td>
                                    <td data-label="Address"> <?php echo $rows['address']; ?></td>
                                </tr>
                            </tbody>
                            <?php
                             }}else { ?>
                            <tr id="noRecordTR">
                                <td colspan="4">No Transaction(s) Added</td>
                            </tr>
                        <?php } ?>
                            </table>
                        </div>
                        <div class="account-container" id="customerTable">
                                    <br>
                                    <header class="previous-transaction-header">SCHEDULED DATE OF DELIVERY</header>
                                    <hr>
                                    <table class="table" id="myTable">
                                    <thead>
                                    <tr>
                                <th scope="col"><span class="statusLbl">DATE of DELIVERY</span></th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Contact Number</th>
                                <th scope="col">Address</th>
                                <th scope="col">Balance</th>
                            </tr>
                            </thead>

                            <?php
                            $query = "SELECT 
                                    date_scheduling.date,
                                    customers.id,
                                    customers.customer_name,
                                    customers.contact_number1,
                                    customers.address, 
                                    customers.balance
                                    FROM customers
                                    INNER JOIN date_scheduling
                                    ON customers.id = date_scheduling.customer_id
                                    WHERE customers.status_archive_id = 1
                                    ORDER BY date_scheduling.date ASC
                                    LIMIT $start_from, $per_page_record";
                            $result = mysqli_query($con, $query);
                            if(mysqli_num_rows($result) > 0)
                            {
                            foreach($result as $rows)
                            {
                            ?>
                            <tbody>
                            <tr>
                                <td data-label="DATE of DELIVERY"> <?php echo $rows['date']; ?></td>
                                <td data-label="Customer Name"> <?php echo $rows['customer_name']; ?></td>
                                <td data-label="Contact Number"> <?php echo $rows['contact_number1']; ?></td>
                                <td data-label="Address"> <?php echo $rows['address']; ?></td>
                                <td data-label="Balance"> <?php echo '<span>&#8369;</span>'.' '.$rows['balance']; ?></td>
                            </tr>
                            </tbody>
                            <?php
                             }}else { ?>
                            <tr id="noRecordTR">
                                <td colspan="5">No Transaction(s) Added</td>
                            </tr>
                        <?php } ?>
                            </table>
                        </div>
                        <div class="pagination">   
            <br>
                <?php  

                    // Number of pages required.   
                    $total_pages = ceil($total_records / $per_page_record);     
                    $pageLink = "";       
                
                    if($page>=2){   
                        echo "<a href='".$page_location."?page=".($page-1)."&records=".$per_page_record."'> Prev </a>";   
                    }       
                            
                    for ($i=1; $i<=$total_pages; $i++) {   
                    if ($i == $page) {   
                        $pageLink .= "<a class = 'active' href='".$page_location."?page=".$i."&records=".$per_page_record."'>".$i." </a>";   
                    }               
                    else  {   
                        $pageLink .= "<a href='".$page_location."?page=".$i."&records=".$per_page_record."'>".$i." </a>";     
                    }   
                    }; 

                    echo $pageLink;   
            
                    if($page<$total_pages){   
                        echo "<a href='".$page_location."?page=".($page + 1)."&records=".$per_page_record."'>  Next </a>";   
                    }  
                ?>

                <br><br>
                <select name="option" onchange="location ='<?php echo $page_location ?>' + '?page=1&records=' + this.value;">
                        <option value="5" <?php if($per_page_record == "5") { echo 'selected'; }?>>5</option>
                        <option value="10" <?php if($per_page_record == "10") { echo 'selected'; }?>>10</option>
                        <option value="50" <?php if($per_page_record == "50") { echo 'selected'; }?>>50</option>
                        <option value="100" <?php if($per_page_record == "100") { echo 'selected'; }?>>100</option>
                        <option value="250" <?php if($per_page_record == "250") { echo 'selected'; }?>>250</option>
                        <option value="500" <?php if($per_page_record == "500") { echo 'selected'; }?>>500</option>
                        <option value="1000" <?php if($per_page_record == "1000") { echo 'selected'; }?>>1000</option>
                </select>
                <span> No. of Records Per Page </span>  
                
            </div>
            </main>
            <div class="top-menu">
                <div class="menu-bar">
                    <div class="menu-btn2">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h2 class="Title-top">MONITORING</h2>
                    <h4 class="subTitle-top">Scheduling</h2>
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
        <div class="bg-addcustomerform" id="bg-addform">
        <div class="container1">
        <form action="" method="post" enctype="multipart/form-data" id="addcustomerFrm">
            <h1 class="addnew-title">DATE SCHEDULE</h1>
            <form action="#">
                <div class="main-user-info">
                        <div class="customerName">
                                <label for="contact_num2">Customer Name</label>
                                <div class="usertype-dropdown">
                                    <?php
                                    $dropdown_customers = "SELECT * FROM customers";
                                    $result_customers = mysqli_query($con, $dropdown_customers);
                                    ?>
                                    <select id="chosen1" class="select-customer" name="customername" required="">
                                        <option selected disabled value="">SELECT CUSTOMER</option>
                                        <?php while($customers = mysqli_fetch_array($result_customers)){?>
                                            <option value="<?php echo $customers['id']?>">
                                                <?php echo $customers['customer_name'];?>                                        
                                            </option>
                                        <?php }?>
                                    </select>
                                </div>
                        </div>
                    <div class="user-input-box">
                        <label class="monday">DATE of Delivery</label>
                        <input type="date"
                               class="date"
                               id="dateofattendance"
                               name="date_schedule"
                               required="required"
                               onchange="console.log(this.value);" />
                    </div>
                    <div class="line"></div>

                    <div class="bot-buttons">
                        <div class="CancelButton">
                            <a href="../monitoring/monitoring-scheduling.php" id="cancel">CANCEL</a>
                        </div>
                        <div class="AddButton">
                            <button type="submit" id="addcustomerBtn" name="save-date-schedule">SAVE</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>            
            <div class="container2">
            <?php 
            $customer_id = 0;
            if(isset($_POST['customer_id'])) {
                    echo '<script type="text/JavaScript"> 
                    const addForm = document.querySelector(".bg-addcustomerform");
                    const container1 = document.querySelector(".container1");
                    const container2 = document.querySelector(".container2");

                    addForm.style.display = "flex";
                    container2.style.display = "block";
                    container1.style.display = "none";
                    </script>';
                    $customer_id = $_POST['customer_id'];
            }
            
            ?>
            <form action="" method="post" enctype="multipart/form-data" id="addcustomerFrm">
                <h1 class="addnew-title">WEEKLY SCHEDULE</h1>
                <form action="#">
                    <div class="main-user-info">
                            <div class="customerName">
                            <form method="POST" action="">
                                <label for="contact_num2">Customer Name</label>
                                <div class="usertype-dropdown">
                                    <?php
                                    $dropdown_customers = "SELECT * FROM customers";
                                    $result_customers = mysqli_query($con, $dropdown_customers);
                                    ?>
                                    <select id="chosen2" class="select-customer" name="customer_id" required="" onchange="this.form.submit()">
                                        <option selected disabled value="">SELECT CUSTOMER</option>
                                        <?php while($customers = mysqli_fetch_array($result_customers)){?>
                                            <option 
                                            <?php if(isset($_POST['customer_id']) && $customers['id'] == $_POST['customer_id']) echo 'selected'; ?>
                                            value="<?php echo $customers['id']?>">
                                                <?php echo $customers['customer_name'];?>                                        
                                            </option>
                                        <?php }?>
                                    </select>
                                </div>
                            </form>
                            </div>
                        <label class="dateofattendance">SELECT DAY(S)</label>
                        <?php 
                        $has_monday = false;
                        $has_tuesday = false;
                        $has_wednesday = false;
                        $has_thursday = false;
                        $has_friday = false;
                        $has_saturday = false;
                        $has_sunday = false;
                        if(isset($_POST['customer_id'])) {
                            $has_monday = has_day($con, 'MONDAY', $customer_id);
                            $has_tuesday = has_day($con, 'TUESDAY', $customer_id);
                            $has_wednesday = has_day($con, 'WEDNESDAY', $customer_id);
                            $has_thursday = has_day($con, 'THURSDAY', $customer_id);
                            $has_friday = has_day($con, 'FRIDAY', $customer_id);
                            $has_saturday = has_day($con, 'SATURDAY', $customer_id);
                            $has_sunday = has_day($con, 'SUNDAY', $customer_id);
                            echo '<input type="hidden" name="customername" value="'.$_POST['customer_id'].'">';
                        }
                        ?>

                        <div class="user-checkbox">
                            <label class="switch">
                                <input type="checkbox" name="monday" <?php if($has_monday) echo 'checked'?>>
                                <span class="slider round"></span>
                            </label>
                            <label class="monday">MONDAY</label>
                        </div>
                        <div class="user-checkbox">
                            <label class="switch">
                                <input type="checkbox" name="tuesday" <?php if($has_tuesday) echo 'checked'?>>
                                <span class="slider round"></span>
                            </label>
                            <label class="monday">TUESDAY</label>
                        </div>
                        <div class="user-checkbox">
                            <label class="switch">
                                <input type="checkbox" name="wednesday" <?php if($has_wednesday) echo 'checked'?>>
                                <span class="slider round"></span>
                            </label>
                            <label class="monday">WEDNESDAY</label>
                        </div>
                        <div class="user-checkbox">
                            <label class="switch">
                                <input type="checkbox" name="thursday" <?php if($has_thursday) echo 'checked'?>>
                                <span class="slider round"></span>
                            </label>
                            <label class="monday">THURSDAY</label>
                        </div>
                        <div class="user-checkbox">
                            <label class="switch">
                                <input type="checkbox" name="friday" <?php if($has_friday) echo 'checked'?>>
                                <span class="slider round"></span>
                            </label>
                            <label class="monday">FRIDAY</label>
                        </div>
                        <div class="user-checkbox">
                            <label class="switch">
                                <input type="checkbox" name="saturday" <?php if($has_saturday) echo 'checked'?>>
                                <span class="slider round"></span>
                            </label>
                            <label class="monday">SATURDAY</label>
                        </div>
                        <div class="user-checkbox">
                            <label class="switch">
                                <input type="checkbox" name="sunday" <?php if($has_sunday) echo 'checked'?>>
                                <span class="slider round"></span>
                            </label>
                            <label class="monday">SUNDAY</label>
                        </div>

                        <div class="line"></div>

                        <div class="bot-buttons">
                            <div class="CancelButton">
                                <a href="../monitoring/monitoring-scheduling.php" id="cancel">CANCEL</a>
                            </div>
                            <div class="AddButton">
                                <button type="submit" id="addcustomerBtn" name="save-weekly-schedule">SAVE</button>
                            </div>
                        </div>
                    </div>
            </div>     
        </form>
    </body>
<script src="../javascript/side-menu-toggle.js"></script>
</html>
<script>
    function goToPage(reference) {   
    var page = document.getElementById("page").value;   
    page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
    window.location.href = reference + '&page=' + page;   
} 
    // -----------------------------SIDE MENU
    const addForm = document.querySelector(".bg-addcustomerform");
const container1 = document.querySelector(".container1");
const container2 = document.querySelector(".container2");
 function addnewuser1(){
    // const addBtn = document.querySelector(".add-customer");
    addForm.style.display = 'flex';
    container2.style.display = 'block';
    container1.style.display = 'none';
}
function addnewuser2(){
    // const addBtn = document.querySelector(".add-customer");
    addForm.style.display = 'flex';
    container2.style.display = 'none';
    container1.style.display = 'block';
}
new TomSelect("#chosen1",{
            create: false,
            sortField: {
            field: "text",
            direction: "asc"
        }
    });
    new TomSelect("#chosen2",{
            create: false,
            sortField: {
            field: "text",
            direction: "asc"
        }
    });
    // -----------------------------SIDE MENU
 $(document).ready(function(){
     //jquery for toggle sub menus
     $('.sub-btn').click(function(){
       $(this).next('.sub-menu').slideToggle();
       $(this).find('.dropdown').toggleClass('rotate');
     });

     //jquery for expand and collapse the sidebar
     $('.menu-btn').click(function(){
       $('.side-bar').addClass('active');
       $('.menu-btn').css("visibility", "hidden");
     });

     $('.close-btn').click(function(){
       $('.side-bar').removeClass('active');
       $('.menu-btn').css("visibility", "visible");
     });
     $('.menu-btn2').click(function(){
       $('.side-bar').addClass('active');
       $('.menu-btn2').css("visibility", "hidden");
     });

     $('.close-btn').click(function(){
       $('.side-bar').removeClass('active');
       $('.menu-btn2').css("visibility", "visible");
     });
   });
//    --------------------------------------------------------------------
    const sideMenu = document.querySelector('#aside');
    const closeBtn = document.querySelector('#close-btn');
    const menuBtn = document.querySelector('#menu-button');
    const checkbox = document.getElementById('checkbox');
        menuBtn.addEventListener('click', () =>{
            sideMenu.style.display = 'block';
        })

        closeBtn.addEventListener('click', () =>{
            sideMenu.style.display = 'none';
        })
</script>
