<?php
require_once '../database/connection-db.php';
require_once "../service/user-access.php";
require_once "../service/filter-reports-expense.php";

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
    <link rel="stylesheet" type="text/css" href="../CSS/reports-sales.css">
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/galhau-display" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/malberg-trial" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/rajdhani" rel="stylesheet">
    <title>Tag's Water Purified Drinking Water</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
</head>
<body>
<div class="container">
    <?php
    include('../common/side-menu.php')
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
                    <h2> Expense</h2>
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
                            <span class="span-from"> FROM:</span>
                            <input type="date" class="date" id="date-from" name="date-from" onchange="console.log(this.value);"/>
                            <span class="span-to"> TO:</span>
                            <input type="date" class="date" id="date-to" name="date-to" onchange="console.log(this.value);" />
                            <div class="newUser-button">
                                <div class="button1">
                                    <button type="submit" id="add-userbutton" class="add-account" name="filter-expense">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.5 16q-.208 0-.354-.146T9 15.5v-4.729L4.104 4.812q-.187-.25-.052-.531Q4.188 4 4.5 4h11q.312 0 .448.281.135.281-.052.531L11 10.771V15.5q0 .208-.146.354T10.5 16Zm.5-6.375L13.375 5.5H6.604Zm0 0Z"/></svg>
                                        <h3>Filter</h3>
                                    </button>
                                </div>
                                <div class="button2">
                                    <button type="print" id="print-report" class="print-report" onclick="print()">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M15 6H5V3h10Zm-.25 4.5q.312 0 .531-.219.219-.219.219-.531 0-.312-.219-.531Q15.062 9 14.75 9q-.312 0-.531.219Q14 9.438 14 9.75q0 .312.219.531.219.219.531.219Zm-1.25 5v-3h-7v3ZM15 17H5v-3H2V9q0-.833.583-1.417Q3.167 7 4 7h12q.833 0 1.417.583Q18 8.167 18 9v5h-3Z"/></svg>
                                        <h3>Print</h3>
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
                            <th>Date</th>
                            <th>Details</th>
                            <th>Description</th>
                            <th>Total Amount</th>
                        </tr>
                        </thead>

                        <?php
                        $query = "SELECT
                                    expense.date,
                                    SUM(expense.amount) as total
                                FROM expense 
                                WHERE expense.status_archive_id = 1
                                GROUP BY expense.date
                                ORDER BY expense.date DESC";

                        if (isset($_GET['from']) && isset($_GET['to'])) {
                            $from = $_GET['from'];
                            $to = $_GET['to'];
                            $query = "SELECT 
                                    expense.date,
                                    SUM(expense.amount) as total
                                FROM expense 
                                WHERE expense.status_archive_id = 1
                                AND expense.date BETWEEN '$from' AND '$to'
                                GROUP BY expense.date
                                ORDER BY expense.date ASC";
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
                                    <a href="../reports/reports-expense-view-details.php?view=<?php echo $rows['date']; ?>">
                                        <?php echo $rows['date']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="../reports/reports-expense-view-details.php?view=<?php echo $rows['date']; ?>"> 
                                        View Details 
                                    </a>
                                </td>
                                <td>
                                    <a href="../reports/reports-expense-view-details.php?view=<?php echo $rows['date']; ?>">
                                        <?php echo 'Expense Report Details For Date: '.$rows['date']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="../reports/reports-expense-view-details.php?view=<?php echo $rows['date']; ?>">
                                        <?php echo 'PHP '.$rows['total']; ?>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        <?php }} ?>
                    </table>
                </div>

            </div>
    </main>

    <?php
    include('../common/top-menu.php')
    ?>

</div>
</body>
</html>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/reports-sales.js"></script>
<script src="../index.js"></script>
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