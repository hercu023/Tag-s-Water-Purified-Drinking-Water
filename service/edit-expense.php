<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'EXPENSE';

if (isset($_POST['edit-expense'])) {
    if (isset($_POST['expense_types'])
        || isset($_POST['date'])
        || isset($_POST['amount'])
        || isset($_POST['description'])) {

        $user_id = $_SESSION['user_user_id'];

        $expense_id = $_POST['id'];

        $expense_type = $_POST['expense_types'];
        $date = $_POST['date'];

        $amount = filter_var($_POST['amount'], FILTER_SANITIZE_STRING);

        $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);

        $select = mysqli_query($con, "SELECT is_editable from expense
                              WHERE id = '$expense_id'");

        if(mysqli_num_rows($select) > 0) {
            $result = mysqli_fetch_assoc($select);

            if($result['is_editable'] == 0) {
                log_audit($con, $user_id, $module, 9, 'Expense cannot be modified with id:' .$expense_id);
                header("Location: ../expense/expense.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> This expense is not modifiable.");
            } else {

                $update =mysqli_query($con, "UPDATE expense SET 
                     expense_type_id = '$expense_type',
                     date='$date',
                     amount='$amount',
                     description='$description',
                     updated_by='$user_id',
                     date_updated=now()
                 WHERE id='$expense_id'");

                if($update){
                    log_audit($con, $user_id, $module, 1, 'Updated expense with id:' .$expense_id);
                    header("Location: ../expense/expense-success.php?success=Update Expense Successful!");
                } else {
                    log_audit($con, $user_id, $module, 0, 'Error processing database.');
                    header("Location: ../common/error-page.php?error=" . mysqli_error($con));
                }
            }
        }
    }
}
