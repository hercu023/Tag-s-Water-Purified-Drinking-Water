<?php 
session_start();
require "connectionDB.php";
// $email = "";
// $name = "";
// $lastname= "";
// $firstname= "";
// $middlename= "";
// $email= "";
// $contactnum= "";

$status = 0;
$errors = array();

$id = $_GET['edit'];
$sqls="Select * From users WHERE id=$id";
$results=mysqli_query($con,$sqls);
$rows = mysqli_fetch_assoc($results);
$lastname=$rows['last_name'];
$firstname=$rows['first_name'];
$middlename=$rows['middle_name']; 
$email=$rows['email']; 
$contact=$rows['contact_number']; 
$usertype=$rows['user_type']; 
$image=$rows['profile_image'];
$password=$rows['password'];
 
// if(isset($_POST['update'])){
    if(isset($_POST['lastname']) || isset($_POST['firstname']) || isset($_POST['middlename'])
        || isset($_POST['email']) || isset($_POST['contactnum']) || isset($_POST['usertypes'])){

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

        if(isset($_FILES['profile_image']['name']) && ($_FILES['profile_image']['name']!="")){
            
            $old_image = $_POST['old_image'];
            $image = $_FILES['profile_image']['name'];
            $image_tmp_name = $_FILES['profile_image']['tmp_name'];
            $image_size = $_FILES['profile_image']['size'];
            $image_folder = 'uploaded_image/'.$image;
            
            unlink('uploaded_image/'.$old_image);
            move_uploaded_file($image_tmp_name, $image_folder);
           
        // $update_profile = $conn->prepare("UPDATE `users` SET last_name = ?, first_name = ?, middle_name = ?, email = ?, contact_num = ?, user_type = ? WHERE id = ?");
        // $update_profile->execute([$lastname, $firstname, $middlename, $email, $contact, $usertype, $user_id]);
        // $insert = mysqli_query($con, "UPDATE users SET('','$lastname', '$firstname', '$middlename', '$email', '', '$contact', '$usertype','', '') WHERE id='$id'");
        // $sql =;
        $result =mysqli_query($con, "UPDATE users SET last_name='$lastname', 
        first_name='$firstname', middle_name='$middlename', email='$email', 
        contact_number='$contact', user_type='$usertype', 
        profile_image = '$image' WHERE id='$id'");
        if($result){
            // header('location:Account.php');
            $response['status'] = 1;
            
        }
        else{
            die(mysqli_error($con));
            $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Database error.";
        }
      
        
              
                    // if($image_size > 2000000){
                    //         // $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i>Image size is too large";
                    //  }else{
                    // $update_image = $conn->prepare("UPDATE `users` SET profile_image = '$image' WHERE id = '$id'");
                    // $update_image->execute([$image, $user_id]);
                        
                    //     if($update_image){
                    //         move_uploaded_file($image_tmp_name, $image_folder);
                    //         unlink('uploaded_image/'.$old_image);
                    //            // $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Image updated! ";
                    //     }
                    // }
        }
    }
// if(isset($_POST['change'])){

//    $old_pass = $_POST['old_pass'];
//    $previous_pass = md5($_POST['opass']);
//    $previous_pass = filter_var($previous_pass, FILTER_SANITIZE_STRING);
//    $new_pass = md5($_POST['pass']);
//    $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
//    $confirm_pass = md5($_POST['encpass']);
//    $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

//       if($previous_pass != $old_pass){
//         $response['message'] =  'old password not matched!';
//       }elseif($new_pass != $confirm_pass){
//         $response['message'] =  'confirm password not matched!';
//       }else{
//          $update_password = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
//          $update_password->execute([$confirm_pass]);
//          $response['message'] =  'password has been updated!';
//       }
// }
// $id = $_GET['id'];
$user_id = $_SESSION['user_id'];
// if(isset($_POST['update'])){
//     // if(isset($_POST['lastname']) || isset($_POST['firstname']) || isset($_POST['middlename'])
//     // || isset($_POST['email']) || isset($_POST['contactnum']) || isset($_POST['usertypes']) 
//     // ||  isset($_POST['profile_image'])){

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

//     $update_profile = $conn->prepare("UPDATE `users` SET last_name = ?, first_name = ?, middle_name = ?, email = ?, contactnum = ?, usertypes = ? WHERE id = ?");
//     $update_profile->execute([$lastname, $firstname, $middlename, $email, $contact, $usertype, $image, $user_id]);
 
//     $old_image = $_POST['old_image'];
//     $image = $_FILES['profile_image']['name'];
//     $image_tmp_name = $_FILES['profile_image']['tmp_name'];
//     $image_size = $_FILES['profile_image']['size'];
//     $image_folder = 'uploaded_image/'.$image;
    
    
//     if(!empty($image)){

//         if($image_size > 2000000){
//             $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i>Image size is too large";
//         }else{
//         $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
//         $update_image->execute([$image, $user_id]);

//             if($update_image){
//                 move_uploaded_file($image_tmp_name, $image_folder);
//                 unlink('uploaded_image/'.$old_image);
//                 $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Image updated! ";
//             }
//         }

//      }
//         $sql = "UPDATE users SET last_name ='$lastname', first_name ='$firstname', middle_name ='$middlename', email ='$email',
//         contact_number ='$contact', user_type ='$usertype', profile_image ='$image' WHERE id=$id";

//         $result = mysqli_query($conn, $sql);

//         if($result){
//             $response['status'] = 1;
//             // $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Record Updated";
//         }
//     }

//  if(isset($_GET['edit'])){
//     $id = $_GET['edit'];
//     $result = $mysqli->query("SELECT * FROM users WHERE id=$id") or die(mysqli->error());
//     if (count($result)==1){
//         $row = $result->fetch_array();
//         $email = $row['email'];
//         $lastname= $row['last_name'];
//         $firstname= $row['first_name'];
//         $middlename= $row['middle_name'];
//         $contactnum= $row['contact_number'];
//     }
// }
 // if(isset($_POST['submit'])){
// if(isset($_POST['login-now'])){
//     header('Location: login.php');
// }
$response = array(); 

echo json_encode($response); 
?>