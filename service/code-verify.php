<?php
session_start();
require '../database/connection-db.php';
require_once "../audit/audit-logger.php";
$module = 'CODE_VERIFICATION';

if(isset($_POST['code-verify'])){

    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $email = $_SESSION['email'];

    $check_code = "SELECT * FROM users WHERE email = '$email'";
    $code_result = mysqli_query($con, $check_code);

    if(mysqli_num_rows($code_result) > 0) {

        $fetch_data = mysqli_fetch_assoc($code_result);

        $fetch_otp_code = $fetch_data['code'];
        $fetch_user_id = $fetch_data['user_id'];

        if ($fetch_otp_code === $otp_code) {

            $update_otp = "UPDATE users SET code = 0 WHERE code = '$fetch_code'";
            $update_res = mysqli_query($con, $update_otp);

            if($update_res){
                $_SESSION['verified'] = $email;
                log_audit($con, $fetch_user_id, $module, 1,'Valid code input');
                header('Location: ../auth/change-password.php');
                exit();
            }else {
                header("Location: ../auth/code-verification.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed while updating code.");
            }
        } else {
            log_audit($con, $fetch_user_id, $module, 0,'Invalid code input');
            header("Location: ../auth/code-verification.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> You have entered an invalid code.");
        }
    } else {
        header("Location: ../auth/code-verification.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> You are not authorized for code verification.");
    }
}