<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <title>Forgot Password</title>
</head>
<body>
    <div class="colorbg"> 
            <div class="lines">
                <section class="line2"></section>
                <section class="line1"></section>
            </div>
            <div id="container">
                <div class="pageform">
                    <form action="login.php" method="post" autocomplete="off"> 
                            <h2>Forgot Password</h2>
                            <p>Please enter your email address and will send you the code.</p> 
                                <div class="txt_field">    
                                    <input type="text" id="email" name="email" required>
                                    <span></span>
                                    <label for="email">Email</label>
                                </div>
                                <div class="loginbtn">
                                <button id="cancel" onclick="window.location='login.php';" value="click here">CANCEL</button> 
                                    <input type="submit" value="CONTINUE" name="submit" id="sub">
                                </div>   
                        </div>
                    </form>
                </div>
            </div>
    </div>
</body>
</html>
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
            .txt_field{
                position: relative;
                border-bottom: 2.5px solid #adadad;
                margin-top: 15px;
                margin-bottom: 5px;
                padding-right: 12vh;
            }
            .txt_field input{
                position: relative;
                margin-left: 15px;
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
                left: 20px;
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
            form .loginbtn{
                text-align: right;
            }
            form .loginbtn #cancel{
                width: 120px;
                background: #c44242;
                font-family: 'COCOGOOSE', sans-serif;
                padding: 10px;
                margin-top: 25px;
                margin-right: 10px;
                margin-bottom: 20px;
                text-align: center;
                height: 45px;
                outline: none;
                border: none;
                font-size: 11px;
                border-radius: 10px;
                color: white;
                cursor: pointer; 
            }
            form .loginbtn input{
                /* display: block; */
                font-family: 'COCOGOOSE', sans-serif;
                padding: 10px;
                margin-top: 25px;
                margin-right: 10px;
                margin-bottom: 20px;
                text-align: center;
                width: 130px;
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
            form .loginbtn input:hover{
                background: #00690e; 
            }
            #container{
                position: absolute;
                top: 50%;
                left: 50%;
                min-width: 20vh;
                max-width: 42vh;
                transform: translate(-50%, -50%);
                width: 100%;
                background: white;
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
                font-family: 'ARIAL', sans-serif;
                font-size: 12px;
                align-items: center;
                text-align: center;
                color: rgb(158, 158, 158);
                padding-bottom: 10px;
                /* margin-left: 30px; */
            }
    </style>