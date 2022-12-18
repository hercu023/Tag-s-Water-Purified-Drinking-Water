<?php

if(isset($_POST['filter-expense'])) {
    if (isset($_POST['date-from'])
        && (isset($_POST['date-to'])))
    {
        if(empty($_POST['date-from'])) {
            header("Location: ../reports/reports-expense.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Please select a 'FROM' Date!");
            exit();
        }

        if(empty($_POST['date-to'])) {
            header("Location: ../reports/reports-expense.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Please select a 'TO' Date!");
            exit();
        }

        $date_from = $_POST['date-from'];
        $date_to = $_POST['date-to'];

        //Validate if from date is later than to date
        if($date_from > $date_to) {
            header("Location: ../reports/reports-expense.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> 'FROM' date cannot be later than 'TO' date");
            exit();
        }

        header("Location: ../reports/reports-expense.php?from=". $date_from .'&'.'to='.$date_to);
    }
}