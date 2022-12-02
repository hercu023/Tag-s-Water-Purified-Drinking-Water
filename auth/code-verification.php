<?php
require_once '../service/code-verify.php';
if (!isset($_SESSION['email'])) {
    header("Location:../auth/logout.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/code-verification.css">
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <title>Code Confirmation</title>
    <script src="../index.js"></script>
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
            if(isset($_GET['message'])){
                echo '<div id="alert"><p class="notif-notif"> '.$_GET['message'].' </div></p>';
            }
            ?>

            <?php
            if (isset($_GET['error'])) {
                echo '<p class="error-error"> '.$_GET['error'].' </p>';
            }
            ?>

        </div>
        <div class="pageform">
            <form action="../service/code-verify.php" method="post" autocomplete="off">
                <div class="txt_field">
                    <input type="text" id="" name="otp" maxlength = "6" onkeypress="return isNumberKey(event)" required>
                    <span></span>
                    <label for="code">Code</label>
                </div>
                <div class="confirmbtn">
                    <input type="submit" value="CONFIRM" name="code-verify" class="confirm">
                    <a href="login.php" id="cancel">CANCEL</a>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
</body>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</html>