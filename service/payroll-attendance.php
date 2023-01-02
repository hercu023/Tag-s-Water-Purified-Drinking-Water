<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";

$module = 'EMPLOYEE';
$user_user_id = $_SESSION['user_user_id'];

if(isset($_POST['payroll-attendance'])) {
    $id = $_POST['id'];
    process_payroll($con, $id, $module, $user_user_id);

    header("Location: ../employee/employee-attendance-success.php?success= Payroll Process Successful");
    exit();
}

if(isset($_POST['submit-payroll-attendance'])) {

    $all_id = $_POST['select-check'];
    $extract_id = implode(',' , $all_id);

    //validate if all ids are not yet processed for payroll
    $validate = mysqli_query($con, "SELECT * FROM attendance WHERE payroll_status = '1' AND id IN ($extract_id)");
    if (mysqli_num_rows($validate) > 0) {
        header("Location: ../employee/employee-attendance.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Please select only the unprocessed attendance records.");
        exit();
    }

    $count = count((array)$all_id);

    for ($index = 0; $index < $count; $index++) {
        $id = $all_id[$index];
        process_payroll($con, $id, $module, $user_user_id);
    }

    header("Location: ../employee/employee-attendance-success.php?success= Payroll Process Successful");
    exit();
}

function process_payroll($con, $id, $module, $user_user_id) {

    $result = mysqli_query($con, "SELECT * FROM attendance 
         INNER JOIN employee
         ON attendance.employee_id = employee.id
         WHERE attendance.id = '$id'");

    if (mysqli_num_rows($result) > 0) {

        $attendance = mysqli_fetch_assoc($result);

        //Validate payroll status if already processed.
        $payroll_status = $attendance['payroll_status'];
        if($payroll_status == 1) {
            header("Location: ../employee/employee-attendance.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Attendance record is already paid.");
            exit();
        }

        $expense_result = mysqli_query($con, "SELECT * FROM expense_type 
                                            WHERE name = 'Salary'");

        if (mysqli_num_rows($expense_result) > 0) {
            $expense_type = mysqli_fetch_assoc($expense_result);
            $expense_id = $expense_type['id'];

            $is_whole_day = $attendance['whole_day'];

            $daily_rate = $attendance['daily_rate'];

            if ($is_whole_day == 0) {
                $daily_rate = $daily_rate / 2;
            }

            $deduction = $attendance['deduction'];
            $bonus = $attendance['bonus'];
            $amount = ($daily_rate + $bonus) - $deduction;

            $employee_name = $attendance['first_name'].' '.$attendance['middle_name'].' '.$attendance['last_name'];
            $description = 'Payroll for ' .$employee_name. ', Date: '.$attendance['date']. ', Total Amount:' .$amount;

            $insert = mysqli_query($con, "INSERT INTO `expense` VALUES(
                             '',
                             '$expense_id',
                             now(),
                             '$amount',
                             '$description',
                             '$user_user_id',
                              now(),
                             '$user_user_id',
                             now(),
                             0,
                             1)");

            log_audit($con, $user_user_id, 'EXPENSE', 1, 'Added new expense:[date='.$attendance['date'].', expense_type='.$expense_id.', amount='.$amount.']');
            header("Location: ../expense/expense-success.php?success=Add New Expense Successful!");

            if($insert) {

                $update= mysqli_query($con, "UPDATE attendance 
                SET payroll_status = '1', 
                total_amount = '$amount'
                WHERE id = '$id'");

                if($update) {
                    log_audit($con, $user_user_id, $module, 1, 'Payroll Process for attendance with id:' .$id);
                } else {
                    log_audit($con, $user_user_id, $module, 0, 'Error processing database.');
                    header("Location: ../common/error-page.php?error=".mysqli_error($con));
                }
            } else {
                log_audit($con, $user_user_id, $module, 0, 'Error processing database.');
                header("Location: ../common/error-page.php?error=".mysqli_error($con));
            }
        } else {
            log_audit($con, $user_user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=".mysqli_error($con));
        }
    }


}