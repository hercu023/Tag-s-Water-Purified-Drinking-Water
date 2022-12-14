<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'EMPLOYEE';

if (isset($_POST['edit-employee-attendance'])) {
    if (isset($_POST['employee_id'])
        || isset($_POST['date_of_attendance'])
        || isset($_POST['time_in'])
        || isset($_POST['time_out'])
        || isset($_POST['deduction'])
        || isset($_POST['additional_bonus'])
        || isset($_POST['note'])
        || isset($_POST['is_whole_day'])) {

        $user_id = $_SESSION['user_user_id'];

        $attendance_id = $_POST['id'];
        $payroll_status = $_POST['payroll_status'];

        $employee_id = $_POST['employee_id'];
        $date_of_attendance = $_POST['date_of_attendance'];
        $time_in = $_POST['time_in'];
        $time_out = $_POST['time_out'];

        $deduction = filter_var($_POST['deduction'], FILTER_SANITIZE_STRING);
        $additional_bonus = filter_var($_POST['additional_bonus'], FILTER_SANITIZE_STRING);
        $note = filter_var($_POST['note'], FILTER_SANITIZE_STRING);

        $is_whole_day = $_POST['is_whole_day'];

        $date_input = new DateTime($date_of_attendance);
        $current_date = new DateTime();

        if ($date_input > $current_date)
        {
            header("Location: ../employee/employee-attendance.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Error: Date of attendance cannot be a future date.");
            exit();
        }

        if ($payroll_status == 1) {
            header("Location: ../employee/employee-attendance.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Error: Can not modify attendance with already processed payroll");
            exit();
        }

        $check_query = mysqli_query($con, "SELECT * FROM `attendance` 
                                        WHERE employee_id = '$employee_id'
                                        AND date = '$date_of_attendance'
                                        AND id != '$attendance_id'");

        if (mysqli_num_rows($check_query) > 0) {
            log_audit($con, $user_id, $module, 0, 'Date of attendance with the same employee already exist');
            header("Location: ../employee/employee-attendance.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Date of attendance for employee already exist!");
        } else {

            $is_whole_day_value = 0;
            if ($is_whole_day === 'YES') {
                $is_whole_day_value = 1;
            }

            $update = mysqli_query($con, "UPDATE `attendance` SET
                             whole_day='$is_whole_day_value',
                             date='$date_of_attendance',
                             time_in='$time_in',
                             time_out='$time_out',
                             deduction='$deduction',
                             bonus='$additional_bonus',
                             note='$note',
                             updated_by='$user_id',
                             date_updated=now()
                             WHERE id = $attendance_id
                             ");

            if ($update) {
                log_audit($con, $user_id, $module, 1, 'Edited attendance with details[employee_id ='.$employee_id.','.$date_of_attendance.']');
                header("Location: ../employee/employee-attendance-success.php?success=Edit Attendance Successful!");
            } else {
                log_audit($con, $user_id, $module, 0, 'Error processing database.');
                header("Location: ../common/error-page.php?error=" . mysqli_error($con));
            }
        }
    }
}