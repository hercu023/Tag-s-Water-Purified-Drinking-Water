<?php
session_start();
require "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'EXPENSE';

if (isset($_POST['archive-expense'])) {
    if(isset($_POST['id'])){

        $user_id = $_SESSION['user_user_id'];
        $id = $_POST['id'];

        $result =mysqli_query($con, "UPDATE expense 
                                        SET status_archive_id = '2' 
                                        WHERE id = $id");
        if($result){
            log_audit($con, $user_id, $module, 1, 'Archived expense with id: '.$id);
            header("Location: ../expense/expense-success.php?archive_success=Expense Archived Successful");
        } else {
            log_audit($con, $user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=".mysqli_error($con));
        }
    }
}
