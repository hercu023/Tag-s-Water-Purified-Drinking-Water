<?php
require "../database/connection-db.php";
require_once "../audit/audit-logger.php";

$module = 'MONITORING-SCHEDULING';

if(isset($_POST['save-weekly-schedule'])){
    if(isset($_POST['customername'])
    || isset($_POST['monday'])
    || isset($_POST['tuesday'])
    || isset($_POST['wednesday'])
    || isset($_POST['thursday'])
    || isset($_POST['friday'])
    || isset($_POST['saturday'])
    || isset($_POST['sunday'])) {

        $customer_id = $_POST['customername'];

        if(isset($_POST['monday'])) {
            update_day($con, 1, 'MONDAY', $customer_id);
        } else {
            update_day($con, 0, 'MONDAY', $customer_id);
        }    

        if(isset($_POST['tuesday'])) {
            update_day($con, 1, 'TUESDAY', $customer_id);
        } else {
            update_day($con, 0, 'TUESDAY', $customer_id);
        }    

        if(isset($_POST['wednesday'])) {
            update_day($con, 1, 'WEDNESDAY', $customer_id);
        } else {
            update_day($con, 0, 'WEDNESDAY', $customer_id);
        }    

        if(isset($_POST['thursday'])) {
            update_day($con, 1, 'THURSDAY', $customer_id);
        } else {
            update_day($con, 0, 'THURSDAY', $customer_id);
        }    

        if(isset($_POST['friday'])) {
            update_day($con, 1, 'FRIDAY', $customer_id);
        } else {
            update_day($con, 0, 'FRIDAY', $customer_id);
        }    

        if(isset($_POST['saturday'])) {
            update_day($con, 1, 'SATURDAY', $customer_id);
        } else {
            update_day($con, 0, 'SATURDAY', $customer_id);
        }    

        if(isset($_POST['sunday'])) {
            update_day($con, 1, 'SUNDAY', $customer_id);
        } else {
            update_day($con, 0, 'SUNDAY', $customer_id);
        }    

        log_audit($con, $_user_user_id, $module, 1, 'Updated weekly schedules for customer id:'.$customer_id);
        header("Location: ../monitoring/monitoring-scheduling-success.php?success=Updated Weekly Scheduling Successful!");
        exit();
    }
}

function update_day($con, $status, $day, $customer_id) {
    
    if($status == 1) {
        //Check if already has data for the day saved, if true do nothing, otherwise insert data
        if (!has_day($con, $day, $customer_id)) {
            $insert_day = mysqli_query($con, "INSERT into weekly_scheduling VALUES(
                                '',
                                '$day',
                                '$customer_id')");
        }
    } else {
        $delete_day = mysqli_query($con,"DELETE FROM weekly_scheduling
        WHERE day = '$day'
        AND customer_id = '$customer_id'");
    }
}

function has_day($con, $day, $customer_id) {
    $check_day = mysqli_query($con,"SELECT id 
                                    FROM weekly_scheduling
                                    WHERE day = '$day'
                                    AND customer_id = '$customer_id'");

    if (mysqli_num_rows($check_day) > 0) {
        return true;
    } else {
        return false;
    }
    
}
?>