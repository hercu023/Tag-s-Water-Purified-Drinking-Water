<?php
require "../database/connection-db.php";
require_once "../audit/audit-logger.php";

$module = 'ACCOUNT-ACCOUNT_TYPE';

if(isset($_POST['save-account-type'])) {
    if(isset($_POST['role_description'])) {

        $role = $_POST['role_description'];

        if($role == 'ADMIN') {
            header("Location: ../accounts/account-type.php?error= <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> ADMIN role cannot be modified.");
            exit();
        }

        $for_update_only = 0;
        if (isset($_POST['update'])) {
            $for_update_only = $_POST['update'];
        }
        
        //Validate if user role name already exists.
        $validate_role = mysqli_query($con, "SELECT * FROM account_type
                                                WHERE user_type = '$role'
                                                AND is_deleted = '0'");

        if(mysqli_num_rows($validate_role) > 0 && $for_update_only == 0) {
            header("Location: ../accounts/account-type.php?error= <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Role already exist.");
            exit();
        } else {
            
            $insert_role = true;

            if ($for_update_only == 0) {
                $insert_role = mysqli_query($con, "INSERT INTO account_type VALUES(
                    '',
                    '$role',
                    '0')");
            }
            
            if($insert_role) {

                //Get id of role
                $result_role_id = mysqli_query($con, "SELECT id FROM account_type
                                                WHERE user_type = '$role'");
                $account_type_id = mysqli_fetch_assoc($result_role_id)['id'];

                if(isset($_POST['ACCOUNT-ACCOUNT_TYPE'])) {
                    add_access($con, 1, $account_type_id, 'ACCOUNT-ACCOUNT_TYPE');
                } else {
                    add_access($con, 0, $account_type_id, 'ACCOUNT-ACCOUNT_TYPE');
                }

                if(isset($_POST['ACCOUNT-USER_ACCOUNT'])) {
                    add_access($con, 1, $account_type_id, 'ACCOUNT-USER_ACCOUNT');
                } else {
                    add_access($con, 0, $account_type_id, 'ACCOUNT-USER_ACCOUNT');
                }

                if(isset($_POST['CUSTOMER'])) {
                    add_access($con, 1, $account_type_id, 'CUSTOMER');
                } else {
                    add_access($con, 0, $account_type_id, 'CUSTOMER');
                }

                if(isset($_POST['DASHBOARD'])) {
                    add_access($con, 1, $account_type_id, 'DASHBOARD');
                } else {
                    add_access($con, 0, $account_type_id, 'DASHBOARD');
                }

                if(isset($_POST['EMPLOYEE-ATTENDANCE'])) {
                    add_access($con, 1, $account_type_id, 'EMPLOYEE-ATTENDANCE');
                } else {
                    add_access($con, 0, $account_type_id, 'EMPLOYEE-ATTENDANCE');
                }

                if(isset($_POST['EMPLOYEE-LIST'])) {
                    add_access($con, 1, $account_type_id, 'EMPLOYEE-LIST');
                } else {
                    add_access($con, 0, $account_type_id, 'EMPLOYEE-LIST');
                }

                if(isset($_POST['EXPENSE'])) {
                    add_access($con, 1, $account_type_id, 'EXPENSE');
                } else {
                    add_access($con, 0, $account_type_id, 'EXPENSE');
                }

                if(isset($_POST['INVENTORY-ITEM'])) {
                    add_access($con, 1, $account_type_id, 'INVENTORY-ITEM');
                } else {
                    add_access($con, 0, $account_type_id, 'INVENTORY-ITEM');
                }

                if(isset($_POST['INVENTORY-STOCKS'])) {
                    add_access($con, 1, $account_type_id, 'INVENTORY-STOCKS');
                } else {
                    add_access($con, 0, $account_type_id, 'INVENTORY-STOCKS');
                }
             
                if(isset($_POST['MONITORING-CUSTOMER_BALANCE'])) {
                    add_access($con, 1, $account_type_id, 'MONITORING-CUSTOMER_BALANCE');
                } else {
                    add_access($con, 0, $account_type_id, 'MONITORING-CUSTOMER_BALANCE');
                }

                if(isset($_POST['MONITORING-DELIVERY_PICKUP'])) {
                    add_access($con, 1, $account_type_id, 'MONITORING-DELIVERY_PICKUP');
                } else {
                    add_access($con, 0, $account_type_id, 'MONITORING-DELIVERY_PICKUP');
                }

                if(isset($_POST['MONITORING-ITEM_HISTORY'])) {
                    add_access($con, 1, $account_type_id, 'MONITORING-ITEM_HISTORY');
                } else {
                    add_access($con, 0, $account_type_id, 'MONITORING-ITEM_HISTORY');
                }

                if(isset($_POST['MONITORING-POINT_OF_SALES_TRANSACTION'])) {
                    add_access($con, 1, $account_type_id, 'MONITORING-POINT_OF_SALES_TRANSACTION');
                } else {
                    add_access($con, 0, $account_type_id, 'MONITORING-POINT_OF_SALES_TRANSACTION');
                }

                if(isset($_POST['MONITORING-RETURN_CONTAINER'])) {
                    add_access($con, 1, $account_type_id, 'MONITORING-RETURN_CONTAINER');
                } else {
                    add_access($con, 0, $account_type_id, 'MONITORING-RETURN_CONTAINER');
                }

                if(isset($_POST['MONITORING-SCHEDULING'])) {
                    add_access($con, 1, $account_type_id, 'MONITORING-SCHEDULING');
                } else {
                    add_access($con, 0, $account_type_id, 'MONITORING-SCHEDULING');
                }

                if(isset($_POST['POS'])) {
                    add_access($con, 1, $account_type_id, 'POS');
                } else {
                    add_access($con, 0, $account_type_id, 'POS');
                }

                if(isset($_POST['REPORTS-ATTENDANCE'])) {
                    add_access($con, 1, $account_type_id, 'REPORTS-ATTENDANCE');
                } else {
                    add_access($con, 0, $account_type_id, 'REPORTS-ATTENDANCE');
                }

                if(isset($_POST['REPORTS-DELIVERY_WALKIN'])) {
                    add_access($con, 1, $account_type_id, 'REPORTS-DELIVERY_WALKIN');
                } else {
                    add_access($con, 0, $account_type_id, 'REPORTS-DELIVERY_WALKIN');
                }

                if(isset($_POST['REPORTS-EXPENSE'])) {
                    add_access($con, 1, $account_type_id, 'REPORTS-EXPENSE');
                } else {
                    add_access($con, 0, $account_type_id, 'REPORTS-EXPENSE');
                }

                if(isset($_POST['REPORTS-INVENTORY'])) {
                    add_access($con, 1, $account_type_id, 'REPORTS-INVENTORY');
                } else {
                    add_access($con, 0, $account_type_id, 'REPORTS-INVENTORY');
                }

                if(isset($_POST['REPORTS-ITEM_ISSUE'])) {
                    add_access($con, 1, $account_type_id, 'REPORTS-ITEM_ISSUE');
                } else {
                    add_access($con, 0, $account_type_id, 'REPORTS-ITEM_ISSUE');
                }

                if(isset($_POST['REPORTS-SALES'])) {
                    add_access($con, 1, $account_type_id, 'REPORTS-SALES');
                } else {
                    add_access($con, 0, $account_type_id, 'REPORTS-SALES');
                }

                if(isset($_POST['SETTINGS-ARCHIVES'])) {
                    add_access($con, 1, $account_type_id, 'SETTINGS-ARCHIVES');
                } else {
                    add_access($con, 0, $account_type_id, 'SETTINGS-ARCHIVES');
                }

                if(isset($_POST['SETTINGS-BACKUP_RESTORE'])) {
                    add_access($con, 1, $account_type_id, 'SETTINGS-BACKUP_RESTORE');
                } else {
                    add_access($con, 0, $account_type_id, 'SETTINGS-BACKUP_RESTORE');
                }

                if(isset($_POST['SETTINGS-DATA_LOGS'])) {
                    add_access($con, 1, $account_type_id, 'SETTINGS-DATA_LOGS');
                } else {
                    add_access($con, 0, $account_type_id, 'SETTINGS-DATA_LOGS');
                }

                if(isset($_POST['SETTINGS-HELP'])) {
                    add_access($con, 1, $account_type_id, 'SETTINGS-HELP');
                } else {
                    add_access($con, 0, $account_type_id, 'SETTINGS-HELP');
                }

                log_audit($con, $_user_user_id, $module, 1, 'Saved Account Type and Access with account type id:'.$account_type_id);
                header("Location: ../accounts/account-type-success.php?success=Account Type and Access Saved Successful!");
                exit();
            } else {
                header("Location: ../accounts/account-type.php?error= <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Error creating role. Please try again.");
            exit();
            }
        }
    }
}

function add_access($con, $status, $account_type_id, $module_name) {

    //Get module id
    $result_module_id = mysqli_query($con, "SELECT id FROM module
                                                WHERE name = '$module_name'");
    $module_id = mysqli_fetch_assoc($result_module_id)['id'];

    if($status == 1) {
        if (!has_access($con, $module_id, $account_type_id)) {
            $insert_access = mysqli_query($con, "INSERT INTO account_module_access VALUES(
                                '',
                                '$account_type_id',
                                '$module_id')");
        }
    } else {
        $delete_access = mysqli_query($con,"DELETE FROM account_module_access
        WHERE module_id = '$module_id'
        AND account_type_id = '$account_type_id'");
    }
}

function has_access($con, $module_id, $account_type_id) {
    $check_access = mysqli_query($con,"SELECT id 
                                    FROM account_module_access
                                    WHERE module_id = '$module_id'
                                    AND account_type_id = '$account_type_id'");

    if (mysqli_num_rows($check_access) > 0) {
        return true;
    } else {
        return false;
    }
    
}

