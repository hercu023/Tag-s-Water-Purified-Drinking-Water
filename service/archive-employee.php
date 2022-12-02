<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'EMPLOYEE';

if (isset($_POST['archive-employee'])) {
    if(isset($_POST['id'])){

        $user_id = $_SESSION['user_user_id'];
        $employee_id = $_POST['id'];

        $result =mysqli_query($con, "UPDATE employee SET status_archive_id = '2' WHERE id = '$employee_id'");
        if($result){
            log_audit($con, $user_id, $module, 1, 'Archived employee with id: '.$employee_id);
            header("Location: ../employee/employee-success.php?archive_success=Employee Archived Successful");
        } else {
            log_audit($con, $user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=" . mysqli_error($con));
        }
    }
}
