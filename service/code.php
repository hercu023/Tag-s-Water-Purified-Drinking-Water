<?php
session_start();
if(isset($_POST['submit-checkall'])){
        if(isset($_POST['select-check'])){

        $all_id = $_POST['select-check'];

        $extract_id = implode(',' , $all_id);

        // echo $extract_id;
        $result= mysqli_query($con, 
                "UPDATE users SET status_archive_id 
                = '1' 
                WHERE user_id = $id IN($extract_id)");
                if($result){
                    header("Location: ../settings/settings-restore-account-success.php?restore_success=User Account Restored Successful");
                } else {
                    header("Location: ../common/error-page.php?error=".mysqli_error($con));
                }    
            }
        }
        ?>