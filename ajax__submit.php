 <?php
 session_start();
 require "connectionDB.php";
 
     $status = 0;
    if(isset($_POST['submit'])){

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
        $message[] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Email already exist!";
        // header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Email already exist.");
    }else{
        if($pass != $encpass){
            $message[] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Password does not matched.";
            // header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Password does not matched.");
        }elseif($image_size > 2000000){
            $message[] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Image is too large.";
            // header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Image is too large.");
        }else{
            $cpass = password_hash($pass, PASSWORD_BCRYPT);
            $insert = mysqli_query($con, "INSERT INTO users VALUES('','$lastname', '$firstname', '$middlename', '$email', '$cpass', '$contact', '','$usertype','', '$image')");
            // $insert->execute([$lastname, $firstname, $middlename, $email, $pass, $contact, $address, $image]);
            if($insert){
                $status = 1;
                move_uploaded_file($image_tmp_name, $image_folder);
                // header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Registered successfully.");
            
            }
        }
    }
}
$response = array( 
    'status' => $status
); 
echo json_encode($response); 
?>
   