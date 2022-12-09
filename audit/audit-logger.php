`<?php

function log_audit($con, $user_id, $module, $status, $data) {

    $module_id = get_module_name($con, $module);

    $insert = mysqli_query($con, "INSERT INTO audit_trail VALUES(
                         '',
                         '$module_id', 
                         '$user_id', 
                         '$status', 
                         '$data', 
                         now())
                         ");
    if (!$insert) {
        header("Location: ../common/error-page.php?error=".mysqli_error($con));
    }
}

function get_module_name($con, $module) {

    $query = "SELECT * FROM module WHERE name = '$module'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $fetch_data = mysqli_fetch_assoc($result);
        return $fetch_data['id'];
    }
}

