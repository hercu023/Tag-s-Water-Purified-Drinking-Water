<?php
session_start();
include 'loginDb.php';
    if (isset($_POST['user']) && isset($_POST['pswd'])){
        
        // function validate($data){
        //     $data = trim($data);
        //     $data = stripslashes($data);
        //     $data = htmlspecialchars($data);
        //     return $data;
        // }

        $username = validate($_POST['user']);
        $pass = validate($_POST['pswd']);
        
        // $sql = "SELECT * FROM users WHERE username='$username' AND password='$pass'";
        // $result = mysqli_query($conn, $sql); 

        // 
        //     $row = mysqli_fetch_assoc($result);
        //     if ($row['username'] === $username && $row['password'] === $pass) {
        //         $_SESSION['username'] = $row['username'];
        //         $_SESSION['full_name'] = $row['full_name'];
        //         $_SESSION['id'] = $row['id'];
        //         header("Location: home.php");
        //         exit();
        //     }else{

        //         header("Location: login.php?error=Incorrect Username or Password");
        //         exit();
        //     }

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
?> 