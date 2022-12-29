<?php
require "../database/connection-db.php";
require_once "../audit/audit-logger.php";

if(isset($_POST['save-weekly-schedule'])){

    if(isset($_POST['saturday'])) {
        header("Location: ../common/error-page.php?error=HERE".$_POST['saturday']);
        exit();
    }
    
}
?>
