<?php
session_start();
require "../database/connection-db.php";

if (isset($_POST['restore-customer'])) {
    if(isset($_POST['id'])){

        $id = $_POST['id'];

        $result =mysqli_query($con, 
        "UPDATE customers SET status_archive_id 
        = '1' 
        WHERE id = $id");
        if($result){
            header("Location: ../settings/settings-restore-customers-success.php?restore_success=Customer Restored Successful");
        } else {
            header("Location: ../common/error-page.php?error=".mysqli_error($con));
        }    
    }
}

// if (isset($_POST['restore-account'])) {
//     if(isset($_POST['id'])){

//         $id = $_POST['id'];

//         $result =mysqli_query($con, 
//         "UPDATE users SET status_archive_id 
//         = '1' 
//         WHERE user_id = $id");
//         if($result){
//             header("Location: ../settings/settings-restore-account-success.php?restore_success=Account Restored Successful");
//         } else {
//             header("Location: ../common/error-page.php?error=".mysqli_error($con));
//         }    
//     }
// }

if (isset($_POST['restore-inventory'])) {
    if(isset($_POST['id'])){

        $id = $_POST['id'];

        $result =mysqli_query($con, 
        "UPDATE inventory_item SET status_archive_id 
        = '1' 
        WHERE id = $id");
        if($result){
            header("Location: ../settings/settings-restore-inventory-success.php?restore_success=Inventory Item Restored Successful");
        } else {
            header("Location: ../common/error-page.php?error=".mysqli_error($con));
        }    
    }
}
if (isset($_POST['restore-account'])) {
    if(isset($_POST['user_id'])){

        $id = $_POST['user_id'];

        $result =mysqli_query($con, 
        "UPDATE users SET status_archive_id 
        = '1' 
        WHERE user_id = $id");
        if($result){
            header("Location: ../settings/settings-restore-account-success.php?restore_success=User Account Restored Successful");
        } else {
            header("Location: ../common/error-page.php?error=".mysqli_error($con));
        }    
    }
}
    if(isset($_POST['submit-checkall-inventory'])){

        $all_id = $_POST['select-check'];

        $extract_id = implode(',' , $all_id);

        $result= mysqli_query($con, 
                "UPDATE inventory_item SET status_archive_id 
                = '1' 
                WHERE id 
                IN ($extract_id)");
                if($result){
                    header("Location: ../settings/settings-restore-inventory-success.php?restore_success=Inventory Item Restored Successful");
                } else {
                    header("Location: ../common/error-page.php?error=".mysqli_error($con));
                }   
        }
    if(isset($_POST['submit-checkall-customers'])){

        $all_id = $_POST['select-check'];
    
        $extract_id = implode(',' , $all_id);
    
        $result= mysqli_query($con, 
                "UPDATE customers SET status_archive_id 
                = '1' 
                WHERE id 
                IN ($extract_id)");
                if($result){
                    header("Location: ../settings/settings-restore-customers-success.php?restore_success=Customer Restored Successful");
                } else {
                    header("Location: ../common/error-page.php?error=".mysqli_error($con));
                }   
        }
    if(isset($_POST['submit-checkall-account'])){

        $all_id = $_POST['select-check'];
        
        $extract_id = implode(',' , $all_id);
        
        $result= mysqli_query($con, 
                "UPDATE users SET status_archive_id 
                = '1' 
                WHERE user_id 
                IN ($extract_id)");
                if($result){
                    header("Location: ../settings/settings-restore-account-success.php?restore_success=Account Restored Successful");
                } else {
                    header("Location: ../common/error-page.php?error=".mysqli_error($con));
                }   
        }       
?>
