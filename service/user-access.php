<?php
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

    $check_session = mysqli_query($con, "SELECT * FROM user_session 
                                                WHERE session_key = '$user_session'
                                                AND status = 'ACTIVE'");

    if (mysqli_num_rows($check_session) > 0) {
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
        header("Location: ../auth/login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> You're session has expired. Try login again.");
        exit();
    }
}