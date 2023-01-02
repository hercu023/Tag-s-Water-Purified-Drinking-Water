<?php
@session_start();
require_once '../database/connection-db.php';
require_once "../service/user-access.php";
require_once "../service/pie-graph-data.php";
require_once "../service/bar-graph-data.php";

date_default_timezone_set("Asia/Manila");

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'DASHBOARD')) {
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
        <title>Tag's Water Purified Drinking Water</title>
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"> -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>   
    </head>
    <style>
:root{
    --color-main: rgb(2, 80, 2);
    --color-white: white;
    --color-white-secondary: white;
    --color-tertiary: hsl(0, 0%, 57%);
    --color-black: rgb(49, 49, 49);
    --color-maroon: rgb(136, 0, 0);
    --color-secondary-main: rgb(244, 255, 246);
    --color-blue-button: rgb(62, 178, 255);
    --color-light-blue: #E0FFFF;
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
    --color-blue-button: rgb(164, 219, 255);
    --color-maroon: rgb(255, 130, 130);
    --color-light-blue: #4682B4;
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
    font-family: 'galhau-display', sans-serif;
    background-position: center;
    background-size: cover;
    background-attachment: fixed;
}  
@media print{
    /* body * {
        display: none;
    } */
    #myTable *{
        display: block;
    }
}
.Title-top{
    display: none;
    font-size: min(max(1.2rem, 0.4vw), 1.3rem);
    color: var(--color-main);
    font-family: 'COCOGOOSE', sans-serif;
    letter-spacing: .03rem;
}
.subTitle-top{
    display: none;
    position: relative;
    margin-left: 3rem;
    border-left: 1px var(--color-solid-gray) solid;
    padding-left: 1rem;
    padding-bottom: .2rem;
    font-family: 'calibri', sans-serif;
    color: var(--color-solid-gray);
    font-size: 1rem;
    text-transform: uppercase;

}
.newUser-button{
    position: absolute;
    display: inline-block;
    margin-left: 2rem;
    margin-top: -.05rem;
}
.button1{
    display: inline-block;
}
.add-account{
    display: flex;
    border: none;
    background-color: var(--color-main);
    align-items: center;
    color: var(--color-white);
    fill: var(--color-white);
    width: 7.5rem;
    max-height: 46px;
    border-radius: 20px;
    padding: .68rem 1rem;
    font-family: 'Switzer', sans-serif;
    cursor: pointer;
    gap: 1rem;
    transition: all 300ms ease;
    position: relative;
    text-transform: uppercase;
}
.add-account h3{
    font-size: .8rem;
}
.add-account:hover{
    background-color: var(--color-white);
    color: var(--color-main);
    fill: var(--color-main);
    padding-top: -.2px;
    transition: 0.7s;
    border-bottom: 4px solid var(--color-maroon);
}
.button2{
    display: inline-block;
}
.print-report{
    display: flex;
    border: none;
    background-color: var(--color-button);
    align-items: center;
    color: var(--color-white);
    fill: var(--color-white);
    width: 7rem;
    max-height: 46px;
    border-radius: 20px;
    padding: .68rem 1rem;
    font-family: 'Switzer', sans-serif;
    cursor: pointer;
    gap: 1rem;
    transition: all 300ms ease;
    position: relative;
    text-transform: uppercase;
}
.print-report h3{
    font-size: .8rem;
}
.print-report:hover{
    background-color: var(--color-white);
    color: var(--color-solid-gray);
    fill: var(--color-solid-gray);
    padding-top: -.2px;
    transition: 0.7s;
    border-bottom: 4px solid var(--color-maroon);
}
/* .datetime {
    position: absolute;
    font-size: 10px;
    padding: 15px;
    color: var(--color-white);
    background: var(--color-tertiary);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
    border-radius: 4px;
    border-right: 10px var(--color-main) solid;
    width:10rem;
    margin-top: -2.5rem;
    font-weight: 500;
    display: inline-block;
    font-family: "Inter", sans-serif;
}

.time {
    font-size: 2em;
    color: var(--color-white);
}

.date {
    margin-top: 5px;
    color: var(--color-secondary-main);
    font-size: 1.1em;
} */

/* -------------------------------------------------Sub Tab------------------------------------------ */
.sub-tab2{
    display: inline-block;
    margin-left: 1rem;
}
span{
    font-family: 'calibri', sans-serif;
    color: var(--color-main);
    font-size: 15px;
    font-weight: 900;
    margin-right: .5rem;
    margin-left: 2rem;
}

/* ----------------------------------------Sub TAB---------------------------------------- */

.user-title{
    position: relative;
    display: inline-block;
    margin-left: 5rem;
    border-bottom: 2px var(--color-black) solid;
    margin-bottom: 1.5rem;
}
main  h2{
    color: var(--color-black);
    font-size: 1.5rem;
    letter-spacing: .05rem;
    font-family: 'century gothic', sans-serif;
}
main .sub-tab{
    margin-bottom: 3rem;
}
.select-dropdown{
    display: inline-block;
    max-height: 50px;
}
.select{
    background-color: var(--color-background);
    color: var(--color-solid-gray);
    /* align-items: center; */
    border-radius: 20px;
    padding: .80rem 1rem;
    width: 10.8vw;
    font-size: 14px;
    cursor: pointer;
    transition: 0.3s;
    border: none;
}
.select:hover{
    background:  var(--color-solid-gray);
    color: var(--color-white);
}
/* ----------------------------------------Search BAR---------------------------------------- */
.search{
    position: absolute;
    gap: 2rem;
    margin-top: .5rem;
    align-items: right;
    text-align: right;
    right: 4%;
    display: inline-block;
}
.search-bar{
    width: 15vw;
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
}
/* ----------------------------------------MAIN---------------------------------------- */
.main-dashboard{
    width:100%;
}
.dashTitle{
    /* margin-top: 2rem; */
    font-size: min(max(1.9rem, 1.1vw), 2rem);
    color: var(--color-main); 
    border-bottom: 2px solid var(--color-main); 
    width: 78%;
    font-weight: 1000;
    margin-top: 3.2rem;
}
/* ----------------------------------------Customers Table---------------------------------------- */
.container-table2{
    position: relative;
    margin-right:2rem;
    width: 65%;
    display: inline-block;
}
.main-container{
    /* height: 600px; */
    background: var(--color-white);
    border-radius: 20px 20px 0 0;
    position: relative;
}
.sub-tab-container{
    padding: 1.6rem;
}
.customer-container{
    /* margin-top: 2rem; */
    max-height: 650px;
    overflow:auto;
    /* position: absolute; */
    /* box-shadow: 0px 5px 30px 2px var(--color-table-shadow); */
    border-top: 2px solid var(--color-solid-gray);
    border-radius: 0px 0px 20px 20px;
    margin-bottom: 1.5rem;
}
.customer-container table{
    background: var(--color-white);
    font-family: 'Switzer', sans-serif;
    width: 100%;
    font-size: 1rem;
    height: 400px;
    padding-left: 2.5rem;
    padding-right: 2.5rem;
    border-radius:0px 0px 20px 20px;
    padding-bottom: 2.5rem;
    text-align: center;
    transition: all 700ms ease;
    /* margin-top: -1rem; */
}
.customer-container table:hover{
    box-shadow: none;
    /* border-top: 8px solid var(--color-main); */
}

