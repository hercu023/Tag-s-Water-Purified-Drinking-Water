<?php
require_once '../database/connection-db.php';
require_once "../service/user-access.php";
require_once "../service/filter-reports.php";

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'REPORTS-EXPENSE')) {
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
    <link rel="stylesheet" type="text/css" href="../CSS/reports-viewdetails.css">
    <link rel="stylesheet" type="text/css" href="../CSS/pagination.css">
    <title>Tag's Water Purified Drinking Water</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    
</head>
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
                    $per_page_record = 10;
                    $page = 1;
                }

                if(isset($_GET['view']) && !isset($_GET['month']) && !isset($_GET['year'])) {
                    $date = $_GET['view'];
                            $query = "SELECT 
                                    expense.date,
                                    expense_type.name,
                                    expense.description,
                                    expense.amount,
                                    users.first_name,
                                    users.last_name,
                                    expense.date_created
                                    FROM expense 
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    INNER JOIN users
                                    ON users.user_id = expense.added_by
                                    WHERE expense.status_archive_id = 1
                                    and date = '$date'
                                    ORDER BY expense.date DESC";

                        $rs_result = mysqli_query($con, $query);     
                        $row = mysqli_fetch_row($rs_result);     
                        $page_location = '../reports/reports-expense-view-details.php?view='.$date;
                        $total_records = mysqli_num_rows($rs_result); 
                } else if (!isset($_GET['view']) && isset($_GET['month']) && isset($_GET['year'])) {
                    $month = $_GET['month'];
                            $year = $_GET['year'];
                            $query = "SELECT 
                                    expense.date,
                                    expense_type.name,
                                    expense.description,
                                    expense.amount,
                                    users.first_name,
                                    users.last_name,
                                    expense.date_created
                                    FROM expense 
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    INNER JOIN users
                                    ON users.user_id = expense.added_by
                                    WHERE expense.status_archive_id = 1
                                    AND MONTHNAME(expense.date) = '$month'
                                    AND YEAR(expense.date) = '$year'
                                    ORDER BY expense.date DESC";

                            $rs_result = mysqli_query($con, $query);     
                            $row = mysqli_fetch_row($rs_result);     
                            $page_location = '../reports/reports-expense-view-details.php?month='.$month.'&year='.$year;
                            $total_records = mysqli_num_rows($rs_result); 

                } else if (!isset($_GET['view']) && !isset($_GET['month']) && isset($_GET['year'])) {
                    $year = $_GET['year'];
                            $query = "SELECT 
                                    expense.date,
                                    expense_type.name,
                                    expense.description,
                                    expense.amount,
                                    users.first_name,
                                    users.last_name,
                                    expense.date_created
                                    FROM expense 
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    INNER JOIN users
                                    ON users.user_id = expense.added_by
                                    WHERE expense.status_archive_id = 1
                                    AND YEAR(expense.date) = '$year'
                                    ORDER BY expense.date DESC";

                             $rs_result = mysqli_query($con, $query);     
                             $row = mysqli_fetch_row($rs_result);     
                             $page_location = '../reports/reports-expense-view-details.php?year='.$year;
                             $total_records = mysqli_num_rows($rs_result); 
                } else {
                    $total_records = 0;     
                }
 
                $start_from = ($page - 1) * $per_page_record;  
                    
            ?>
    <main>
            <div class="header-title">
                <h1 class="addnew-title">TAG'S WATER</h1>
                <h1 class="addnew-title">PURIFIED DRINKING WATER</h1>
                <p class="address">17 M. Santos St., Brgy. San Jose, Antipolo City<p>
            </div>
        <div class="main-dashboard">
            <h1 class="dashTitle">REPORTS</h1>
            <?php
            if (isset($_GET['error'])) {
                echo '<p id="myerror" class="error-error" > '.$_GET['error'].' </p>';
            }
            ?>
            <div class="sub-tab">
                <div class="user-title">
                    <h2> EXPENSES REPORT </h2>
                </div>
                <?php if(isset($_GET['view']) && !isset($_GET['month']) && !isset($_GET['year'])) { ?>
                    <h3 class="for-date"> For Date <h2 class="date"><?php echo $_GET['view']?></h3></h2>

                <?php } else if (!isset($_GET['view']) && isset($_GET['month']) && isset($_GET['year'])) { ?>
                    <h3 class="for-date"> For Month <h2 class="date"><?php echo $_GET['month'] .' '. $_GET['year']?></h3></h2>

                <?php } else if (!isset($_GET['view']) && !isset($_GET['month']) && isset($_GET['year'])) { ?>
                    <h3 class="for-date"> For Year <h2 class="date"><?php echo $_GET['year']?></h3></h2>

                <?php } else { echo '<script> location.replace("../reports/reports-expense.php"); </script>'; } ?>
                
                <div class="main-container">
                        <div class="sub-tab-container">
                            <div class="totals">
                            <div class="newUser-button1"> 
                                <div id="add-userbutton" class="add-account1">
                            <?php
                                $salary_count = "";
                                if(isset($_GET['view']) && !isset($_GET['month']) && !isset($_GET['year'])) {
                                    $date = $_GET['view'];
                                    $salary_count = "SELECT expense.id
                                    FROM expense
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    WHERE expense_type.name = 'Salary'
                                    AND expense.date = '$date'";
                                } else if (!isset($_GET['view']) && isset($_GET['month']) && isset($_GET['year'])) {
                                    $month = $_GET['month'];
                                    $year = $_GET['year'];
                                    $salary_count = "SELECT expense.id
                                    FROM expense
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    WHERE expense_type.name = 'Salary'
                                    AND MONTHNAME(expense.date) = '$month'
                                    AND YEAR(expense.date) = '$year'";
                                } else if (!isset($_GET['view']) && !isset($_GET['month']) && isset($_GET['year'])) {
                                    $year = $_GET['year'];
                                    $salary_count = "SELECT expense.id
                                    FROM expense
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    WHERE expense_type.name = 'Salary'
                                    AND YEAR(expense.date) = '$year'";
                                } else {
                                    echo '<script> location.replace("../reports/reports-expense.php"); </script>';
                                }
                                    

                                    if($salary_count_result = mysqli_query($con, $salary_count))
                                    $rowcount = mysqli_num_rows($salary_count_result);
                                    ?>
                                    <h3 class="deliveries">Salary Expense</h3>
                                    <span class="total-deliveries"><?php echo $rowcount;?></span>
                                </div>
                            </div>
                            <div class="newUser-button2"> 
                                <div id="add-userbutton" class="add-account2">
                                <?php
                                $utilities_count = "";
                                if(isset($_GET['view']) && !isset($_GET['month']) && !isset($_GET['year'])) {
                                    $date = $_GET['view'];
                                    $utilities_count = "SELECT expense.id
                                    FROM expense
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    WHERE expense_type.name = 'Utilities'
                                    AND expense.date = '$date'";
                                } else if (!isset($_GET['view']) && isset($_GET['month']) && isset($_GET['year'])) {
                                    $month = $_GET['month'];
                                    $year = $_GET['year'];
                                    $utilities_count = "SELECT expense.id
                                    FROM expense
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    WHERE expense_type.name = 'Utilities'
                                    AND MONTHNAME(expense.date) = '$month'
                                    AND YEAR(expense.date) = '$year'";
                                } else if (!isset($_GET['view']) && !isset($_GET['month']) && isset($_GET['year'])) {
                                    $year = $_GET['year'];
                                    $utilities_count = "SELECT expense.id
                                    FROM expense
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    WHERE expense_type.name = 'Utilities'
                                    AND YEAR(expense.date) = '$year'";
                                } else {
                                    echo '<script> location.replace("../reports/reports-expense.php"); </script>';
                                }
                                    if($utilities_count_result = mysqli_query($con, $utilities_count))
                                    $rowcount = mysqli_num_rows($utilities_count_result);
                                    ?>
                                    <h3 class="deliveries">Utilities Expense</h3>
                                    <span class="total-deliveries"><?php echo $rowcount;?></span>
                                </div>
                            </div>  
                            <div class="newUser-button3"> 
                                <div id="add-userbutton" class="add-account3">
                                <?php
                                $maintenance_count = "";
                                if(isset($_GET['view']) && !isset($_GET['month']) && !isset($_GET['year'])) {
                                    $date = $_GET['view'];
                                    $maintenance_count = "SELECT expense.id
                                    FROM expense
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    WHERE expense_type.name = 'Maintenance'
                                    AND expense.date = '$date'";

                                } else if (!isset($_GET['view']) && isset($_GET['month']) && isset($_GET['year'])) {
                                    $month = $_GET['month'];
                                    $year = $_GET['year'];
                                    $maintenance_count = "SELECT expense.id
                                    FROM expense
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    WHERE expense_type.name = 'Maintenance'
                                    AND MONTHNAME(expense.date) = '$month'
                                    AND YEAR(expense.date) = '$year'";

                                } else if (!isset($_GET['view']) && !isset($_GET['month']) && isset($_GET['year'])) {
                                    $year = $_GET['year'];
                                    $maintenance_count = "SELECT expense.id
                                    FROM expense
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    WHERE expense_type.name = 'Maintenance'
                                    AND YEAR(expense.date) = '$year'";
                                } else {
                                    echo '<script> location.replace("../reports/reports-expense.php"); </script>';
                                }
                                    if($maintenance_count_result = mysqli_query($con, $maintenance_count))
                                    $rowcount = mysqli_num_rows($maintenance_count_result);
                                    ?>
                                    <h3 class="deliveries">Maintenance Expense</h3>
                                    <span class="total-deliveries"><?php echo $rowcount;?></span>
                                </div>
                            </div>  
                            <div class="newUser-button4"> 
                                <div id="add-userbutton" class="add-account4">
                                <?php
                                $other_expenses_count = "";
                                if(isset($_GET['view']) && !isset($_GET['month']) && !isset($_GET['year'])) {
                                    $date = $_GET['view'];
                                    $other_expenses_count = "SELECT expense.id
                                    FROM expense
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    WHERE expense_type.name = 'Other Expenses'
                                    AND expense.date = '$date'";
                                } else if (!isset($_GET['view']) && isset($_GET['month']) && isset($_GET['year'])) {
                                    $month = $_GET['month'];
                                    $year = $_GET['year'];
                                    $other_expenses_count = "SELECT expense.id
                                    FROM expense
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    WHERE expense_type.name = 'Other Expenses'
                                    AND MONTHNAME(expense.date) = '$month'
                                    AND YEAR(expense.date) = '$year'";
                                } else if (!isset($_GET['view']) && !isset($_GET['month']) && isset($_GET['year'])) {
                                    $year = $_GET['year'];
                                    $other_expenses_count = "SELECT expense.id
                                    FROM expense
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    WHERE expense_type.name = 'Other Expenses'
                                    AND YEAR(expense.date) = '$year'";
                                } else {
                                    echo '<script> location.replace("../reports/reports-expense.php"); </script>';
                                }
                                    if($other_expenses_count_result = mysqli_query($con, $other_expenses_count))
                                    $rowcount = mysqli_num_rows($other_expenses_count_result);
                                    ?>
                                    <h3 class="deliveries">Other Expense</h3>
                                    <span class="total-deliveries"><?php echo $rowcount;?></span>
                                </div>
                            </div>  
                            <div class="bot-buttons">
                                <div class="AddButton1">
                                    <button type="submit" onclick="print();" id="addcustomerBtn">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M15 6H5V3h10Zm-.25 4.5q.312 0 .531-.219.219-.219.219-.531 0-.312-.219-.531Q15.062 9 14.75 9q-.312 0-.531.219Q14 9.438 14 9.75q0 .312.219.531.219.219.531.219Zm-1.25 5v-3h-7v3ZM15 17H5v-3H2V9q0-.833.583-1.417Q3.167 7 4 7h12q.833 0 1.417.583Q18 8.167 18 9v5h-3Z"/></svg>
                                        PRINT
                                    </button>
                                </div>
                            </div>
                        </div>
                        </div>
                </div>
                <div class="customer-container">
                    <table class="table" id="myTable">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Amount</th>
                            <th>Created By</th>
                            <th>Date/Time Added</th>
                        </tr>
                        </thead>

                        <?php
                        $query = "";
                        if(isset($_GET['view']) && !isset($_GET['month']) && !isset($_GET['year'])) {
                            $date = $_GET['view'];
                            $query = "SELECT 
                                    expense.date,
                                    expense_type.name,
                                    expense.description,
                                    expense.amount,
                                    users.first_name,
                                    users.last_name,
                                    expense.date_created
                                    FROM expense 
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    INNER JOIN users
                                    ON users.user_id = expense.added_by
                                    WHERE expense.status_archive_id = 1
                                    and date = '$date'
                                    ORDER BY expense.date DESC
                                    LIMIT $start_from, $per_page_record";
                        } else if (!isset($_GET['view']) && isset($_GET['month']) && isset($_GET['year'])) {
                            $month = $_GET['month'];
                            $year = $_GET['year'];
                            $query = "SELECT 
                                    expense.date,
                                    expense_type.name,
                                    expense.description,
                                    expense.amount,
                                    users.first_name,
                                    users.last_name,
                                    expense.date_created
                                    FROM expense 
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    INNER JOIN users
                                    ON users.user_id = expense.added_by
                                    WHERE expense.status_archive_id = 1
                                    AND MONTHNAME(expense.date) = '$month'
                                    AND YEAR(expense.date) = '$year'
                                    ORDER BY expense.date DESC
                                    LIMIT $start_from, $per_page_record";
                        } else if (!isset($_GET['view']) && !isset($_GET['month']) && isset($_GET['year'])) {
                            $year = $_GET['year'];
                            $query = "SELECT 
                                    expense.date,
                                    expense_type.name,
                                    expense.description,
                                    expense.amount,
                                    users.first_name,
                                    users.last_name,
                                    expense.date_created
                                    FROM expense 
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    INNER JOIN users
                                    ON users.user_id = expense.added_by
                                    WHERE expense.status_archive_id = 1
                                    AND YEAR(expense.date) = '$year'
                                    ORDER BY expense.date DESC
                                    LIMIT $start_from, $per_page_record";
                        } else {
                            echo '<script> location.replace("../reports/reports-expense.php"); </script>';
                        }
                        
                        $result = mysqli_query($con, $query);

                        if(mysqli_num_rows($result) <= 0) { ?>
                        <tbody>
                        <tr id="noRecordTR">
                                <td colspan="4">No Record Found</td>
                        </tr>
                        </tbody>
                        <?php } else {
                            while ($rows = mysqli_fetch_assoc($result)) { ?>
                            <tbody>
                            <tr>
                                <td>
                                    <?php echo $rows['date']; ?>
                                </td>
                                <td>
                                     <?php echo $rows['name']; ?>
                                </td>
                                <td>
                                    <?php echo $rows['description']; ?>
                                </td>
                                <td>
                                     <?php echo '&#8369 ' . $rows['amount']; ?>
                                </td>
                                <td>
                                    <?php echo $rows['first_name'] .' '. $rows['last_name']; ?>
                                </td>
                                <td>
                                     <?php echo $rows['date_created']; ?>
                                </td>
                               
                            </tr>
                            </tbody>
                        <?php }} ?>
                    </table>
                </div>
            </div>
            <div class="header-title">
                <p class="address">CREATED BY: <?php echo ' '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name']; ?><p>
                <p class="address">DATE: <?php echo date("F j, Y")?> - TIME:<?php echo date("h-i-s-A")?><p>
            </div>

           
            <div class="pagination">   
                    <div class="page-navigation">
                    <div class="href-pages">  
                <?php  
                if($total_records > 0) {

                    // Number of pages required.   
                    $total_pages = ceil($total_records / $per_page_record);     
                    $pageLink = "";       
                    if($page>=2){   
                        echo "<a href='".$page_location."&page=".($page-1)."&records=".$per_page_record."'> Prev </a>";   
                    }       
                            
                    for ($i=1; $i<=$total_pages; $i++) {   
                    if ($i == $page) {   
                        $pageLink .= "<a class = 'active' href='".$page_location."&page=".$i."&records=".$per_page_record."'>".$i." </a>";   
                    }               
                    else  {   
                        $pageLink .= "<a href='".$page_location."&page=".$i."&records=".$per_page_record."'>".$i." </a>";     
                    }   
                    }; 

                    echo $pageLink;   

                    if($page<$total_pages){   
                        echo "<a href='".$page_location."&page=".($page + 1)."&records=".$per_page_record."'>  Next </a>";   
                    }  
               

                ?>

                </div>
                <div class="dropdown-pages">   
                    <select name="option" class="pages" onchange="location ='<?php echo $page_location ?>' + '&page=1&records=' + this.value;">
                            <option value="5" <?php if($per_page_record == "5") { echo 'selected'; }?>>5</option>
                            <option value="10" <?php if($per_page_record == "10") { echo 'selected'; }?>>10</option>
                            <option value="50" <?php if($per_page_record == "50") { echo 'selected'; }?>>50</option>
                            <option value="100" <?php if($per_page_record == "100") { echo 'selected'; }?>>100</option>
                            <option value="250" <?php if($per_page_record == "250") { echo 'selected'; }?>>250</option>
                            <option value="500" <?php if($per_page_record == "500") { echo 'selected'; }?>>500</option>
                            <option value="1000" <?php if($per_page_record == "1000") { echo 'selected'; }?>>1000</option>
                    </select>
                    <span class="label-number"> No. of Records Per Page </span>  

                </div>
                
           


            <div class="inline">   
                        <input id="page" type="number" class="input-pages" min="1" max="<?php echo $total_pages?>"   
                        placeholder="<?php echo $page." - ".$total_pages; ?>" required> 

                        <button class="gotopage-btn" onClick="goToPage('<?php echo $page_location.'?records='.$per_page_record?>');">Go to page</button>   
                    </div>  
            </div>
                     
            <?php }?>
                   
    </main>
    <div class="top-menu">
                <div class="menu-bar">
                    <div class="menu-btn2">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h2 class="Title-top">REPORTS</h2>
                    <h4 class="subTitle-top">EXPENSES REPORT</h2>
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
</html>
<script>
    function goToPage(reference) {   
    var page = document.getElementById("page").value;   
    page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
    window.location.href = reference + '&page=' + page;   
} 
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/reports-sales.js"></script>
