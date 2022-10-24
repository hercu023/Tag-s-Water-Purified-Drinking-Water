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
// $id = $_GET['id'];
$user_id = $_SESSION['user_id'];
if(isset($_POST['update'])){

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

    $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
    $update_profile->execute([$lastname, $firstname, $middlename, $email, $contact, $usertype, $image, $user_id]);
 
    $old_image = $_POST['old_image'];
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder = 'uploaded_image/'.$image;
    
    
    if(!empty($image)){

        if($image_size > 2000000){
            $response['message'] = 'image size is too large';
        }else{
        $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
        $update_image->execute([$image, $user_id]);

            if($update_image){
                move_uploaded_file($image_tmp_name, $image_folder);
                unlink('uploaded_image/'.$old_image);
                $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Image updated! ";
            }
        }

    //  }
    //     $sql = "UPDATE users SET last_name ='$lastname', first_name ='$firstname', middle_name ='$middlename', email ='$email',
    //     contact_number ='$contact', user_type ='$usertype', profile_image ='$image' WHERE id=$id";

    //     $result = mysqli_query($conn, $sql);

    //     if($result){
    //         $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Record Updated";
    //     }
        }
}
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
if(isset($_POST['login-now'])){
    header('Location: login.php');
}
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

    $image = $_FILES['profile_image']['last_name'];
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
?>