.customer-container table tbody td{
    height: 2.8rem;
    border-bottom: 1px solid var(--color-solid-gray);
    color: var(--color-td);
    font-size: .8rem;
}
th{
    height: 2.8rem;
    color: var(--color-black);
    margin:1rem;
    font-size: 1rem;
    letter-spacing: 0.02rem;
}
/*-----------------------------------------------------------------------  */
.container-table1{
    position: relative;
    width: 32%;
    display: inline-block;
}
.main-container1{
    /* height: 600px; */
    background: var(--color-white);
    border-radius: 20px 20px 0 0;
    position: relative;
}
.sub-tab-container1{
    padding: 1.6rem;
}
.customer-container1{
    /* margin-top: 2rem; */
    max-height: 650px;
    position: relative;
    overflow:auto;
        /* position: absolute; */
    /* box-shadow: 0px 5px 30px 2px var(--color-table-shadow); */
    border-top: 2px solid var(--color-solid-gray);
    border-radius: 0px 0px 20px 20px;
    margin-bottom: 1.5rem;
}
.customer-container1 table{
    background: var(--color-white);
    font-family: 'Switzer', sans-serif;
    width: 100%;
    font-size: 1rem;
    border-radius:0px 0px 20px 20px;
    height: 400px;
    padding-left: 2.5rem;
    padding-right: 2.5rem;
    padding-bottom: 2.5rem;
    text-align: center;
    transition: all 700ms ease;
    /* margin-top: -1rem; */
}
.customer-container1 table:hover{
    box-shadow: none;
    /* border-top: 8px solid var(--color-main); */
}

.customer-container1 table tbody td{
    height: 2.8rem;
    border-bottom: 1px solid var(--color-solid-gray);
    color: var(--color-td);
    font-size: .8rem;
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

@media screen and (max-width: 1400px){
    .container{
        width: 100%;
        /* margin-left: 3rem; */
        grid-template-columns: 2rem auto 2rem;
    }
    
    .select{
        width: 10rem;
    }
    .customer-container{
        width: 100%;
    }
    .dashTitle{
        /* margin-left: 5%; */
        /* margin-top: 3.5rem; */
        width: 65vw;

    }
    main .sub-tab{
        margin-bottom: 4rem;
    }
    .search{
        right: 5%;
    }
    .search-bar{
        width: 17rem;
    } 
    /* .search{
        right: 5%;
    }
    .search-bar{
        width: 19rem;
    } */
}
@media screen and (max-width: 1200px){
    .search{
        right: 0;
    }
    .search-bar{
        width: 15rem;
    } 
    .dashTitle{
        width: 57vw;

    }
}
@media screen and (max-width: 1000px){
    .button1 button{
        width: 3.3rem;
    }
    .button2 button{
        width: 3.3rem;
    }
    h3{
        display: none;
    }
    .customer-container{
        max-width: 1500px;
    }
    .customer-container table{
        overflow-y: scroll;
    }
    .date{
        width: 9vw;
        margin-left:1px;
    }
    span{
        margin-left: 2px;
    }
}

@media screen and (max-width: 500px){
    .containter{
        width: 100%;
        /* overflow-y: scroll; */
    }
    .Title-top{
        display: block;
        left: 0;
        margin-left: 4rem;
        position: absolute;
    }
    .subTitle-top{
        display: block;
        left: 0;
        margin-left: 11rem;
        position: absolute;
    }
    .menu-btn2{
        display: flex;
    }
    /* ----------------------------------top-menu----------------------------- */
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
    .profile{
        margin-right: 1.4rem;
    }
    .top-menu .menu-bar .user1{
        display: none;
    }
    .drop-menu .ul .user-type3{
        display: flex;
        left:20.5%; 
         position: absolute;
        margin-top: -2.3rem;
        margin-bottom: 1.9rem;
    }
    .dashTitle{
        display:none;
    }
    .user-title{
        display: none;
    }
    .user2 .drop-menu{
        right: 40px;
        height: 9.3rem;
        margin-top: 2px;
    }
    .user2 .drop-menu::before{
        right: 30px;
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
    /* ------------------------------------------------------------------------------ */
    .main-dashboard{
        position: relative;
        text-align: center;
        align-items: center;
    }
    .main-container{
        margin-left: -2rem;
        margin-top: 3rem;
        position: relative;
        width: 100%;
        align-items: center;
        background: none;
    }
    .sub-tab{
        width: 100%;

    }
    .sub-tab-container{
        width: 100%;
        text-align: left;
        margin-top: -4rem;
        align-items: center;
    }
    .select-dropdown{
        display: flex;
        position: relative;
        align-items: center;
        text-align: center;
        margin-bottom: -2rem;

    }
    .select{
        background-color: var(--color-white);
        width: 80%;

        
    }
    .customer-container{
        /* display: none; */
        position: relative;
        margin-left: -.5rem;
        /* margin-top: 3rem; */
        width: 100%;
        max-height: 600px;
        /* border-radius: 20px; */
        border-top: 5px solid var(--color-solid-gray);
        font-size: 15px;
        margin-bottom:2rem;
    }
    .customer-container tbody tr td{
        font-size: 10px;
        
    }
    table thead {
        border: none;
        clip: rect(0 0 0 0);
        height: 1px;
        margin: -1px;
        overflow: hidden;
        padding: 0;
        position: absolute;
        width: 1px;
    }
    table th {
        border-bottom: 10px solid var(--color-main);
        display: block;
        margin-bottom: .625em;
    }
    
    
    table tr {
        border-bottom: 3px solid var(--color-main);
        display: block;
        margin-bottom: .625em;
    }
    
    table td {
        border-bottom: 1px solid #ddd;
        display: block;
        font-size: .8em;
        text-align: right;
        
    }
    
    table td::before {
        content: attr(data-label);
        float: left;
        font-weight: bold;
        font-size: 10px;
        text-transform: uppercase;
    }
    
    table td:last-child {
        border-bottom: 0;
    }
    
    .span-from{
        margin-top: 4rem;
        /* margin-left: -5vw; */
        position: relative;
        font-size: 12px;
    }
    
    .span-to{
        margin-top: 1.2rem;
        /* margin-left: -10.7vw; */
        position: relative;
        font-size: 12px;
    }
    #date-from{
        background-color: var(--color-white);;
        /* margin-left:8.6vw; */
        margin-top: 3.4rem;
        border-radius: 20px;
        width: 25.5vw;
        font-size: 15px;

    }   
    #date-to{
        background-color: var(--color-white);;
        margin-left: -1.3vw;
        margin-top: .5rem;
        width: 25.5vw;
        font-size: 15px;
        border-radius: 20px;
    }   


 
    .sub-tab{
        margin-top: 5rem;
        width: 100%;
        align-items: center;
        text-align: center;
    }
    .newUser-button{
        margin-top: 1rem;
        /* display: flex; */
        position: relative;
        width: 100%;
    }
    .button1 button{
        width: 7.3rem;
    }
    .button2 button{
        margin-left: 2.5rem;
        width: 7.3rem;
    }
    h3{
        display: block;
    }
    .print-report{
        text-align: center;
        margin-left: .3rem;

    }
    .search{
        /* left: 77%; */
        /* display:none; */
        align-items: center;
        text-align: center;
        position: relative;
        width: 80%;
        /* margin-bottom: 2rem; */
    }
    .search-bar{
        position: relative;
        /* margin-right:10rem; */
        width: 80%;

    } 
}

