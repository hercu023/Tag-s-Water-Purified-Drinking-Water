
<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'EXPENSE';

if (isset($_POST['add-expense'])) {
    if (isset($_POST['expense_types'])
        || isset($_POST['date'])
        || isset($_POST['amount'])
        || isset($_POST['description'])) {

        $user_id = $_SESSION['user_user_id'];

        $expense_type = $_POST['expense_types'];
        $date = $_POST['date'];

        $amount = filter_var($_POST['amount'], FILTER_SANITIZE_STRING);

        $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);

        $insert = mysqli_query($con, "INSERT INTO `expense` VALUES(
                             '',
                             '$expense_type',
                             '$date',
                             '$amount',
                             '$description',
                             '$user_id',
                              now(),
                             '$user_id',
                             now(),
                             1,
                             1)"
        );
        if ($insert) {
            log_audit($con, $user_id, $module, 1, 'Added new expense:[date='.$date.',expense_type='.$expense_type.',amount='.$amount.']');
            header("Location: ../expense/expense-success.php?success=Add New Expense Successful!");
        } else {
            log_audit($con, $user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=" . mysqli_error($con));
        }
    }
}

