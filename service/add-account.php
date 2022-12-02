<?php
require "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'ACCOUNT';

if(isset($_POST['add-account'])) {
    if (isset($_POST['last_name'])
        || isset($_POST['first_name'])
        || isset($_POST['middle_name'])
        || isset($_POST['email'])
        || isset($_POST['contact_num'])
        || isset($_POST['user_types'])
        || isset($_POST['pass'])
        || isset($_POST['confirm_pass'])
        || isset($_POST['profile_image'])) {

        //session user id
        $user_user_id = $_SESSION['user_user_id'];

        $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);

        $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);

        $middle_name = filter_var($_POST['middle_name'], FILTER_SANITIZE_STRING);

        $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);

        $contact = filter_var($_POST['contact_num'], FILTER_SANITIZE_STRING);

        $user_type = $_POST['user_types'];

        $pass = mysqli_real_escape_string($con, $_POST['pass']);
        $confirm_pass = mysqli_real_escape_string($con, $_POST['confirm_pass']);

        if ($pass != $confirm_pass) {
            header("Location: account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Password does not matched.");
            exit();
        }

        $image = $_FILES['profile_image']['name'];
        $image_tmp_name = $_FILES['profile_image']['tmp_name'];
        $image_size = $_FILES['profile_image']['size'];
        $image_folder = '../uploaded_image/' . $image;

        if ($image_size > 2000000) {
            header("Location: account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Image is too large.");
            exit();
        }

        $check_query =mysqli_query($con, "SELECT * FROM `users` WHERE email = '$email'");

        if (mysqli_num_rows($check_query) > 0) {
            header("Location: account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Email already exist.");
        } else {

            $encrypted_pass = password_hash($pass, PASSWORD_BCRYPT);

            $insert = mysqli_query($con, "INSERT INTO `users` VALUES(
                         '',
                         '$last_name', 
                         '$first_name', 
                         '$middle_name', 
                         '$email', 
                         '$encrypted_pass', 
                         '$contact', 
                         '$user_type',
                         0,
                         '$image',
                         now(),
                         1)"
            );

            if ($insert) {

                $select = mysqli_query($con, "SELECT * FROM `users` WHERE
                           email = '$email' AND
                           status_archive_id = 1");

                if (mysqli_num_rows($select) > 0) {
                    move_uploaded_file($image_tmp_name, $image_folder);

                    $fetch_data = mysqli_fetch_assoc($select);
                    $fetch_id = $fetch_data['user_id'];
                    log_audit($con, $user_user_id, $module, 1, 'Added new user with id:' . $fetch_id);
                    header("Location: ../accounts/account-success.php?success=Add New Account Successful!");
                } else {
                    log_audit($con, $user_user_id, $module, 0, 'Error processing database.');
                    header("Location: ../common/error-page.php?error=".$email);
                }
            } else {
                log_audit($con, $user_user_id, $module, 0, 'Error processing database.');
                header("Location: ../common/error-page.php?error=".$last_name.' | '.
                    $first_name.' | '.
                    $middle_name.' | '.
                    $email.' | '.
                    $encrypted_pass.' | '.
                    $contact.' | '.
                    $user_type.' | '.
                    $image);
            }
        }
    }
}