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
                <aside id="aside">
                    <div class="title">
                        <div class="titlelogo">
                            <img class="tagslogo" src="../Tag-s-Water-Purified-Drinking-Water/Pictures and Icons/tags logo.png" >
                            <!-- <h1>Tag's Water Purified Drinking Water</h1> -->
                        </div>
                        <div class="close" id="close-btn" onclick="myFunction(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M6.4 19 5 17.6l5.6-5.6L5 6.4 6.4 5l5.6 5.6L17.6 5 19 6.4 13.4 12l5.6 5.6-1.4 1.4-5.6-5.6Z"/></svg>
                        </div>
                    </div>
                <!-- <div class="userType">Admin User</div> -->
                <div class="sidebar">

                        <a href="#" class="dashboard">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M13 9V3h8v6ZM3 13V3h8v10Zm10 8V11h8v10ZM3 21v-6h8v6Z"/></svg>
                            <h3>DASHBOARD</h3>
                        </a>
                    
                        <a href="#" class="pointofsales">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M7 8q-.825 0-1.412-.588Q5 6.825 5 6V4q0-.825.588-1.413Q6.175 2 7 2h10q.825 0 1.413.587Q19 3.175 19 4v2q0 .825-.587 1.412Q17.825 8 17 8Zm0-2h10V4H7v2ZM4 22q-.825 0-1.412-.587Q2 20.825 2 20v-1h20v1q0 .825-.587 1.413Q20.825 22 20 22Zm-2-4 3.475-7.825q.25-.55.738-.863Q6.7 9 7.3 9h9.4q.6 0 1.088.312.487.313.737.863L22 18Zm6.5-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35Q9.7 15 9.5 15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35Q9.7 13 9.5 13h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35Q9.7 11 9.5 11h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm3 4h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm3 4h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Z"/></svg>
                            <h3>POINT OF SALES</h3>
                        </a>
                    
                        <a href="#" class="reports">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M2 21V3h10v4h10v14Zm2-2h6v-2H4Zm0-4h6v-2H4Zm0-4h6V9H4Zm0-4h6V5H4Zm8 12h8V9h-8Zm2-6v-2h4v2Zm0 4v-2h4v2Z"/></svg>
                            <h3>REPORTS</h3>
                        </a>
                
                        <a href="#" class="monitoring">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M3 21v-2l2-2v4Zm4 0v-6l2-2v8Zm4 0v-8l2 2.025V21Zm4 0v-5.975l2-2V21Zm4 0V11l2-2v12ZM3 15.825V13l7-7 4 4 7-7v2.825l-7 7-4-4Z"/></svg>
                            <h3>MONITORING</h3>
                        </a>
                    
                        <a href="#" class="customers">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M1 20v-2.8q0-.85.438-1.563.437-.712 1.162-1.087 1.55-.775 3.15-1.163Q7.35 13 9 13t3.25.387q1.6.388 3.15 1.163.725.375 1.162 1.087Q17 16.35 17 17.2V20Zm18 0v-3q0-1.1-.612-2.113-.613-1.012-1.738-1.737 1.275.15 2.4.512 1.125.363 2.1.888.9.5 1.375 1.112Q23 16.275 23 17v3ZM9 12q-1.65 0-2.825-1.175Q5 9.65 5 8q0-1.65 1.175-2.825Q7.35 4 9 4q1.65 0 2.825 1.175Q13 6.35 13 8q0 1.65-1.175 2.825Q10.65 12 9 12Zm10-4q0 1.65-1.175 2.825Q16.65 12 15 12q-.275 0-.7-.062-.425-.063-.7-.138.675-.8 1.037-1.775Q15 9.05 15 8q0-1.05-.363-2.025Q14.275 5 13.6 4.2q.35-.125.7-.163Q14.65 4 15 4q1.65 0 2.825 1.175Q19 6.35 19 8ZM3 18h12v-.8q0-.275-.137-.5-.138-.225-.363-.35-1.35-.675-2.725-1.013Q10.4 15 9 15t-2.775.337Q4.85 15.675 3.5 16.35q-.225.125-.362.35-.138.225-.138.5Zm6-8q.825 0 1.413-.588Q11 8.825 11 8t-.587-1.412Q9.825 6 9 6q-.825 0-1.412.588Q7 7.175 7 8t.588 1.412Q8.175 10 9 10Zm0 8ZM9 8Z"/></svg>
                            <h3>CUSTOMER</h3>
                        </a>  
                    
                        <a href="#" class="inventory">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M11 21H5q-.825 0-1.413-.587Q3 19.825 3 19V5q0-.825.587-1.413Q4.175 3 5 3h4.175q.275-.875 1.075-1.438Q11.05 1 12 1q1 0 1.788.562.787.563 1.062 1.438H19q.825 0 1.413.587Q21 4.175 21 5v5h-2V5h-2v3H7V5H5v14h6Zm4.5-1.075-4.25-4.25 1.4-1.4 2.85 2.85 5.65-5.65 1.4 1.4ZM12 5q.425 0 .713-.288Q13 4.425 13 4t-.287-.713Q12.425 3 12 3t-.712.287Q11 3.575 11 4t.288.712Q11.575 5 12 5Z"/></svg>
                            <h3>INVENTORY</h3>
                        </a>

                        <a href="#" class="employee">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M4 22q-.825 0-1.412-.587Q2 20.825 2 20V9q0-.825.588-1.413Q3.175 7 4 7h5V4q0-.825.588-1.413Q10.175 2 11 2h2q.825 0 1.413.587Q15 3.175 15 4v3h5q.825 0 1.413.587Q22 8.175 22 9v11q0 .825-.587 1.413Q20.825 22 20 22Zm2-4h6v-.45q0-.425-.238-.788-.237-.362-.662-.562-.5-.225-1.012-.337Q9.575 15.75 9 15.75q-.575 0-1.087.113-.513.112-1.013.337-.425.2-.662.562Q6 17.125 6 17.55Zm8-1.5h4V15h-4ZM9 15q.625 0 1.062-.438.438-.437.438-1.062t-.438-1.062Q9.625 12 9 12t-1.062.438Q7.5 12.875 7.5 13.5t.438 1.062Q8.375 15 9 15Zm5-1.5h4V12h-4ZM11 9h2V4h-2Z"/></svg>
                            <h3>EMPLOYEE</h3>
                        </a>

                        <a href="#" class="expense">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M3 20q-.825 0-1.412-.587Q1 18.825 1 18V7h2v11h17v2Zm4-4q-.825 0-1.412-.588Q5 14.825 5 14V6q0-.825.588-1.412Q6.175 4 7 4h14q.825 0 1.413.588Q23 5.175 23 6v8q0 .825-.587 1.412Q21.825 16 21 16Zm2-2q0-.825-.588-1.413Q7.825 12 7 12v2Zm10 0h2v-2q-.825 0-1.413.587Q19 13.175 19 14Zm-5-1q1.25 0 2.125-.875T17 10q0-1.25-.875-2.125T14 7q-1.25 0-2.125.875T11 10q0 1.25.875 2.125T14 13ZM7 8q.825 0 1.412-.588Q9 6.825 9 6H7Zm14 0V6h-2q0 .825.587 1.412Q20.175 8 21 8Z"/></svg>
                            <h3>EXPENSE</h3>
                        </a>
                
                        <a href="#" class="account">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M10 12q-1.65 0-2.825-1.175Q6 9.65 6 8q0-1.65 1.175-2.825Q8.35 4 10 4q1.65 0 2.825 1.175Q14 6.35 14 8q0 1.65-1.175 2.825Q11.65 12 10 12Zm-8 8v-2.8q0-.85.425-1.563.425-.712 1.175-1.087 1.5-.75 3.113-1.15Q8.325 13 10 13h.338q.162 0 .312.05-.725 1.725-.588 3.563Q10.2 18.45 11.25 20Zm14 1-.3-1.5q-.3-.125-.563-.262-.262-.138-.537-.338l-1.45.45-1-1.7 1.15-1q-.05-.35-.05-.65 0-.3.05-.65l-1.15-1 1-1.7 1.45.45q.275-.2.537-.338.263-.137.563-.262L16 11h2l.3 1.5q.3.125.563.275.262.15.537.375l1.45-.5 1 1.75-1.15 1q.05.3.05.625t-.05.625l1.15 1-1 1.7-1.45-.45q-.275.2-.537.338-.263.137-.563.262L18 21Zm1-3q.825 0 1.413-.587Q19 16.825 19 16q0-.825-.587-1.413Q17.825 14 17 14q-.825 0-1.412.587Q15 15.175 15 16q0 .825.588 1.413Q16.175 18 17 18Z"/></svg>
                            <h3>ACCOUNT</h3>
                        </a>

                        <a href="#" class="settings">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="m9.25 22-.4-3.2q-.325-.125-.612-.3-.288-.175-.563-.375L4.7 19.375l-2.75-4.75 2.575-1.95Q4.5 12.5 4.5 12.337v-.675q0-.162.025-.337L1.95 9.375l2.75-4.75 2.975 1.25q.275-.2.575-.375.3-.175.6-.3l.4-3.2h5.5l.4 3.2q.325.125.613.3.287.175.562.375l2.975-1.25 2.75 4.75-2.575 1.95q.025.175.025.337v.675q0 .163-.05.338l2.575 1.95-2.75 4.75-2.95-1.25q-.275.2-.575.375-.3.175-.6.3l-.4 3.2Zm2.8-6.5q1.45 0 2.475-1.025Q15.55 13.45 15.55 12q0-1.45-1.025-2.475Q13.5 8.5 12.05 8.5q-1.475 0-2.488 1.025Q8.55 10.55 8.55 12q0 1.45 1.012 2.475Q10.575 15.5 12.05 15.5Z"/></svg>
                            <h3>SETTINGS</h3>
                        </a>
                </div>       
                <div class="sidebar2"> 
                        <a href="logout.php" class="logout">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M5 21q-.825 0-1.413-.587Q3 19.825 3 19V5q0-.825.587-1.413Q4.175 3 5 3h7v2H5v14h7v2Zm11-4-1.375-1.45 2.55-2.55H9v-2h8.175l-2.55-2.55L16 7l5 5Z"/></svg>
                            <h3>LOG OUT</h3>
                        </a> 
                </div>       
                </aside>
            </div>
            <!-- <div class="bg-shadow">
                <section id="shadow"></section>
            </div>onclick="MenuFunction(this)" -->
                <div class="top-menu">  
                    <div class="menu-bar">
                        <button id="menu-button">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M3 18v-2h18v2Zm0-5v-2h18v2Zm0-5V6h18v2Z"/></svg>
                        </button>
                        <div id="user1">
                            <div class="welcome">
                                <h4 > Welcome, </h4>
                            </div>
                            <div class="user-name">
                                <h4><?php echo $_SESSION['user_first_name']; ?> </h4>
                            </div>
                            <div class="user-type">
                                <h1><?php echo $_SESSION['user_user_type']; ?> </h1>
                            </div>
                        </div>   
                        <div id="user2"> 
                            <div class="profile">
                                <img class="profile-picture" src="../Tag-s-Water-Purified-Drinking-Water/Pictures and Icons/ID.jpg" >
                            </div>
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
<script>
        const sideMenu = document.querySelector("#aside");
        const closeBtn = document.querySelector("#close-btn");
        const menuBtn = document.querySelector("#menu-button");
        menuBtn.addEventListener('click', () =>{
            sideMenu.style.display = 'block';
        })
        closeBtn.addEventListener('click', () =>{
            sideMenu.style.display = 'none';
        })

