

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="../CSS/error-page.css"> -->
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
            <div class="content">
                <div class="verify">
                    <svg class="verified" width="100px" height="100px" viewBox="0 0 24 24" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/"><g transform="translate(0 -1028.4)">
                    <path d="m22 12c0 5.523-4.477 10-10 10-5.5228 0-10-4.477-10-10 0-5.5228 4.4772-10 10-10 5.523 0 10 4.4772 10 10z" transform="translate(0 1029.4)" fill="#c0392b"/>
                    <path d="m22 12c0 5.523-4.477 10-10 10-5.5228 0-10-4.477-10-10 0-5.5228 4.4772-10 10-10 5.523 0 10 4.4772 10 10z" transform="translate(0 1028.4)" fill="#e74c3c"/>
                    <path d="m7.0503 1037.8 3.5357 3.6-3.5357 3.5 1.4142 1.4 3.5355-3.5 3.536 3.5 1.414-1.4-3.536-3.5 3.536-3.6-1.414-1.4-3.536 3.5-3.5355-3.5-1.4142 1.4z" fill="#c0392b"/>
                    <path d="m7.0503 1036.8 3.5357 3.6-3.5357 3.5 1.4142 1.4 3.5355-3.5 3.536 3.5 1.414-1.4-3.536-3.5 3.536-3.6-1.414-1.4-3.536 3.5-3.5355-3.5-1.4142 1.4z" fill="#ecf0f1"/>
                    </g></svg>
                </div>
                <h2>USER ACCESS ERROR</h2>
                </div>
            </div>
        <div class="pageform">
            <div class="error-div">
                <?php
                    if(isset($_GET['error'])) {
                        echo '<h1 class="error-error">' .$_GET['error']. '<h1>';
                    }
                ?>
            </div>
            <div class="loginbtn">
                <a href="../auth/logout.php" class="confirm-btn"> 
                    confirm
                </a>
            </div>
        </div>
       
    </div>
</div>
</div>
</body>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</html>