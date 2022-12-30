<?php
require "../database/connection-db.php";
require_once "../audit/audit-logger.php";

$module = 'MONITORING-SCHEDULING';

if(isset($_POST['save-date-schedule'])){
    if(isset($_POST['customername'])
    || isset($_POST['date_schedule'])) {

        $customer_id = $_POST['customername'];
        $date_schedule = $_POST['date_schedule'];


        $validate_schedule = mysqli_query($con, "SELECT * FROM date_scheduling
                                                WHERE date = '$date_schedule'
                                                AND customer_id = '$customer_id'");

        if (mysqli_num_rows($validate_schedule) > 0) {
            header("Location: ../monitoring/monitoring-scheduling.php?error= <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Can not add duplicate schedule for the same customer.");
            exit();
        } else {
            $insert_schedule = mysqli_query($con, "INSERT INTO date_scheduling VALUES(
                                                    '',
                                                    '$date_schedule',
                                                    '$customer_id')");
            if($insert_schedule) {
                log_audit($con, $_user_user_id, $module, 1, 'Added schedule for customer id:'.$customer_id);
                header("Location: ../monitoring/monitoring-scheduling-success.php?success=Add Date Schedule Successful!");
                exit();
            } else {
                header("Location: ../monitoring/monitoring-scheduling.php?error= <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Error adding schedule in database.");
                exit();
            }
        }
    }
}

?>