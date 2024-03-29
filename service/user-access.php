<?php

date_default_timezone_set("Asia/Manila");

@session_start();

function get_user_access($con, $user_type) {

    $select = mysqli_query($con, "SELECT * FROM `account_module_access` 
                                        INNER JOIN account_type 
                                        ON account_module_access.account_type_id = account_type.id
                                        INNER JOIN module
                                        ON account_module_access.module_id = module.id
                                        WHERE account_type.user_type ='$user_type'");

    if (mysqli_num_rows($select)) {
        return mysqli_fetch_assoc($select);
    }

    return null;
}

function get_user_access_per_module($con, $user_type, $module) {

    $user_session = $_SESSION['user_user_session_key'];

    $check_session = mysqli_query($con, "SELECT date_add(date_active,interval 30 minute) as date_active FROM user_session 
                                                WHERE session_key = '$user_session'
                                                AND status = 'ACTIVE'");

    if (mysqli_num_rows($check_session) > 0) {

        //Validate expiry of session
        $session = mysqli_fetch_assoc($check_session);
        $date_active = $session['date_active'];

        $date_active = new DateTime($date_active);
        $current_date = new DateTime();

        if($current_date > $date_active) {
            $delete = mysqli_query($con, "DELETE from user_session WHERE session_key = '$user_session'");
            header("Location: ../auth/login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Session has expired. Try login again.");
            exit();
        } else {
            $update = mysqli_query($con, "UPDATE user_session SET 
                                date_active = now()
                                WHERE session_key = '$user_session'");
        }

        $select = mysqli_query($con, "SELECT * FROM `account_module_access` 
                                        INNER JOIN account_type 
                                        ON account_module_access.account_type_id = account_type.id
                                        INNER JOIN module
                                        ON account_module_access.module_id = module.id
                                        WHERE account_type.user_type ='$user_type' 
                                        AND module.name = '$module'");

        if (mysqli_num_rows($select)) {
            return true;
        }
        return false;
    } else {
        $delete = mysqli_query($con, "DELETE from user_session WHERE session_key = '$user_session'");
        header("Location: ../auth/login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> You don't have an active session. Try logging in again.");
        exit();
    }

}