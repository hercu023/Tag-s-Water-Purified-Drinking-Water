<?php
include '../database/connection-db.php';
require_once '../service/backup-restore.php';

date_default_timezone_set("Asia/Manila");
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <!-- <link rel="stylesheet" type="text/css" href="../TAG-S-WATER-PURIFIED-DRINKING-WATER/CSS/Dashboard.css"> -->
        <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
        <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
        <link href="http://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
           <link href="http://fonts.cdnfonts.com/css/galhau-display" rel="stylesheet">
        <link href="http://fonts.cdnfonts.com/css/malberg-trial" rel="stylesheet">
        <title>Tag's Water Purified Drinking Water</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
        <script src="../index.js"></script>
    </head>
    <body>
    
        <div class="container">
        <?php
        include('../common/side-menu.php')
        ?>
            <main>
            <div class="main-dashboard">
                    <h1 class="dashTitle">SETTINGS</h1> 
                    <div class="sub-tab">
                        <div class="user-title">
                            <h2> BACK UP/RESTORE </h2>
                        </div>
                    </div>
                    <div class="backup-topmenu">
                    <p class="autobackup-title">BACK UP DATABASE</p><br>
                        <div class="backbutton1">
                            <form action="" method="post">
                                <button class="backup-button" id="backupAll-button" name="backup-db">Backup All</button>
                            </form>     
                        </div>
                    </div>

    <!-- -------------------------------------------------TABLES------------------------------------------------ -->

    <!-- ---------------------------------------- AUTOMATIC BACKUP -------------------------------------------- -->

    <div class="autobackup-container">

        <p class="autobackup-title">RESTORE FROM BACKUP</p><br>
        <form method="post" action="" enctype="multipart/form-data"
            id="frm-restore">
            <div class="form-row">
                <div class="labelBackup">Choose Backup File</div>
                <div class="backupRestore">
                    <input type="file" name="backup_file" required />
                </div>
            </div>
            <div class="backbutton2">
                <button type="submit" name="restore" value="Restore" class="backup-button">RESTORE</button>
            </div>
        </form>
    </div>

            </main>
            <?php
                include('../common/top-menu.php')
            ?>

        </div>
        <form action="" method="post" enctype="multipart/form-data" id="addcustomerFrm">
            <div class="bg-addcustomerform" id="bg-addform">
                <div class="message"></div>
                <div class="container1">
                    <h1 class="addnew-title">RESTORE DATABASE</h1>
                    <form action="#">
                        <input type="hidden" required="required" name="id" value="<?=$id;?>">
                            <div class="labelBackup">Choose Backup File</div>
                        <div class="form-row">
                            <div class="backupRestore">
                                <input type="file" name="backup_file" required />
                            </div>
                        </div>
                        <div class="bot-buttons">
                            <div class="CancelButton">
                                <a href="../settings/settings-databackup.php"  id="cancel">CANCEL</a>
                            </div>
                            <div class="AddButton">
                                <button type="submit" id="addcustomerBtn" name="restore">CONFIRM</button>
                            </div>
                        </div>
                    </form>
                </div>
        </form> 
    </body>
</html>
<script>
    // -----------------------------SIDE MENU
 $(document).ready(function(){
     //jquery for toggle sub menus
     $('.sub-btn').click(function(){
       $(this).next('.sub-menu').slideToggle();
       $(this).find('.dropdown').toggleClass('rotate');
     });

     //jquery for expand and collapse the sidebar
     $('.menu-btn').click(function(){
       $('.side-bar').addClass('active');
       $('.menu-btn').css("visibility", "hidden");
     });

     $('.close-btn').click(function(){
       $('.side-bar').removeClass('active');
       $('.menu-btn').css("visibility", "visible");
     });
     $('.menu-btn2').click(function(){
       $('.side-bar').addClass('active');
       $('.menu-btn2').css("visibility", "hidden");
     });

     $('.close-btn').click(function(){
       $('.side-bar').removeClass('active');
       $('.menu-btn2').css("visibility", "visible");
     });
   });
