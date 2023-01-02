<?php
require "../database/connection-db.php";

date_default_timezone_set("Asia/Manila");

if(isset($_POST['backup-db'])){
    include ('dumper.php');

    try {
        delete_all_backup();
        $date = date("F-j-Y-h-i-s-A");
        $hostName = "localhost";
        $userName = "root";
        $password = "";
        $db_name = "acc_db";
        $world_dumper = Shuttle_Dumper::create(array(
            'host' => $hostName,
            'username' => $userName ,
            'password' => $password,
            'db_name' => $db_name,
        ));

        // dump the database to plain text file
        $world_dumper->dump('../backup/tagswater_'.$date.'_db.sql');
        echo 
        '<script>
            var popwin = location.replace("../backup/tagswater_'.$date.'_db.sql"); 
            window.setTimeout(function(){
                location.replace("../settings/settings-databackup.php?success=Data Back Up Successful.");
                
            }, 500);
        </script>';
        unlink("../backup/tagswater_'.$date.'_db.sql");

        }catch(ex){

        }
    }
    function delete_all_backup(){

        $folder_path = "../backup";

        $files = glob($folder_path . '/*');

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

    function delete_all_restore(){

        $folder_path = "../restore";

        $files = glob($folder_path . '/*');

        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

    if(isset($_POST['restore'])){
        delete_all_restore();
    
            if (! empty($_FILES)) {
                
                if (! in_array(strtolower(pathinfo($_FILES["backup_file"]["name"], PATHINFO_EXTENSION)), array(
                    "sql"
                ))) {
                    header("location: ../settings/settings-databackup.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> This file is not supported. Only SQL file are accepted.");
                    exit();
              
                } else {
                    if (is_uploaded_file($_FILES["backup_file"]["tmp_name"])) {
                    
                        $conn = mysqli_connect("localhost", "root", "", "acc_db");
                        $filename = $_FILES['backup_file']['name'];
                        $filename_tmp_name = $_FILES['backup_file']['tmp_name'];
                        $restore_folder = '../restore/' . $filename;
                        move_uploaded_file($filename_tmp_name, $restore_folder);
                        restoreMysqlDB($restore_folder, $conn);
                        delete_all_session($conn);
                        echo '<script> location.replace("../auth/logout.php"); </script>';
                    
                    }
                }
            } else {
                header("location: ../settings/settings-databackup.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> No selected file.");
                exit();
        }
    }
    
      
function restoreMysqlDB($filePath, $conn)
{
    $sql = '';
    $error = '';

    if (file_exists($filePath)) {

        $lines = file($filePath);

        foreach ($lines as $line) {
            
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }
            
            $sql .= $line;
            
            if (substr(trim($line), - 1, 1) == ';') {
                $result = mysqli_query($conn, $sql);
                if (! $result) {
                    $error .= mysqli_error($conn) . "\n";
                }
                $sql = '';
            }
        } 
        
    } 
}

function delete_all_session($conn){
    $delete = mysqli_query($conn, "DELETE FROM user_session;");
}
?>