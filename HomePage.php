<?php
// session_start();
include 'connectionDB.php';
    if (isset($_POST['email']) && isset($_POST['password'])){

        $email = $_POST['email'];
        $pass = $_POST['password'];
        
        if (empty($email)){
            // header("Location: login.php?error=Email is required");
        }else if (empty($pass)){
            // header("Location: login.php?error=Password is required");
        }else{
            $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
            $stmt->execute([$email]);
            if ($stmt->rowCount() === 1){
                $user = $stmt->fetch();
                
                $user_id = $user['id'];
                $user_email = $user['email'];
                $user_password = $user['password'];
                $user_full_name = $user['full_name'];
                if ($email === $user_email){
                    if (password_verify($pass, $user_password)){
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['user_email'] = $user_email;
                        $_SESSION['user_full_name'] =  $user_full_name;
                    }else{
                        header("Location: login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> The password you've entered is incorrect");
                    }
                }else {
                    header("Location: login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> The email you entered is not connected to the system");
                }
            }else{
                header("Location: login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> The email you entered is not connected to the system");
            }
        } 
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../TAGS/dashboard.css">
        <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
        <title>Tag's Water Purified Drinking Water</title>
    </head>
    <body>
        <div class="menu">
            <div class="userType">Admin User</div>

            <p>MAIN</p>
            <a href="dashboard.php" style="text-decoration:none" class="dashboard" = onclick="dashboard()"><img src="https://cdn-icons-png.flaticon.com/512/25/25694.png">DASHBOARD</a>
            <a href="posPage.php" style="text-decoration:none" class="pos" = onclick="pos()"><img src="https://www.shareicon.net/data/512x512/2015/09/30/109572_arrows_512x512.png">POINT OF SALES</a></li>
            <a href="reportsPage.html" style="text-decoration:none" class="reports" = onclick="report()"><img src="https://cdn-icons-png.flaticon.com/512/90/90417.png">REPORTS</a></li>  
            <a href="monitoringPage.html" style="text-decoration:none" class="monitoring" = onclick="monitor()"><img src="http://cdn.onlinewebfonts.com/svg/img_189017.png">MONITORING</a></li>
            
            <p>MANAGEMENT</p>
            <a href="customersPage.html" style="text-decoration:none" class="customers" = onclick="customers()"><img src="https://static.thenounproject.com/png/3858494-200.png">CUSTOMERS</a></li>  
            <a href="inventoryPage.html" style="text-decoration:none" class="inventory" = onclick="inventory()"><img src="http://cdn.onlinewebfonts.com/svg/img_191109.png">INVENTORY</a></li>
            
            <p>SETTINGS</p>
            <a href="settingsPage.html" style="text-decoration:none" class="settings" = onclick="settings()"><img src="https://cdn-icons-png.flaticon.com/512/126/126472.png">SETTINGS</a></li>
            <a href="accountPage.html" style="text-decoration:none" class="account" = onclick="account()"><img src="https://www.veryicon.com/download/png/miscellaneous/management-system-icon-library/account-24?s=256">ACCOUNT</a></li>

        </div>

    <form>
        <div class="topBar">
            <p class="webName">TAG's Water Purified Drinking Water Station</p>
            <a href="#"><img src="https://www.freeiconspng.com/thumbs/calendar-icon-png/calendar-icon-png-4.png"></a>
            <a href="#"><img src="https://www.freeiconspng.com/thumbs/bell-icons/bell-icon-8.png"></a>
            <a href="#"><img src="http://cdn.onlinewebfonts.com/svg/img_574534.png"></a>
        </div>
    </form>

    <form>
        <div class="content">

        <?php
        echo"<p>INSERT CONTENT HERE</p>";
        ?> 

        </div>
    </form>

    <!--widgets-->
    <div class="widgets">

        <div class="item1">
            <?php echo "Total Sales"?>
        </div>
    

        <div class="item2">
            <?php echo "delivered"?>
        </div>
    

        <div class="item3">
            <?php echo "walk-ins"?>
        </div>
    
        <div class="item4">
            <?php echo "Unpaid"?>
        </div>

        <div class="item5">
             <?php echo "Pick-up"?>
        </div>
    </div>


    </body>

</html>
<style> 
    BODY{
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
    .menu{
        background-color: white;
        font-weight: bold;
        float: left;
        width: 13%;
        height: 100%;
        box-shadow: 10px 0 20px -5px darkgray;
    }
    .userType{
        font-size: 15px;
        text-align: center;
        color: gray;
        margin: 0px;
        margin-top: 10px;
    }
    .menu p{
        font-size: 20px;
        font-weight: lighter;
        margin-left: 10px;
    }
    .menu a{
        padding: 0px;
        text-align: left;
        font-weight: lighter;
        font-size: 20px;
        margin-top: 10px;
        color: gray;
        line-height: 50px;
        display: block;
    }
    a.menu:link, a:visited{
        color: white;
    }
    menu.dashboard, a.dashboard:link {
        color: black;
        background-color: darkgreen;
    }
    .menu img{
        width: 15px;
        margin-right: 10px;
        margin-left: 20px;
    }
    .menu a:hover{
        transition: 0.3s;
        background-color: lightgray;
        padding-inline: 2%;
        color: black;
        font-weight: bold;
    }
    /*top bar css-style*/
    .topBar{
        margin: 50px;
        margin-bottom: 1px;
        margin-left: 14%;
        text-align: left;
        background-color: white;
        height: 5%;
        width: 82%;
        border-radius: 0px 0px 10px 10px;
        padding-inline: 10px;
        box-shadow: 0 10px 20px -5px darkgray;
        vertical-align: middle;

    }
    .webName{
        float: left;
        vertical-align: middle;
        font-size: 15px;
    }
    .topBar img{
        border: 1px;
        padding: 5px;
        width: 10px;
        margin-top: 0.9%;
        float: right;
    }
    /*content */
    .content{
        padding-inline: 10px;
        background-color: lightgray;
        margin-left: 14%;
        height: 94%;
        width: 82%;
        border-radius: 10px;
    }

    /*widgets*/
    .item1,.item2,.item3,.item4,.item5{
        box-shadow: 0 10px 20px -5px darkgray;
        height: 50px;
        width: 100px;
        float: left;
        margin: 20px;
        position: relative;
        bottom: 570px;
        left: 300px;
        font-size: 14px;
        text-align: center;
    }

    .item1{
        background-color: #b4f59d;
    }

    .item2{
        background-color: #f55656;
    }

    .item3{
        background-color: #5690f5;
    }

    .item4{
        background-color: #c884e0;
    }

    .item5{
        background-color: #a2a9b3;
    }
</style>