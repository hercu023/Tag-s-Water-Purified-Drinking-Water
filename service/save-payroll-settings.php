<?php
require "../database/connection-db.php";
require_once "../audit/audit-logger.php";

$module = 'SETTINGS-PAYROLL';

if(isset($_POST['save-payroll-settings'])) {
    if(isset($_POST['time_in'])
    || isset($_POST['grace_period'])
    || isset($_POST['late_deduction'])
    || isset($_POST['ot_bonus'])
    || isset($_POST['without_uniform_deduction'])
    ) {

        $time_in_schedule = $_POST['time_in'];
        $grace_period = $_POST['grace_period'];
        $late_deduction = $_POST['late_deduction'];
        $ot_bonus = $_POST['ot_bonus'];
        $without_uniform_deduction = $_POST['without_uniform_deduction'];

        $user_user_id = $_SESSION['user_user_id'];

        if ($time_in_schedule > $grace_period) {
            header("Location: ../settings/settings-payroll.php?error= <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Time IN Schedule cannot be later than Grace Period");
            exit();
        }

        $update = mysqli_query($con, "UPDATE payroll_settings SET
                        grace_period = '$grace_period',
                        late_deduction_per_min = '$late_deduction',
                        time_in_schedule ='$time_in_schedule',
                        overtime_bonus_per_hour = '$ot_bonus',
                        without_uniform_deduction = '$without_uniform_deduction'");

        if($update) {
            log_audit($con, $_user_user_id, $module, 1, 'Updated payroll settings.');
            header("Location: ../settings/settings-payroll-success.php?success=Update Payroll Settings Successful!");
            exit();
        } else {
            log_audit($con, $_user_user_id, $module, 1, 'Error update on payroll settings.');
            header("Location: ../settings/settings-payroll.php?error= <i class='fas fa-exclamation-triangle' style='font-size:14px'></i>Failed updating payroll settings. Try again.");
            exit();
        }
    }
}

?>