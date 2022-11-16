<?php 
session_start();
require "connectionDB.php";
$email = "";
$name = "";
$lastname= "";
$firstname= "";
$middlename= "";
$email= "";
$contactnum= "";

$status = 0;
// $status_customer = 0;

$errors = array();

if(isset($_POST['code-verfiy'])){
        // $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $update_otp = "UPDATE users SET code = $code WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['full_name'] = $name;
                $_SESSION['email'] = $email;
                header('location: changePassword.php');
                exit();
            }else {
                header("Location: code-verification.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed while updating code.");
            }
        }else {
            header("Location: code-verification.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> You've entered incorrect code.");
        }
    }
   
    if (isset($_POST['check-email'])) {
        // $disable = $_POST['check-email'];
        // $disable.attr('disable', 'disable');
        $email = $_POST['email'];
        $_SESSION['email'] = $email;
        $emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
        $emailCheckResult = mysqli_query($con, $emailCheckQuery);
       
        // if query run
        if ($emailCheckResult) {
            // if email matched
            if (mysqli_num_rows($emailCheckResult) > 0) {
            //   $(function()
            //   {
            //     $("#submitBtn"))
                   
                 
                    $code = rand(999999, 111111);
                    $updateQuery = "UPDATE users SET code = $code WHERE email = '$email'";
                    $updateResult = mysqli_query($con, $updateQuery);
                    // $_POST['check-email'] = $this->disable='false';
                    if ($updateResult) {
                        $subject = 'Tags Water System Verification Code';
                        $message = "We received a request to reset your password.
                        Here is the verification code $code";
                        $sender = 'From: narutosasuke454545@gmail.com';

                        if (mail($email, $subject, $message, $sender)) {
                            $message = "We've sent a verification code to your Email <br> <ins><strong>$email</ins></strong>";

                            $_SESSION['message'] = $message;
                            header('location: code-verification.php');
                        }else{
                             header("Location: forgot.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed while sending code");
                        }
                    }else {
                        header("Location: forgot.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Something went wrong");
                    
                }
            }else{
                header("Location: forgot.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> This email address does not exist to the system");
            }
        }else {
           header("Location: forgot.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed while checking email from database");
        }
    }

    if(isset($_POST['Change-Password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($con, $_POST['newpassword']);
        $cpassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);
        if (strlen($_POST['newpassword']) < 8) {
            header("Location: changePassword.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Use 8 or more characters with a mix of letters, numbers & symbols");
        } else {
            if($password !== $cpassword){
                header("Location: changePassword.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Password don't matched");
            }else{
            
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_BCRYPT);
            $update_pass = "UPDATE users SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($con, $update_pass);
            if($run_query){
                header('Location: PwChanged-Confirm.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
}
$response = array( 'status' => 0); 

 // if(isset($_POST['submit'])){
if(isset($_POST['login-now'])){
    header('Location: login.php');
}


// // if(isset($_POST['submit'])){
if(isset($_POST['lastname']) || isset($_POST['firstname']) || isset($_POST['middlename'])
|| isset($_POST['email']) || isset($_POST['contactnum']) || isset($_POST['usertypes']) 
|| isset($_POST['pass']) || isset($_POST['ecpass']) || isset($_POST['profile_image'])){
    
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
    $encpass = mysqli_real_escape_string($con, $_POST['ecpass']);

   
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
            $insert = mysqli_query($con, "INSERT INTO users VALUES('','$lastname', '$firstname', '$middlename', '$email', '$cpass', '$contact', '$usertype','', '$image','')");
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
if(isset($_POST['customername']) || isset($_POST['address']) || isset($_POST['contactnum']) || isset($_POST['balance']) 
|| isset($_POST['note'])){
// if(isset($_POST['customername']) || isset($_POST['address']) || isset($_POST['contactnum']) || isset($_POST['balance']) 
//     || isset($_POST['note'])){
// $status = 0;

    $customername = $_POST['customername'];
    $customername = filter_var($customername, FILTER_SANITIZE_STRING);
    $address = $_POST['address'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $contact = $_POST['contactnum'];
    $contact = filter_var($contact, FILTER_SANITIZE_STRING);
    $balance = $_POST['balance'];
    $balance = filter_var($balance, FILTER_SANITIZE_STRING);
    $note = $_POST['note'];

    $selects = $conn->prepare("SELECT * FROM `customers` WHERE customer_name = ?");
    $selects->execute([$customername]);

    if($selects->rowCount() > 0){
    $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Customer already exist! ";
    // header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Email already exist.");
    }else{
        $insert = mysqli_query($con, "INSERT INTO customers VALUES('','$customername', '$address', '$contact', '$note', '$balance','')");
        // $insert->execute([$lastname, $firstname, $middlename, $email, $pass, $contact, $address, $image]);
        
        if($insert){
            $response['status'] = 1;

        }
    }
}
// if(isset($_POST['pass']) || isset($_POST['ecpass']) || isset($_POST['userid'])){
//     // if(isset($_POST['change'])){
//             // $password = $_POST['password'];
//             // $_SESSION['info'] = "";
//          //    $id = $_POST['id'];
//             $userid = $_POST['userid'];
//             $new_pass = mysqli_real_escape_string($con, $_POST['pass']);
//             $confirm_pass = mysqli_real_escape_string($con, $_POST['ecpass']);
//             $select = $conn->prepare("SELECT * FROM `users` WHERE password = ?");
//             $select->execute([$password]);
            
//             // if($select->rowCount() > 0){
//             //     $response['message'] =  "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Create new password";
//             // }else{
 
                
//                 if (strlen($_POST['pass']) < 8) {
//                  //    $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Use 8 or more characters with a mix of letters, numbers & symbols";
//                     echo "<div class='message' style='display:block'></div>";
//                  //    echo "<div class='bg-cpassDropdown' style='display:block'></div>";
//                  //   $_SESSION['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Use 8 or more characters with a mix of letters, numbers & symbols";
//                     // header("Location: Account-changepass-error1.php");
//                     // header("Location: Account-Action-ChangePassword.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Use 8 or more characters with a mix of letters, numbers & symbols");
//                 } else {
//                     // $id = $_SESSION['id'];
//                     if($new_pass !== $confirm_pass){
//                         echo "<div class='message' style='display:block'> <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Password don't matched </div>";
//                      // $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Password don't matched";
//                         // header("Location: Account-Password-Changed.php");
//                     // header("Location: Account-Action-ChangePassword.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Use 8 or more characters with a mix of letters, numbers & symbols");
//                     }else{
//                         $encpass = password_hash($new_pass, PASSWORD_BCRYPT);
//                         $run_query = mysqli_query($con, "UPDATE users SET password = '$encpass' WHERE id = '$userid'");
//                      //    $run_query = mysqli_query($con, $update_pass);
//                         if($run_query){
//                             // header("Location: Account-Password-Changed.php");
//                             header("Location: Account-Password-Changed.php");
//                         }else{
 
//                         }
//                     }   
//                 }   
//             }
// if(isset($_POST['customername']) || isset($_POST['address']) || isset($_POST['contactnum']) || isset($_POST['balance']) 
// || isset($_POST['note'])){

// if(isset($_POST['submitCustomer'])){
// // $status = 0;

// $customername = $_POST['customername'];
// $customername = filter_var($customername, FILTER_SANITIZE_STRING);
// $address = $_POST['address'];
// $address = filter_var($address, FILTER_SANITIZE_STRING);
// $contact = $_POST['contactnum'];
// $contact = filter_var($contactnum, FILTER_SANITIZE_STRING);
// $balance = $_POST['balance'];
// $balance = filter_var($balance, FILTER_SANITIZE_STRING);
// $note = $_POST['note'];


// $selects = $conn->prepare("SELECT * FROM `customers` WHERE customer_name = ?");
// $selects->execute([$customername]);

// if($selects->rowCount() > 0){
//     $response_customer['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Customer already exist! ";
//     // header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Email already exist.");
// }else{
//         $inserts = mysqli_query($con, "INSERT INTO customers VALUES('','$customername', '$address', '$contact', '$balance', '$note')");
//         // $insert->execute([$lastname, $firstname, $middlename, $email, $pass, $contact, $address, $image]);
//         if($inserts){
//             $response_customer['status'] = 1;

//         }
//     }
// }

  
 echo json_encode($response); 
?>