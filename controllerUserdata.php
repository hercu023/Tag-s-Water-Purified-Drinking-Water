<?php 
session_start();
require "connectionDB.php";
$email = "";
$name = "";
$errors = array();

if(isset($_POST['code-verfiy'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $update_otp = "UPDATE users SET code = $code WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['full_name'] = $name;
                $_SESSION['email'] = $email;
                header('location: changePassword.php');
                exit();
            }else {
                header("Location: code-verification.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i>Failed while updating code.");
            }
        }else {
            header("Location: code-verification.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i>You've entered incorrect code.");
        }
    }
    if (isset($_POST['check-email'])) {
        $email = $_POST['email'];
        $_SESSION['email'] = $email;

        $emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
        $emailCheckResult = mysqli_query($con, $emailCheckQuery);

        // if query run
        if ($emailCheckResult) {
            // if email matched
            if (mysqli_num_rows($emailCheckResult) > 0) {
                $code = rand(999999, 111111);
                $updateQuery = "UPDATE users SET code = $code WHERE email = '$email'";
                $updateResult = mysqli_query($con, $updateQuery);
                if ($updateResult) {
                    $subject = 'Tags Water System Verification Code';
                    $message = "We received a request to reset your password.
                    Here is the verification code $code";
                    $sender = 'From: narutosasuke454545@gmail.com';

                    if (mail($email, $subject, $message, $sender)) {
                        $message = "We've sent a verification code to your Email <br> <ins><strong>$email</ins></strong>";

                        $_SESSION['message'] = $message;
                        header('location: code-verification.php');
                    }else{
                        header("Location: forgot.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed while sending code");
                    }
                }else {
                    header("Location: forgot.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Something went wrong");
                }
            }else{
                header("Location: forgot.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> This email address does not exist to the system");
            }
        }else {
            header("Location: forgot.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i>Failed while checking email from database!");
        }
        
    }
    if(isset($_POST['changePassword'])){
        $password = md5($_POST['newpassword']);
        $confirmPassword = md5($_POST['confirmPassword']);
        
        if (strlen($_POST['newpassword']) < 8) {
            $errors['password_error'] = 'Use 8 or more characters with a mix of letters, numbers & symbols';
        } else {
            // if password not matched so
            if ($_POST['newpassword'] != $_POST['confirmPassword']) {
                $errors['password_error'] = 'Password not matched';
            } else {
                $email = $_SESSION['email'];
                $updatePassword = "UPDATE users SET password = '$password' WHERE email = '$email'";
                $updatePass = mysqli_query($conn, $updatePassword) or die("Query Failed");
                session_unset($email);
                session_destroy();
                header('location: login.php');
            }
        }
    }
?>