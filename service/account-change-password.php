<?php
require "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'ACCOUNT';

if(isset($_POST['change-password'])){

    //session user id
    $user_user_id = $_SESSION['user_user_id'];

    $user_id = $_POST['id'];

    $new_pass = mysqli_real_escape_string($con, $_POST['pass']);
    $confirm_pass = mysqli_real_escape_string($con, $_POST['confirm_pass']);

    if (strlen($new_pass) < 8) {
        header("Location: account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Password too short. Use 8 or more characters with a mix of letters, numbers and symbols.");
        exit();
    }

    if($new_pass !== $confirm_pass) {
        header("Location: account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Passwords doesn't matched. Try again.");
        exit();
    }

    $encrypted_pass = password_hash($new_pass, PASSWORD_BCRYPT);

    $update = mysqli_query($con, "UPDATE users SET password = '$encrypted_pass' WHERE user_id = '$user_id'");

    if($update) {
        log_audit($con, $user_user_id, $module, 1,'Update password successful');
        header("Location: ../accounts/account-success.php?success=Password Update Successful!");
    } else {
        log_audit($con, $user_user_id, $module, 0,'Error while updating password');
        header("Location: ../common/error-page.php?error=".mysqli_error($con));
    }
}

function validate_change_password() {
    $session_user_id = $_SESSION['user_user_id'];
    $user_id = $_GET['edit'];

    if ($session_user_id != $user_id) {
        header("Location: account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> You are not authorized to update another user's password.");
        exit();
    }
}