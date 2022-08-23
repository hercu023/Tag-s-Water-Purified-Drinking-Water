<?php
// session_start();
include 'connectionDB.php';
    if (isset($_POST['email']) && isset($_POST['password'])){

        $email = $_POST['email'];
        $pass = $_POST['password'];
        
        if (empty($email)){
            // header("Location: login.php?error=Email is required");
        }else if (empty($pass)){
            // header("Location: login.php?error=Password is required");
        }else{
            $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
            $stmt->execute([$email]);
            if ($stmt->rowCount() === 1){
                $user = $stmt->fetch();
                
                $user_id = $user['id'];
                $user_email = $user['email'];
                $user_password = $user['password'];
                $user_full_name = $user['full_name'];
                if ($email === $user_email){
                    if (password_verify($pass, $user_password)){
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['user_email'] = $user_email;
                        $_SESSION['user_full_name'] =  $user_full_name;
                    }else{
                        header("Location: login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> The password you've entered is incorrect");
                    }
                }else {
                    header("Location: login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> The email you entered is not connected to the system");
                }
            }else{
                header("Location: login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> The email you entered is not connected to the system");
            }
        } 
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>
</html>