</script>
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
     /* Top bar menu  */
     .top-menu{
        margin-top: 1.7rem;
        position:  relative;
        text-align: right;
        align-items: right;
        left: 100%;
        width: 32%;
    }
    .top-menu .menu-bar{
        display: flex;
        justify-content: end;
        gap: 2rem;
    }
    .top-menu .menu-bar button{
        display: none;
    }
    .top-menu .menu-bar #user1{
        gap: 2rem;
        align-items: right;
        text-align: right;
    }
    .top-menu .menu-bar #user2{
        display: flex;
        gap: 2rem;
        align-items: right;
        text-align: right;
    }
    .user-type{
        font-family: 'PHANTOM', sans-serif;
        font-size: 7.5px;
        color: rgb(2, 80, 2);
        letter-spacing: .2rem;
        border-top: 2px solid rgb(2, 80, 2); 
        margin-top: -0.97rem;
        width: 100px;
    }
    h1{
        margin-top: 6px;     
    }
    .welcome{
        font-family: 'Switzer', sans-serif;
        font-size: 9px;
        /* margin-right: -7.3rem;*/
        margin-top: -0.6rem; 
        letter-spacing: 2px;
        color: rgb(2, 80, 2);
    }
    .user-name{
        font-family: 'Switzer', sans-serif;
        font-size: 12px;
        margin-top: -1rem; 
        text-transform: uppercase;
        margin-bottom: 0;
        color: rgb(136, 0, 0);
    }
    .profile .profile-picture{
        background: white;
        border-radius: 30%;
        width: 50px;
        padding: 4px;
    }
    #menu-button{
        border: none;
        background: none;
    }
    /* .bg-shadow{
        position: absolute;
        bottom: 0%; 
        width: 100%;
     }
    #shadow{
        background: rgb(219, 219, 219);
        opacity: .2;
        display: flex;
        display: none;
        overflow-y: hidden;
        position: relative;
        height: 100%;
        background-attachment: fixed;
        bottom: 0%;
        width: 100%;
    } */
    #user{
        text-align: right;
        align-items: right;
    }
    /* main menu - sidebar */
    a{
        text-decoration:none;
        font-family: 'COCOGOOSE', sans-serif;
    }
    h3{
        font-size: 0.87rem;
    }
