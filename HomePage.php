<?php
include 'loginDB.php';
    if (isset($_POST['user']) && isset($_POST['pswd'])){
        
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $username = validate($_POST['user']);
        $pass = validate($_POST['pswd']);
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
        $stmt->execute([$username]);

        if ($stmt->rowCount() === 1){

        }else{
            header("Location: login.php?error=Incorrect Email or Password");
        }
    }
?>

<!-- Welcome Buddy -->