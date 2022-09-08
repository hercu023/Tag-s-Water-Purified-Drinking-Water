
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
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
                <div class="dividecolor">
                            <h2>Forgot Password</h2>
                            <p>Please enter your email address and will send you the <br> 6 digit code.</p> 
                                <?php if (isset($_GET['error'])) { ?>
                                    <p class="error-error"><?php echo $_GET['error']; ?></p>
                                <?php } ?>  
                </div>
                <div class="pageform">
                    <form action="code-verification.php" method="post" autocomplete="off" class="disable-form"> 
                            
                                <div class="txt_field">    
                                    <input type="text" id="email" name="email" required>
                                    <span></span>
                                    <label for="email">Email</label>
                                </div>
                                <div class="confirmbtn">
                                    <input type="submit" class="confirm" value="CONTINUE" name="check-email" onclick="disable(true)">

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
//         session_start();
// include 'connectionDB.php';
//     if (isset($_POST['check-email'])) {
//         $email = $_POST['email'];
//         $disable = 'check-email';
//         $_SESSION['email'] = $email;
//         $emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
//         $emailCheckResult = mysqli_query($con, $emailCheckQuery);
        
//         // if query run
//         if ($emailCheckResult) {

//             // if email matched
//             if (mysqli_num_rows($emailCheckResult) > 0) {
//                         function disable(x){
//                     x.disabled=true;
//                     $code = rand(999999, 111111);
//                     $updateQuery = "UPDATE users SET code = $code WHERE email = '$email'";
//                     $updateResult = mysqli_query($con, $updateQuery);
//                     // $_POST['check-email'] = $this->disable='false';
//                     if ($updateResult) {
//                         $subject = 'Tags Water System Verification Code';
//                         $message = "We received a request to reset your password. Here is the verification code $code";
//                         $sender = 'From: narutosasuke454545@gmail.com';

//                         if (mail($email, $subject, $message, $sender)) {
//                             $message = "We've sent a verification code to your Email <br> <ins><strong>$email</ins></strong>";

//                             $_SESSION['message'] = $message;
//                             header('location: code-verification.php');
//                         }else{
//                              header("Location: forgot.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed while sending code");
//                         }
//                     }else {
//                         header("Location: forgot.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Something went wrong");
//                     }
//             }else{
//                 header("Location: forgot.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> This email address does not exist to the system");
//             }
//         }else {
//            header("Location: forgot.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Failed while checking email from database");
//         }
//     }
        // $("form").submit(function() {
        // $(this).find('input[type="submit"]').prop("disabled", true);
        // });
        // function disable(x){ 
        //     var y = document.getElementById("continue");
        //     var z = document.getElementById("email");

        //         y.style.display = "block";
        //         x.style.display = 'none';
        //     }else{
              
        //     }

            
        // // }
        // 
        // }
        //  $('.disable-form').on('submit', function(x){
                
        //             var self = $(this),
        //                 button = self.find('input[type="submit"], button'),
        //                 submitValue = button.data('submit-value');

        //             button.attr('disabled', 'disabled').val((submitValue) ? submitValue : 'Please Wait...');
        //             return false;
        //         });
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
            .error-error{
                background-color: hsl(0, 100%, 77%);
                color: #ffffff;
                padding: 13px;
                width: 80%;
                border-radius: 3px;
                margin: 20px;
                font-size: min(max(9px, 1.2vw), 11px);
                letter-spacing: 0.5px;
                font-family: ARIAL, sans-serif;
            }
            .pageform{
                background-color: white;
                border-radius: 0px 0px 10px 10px;
                border-top: 2px solid hsl(0, 0%, 86%);
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
                background: #888888;
                cursor: pointer; 
                transition: 0.5s; 
            }
            form .confirmbtn .confirm:hover{
                background: #00690e; 
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
                display: flex;
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