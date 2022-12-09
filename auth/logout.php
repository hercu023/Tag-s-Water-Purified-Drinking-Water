<?php
session_start();
require_once  "../database/connection-db.php";
require_once "../audit/audit-logger.php";

$user_id = $_SESSION['user_user_id'];

log_audit($con, $user_id, 'LOGIN', 1, 'Logged out of the system');

$session_key = $_SESSION['user_user_session_key'];

$delete = mysqli_query($con, "DELETE from user_session WHERE session_key = '$session_key'");

unset( $_SESSION['user_user_session_key']);
unset($_SESSION['email']);
unset($_SESSION['verified']);
unset($_SESSION['user_user_id']);
unset($_SESSION['user_email']);
unset($_SESSION['user_first_name']);
unset($_SESSION['user_user_type']);
unset($_SESSION['user_profile_image']);

header("location:login.php");

