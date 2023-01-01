<?php

function get_month_sales_data($con, $month, $year) {
    $total_sales_query = "SELECT
                        IF(SUM(transaction.total_amount) IS NULL or SUM(transaction.total_amount) = '', 0, SUM(transaction.total_amount)) as total
                        FROM transaction
                        WHERE transaction.status_id = '1'
                        AND MONTHNAME(transaction.created_at_date) = '$month'
                        AND YEAR(transaction.created_at_date) = '$year'";
    $total_sales_result = mysqli_query($con, $total_sales_query);
    $total_sales = mysqli_fetch_assoc($total_sales_result);
    return $total_sales['total'];
}
?>