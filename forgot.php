
<?php require_once 'controllerUserdata.php';
 $emailCheckQuery = "SELECT * FROM users WHERE email = '$email'";
 $emailCheckResult = mysqli_query($con, $emailCheckQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../TAG-S-WATER-PURIFIED-DRINKING-WATER/CSS/forgot.css">
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
                                <!-- <button class="confirm" name="check-email" id="submitBtn" disabled="">SEND</button>     -->
                                <input type="submit" class="confirm" value="SEND" name="check-email" id="submitBtn" >
                                    <!-- <p id="continue">Please wait..</p> -->
                                    <a href="login.php" id="cancel">CANCEL</a>
                                </div>   
                        </div>
                    </form>
                </div>
            </div>
    </div>
</body>
</html>
<!-- <script type="text/javascript">
    var timer = 4;
    var myTimer = setInterval(function(){
        document.getElementById('submitBtn').innerHTML = "Please Wait for "+timer--+" sec.";
        if(timer == -1){
            clearInterval(myTimer);
            document.getElementById('submitBtn').innerHTML = "Click me!";
            document.getElementById('submitBtn').disabled = false;
        }
    }, 1000);
    </script> -->