//    --------------------------------------------------------------------
    const sideMenu = document.querySelector('#aside');
    const closeBtn = document.querySelector('#close-btn');
    const menuBtn = document.querySelector('#menu-button');
    const checkbox = document.getElementById('checkbox');
        menuBtn.addEventListener('click', () =>{
            sideMenu.style.display = 'block';
        })

        closeBtn.addEventListener('click', () =>{
            sideMenu.style.display = 'none';
        })
         checkbox.addEventListener( 'change', () =>{
             document.body.classList.toggle('dark-theme');
        //     if(this.checked) {
        //         body.classList.add('dark')
        //     } else {
        //         body.classList.remove('dark')     
        //     }
         });
        
        // if(localStorage.getItem('dark')) {
        //     body.classList.add('dark');
        //     }
    // const sideMenu = document.querySelector("#aside");
    // const closeBtn = document.querySelector("#close-btn");
    // const menuBtn = document.querySelector("#menu-button");
    // const checkbox = document.getElementById("checkbox");
    //     menuBtn.addEventListener('click', () =>{
    //         sideMenu.style.display = 'block';
    //     })
    //     closeBtn.addEventListener('click', () =>{
    //         sideMenu.style.display = 'none';
    //     })
    //     checkbox.addEventListener('change', () =>{
    //         document.body.classList.toggle('dark-theme');
    //     })

    //     function menuToggle(){
    //         const toggleMenu = document.querySelector('.drop-menu');
    //         toggleMenu.classList.toggle('user2')
    //     }
