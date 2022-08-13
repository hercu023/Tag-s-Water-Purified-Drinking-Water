<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <!-- <link rel="stylesheet" type="text/css" href="../Tag-s-Water-Purified-Drinking-Water/loginPage.css"> -->
    <link href="http://fonts.cdnfonts.com/css/galhau-display" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/malberg-trial" rel="stylesheet">
    <title>Tag's Water Purified Drinking Water</title>
</head>
<body> 

    <div class="colorbg">
        <div class="container">   
            <div class="logo">
                <img src="../Tag-s-Water-Purified-Drinking-Water/Pictures and Icons/tags logo.png" width="260">
                <h1 id="title">PURIFIED DRINKING WATER</h1>            
            </div>
            <div class="pageform">
                <label class="title"><b>WELCOME</b></label>
                  
                <form action="HomePage.php" method="post">    
                        <?php if (isset($_GET['error'])) { ?>
                            <p class="error-error"><?php echo $_GET['error']; ?></p>
                        <?php } ?>  
                        <div class="txt_field">    
                        <div class="user-icon"><i class='fas fa-user-alt'></i></div>  
                            <input type="text" id="username"name="user" required>
                            <span></span>
                            <label for="username">Username</label>
                        </div>                      
                        <div class="txt_field">
                            <span class="eye" onclick="myFunction()">
                                <i id="hide" class='fas fa-eye-slash'></i>
                                <i id="unhide"  class='fas fa-eye'></i>
                            </span>
                            <div class="pass-icon"><i class='fas fa-key'></i></div>
                            <input type="password" id="pass" name="password" required>
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
    <style>
            body{
                background: #a3a3a3;
                margin: 0;
                overflow-x: hidden;
                font-family: Arial, Helvetica, sans-serif;
                /* background-image: url("https://wallpaperaccess.com/full/562838.jpg"); */ */
                background-repeat: cover;
                background-position: center;
                background-size: cover;
                background-attachment: fixed;
            }
            .line1{
                position: relative;
                display: flex;
                flex-direction: column;
                align-items: center;
                min-height: 5.6vh;
                background-color: #02661b;
                background-attachment: fixed;
            }
            .line2{
                position: relative;
                display: flex;
                flex-direction: column;
                align-items: center;
                min-height: 1vh;
                background-color: rgb(255, 255, 255);
                background-attachment: fixed;
            } 
            .user-icon{
                left: 2%;
            }
            #title{
                color: rgb(0, 0, 0); 
            }
            .logo{
                text-align: center;
                padding-top: 50px;
                position: relative;
            }
            .colorbg{
                min-height: 93.4vh;
                background: linear-gradient(600deg, transparent, #660202);
                display: flex;
                align-items: center;
                justify-content: center;
            } 
            .error-error{
                background-color: hsl(0, 100%, 77%);
                color: #ffffff;
                padding: 15px;
                width: 95%;
                left: 50%;
                border-radius: 3px;
                font-size: 13px;
                letter-spacing: 0.5px;
                font-family: Helvetica, sans-serif;
            }
            .container{
                position: absolute;
                top: 45%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 500px;
                background: white;
                border-radius: 10px;
                box-shadow: 10px 20px 35px rgba(0,0,0,0.55);
            }
            .container form{
                box-sizing: border-box;
                padding: 0 30px;
            }

            form .user-icon{
                position: absolute;
                left: 8px;
                bottom: 11px;
                font-size: 15px;
                color: #adadad;
                border-right: 2.5px solid #adadad;
                padding-right: 7px;
            } 
            
            form .pass-icon{
                position: absolute;
                left: 8px;
                bottom: 11px;
                font-size: 15px;
                color: #adadad;
                border-right: 2.5px solid #adadad;
                padding-right: 7px;
            }

            form .txt_field{
                position: relative;
                border-bottom: 2.5px solid #adadad;
                margin-top: 30px;
                margin-bottom: 5px;
            }
            form .txt_field .password{
                margin-bottom: 10px;
            }
            .txt_field input{
                width: 100%;
                margin-left: 38.5px;
                padding: 0 5px;
                height: 40px;
                font-size: 13px;
                border: none;
                background: none;
                outline: none;
            }
            .txt_field label{
            font-family: 'Malberg Trial', sans-serif;
            position: absolute;
            top: 50%;
            left: 43px;
            color: #adadad;
            transform: translateY(-50%);
            font-size: 15px;
            pointer-events: none;
            transition: .5s;
            }
            .txt_field span::before{
                content: '';
                position: absolute;
                top: 40px;
                left: 0;
                width: 0%;
                height: 2px;
                background: #02661b;
                transition: .5s;
            }
            .txt_field input:focus ~ label,
            .txt_field input:not(:placeholder-shown).txt_field input:not(:focus){
            top: -5px;
            font-size: 8px;
            color: #02661b;
            }

            .txt_field input:focus ~ span::before,
            .txt_field input:valid ~ span::before{
            width: 100%;
            }
            .pass{
                margin: -5px 0 20px 5px;
                color: #a6a6a6;
                cursor: pointer;
            }
            .pass:hover{
                text-decoration: underline;
            }
            form .loginbtn input{
                display: block;
                font-family: 'COCOGOOSE', sans-serif;
                padding: 10px;
                margin-top: 25px;
                margin-bottom: 20px;
                text-align: center;
                width: 100%;
                height: 50px;
                outline: none;
                border: none;
                font-size: 12px;
                border-radius: 10px;
                color: white;
                background:  #888888;
                cursor: pointer; 
                transition: 0.5s;
            }
            form .loginbtn input:hover{
                background: #00690e; 
            }
            .eye{
                position: absolute;
                font-size: 15px;
                right: 10px;
                top: 13px;
                color:rgb(201, 201, 201);
            }
            .eye:hover{
                color:rgb(63, 63, 63)
            }
            #unhide{
                display: none;
            }
            .forgotpass{
                text-align: right;
                font-size: 12px;
                font-family: arial;
                color:rgb(158, 158, 158);
                cursor: pointer;
                padding-bottom: 5px;
            }
            .forgotpass:hover{
                color: rgb(3, 80, 3);
            }
            .container .pageform {
                padding: 25px;
                font-size: 20px;
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                text-align: center;
            }
            h1{
                text-align: center;
                font-size: 35px;
                letter-spacing: 3px;
                margin-bottom: -5px;
                border-bottom: 5px solid rgb(2, 80, 2);
                font-family: 'Galhau Display', sans-serif;
                font-weight: 1000;
                
            }
            .title{
                font-family: 'PHANTOM', sans-serif;
                font-size: 45px;
                letter-spacing: 2px;
                color: rgb(158, 158, 158);
            }

    </style>
</body>
                        
</html>

