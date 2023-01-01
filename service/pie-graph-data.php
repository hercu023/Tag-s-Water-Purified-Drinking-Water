<?php
date_default_timezone_set("Asia/Manila");

function get_salaries_count($con) {
    return get_expense_type_count($con, 'Salary');
}

function get_utilities_count($con) {

    return get_expense_type_count($con, 'Utilities');
}

function get_maintenance_count($con) {
    return get_expense_type_count($con, 'Maintenance');
}

function get_other_expenses_count($con) {
    return get_expense_type_count($con, 'Other Expenses');
}

function get_expense_type_count($con, $expense_type) {
    $month = date("F");
    $year = date("Y");
    $expense_type_query = mysqli_query($con, "SELECT 
                                            IF(SUM(expense.amount) IS NULL or SUM(expense.amount) = '', 0, SUM(expense.amount)) as total
                                            FROM expense
                                            INNER JOIN expense_type
                                            ON expense.expense_type_id = expense_type.id
                                            WHERE expense_type.name = '$expense_type'
                                            AND MONTHNAME(expense.date) = '$month'
                                            AND YEAR(expense.date) = '$year';");
    $expense_type_result = mysqli_fetch_assoc($expense_type_query);
    $expense_type = $expense_type_result['total'];
    return $expense_type;
}

?>