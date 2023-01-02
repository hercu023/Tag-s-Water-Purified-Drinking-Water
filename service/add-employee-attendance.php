<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'EMPLOYEE';

if (isset($_POST['add-employee-attendance'])) {
    if (isset($_POST['employee_id'])
        || isset($_POST['date_of_attendance'])
        || isset($_POST['time_in'])
        || isset($_POST['time_out'])
        || isset($_POST['deduction'])
        || isset($_POST['additional_bonus'])
        || isset($_POST['note'])
        || isset($_POST['is_whole_day'])) {

        $user_id = $_SESSION['user_user_id'];

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

        $check_query = mysqli_query($con, "SELECT * FROM `attendance` 
                                        WHERE employee_id = '$employee_id'
                                        AND date = '$date_of_attendance'
                                        AND status_archive_id = '1'");

        if (mysqli_num_rows($check_query) > 0) {
            log_audit($con, $user_id, $module, 0, 'Date of attendance with the same employee already exist');
            header("Location: ../employee/employee-attendance.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Date of attendance for employee already exist!");
            exit();
        } else {

            $is_whole_day_value = 0;
            if ($is_whole_day == 'Yes') {
                $is_whole_day_value = 1;
            }

            $insert = mysqli_query($con, "INSERT INTO `attendance` VALUES(
                             '',
                             '$employee_id',
                             '$is_whole_day_value',
                             '$date_of_attendance',
                             '$time_in',
                             '$time_out',
                             '$deduction',
                             '$additional_bonus',
                             '$note',
                             '0',
                             '0',
                             '$user_id',
                             now(),
                             '$user_id',
                             now(),
                             '1')
                             ");
            if ($insert) {
                log_audit($con, $user_id, $module, 1, 'Added new attendance with details: employee_id ='.$employee_id.','.$date_of_attendance);
                header("Location: ../employee/employee-attendance-success.php?success= Add New Attendance Successful!");
                exit();
            } else {
                log_audit($con, $user_id, $module, 0, 'Error adding new attendance on database.');
                header("Location: ../employee/employee-attendance.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed adding attendance record in database. Try again.");
                exit();
            }

        }
    }
}