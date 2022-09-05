<?php 
session_start();
require "connectionDB.php";
$email = "";
$name = "";
$errors = array();

// session_start();
    if (isset($_POST['email']) && isset($_POST['password'])){

        $email = $_POST['email'];
        $pass = $_POST['password'];
        
        if (empty($email)){
            // header("Location: login.php?error=Email is required");
        }else if (empty($pass)){
            // header("Location: login.php?error=Password is required");
        }else{
            $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
            $stmt->execute([$email]);
            if ($stmt->rowCount() === 1){
                $user = $stmt->fetch();
                
                $user_id = $user['id'];
                $user_email = $user['email'];
                $user_password = $user['password'];
                $user_full_name = $user['full_name'];
                if ($email === $user_email){
                    if (password_verify($pass, $user_password)){
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['user_email'] = $user_email;
                        $_SESSION['user_full_name'] =  $user_full_name;
                    }else{
                        header("Location: login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> The password you've entered is incorrect");
                    }
                }else {
                    header("Location: login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> The email you entered is not connected to the system");
                }
            }else{
                header("Location: login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> The email you entered is not connected to the system");
            }
        } 
    }

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
    if(isset($_POST['Change-Password'])){
        $password = md5($_POST['newpassword']);
        $confirmPassword = md5($_POST['confirmPassword']);
        
        if (strlen($_POST['newpassword']) < 8) {
            header("Location: changePassword.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i>Use 8 or more characters with a mix of letters, numbers & symbols");
        } else {
            // if password not matched so
            if ($_POST['newpassword'] != $_POST['confirmPassword']) {
                header("Location: changePassword.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Password don't matched");
            } else {
                $email = $_SESSION['email'];
                $updatePassword = "UPDATE users SET password = '$password' WHERE email = '$email'";
                $updatePass = mysqli_query($con, $updatePassword) or die("Query Failed");
                session_unset($email);
                session_destroy();
                header('location: login.php');
            }
        }
    }
?>