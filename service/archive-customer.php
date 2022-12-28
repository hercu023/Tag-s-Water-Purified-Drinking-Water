<?php
session_start();
require_once "../database/connection-db.php";
require_once "../audit/audit-logger.php";
$module = 'CUSTOMER';

if (isset($_POST['archive-customer'])) {
    if(isset($_POST['id'])){

        $user_id = $_SESSION['user_user_id'];
        $customer_id = $_POST['id'];

        $check_credit_result = mysqli_query($con, "SELECT 
                                                    SUM(t.unpaid_amount) as credit
                                                    FROM
                                                    (SELECT
                                                    customers.id,
                                                    customers.customer_name,
                                                    customers.contact_number1,
                                                    customers.address, 
                                                    customers.balance,
                                                    transaction_history.transaction_uuid,
                                                    MIN(transaction_history.unpaid_amount) as unpaid_amount
                                                    FROM transaction_history
                                                    INNER JOIN transaction
                                                    ON transaction.uuid = transaction_history.transaction_uuid
                                                    INNER JOIN customers
                                                    on transaction.customer_name_id = customers.id
                                                    WHERE customers.status_archive_id = 1
                                                    AND customers.id = '$customer_id'
                                                    GROUP BY transaction_history.transaction_uuid) 
                                                    t GROUP BY t.customer_name");
        //Check if customer has unpaid transactions
        if (mysqli_num_rows($check_credit_result) > 0) {

            $credit = mysqli_fetch_assoc($check_credit_result)['credit'];
            $credit = filter_var($credit, FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

            if ($credit > 0) {
                header("Location: ../customers/customer.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Archive failed. Customer has unpaid transactions.");
                exit();
            }
        }
        
        $result =mysqli_query($con, "UPDATE customers SET status_archive_id = '2' WHERE id = '$customer_id'");
        if($result){
            log_audit($con, $user_id, $module, 1, 'Archived customer with id: '.$customer_id);
            header("Location: ../customers/customer-success.php?archive_success=Customer Archived Successful");
        } else {
            log_audit($con, $user_id, $module, 0, 'Error processing database.');
            header("Location: ../common/error-page.php?error=" . mysqli_error($con));
        }
    }
}
