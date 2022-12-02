<?php require_once '../service/check-email.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/forgot-password.css">
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <title>Tag's Water Purified Drinking Water</title>
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
            <?php
            if (isset($_GET['error'])) {
                echo '<p class="error-error"> '.$_GET['error'].' </p>';
            }
            ?>
        </div>
        <div class="pageform">
            <form action="../service/check-email.php" method="post" autocomplete="off" class="disable-form">

                <div class="txt_field">
                    <input type="text" id="email" name="email" required>
                    <span></span>
                    <label for="email">Email</label>
                </div>
                <div class="confirmbtn">
                    <input type="submit" class="confirm" value="SEND" name="check-email" id="submitBtn">
                    <a href="../auth/login.php" id="cancel">CANCEL</a>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
</body>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</html>