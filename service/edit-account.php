<?php
require "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'ACCOUNT';

if(isset($_POST['update-account'])) {
    if (isset($_POST['user_id'])
        || isset($_POST['last_name'])
        || isset($_POST['first_name'])
        || isset($_POST['middle_name'])
        || isset($_POST['contact_num'])
        || isset($_POST['user_types'])
        || isset($_FILES['profile_image']['name'])
        && ($_FILES['profile_image']['name'] != "")) {

        //session user id
        $user_user_id = $_SESSION['user_user_id'];

        $user_id = $_POST['user_id'];

        $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);

        $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);

        $middle_name = filter_var($_POST['middle_name'], FILTER_SANITIZE_STRING);

        $contact = filter_var($_POST['contact_num'], FILTER_SANITIZE_STRING);

        $user_type = $_POST['user_types'];

        $image = $_FILES['profile_image']['name'];
        $image_tmp_name = $_FILES['profile_image']['tmp_name'];
        $image_size = $_FILES['profile_image']['size'];
        $image_folder = '../uploaded_image/' . $image;

        //If image is empty replace it with the saved image name from users table.
        if (empty($image)) {
            $user_image_query = "SELECT profile_image FROM users WHERE user_id = '$user_id'";
            $result_image = mysqli_query($con, $user_image_query);
            $image = mysqli_fetch_assoc($result_image)['profile_image'];
        }

        $result = mysqli_query($con, "UPDATE users SET 
                 last_name='$last_name', 
                 first_name='$first_name', 
                 middle_name='$middle_name', 
                 contact_number='$contact',
                 profile_image ='$image',
                 account_type_id = '$user_type'
             WHERE user_id='$user_id'");

        if ($result) {
            move_uploaded_file($image_tmp_name, $image_folder);
            log_audit($con, $user_user_id, $module, 1, 'Updated user with id:' .$user_id);
            header("Location: ../accounts/account-success.php?success=Update Account Successful!");
        } else {
            log_audit($con, $user_user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=".mysqli_error($con));
        }
    }
}