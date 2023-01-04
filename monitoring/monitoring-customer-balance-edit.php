<?php
require_once '../database/connection-db.php';
require_once '../service/edit-customer-balance.php';
require_once "../service/user-access.php";

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'MONITORING-CUSTOMER_BALANCE')) {
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
        <link rel="stylesheet" type="text/css" href="../CSS/monitoring-customer-balance-edit.css">

        
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
                        <div class="sub-tab">
                            <div class="user-title">
                                <h2>CUSTOMER BALANCE</h2>
                            </div>
        
                            <div class="sub-tab2">
                                <div class="newUser-button">
                                    <button type="button" id="add-userbutton" class="add-customer" onclick="addnewuser();">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 14h1.5v-3.25H14v-1.5h-3.25V6h-1.5v3.25H6v1.5h3.25Zm.75 4q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                                        <h3>Add Balance</h3>
                                    </button>
                                </div>
                            </div>
                            <div class="search">
                                <div class="search-bar"> 
                                    <input text="text" placeholder="Search" onkeyup='tableSearch()' id="searchInput" name="searchInput"/>
                                    <button type="submit" >
                                        <svg id="search-icon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="m15.938 17-4.98-4.979q-.625.458-1.375.719Q8.833 13 8 13q-2.083 0-3.542-1.458Q3 10.083 3 8q0-2.083 1.458-3.542Q5.917 3 8 3q2.083 0 3.542 1.458Q13 5.917 13 8q0 .833-.26 1.583-.261.75-.719 1.375L17 15.938ZM8 11.5q1.458 0 2.479-1.021Q11.5 9.458 11.5 8q0-1.458-1.021-2.479Q9.458 4.5 8 4.5q-1.458 0-2.479 1.021Q4.5 6.542 4.5 8q0 1.458 1.021 2.479Q6.542 11.5 8 11.5Z"/></svg>
                                    </button>
                                </div>
                            </div>  
                        </div> 
                </div>
                <div class="main-container">
                        <div class="sub-tab-container">
                            
                                <div class="newUser-button3"> 
                                    <div id="add-userbutton" class="add-account1">
                                        <?php
                                        $total_customer_with_balance = "SELECT id
                                        FROM customers
                                        WHERE balance > 0";

                                        if($total_customer_with_balance_result = mysqli_query($con, $total_customer_with_balance))
                                        $rowcount = mysqli_num_rows($total_customer_with_balance_result);
                                        ?>
                                        <h3 class="deliveries">Customer With Balance</h3>
                                        <span class="total-deliveries"><?php echo $rowcount;?></span>
                                    </div>
                                </div>
                                <div class="newUser-button2"> 
                                    <div id="add-userbutton" class="add-account2">
                           
                                        <h3 class="deliveries">Customer With Credit</h3>
                                        <span class="total-deliveries"><?php echo $rowcount;?></span>
                                    </div>
                                </div>  
                                
                        </div>
                    </div>
                    
                    <div class="account-container" id="customerTable">
                            <br>
                            <header class="previous-transaction-header">List of Customers with Credit</header>
                            <hr>
                            <table class="table" id="myTable">
                            <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Address</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Credit</th>
                
                        </tr>
                        </thead>
                   
                            <tbody>
                                <tr>
                                    <td data-label="ID"></td>
                                    <td data-label="Customer Name"></td>
                                    <td data-label="Contact Number"></td>
                                    <td data-label="Address"></td>
                                    <td data-label="Balance"></td>
                                    <td data-label="Credit"></td>
                                </tr>
                            </tbody>
                            <tr id="noRecordTR">
                                <td colspan="6">No Transaction(s) Added</td>
                            </tr>
                            </table>
                        </div>
                        <div class="account-container" id="customerTable">
                            <br>
                            <header class="previous-transaction-header">List of Customer's Available Balance</header>
                            <hr>
                            <table class="table" id="myTable">
                            <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Contact Number</th>
                            <th scope="col">Address</th>
                            <th scope="col">Balance</th>
                            <th scope="col">Credit</th>
                
                        </tr>
                  
                            <tbody>
                                <tr>
                                    <td data-label="ID"> </td>
                                    <td data-label="Customer Name"> </td>
                                    <td data-label="Contact Number"> </td>
                                    <td data-label="Balance"> </td>
                                    <td data-label="Credit"> </td>
                                    <td>
                                       
                                    </td>
                                </tr>
                            </tbody>
                            <tr id="noRecordTR">
                                <td colspan="6">No Transaction(s) Added</td>
                            </tr>
                            </table>
                        </div>
            </main>
            <div class="top-menu">
                <div class="menu-bar">
                    <div class="menu-btn2">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h2 class="Title-top">MONITORING</h2>
                    <h4 class="subTitle-top">CUSTOMER BALANCE</h2>
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
        <?php if(isset($_GET['edit'])) { ?>
        <form action="" method="post" enctype="multipart/form-data" id="addcustomerFrm">
    <div class="bg-addcustomerform" id="bg-addform">
        <div class="message"></div>
        <div class="container1">
            <h1 class="addnew-title">EDIT BALANCE</h1>
            <form action="#">
                <div class="main-user-info">
                        <div class="customerName">
                            <label for="contact_num2">Customer Name</label>
                            <div class="usertype-dropdown">
                                <?php
                                $id = $_GET['edit'];
                                $dropdown_customers = "SELECT * FROM customers where id = '$id'";
                                $result_customers = mysqli_query($con, $dropdown_customers);
                                $customers = mysqli_fetch_assoc($result_customers);
                                ?>
                                <select id="chosen" class="select-customer" name="customername" required="" onchange="customerBal();">
                                        <option selected value="<?php echo $customers['id']?>">
                                            <?php echo $customers['customer_name'];?>                                        
                                        </option>
                                </select>
                            </div>
                        </div>
                    <div class="user-input-box" id="address-box">
                        <label for="balance">Advance Payment</label>
                        <input type="number" step=".01"
                               id="address" 
                               class="address"
                               required="required" 
                               name="balance" 
                               placeholder="0.00"
                               value = "<?php echo $customers['balance'];?>"/>
                    </div>
                    <div class="line"></div>

                    <div class="bot-buttons">
                        <div class="CancelButton">
                            <a href="../monitoring/monitoring-customer-balance.php" id="cancel">CANCEL</a>
                        </div>
                        <div class="AddButton">
                            <button type="submit" id="addcustomerBtn" name="edit-balance">SAVE</button>
                        </div>
                    </div>
                </div>
            </form>
            <?php }else{
           echo '<script> location.replace("../monitoring/monitoring-customer-balance.php"); </script>';
    } ?>
    </body>
</html>
<script>
    // -----------------------------SIDE MENU
    function addnewuser(){
    // const addBtn = document.querySelector(".add-customer");
const addForm = document.querySelector(".bg-addcustomerform");
    addForm.style.display = 'flex';
}
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
</script>
