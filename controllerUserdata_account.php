<?php 
session_start();
require "connectionDB.php";

$status = 0;
$errors = array();
$response = array(); 
$id = $_GET['edit'];
// if (isset($_POST['id'])){
    if(isset($_POST['user_id']) || isset($_POST['lastname']) || isset($_POST['firstname']) || isset($_POST['middlename'])
    || isset($_POST['contactnum']) || isset($_POST['usertypes']) 
    || isset($_FILES['profileimage']['name']) && ($_FILES['profileimage']['name']!="")){
       
       $userid = $_POST['user_id'];
       $lastname = $_POST['lastname'];
       $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
       $firstname = $_POST['firstname'];
       $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
       $middlename = $_POST['middlename'];
       $middlename = filter_var($middlename, FILTER_SANITIZE_STRING);
       $contact = $_POST['contactnum'];
       $contact = filter_var($contact, FILTER_SANITIZE_STRING);
       $usertype = $_POST['usertypes'];

       $old_image = $_POST['old_image'];
       $image = $_FILES['profileimage']['name'];
       $image_tmp_name = $_FILES['profileimage']['tmp_name'];
       $image_size = $_FILES['profileimage']['size'];
       $image_type = $_FILES['profileimage']['type'];

       $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
       $select->execute([$email]);
       
               $result =mysqli_query($con, "UPDATE users SET last_name='$lastname', first_name='$firstname', 
               middle_name='$middlename', contact_number='$contact', user_type='$usertype' WHERE id='$userid'");
              
               if($result){
                       move_uploaded_file($image_tmp_name, "uploaded_image/$image");
                       header("Location: Account-Updated-Success.php");
                       // $response['status'] = 1;
               }
               if(!empty($image)){
           
                       $update_image =mysqli_query($con, "UPDATE users SET profile_image ='$image' WHERE id='$id'");
                       if($result){
                           move_uploaded_file($image_tmp_name, "uploaded_image/$image");
                           header("Location: Account-Updated-Success.php");
                           // $response['status'] = 1;

                       }

               }
   }

    // if(isset($_POST['pass']) || isset($_POST['ecpass']) || isset($_POST['userid'])){
        if(isset($_POST['change'])){
                // $password = $_POST['password'];
                // $_SESSION['info'] = "";
             //    $id = $_POST['id'];
                // $userid = $_POST['userid'];
                $new_pass = mysqli_real_escape_string($con, $_POST['pass']);
                $confirm_pass = mysqli_real_escape_string($con, $_POST['ecpass']);
                $select = $conn->prepare("SELECT * FROM `users` WHERE password = ?");
                $select->execute([$password]);
                
                if($select->rowCount() > 0){
                    echo "<div class='message' style='display:block'><i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Create new password</div>";
                }else{
     
                    
                    if (strlen($_POST['pass']) < 8) {
                     //    $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Use 8 or more characters with a mix of letters, numbers & symbols";
                        echo "<div class='message' style='display:block'><i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Use 8 or more characters with a mix of letters, numbers & symbols</div>";
                     //    echo "<div class='bg-cpassDropdown' style='display:block'></div>";
                     //   $_SESSION['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Use 8 or more characters with a mix of letters, numbers & symbols";
                        // header("Location: Account-changepass-error1.php");
                        // header("Location: Account-Action-ChangePassword.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Use 8 or more characters with a mix of letters, numbers & symbols");
                    } else {
                        // $id = $_SESSION['id'];
                        if($new_pass !== $confirm_pass){
        // position: relative
                            echo "<div class='message' style='display:block'> <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Password don't matched </div>";
                         // $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Password don't matched";
                            // header("Location: Account-Password-Changed.php");
                        // header("Location: Account-Action-ChangePassword.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Use 8 or more characters with a mix of letters, numbers & symbols");
                        }else{
                            $encpass = password_hash($new_pass, PASSWORD_BCRYPT);
                            $run_query = mysqli_query($con, "UPDATE users SET password = '$encpass' WHERE id = '$id'");
                         //    $run_query = mysqli_query($con, $update_pass);
                            if($run_query){
                                // header("Location: Account-Password-Changed.php");
                                header("Location: Account-Password-Changed.php");
                            }
                        }   
                    }   
                }
        }
// $id = $_GET['edit'];
// $sqls="Select * From users WHERE id=$id";
// $results=mysqli_query($con,$sqls);
// $rows = mysqli_fetch_assoc($results);
// $lastname=$rows['last_name'];
// $firstname=$rows['first_name'];
// $middlename=$rows['middle_name']; 
// $email=$rows['email']; 
// $contact=$rows['contact_number']; 
// $usertype=$rows['user_type']; 
// $image=$rows['profile_image'];
 
//     if(isset($_POST['lastname']) || isset($_POST['firstname']) || isset($_POST['middlename'])
//      || isset($_POST['contactnum']) || isset($_POST['usertypes']) 
//      || isset($_FILES['profileimage']['name']) && ($_FILES['profileimage']['name']!="")){

//         $lastname = $_POST['lastname'];
//         $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
//         $firstname = $_POST['firstname'];
//         $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
//         $middlename = $_POST['middlename'];
//         $middlename = filter_var($middlename, FILTER_SANITIZE_STRING);
//         $contact = $_POST['contactnum'];
//         $contact = filter_var($contact, FILTER_SANITIZE_STRING);
//         $usertype = $_POST['usertypes'];

//         $old_image = $_POST['old_image'];
//         $image = $_FILES['profileimage']['name'];
//         $image_tmp_name = $_FILES['profileimage']['tmp_name'];
//         $image_size = $_FILES['profileimage']['size'];
//         $image_type = $_FILES['profileimage']['type'];

//         $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
//         $select->execute([$email]);
        
//                 $result =mysqli_query($con, "UPDATE users SET last_name='$lastname', first_name='$firstname', 
//                 middle_name='$middlename', contact_number='$contact', user_type='$usertype' WHERE id='$id'");
               
//                 if($result){
//                         move_uploaded_file($image_tmp_name, "uploaded_image/$image");
//                         header("Location: Account-Updated-Success.php");
//                         // $response['status'] = 1;
//                 }
//                 if(!empty($image)){
            
//                         $update_image =mysqli_query($con, "UPDATE users SET profile_image ='$image' WHERE id='$id'");
//                         if($result){
//                             move_uploaded_file($image_tmp_name, "uploaded_image/$image");
//                             header("Location: Account-Updated-Success.php");
//                             // $response['status'] = 1;

//                         }

//                 }
    // }
// $id = $_GET['edit'];
//      if(isset($_POST['pass']) || isset($_POST['ecpass'])){
//         // if(isset($_POST['change'])){
//                 // $password = $_POST['password'];
//                 // $_SESSION['info'] = "";
//                 $new_pass = mysqli_real_escape_string($con, $_POST['pass']);
//                 $confirm_pass = mysqli_real_escape_string($con, $_POST['ecpass']);
//                 $select = $conn->prepare("SELECT * FROM `users` WHERE password = ?");
//                 $select->execute([$password]);
                
//                 // if($select->rowCount() > 0){
//                 //     $response['message'] =  "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Create new password";
    
//                 // }else{
    
                    
//                     if (strlen($_POST['pass']) < 8) {
//                         // $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Use 8 or more characters with a mix of letters, numbers & symbols";
//                         echo "<p class='message'> <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Use 8 or more characters with a mix of letters, numbers & symbols </p>";
//                         // header("Location: Account-changepass-error1.php");
//                         // header("Location: Account-Action.php?message=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Use 8 or more characters with a mix of letters, numbers & symbols");
//                     } else {
//                         // $id = $_SESSION['id'];
//                         if($new_pass !== $confirm_pass){
//                             echo "<p class='message'> <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Password don't matched </p>";
//                             // $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Password don't matched";
//                             // header("Location: Account-Password-Changed.php");
//                         }else{
//                             $encpass = password_hash($new_pass, PASSWORD_BCRYPT);
//                             $update_pass = "UPDATE users SET password = '$encpass' WHERE id = '$id'";
//                             $run_query = mysqli_query($con, $update_pass);
//                             if($run_query){
//                                 // header("Location: Account-Password-Changed.php");
//                                 header("Location: Account-Password-Changed.php");
//                             }else{

//                             }
//                         }   
//                     }   
//                 }
            // }
    echo json_encode($response); 
?>