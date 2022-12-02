<?php
session_start();
require_once '../database/connection-db.php';
require_once "../audit/audit-logger.php";
$module = 'CHANGE_PASSWORD';

if(isset($_POST['change-password'])){
    $password = mysqli_real_escape_string($con, $_POST['newPassword']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirmPassword']);

    if (strlen($_POST['newPassword']) < 8) {
        header("Location:../auth/change-password.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Use 8 or more characters with a mix of letters, numbers & symbols");
    } else {
        if ($password !== $confirm_password){
            header("Location: ../auth/change-password.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Password don't matched");
        } else {

            $email = $_SESSION['email']; //getting this email using session
            $emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
            $emailCheckResult = mysqli_query($con, $emailCheckQuery);

            if ($emailCheckResult) {
                // validate if email matched
                if (mysqli_num_rows($emailCheckResult) > 0) {
                    $fetch_data = mysqli_fetch_assoc($emailCheckResult);
                    $fetch_user_id = $fetch_data['user_id'];

                    $code = 0;
                    $encpass = password_hash($password, PASSWORD_BCRYPT);

                    $update_pass = "UPDATE users SET code = $code, password = '$encpass' WHERE user_id = '$fetch_user_id'";
                    $run_query = mysqli_query($con, $update_pass);

                    if($run_query){
                        log_audit($con, $fetch_user_id, $module, 1,'Update password successful');
                        header('Location: ../auth/change-password-confirm.php');
                    }else{
                        log_audit($con, $fetch_user_id, $module, 0,'Error while updating password');
                        header("Location: ../auth/login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> There was an error when trying to update your password");
                    }
                }
            }
        }
    }
}