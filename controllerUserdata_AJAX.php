<?php 
session_start();
require "connectionDB.php";
$response = array(); 


// if(isset($_POST['submit'])){
if(isset($_POST['lastname']) || isset($_POST['firstname']) || isset($_POST['middlename'])
|| isset($_POST['email']) || isset($_POST['contactnum']) || isset($_POST['usertypes']) 
|| isset($_POST['pass']) || isset($_POST['encpass']) || isset($_POST['profile_image'])){

    
    // $status = 0;
    
    $lastname = $_POST['lastname'];
    $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
    $firstname = $_POST['firstname'];
    $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
    $middlename = $_POST['middlename'];
    $middlename = filter_var($middlename, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $contact = $_POST['contactnum'];
    $contact = filter_var($contact, FILTER_SANITIZE_STRING);
    $usertype = $_POST['usertypes'];
    $pass = mysqli_real_escape_string($con, $_POST['pass']);
    $encpass = mysqli_real_escape_string($con, $_POST['encpass']);

    $image = $_FILES['profile_image']['name'];
    $image_tmp_name = $_FILES['profile_image']['tmp_name'];
    $image_size = $_FILES['profile_image']['size'];
    $image_folder = 'uploaded_image/'.$image;

    $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select->execute([$email]);
    
    if($select->rowCount() > 0){
        $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Email already exist! ";
        // header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Email already exist.");
    }else{
        if($pass != $encpass){
            $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Password does not matched.";
            // header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Password does not matched.");
        }elseif($image_size > 2000000){
            $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Image is too large.";
            // header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Image is too large.");
        }else{
            $cpass = password_hash($pass, PASSWORD_BCRYPT);
            $insert = mysqli_query($con, "INSERT INTO users VALUES('','$lastname', '$firstname', '$middlename', '$email', '$cpass', '$contact', '','$usertype','', '$image')");
            // $insert->execute([$lastname, $firstname, $middlename, $email, $pass, $contact, $address, $image]);
            if($insert){
                $response['status'] = 1;
                // $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Registered Successfully!";
                move_uploaded_file($image_tmp_name, $image_folder);
                // header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Registered successfully.");
            }
        }
    }

    
  
}
echo json_encode($response); 


// $admin_id = $_SESSION['admin_id'];

// if(!isset($admin_id)){
//    header('location:login.php');
// };

// if(isset($_POST['update'])){

//     $lastname = $_POST['lastname'];
//     $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
//     $firstname = $_POST['firstname'];
//     $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
//     $middlename = $_POST['middlename'];
//     $middlename = filter_var($middlename, FILTER_SANITIZE_STRING);
//     $email = $_POST['email'];
//     $email = filter_var($email, FILTER_SANITIZE_STRING);
//     $contact = $_POST['contactnum'];
//     $contact = filter_var($contact, FILTER_SANITIZE_STRING);
//     $usertype = $_POST['usertypes'];
    
//     $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
//     $update_profile->execute([$lastname,  $firstname,  $middlename, $email,  $contact, $usertype, $admin_id]);
 
//     $old_image = $_POST['old_image'];
//     $image = $_FILES['image']['name'];
//     $image_tmp_name = $_FILES['image']['tmp_name'];
//     $image_size = $_FILES['image']['size'];
//     $image_folder = 'uploaded_img/'.$image;
 
//     if(!empty($image)){
 
//        if($image_size > 2000000){
//           $message[] = 'image size is too large';
//        }else{
//           $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
//           $update_image->execute([$image, $admin_id]);
 
//           if($update_image){
//              move_uploaded_file($image_tmp_name, $image_folder);
//              unlink('uploaded_img/'.$old_image);
//              $message[] = 'image has been updated!';
//           }
//        }
 
//     }
 
//     $old_pass = $_POST['old_pass'];
//     $previous_pass = md5($_POST['previous_pass']);
//     $previous_pass = filter_var($previous_pass, FILTER_SANITIZE_STRING);
//     $new_pass = md5($_POST['new_pass']);
//     $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
//     $confirm_pass = md5($_POST['confirm_pass']);
//     $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);
 
//     if(!empty($previous_pass) || !empty($new_pass) || !empty($confirm_pass)){
//        if($previous_pass != $old_pass){
//           $response['message'] = 'old password not matched!';
//        }elseif($new_pass != $confirm_pass){
//           $response['message'] = 'confirm password not matched!';
//        }else{
//           $response['status'] = 1;
//           $update_password = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
//           $update_password->execute([$confirm_pass, $admin_id]);
//        }
//     }
 
//  }
?>
   