/* -----------------------------------------------Side Menu---------------------------------------- */
.side-bar{
    background: var(--color-table-hover);
    backdrop-filter: blur(15px);
    width: 15.5rem;
    height: 100vh;
    font-family: 'cocogoose', sans-serif;
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
    color: var(--color-solid-gray);
    fill: var(--color-solid-gray);
    font-size: 13px;
    text-decoration: none;
    display: flex;
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



/* ----------------------------------------Top bar menu----------------------------------------  */

.top-menu{
    margin-top: 2rem;
    text-decoration: none;
    position: absolute;
    right: 4%;
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

.user2 a{
    font-family: 'Malberg Trial', sans-serif;
    text-decoration: none;
    color: rgb(68, 68, 68);
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
    right: 5px;
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
    right: 25px;
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
.previous-transaction-header1{
    color: var(--color-black);
    padding-top: .5rem;
    font-weight: bold;
    font-size: 1.5rem;
    text-align: center;
    text-transform: uppercase;
    font-family: 'COCOGOOSE', sans-serif;

    letter-spacing: 1px;
}
.previous-transaction-header{
    color: var(--color-black);
    padding-right: 2rem;
    border-right: 2px solid var(--color-black);
    font-weight: bold;
    font-size: 1.5rem;
    text-align: center;
    text-transform: uppercase;
    font-family: 'COCOGOOSE', sans-serif;
    display: inline-block;
    margin-right: 2rem;
    margin-left: 2rem;
    letter-spacing: 1px;
}
.card {
    display: inline-block;
    border-radius: 0.1rem;
    height: 1rem;
    margin-right: 2rem;
    border: transparent;
    font-family: 'Rajdhani', sans-serif;
    /* left: 25vw;      */
    margin-top: .5rem;
    /* position: absolute; */
}

.date {
    color: var(--color-solid-gray);
    font-size: 1.2rem;
    font-weight: 500;
    margin-left: 1rem;
    display: inline-block;
}
.dash{
    display: inline-block;
    color: var(--color-tertiary);
    font-size: 1.2rem;
    font-weight: 500;
}
.day {
    color: var(--color-solid-gray);
    font-size: 1.2rem;
    margin-right: 1rem;
    font-weight: 900;
    display: inline-block;
    text-transform: uppercase;
}
.newUser-button{
        margin-left: .9rem;
        position: relative;
        display: inline-block;
    }
    .widget1{
        border: none;
        background-color: var(--color-white); 
        align-items: center;
        width: 20.5rem;
        justify-content: center;
        height: 5.7rem;
        border-radius: 20px ;
        padding: .68rem 1rem;
        font-family: 'Outfit', sans-serif;
        transition: all 300ms ease;
        position: relative; 
        margin-top: .2rem;
        text-transform: uppercase;
        border-left: 7px solid #41c59b;
    }
    .widget1 h3{
        font-size: .8rem;
        font-weight: 900;
        color: #41c59b; 
        text-align: left;
        margin-left: 1.5rem;
    }
    .widget2{
        border: none;
        background-color: var(--color-white); 
        align-items: center;
        color: var(--color-button); 
        fill: var(--color-button); 
        width: 20.5rem;
        justify-content: center;
        height: 5.7rem;
        border-radius: 20px ;
        padding: .68rem 1rem;
        font-family: 'Outfit', sans-serif;
        transition: all 300ms ease;
        position: relative; 
        margin-top: .2rem;
        text-transform: uppercase;
        border-left: 7px solid #8A2BE2;
    }
    .widget2 h3{
        font-size: .8rem;
        font-weight: 900;
        color: #8A2BE2; 
        text-align: left;
        margin-left: 1.5rem;
    }
    .widget3{
        border: none;
        background-color: var(--color-white); 
        align-items: center;
        color: var(--color-button); 
        fill: var(--color-button); 
        width: 20.5rem;
        justify-content: center;
        height: 5.7rem;
        border-radius: 20px ;
        padding: .68rem 1rem;
        font-family: 'Outfit', sans-serif;
        transition: all 300ms ease;
        position: relative; 
        margin-top: .2rem;
        text-transform: uppercase;
        border-left: 7px solid #ffd700;
    }
    .widget3 h3{
        font-size: .8rem;
        font-weight: 900;
        color: #ffd700; 
        text-align: left;
        margin-left: 1.5rem;
    }.widget4{
        border: none;
        background-color: var(--color-white); 
        align-items: center;
        color: var(--color-button); 
        fill: var(--color-button); 
        width: 20.5rem;
        justify-content: center;
        height: 5.7rem;
        border-radius: 20px ;
        padding: .68rem 1rem;
        font-family: 'Outfit', sans-serif;
        transition: all 300ms ease;
        position: relative; 
        margin-top: .2rem;
        text-transform: uppercase;
        border-left: 7px solid #8d8d8d;
    }
    .widget4 h3{
        font-size: .8rem;
        font-weight: 900;
        text-align: left;
        color: #8d8d8d; 
        margin-left: 1.5rem;
    }
    .transactions-total{
        position: relative; 
        text-align: center;
    }
    
    .newUser-button1{
        margin-left: 2rem;
        margin-top: 2rem;
        position: relative;
        display: inline-block;
    }
    .widget5{
        border: none;
        background-color: var(--color-white);
        align-items: center;
        color: var(--color-button); 
        fill: var(--color-button); 
        width: 10.5rem;
        text-align: center;
        justify-content: center;
        height: 6.5rem;
        border-radius:  15px;
        padding: .68rem 1rem;
        font-family: 'century gothic', sans-serif;
        transition: all 300ms ease;
        box-shadow: 3px 2px 2px var(--color-solid-gray);
        position: relative; 
        margin-top: .2rem;
        text-transform: uppercase;
    }
    .widget5 h4{
        font-size: .9rem;
        font-weight: 900;
        color: #000080;
        width: 100%;    
        position: relative;
        text-align: center;
     }
     .widget6{
        border: none;
        background-color: var(--color-white);
        align-items: center;
        width: 10.5rem;
        text-align: center;
        justify-content: center;
        height: 6.5rem;
        border-radius:  15px;
        padding: .68rem 1rem;
        font-family: 'century gothic', sans-serif;
        transition: all 300ms ease;
        box-shadow: 3px 2px 2px var(--color-solid-gray);
        position: relative; 
        margin-top: .2rem;
        text-transform: uppercase;
    }
    .widget6 h4{
        font-size: .9rem;
        font-weight: 900;
        width: 100%;    
        color: #6495ED; 
        position: relative;
        text-align: center;
     }
     .widget7{
        border: none;
        background-color: var(--color-white);
        align-items: center;
        width: 10.5rem;
        text-align: center;
        justify-content: center;
        height: 6.5rem;
        border-radius:  15px;
        padding: .68rem 1rem;
        font-family: 'century gothic', sans-serif;
        transition: all 300ms ease;
        box-shadow: 3px 2px 2px var(--color-solid-gray);
        position: relative; 
        margin-top: .2rem;
        text-transform: uppercase;
    }
    .widget7 h4{
        font-size: .9rem;
        font-weight: 900;
        width: 100%;    
        color: #DC143C; 
        position: relative;
        text-align: center;
     }
     .widget8{
        border: none;
        background-color: var(--color-white);
        align-items: center;
        width: 10.5rem;
        text-align: center;
        justify-content: center;
        height: 6.5rem;
        border-radius:  15px;
        padding: .68rem 1rem;
        font-family: 'century gothic', sans-serif;
        transition: all 300ms ease;
        box-shadow: 3px 2px 2px var(--color-solid-gray);
        position: relative; 
        margin-top: .2rem;
        text-transform: uppercase;
    }
    .widget8 h4{
        font-size: .9rem;
        font-weight: 900;
        width: 100%;    
        color: #8B4513; 
        position: relative;
        text-align: center;
     }
     .total-transaction1{
        font-family: 'century gothic', sans-serif;
        text-align: center;
        color: #000080; 
        margin-left: .2rem;
        font-size: 1.3rem;
    }   
    .total-transaction2{
        font-family: 'century gothic', sans-serif;
        text-align: center;
        color: #6495ED; 
        margin-left: .2rem;
        font-size: 1.3rem;
    }
    .total-transaction3{
        font-family: 'century gothic', sans-serif;
        text-align: center;
        color: #DC143C; 
        margin-left: .2rem;
        font-size: 1.3rem;
    }
    .total-transaction4{
        font-family: 'century gothic', sans-serif;
        text-align: center;
        color:#8B4513; 
        margin-left: .2rem;
        font-size: 1.3rem;
    }
    .total-deliveries{
        font-family: 'ARIAL', sans-serif;
        display: inline-block;
        color: var(--color-black); 
        margin-left: -.2rem;
        margin-top: .5rem;
        font-size: 1.5rem;
    }
    .icon-widget{
        position: relative;
        display: inline-block;
        float: left;
        margin-right: 2.5rem;
        margin-left: 1.3rem;
        margin-top: 1.2rem;
    }
    .text-widtget{
        display: inline-block;
        position: relative;
    }
    .peso-sign{
        font-family: 'century gothic', sans-serif;
        margin-left: -.1rem;
        font-size: 1.5rem;
        color: var(--color-black);
    }

.bar-graph1{
    width: 65%;
    height: 35rem;
    background-color: var(--color-white);
    border-radius: 25px;
    margin-bottom: 3rem;
    margin-right: 2rem;
    text-align: center;
    align-items: center;
    display: inline-block;
    justify-content: center;
}.bar-graph2{
    width: 32%;
    height: 35rem;
    background-color: var(--color-white);
    border-radius: 25px;
    margin-bottom: 3rem;
    display: inline-block;
    text-align: center;
    align-items: center;
    justify-content: center;
}

.caption {
    color: var(--color-black);
    width: 100%;
    border-bottom: 1px solid var(--color-black);
    padding-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: .5px;
    position: relative; 
    padding-top: 2rem;
    font-weight: bold;
}

.bar1{
    width: 100%;
    text-align: center;
    margin-right: 3rem;
    margin-left: 3rem;
    justify-content: center;
    align-items: center;
}
.bar2{
    width: 100%;
    margin-top: 1rem;
    text-align: center;
    margin-right: 3rem;
    margin-left: 3rem;
    justify-content: center;
    align-items: center;
}
.viewTransaction{
    font-family: 'century-gothic', sans-serif;
    font-size: .7rem;
    color: var(--color-main);
    text-transform: uppercase;
    cursor: pointer;
}
.viewTransaction:hover{
    color: var(--color-maroon);
    border-bottom: 1px solid var(--color-maroon);
}
.outofstock{
        border-radius: 20px;
        background-color: #B22222;
        color: #ffffff;
        font-size: 10px;
        padding: 7px;
        font-weight: 700;
        padding-right: 9px;
        padding-left: 9px;
    }
    .instock{
        border-radius: 20px;
        background-color: #228B22;
        font-size: 10px;
        padding: 7px;
        font-weight: 700;
        padding-right: 9px;
        padding-left: 9px;
        color: #ffffff;
    }
/* ----------------------------------------PIE GRAPH------------------------------------ */

.chart {
  background: 
    conic-gradient($red 4%, 
      $gray 0 8%, 
      $blue 0 17%,
      $yellow 0 48%,
      $purple 0 54%,
      $orange 0
    );
  border-radius: 50%;
  width: 50%;
  height: 0;
  padding-top: 50%;
  float: left;
  padding-right: 20px;
}

.key {
  width: 50%;
  float: right;
  list-style: none;
  display: table;
  border-collapse: separate;
  > li {
    display: table-row;
    > * {
      display: table-cell;
      border-bottom: 12px solid white;
    }
  }
}

.percent {
  color: white;
  padding: 10px 2px;
  text-shadow: 0 0 1px black;
  text-align: center;
}
.choice {
  padding-left: 10px;
}

.red {
  background: $red;
}
.gray {
  background: $gray;
}
.blue {
  background: $blue;
}
.yellow {
  background: $yellow;
}
.purple {
  background: $purple;
}
.orange {
  background: $orange;
}

 {
  box-sizing: border-box;
}

    </style>
    <body>
        <div class="container">
            <?php
            include('../common/side-menu.php')
            ?>
            <main>
                <div class="main-dashboard">
                    <h1 class="dashTitle">DASHBOARD</h1> 
                    <div class="user-title">
                            <h2>Today's Summary</h2>
                        </div>
                    <div class="sub-tab">
                        <div class="newUser-button"> 
                            <div id="add-userbutton" class="widget1">
                                <div class="icon-widget">
                                    <img  src="../Pictures and Icons/icons8-total-sales-48.png" >
                                </div>
                                <div class="text-widget">
                                    <?php
                                        $date = date("Y-m-d");
                                        $total_sales_query = "SELECT
                                            IF(SUM(transaction.total_amount) IS NULL or SUM(transaction.total_amount) = '', 0, SUM(transaction.total_amount)) as total
                                            FROM transaction
                                            WHERE transaction.status_id = '1'
                                            AND transaction.created_at_date = '$date'";
                                        $total_sales_result = mysqli_query($con, $total_sales_query);
                                        $total_sales = mysqli_fetch_assoc($total_sales_result);
                                    ?>
                                    <span class="total-deliveries">
                                        <span class="peso-sign">&#8369</span>
                                        <?php echo number_format($total_sales['total'], '2','.',','); ?>
                                    </span>
                                    <h3 class="deliveries">TOTAL SALES</h3>
                                </div>
                            </div>
                        </div>
                        <div class="newUser-button"> 
                            <div id="add-userbutton" class="widget2">
                                <div class="icon-widget">
                                    <img width="45" src="../Pictures and Icons/icons8-expense-64.png" >
                                </div>
                                <div class="text-widget">
                                    <?php
                                        $date = date("Y-m-d");
                                        $total_expense_query = "SELECT
                                            IF(SUM(expense.amount) IS NULL or SUM(expense.amount) = '', 0, SUM(expense.amount)) as total
                                            FROM expense
                                            WHERE expense.status_archive_id = '1'
                                            AND expense.date = '$date'";
                                        $total_expense_result = mysqli_query($con, $total_expense_query);
                                        $total_expense = mysqli_fetch_assoc($total_expense_result);
                                    ?>
                                    <span class="total-deliveries">
                                        <span class="peso-sign">&#8369</span>
                                        <?php echo number_format($total_expense['total'], '2','.',','); ?>
                                    </span>
                                    <h3 class="deliveries">TOTAL EXPENSE</h3>
                                </div>
                            </div>
                        </div>
                        <div class="newUser-button"> 
                            <div id="add-userbutton" class="widget3">
                                <div class="icon-widget">
                                    <img width="45" src="../Pictures and Icons/icons8-transaction-48.png" >
                                </div>
                                <div class="text-widget">
                                    <?php
                                        $date = date("Y-m-d");
                                        $total_transaction_query = "SELECT
                                            COUNT(transaction.id) as total
                                            FROM transaction
                                            WHERE transaction.created_at_date = '$date'";
                                        $total_transaction_result = mysqli_query($con, $total_transaction_query);
                                        $total_transaction = mysqli_fetch_assoc($total_transaction_result);
                                    ?>
                                    <span class="total-deliveries"><?php echo $total_transaction['total'];?></span>
                                    <h3 class="deliveries">TOTAL TRANSACTION</h3>
                                </div>
                            </div>
                        </div>
                        <div class="newUser-button"> 
                            <div id="add-userbutton" class="widget4">
                                <div class="icon-widget">
                                    <img width="55" src="../Pictures and Icons/icons8-customer-64.png" >
                                </div>
                                <div class="text-widget">

                                    <?php
                                        $total_unpaid_customers_query = "SELECT
                                            COUNT(DISTINCT transaction.customer_name_id) as total
                                            FROM transaction";
                                        $total_unpaid_customers_result = mysqli_query($con, $total_unpaid_customers_query);
                                        $total_unpaid_customers = mysqli_fetch_assoc($total_unpaid_customers_result);
                                    ?>
                                    <span class="total-deliveries"><?php echo $total_unpaid_customers['total'];?></span>
                                    <h3 class="deliveries">UNPAID CUSTOMERS</h3>

                                </div>
                            </div>
                        </div>
                        
                        <div class="transactions-total">
                            <div class="newUser-button1"> 
                                <div id="add-userbutton" class="widget5">
                                <?php
                                    $date = date("Y-m-d");
                                    $total_delivery_query = "SELECT
                                        COUNT(transaction.id) as total
                                        FROM transaction
                                        WHERE transaction.created_at_date = '$date'
                                        AND transaction.service_type != 'Walk In'";
                                    $total_delivery_result = mysqli_query($con, $total_delivery_query);
                                    $total_delivery = mysqli_fetch_assoc($total_delivery_result);
                                ?>
                                    <h4 class="deliveries-transaction">DELIVERIES</h4>
                                    <span class="total-transaction1"><?php echo $total_delivery['total'];?></span>
                                </div>
                            </div>
                            <div class="newUser-button1">
                                <?php
                                    $date = date("Y-m-d");
                                    $total_walkin_query = "SELECT
                                        COUNT(transaction.id) as total
                                        FROM transaction
                                        WHERE transaction.created_at_date = '$date'
                                        AND transaction.service_type = 'Walk In'";
                                    $total_walkin_result = mysqli_query($con, $total_walkin_query);
                                    $total_walkin = mysqli_fetch_assoc($total_walkin_result);
                                ?>
                                <div id="add-userbutton" class="widget6">
                                    <h4 class="deliveries-transaction">WALK IN</h4>
                                    <span class="total-transaction2"><?php echo $total_walkin['total'];?></span>
                                </div>
                            </div>
                            <div class="newUser-button1"> 
                                <div id="add-userbutton" class="widget7">
                                <?php
                                    $total_critical_stock_query = "SELECT 
                                    COUNT(inventory_item.id) as total
                                    FROM inventory_item
                                    INNER JOIN inventory_stock
                                    ON inventory_item.id = inventory_stock.item_name_id
                                    WHERE inventory_stock.on_hand <= inventory_item.reorder_level
                                    AND inventory_item.status_archive_id = 1";
                                    $total_critical_stock_result = mysqli_query($con, $total_critical_stock_query);
                                    $total_critical_stock = mysqli_fetch_assoc($total_critical_stock_result);
                                ?>
                                    <h4 class="deliveries-transaction">CRITICAL STOCK</h4>
                                    <span class="total-transaction3"><?php echo $total_critical_stock['total'];?></span>
                                </div>
                            </div>
                            <div class="newUser-button1"> 
                                <div id="add-userbutton" class="widget8">
                                <?php
                                    $date = date("Y-m-d");
                                    $total_new_customer_query = "SELECT 
                                        COUNT(customers.id) as total
                                        FROM customers 
                                        WHERE DATE(customers.created_at) = '$date'";
                                    $total_new_customer_result = mysqli_query($con, $total_new_customer_query);
                                    $total_new_customer = mysqli_fetch_assoc($total_new_customer_result);
                                ?>
                                    <h4 class="deliveries-transaction">NEW CUSTOMERS</h4>
                                    <span class="total-transaction4"><?php echo $total_new_customer['total'];;?></span>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bar-graph1">
                            <header class="caption">Monthly Sales <?php echo ' '.date("Y")?></header>
                            <div class="bar1" style="width: 900px;">
                                <canvas id="myChart1"></canvas>
                            </div>
                    </div>

                    <div class="bar-graph2">
                            <header class="caption">Monthly Expenses (<?php echo date("F Y")?>)</header>
                            <div class="bar2" style="width: 400px;">
                                <canvas id="myChart2"></canvas>
                            </div>
                    </div>
                    <div class="container-table2">
                        <div class="main-container">
                            <div class="sub-tab-container">
                                <header class="previous-transaction-header">RECENT TRANSACTION</header>
                                <div class="card">
                                    <h1 class="day"><?php echo date("l")?></h1>
                                    <h1 class="dash">-</h1>
                                    <h1 class="date"><?php echo ' '.date("F j, Y")?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="customer-container" id="customerTable">
                            <table class="previous-transaction-table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer Name</th>
                                    <th>Order Details</th>
                                    <th>Service</th>
                                    <th>Payment Status</th>
                                    <th>Cashier Name</th>
                                    <th>Time</th>
                                </tr>
                                </thead>
                                <?php
                                $date = date("Y-m-d");
                                $dropdown_query2 = "SELECT 
                                    transaction.id,
                                    transaction.uuid,
                                    customers.customer_name,
                                    transaction.service_type,
                                    transaction.status_id,
                                    users.first_name,
                                    users.last_name,
                                    transaction.created_at_time,
                                    transaction.created_at_date
                                    FROM transaction
                                    INNER JOIN users
                                    ON transaction.created_by_id = users.user_id
                                    LEFT JOIN customers
                                    ON transaction.customer_name_id = customers.id
                                    WHERE transaction.created_at_date = '$date'
                                    ORDER BY transaction.created_at_date DESC,
                                    transaction.created_at_time DESC
                                    LIMIT 5";
                                $result4 = mysqli_query($con, $dropdown_query2);
                                if(mysqli_num_rows($result4) > 0)
                                {
                                foreach($result4 as $rows)
                                {   
                                    ?>
                                    <tbody>
                                    <tr>
                                        <td> <?php echo $rows['id']; ?></td>
                                        <td> <?php if($rows['customer_name']){
                                            echo $rows['customer_name'];
                                            }else{
                                                echo 'GUEST';
                                            }
                                        ?></td>
                                        <td> <a class="viewTransaction" href="../pos/point-of-sales-viewdetails.php?view=<?php echo $rows['uuid'];?>">View Details</a></td>

                                        <td> <?php echo $rows['service_type']; ?></td>
                                        <td> 
                                            <?php 
                                            if($rows['status_id'] == 0){
                                                echo '<span class="outofstock">Unpaid</span>';
                                            }else{
                                                echo '<span class="instock">Paid</span>';
                                            } ?>
                                        </td>
                                        <td> <?php echo $rows['first_name'] .' '. $rows['last_name'] ; ?></td>
                                        <td> <?php echo $rows['created_at_time']; ?></td>
                                    <tr id="noRecordTR" style="display:none">
                                        <td colspan="7">No Record Found</td>
                                    </tr>
                                    </tbody>
                                    <?php
                                        }}else { ?>
                                        <tr id="noRecordTR">
                                            <td colspan="7">No Transaction(s) Added</td>
                                        </tr>
                                    <?php } ?>
                            </table>
                        </div>
                    </div>
                    <div class="container-table1">
                            <div class="main-container1">
                                <div class="sub-tab-container1">
                                    <header class="previous-transaction-header1">TODAY' ATTENDANCE</header>
                                </div>
                            </div>
                            <div class="customer-container1" id="customerTable">
                                <table class="previous-transaction-table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Employee Name</th>
                                        <th>Time IN</th>
                                        <th>Time OUT</th>
                                    </tr>
                                    </thead>
                                    <?php
                                    $date = date("Y-m-d");
                                    $dropdown_query2 = "SELECT 
                                        attendance.id,
                                        attendance.time_in,
                                        attendance.time_out, 
                                        employee.first_name as emp_first_name,
                                        employee.last_name as emp_last_name
                                        FROM attendance 
                                        INNER JOIN employee 
                                        ON attendance.employee_id = employee.id
                                        WHERE attendance.status_archive_id = 1
                                        and attendance.date = '$date'";
                                    $result4 = mysqli_query($con, $dropdown_query2);
                                    if(mysqli_num_rows($result4) > 0)
                                    {
                                    foreach($result4 as $rows)
                                    {   
                                        ?>
                                        <tbody>
                                        <tr>
                                            <td> <?php echo $rows['id']; ?></td>
                                            <td> <?php echo $rows['emp_first_name'].' '.$rows['emp_last_name'] ; ?></td>
                                            <td> <?php echo $rows['time_in']; ?></td>
                                            <td> <?php echo $rows['time_out']; ?></td></td>
                                        <tr id="noRecordTR" style="display:none">
                                            <td colspan="4">No Record Found</td>
                                        </tr>
                                        </tbody>
                                        <?php
                                            }}else { ?>
                                            <tr id="noRecordTR">
                                                <td colspan="7">No Transaction(s) Added</td>
                                            </tr>
                                        <?php } ?>
                                </table>
                            </div>
                    </div>
                </div>
             
            </main>

            <div class="top-menu">
                <div class="menu-bar">
                    <div class="menu-btn2">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h2 class="Title-top">DASHBOARD</h2>
                    <div class="user1">
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
                    <div class="user2">
                        <div class="profile" onclick="menuToggle();">
                            <img src="../uploaded_image/<?= $_SESSION['user_profile_image']; ?>" alt="">
                        </div>
                        <div class="drop-menu" >
                            <div class="ul">
                                <div class="user-type3">
                                    <h1><?php echo $_SESSION['user_user_type']; ?> </h1>
                                </div>
                                <input type="checkbox" class="checkbox" id="checkbox">
                                <label for="checkbox" class="theme-dark">
                                    <svg class="moon" xmlns="http://www.w3.org/2000/svg" height="18" width="18"><path d="M10 17q-2.917 0-4.958-2.042Q3 12.917 3 10q0-2.917 2.042-4.958Q7.083 3 10 3q.271 0 .531.021.261.021.531.062-.812.605-1.291 1.5-.479.896-.479 1.917 0 1.771 1.218 2.99 1.219 1.218 2.99 1.218 1.021 0 1.917-.479.895-.479 1.5-1.291.041.27.062.531.021.26.021.531 0 2.917-2.042 4.958Q12.917 17 10 17Z"/></svg>
                                    <svg class="sun" xmlns="http://www.w3.org/2000/svg" height="18" width="18"><path d="M10 14q-1.667 0-2.833-1.167Q6 11.667 6 10q0-1.667 1.167-2.833Q8.333 6 10 6q1.667 0 2.833 1.167Q14 8.333 14 10q0 1.667-1.167 2.833Q11.667 14 10 14Zm-8.25-3.25q-.312 0-.531-.219Q1 10.312 1 10q0-.312.219-.531.219-.219.531-.219h2q.312 0 .531.219.219.219.219.531 0 .312-.219.531-.219.219-.531.219Zm14.5 0q-.312 0-.531-.219-.219-.219-.219-.531 0-.312.219-.531.219-.219.531-.219h2q.312 0 .531.219Q19 9.688 19 10q0 .312-.219.531-.219.219-.531.219ZM10 4.5q-.312 0-.531-.219-.219-.219-.219-.531v-2q0-.312.219-.531Q9.688 1 10 1q.312 0 .531.219.219.219.219.531v2q0 .312-.219.531-.219.219-.531.219ZM10 19q-.312 0-.531-.219-.219-.219-.219-.531v-2q0-.312.219-.531.219-.219.531-.219.312 0 .531.219.219.219.219.531v2q0 .312-.219.531Q10.312 19 10 19ZM5.042 6.104 4 5.042q-.229-.209-.229-.511 0-.302.229-.531.208-.229.521-.229.312 0 .521.229l1.062 1.042q.229.229.229.531 0 .302-.229.531-.208.229-.521.229-.312 0-.541-.229ZM14.958 16l-1.062-1.042q-.229-.229-.229-.531 0-.302.229-.531.208-.229.521-.229.312 0 .541.229L16 14.958q.229.209.229.511 0 .302-.229.531-.229.229-.521.229-.291 0-.521-.229Zm-1.062-9.896q-.229-.208-.229-.521 0-.312.229-.541L14.958 4q.23-.229.521-.219.292.011.521.219.229.229.229.521 0 .291-.229.521l-1.042 1.062q-.229.229-.531.229-.302 0-.531-.229ZM4 16q-.229-.208-.229-.521 0-.312.229-.521l1.042-1.062q.229-.208.531-.208.302 0 .531.208.229.229.219.531-.011.302-.219.531L5.042 16q-.209.229-.511.229-.302 0-.531-.229Z"/></svg>
                                    <div class="ball"></div>
                                </label>
                                </input>
                                <a href="#" class="account">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.917 14.167q1.062-.875 2.364-1.313 1.302-.437 2.719-.437 1.417 0 2.719.437 1.302.438 2.385 1.313.688-.855 1.084-1.907.395-1.052.395-2.26 0-2.75-1.916-4.667Q12.75 3.417 10 3.417T5.333 5.333Q3.417 7.25 3.417 10q0 1.208.406 2.26.406 1.052 1.094 1.907ZM10 10.854q-1.229 0-2.073-.844-.844-.843-.844-2.072 0-1.23.844-2.073.844-.844 2.073-.844t2.073.844q.844.843.844 2.073 0 1.229-.844 2.072-.844.844-2.073.844Zm0 7.479q-1.729 0-3.25-.656t-2.646-1.781q-1.125-1.125-1.781-2.646-.656-1.521-.656-3.25t.656-3.25q.656-1.521 1.781-2.646T6.75 2.323q1.521-.656 3.25-.656t3.25.656q1.521.656 2.646 1.781t1.781 2.646q.656 1.521.656 3.25t-.656 3.25q-.656 1.521-1.781 2.646t-2.646 1.781q-1.521.656-3.25.656Zm.021-1.75q1.021 0 2-.312.979-.313 1.771-.896-.771-.604-1.75-.906-.98-.302-2.042-.302-1.062 0-2.031.302-.969.302-1.761.906.792.583 1.782.896.989.312 2.031.312ZM10 9.104q.521 0 .844-.323.323-.323.323-.843 0-.521-.323-.844-.323-.323-.844-.323-.521 0-.844.323-.323.323-.323.844 0 .52.323.843.323.323.844.323Zm0-1.166Zm0 7.437Z"/></svg>
                                    <h4>My Account</h4>
                                </a>
                                <a href="#" class="help">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M10 15q.417 0 .708-.292Q11 14.417 11 14t-.292-.708Q10.417 13 10 13t-.708.292Q9 13.583 9 14t.292.708Q9.583 15 10 15Zm-.75-3.188h1.521q0-.77.135-1.093.136-.323.656-.823.73-.708 1.011-1.208.281-.5.281-1.105 0-1.145-.781-1.864Q11.292 5 10.083 5q-1.062 0-1.843.562-.782.563-1.094 1.521l1.354.563q.188-.584.594-.906.406-.323.948-.323.583 0 .958.333t.375.875q0 .479-.323.854t-.719.729q-.729.667-.906 1.094-.177.427-.177 1.51ZM10 18q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                                    <h4>Help</h4>
                                </a>
                                <a href="../auth/logout.php" class="logout">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.5 17q-.625 0-1.062-.438Q3 16.125 3 15.5v-11q0-.625.438-1.062Q3.875 3 4.5 3H10v1.5H4.5v11H10V17Zm9-3.5-1.062-1.062 1.687-1.688H8v-1.5h6.125l-1.687-1.688L13.5 6.5 17 10Z"/></svg>
                                    <h4>Logout</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                        

        </div> 
    </body>
</html>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/reports-sales.js"></script>
<script src="../index.js"></script>
<?php
$year = date("Y");
$jan = get_month_sales_data($con, "January", $year);
$feb = get_month_sales_data($con, "February", $year);
$mar = get_month_sales_data($con, "March", $year);
$apr = get_month_sales_data($con, "April", $year);
$may = get_month_sales_data($con, "May", $year);
$jun = get_month_sales_data($con, "June", $year);
$jul = get_month_sales_data($con, "July", $year);
$aug = get_month_sales_data($con, "August", $year);
$sep = get_month_sales_data($con, "September", $year);
$oct = get_month_sales_data($con, "October", $year);
$nov = get_month_sales_data($con, "November", $year);
$dec = get_month_sales_data($con, "December", $year);

echo '
<script type="text/JavaScript"> 

    var config1 = {
        type: "bar",
        data: {
        datasets: [{
        label: ["Total Sales Per Month"],
        data: [
            '.$jan.',
            '.$feb.',
            '.$mar.',
            '.$apr.',
            '.$may.',
            '.$jun.',
            '.$jul.',
            '.$aug.',
            '.$sep.',
            '.$oct.',
            '.$nov.',
            '.$dec.'],

        backgroundColor: [
            "rgba(255, 51, 51, 0.7)",
            "rgba(255, 131, 51, 0.7)",
            "rgba(255, 218, 51, 0.7)",
            "rgba(144, 255, 51, 0.7)",
            "rgba(51, 255, 150, 0.7)",
            "rgba(51, 252, 255 , 0.7)",
            "rgba(51, 131, 255, 0.7)",
            "rgba(134, 51, 255, 0.7)",
            "rgba(255, 51, 255, 0.7)",
            "rgba(255, 51, 144, 0.7)",
            "rgba(255, 51, 82, 0.7)",
            "rgba(201, 203, 207, 0.7)"
        ],
        borderColor: [
            "rgb(255, 51, 51 )",
            "rgb(255, 131, 51 )",
            "rgb(255, 218, 51 )",
            "rgb(144, 255, 51 )",
            "rgb(51, 255, 150 )",
            "rgb(51, 252, 255 )",
            "rgb(51, 131, 255 )",
            "rgb(134, 51, 255 )",
            "rgb(255, 51, 255 )",
            "rgb(255, 51, 144 )",
            "rgb(255, 51, 82 )",
            "rgb(201, 203, 207 )"
        ],
        borderWidth: 1
        }],
        labels: ["January","February","March","April","May","June","July","August","September","October","November","December"]

    },
    options: {
            responsive: true,
            legend: {
                position: "top",
            },
            title: {
                display: true,
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };

    var myChart1 = new Chart(
        document.getElementById("myChart1"),
        config1
    );
</script>
';
?>

</script>
    <?php
    $maintenace = get_maintenance_count($con);
    $utilities = get_utilities_count($con);
    $salaries = get_salaries_count($con);
    $other_expenses = get_other_expenses_count($con);
    echo '
    <script type="text/JavaScript"> 

    var config2 = {
        type: "pie",
        data: {
        datasets: [{
        data: [
            '.$maintenace.',
            '.$utilities.',
            '.$salaries.',
            '.$other_expenses.'
        ],

        backgroundColor: [
            "rgba(255, 51, 51, 0.7)",
            "rgba(255, 131, 51, 0.7)",
            "rgba(255, 218, 51, 0.7)",
            "rgba(144, 255, 51, 0.7)"
        ],
        borderColor: [
            "rgb(255, 255, 255 )",
            "rgb(255, 255, 255 )",
            "rgb(255, 255, 255 )",
            "rgb(255, 255, 255 )"
        ],
        borderWidth: 1
        }],
        labels: [
            "Maintenance", 
            "Utilities", 
            "Salaries", 
            "Others"]
    },
    options: {
            responsive: true,
            legend: {
                position: "top",
            },
            title: {
                display: true,
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };

    var myChart2 = new Chart(
        document.getElementById("myChart2"),
        config2
    );
    </script>
';
?>

<script>
    var divToPrint = document.getElementById('print');
            newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
</script>