<?php
require "../database/connection-db.php";
require_once "../audit/audit-logger.php";

$module = 'ACCOUNT-ACCOUNT_TYPE';

if(isset($_POST['remove-account-type'])) {
    if(isset($_POST['account_type_id'])) {

        $account_type_id = $_POST['account_type_id'];

        $validate_account_type = mysqli_query($con, "SELECT * FROM account_type
                                                        WHERE id = '$account_type_id'
                                                        AND is_deleted = 0");

        if($validate_account_type) {
            if (mysqli_num_rows($validate_account_type) > 0) {
                $account_type = mysqli_fetch_assoc($validate_account_type);
                $account_type_name = $account_type['user_type'];

                if($account_type_name == 'ADMIN' || $account_type_name == 'MANAGER' || $account_type_name == 'CASHIER') {
                    header("Location: ../accounts/account-type.php?error= <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Role '".$account_type_name."' cannot be removed.");
                    exit();
                }

            } else {
                header("Location: ../accounts/account-type.php?error= <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Role is already removed.");
                exit();
            }
        }


        $validate_users_with_account_type = mysqli_query($con, "SELECT * FROM users
                                                            WHERE account_type_id = '$account_type_id'
                                                            AND status_archive_id = 1");

        if (mysqli_num_rows($validate_users_with_account_type) > 0) {
            header("Location: ../accounts/account-type.php?error= <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Cannot remove role assigned to active users");
            exit();
        } else {

            //Update account type status
            $update_account_type_status = mysqli_query($con, "UPDATE account_type SET
                                                                is_deleted = '1'
                                                                WHERE id = '$account_type_id'");
        
            if ($update_account_type_status) {
                //Delete * account module access for user
                $delete_account_module_access = mysqli_query($con, "DELETE FROM account_module_access
                                                                    WHERE account_type_id = '$account_type_id'");

                if($delete_account_module_access) {
                    log_audit($con, $_user_user_id, $module, 1, 'Successfully removed account type and access with account type id:'.$account_type_id);
                    header("Location: ../accounts/account-type-success.php?success=Account Type and Access Remove Successful!");
                    exit();
                } else {
                    header("Location: ../common/error-page.php?error=Error on update role process in database.");
                    exit();
                }
            } else {
                header("Location: ../common/error-page.php?error=Error on update role process in database.");
                exit();
            }
        }
    
    }


}