<?php
session_start();
require "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'EXPENSE';

if (isset($_POST['archive-expense'])) {
    if(isset($_POST['id'])){

        $user_id = $_SESSION['user_user_id'];
        $id = $_POST['id'];

        //Check if the expense record is editable or can be archived
        $select = mysqli_query($con, "SELECT * FROM expense 
                            WHERE is_editable = 0
                            AND id = $id");

        if (mysqli_num_rows($select) > 0) {
            header("Location: ../expense/expense.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> This expense record can not be archived.");
            exit();
        }

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
