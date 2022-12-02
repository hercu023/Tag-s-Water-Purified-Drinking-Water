<?php
session_start();
require_once  "../database/connection-db.php";
require_once "../audit/audit-logger.php";

$user_id = $_SESSION['user_user_id'];

log_audit($con, $user_id, 'LOGIN', 1, 'Logged out of the system');

unset($_SESSION['email']);
unset($_SESSION['verified']);

unset($_SESSION['user_user_id']);
unset($_SESSION['user_email']);
unset($_SESSION['user_first_name']);
unset($_SESSION['user_user_type']);
unset($_SESSION['user_profile_image']);

header("location:login.php");

