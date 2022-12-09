<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";

$module = 'SETTINGS-ARCHIVES';
$_user_user_id = $_SESSION['user_user_id'];

if (isset($_POST['restore-inventory'])) {
    if(isset($_POST['id'])){

        $id = $_POST['id'];

        $result =mysqli_query($con,
            "UPDATE inventory_item SET 
                status_archive_id = '1' 
                WHERE id = $id");

        if($result){
            log_audit($con, $_user_user_id, $module, 1, 'Restored inventory item with id:' .$id);
            header("Location: ../settings/settings-restore-success.php?restore_success=Inventory Item Restored Successful");
        } else {
            log_audit($con, $_user_user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=".mysqli_error($con));
        }
    }
}

if (isset($_POST['restore-customer'])) {
    if(isset($_POST['id'])){

        $id = $_POST['id'];

        header("Location: ../common/error-page.php?error=".mysqli_error($con));

        $result =mysqli_query($con,
            "UPDATE customers SET 
                status_archive_id = '1' 
                WHERE id = $id");

        if($result){
            log_audit($con, $_user_user_id, $module, 1, 'Restored customer with id:' .$id);
            header("Location: ../settings/settings-restore-success.php?restore_success=Customer Restored Successful");
        } else {
            log_audit($con, $_user_user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=".mysqli_error($con));
        }
    }
}

if (isset($_POST['restore-account'])) {
    if(isset($_POST['id'])){

        $id = $_POST['id'];

        $result =mysqli_query($con,
            "UPDATE users SET 
                status_archive_id = '1' 
                WHERE user_id = $id");

        if($result){
            log_audit($con, $_user_user_id, $module, 1, 'Restored account with id:' .$id);
            header("Location: ../settings/settings-restore-success.php?restore_success=User Account Restored Successful");
        } else {
            log_audit($con, $_user_user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=".mysqli_error($con));
        }
    }
}

if (isset($_POST['restore-employee'])) {
    if(isset($_POST['id'])){

        $id = $_POST['id'];

        $result =mysqli_query($con,
            "UPDATE employee SET 
                status_archive_id = '1' 
                WHERE id = $id");

        if($result){
            log_audit($con, $_user_user_id, $module, 1, 'Restored employee with id:' .$id);
            header("Location: ../settings/settings-restore-success.php?restore_success=Employee Restored Successful");
        } else {
            log_audit($con, $_user_user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=".mysqli_error($con));
        }
    }
}

if (isset($_POST['restore-expense'])) {
    if(isset($_POST['id'])){

        $id = $_POST['id'];

        $result =mysqli_query($con,
            "UPDATE expense SET 
                status_archive_id = '1' 
                WHERE id = $id");

        if($result){
            log_audit($con, $_user_user_id, $module, 1, 'Restored expense with id:' .$id);
            header("Location: ../settings/settings-restore-success.php?restore_success=Expense Restored Successful");
        } else {
            log_audit($con, $_user_user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=".mysqli_error($con));
        }
    }
}

if (isset($_POST['restore-attendance'])) {
    if(isset($_POST['id'])){

        $id = $_POST['id'];

        $select = mysqli_query($con, "SELECT * FROM `attendance` 
                                        WHERE id = '$id'");

        if (mysqli_num_rows($select) > 0) {
            $employee = mysqli_fetch_assoc($select);
            $employee_id = $employee['employee_id'];
            $date_of_attendance = $employee['date'];

            $check_query = mysqli_query($con, "SELECT * FROM `attendance` 
                                        WHERE employee_id = '$employee_id'
                                        AND date = '$date_of_attendance'
                                        AND id != '$id'");

            if (mysqli_num_rows($check_query) > 0) {
                log_audit($con, $_user_user_id, $module, 0, 'Can not restore record. Date of attendance with the same employee already exist');
                header("Location: ../settings/settings-data-archive-attendance.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Can not restore record. Date of attendance for employee already exist!");
                exit();
            }

            $result =mysqli_query($con,
                "UPDATE attendance SET 
                status_archive_id = '1' 
                WHERE id = $id");

            if($result){
                log_audit($con, $_user_user_id, $module, 1, 'Restored expense with id:' .$id);
                header("Location: ../settings/settings-restore-success.php?restore_success=Attendance Restored Successful");
            } else {
                log_audit($con, $_user_user_id, $module, 0, 'Error processing database.');
                header("Location: ../common/error-page.php?error=".mysqli_error($con));
            }
        }

    }
}

if(isset($_POST['submit-checkall-inventory'])){

    $all_id = $_POST['select-check'];

    $extract_id = implode(',' , $all_id);

    $result= mysqli_query($con,
        "UPDATE inventory_item SET status_archive_id 
                = '1' 
                WHERE id 
                IN ($extract_id)");

    if($result){
        log_audit($con, $_user_user_id, $module, 1, 'Restored inventory item(s) with id:' .$extract_id);
        header("Location: ../settings/settings-restore-success.php?restore_success=Inventory Item(s) Restored Successful");
    } else {
        log_audit($con, $_user_user_id, $module, 0, 'Error processing database.');
        header("Location: ../common/error-page.php?error=".mysqli_error($con));
    }
}

if(isset($_POST['submit-checkall-customers'])){

    $all_id = $_POST['select-check'];

    $extract_id = implode(',' , $all_id);

    $result= mysqli_query($con,
        "UPDATE customers SET status_archive_id 
                = '1' 
                WHERE id 
                IN ($extract_id)");

    if($result){
        log_audit($con, $_user_user_id, $module, 1, 'Restored customer(s) with id:' .$extract_id);
        header("Location: ../settings/settings-restore-success.php?restore_success=Customer(s) Restored Successful");
    } else {
        log_audit($con, $_user_user_id, $module, 0, 'Error processing database.');
        header("Location: ../common/error-page.php?error=".mysqli_error($con));
    }
}

if(isset($_POST['submit-checkall-account'])){

    $all_id = $_POST['select-check'];

    $extract_id = implode(',' , $all_id);

    $result= mysqli_query($con,
        "UPDATE users SET status_archive_id 
                = '1' 
                WHERE user_id 
                IN ($extract_id)");

    if($result){
        log_audit($con, $_user_user_id, $module, 1, 'Restored account(s) with id:' .$extract_id);
        header("Location: ../settings/settings-restore-success.php?restore_success=Account(s) Restored Successful");
    } else {
        log_audit($con, $_user_user_id, $module, 0, 'Error processing database.');
        header("Location: ../common/error-page.php?error=".mysqli_error($con));
    }
}

if(isset($_POST['submit-checkall-employees'])){

    $all_id = $_POST['select-check'];

    $extract_id = implode(',' , $all_id);

    $result= mysqli_query($con,
        "UPDATE employee SET status_archive_id 
                = '1' 
                WHERE id 
                IN ($extract_id)");

    if($result){
        log_audit($con, $_user_user_id, $module, 1, 'Restored employee(s) with id:' .$extract_id);
        header("Location: ../settings/settings-restore-success.php?restore_success=Employee(s) Restored Successful");
    } else {
        log_audit($con, $_user_user_id, $module, 0, 'Error processing database.');
        header("Location: ../common/error-page.php?error=".mysqli_error($con));
    }
}

if(isset($_POST['submit-checkall-expense'])){

    $all_id = $_POST['select-check'];

    $extract_id = implode(',' , $all_id);

    $result= mysqli_query($con,
        "UPDATE expense SET status_archive_id 
                = '1' 
                WHERE id 
                IN ($extract_id)");

    if($result){
        log_audit($con, $_user_user_id, $module, 1, 'Restored expense(s) with id:' .$extract_id);
        header("Location: ../settings/settings-restore-success.php?restore_success=Expense(s) Restored Successful");
    } else {
        log_audit($con, $_user_user_id, $module, 0, 'Error processing database.');
        header("Location: ../common/error-page.php?error=".mysqli_error($con));
    }
}

if(isset($_POST['submit-checkall-attendance'])){

    $all_id = $_POST['select-check'];

    $count = count((array)$all_id);
    $extract_id = implode(',' , $all_id);


    for ($index = 0; $index < $count; $index++) {
        $id = $all_id[$index];

        //Validate each record to check for duplicates employee recorded attendance in the attendance module
        $select = mysqli_query($con, "SELECT * FROM `attendance` 
                                        WHERE id = '$id'");

        if (mysqli_num_rows($select) > 0) {
            $employee = mysqli_fetch_assoc($select);
            $employee_id = $employee['employee_id'];
            $date_of_attendance = $employee['date'];

            $check_query = mysqli_query($con, "SELECT * FROM `attendance` 
                                        WHERE employee_id = '$employee_id'
                                        AND date = '$date_of_attendance'
                                        AND id != '$id'
                                        AND status_archive_id = '1'");


            if (mysqli_num_rows($check_query) > 0) {
                log_audit($con, $_user_user_id, $module, 0, 'Can not restore record with id '.$id.'. Date of attendance with the same employee already exist');
                header("Location: ../settings/settings-data-archive-attendance.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Can not restore record with id '$id'. Date of attendance for employee already exist!");
                exit();
            }

            //Validate each record to check for duplicates employee recorded attendance that is included in the batch for restoration
            $check_query = mysqli_query($con, "SELECT * FROM `attendance` 
                                        WHERE employee_id = '$employee_id'
                                        AND date = '$date_of_attendance'
                                        AND id != '$id'
                                        AND status_archive_id = '2'
                                        AND id IN ($extract_id)");

            if (mysqli_num_rows($check_query) > 0) {
                log_audit($con, $_user_user_id, $module, 0, 'Can not restore record with id '.$id.'. Has a duplicate attendance record in the batch.');
                header("Location: ../settings/settings-data-archive-attendance.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Can not restore record with id '$id'. Has a duplicate attendance record in the batch. Please select only 1");
                exit();
            }
        }

        $result= mysqli_query($con,
            "UPDATE attendance SET status_archive_id 
                = '1' 
                WHERE id 
                IN ($extract_id)");

        if($result){
            log_audit($con, $_user_user_id, $module, 1, 'Restored attendance(s) with id:' .$extract_id);
            header("Location: ../settings/settings-restore-success.php?restore_success=Expense(s) Restored Successful");
        } else {
            log_audit($con, $_user_user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=".mysqli_error($con));
        }

    }

    header("Location: ../settings/settings-restore-success.php?restore_success=Attendance(s) Restored Successful");
}


