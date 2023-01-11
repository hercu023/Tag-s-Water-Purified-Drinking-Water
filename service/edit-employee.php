<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'EMPLOYEE';

if (isset($_POST['edit-employee'])) {
    if (isset($_POST['first_name'])
        || isset($_POST['last_name'])
        || isset($_POST['middle_name'])
        || isset($_POST['position_types'])
        || isset($_POST['date_of_birth'])
        || isset($_POST['hourly_rate'])
        || isset($_POST['email'])
        || isset($_POST['contact_num'])) {

        $user_id = $_SESSION['user_user_id'];

        $employee_id = $_POST['id'];

        $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
        $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
        $middle_name = filter_var($_POST['middle_name'], FILTER_SANITIZE_STRING);

        $position_type = $_POST['position_types'];
        $date_of_birth = $_POST['date_of_birth'];

        $hourly_rate = filter_var($_POST['hourly_rate'], FILTER_SANITIZE_STRING);

        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $contact_num = filter_var($_POST['contact_num'], FILTER_SANITIZE_STRING);

        $update =mysqli_query($con, "UPDATE employee SET 
                     first_name='$first_name',
                     last_name='$last_name',
                     middle_name='$middle_name',
                     position_id='$position_type', 
                     date_of_birth='$date_of_birth', 
                     hourly_rate=$hourly_rate,
                     email_address= '$email',
                     contact_number= '$contact_num'
                 WHERE id='$employee_id'");
        if($update){
            log_audit($con, $user_id, $module, 1, 'Updated employee with id:' .$employee_id);
            header("Location: ../employee/employee-success.php?success=Update Employee Successful!");
        } else {
            log_audit($con, $user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=" . mysqli_error($con));
        }
    }
}
