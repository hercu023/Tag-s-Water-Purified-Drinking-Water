<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" type="text/css" href="../Tag's Water Purified Drinking Water/loginPage.css">
    <title>Tag's Water Purified Drinking Water</title>
</head>
<body> 

    <div class="colorbg">
        <div class="container">   
            <div class="logo">
                <img src="../Tag's Water Purified Drinking Water/tags logo.png" width="260">
                <h1 id="title">Purified Drinking Water</h1>            
            </div>
            <div class="pageform">
                <label class="title"><b>WELCOME</b></label>
                <form action="HomePage.php" method="post">               
                        <div class="txt_field">    
                        <div class="user-icon"><i class='fas fa-user-alt'></i></div>  
                            <input type="username" name="user" required>
                            <span></span>
                            <label for="username">Username</label>
                        </div>                      
                        <div class="txt_field">
                            <span class="eye" onclick="myFunction()">
                                <i id="hide" class='fas fa-eye-slash'></i>
                                <i id="unhide"  class='fas fa-eye'></i>
                            </span>
                            <div class="pass-icon"><i class='fas fa-key'></i></div>
                            <input type="password" name="pswd" required>
                            <span></span>
                            <label for="password">Password</label>       
                        </div>
                        <div class="forgotpass">
                            Forgot Password?
                        </div>
                        <div class="loginbtn">
                            <input type="submit" value="LOG IN" name="submit" id="sub">
                        </div>   
                </form>
            </div>    
        </div>
    </div>
    <div class="line2"></div>
    <div class="line1"></div>
    <script>
                            function myFunction(){
                                var x = document.getElementById("pass");
                                var y = document.getElementById("hide");
                                var z = document.getElementById("unhide");

                                if(x.type === 'password'){
                                    x.type = "text";
                                    y.style.display = "block";
                                    z.style.display = "none";
                                }else{
                                    x.type = "password";
                                    y.style.display = "none";
                                    z.style.display = "block";
                                }
                            }           
                        </script>
</body>
                        
</html>

