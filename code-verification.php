<?php require_once 'controllerUserdata.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" type="text/css" href="../TAG-S-WATER-PURIFIED-DRINKING-WATER/CSS/code-verify.css">
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <title>Code Confirmation</title>
    <script src="index.js"></script>
</head>
<body>
    <div class="colorbg"> 
            <div class="lines">
                <section class="line2"></section>
                <section class="line1"></section>
            </div>
            <div id="container">
                <div class="dividecolor">
                    <h2>Code Verification</h2>
                                <?php
                                    if(isset($_SESSION['message'])){
                                        ?>
                                        <div id="alert"><p class="notif-notif"> <?php echo $_SESSION['message']; ?></div></p>
                                        <?php
                                    }
                                    ?>
                                    <?php if (isset($_GET['error'])) { ?>
                                        <p class="error-error"><?php echo $_GET['error']; ?></p>
                                    <?php } ?> 
                </div>
                <div class="pageform">
                    <form action="changePassword.php" method="post" autocomplete="off"> 
                            
                                <div class="txt_field">    
                                    <input type="text" id="" name="otp" maxlength = "6" onkeypress="return isNumberKey(event)" required>
                                    <span></span>
                                    <label for="code">Code</label>
                                </div>
                                <div class="confirmbtn">
                                    <input type="submit" value="CONFIRM" name="code-verfiy" class="confirm">
                                    <a href="login.php" id="cancel">CANCEL</a>
                                </div>   
                        </div>
                    </form>
                </div>
            </div>
    </div>
</body>
</html>