<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'EMPLOYEE';

if (isset($_POST['archive-employee-attendance'])) {
    if(isset($_POST['id'])){

        $user_id = $_SESSION['user_user_id'];
        $attendance_id = $_POST['id'];

        //Validate if attendance is already paid
        $check_query = mysqli_query($con, "SELECT * FROM `attendance` 
                                        WHERE payroll_status = 1 
                                        AND id = $attendance_id");

        if (mysqli_num_rows($check_query) > 0) {
            log_audit($con, $user_id, $module, 0, 'Cannot archive already processed attendance.');
            header("Location: ../employee/employee-attendance.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Cannot archive already processed attendance!");
            exit();
        }

        $result =mysqli_query($con, "UPDATE attendance SET status_archive_id = '2' WHERE id = '$attendance_id'");

        if($result){
            log_audit($con, $user_id, $module, 1, 'Archived attendance with id: '.$attendance_id);
            header("Location: ../employee/employee-attendance-success.php?archive_success=Attendance Archived Successful");
        } else {
            log_audit($con, $user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=" . mysqli_error($con));
        }
    }
}
