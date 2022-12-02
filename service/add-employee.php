<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'EMPLOYEE';

if (isset($_POST['add-employee'])) {
    if (isset($_POST['first_name'])
        || isset($_POST['last_name'])
        || isset($_POST['middle_name'])
        || isset($_POST['position_types'])
        || isset($_POST['date_of_birth'])
        || isset($_POST['daily_rate'])
        || isset($_POST['email'])
        || isset($_POST['contact_num'])) {

        $user_id = $_SESSION['user_user_id'];

        $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
        $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
        $middle_name = filter_var($_POST['middle_name'], FILTER_SANITIZE_STRING);

        $position_type = $_POST['position_types'];
        $date_of_birth = $_POST['date_of_birth'];

        $daily_rate = filter_var($_POST['daily_rate'], FILTER_SANITIZE_STRING);

        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
        $contact_num = filter_var($_POST['contact_num'], FILTER_SANITIZE_STRING);

        $check_query = mysqli_query($con, "SELECT * FROM `employee` 
                                        WHERE first_name = '$first_name'
                                        AND last_name = '$last_name'
                                        AND middle_name = '$middle_name'
                                        AND date_of_birth = '$date_of_birth'");

        if (mysqli_num_rows($check_query) > 0) {
            log_audit($con, $user_id, $module, 0, 'Duplicate employee with name already exist');
            header("Location: ../employee/employee.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Employee name already exist!");
        } else {
            $insert = mysqli_query($con, "INSERT INTO `employee` VALUES(
                             '',
                             '$last_name',
                             '$first_name',
                             '$middle_name',
                             '$position_type',
                             '$daily_rate',
                             '$date_of_birth',
                             '$email',
                             '$contact_num',
                             '$user_id',
                             now(),
                             '',
                             '',
                             1)
                             ");
            if ($insert) {
                $select = mysqli_query($con, "SELECT * FROM `employee` 
                                        WHERE first_name = '$first_name'
                                        AND last_name = '$last_name'
                                        AND middle_name = '$middle_name'
                                        AND date_of_birth = '$date_of_birth'
                                        AND status_archive_id = 1");

                if (mysqli_num_rows($select) > 0) {
                    $fetch_data = mysqli_fetch_assoc($select);
                    $fetch_id = $fetch_data['id'];
                    log_audit($con, $user_id, $module, 1, 'Added new employee with id:' .$fetch_id);
                    header("Location: ../employee/employee-success.php?success=Add New Employee Successful!");
                } else {
                    log_audit($con, $user_id, $module, 0, 'Error processing database.');
                    header("Location: ../common/error-page.php?error=" . mysqli_error($con));
                }
            } else {
                log_audit($con, $user_id, $module, 0, 'Error processing database.');
                header("Location: ../common/error-page.php?error=" . mysqli_error($con));
            }
        }
    }
}

