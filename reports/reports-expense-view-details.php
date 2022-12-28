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
                    <h2> Expenses Report for Date <?php echo $_GET['view']?></h2>
                </div>
                
                <div class="main-container">
                        <div class="sub-tab-container">
                            <div class="totals">
                            <div class="newUser-button1"> 
                                <div id="add-userbutton" class="add-account1">
                                <?php
                                    $date = $_GET['view'];
                                    $salary_count = "SELECT expense.id
                                    FROM expense
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    WHERE expense_type.name = 'Salary'
                                    AND expense.date = '$date'";

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
                                    $date = $_GET['view'];
                                    $utilities_count = "SELECT expense.id
                                    FROM expense
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    WHERE expense_type.name = 'Utilities'
                                    AND expense.date = '$date'";

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
                                    $date = $_GET['view'];
                                    $maintenance_count = "SELECT expense.id
                                    FROM expense
                                    INNER JOIN expense_type
                                    ON expense_type.id = expense.expense_type_id
                                    WHERE expense_type.name = 'Maintenance'
                                    AND expense.date = '$date'";

                                    if($maintenance_count_result = mysqli_query($con, $maintenance_count))
                                    $rowcount = mysqli_num_rows($maintenance_count_result);
                                    ?>
                                    <h3 class="deliveries">Maintenance Expense</h3>
                                    <span class="total-deliveries"><?php echo $rowcount;?></span>
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
                                     <?php echo 'PHP ' . $rows['amount']; ?>
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

    .total-deliveries{
        font-family: 'ARIAL', sans-serif;
        color: var(--color-main); 
        font-size: .9rem;
    }
    .total-transactions{
        font-family: 'ARIAL', sans-serif;
        font-weight: 900;
        color: var(--color-black); 
        font-size: 1rem;
    }

    .add-account1{
        display: flex;
        border: none;
        background-color: var(--color-background); 
        align-items: center;
        color: var(--color-button); 
        fill: var(--color-button); 
        width: 15rem;
        text-align: center;
        justify-content: center;
        height: 2rem;
        border-radius: 10px;
        padding: .68rem 1rem;
        font-family: 'Outfit', sans-serif;
        transition: all 300ms ease;
        position: relative; 
        margin-top: .2rem;
        text-transform: uppercase;
        border-bottom: 4px solid #8FBC8F;
    }

    .add-account1 h3{
        font-size: .8rem;
        margin-right: 1.5rem;
    }

    .add-account2{
        display: flex;
        border: none;
        background-color: var(--color-background); 
        align-items: center;
        color: var(--color-button); 
        fill: var(--color-button); 
        width: 15rem;
        text-align: center;
        justify-content: center;
        height: 2rem;
        border-radius: 10px;
        padding: .68rem 1rem;
        font-family: 'Outfit', sans-serif;
        transition: all 300ms ease;
        position: relative; 
        margin-top: .2rem;
        text-transform: uppercase;
        border-bottom: 4px solid #008B8B;
    }
    .add-account2 h3{
        font-size: .8rem;
        margin-right: 1.5rem;
    }
    .add-account3{
        display: flex;
        border: none;
        background-color: var(--color-background); 
        align-items: center;
        color: var(--color-black); 
        fill: var(--color-button); 
        width: 18rem;
        text-align: center;
        justify-content: center;
        height: 2rem;
        border-radius: 0px 0px 5px 5px;
        padding: .68rem 1rem;
        font-family: 'Outfit', sans-serif;
        transition: all 300ms ease;
        position: relative; 
        margin-top: .2rem;
        text-transform: uppercase;
        border-bottom: 7px solid #A9A9A9;
    }
    .add-account3 h3{
        font-weight: 900;
        font-size: .8rem;
        margin-right: 1.5rem;
    }
</style>