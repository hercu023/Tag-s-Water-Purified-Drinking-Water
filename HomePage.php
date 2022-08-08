<?php
    if (isset($_POST['user']) && isset($_POST['pswd'])){
        
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $username = $_POST['user'];
        $pass = $_POST['pswd'];
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$username]);

        if ($stmt->rowCount() === 1){

        }else{
            header("Location: login.php?error=Incorrect Email or Password");
        }
    }
?>