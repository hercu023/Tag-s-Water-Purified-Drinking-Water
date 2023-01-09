<?php
require_once '../database/connection-db.php';
require_once "../service/user-access.php";
require_once "../service/filter-reports.php";

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'REPORTS-INVENTORY')) {
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
    <link rel="stylesheet" type="text/css" href="../CSS/reports-sales.css">
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
                    $per_page_record = 2;
                    $page = 1;
                }

                if(isset($_GET['option']) && $_GET['option'] == "Daily") {
                    $query = "SELECT COUNT(*)
                    FROM inventory_log
                            WHERE action = 'IN'
                            GROUP BY DATE(inventory_log.created_at)
                            ORDER BY DATE(inventory_log.created_at) DESC";
                    $rs_result = mysqli_query($con, $query);     
                    $row = mysqli_fetch_row($rs_result);     
                    $page_location = '../reports/reports-inventory.php?option=Daily';
                    $total_records = mysqli_num_rows($rs_result); 
  
                } else if (isset($_GET['option']) && $_GET['option'] == "Monthly") {
                    $query = "SELECT COUNT(*)
                    FROM inventory_log
                            WHERE action = 'IN'
                            GROUP BY MONTH(inventory_log.created_at),
                            YEAR(inventory_log.created_at)
                            ORDER BY YEAR(inventory_log.created_at) DESC, 
                            MONTH(inventory_log.created_at) DESC";
                    $rs_result = mysqli_query($con, $query);     
                    $row = mysqli_fetch_row($rs_result);     
                    $page_location = '../reports/reports-inventory.php?option=Monthly';
                    $total_records = mysqli_num_rows($rs_result); 
                } else if(isset($_GET['option']) && $_GET['option'] == "Yearly") {
                    $query = "SELECT COUNT(*)
                    FROM inventory_log
                            WHERE action = 'IN'
                            GROUP BY YEAR(inventory_log.created_at)
                            ORDER BY YEAR(inventory_log.created_at) DESC";
                    $rs_result = mysqli_query($con, $query);     
                    $row = mysqli_fetch_row($rs_result);     
                    $page_location = '../reports/reports-inventory.php?option=Yearly';
                    $total_records = mysqli_num_rows($rs_result); 
                } else {
                    $total_records = 0;     
                }

                if (isset($_GET['from']) && isset($_GET['to'])) {
                    if(isset($_GET['option']) && $_GET['option'] == "Daily") {
                    $from = $_GET['from'];
                    $to = $_GET['to'];
                    $query = "SELECT
                                    DATE(inventory_log.created_at) as date,
                                    SUM(amount) as total
                                    FROM inventory_log
                                    WHERE action = 'IN'
                                    AND DATE(inventory_log.created_at) BETWEEN '$from' AND '$to'
                                    GROUP BY DATE(inventory_log.created_at)
                                    ORDER BY DATE(inventory_log.created_at) DESC";
                        $rs_result = mysqli_query($con, $query);     
                        $row = mysqli_fetch_row($rs_result);     
                        $page_location = '../reports/reports-inventory.php?option=Daily&from='.$from.'&to='.$to;
                        $total_records = mysqli_num_rows($rs_result);      
                    } 
                    
                }
                
                $start_from = ($page - 1) * $per_page_record;  
                    
            ?>
    <main>
        <div class="main-dashboard">
            <h1 class="dashTitle">REPORTS</h1>
            <?php
            if (isset($_GET['error'])) {
                echo '<p id="myerror" class="error-error" > '.$_GET['error'].' </p>';
            }
            ?>
            <div class="sub-tab">
                <div class="user-title">
                    <h2> INVENTORY</h2>
                </div>
                <div class="search">
                    <div class="search-bar">
                        <input text="text" placeholder="Search" onkeyup='tableSearch()' id="searchInput" name="searchInput"/>
                        <button type="submit" >
                            <svg id="search-icon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="m15.938 17-4.98-4.979q-.625.458-1.375.719Q8.833 13 8 13q-2.083 0-3.542-1.458Q3 10.083 3 8q0-2.083 1.458-3.542Q5.917 3 8 3q2.083 0 3.542 1.458Q13 5.917 13 8q0 .833-.26 1.583-.261.75-.719 1.375L17 15.938ZM8 11.5q1.458 0 2.479-1.021Q11.5 9.458 11.5 8q0-1.458-1.021-2.479Q9.458 4.5 8 4.5q-1.458 0-2.479 1.021Q4.5 6.542 4.5 8q0 1.458 1.021 2.479Q6.542 11.5 8 11.5Z"/></svg>
                        </button>
                    </div>
                </div>
                <div class="main-container">
                    <div class="sub-tab-container">
                        <form action="" method="post">
                            <div class="select-dropdown">
                                <select class="select" name="option" onchange="location = '../reports/reports-inventory.php?option=' + this.value;">
                                <option selected>Select Type</option>
                                    <option value="Daily" <?php if(isset($_GET['option']) && $_GET['option'] == "Daily") { echo 'selected'; }?>>Daily</option>
                                    <option value="Monthly" <?php if(isset($_GET['option']) && $_GET['option'] == "Monthly") { echo 'selected'; }?>>Monthly</option>
                                    <option value="Yearly" <?php if(isset($_GET['option']) && $_GET['option'] == "Yearly") { echo 'selected'; }?>>Yearly</option>
                                </select>
                            </div>
                            <span class="span-from"> FROM:</span>
                            <input type="date" class="date" id="date-from" name="date-from" onchange="console.log(this.value);" <?php if(isset($_GET['option']) && $_GET['option'] != 'Daily') { echo 'disabled=true';} ?>/>
                            <span class="span-to"> TO:</span>
                            <input type="date" class="date" id="date-to" name="date-to" onchange="console.log(this.value);" <?php if(isset($_GET['option']) && $_GET['option'] != 'Daily') { echo 'disabled=true';} ?>/>
                            <div class="newUser-button">
                                <div class="button1">
                                    <input type="hidden" name="module" value="inventory">
                                    <button type="submit" id="add-userbutton" class="add-account" name="filter-report">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.5 16q-.208 0-.354-.146T9 15.5v-4.729L4.104 4.812q-.187-.25-.052-.531Q4.188 4 4.5 4h11q.312 0 .448.281.135.281-.052.531L11 10.771V15.5q0 .208-.146.354T10.5 16Zm.5-6.375L13.375 5.5H6.604Zm0 0Z"/></svg>
                                        <h3>Filter</h3>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="customer-container">
                    <table class="table" id="myTable">
                        <thead>
                        <tr>
                            <?php
                            if(isset($_GET['option']) && $_GET['option'] == "Daily") {
                                echo "<th>Date</th>";
                            } else if (isset($_GET['option']) && $_GET['option'] == "Monthly") {
                                echo "<th>Month</th>";
                            } else {
                                echo "<th>Year</th>";
                            }
                            ?>
                            <th>Details</th>
                            <th>Description</th>
                            <th>Total Purchased Amount</th>
                        </tr>
                        </thead>

                        <?php
                        $query = "";
                        if(isset($_GET['option']) && $_GET['option'] == "Daily") {
                            $query = "SELECT
                            DATE(inventory_log.created_at) as date,
                            SUM(amount) as total
                            FROM inventory_log
                            WHERE action = 'IN'
                            GROUP BY DATE(inventory_log.created_at)
                            ORDER BY DATE(inventory_log.created_at) DESC
                            LIMIT $start_from, $per_page_record";
                        } else if (isset($_GET['option']) && $_GET['option'] == "Monthly") {
                            $query = "SELECT 
                            YEAR(inventory_log.created_at) AS year,
                            MONTHNAME(inventory_log.created_at) AS month,
                            SUM(inventory_log.amount) as total
                            FROM inventory_log
                            WHERE action = 'IN'
                            GROUP BY MONTH(inventory_log.created_at),
                            YEAR(inventory_log.created_at)
                            ORDER BY YEAR(inventory_log.created_at) DESC, 
                            MONTH(inventory_log.created_at) DESC
                            LIMIT $start_from, $per_page_record";
                        } else if(isset($_GET['option']) && $_GET['option'] == "Yearly") {
                            $query = "SELECT 
                            YEAR(inventory_log.created_at) AS year,
                            SUM(inventory_log.amount) as total
                            FROM inventory_log
                            WHERE action = 'IN'
                            GROUP BY YEAR(inventory_log.created_at)
                            ORDER BY YEAR(inventory_log.created_at) DESC
                            LIMIT $start_from, $per_page_record";
                        } 
                    
                        if (isset($_GET['from']) && isset($_GET['to'])) {
                            if(isset($_GET['option']) && $_GET['option'] == "Daily") {
                                $from = $_GET['from'];
                                $to = $_GET['to'];

                                $query = "SELECT
                                    DATE(inventory_log.created_at) as date,
                                    SUM(amount) as total
                                    FROM inventory_log
                                    WHERE action = 'IN'
                                    AND DATE(inventory_log.created_at) BETWEEN '$from' AND '$to'
                                    GROUP BY DATE(inventory_log.created_at)
                                    ORDER BY DATE(inventory_log.created_at) DESC
                                    LIMIT $start_from, $per_page_record";
                        
                            } 
                        }

                        if(isset($_GET['option']) && $_GET['option'] != 'Select Type') {

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
                                    <?php if(isset($_GET['option']) && $_GET['option'] == "Daily") { ?>
                                        <?php echo $rows['date']; ?>
                                    <?php } else if (isset($_GET['option']) && $_GET['option'] == "Monthly") { ?>
                                        <?php echo $rows['month'].' '.$rows['year']; ?>
                                    <?php } else { ?>
                                        <?php echo $rows['year']; ?>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if(isset($_GET['option']) && $_GET['option'] == "Daily") { ?>
                                            <a href="../reports/reports-inventory-view-details.php?view=<?php echo $rows['date']; ?>">
                                                View Details 
                                            </a>
                                    <?php } else if (isset($_GET['option']) && $_GET['option'] == "Monthly") { ?>
                                            <a href="../reports/reports-inventory-view-details.php?month=<?php echo $rows['month'].'&year='.$rows['year']; ?>">
                                                View Details 
                                            </a>
                                    <?php } else { ?>
                                            <a href="../reports/reports-inventory-view-details.php?year=<?php echo $rows['year'];?>">
                                                View Details 
                                            </a>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if(isset($_GET['option']) && $_GET['option'] == "Daily") { ?>
                                        <?php echo 'Inventory Report Details For Date: '.$rows['date']; ?>
                                    <?php } else if (isset($_GET['option']) && $_GET['option'] == "Monthly") { ?>
                                        <?php echo 'Inventory Report Details For The Month: '.$rows['month'].' '.$rows['year']; ?>
                                    <?php } else { ?>
                                        <?php echo 'Inventory Report Details For Year: '.$rows['year']; ?>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php echo 'PHP '.$rows['total']; ?>
                                </td>
                            </tr>
                            </tbody>
                        <?php }}} ?>
                    </table>
                </div>

            </div>

            <div class="pagination">   
            <br>
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


                <br><br>
                <select name="option" onchange="location ='<?php echo $page_location ?>' + '&page=1&records=' + this.value;">
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
           

            <div></div>

            <div class="inline">   
                <input id="page" type="number" min="1" max="<?php echo $total_pages?>"   
                placeholder="<?php echo $page."/".$total_pages; ?>" required> 

                <button onClick="goToPage('<?php echo $page_location.'&records='.$per_page_record?>');">Go to page</button>   
            </div>    
            <?php }?>
    </main>

    <?php
    include('../common/top-menu.php')
    ?>

</div>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/reports-sales.js"></script>
<script src="../javascript/reports-inventory-search.js"></script>
<script src="../index.js"></script>
<script>
    function goToPage(reference) {   
    var page = document.getElementById("page").value;   
    page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
    window.location.href = reference + '&page=' + page;   
} 
</script>
<style>
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
</style>