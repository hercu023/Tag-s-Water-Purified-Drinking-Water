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
        <div class="lines">
            <section class="line2"></section>
            <section class="line1"></section>
        </div>
        <div class="container">  
            
                <div class="logo">
                    <img class="tagslogo" src="../Tag-s-Water-Purified-Drinking-Water/Pictures and Icons/tags logo.png" >
                    <h1 id="title">PURIFIED DRINKING WATER</h1>            
                </div>
                    <div class="pageform">
                        <form action="HomePage.php" method="post">    
                                <?php if (isset($_GET['error'])) { ?>
                                    <p class="error-error"><?php echo $_GET['error']; ?></p>
                                <?php } ?>  
                                <div class="txt_field">    
                                <div class="user-icon"><i class='fas fa-user-alt'></i></div>  
                                    <input type="text" id="email" name="email" required>
                                    <span></span>
                                    <label for="email">Email</label>
                                </div>                      
                                <div class="txt_field">
                                    <div class="pass-icon"><i class='fas fa-key'></i></div>
                                    <span class="eye" onclick="myFunction()">
                                        <i id="unhide"  class='fas fa-eye'></i>
                                        <i id="hide" class='fas fa-eye-slash'></i>
                                    </span>
                                    <input type="password" id="pass" name="password" required>
                                    
                                    <span></span>
                                    <label for="password">Password</label>       
                                </div>
                                <div class="forgotpass"> 
                                    <a href="forgot.php" id="forgot">Forgot Password?</a>
                                </div>
                                <div class="loginbtn">
                                    <input type="submit" value="LOG IN" name="submit" id="sub">
                                </div>   
                        </form>
                    </div>    
        </div>
        
    </div>
    
                        <script>
                            function myFunction(){
                                var x = document.getElementById("pass");
                                var y = document.getElementById("hide");
                                var z = document.getElementById("unhide");

                                if(x.type === 'password'){
                                    x.type = "text";
                                    z.style.display = "block";
                                    y.style.display = "none";
                                }else{
                                    x.type = "password";
                                    y.style.display = "block";
                                    z.style.display = "none";
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
            .user-icon{
                left: 2%;
            }
            #title{
                color: rgb(0, 0, 0); 
            }
            .logo{
                text-align: center;
                padding-top: 20px;
                position: relative;
            }
            .logo .tagslogo{
                max-width: 23vh;
                width: 100%;
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
            .error-error{
                background-color: hsl(0, 100%, 77%);
                color: #ffffff;
                padding: 13px;
                width: 92%;
                border-radius: 3px;
                font-size: 11px;
                letter-spacing: 0.5px;
                font-family: Helvetica, sans-serif;
            }
            .container{
                position: absolute;
                top: 50%;
                left: 50%;
                max-height: 85vh;
                min-width: 300px;
                overflow-y: scroll;              
                transform: translate(-50%, -50%);  
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
                margin-top: 15px;
                margin-bottom: 5px;
                padding-right: 12vh;
            }
            form .txt_field .password{
                margin-bottom: 10px;
            }
            .txt_field input{
                position: relative;
                margin-left: 35px;
                min-width: 3vh;
                padding: 0 6px;
                margin-top: 5px;
                margin-bottom: 5px;
                height: 30px;
                width: 100%;
                max-width: 24.7vh;
                font-size: 12px;
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
            font-size: 13px;
            pointer-events: none;
            transition: .2s;
            }
            .txt_field span::before{
                content: '';
                position: absolute;
                top: 40px;
                left: 0;
                width: 0%;
                height: 2px;
                background: #02661b;
                transition: .2s;
            }
            .txt_field input:focus ~ label,
            .txt_field input:valid ~ label{
            top: -0.5px;
            font-size: 10px;
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
                font-size: 11px;
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
                right: 9px;
                top: 13px;
                color:rgb(63, 63, 63);
                cursor: pointer;
            }
            #unhide{
                display: none;
            }
            #hide{
                color:rgb(201, 201, 201);
            }
            .forgotpass{
                text-align: right;
                padding-bottom: 5px;
            }
            .forgotpass #forgot{
                font-size: 11.5px;
                font-family: arial;
                color:rgb(158, 158, 158);
                cursor: pointer;
            }
            #forgot:active{
                color: rgb(3, 80, 3);
            }
            #forgot:hover{
                color: rgb(3, 80, 3);
            }
            .container .pageform {
                padding: 10px;
                font-size: 20px;
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                text-align: center;
            }
            h1{
                text-align: center;
                font-size: 25px;
                letter-spacing: 3px;
                margin-bottom: 6px;
                border-bottom: 3px solid rgb(2, 80, 2);
                font-family: 'Galhau Display', sans-serif;
                font-weight: 1000;

                padding-bottom: 10px;
            }


    </style>
</body>
                        
</html>

