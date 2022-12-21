<?php
require_once '../database/connection-db.php';
require_once "../service/user-access.php";

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'MONITORING-SCHEDULING')) {
    header("Location: ../common/error-page.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i>You are not authorized to access this page.");
    exit();
}
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
                    <h1 class="dashTitle">MONITORING</h1> 
            </main>
            <?php
                include('../common/top-menu.php')
            ?>    
        </div> 
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
      /* -----------------------------------------------Side Menu---------------------------------------- */
      .side-bar{
        background: var(--color-table-hover);
        backdrop-filter: blur(15px);
        width: 15.5rem;
        height: 100vh;
        position: fixed;
        top: 0;
        /* left: -100%; */
        overflow-y: auto;
        transition: 0.6s ease;
        transition-property: left;
    }
    .side-bar .title{
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: -1.9rem;
        }
        .side-bar .titlelogo{
            display: flex;
            gap: 0.8rem;
        }
        .side-bar .titlelogo img{
            width: 5rem;
            margin-top: -1rem;
            margin-bottom: 1rem;
            margin-left: 5.5rem;
        }
        .side-bar .close{
            display: none;
            font-size: 1rem;
        }
    .side-bar.active{
        left: 0;
    }

    .side-bar .menu{
        width: 100%;
        margin-top: 80px;
    }

    .side-bar .menu .item{
        position: relative;
        cursor: pointer;
    }

    .side-bar .menu .item a{
        color: var(--color-tertiary);
        font-size: 13px;
        text-decoration: none;
        display: flex;
        fill: var(--color-tertiary);
        margin-left: .5rem;
        gap: 1rem;
        align-items: center;
        position: relative;
        padding: 0px 20px;
        line-height: 60px;
        height: 3.7rem;
        transition: all 300ms ease;
    }
    .side-bar .menu .item .sub-item{
        height: 2.9rem;

    }
    .side-bar .menu .item a:hover{
        background: var(--color-table-hover);
        transition: 0.6s;
        margin-left: 0rem;
        border-radius: 0 10px 10px 0 ;
        box-shadow: 2px 2px 2px rgb(224, 224, 224);
    }
    #monitoring{
        background: var(--color-white);
        box-shadow: 2px 2px 2px rgb(224, 224, 224);
        border-radius: 0 10px 10px 0;
    }
    .side-bar .menu .item a .dropdown{
        position: absolute;
        right: 0;
        margin: 20px;
        transition: 0.3s ease;
    }

    .side-bar .menu .item .sub-menu{
        background: var(--color-background);
        display: none;
        
    }

    .side-bar .menu .item .sub-menu a{
        padding-left: 90px;
        font-size: 13px;
        font-weight: 500;
        font-family: 'switzer', sans-serif;
        box-shadow: 0px 1px 1px rgb(224, 224, 224);

    }

    .rotate{
        transform: rotate(90deg);
    }

    .close-btn{
        position: absolute;
        color: var(--color-tertiary);
        font-size: 14px;
        right: 0;
        margin: 25px;
        margin-top: 50px;
        display: none;
        cursor: pointer;
    }

    .menu-btn{
        position: absolute;
        color: var(--color-tertiary);
        font-size: 20px;
        margin: 25px;
        cursor: pointer;
    }
    .menu-btn:hover{
        color: var(--color-main);
    }
    .menu-btn2{
        position: absolute;
        color: var(--color-tertiary);
        font-size: 20px;
        margin: 25px;
        display: none;
        left: 0;
        cursor: pointer;
    }
    .menu-btn2:hover{
        /* position: absolute; */
        color: var(--color-main);
        /* font-size: 25px;
        margin: 30px;
        cursor: pointer; */
    }
     /* ----------------------------------------Top bar menu----------------------------------------  */
     .top-menu{
        margin-top: 2rem;
        position: absolute;
        right: 3%;
    }
    .top-menu .menu-bar{
        display: flex;
        justify-content: end;
        gap: 2rem;
    }
    .top-menu .menu-bar button{
        display: none;
    }
    .top-menu .menu-bar .user1{
        gap: 2rem;
        align-items: right;
        text-align: right;
    }
    .top-menu .menu-bar .user2{
        display: flex;
        gap: 2rem;
        align-items: right;
        text-align: right;
    }
    .top-menu .menu-bar .dashTitle-top{
        font-size: min(max(1.2rem, 0.4vw), 1.3rem);
        color: var(--color-main); 
        font-family: 'COCOGOOSE', sans-serif;
        letter-spacing: .03rem;
        display: none;
        text-align: center;
        align-items: center;
    }
    
    .user-type{
        font-family: 'switzer', sans-serif;
        font-size: 7.5px;
        color: var(--color-black); 
        letter-spacing: 1px;
        border-top: 2px solid var(--color-main); 
        margin-top: -0.97rem;
        width: 7vw;
        text-transform: uppercase;
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
        color: var(--color-main); 
    }
    .user-name{
        font-family: 'Switzer', sans-serif;
        font-size: 12px;
        margin-top: -1rem; 
        text-transform: uppercase;
        margin-bottom: 0;
        color: var(--color-maroon);
    }
    .profile img{
        background: var(--color-white); 
        border-radius: 30%;
        width: 50px;
        padding: 4px;
    }
    #menu-button{
        border: none;
        background: none;
    }
    a{
        text-decoration:none;
        font-family: 'COCOGOOSE', sans-serif;
    }
    .user2 a{
        font-family: 'Malberg Trial', sans-serif;
        color: rgb(68, 68, 68);
    }
    .notifs-section{

    }
    .todeliver{
        margin-bottom: -2.2rem;
        margin-top: 2rem;
        color: rgb(117, 117, 117);
        font-size: 1.3rem;
        letter-spacing: .1rem;
        font-family: 'Galhau Display', sans-serif;
    }
    h3{
        font-size: 0.87rem;
    }
    .user2 .profile{
        position: relative;
        cursor: pointer;
    }
    .user2 .drop-menu{
        position: absolute; 
        top: 120px;
        right: 15px;
        padding: 10px 20px;
        background: var(--color-white);
        width: 110px;
        box-sizing: 0 5px 25px rgba(0,0,0,0.1);
        border-radius: 7px;
        transition: 0.5s;
        visibility: hidden;
        opacity: 0;
    }
    .user2 .drop-menu.user2{
        top: 80px;
        visibility: visible;
        opacity: 1;
    }
    .user2 .drop-menu::before{
        content:'';
        position: absolute;
        top: -5px;
        right: 33px;
        width: 15px;
        height: 20px;
        background: var(--color-white);
        transform: rotate(45deg);
        transition: 0.5s;
    }
    .drop-menu .ul .user-type3{
        font-family: 'PHANTOM', sans-serif;
        font-size: 7.5px;
        color: var(--color-main); 
        letter-spacing: .2rem;
        display: none;
    }

    .drop-menu .ul{
        margin-top: 2rem;
        display: flex;
        flex-direction: column;
        height: 9vh;
        position: relative;
        margin-bottom: 0.5rem;
    }
    .drop-menu h4{
        font-weight: 400;
        font-size: 12px;
    }
    .drop-menu .ul a{
        display: flex;
        color: hsl(0, 0%, 69%);
        fill: hsl(0, 0%, 69%); 
        margin-left: -1.26rem;
        padding-left: 1rem;
        gap: 1rem;
        height: 1rem;
        width: 8.5rem;
        align-items: center;
        position: relative;
        height: 1.7rem;
        transition: all 300ms ease;
    }
    .drop-menu .ul a:hover {
        background:  rgb(190, 190, 190);
        transition: 0.6s;
        color: var(--color-white);
        fill: var(--color-white);
        padding-left: .9rem;
        content: "";
        margin-bottom: 6px;
        font-size: 15px;
        border-radius: 0px 0px 10px 10px;
        cursor: pointer;
    }
    .checkbox{
        opacity: 0;
        position: absolute;
    }
    .checkbox:checked + .theme-dark .ball{
        transform: translateX(28px);
    }
    .drop-menu .theme-dark{
        background: hsl(0, 0%, 69%);
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 14.5px;
        width: 42.5px;
        cursor: pointer;
        border-radius: 50px;
        position: relative;
        padding: 5px;
        margin-top: -30px;
        margin-bottom: 8px;
        margin-left: 2rem;
    }
    .sun{
        fill: yellow;
    }
    .moon{
        fill: white;
    }
    .ball{
        background: white;
        position: absolute;
        border-radius: 50%;
        top: 2px;
        left: 2px;
        height: 21px;
        width: 21px;
        transition: transform 0.2s linear;
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
   
        /* ----------------------------------------Sub TAB---------------------------------------- */
        /* .user-title{
            position: relative;
        }
        main  h2{
            margin-bottom: -2.2rem;
            margin-top:2rem;
            color: var(--color-solid-gray);
            font-size: 1.3rem;
            margin-left: 3%;
            letter-spacing: .1rem;
            font-family: 'Galhau Display', sans-serif;
        }
        main .sub-tab{
            margin-bottom: 4rem;
        } */
        /* ----------------------------------------Search BAR---------------------------------------- */
        /* .search{
            position: absolute;
            gap: 2rem;
            align-items: right;
            text-align: right;
            left: 50%;
        }
        .search-bar{
            width: 18rem;
            background: var(--color-white);
            display: flex;
            position: relative;
            align-items: center;
            border-radius: 60px;
            padding: 10px 20px;
            height: 1.8rem;
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
        } */
        /* ----------------------------------------Add Button---------------------------------------- */
        /* .newUser-button{
            position: absolute;
            left: 68%;
        }
        .add-account{
            display: flex;
            border: none;
            background-color: var(--color-white); 
            align-items: center;
            color: var(--color-button); 
            fill: var(--color-button); 
            width: 11rem;
            max-height: 46px;
            border-radius: 20px;
            padding: .68rem 1rem;
            font-family: 'Outfit', sans-serif;
            cursor: pointer; 
            gap: 1rem;
            align-items: center;
            height: 3.7rem;
            transition: all 300ms ease;
            position: relative; 
            margin-top: .2rem;
            text-transform: uppercase;
        }
        .add-account h3{
            font-size: .8rem;
        }
        .add-account:hover{
            background-color: var(--color-main); 
            color: var(--color-white);
            fill: var(--color-white);
            padding-top: -.2px;
            transition: 0.7s;
            border-bottom: 4px solid var(--color-maroon);
        } */
         /* ----------------------------------------Dashboard Table---------------------------------------- */
     /* main .account-container{
        margin-top: 2rem;
        height: 500px;
        
    }
     main .account-container table{
        background: var(--color-white);
        font-family: 'Switzer', sans-serif;
        width: 100%;
        font-size: 0.8rem;
        border-radius: 0px 0px 10px 10px;
        padding-left: 2.5rem;
        padding-right: 2.5rem;
        padding-bottom: 2.5rem;
        text-align: center; 
        box-shadow: 0px 5px 30px 2px var(--color-table-shadow);
        border-top: 8px solid var(--color-table-hover);
        transition: all 700ms ease;
        overflow: auto;
        margin-top: -1rem;
    }

    main .account-container table:hover{
        box-shadow: none;
        border-top: 8px solid var(--color-main);
    }

    main table tbody td{
        height: 2.8rem;
        border-bottom: 1px solid var(--color-solid-gray);
        color: var(--color-td); 
        font-size: .67rem;
    }
     th{
        height: 2.8rem;
        color: var(--color-black); 
        margin:1rem;
        font-size: .8rem;
        letter-spacing: 0.02rem;
    }  
    tr:hover td{
        color: var(--color-main); 
        cursor: pointer;
        background-color: var(--color-table-hover);
     } */
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
</style>