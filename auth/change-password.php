<?php
require_once '../service/update-password.php';
if (!isset($_SESSION['verified'])) {
    header("Location:../auth/logout.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/change-password.css">
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
            <form action="change-password.php" method="post" autocomplete="off">
                <?php
                if (isset($_GET['error'])) {
                    echo '<p class="error-error"> '.$_GET['error'].' </p>';
                }
                ?>
                <div class="txt_field">
                    <input type="password" id="pass" name="newPassword" required>
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
                    <input type="submit" value="SAVE" name="change-password" class="confirm">
                    <a href="login.php" id="cancel">CANCEL</a>
                </div>

        </div>
        </form>
    </div>
</div>
</div>
</body>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="../index.js"></script>
</html>