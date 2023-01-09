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
        $total_pay = 0;

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

            //Validate if Time IN is later than Time OUT
            if ($time_in > $time_out) {
                header("Location: ../employee/employee-attendance.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> TIME IN not valid. Must be earlier than TIME OUT entry");
                exit();
            } 
            
            $payroll_settings = mysqli_query($con, "SELECT * FROM `payroll_settings` 
                                        WHERE feature = 'payroll'");

            if(mysqli_num_rows($payroll_settings) > 0) {
                $settings_data = mysqli_fetch_assoc($payroll_settings);
                $grace_period = $settings_data['grace_period'];
                $late_deduction_per_min = $settings_data['late_deduction_per_min'];
                $time_in_schedule = $settings_data['time_in_schedule'];
                $overtime_bonus_per_hour = $settings_data['overtime_bonus_per_hour'];

                $employee_data = mysqli_query($con, "SELECT * FROM employee
                    WHERE id = '$employee_id'");
                if(mysqli_num_rows($employee_data) > 0) {
                    $hourly_rate = mysqli_fetch_assoc($employee_data)['hourly_rate'];

                    //Get rendered hours
                    $time1 = strtotime($time_in);
                    $time2 = strtotime($time_out);

                    //Get rendered time. succeeding minutes are not counted only HOURS
                    $rendered_time_in_hours= floor(abs($time2 - $time1) / 3600);

                    $regular_hour_pay = 0;
                    $overtime_pay = 0.00;
                    if ($rendered_time_in_hours >= 9) {
                        $regular_hour_pay = 8 * $hourly_rate;
                        $overtime_hours = $rendered_time_in_hours - 9;
                        $overtime_pay = $overtime_hours * $overtime_bonus_per_hour;
                    } else if ($rendered_time_in_hours < 9) {
                        $regular_hour_pay = $rendered_time_in_hours * $hourly_rate;
                    }
                   
                    $late_deduction = 0.00;
                    //Validate if time is is late if Time IN exceed the Time IN Schedule and Grace Period
                    if ($time_in > $time_in_schedule && $time_in > $grace_period) {
                        $time1 = strtotime($time_in);
                        $time2 = strtotime($time_in_schedule);
                        $difference_in_minute = ($time1 - $time2) / 60;

                        //Compute for late deduction
                        $late_deduction = $difference_in_minute * $late_deduction_per_min;
                    }

                    $note = $note .PHP_EOL.''.PHP_EOL.
                            'Regular Pay: '.$regular_hour_pay .PHP_EOL.
                            'Overtime: '.$overtime_pay .PHP_EOL.
                            'Late Deduction: '.$late_deduction .PHP_EOL;

                    $total_pay = ($regular_hour_pay + $overtime_pay) - $late_deduction;
                    $total_pay = ($total_pay + $additional_bonus) - $deduction;

                } else {
                    header("Location: ../employee/employee-attendance.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Can't retrieve employee data. Try again.");
                    exit();
                }
                
            } else {
                header("Location: ../employee/employee-attendance.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Can't retrieve payroll settings. Try again.");
                exit();
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
                             '$total_pay',
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