<?php
session_start();
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
                $user_first_name = $user['first_name'];
                $user_user_type = $user['user_type'];
                if ($email === $user_email){
                    if (password_verify($pass, $user_password)){
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['user_email'] = $user_email;
                        $_SESSION['user_first_name'] =  $user_first_name;
                        $_SESSION['user_user_type'] =  $user_user_type;
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
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
        <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
        <link href="http://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
        <title>Home</title>
    </head>
    <body>
        <div class="container">
            <div class="menu-tab">     
                <aside>
                    <div class="title">
                        <div class="titlelogo">
                            <img class="tagslogo" src="../Tag-s-Water-Purified-Drinking-Water/Pictures and Icons/tags logo.png" >
                            <!-- <h1>Tag's Water Purified Drinking Water</h1> -->
                        </div>
                        <div class="close" id="close-btn">
                        <span class="material-symbols-outlined">arrow_back_ios</span>
                        </div>
                    </div>
                <!-- <div class="userType">Admin User</div> -->
                <div class="sidebar">

                        <a href="#" class="dashboard">
                            <span class="material-symbols-outlined">dashboard</span>
                            <h3>DASHBOARD</h3>
                        </a>
                    
                        <a href="#" class="active">
                            <span class="material-symbols-outlined">point_of_sale</span>
                            <h3>POINT OF SALES</h3>
                        </a>
                    
                        <a href="#" class="reports">
                            <span class="material-symbols-outlined">corporate_fare</span>             
                            <h3>REPORTS</h3>
                        </a>
                
                        <a href="#" class="monitoring">
                            <span class="material-symbols-outlined">monitoring</span>
                            <h3>MONITORING</h3>
                        </a>
                    
                        <a href="#" class="customers">
                            <span class="material-symbols-outlined">person</span>
                            <h3>CUSTOMER</h3>
                        </a>  
                    
                        <a href="#" class="inventory">
                            <span class="material-symbols-outlined">inventory</span>
                            <h3>INVENTORY</h3>
                        </a>

                        <a href="#" class="inventory">
                            <span class="material-symbols-outlined">badge</span>
                            <h3>EMPLOYEE</h3>
                        </a>

                        <a href="#" class="inventory">
                            <span class="material-symbols-outlined">payments</span>
                            <h3>EXPENSE</h3>
                        </a>
                
                        <a href="#" class="account">
                            <span class="material-symbols-outlined">manage_accounts</span>
                            <h3>ACCOUNT</h3>
                        </a>

                        <a href="#" class="settings">
                            <span class="material-symbols-outlined">settings</span>
                            <h3>SETTINGS</h3>
                        </a>
                </div>       
                <div class="sidebar2"> 
                        <a href="logout.php" class="logout">
                            <span class="material-symbols-outlined">logout</span>
                            <h3>LOG OUT</h3>
                        </a> 
                </div>       
                </aside>
            </div>
            <div class="top-menu">  
                <div id="user">
                    <div class="welcome">
                        <h4 > Welcome, </h4>
                    </div>
                    <div class="user-name">
                        <h4 ><?php echo $_SESSION['user_first_name']; ?> </h4>
                    </div>
                    <div class="user-type">
                        <h1> <?php echo $_SESSION['user_user_type']; ?> </h1>
                    </div>
                </div>        
            </div> 
        </div>
    <!-- <form>
        <div class="topBar">
            <a href="#"><img src="https://www.freeiconspng.com/thumbs/calendar-icon-png/calendar-icon-png-4.png"></a>
            <a href="#"><img src="https://www.freeiconspng.com/thumbs/bell-icons/bell-icon-8.png"></a>
            <a href="#"><img src="http://cdn.onlinewebfonts.com/svg/img_574534.png"></a>
        </div>
    </form> -->

    </body>

</html>
<style> 
    BODY{
        background: rgb(224, 224, 224);
        margin: 0;
        padding: 0;
        height: 100%;
        overflow-x: hidden;
        font-family: Arial, Helvetica, sans-serif;
        background-repeat: cover;
        background-position: center;
        background-size: cover;
        background-attachment: fixed;
    }
    .user-type{
        font-family: 'PHANTOM', sans-serif;
        font-size: 10px;
        color: rgb(2, 80, 2);
        letter-spacing: .2rem;
        border-top: 2px solid rgb(2, 80, 2); 
        margin-top: -0.67rem;
    }
    h1{
        margin-top: 6px;     
    }
    .welcome{
        font-family: 'Switzer', sans-serif;
        font-size: 12px;
        margin-bottom: -1.2rem;
        letter-spacing: 2px;
        color: rgb(2, 80, 2);
  
    }
    .user-name{
        font-family: 'Switzer', sans-serif;
        font-size: 15px;
        text-transform: uppercase;
        margin-bottom: 0;
        color: rgb(136, 0, 0);
    }
    .top-menu{
        margin-top: 1.7rem;
        position:  relative;
        text-align: right;
        align-items: right;
        left: 100%;
        width: 15%;
    }
    #user{
        text-align: right;
        align-items: right;
    }
    a{
        text-decoration:none;
        font-family: 'COCOGOOSE', sans-serif;
    }
    h3{
        font-size: 0.87rem;
    }

    .icons{
        max-width: 2vh; 
        margin-left: 1vw;
        width: 100%;
    }
    .container{
        display: grid;
        width: 96%;
        margin: 0 auto;
        background: rgb(224, 224, 224);
        gap: 1.8rem;
        grid-template-columns: 14rem auto 23rem;
    }
    aside{
        height: 100vh;
        background:rgb(224, 224, 224);
    }
    aside .title{
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 1.9rem;
    }
    aside .titlelogo{
        display: flex;
        gap: 0.8rem;
    }
    aside .titlelogo img{
        width: 5rem;
        margin-top: 1rem;
        margin-left: 4.5rem;
    }
    aside .close{
        display: none;
        font-size: 1rem;
    }
    aside .sidebar{
        margin-top: 2rem;
        display: flex;
        flex-direction: column;
        height: 86vh;
        position: relative;
    }
    aside h3{
        font-weight: 400;
    }
    aside .sidebar a{
        display: flex;
        color: hsl(0, 0%, 69%);
        margin-left: 2rem;
        gap: 1rem;
        align-items: center;
        position: relative;
        height: 3.7rem;
        transition: all 300ms ease;
        
    }
    aside .sidebar a span{
        font-size: 1.6rem;
    }
   
    aside .sidebar a:focus{
        background: white;
        transition: 0.6s;
        color: rgb(2, 80, 2);
        margin-left: 0;
        padding-left: 1rem;
        content: "";
        margin-bottom: 6px;
        font-size: 10px;
        border-radius: 0 10px 10px 0 ;
        border-left: 5px solid rgb(2, 80, 2); 
        box-shadow: 1px 3px 1px rgb(78, 150, 78);
    }
    aside .sidebar2{
        margin-top: -6rem;
        display: flex;
        flex-direction: column;
        position: relative;
    }
    aside .sidebar2 a{
        display: flex;
        color: hsl(0, 0%, 69%);
        margin-left: 1.5rem;
        gap: 1rem;
        align-items: center;
        position: relative;
        height: 3rem;
        transition: all 300ms ease;
    }
    aside .sidebar2 a span{
        font-size: 1.6rem;
    }
    aside .sidebar2 a:focus{
        background: rgb(228, 95, 95);
        transition: 0.6s;
        margin-left: 0rem;
        color: white;
        font-weight: bold;
        padding-left: 1rem;
        content: "";
        margin-bottom: 6px;
        font-size: 10px;
        border-radius: 0 20px 20px 0;
        border-left: 5px solid rgb(255, 255, 255);
        box-shadow: 0px 3px 2px 1px rgb(53, 0, 0);
    }
    .menu-tab .sidebar2 a:hover{
        background: rgb(228, 95, 95);
        transition: 0.6s;
        margin-left: 0rem;
        color: white;
        font-weight: bold;
        padding-left: 1rem;
        content: "";
        margin-bottom: 6px;
        font-size: 10px;
        border-radius: 0 20px 20px 0;
        border-left: 5px solid rgb(255, 255, 255);
        box-shadow: 2px 3px 1px rgb(53, 0, 0);
    }
    @media screen and (max-width: 1200px){
        .container{
            width: 94%;
            grid-template-columns: 7rem auto 23rem;
        }
        aside .sidebar h3{
            display: none;
        }
        aside .sidebar a{
            width: 5.6rem;
        }
        aside .sidebar a:focus{
            padding-left: 2rem;
            width: 4rem;
        }
        aside .sidebar2 h3{
            display: none;
        }
        aside .sidebar2 a{
            width: 5.6rem;
        }
    }

    @media screen and (max-width: 768px){
        .containter{
            width: 100%;
        }
        aside {
            position: fixed; 
            left: 0;
            background: hsl(111, 100%, 96%);
            width: 15rem;
            z-index: 3;
            height: 100vh;
            padding-right: var(--card-padding);
        }
        aside .sidebar h3{
            display: inline;
        }
        aside .sidebar a{
            width: 100%;
            height: 3.4rem;
        }
        aside .sidebar a:focus{
            width: 13rem;
            background: white;
            box-shadow: 0px 3px 1px rgb(78, 150, 78);
        }
        aside .sidebar2 h3{
            display: inline;
        }
        aside .sidebar2 a{
            width: 100%;
            height: 3.4rem;
        }
        aside .sidebar2 a:focus{
            width: 13rem;
            background: white;
            box-shadow: 0px 3px 1px rgb(78, 150, 78);
        }
        aside .close{
            display: block;
            margin-right:5px;
        }
    }
    .menu-tab a:hover{
        width: 14rem;
    }
    

    .menu-tab p{
        font-size: 20px;
        font-weight: lighter;
        margin-left: 10px;
    }

    .menu-tab img{
        width: 15px;
        margin-right: 10px;
        margin-left: 20px;
    }
    .menu-tab a:hover{
        background: white;
        transition: 0.6s;
        margin-left: 0rem;
        color: rgb(2, 80, 2);
        font-weight: bold;
        padding-left: 1rem;
        content: "";
        margin-bottom: 6px;
        font-size: 10px;
        border-radius: 0 10px 10px 0 ;
        /* border-left: 5px solid rgb(2, 80, 2); */
        box-shadow: 1px 3px 1px rgb(78, 150, 78);
    }
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