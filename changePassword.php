<?php require_once "controllerUserdata.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
    <title>Change Password</title>
</head>
<body>
<div class="colorbg"> 
            <div class="lines">
                <section class="line2"></section>
                <section class="line1"></section>
            </div>
            <div id="container">
                <div class="dividecolor">
                    <h2>Change Password</h2>
                    <p>Create new password that is at least 8 characters long. <br> Mix with numbers and symbols for a strong security.</p>
                </div>
                <div class="pageform">
                    <form action="changePassword.php" method="post" autocomplete="off">
                                <?php if (isset($_GET['error'])) { ?>
                                    <p class="error-error"><?php echo $_GET['error']; ?></p>
                                <?php } ?>         
                                <div class="txt_field">
                                    <input type="password" id="pass" name="newpassword" required>
                                    <span></span>
                                    <label for="password">New Password</label>  
                                </div>
                                <div class="txt_field">  
                                    <input type="password" id="changepass" name="confirmPassword" required>
                                    <span></span>
                                    <label for="password">Confirm Password</label> 
                                </div>
                                <div class="checker">
                                    <input type="checkbox" name="" onclick="myFunction()" >
                                    <span>Show password</span>
                                </div>
                                <div class="confirmbtn">
                                    <input type="submit" value="SAVE" name="Change-Password" class="confirm">
                                    <a href="login.php" id="cancel">CANCEL</a>
                                </div>   
                                
                        </div>
                    </form>
                </div>
            </div>
    </div>
</body>
</html>
    <script>
            function myFunction(){
                var x = document.getElementById("pass");
                var y = document.getElementById("changepass");
                if(x.type === 'password'){
                    x.type = "text";
                    y.type = "text";
                }else{
                    x.type = "password";
                    y.type = "password";
                }
            }           
    </script>
    <style>
            body{
                background: #686868;
                margin: 0;
                padding: 0;
                height: 100%;
                overflow-x: hidden;
                font-family: Arial, Helvetica, sans-serif;
                /* background-image: url("https://wallpaperaccess.com/full/562838.jpg"); */ */
                background-repeat: cover;
                background-position: center;
                background-size: cover;
                background-attachment: fixed;
            }
            .colorbg{
                overflow-y: hidden;
                position: absolute;
                height: 100%;
                bottom: 0%;
                width: 100%;
                background: linear-gradient(270deg, transparent, white);
                display: flex;
            }
            .pageform{
                background-color: white;
                border-radius: 0px 0px 10px 10px;
                border-top: 2px solid hsl(0, 0%, 86%);
            } 
            .error-error{
                background-color: hsl(0, 100%, 77%);
                color: #ffffff;
                padding: 11px;
                width: 92%;
                margin-left: 3px;
                border-radius: 3px;
                font-size: min(max(9px, 1.2vw), 11px);
                letter-spacing: 0.5px;
                font-family: Helvetica, sans-serif;
            }
            .checker {
                margin-top: 10px;
                text-align: right;
                align-items: right;
                margin-right: 10px;
            }
            .checker span {
                text-decoration: none;
                color: rgb(3, 80, 3);
                top: 50%;
                font-size: min(max(10px, 1.2vw), 12px);
                font-family: 'Switzer', sans-serif;
            }
            .txt_field{
                position: relative;
                border-bottom: 2.5px solid #adadad;
                margin-top: 15px;
                padding-right: 15px;
            }
            .txt_field input{
                position: relative;
                padding: 0 6px;
                margin-top: 5px;
                margin-bottom: 5px;
                height: 30px;
                width: 100%;
                
                font-size: 12px;
                border: none;
                background: none;
                outline: none;
            }
            form .txt_field .password{
                margin-bottom: 10px;
            }
            .txt_field label{
                font-family: 'Malberg Trial', sans-serif;
                position: absolute;
                top: 50%;
                left: 20px;
                color: #adadad;
                transform: translateY(-50%);
                font-size: 11px;
                pointer-events: none;
                transition: 0.2s;
            }
            .txt_field span::before{
                content: '';
                position: absolute;
                top: 40px;
                left: 0;
                width: 0%;
                height: 2px;
                background: #02661b;
                transition: 0.2s;
            }
            .txt_field input:focus ~ label,
            .txt_field input:valid ~ label{
                top: -0.5px;
                font-size: 9px;
                color: #02661b;
            }

            .txt_field input:focus ~ span::before,
            .txt_field input:valid ~ span::before{
                width: 100%;
            }
            .lines{
                position: absolute;
                bottom: 0%; 
                width: 100%;
            }
            .line1{
                position: relative;
                display: flex;
                min-height: 75.6vh;
                clip-path: ellipse(83% 42% at 83% 100%);
                background: linear-gradient(290deg, transparent, #02661b);
                background-attachment: fixed;
            }
            .line2{
                position: relative;
                display: flex;
                min-height: 40vh;
                background: linear-gradient(80deg, transparent, #B22222);
                clip-path: ellipse(60% 66% at 14% 12%);
                background-attachment: fixed;
            }
            form .confirmbtn{
                position: relative;
                padding-left: 3vh;
                display: flex;
            }
            a{
                text-decoration:none;
                position: relative;
                width: 120px;
                background: #c44242;
                font-family: 'COCOGOOSE', sans-serif;
                margin-top: 15px;
                padding-top: 13.5px;
                margin-right: 15px;
                text-align: center;
                height: 32px;
                right: 142px;
                outline: none;
                border: none;
                font-size: 11px;
                border-radius: 10px;
                color: white;
                cursor: pointer; 
            }
            a:hover{
                 background-color: rgb(158, 0, 0);
                 transition: 0.5s; 
            }
            form .confirmbtn .confirm{
                /* display: block; */
                position: relative;
                font-family: 'COCOGOOSE', sans-serif;
                margin-top: 15px;
                margin-bottom: 20px;
                text-align: center;
                width: 130px;
                left: 125px;
                height: 45px;
                outline: none;
                border: none;
                font-size: 11px;
                border-radius: 10px;
                color: white;
                background:  #888888;
                cursor: pointer; 
                transition: 0.5s; 
            }
            #container{
                position: absolute;
                top: 50%;
                left: 50%;
                max-height: 85vh;
                min-width: 300px;
                transform: translate(-50%, -50%);
                background: hsl(112, 73%, 90%);
                border-radius: 10px;
                box-shadow: 10px 20px 35px rgba(0,0,0,0.55);
            }
            .pageform{
                box-sizing: border-box;
                padding: 0 30px;
            }
            .container .pageform {
                padding: 10px;
                font-size: 20px;
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                text-align: center;
            }
            h2{
                font-family: 'PHANTOM', sans-serif;
                font-size: 30px;
                align-items: center;
                text-align: center;
                letter-spacing: 2px;
                color: black;
                margin-bottom: 5px;
            } 
            p{
                color: hsl(0, 0%, 53%);
                font-size: min(max(10px, 1.2vw), 12px);
                letter-spacing: 0.5px;
                font-family: Helvetica, sans-serif;
                align-items: center;
                text-align: center;
                /* margin-left: 30px; */
            }
    </style>