<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="../CSS/success-page.css">
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/galhau-display" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/outfit" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/malberg-trial" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Tag's Water Purified Drinking Water</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
<div class="bg-actionDropdown" id="action-bgdrop">
    <div id="form-registered1">
        <div id="container-registered">
            <div class="content">
                <div class="verify">
                    <svg class="verified" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="916px" height="916px" viewBox="0 0 916 916" style="enable-background:new 0 0 916 916;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M97.65,862.3c4.7,31.3,27.1,53.7,54.7,53.7h616c27.6,0,50-22.4,50-50V50c0-27.6-22.4-50-50-50h-616
                                        c-27.6,0-50,22.4-54.7,46.3V862.3z M712.15,750.2l-62.8,62.8l0,0l-18.3,18.3c-9.8,9.7-25.601,9.7-35.3,0l-18.4-18.3l0,0l-18-17
                                        c-9.8-9.8-9.8-25.6,0-35.4l0.6-0.6c9.801-9.8,25.601-9.8,35.4,0l18,17l62.8-62.8c9.8-9.8,25.601-9.8,35.4,0l0.6,0.6
                                        C721.95,724.6,721.95,740.4,712.15,750.2z M727.55,602.1c0,13.801-11.2,25-25,25H631.95c-13.8,0-25-11.199-25-25V601.2
                                        c0-13.8,11.2-25,25-25h70.601c13.8,0,25,11.2,25,25V602.1z M727.55,470c0,13.8-11.2,25-25,25H631.95c-13.8,0-25-11.2-25-25v-0.9
                                        c0-13.8,11.2-25,25-25h70.601c13.8,0,25,11.2,25,25V470z M702.55,312c13.8,0,25,11.2,25,25v0.9c0,13.8-11.2,25-25,25H631.95
                                        c-13.8,0-25-11.2-25-25V337c0-13.8,11.2-25,25-25H702.55z M302.65,156c0-13.8,11.2-25,25-25h265.4c13.8,0,25,11.2,25,25v0.9
                                        c0,13.8-11.2,25-25,25h-265.4c-13.8,0-25-11.2-25-25V156z M193.15,337c0-13.8,11.2-25,25-25h265.4c13.8,0,25,11.2,25,25v0.9
                                        c0,13.8-11.2,25-25,25h-265.4c-13.8,0-25-11.2-25-25V337L193.15,337z M193.15,469.1c0-13.8,11.2-25,25-25h265.4
                                        c13.8,0,25,11.2,25,25v0.9c0,13.8-11.2,25-25,25h-265.4c-13.8,0-25-11.2-25-25V469.1L193.15,469.1z M193.15,601.2
                                        c0-13.8,11.2-25,25-25h265.4c13.8,0,25,11.2,25,25v0.899c0,13.801-11.2,25-25,25h-265.4c-13.8,0-25-11.199-25-25V601.2
                                        L193.15,601.2z"/>
                                </g>
                            </svg>
                </div>
                <div class="register">
                    <?php
                    if(isset($_GET['success']))
                    {
                        echo '<h2> '.$_GET['success'].' </h2>';
                    }
                    ?>
                    <?php
                    if(isset($_GET['archive_success']))
                    {
                        echo '<h2> '.$_GET['archive_success'].' </h2>';
                    }
                    ?>
                    <?php
                    if(isset($_GET['restore_success']))
                    {
                        echo '<h2> '.$_GET['restore_success'].' </h2>';
                    }
                    ?>
                </div>
            </div>
            <div class="pageform">
                <div class="confirmBtn">
                    <a href="../settings/settings-dataarchive-customers.php" id="registered">CONFIRM</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
