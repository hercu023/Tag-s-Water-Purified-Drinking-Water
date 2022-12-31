<?php

if(isset($_POST['filter-report'])) {
    if (isset($_POST['date-from'])
        && (isset($_POST['date-to']))
        && (isset($_POST['module'])))
    {

        if(empty($_POST['date-from'])) {
            
            if($module == 'expense') {
                header("Location: ../reports/reports-expense.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Please select a 'FROM' Date!");
                exit();
            } 
            
            if($module == 'attendance') {
                header("Location: ../reports/reports-attendance.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Please select a 'FROM' Date!");
                exit();
            }

            if($module == 'inventory') {
                header("Location: ../reports/reports-inventory.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Please select a 'FROM' Date!");
                exit();
            }

            if($module == 'delivery') {
                header("Location: ../reports/reports-delivery.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Please select a 'FROM' Date!");
                exit();
            }
        }

        if(empty($_POST['date-to'])) {

            if($module == 'expense') {
                header("Location: ../reports/reports-expense.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Please select a 'TO' Date!");
                exit();
            } 
            
            if($module == 'attendance') {
                header("Location: ../reports/reports-attendance.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Please select a 'TO' Date!");
                exit();
            }

            if($module == 'inventory') {
                header("Location: ../reports/reports-inventory.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Please select a 'TO' Date!");
                exit();
            }

            if($module == 'delivery') {
                header("Location: ../reports/reports-delivery.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Please select a 'TO' Date!");
                exit();
            }
        }

        $date_from = $_POST['date-from'];
        $date_to = $_POST['date-to'];
        $module = $_POST['module'];

        //Validate if from date is later than to date
        if($date_from > $date_to) {
            if($module == 'expense') {
                header("Location: ../reports/reports-expense.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> 'FROM' date cannot be later than 'TO' date");
                exit();
            } 
            
            if($module == 'attendance') {
                header("Location: ../reports/reports-attendance.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> 'FROM' date cannot be later than 'TO' date");
                exit();
            }

            if($module == 'inventory') {
                header("Location: ../reports/reports-inventory.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> 'FROM' date cannot be later than 'TO' date");
                exit();
            }

            if($module == 'delivery') {
                header("Location: ../reports/reports-delivery.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> 'FROM' date cannot be later than 'TO' date");
                exit();
            }
        }

        if($module == 'expense') {
            header("Location: ../reports/reports-expense.php?option=Daily".'&from='. $date_from .'&'.'to='.$date_to);
            exit();
        }
        
        if($module == 'attendance') {
            header("Location: ../reports/reports-attendance.php?option=Daily".'&from='. $date_from .'&'.'to='.$date_to);
            exit();
        }

        if($module == 'inventory') {
            header("Location: ../reports/reports-inventory.php?option=Daily".'&from='. $date_from .'&'.'to='.$date_to);
            exit();
        }

        if($module == 'delivery') {
            header("Location: ../reports/reports-delivery.php?option=Daily".'&from='. $date_from .'&'.'to='.$date_to);
            exit();
        }
    }
}