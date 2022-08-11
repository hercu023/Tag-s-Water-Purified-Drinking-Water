<?php
// session_start();
include 'loginDb.php';
    if (isset($_POST['user']) && isset($_POST['password'])){

        $username = $_POST['user'];
        $pass = $_POST['password'];
        
        if (empty($username)){
            // header("Location: login.php?error=Email is required");
        }else if (empty($pass)){
            // header("Location: login.php?error=Password is required");
        }else{
            $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
            $stmt->execute([$username]);
            if ($stmt->rowCount() === 1){
                $user = $stmt->fetch();
                
                $user_id = $user['id'];
                $user_username = $user['username'];
                $user_password = $user['password'];
                $user_full_name = $user['full_name'];
                if ($username === $user_username){
                    if (password_verify($pass, $user_password)){
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['user_username'] = $user_username;
                        $_SESSION['user_full_name'] =  $user_full_name;
                    }else{
                        header("Location: login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i>           Incorrect Username or Password");
                    }
                }else {
                    header("Location: login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i>           Incorrect Username or Password");
                }
                
            }else{
            header("Location: login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i>           Incorrect Username or Password");
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