/* 
    .icons{
        max-width: 2vh; 
        margin-left: 1vw;
        width: 100%;
    } */
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
        margin-top: -1.9rem;
        background: rgb(244, 255, 246);
        left: 0;
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
        fill: hsl(0, 0%, 69%);
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
        background: rgb(224, 224, 224);
        transition: 0.6s;
        color: rgb(2, 80, 2);
        fill: rgb(2, 80, 2);
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
        fill: hsl(0, 0%, 69%);
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
    #menu-button{
        display: none;
    }
    .menu-tab .sidebar2 a:hover{
        background: rgb(255, 133, 133);
        transition: 0.6s;
        margin-left: 0rem;
        color: rgb(124, 0, 0);
        fill: rgb(124, 0, 0);
        font-weight: bold;
        padding-left: 1rem;
        content: "";
        margin-bottom: 6px;
        font-size: 10px;
        border-radius: 0 20px 20px 0;
        border-left: 5px solid rgb(124, 0, 0);
        box-shadow: 2px 3px 1px rgb(124, 0, 0);
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
        .top-menu{
            width: 370px;
        }
    }

    @media screen and (max-width: 768px){
        .containter{
            width: 100%;
        }
        aside {
            position: fixed; 
            left: 0;
            margin-top: -.2rem;
            display: none;
            background: white;
            width: 17rem;
            z-index: 3;
            height: 100vh;
            padding-right: var(--card-padding);
            /* animation: sideMenu 400ms ease forwards; */
            box-shadow: 70px 0px 250px rgb(116, 116, 116);
        }
        /* @keyframes showMenu {
            to{
                left: 0;
            }
        } */
        aside .titlelogo img{
            margin-top: -.6rem;
            margin-left: 4rem;
        }

        aside .sidebar h3{
            display: inline;
        }
        aside .sidebar a{
            width: 100%;
            height: 3.4rem;
        }
        aside .sidebar a:focus{
            width: 15rem;
            background: rgb(224, 224, 224);
            box-shadow: 0px 3px 1px rgb(78, 150, 78);
        }
        aside .sidebar2 h3{
            display: inline;
        }
        aside .sidebar2 a{
            width: 100%;
            height: 3.4rem;
        }
        aside .sidebar2 a:hover{
            width: 15rem;
            background: rgb(224, 224, 224);
            box-shadow: 0px 3px 1px rgb(78, 150, 78);
        }
        aside .close{
            display: inline-block;
            margin-right: 18px;
            margin-top: -1rem;
            cursor: pointer;
            fill: rgb(2, 80, 2);
        }
        aside .close:hover{
            display: inline-block;
            margin-right: 15px;
            cursor: pointer;
        }
        .top-menu{
            width: 94%;
            margin: 0 auto 4rem;
        }
        .top-menu .menu-bar{
            position: fixed;
            top: 0;
            left: 0;
            align-items: center;
            padding: 0 0.8rem;
            height: 5rem;
            background: white;
            width: 100%;
            margin: 0;
            z-index: 2;
            box-shadow: 0px 2px 14px rgb(116, 116, 116);
        }
        .profile .profile-picture{
            margin-right: 1.5rem;
            margin-left: -1rem;
        }
        #menu-button{
            display: block;
            left: 1rem;
            position: absolute;
            cursor: pointer;
        }
        #user1{
            display: none;
        }
        #user2{
            display: none;
        }
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
        background: rgb(224, 224, 224);
        transition: 0.6s;
        margin-left: 0rem;
        color: rgb(2, 80, 2);
        fill: rgb(2, 80, 2);
        font-weight: bold;
        padding-left: 1rem;
        content: "";
        margin-bottom: 6px;
        font-size: 10px;
        border-radius: 0 10px 10px 0 ;
        /* border-left: 5px solid rgb(2, 80, 2); */
        box-shadow: 1px 3px 1px rgb(78, 150, 78);
    }
    /* ICONS*/
   
    /* .topBar{
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
    content */
    /* .content{
        padding-inline: 10px;
        background-color: lightgray;
        margin-left: 14%;
        height: 94%;
        width: 82%;
        border-radius: 10px;
    }

    /*widgets*/
    /* .item1,.item2,.item3,.item4,.item5{
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
    } */ 
</style>