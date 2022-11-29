<?php
session_start();
require "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'ACCOUNT';

if (isset($_POST['archive-account'])) {
    if(isset($_POST['user_id'])){

        //session user id
        $user_user_id = $_SESSION['user_user_id'];

        $user_id = $_POST['user_id'];

        $result =mysqli_query($con, "UPDATE users SET status_archive_id = '2' WHERE user_id = $user_id");
        if($result){
            log_audit($con, $user_user_id, $module, 1, 'Archived user with id: '.$user_id);
            header("Location: account-success.php?success=User Account Archived Successful");
        } else {
            log_audit($con, $user_user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=".mysqli_error($con));
        }    
    }
}

function validate_archive_user() {
    $session_user_id = $_SESSION['user_user_id'];
    $user_id = $_GET['edit'];

    if ($session_user_id == $user_id) {
        header("Location: account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> You are not allowed to archive own your account.");
        exit();
    }
}

