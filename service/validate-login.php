<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
require_once "../service/user-access.php";

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
            $user_last_name = $user['last_name'];
            $user_user_type = $user['user_type'];
            $user_profile_image = $user['profile_image'];

            if ($email === $user_email){
                if (password_verify($password, $user_password)){

                    //Setup the session variables
                    $_SESSION['user_user_id'] = $user_id;
                    $_SESSION['user_email'] = $user_email;
                    $_SESSION['user_first_name'] =  $user_first_name;
                    $_SESSION['user_last_name'] =  $user_last_name;
                    $_SESSION['user_user_type'] =  $user_user_type;
                    $_SESSION['user_profile_image'] =  $user_profile_image;

                    $validate_session = mysqli_query($con, "SELECT * FROM user_session 
                                                                WHERE user_id = '$user_id'
                                                                AND status = 'ACTIVE'");

                    if (mysqli_num_rows($validate_session) > 0) {
                        log_audit($con, $user_id, $module, 0, 'Restricted login, still has an active session.');
                        header("Location: ../auth/login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> You still have an active session. Please log out previous session.");
                    } else {
                        $session_key = bin2hex(openssl_random_pseudo_bytes(10)); //Create 20 chars hexadecimal String

                        $_SESSION['user_user_session_key'] = $session_key;

                        $insert_session = mysqli_query($con, "INSERT INTO user_session VALUES (
                                 '',
                                 '$user_id',
                                 '$session_key',
                                 'ACTIVE')");

                        if ($insert_session) {
                            log_audit($con, $user_id, $module, 1,'Logged in the system');
                            $user_access = get_user_access($con, $user_user_type);

                            while ($access = $user_access) {
                                if ($access['name'] == 'DASHBOARD') {
                                    header("Location: ../common/dashboard.php");
                                    exit();
                                }

                                if ($access['name'] == 'POS') {
                                    header("Location: ../pos/point-of-sales.php");
                                    exit();
                                }

                                if($access['name'] == 'REPORTS-SALES') {
                                    header("Location: ../reports/reports-sales.php");
                                    exit();
                                }
        
                                if($access['name'] == 'REPORTS-DELIVERY') {
                                    header("Location: ../reports/reports-delivery-walkin.php");
                                    exit();
                                }

                                if($access['name'] == 'REPORTS-INVENTORY') {
                                    header("Location: ../reports/reports-inventory.php");
                                    exit();
                                }
                                
                
                                if($access['name'] == 'REPORTS-ITEM_ISSUE') {
                                    header("Location: ../reports/reports-item-issue.php");
                                    exit();
                                }

                                if($access['name'] == 'REPORTS-EXPENSE') {
                                    header("Location: ../reports/reports-expense.php");
                                    exit();
                                }
                                
                                if($access['name'] == 'REPORTS-ATTENDANCE') {
                                    header("Location: ../reports/reports-attendance.php");
                                    exit();
                                }
                               
                                if($access['name'] == 'ACCOUNT-ACCOUNT_TYPE') {
                                    header("Location: ../accounts/account-type.php");
                                    exit();
                                }
                                
                                if($access['name'] == 'ACCOUNT-USER_ACCOUNT') {
                                    header("Location: ../accounts/account.php");
                                    exit();
                                }
                                
                                if($access['name'] == 'CUSTOMER') {
                                    header("Location: ../customers/customer.php");
                                    exit();
                                }

                                if($access['name'] == 'EMPLOYEE-ATTENDANCE') {
                                    header("Location: ../employee/employee-attendance.php");
                                    exit();
                                }
                                
                
                                if($access['name'] == 'EMPLOYEE-LIST') {
                                    header("Location: ../employee/employee-list.php");
                                    exit();
                                }
                                
                
                                if($access['name'] == 'EXPENSE') {
                                    header("Location: ../expense/expense.php");
                                    exit();
                                }
                                
                
                                if($access['name'] == 'INVENTORY-ITEM') {
                                    header("Location: ../inventory/inventory-details.php");
                                    exit();
                                }
                                
                
                                if($access['name'] == 'INVENTORY-STOCKS') {
                                    header("Location: ../inventory/inventory-stocks.php");
                                    exit();
                                }
                                
                             
                                if($access['name'] == 'MONITORING-CUSTOMER_BALANCE') {
                                    header("Location: ../monitoring/monitoring-customer-balance.php");
                                    exit();
                                }
                                
                
                                if($access['name'] == 'MONITORING-DELIVERY_PICKUP') {
                                    header("Location: ../monitoring/monitoring-delivery-pickup.php");
                                    exit();
                                }
                                
                                if($access['name'] == 'MONITORING-ITEM_HISTORY') {
                                    header("Location: ../monitoring/monitoring-item-history.php");
                                    exit();
                                }
                            
                                if($access['name'] == 'MONITORING-POINT_OF_SALES_TRANSACTION') {
                                    header("Location: ../monitoring/monitoring-point-of-sales-transaction.php");
                                    exit();
                                }
                                
                                if($access['name'] == 'MONITORING-SCHEDULING') {
                                    header("Location: ../monitoring/monitoring-scheduling.php");
                                    exit();
                                }

                                if($access['name'] == 'SETTINGS-ARCHIVES') {
                                    header("Location: ../settings/settings-data-archive.php");
                                    exit();
                                }

                                if($access['name'] == 'SETTINGS-BACKUP_RESTORE') {
                                    header("Location: ../settings/settings-databackup-customers.php");
                                    exit();
                                }

                                if($access['name'] == 'SETTINGS-DATA_LOGS') {
                                    header("Location: ../settings/settings-datalogs.php");
                                    exit();
                                }
                
                                if($access['name'] == 'SETTINGS-HELP') {
                                    header("Location: ../settings/settings-help.php");
                                    exit();
                                }
                                
                            }
                        }
                    }
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

