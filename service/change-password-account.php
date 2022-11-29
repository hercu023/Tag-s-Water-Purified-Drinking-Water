<?php
require "../database/connection-db.php";

if(isset($_POST['change-password'])){

    $userid = $_POST['user_id'];

    validate_change_password();

    $new_pass = mysqli_real_escape_string($con, $_POST['pass']);
    $confirm_pass = mysqli_real_escape_string($con, $_POST['ecpass']);

    if (strlen($new_pass) < 8) {
        header("Location: account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Password too short. Use 8 or more characters with a mix of letters, numbers and symbols.");
        exit();
    }
    if($new_pass !== $confirm_pass){
        header("Location: account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Passwords doesn't matched. Try again.");
        exit();
    }

    $encpass = password_hash($new_pass, PASSWORD_BCRYPT);
    $run_query = mysqli_query($con, "UPDATE users SET password = '$encpass' WHERE user_id = '$userid'");

    if($run_query){
        header("Location: ../accounts/account-success.php?success=Password Update Successful!");
    } else {
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