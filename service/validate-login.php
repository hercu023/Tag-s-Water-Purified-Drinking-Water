<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'LOGIN';

if (isset($_POST['email']) && isset($_POST['password'])){

    //Unset session
    unset($_SESSION['email']);

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($email) && !empty($password)){

        $select =mysqli_query($con, "SELECT users.user_id,
                                        users.last_name, 
                                        users.first_name, 
                                        users.middle_name, 
                                        users.email, 
                                        users.password,
                                        users.contact_number, 
                                        users.profile_image, 
                                        account_type.user_type 
                                        FROM users 
                                        INNER JOIN account_type 
                                        ON users.account_type_id = account_type.id 
                                        WHERE email= '$email'
                                        AND status_archive_id = 1");

        if (mysqli_num_rows($select) > 0) {
            $user = mysqli_fetch_array($select);

            $user_id = $user['user_id'];
            $user_email = $user['email'];
            $user_password = $user['password'];
            $user_first_name = $user['first_name'];
            $user_user_type = $user['user_type'];
            $user_profile_image = $user['profile_image'];

            if ($email === $user_email){
                if (password_verify($password, $user_password)){

                    //Setup the session variables
                    $_SESSION['user_user_id'] = $user_id;
                    $_SESSION['user_email'] = $user_email;
                    $_SESSION['user_first_name'] =  $user_first_name;
                    $_SESSION['user_user_type'] =  $user_user_type;
                    $_SESSION['user_profile_image'] =  $user_profile_image;

                    log_audit($con, $user_id, $module, 1,'Logged in the system');
                    header("Location: ../common/dashboard.php");
                } else {
                    log_audit($con, $user_id, $module, 0, 'Incorrect password input');
                    header("Location: ../auth/login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> The password you've entered is incorrect");
                }
            } else {
                header("Location: ../auth/login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> The email you entered is not connected to the system");
            }
        } else {
            header("Location: ../auth/login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> The email you entered is not connected to the system");
        }
    }
}