</script>
<style>
     :root{
        --color-main: rgb(2, 80, 2);
        --color-white: white;
        --color-white-secondary: white;
        --color-tertiary: hsl(0, 0%, 57%);
        --color-black: rgb(49, 49, 49);
        --color-maroon: rgb(136, 0, 0);
        --color-secondary-main: rgb(244, 255, 246);
        --color-background: rgb(235, 235, 235);
        --color-solid-gray: rgb(126, 126, 126);
        --color-td:rgb(100, 100, 100);
        --color-button: rgb(117, 117, 117);
        --color-table-shadow: rgb(244, 255, 246);
        --color-shadow-shadow: rgb(116, 116, 116);
        --color-table-hover: rgb(244, 255, 246);
        --color-aside-mobile-focus: rgb(78, 150, 78);
        --color-aside-mobile-text: hsl(0, 0%, 57%);
        --color-select-customer:rgb(9, 138, 107);
        --color-new-customer:rgb(169, 109,5);
        --color-return-container:rgb(54, 85, 225);
        --color-table-title:rgb(0, 197, 145);
        --color-table-border:rgb(226, 226, 229);
        --color-secondary-background:rgb(244, 244, 244);
        --color-lightest-gray:rgb(250,250,250);
    }
    .dark-theme{
        --color-white: rgb(48, 48, 48);
        --color-tertiary: hsl(0, 0%, 25%);
        --color-black: white;
        --color-shadow-shadow: rgb(32, 32, 32);
        --color-aside-mobile-focus: rgb(244, 255, 246);
        --color-table-shadow: rgb(131, 131, 131);
        --color-maroon: rgb(255, 130, 130);
        --color-white-secondary: rgb(235, 235, 235);
        --color-main: rgb(244, 255, 246);
        --color-secondary-main: rgb(97, 172, 111);
        --color-background: rgb(80, 80, 80);
        --color-solid-gray: rgb(231, 231, 231);
        --color-td: rgb(231, 231, 231);
        --color-button: rgb(202, 202, 202);
        --color-table-hover: rgb(112, 112, 112);
        --color-aside-mobile-text:hsl(0, 0%, 88%);
    }
    BODY{
        background: var(--color-background);
        margin: 0;
        padding: 0;
        height: 100%;
        overflow-x: hidden;
        font-family: Arial, Helvetica, sans-serif;
        background-position: center;
        background-size: cover;
        background-attachment: fixed;
    }  
    .container1{
        width: 100%;
        max-width: 500px;
        padding: 28px;
        margin: 0 28px;
        border-radius:  0px 0px 20px 20px;
        background-color: var(--color-white);
        box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
        border-top: 10px solid var(--color-tertiary);
    }
    .bg-addcustomerform{
        height: 100%;
        width: 100%;
        background: rgba(0,0,0,0.7);
        top: 0;
        position: fixed;
        display: flex;
        align-items: center;
        justify-content: center;
        display: flex;
    }
    .a-header{
        align-items: center;
        text-align: center;
        padding: 20px;
    }
    .archive-header{
        text-align: center;
        color: var(--color-black);
        font-family: 'calibri', sans-serif;
        font-size: 20px;
    }
    .addnew-title{
        font-size: min(max(1.9rem, 1.1vw), 2rem);
        color: var(--color-tertiary);
        font-family: 'Malberg Trial', sans-serif;
        letter-spacing: .09rem;
        display: flex;
        padding-top: 1rem;
        justify-content: center;
        border-bottom: 2px solid var(--color-tertiary);
        width: 100%;
        padding-bottom: 2px;
    }
    .bot-buttons{
        width: 100%;
        align-items: center;
        text-align: center;
        display: inline-block;
        margin-top: 1.3rem;
    }
    .AddButton button{
        font-family: 'COCOGOOSE', sans-serif;
        padding: 10px;
        width: 15rem;
        max-height: 60px;
        outline: none;
        border: none;
        font-size: min(max(9px, 1.1vw), 11px);
        border-radius: 20px;
        color: white;
        background:  var(--color-tertiary);
        cursor: pointer;
        transition: 0.5s;
        margin-left: rem;
    }
    .AddButton button:hover{
        background: var(--color-main);
    }
    .CancelButton{
        display: inline-block;
    }
    .AddButton{
        display: inline-block;
    }
    /* .CloseButton{
        margin-top: 5.2vh;
        margin-left: 2.4em;
        margin-bottom: -2rem;
    } */
    #cancel{
        font-family: 'COCOGOOSE', sans-serif;
        padding: 10px;
        padding-left: 90px;
        padding-right: 90px;
        text-align: center;
        width: 15rem;
        max-height: 70px;
        outline: none;
        border: none;
        font-size: min(max(9px, 1.1vw), 11px);
        border-radius: 20px;
        color: white;
        text-decoration: none;
        background: #c44242;
        cursor: pointer;
        transition: 0.5s;
    }
    #cancel:hover{
        background-color: rgb(158, 0, 0);
        transition: 0.5s;
    }


    /* ----------------------------------------MAIN---------------------------------------- */
    .main-dashboard{
        width:100%;
    }
    .dashTitle{
        /* margin-top: 2rem; */
        font-size: min(max(1.9rem, 1.1vw), 2rem);
        color: var(--color-main); 
        font-family: 'COCOGOOSE', sans-serif;
        letter-spacing: .03rem;
        border-bottom: 2px solid var(--color-main); 
        width: 78%;
        margin-top: 3.2rem;
    }
    .user-title{
        position: relative;
        display: inline-block;
        margin-left: 3rem;
    }
    main  h2{
        color: var(--color-solid-gray);
        font-size: 1.3rem;
        letter-spacing: .1rem;
        font-family: 'Galhau Display', sans-serif;
    }
   
    /* ----------------------------------------ASIDE---------------------------------------- */
    .container{
        display: grid;
        width: 96%;
        /* margin: 0 auto; */
        background: var(--color-background);
        gap: 1.8rem;
        grid-template-columns: 16rem auto;
    }
    #menu-button{
        display: none;
    }
    @media screen and (max-width: 1600px){
        .container{
            width: 94%;
            grid-template-columns: 16rem auto;
        }
   
        #aside .sidebar2 h3{
            display: none;
        }
        #aside .titlelogo2 img{
            margin-left: 1.8rem;
            width: 40%;
        }

        #aside .sidebar2 a{
            width: 5.95rem;
        }
        #aside .sidebar2 a:focus{
            padding-left: 2rem;
            width: 4rem;
        }
        .top-menu{
            width: 370px;
        }
        .main-dashboard{
            position: relative;
            left: -5%;
        }
        main .account-container{
            margin: 2rem 0 0 8.8rem;
            width: 94%;
            position: absolute;
            left: 0;
            margin-left: 52%;
            transform: translateX(-50%);
            margin-top: 3%;
        }
        main .account-container table{
            width: 65vw;
            padding-left:30px;
            padding-right:30px;
        }
        .dashTitle{
            margin-left: 5%;
            width: 78%;
            margin-top: 3.2rem;
        }
        main  h2{
            margin-left: 10%;
        }
        main .sub-tab{
            margin-bottom: 4rem;
        }
        .newUser-button{
            left: 94%;
        }
        .search{
            left: 55%;
        }
        .search-bar{
            width: 17vw;
        }
    }
    @media screen and (max-width: 1600px){
        .container{
            width: 94%;
            grid-template-columns: 16rem auto;
        }
   
        #aside .titlelogo2 img{
            margin-left: 1.8rem;
            width: 40%;
        }

        #aside .sidebar2 a{
            width: 5.95rem;
        }
        #aside .sidebar2 a:focus{
            padding-left: 2rem;
            width: 4rem;
        }
        .top-menu{
            width: 370px;
        }
        .main-dashboard{
            position: relative;
            left: -5%;
        }
        main .account-container{
            margin: 2rem 0 0 8.8rem;
            width: 94%;
            position: absolute;
            left: 0;
            margin-left: 52%;
            transform: translateX(-50%);
            margin-top: 3%;
        }
        main .account-container table{
            width: 65vw;
            padding-left:30px;
            padding-right:30px;
        }
        .dashTitle{
            margin-left: 5%;
            width: 78%;
            margin-top: 3.2rem;
        }
        main  h2{
            margin-left: 10%;
        }
        main .sub-tab{
            margin-bottom: 4rem;
        }
        .newUser-button{
            left: 94%;
        }
        .search{
            left: 55%;
        }
        .search-bar{
            width: 17vw;
        }
    }
    @media screen and (max-width: 1400px){
        .container{
            width: 94%;
            grid-template-columns: 4rem auto;
        }
        .side-bar{
            z-index: 3;
            position: fixed;
            left: -100%;
        }
        .close-btn{
            display: flex;
        }

        .top-menu{
            width: 370px;
        }
        .main-dashboard{
            position: relative;
            left: -5%;
        }
        main .account-container{
            margin: 2rem 0 0 8.8rem;
            width: 94%;
            position: absolute;
            left: 0;
            margin-left: 52%;
            transform: translateX(-50%);
            margin-top: 3%;
        }
        main .account-container table{
            width: 65vw;
            padding-left:30px;
            padding-right:30px;
        }
        .dashTitle{
            margin-left: 5%;
            /* margin-top: 3.5rem; */
            width: 60vw;

        }
        main  h2{
            margin-left: 10%;
        }
        main .sub-tab{
            margin-bottom: 4rem;
        }
        .newUser-button{
            left: 99%;
        }
        .search{
            left: 55%;
        }
        .search-bar{
            width: 17vw;
        }
    }
    @media screen and (max-width: 1200px){
        .container{
            width: 94%;
            grid-template-columns: 4rem auto;
        }
    
        .top-menu{
            width: 370px;
        }
        .main-dashboard{
            position: relative;
            left: -5%;
        }
        main .account-container{
            margin: 2rem 0 0 8.8rem;
            width: 94%;
            position: absolute;
            left: 0;
            margin-left: 50%;
            transform: translateX(-50%);
            margin-top: 3%;
        }
        main .account-container table{
            width: 80vw;
            padding-left:30px;
            padding-right:30px;
        }
        .dashTitle{
            margin-left: 5%;
            width: 60vw;
        }
        main  h2{
            margin-left: 10%;
        }
        main .sub-tab{
            margin-bottom: 4rem;
        }
        .newUser-button{
            left: 137%;
        }
        .search{
            left: 77%;
        }
        .search-bar{
            width: 20vw;
        }
        .user2 .drop-menu{
            right: 13px;
            margin-top: 2px;
        }
        .user2 .drop-menu::before{
            right: 25px;
        }
        .drop-menu .ul{
            width: 8.5rem;
            height: 5rem;
        }
        .drop-menu .ul a{
            width: 8.5rem;
        }
    }

    @media screen and (max-width: 768px){
        .containter{
            width: 100%;
        }
    
        .menu-btn2{
            display: flex;
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
            height: 4rem;
            background: var(--color-white);
            width: 100%;
            margin: 0;
            z-index: 2;
            box-shadow: 0px 1px 14px var(--color-shadow-shadow);
        }
        .top-menu .menu-bar .dashTitle-top{
            display: block;
            left: 0;
            margin-left: 4rem;
            position: absolute;
        }
         .profile{
            margin-right: 1.4rem;
        }
        .top-menu .menu-bar .user1{
            display: none;
        }
        .drop-menu .ul .user-type3{
            display: block;
            left:22.5%;
            position: absolute; 
            margin-top: -2.3rem;
            margin-bottom: 1.9rem;
        }
        .dashTitle{
            display:none;
        }
        .user2 .drop-menu{
            right: 40px;
            height: 9.3rem;
            margin-top: 2px;
        }
        .user2 .drop-menu::before{
            right: 17px;
        }
        .drop-menu .ul{
            width: 8.5rem;
            height: 5rem;
        }
        .drop-menu .ul .theme-dark{
            margin-top: -.3rem;
        }
        
        .drop-menu .ul a{
            width: 8.5rem;
        }
        .main-dashboard{
            position: relative;
            left: -5%;
        }
        main .account-container{
            margin: 2rem 0 0 8.8rem;
            width: 94%;
            position: absolute;
            display:none;
            left: 0;
            margin-left: 50%;
            transform: translateX(-50%);
            margin-top: 3%;
        }
        main .account-container table{
            width: 80vw;
            padding-left:30px;
            padding-right:30px;
        }
        main  h2{
            margin-left: 10%;
            display:none;
        }
        main .sub-tab{
            margin-bottom: 4rem;
        }
        .newUser-button{
            left: 137%;
            display:none;
        }
        .search{
            left: 77%;
            display:none;
        }
        .search-bar{
            width: 20vw;
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
        background:  rgb(250, 255, 251);
        transition: 0.6s;
        margin-left: 0rem;
        color: rgb(187, 187, 187);
        fill: rgb(187, 187, 187);
        font-weight: bold;
        padding-left: 1rem;
        content: "";
        margin-bottom: 6px;
        font-size: 9px;
        border-radius: 0 10px 10px 0 ;
        box-shadow: 1px 1px 1px rgb(224, 224, 224);
    }

    /* CONTAINER STYLE-------------------------------------------------------------------------------- */

    /* ------------------------------------------ GENERAL --------------------------------------------- */

    button:active {
        background-color: var(--color-maroon);
    }

    button:hover{
        transition: .3s;
        background-color: var(--color-main);
        color: var(--color-white);
    }

    /* ------------------------------------------- TOPMENU --------------------------------------------- */
    .backup-topmenu{
        background-color: var(--color-white);
        width: 100%;
        align-items: center;
        position: relative;
        border-radius: 25px;
        justify-content: center;
        display: inline-block;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    .backbutton1{
        position: relative;
        width: 100%;
        text-align: center;
        margin-bottom: 5rem;
    }
    .backbutton2{
        position: relative;
        width: 100%;
        text-align: center;
        margin-top: 2rem;
        margin-bottom: 5rem;
    }
    .backup-button{
        background-color: var(--color-solid-gray);
        padding: 0.5rem;
        border-radius: 1.5rem;
        width: 80%;
        font-family: 'COCOGOOSE', sans-serif;
        height: 5rem;
        font-size: 1.5rem;
        text-transform: uppercase;
        font-weight: 900;
        text-align: center;
        color: white;
        border: none;
        letter-spacing: 5px;
        box-shadow: 2px 2px 0px 0px var(--color-shadow-shadow);
    }
    /* ----------------------------------------Search BAR---------------------------------------- */
    .search{
        gap: 2rem;
        align-items: right;
        text-align: right;
        right: 0;
        margin-top: -2rem;
        margin-left: 61rem;
    }
    .search-bar{
        width: 17vw;
        background: var(--color-white);
        display: flex;
        position: relative;
        align-items: center;
        border-radius: 60px;
        padding: 10px 20px;
        height: 2.5rem;
        backdrop-filter: blur(4px) saturate(180%);
    }
    .search-bar input{
        background: transparent;
        flex: 1;
        border: 0;
        outline: none;
        padding: 24px 20px;
        font-size: .8rem;
        color: var(--color-black); 
        margin-left: -0.95rem;
    }
    ::placeholder{
        color: var(--color-solid-gray);
        
    }
    .search-bar button svg{
        width: 20px;
        fill: var(--color-white); 
    }
    .search-bar button{
        border: 0;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        background: var(--color-main); 
        margin-right: -0.55rem;
    }

    /* ARCHIVE MENU --------------------------------------------------------------------------------------- */
    .backup-container{
        background-color: var(--color-white);
        border-radius: 1rem;
        width: 65rem;
        height: 42rem;
        position: relative;
        display: inline-block;
        border-color: var(--color-solid-gray);
    }
    /* ----------------------------------------------TABLES------------------------------------------------ */
    .backup-customers-table{
        padding: 1rem;
        width: 59rem;
        height: 33rem;
        margin-top: 2rem;
        margin-left: 2rem;
        background-color: var(--color-solid-gray);
        border-radius: 5px;
    }
    .backup-location-div{
        margin-top: 37rem;
        margin-left: 2rem;
        border-radius: 5px;
        height: 3rem;
        width: 61.3rem;
        background-color: var(--color-shadow-shadow);
    }
    .backup-currentLocation{
        margin-top: 1rem;
        margin-left: 1rem;
        font-weight: bold;
        font-size: 1rem;
        color: var(--color-white);
    }
    /* ------------------------------------------BACKUP SETTINGS/AUTO BACKUP----------------------------------------- */
    .autobackup-container{
        background-color: var(--color-white);
        border-radius: 1rem;
        width: 100%;
        position: relative;
        display: inline-block;
        border-color: var(--color-solid-gray);
    }
    .form-row{
        position: relative; 
        text-align: center;

        width: 100%;
    }
    .backupRestore{
        display: inline-block;
        width: 90%;
        height: 1.32rem;
        padding: 10px;
        margin-top: 1rem;
        background: var(--color-solid-gray);
        color: var(--color-white);
        border-radius: 10px;
        text-align: center;
        transition: 0.5s;
        font-family: 'COCOGOOSE', sans-serif;
        cursor: pointer;
    }
    .backupLocation{
        color: var(--color-white);
        width: 15rem;
        height: 1.3rem;
        background-color: var(--color-shadow-shadow);
        float: right;
        margin-right: 1rem;
    }
    .backup-now{
        height: 2rem;
        width: 13rem;
        margin-left: 14rem;
        border-radius: 5px;
        background-color: var(--color-main);
        color: var(--color-white);
    }
    .labelBackup{
        font-size: 1rem;
        font-family: 'century gothic', sans-serif;
        font-weight: 900;
        text-align: center;
        margin-right: 2rem;
        color: var(--color-solid-gray);
    }
    .autobackup-title{
        font-weight: bold;
        color: var(--color-main);
        border-bottom: 2px solid var(--color-solid-gray);
        text-align: center;
        font-size: 1.2rem;
    }
    .backupFile-text{
        margin-left: 1rem;
        font-weight: bold;
    }
    .backupFile-div{
        margin-left: 1rem;
    }
    .enableScheduler-checkbox{
        margin-left: 1rem;
    }
    .datetime-div{
        margin-left: 1rem;
    }
    .backup-date, .backup-time{
        width: 6rem;
        border-radius: 5px;
    }
    .runOptions-div{
        margin-left: 1rem;
    }
    .autobackup-prev{
        height: 2rem;
        width: 13rem;
        margin-left: 1rem;
        border-radius: 5px;
        background-color: var(--color-solid-gray);
        color: var(--color-white);
    }
    .autobackup-save{
        height: 2rem;
        width: 13rem;
        border-radius: 5px;
        background-color: var(--color-main);
        color: var(--color-white);
    }
    .autobackup-reset{
        height: 2rem;
        width: 5rem;
        margin-top: 0.3rem;
        margin-left: 1rem;
        border-radius: 5px;
        background-color: var(--color-maroon);
        color: var(--color-white);
    }
</style>