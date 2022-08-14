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