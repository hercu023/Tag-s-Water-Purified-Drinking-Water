<?php 
session_start();
require "connectionDB.php";
$email = "";
$name = "";
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

    
 
if(isset($_POST['login-now'])){
    header('Location: login.php');
}

        if(isset($_POST['submit'])){

        $lastname = $_POST['lastname'];
        $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
        $firstname = $_POST['firstname'];
        $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
        $middlename = $_POST['middlename'];
        $middlename = filter_var($middlename, FILTER_SANITIZE_STRING);
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $address = $_POST['address'];
        $address = filter_var($address, FILTER_SANITIZE_STRING);
        $contact = $_POST['contactnum'];
        $contact = filter_var($contact, FILTER_SANITIZE_STRING);
        $menu = $_POST['menu'];
        $menu = filter_var($menu, FILTER_SANITIZE_STRING);
        $pass = md5($_POST['password']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_folder = 'uploaded_img/'.$image;

        $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
        $select->execute([$email]);

        if($select->rowCount() > 0){
            header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> User already exist.");
        }else{
            if($image_size > 2000000){
                header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Image is too large.");
            }else{
                $insert = $conn->prepare("INSERT INTO `users`(last_name, first_name, middle_name, email, password, contact_number, user_type, address, profile_image) VALUES(?,?,?,?)");
                $insert->execute([$lastname, $firstname, $middlename, $email, $pass, $contact, $menu, $address, $image]);
                if($insert){
                    move_uploaded_file($image_tmp_name, $image_folder);
                    header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Registered successfully.");
                }
            }
        }
    }
?>
   