<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'FORGOT_PASSWORD';

if (isset($_POST['check-email'])) {

    $email = $_POST['email'];

    $emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
    $emailCheckResult = mysqli_query($con, $emailCheckQuery);

    // validate if query is successful
    if ($emailCheckResult) {

        // validate if email matched
        if (mysqli_num_rows($emailCheckResult) > 0) {

            $fetch_data = mysqli_fetch_assoc($emailCheckResult);
            $fetch_user_id = $fetch_data['user_id'];

            //Generate random code
            $code = rand(999999, 111111);

            $updateQuery = "UPDATE users SET code = '$code' WHERE user_id = '$fetch_user_id'";
            $updateResult = mysqli_query($con, $updateQuery);

            if ($updateResult) {

                $subject = 'Tags Water System Verification Code';
                $message = "We received a request to reset your password. Here is the verification code $code";
                $sender = 'From: narutosasuke454545@gmail.com';

                //Send email and
                if (mail($email, $subject, $message, $sender)) {

                    $_SESSION['email'] = $email;
                    $message = "We've sent a verification code to your Email<br><ins><strong>$email</ins></strong>";
                    log_audit($con, $fetch_user_id, $module, 1,'Verification code sent to email');
                    header('Location: ../auth/code-verification.php?message='.$message);

                } else {
                    log_audit($con, $fetch_user_id, $module, 0,'Error sending code to email');
                    header('Location: ../auth/code-verification.php');
                    //header("Location:../auth/forgot-password.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed while sending code");
                }
            } else {
                header("Location:../auth/forgot-password.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Something went wrong");
            }
        } else {
            header("Location:../auth/forgot-password.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> This email address does not exist to the system");
        }
    } else {
        header("Location:../auth/forgot-password.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed while checking email from database");
    }
}
