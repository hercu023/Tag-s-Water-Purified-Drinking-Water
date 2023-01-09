<?php
require_once '../database/connection-db.php';
require_once "../service/user-access.php";

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'MONITORING-DELIVERY_PICKUP')) {
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
         <title>Tag's Water Purified Drinking Water</title>
        <!-- <link rel="stylesheet" type="text/css" href="../CSS/monitoring-delivery-pickup-delivered.css"> -->
        <script src="../index.js"></script>
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
.viewTransaction{
font-family: 'century-gothic', sans-serif;
font-size: .7rem;
color: var(--color-main);
text-transform: uppercase;
border-bottom: 1px solid var(--color-main);
cursor: pointer;
}
.viewTransaction:hover{
color: var(--color-maroon);
border-bottom: 1px solid var(--color-maroon);
}
.main-container{
box-shadow: 5px 5px 15px 0px var(--color-solid-gray);
/* height: 600px; */
background: var(--color-white);
width: 100%;
border-radius: 10px 10px 10px 10px;
margin-bottom: 1rem;
position: relative;
}
.sub-tab-container{
padding: 2rem;
}
.previous-transaction-header{
color: var(--color-black);

font-weight: bold;
font-size: 1rem;
text-align: center;
text-transform: uppercase;
font-family: 'COCOGOOSE', sans-serif;
letter-spacing: 1px;
width: 100%;
position: relative;
margin-bottom:1.5rem;
}
.account-container{
    /* margin-top: 2rem; */
    max-height: 650px;
    overflow:auto;
    background-color: var(--color-white);
    width: 100%;
    margin-bottom: 1rem;
    /* position: absolute; */
    box-shadow: 5px 5px 15px 0px var(--color-solid-gray);
    border-top: 2px solid var(--color-solid-gray);
    border-radius: 10px 10px 10px 10px;

}
.account-container table{
    background: var(--color-white);
    font-family: 'Switzer', sans-serif;
    width: 100%;
    font-size: 1rem;
    padding-left: 2.5rem;
    padding-right: 2.5rem;
    padding-bottom: 2.5rem;
    text-align: center;
    transition: all 700ms ease;
    /* margin-top: -1rem; */
}
.account-container table:hover{
    box-shadow: none;
    /* border-top: 8px solid var(--color-main); */
}

.account-container table tbody td{
    height: 4.8rem;
    border-bottom: 1px solid var(--color-solid-gray);
    color: var(--color-td);
    font-size: .8rem;
}
.orderSum-Details table tbody td{
    height: 4.8rem;
    text-align: center;
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
.Title-top{
display: none;
font-size: 1rem;
color: var(--color-main);
font-family: 'COCOGOOSE', sans-serif;
letter-spacing: .03rem;
}
.subTitle-top{
display: none;
font-size: .7rem;
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
.select-dropdown{
display: inline-block;
margin-left: 2rem;
position: relative;
max-height: 50px;
}
.select{
background-color: var(--color-white);
color: var(--color-solid-gray);
/* align-items: center; */
border-radius: 5px;
padding: .80rem 1rem;
width: 12rem;
font-size: 14px;
cursor: pointer;
transition: 0.3s;
border: none;
}
.select:hover{
background:  var(--color-solid-gray);
color: var(--color-white);
}
.main-account{
width:100%;
position: relative;
}
.dashTitle{
margin-top: 2rem;
font-size: min(max(1.9rem, 1.1vw), 2rem);
color: var(--color-main); 
font-family: 'COCOGOOSE', sans-serif;
letter-spacing: .03rem;
border-bottom: 2px solid var(--color-main); 
width: 78%;
}

/* ----------------------------------------Sub TAB---------------------------------------- */
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
main .sub-tab{
    margin-bottom: 2rem;
}
/* ----------------------------------------Search BAR---------------------------------------- */
.search{
    position: relative;
    display: inline-block;
    gap: 2rem;
    float: right;    
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
}
/* ----------------------------------------Add Button---------------------------------------- */

.newUser-button1{
    position: relative;
    margin-left: 1rem;
    display: inline-block;
}

.newUser-button3{
    position: relative;
    margin-left: 1rem;
    display: inline-block;
    
}
.add-account1{
    display: flex;
    border: none;
    background-color: var(--color-background); 
    align-items: center;
    color: var(--color-button); 
    fill: var(--color-button); 
    width: 12rem;
    text-align: center;
    justify-content: center;
    height: 2rem;
    border-radius: 10px;
    padding: .68rem 1rem;
    font-family: 'Outfit', sans-serif;
    transition: all 300ms ease;
    position: relative; 
    margin-top: .2rem;
    text-transform: uppercase;
    border-bottom: 4px solid #8FBC8F;
}
.add-account1 h3{
    font-size: .8rem;
    margin-right: 1.5rem;
}

.add-account3{
    display: flex;
    border: none;
    background-color: var(--color-background); 
    align-items: center;
    color: var(--color-black); 
    fill: var(--color-button); 
    width: 18rem;
    text-align: center;
    justify-content: center;
    height: 2rem;
    border-radius: 0px 0px 5px 5px;
    padding: .68rem 1rem;
    font-family: 'Outfit', sans-serif;
    transition: all 300ms ease;
    position: relative; 
    margin-top: .2rem;
    text-transform: uppercase;
    border-bottom: 7px solid #A9A9A9;
}
.add-account3 h3{
    font-weight: 900;
    font-size: .8rem;
    margin-right: 1.5rem;
}
.total-deliveries{
        font-family: 'ARIAL', sans-serif;
        color: var(--color-main); 
        font-size: .9rem;
    }
    .total-transactions{
        font-family: 'ARIAL', sans-serif;
        font-weight: 900;
        color: var(--color-black); 
        font-size: 1rem;
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
/* ----------------------------TOP MENU---------------------------- */

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
.sub-tab2{
    display: inline-block;
    position: relative;
    margin-left: 3rem;
}
@media screen and (max-width: 1600px){
.container{
    width: 94%;
}

.top-menu{
    width: 370px;
}

}
@media screen and (max-width: 1400px){

.side-bar{
    z-index: 3;
    position: fixed;
    left: -100%;
}
.close-btn{
    display: flex;
}


.sub-tab2{
    position: absolute;
}
main .account-container{
    width: 100%;
    margin-bottom: 2rem;
}

main .sub-tab{
    margin-bottom: 3rem;
}
.tooltipText{
    display: none;
}
.search-bar{
    margin-bottom: 2rem;
    width: 13rem;
}
}
@media screen and (max-width: 1200px){


.main-account{
    position: relative;
    width: 100%;
    /* margin-left: 2rem; */
}
.tooltipText{
    display: none;
}


.search-bar{
    width: 13rem;
}
}
@media screen and (max-width: 1050px){
.container{
    grid-template-columns: 1rem auto 2rem;
}
.user-title{
    margin-left: .2rem;
}
.sub-tab2{
    position: relative;
    margin-top: 1rem;
}
.main-account{
    position: relative;
    width: 100%;
    margin-right: -2rem;
}
.search-bar{
    width: 11.5rem;
    float: right;
}
.search-bar button{
    margin-left:10rem;
    position: absolute;
}
}
@media screen and (max-width: 768px){
.container{
    margin-left: -.8rem;
    width: 100%;
}
.user-title{
display: none;
}
.menu-btn2{
    display: flex;
}
.top-menu{
    width: 100%;
    margin: 0 auto 2rem;
}
.accTitle{
    display: none;
}
.Title-top{
    display: block;
    left: 0;
    font-size: 1rem;
    margin-left: 4rem;
    position: absolute;
}
.subTitle-top{
    display: block;
    font-size: .8rem;
    left: 0;
    margin-left: 12rem;
    padding-left: .5rem;
    position: absolute;
}
.search button{
    position: absolute;
    float: right;
    right: 5%;
}
.search{
    position: relative;
    width: 100%;
    margin-top: 1rem;
}
.search-bar{
    text-align: center;
    width: 90%;
    float: left;
} 
/* ----------------------------------top-menu----------------------------- */

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
    margin-right: 2rem;
}
.top-menu .menu-bar .user1{
    display: none;
}
.user-type4{
    margin-top: 1.9rem;
}
.drop-menu .ul .user-type3{
    display: flex;
    padding-bottom: 2.9rem;
    left:20.5%; 
    position: absolute;
}
.addnew-title{
    text-align: center;
    font-size: 1.5rem;
}
.dashTitle{
    display:none;
}

.user2 .drop-menu{
    right: 40px;
    height: 7.3rem;
    margin-top: 2px;
}
.user2 .drop-menu::before{
    right: 30px;
}
.drop-menu .ul{
    width: 8.5rem;
    height: 5rem;
}

.drop-menu .ul a{
    width: 8.5rem;
}
/* ------------------------------------------------------------------------------ */




.select-dropdown{
    position: relative;
    width: 100%;
    align-items: center;
    text-align: center;
    margin-top: 1rem;

}
.select{
    width: 100%;
    
}

.account-container{
    position: relative;
    margin-top:2rem;
    overflow: auto;
    width: 100%;
    max-height: 600px;
    border-top: 5px solid var(--color-solid-gray);
    font-size: 15px;
}
.account-container tbody tr td{
    font-size: 10px;
    
}
table {
    border: 0;
}

table caption {
    font-size: 1.3em;
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

table tr {
    border-bottom: 3px solid #ddd;
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
    /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
    content: attr(data-label);
    float: left;
    font-weight: bold;
    text-transform: uppercase;
}

table td:last-child {
    border-bottom: 0;
}

.sub-tab{
    margin-top: 5rem;
    width: 100%;
    align-items: center;
    text-align: center;
}


.sub-tab2{
    width: 100%;  
    margin-left: 0rem;
    text-align: center;

}


h3{
    display: block;
}
.add-account2{
    width: 8rem;
    position: relative;
    display: inline-block;
}
.newUser-button2{
    width: 8rem;
    margin-left: -20rem;
    margin-bottom: 2rem;
    position: relative;
    display: inline-block;
}
.totals{
    margin-left: -3rem;
    width: 10rem;
    position: relative;
}
.sub-tab-container{
    margin-left: -3rem;
    width: 20rem;
}
.sub-tab2{
    width: 100%;
}
.main-user-info{
    max-height: 380px;
    overflow: auto;
}

.main-user-info::-webkit-scrollbar{
    width: 0;
}
.bot-buttons{
    width: 100%;
    margin-left: -1rem;
    align-items: center;
    text-align: center;
}

.error-error{
    background-color: hsl(0, 100%, 77%);
    color: #ffffff;
    position: fixed;
    padding: 11px;
    z-index: 100;
    width: 80%;
    height: 2%;
    border-radius: 6px;
    align-items: center;
    text-align: center;
    margin-left: -.1rem;
    margin-bottom: -2rem;
    font-size: min(max(9px, 1.2vw), 11px);
    letter-spacing: 0.5px;
    font-family: Helvetica, sans-serif;
}
.container1{
    min-width: 280px;
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
/* ----------------------------TOP MENU---------------------------- */

.top-menu a{
text-decoration: none;
}
.top-menu{
margin-top: 1rem;
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
.top-menu .menu-bar .accTitle-top{
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
text-transform: uppercase;
}
h1{
margin-top: 6px;     
}
.welcome{
font-family: 'Calibri', sans-serif;
font-size: 11px;
/* margin-right: -7.3rem;*/
margin-top: -0.6rem; 
letter-spacing: 1px;
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
margin-top: .3rem;
}

.user2 .profile{
position: relative;
cursor: pointer;
}
.user2 .drop-menu{
position: absolute;
top: 120px;
right: 0;
padding: 10px 20px;
background: var(--color-white);
box-shadow: 3px 2px 10px 1px var(--color-solid-gray);
width: 110px;
box-sizing: 0 5px 25px rgba(0,0,0,0.1);
border-radius: 7px;
transition: 0.5s;
visibility: hidden;
opacity: 0;
}
.user2 .drop-menu.user2{
top: 85px;
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
font-family: 'Calibri', sans-serif;
font-size: 7.5px;
color: var(--color-main);
letter-spacing: .2rem;
display: none;
text-transform: uppercase;
}

.drop-menu .ul{
display: flex;
flex-direction: column;
height: 5rem;
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
.addnew-title{
font-size: min(max(1.9rem, 1.1vw), 2rem);
color: var(--color-solid-gray);
font-family: 'Malberg Trial', sans-serif;
letter-spacing: .09rem;
display: flex;
padding-top: 1rem;
justify-content: center;
border-bottom: 2px solid var(--color-solid-gray);
width: 100%;
padding-bottom: 2px;
}
.bot-buttons{
    width: 100%;
    align-items: center;
    text-align: center;
}
.AddButton1 button{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    width: 10rem;
    outline: none;
    justify-content: center;
    border: none;
    gap: .5rem;
    border-radius: 10px;
    font-size: .7rem;
    color: white;
    background:  var(--color-mainbutton);
    cursor: pointer;
    transition: 0.5s;
    /* margin-left: 1rem; */
    display: flex;
    fill: white;
    background: var(--color-solid-gray);
}
.AddButton1 button:hover{
    background: var(--color-secondary-main);
    box-shadow: 1px 3px 3px 0px var(--color-shadow-shadow);
    fill: var(--color-main);
    color: var(--color-main);
}
.AddButton2 button{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    width: 10rem;
    font-size: .7rem;
    justify-content: center;
    border: none;
    gap: .5rem;
    border-radius: 10px;
    color: white;
    background:  var(--color-mainbutton);
    cursor: pointer;
    transition: 0.5s;
    /* margin-left: 1rem; */
    display: flex;
    fill: white;
    background: var(--color-main);
}
.AddButton2 button:hover{
    background: var(--color-secondary-main);
    box-shadow: 1px 3px 3px 0px var(--color-shadow-shadow);
    color: var(--color-main);
    fill: var(--color-main);
}
.AddButton1{
        display: inline-block;
}
.AddButton2{
        display: inline-block;
}

.creditHref{
color: var(--color-main);
}
.creditHref:hover{
color: var(--color-maroon);
}

.bg-addcustomerform{
height: 100%;
width: 100%;
background: rgba(0,0,0,0.7);
top: 0;
position: fixed;
align-items: center;
justify-content: center;
display: none;
}
.main-user-info{
display: flex;
flex-wrap: wrap;
justify-content: space-between;
}
.customerName{
align-items:center;
width: 100%;
height: 5rem;
margin-left: 1rem;
margin-right: 1rem;
}
.customerName label{
/* width: 95%; */
color: var(--color-solid-gray);
font-size: 16px;
display: inline-block;
/* margin-left: .2rem; */
margin-bottom: 0.5rem;
font-family: 'Malberg Trial', sans-serif;
font-weight: 550;
/* margin: 5px 0; */
}

.select-customer{
/* background: var(--color-solid-gray); */
color: var(--color-black);
align-items: center;
border-radius: 13px;
/* padding: 8px 12px; */
height: 40px;
width: 100%;
margin-bottom: 1rem;
cursor: pointer;
transition: 0.3s;
}
.select{
        background: var(--color-solid-gray);
        color: var(--color-white);
        align-items: center;
        border-radius: 13px;
        padding: 8px 12px;
        height: 40px;
        width: 100%;
        cursor: pointer;
        transition: 0.3s;
    }
.usertype-dropdown{
width: 100%;
display: flex;
}
#note-box{
/* position: relative; */
width: 100%;
height: 1.32rem;
margin-bottom: 2rem;
color: var(--color-white);
border-radius: 10px;
font-family: 'COCOGOOSE', sans-serif;
}
#address-box{
/* position: relative; */
width: 100%;
color: var(--color-white);
border-radius: 10px;
font-family: 'COCOGOOSE', sans-serif;
}
#address-box label{
width: 100%;
}
#note-box label{
width: 100%;
}
.user-input-box{
flex-wrap: wrap;
text-align: center;
width: 48%;
padding-bottom: 15px;
}

.user-input-box label{
width: 95%;
color: var(--color-solid-gray);
font-size: 16px;
margin-right: 1rem;
margin-bottom: 0.5rem;
font-family: 'Malberg Trial', sans-serif;
font-weight: 550;
/* margin: 5px 0; */
}
.user-input-box label:focus{
border: 2px solid var(--color-main-3);
font-size: 17px;
font-weight: 600;
}
.user-input-box input::placeholder{
font-size: .8em;
color:var(--color-solid-gray);
}
/* ::placeholder:focus{
border: 2px solid var(--color-main-3);
} */
.user-input-box input:focus{
border: 2px solid var(--color-main);
background: var(--color-white);
}

.user-input-box input{
height: 60px;
width: 30%;
border: 2px solid var(--color-solid-gray);
border-radius: 20px;
outline: none;
text-align: center;
align-items: center;
font-size: 1.5em;
background: var(--color-white);
color: var(--color-black);
padding: 0 10px;
}
.batchlist{
        display: flex;
        border: none;
        text-decoration: none;
        background-color: var(--color-solid-gray); 
        align-items: center;
        color: var(--color-secondary-main); 
        fill: var(--color-secondary-main); 
        width: 19rem;
        padding: .68rem .8rem;
        text-align: center;
        justify-content: center;
        height: 1.7rem;
        gap: 1rem;
        font-weight: 700;
        border-radius: 20px;
        font-family: 'ARIAL', sans-serif;
        transition: all 300ms ease;
        position: relative; 
        text-transform: uppercase;
        cursor: pointer;
    }
    .batchlist h3{
        font-size: .8rem;
        margin-right: 1.5rem;
    }
    .batchlist:hover{
        background-color: #8FBC8F;
        color: white;
        fill: white;
    }

.total-deliveries{
        font-family: 'ARIAL', sans-serif;
        color: var(--color-main); 
        font-size: .9rem;
    }
    .total-transactions{
        font-family: 'ARIAL', sans-serif;
        font-weight: 900;
        color: var(--color-black); 
        font-size: 1rem;
    }
    .add-account2{
        display: flex;
        border: none;
        background-color: var(--color-white); 
        align-items: center;
        color: var(--color-button); 
        fill: var(--color-button); 
        width: 18rem;
        text-align: center;
        justify-content: center;
        height: 2rem;
        border-radius: 10px;
        padding: .68rem 1rem;
        font-family: 'Outfit', sans-serif;
        transition: all 300ms ease;
        position: relative; 
        margin-top: .2rem;
        text-transform: uppercase;
        border-left: 4px solid var(--color-main);
        border-right: 4px solid var(--color-main);
    }
    .add-account2 h3{
        font-size: 1rem;
        margin-right: 1.5rem;
    }
    .newUser-button2{
        margin-left: 1rem;
        position: relative;
        display: inline-block;
    }
    .totals{
        display: inline-block;
        margin-left: 1rem;
        position: relative;
    }
    .sub-tab-container{
        display: inline-block;

    }
    .bg-placeorderform{
        height: 100%;
        width: 100%;
        background: rgba(0,0,0,0.7);
        top: 0;
        position: fixed;
        display: flex;
        align-items: center;
        justify-content: center;
        /* display: flex; */
    }
    .container1{
    width: 100%;
    max-width: 600px;
    padding: 28px;
    margin: 0 28px;
    border-radius:  0px 0px 20px 20px;
    background-color: var(--color-white);
    box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
    border-top: 10px solid var(--color-solid-gray);
}
.customerName{
    align-items:center;
    width: 100%;
    margin-top: -1rem;
    margin-left: 1rem;
    margin-right: 1rem;
}

.customernameLbl{
    margin-left: 1rem;
    font-size: .9rem;
    display: inline-block;
    color: var(--color-solid-gray);
    font-weight: 600;
}
.customer_name{
    color: var(--color-main);
    text-transform: uppercase;
    margin-left: 1.5rem;
    font-family: 'Cocogoose', sans-serif;
    font-size: 1rem;
}
.createdatLbl{
    font-size: .9rem;
    /* width: 100%; */
    display: inline-block;
    margin-top: 1rem;
    border-top: 1px solid var(--color-main);
    border-bottom: 1px solid var(--color-main);
    margin-left: 2rem;
    color: var(--color-main);
    font-weight: 600;
}
.datetimeLbl{
        text-align: center;

    }
    .line{
    width:100%;
    margin-top: 1rem;
    margin-bottom: 1rem;
    border-bottom: 2px solid var(--color-solid-gray);
}
.payment-service{
    width: 100%;
    text-align: center;
}
.payment-options1{
    background-color: none;
    /* width: 100%; */
    /* margin-left:.5rem; */
    /* position: absolute; */
    display: inline-block;
    position: relative;
    /* padding-top: 1rem; */
    /* right: 8%; */
}
.payment-options2{
    background-color: none;
    /* width: 100%; */
    /* margin-left:.5rem; */
    /* position: absolute; */
    display: inline-block;
    position: relative;
    /* padding-top: 1rem; */
    /* right: 8%; */
}
.service-options{
    position: relative;
    border: none;
    width: 15rem;
    padding: 10px;
    align-items: center;
    text-align: center;
    margin-right: 2rem;
    font-family: 'cocogoose', sans-serif;
    font-size: .8rem;
    color: var(--color-secondary-main);
    border-radius: 10px;
    margin-top: 1rem;
    border-bottom: 2px solid var(--color-main);
    text-transform: uppercase;
    background-color: var(--color-solid-gray);
}
.paymentOptions-text{
    font-weight: 700;
    font-size: 13px;
    /* margin-left: 1rem; */
    margin-top:1.7rem;
    color: var(--color-black);
    display: inline-block;
    position: relative;
    font-family: arial, sans-serif;
}
.orderSum-Details{
    background-color: var(--color-white);
    padding: 1rem;
    width:100%;
    overflow:auto;
    /* display: inline-block; */
    box-shadow: 2px 2px 2px 1px var(--color-tertiary);
    /* margin-left: 1.1rem; */
    max-height: 8rem;
    height: 8rem;
    margin-top: 1rem;
    /* text-align: right; */
    /* display: flex; */
    border-top: 2px solid var(--color-solid-gray);
    position: relative;
    border-radius: 10px;
}
.orderSum-Details .tableCheckout td{
    color: var(--color-solid-gray);

}
.totalamount-Details{
    background-color: var(--color-background);
    padding-top: 1.5rem;
    width:100%;
    overflow:auto;
    max-height: 7rem;
    height: 7rem;
    margin-top: 1rem;
    border-radius: 5px;
    border-left: 1px solid var(--color-main);
    border-right: 1px solid var(--color-main);
    position: relative;
}

.tableCheckout table{
    background: var(--color-white);
    font-family: 'Switzer', sans-serif;
    width: 100%;
    font-size: 0.7rem;
    border-radius: 0px 0px 10px 10px;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    /* padding-bottom: 2.5rem; */
    text-align: center;
    transition: all 700ms ease;
    overflow: auto;
    margin-top: -1rem;
}
table{
    font-family: 'Switzer', sans-serif;
    width: 100%;
    border-radius: 0px 0px 10px 10px;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    padding-bottom: 2.5rem;
    text-align: center;
    transition: all 700ms ease;
    overflow: auto;
    margin-top: -1rem;
}
table tbody td{
    height: .4rem;
    border-bottom: 1px solid var(--color-main);
    color: var(--color-main);
    font-size: .67rem;
}
.tableCheckout th{
    height: 1.8rem;
    color: var(--color-solid-gray);
    /* margin:1rem; */
    font-size: .75rem;
    border: none;
    text-transform: uppercase;
    /* border-bottom: 2px solid var(--color-solid-gray); */
}
.payment-section{
    width: 100%;
    align-items: center;
    padding: 20px;
    margin-top: 1rem;
    justify-content: center;
    background-color: var(--color-secondary-main);
    border-top: 5px solid var(--color-main);
    border-radius: 0 0 10px 10px;
}
.user-input-box-totalamount{
    margin-bottom: 1rem;
}

.user-input-box-totalamount label{
    color: var(--color-black);
    text-align: right;
    font-size: 25px;
    /* margin-left: .2rem; */
    font-family: 'century gothic', sans-serif;
    font-weight: 750;
    /* margin: 5px 0; */
}
.user-input-box-totalamount .remaining-amountLbl{
    font-family: 'arial', sans-serif;
    font-weight: 500;   
    color: var(--color-solid-gray);
    font-size: 15px;
}
.remaining-amount2{
    color: var(--color-solid-gray);
    font-family: 'calibri', sans-serif;
    font-size: 15px;
    font-weight: 700;
    float: right;
}
.total-amount2{
    color: var(--color-black);
    font-family: 'calibri', sans-serif;
    font-size: 25px;
    float: right;
}
.close{
    text-align: right;
    float: right;
    color: var(--color-maroon);
    cursor: pointer;
}

.close:hover{
    filter: brightness(2.5);
}
</style>
    <body>
    
        <div class="container">
        <?php
            include('../common/side-menu.php')
        ?>
            <main>
                <div class="main-dashboard">
                    <h1 class="dashTitle">MONITORING</h1> 
                    <?php
                    if (isset($_GET['error'])) {
                        echo '<p id="myerror" class="error-error"> '.$_GET['error'].' </p>';
                    }
                    ?>
                    <div class="sub-tab">
                            <div class="user-title">
                                <h2>DELIVERY/PICK UP</h2>
                            </div>
        

                            <div class="sub-tab-container">
                            
                                    <!-- <h2 class="remaining">REMAINING ITEMS</h2> -->
                                <div class="newUser-button2"> 
                                    <div id="add-userbutton" class="add-account2">
                                    <?php $delivered_query = "SELECT 
                                    count(delivery_list.id) as count
                                    FROM delivery_list
                                    WHERE delivery_list.delivery_status = 3";
                                    $delivered_result = mysqli_query($con, $delivered_query);
                                    $delivered = mysqli_fetch_assoc($delivered_result);
                                    $count_of_delivered = $delivered['count'];
                                    ?>
                                        <h3 class="deliveries">TOTAL DELIVERED ORDERS</h3>
                                        <span class="total-deliveries"><?php echo $count_of_delivered ?></span>
                                    </div>
                                </div>
                                <div class="newUser-button3"> 
                                    <a href="../monitoring/monitoring-delivery-pickup.php" id="add-userbutton" class="batchlist">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M14 18q-1.667 0-2.833-1.167Q10 15.667 10 14q0-1.667 1.167-2.833Q12.333 10 14 10q1.667 0 2.833 1.167Q18 12.333 18 14q0 1.667-1.167 2.833Q15.667 18 14 18Zm1.146-2.146.708-.708-1.354-1.354V12h-1v2.208ZM4.5 17q-.625 0-1.062-.438Q3 16.125 3 15.5v-11q0-.625.448-1.062Q3.896 3 4.5 3h3.562q.209-.708.709-1.104Q9.271 1.5 10 1.5q.75 0 1.25.396T11.938 3H15.5q.604 0 1.052.438Q17 3.875 17 4.5v4.896q-.354-.229-.719-.406-.364-.178-.781-.282V4.5H14V7H6V4.5H4.5v11h4.208q.146.438.292.792.146.354.396.708ZM10 4.5q.312 0 .531-.219.219-.219.219-.531 0-.312-.219-.531Q10.312 3 10 3q-.312 0-.531.219-.219.219-.219.531 0 .312.219.531.219.219.531.219Z"/></svg>
                                        <h3 class="deliveries">PENDING DELIVERY and PICK UP</h3>
                                    </a>
                                </div>
                        </div> 
                </div>
        
                    
                    <div class="account-container" id="customerTable">
                    <br>
                            <header class="previous-transaction-header">DELIVERED ORDERS</header>
                            <hr>
                            <table class="table" id="myTable">
                            <thead>
                            <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Order Details</th>
                            <th>Total Amount</th>
                            <th>Payment Status</th>
                            <th>Delivery Boy</th>
                            <th>Date/Time Listed</th>
                            <th>Date/Time Delivered</th>
                    </tr>
                    </thead>

                    <?php
                            $dropdown_query2 = "SELECT 
                            transaction.id,
                            transaction.uuid,
                            customers.customer_name,
                            transaction.status_id,
                            transaction.total_amount,
                            transaction.created_at_date,
                            transaction.created_at_time,
                            delivery_list.updated_at,
                            employee.first_name,
                            employee.last_name
                            FROM transaction
                            INNER JOIN delivery_list
                            ON transaction.uuid = delivery_list.uuid
                            INNER JOIN employee
                            ON delivery_list.delivery_boy_id = employee.id
                            INNER JOIN payment_option
                            ON transaction.payment_option = payment_option.id
                            LEFT JOIN customers
                            ON transaction.customer_name_id = customers.id
                            WHERE transaction.service_type != 'Walk In'
                            AND transaction.uuid IN (SELECT uuid FROM delivery_list)
                            AND delivery_list.delivery_status = 3
                            ORDER BY transaction.created_at_time";
                        $result4 = mysqli_query($con, $dropdown_query2);
                        while ($rows = mysqli_fetch_assoc($result4))
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
                                <td> <a class="viewTransaction" href="../monitoring/monitoring-delivery-pickup-delivered.php?view=<?php echo $rows['uuid'];?>">View Details</a></td>
                                <td> <?php echo '<span>&#8369;</span>'.' '.number_format($rows['total_amount'], '2','.',','); ?></td> 
                                <td> 
                                    <?php 
                                    if($rows['status_id'] == 0){
                                        echo '<span class="outofstock">Unpaid</span>';
                                    }else{
                                        echo '<span class="instock">Paid</span>';
                                    } ?>
                                </td>
                                <td> <?php echo $rows['first_name'] .' '. $rows['last_name'] ; ?></td>
                                <td> <?php echo $rows['created_at_date'] .' '. $rows['created_at_time']; ?></td>
                                <td> <?php echo $rows['updated_at']?></td>
                            <tr id="noRecordTR" style="display:none">
                                <td colspan="7">No Record Found</td>
                            </tr>
                            </tbody>
                            <?php
                        }
                        ?>
                            </table>
                        </div>
            </main>
            <div class="top-menu">
                <div class="menu-bar">
                    <div class="menu-btn2">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h2 class="Title-top">MONITORING</h2>
                    <h4 class="subTitle-top">DELIVERY/PICK UP</h2>
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
                                <div class="user-type4">
                                    <?php
                                    $query = "SELECT 
                                    users.user_id,
                                    users.last_name,
                                    users.first_name,
                                    users.middle_name,
                                    users.email,
                                    users.contact_number, 
                                    users.profile_image, 
                                    account_type.user_type, 
                                    status_archive.status 
                                    FROM users 
                                    INNER JOIN account_type 
                                    ON users.account_type_id = account_type.id 
                                    INNER JOIN status_archive 
                                    ON users.status_archive_id = status_archive.id
                                    WHERE users.status_archive_id = '1'
                                    ORDER BY users.user_id";
                                    $result = mysqli_query($con, $query);
                                    if ($rows = mysqli_fetch_assoc($result))
                                    {
                                        ?>
                                    <a href="../accounts/account-view.php?view=<?php echo $_SESSION['user_user_id']; ?>" class="account">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.917 14.167q1.062-.875 2.364-1.313 1.302-.437 2.719-.437 1.417 0 2.719.437 1.302.438 2.385 1.313.688-.855 1.084-1.907.395-1.052.395-2.26 0-2.75-1.916-4.667Q12.75 3.417 10 3.417T5.333 5.333Q3.417 7.25 3.417 10q0 1.208.406 2.26.406 1.052 1.094 1.907ZM10 10.854q-1.229 0-2.073-.844-.844-.843-.844-2.072 0-1.23.844-2.073.844-.844 2.073-.844t2.073.844q.844.843.844 2.073 0 1.229-.844 2.072-.844.844-2.073.844Zm0 7.479q-1.729 0-3.25-.656t-2.646-1.781q-1.125-1.125-1.781-2.646-.656-1.521-.656-3.25t.656-3.25q.656-1.521 1.781-2.646T6.75 2.323q1.521-.656 3.25-.656t3.25.656q1.521.656 2.646 1.781t1.781 2.646q.656 1.521.656 3.25t-.656 3.25q-.656 1.521-1.781 2.646t-2.646 1.781q-1.521.656-3.25.656Zm.021-1.75q1.021 0 2-.312.979-.313 1.771-.896-.771-.604-1.75-.906-.98-.302-2.042-.302-1.062 0-2.031.302-.969.302-1.761.906.792.583 1.782.896.989.312 2.031.312ZM10 9.104q.521 0 .844-.323.323-.323.323-.843 0-.521-.323-.844-.323-.323-.844-.323-.521 0-.844.323-.323.323-.323.844 0 .52.323.843.323.323.844.323Zm0-1.166Zm0 7.437Z"/></svg>
                                        <h4>My Account</h4>
                                    </a>
                                <?php }?>

                                    <a href="../settings/settings-help.php" class="help">
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

        </div> 
        <?php
if(isset($_GET['view']))
{
    $uuid = $_GET['view'];
    $result = mysqli_query($con, "SELECT
                                customers.customer_name,
                                transaction.total_amount,                   
                                payment_option.option_name,
                                transaction.service_type,
                                transaction.created_at_date,
                                transaction.created_at_time
                                FROM transaction 
                                LEFT JOIN customers  
                                ON transaction.customer_name_id = customers.id 
                                LEFT JOIN payment_option  
                                ON transaction.payment_option = payment_option.id   
                                WHERE transaction.uuid='$uuid'");
    if (mysqli_num_rows($result) > 0) {
    $transaction = mysqli_fetch_assoc($result);
    ?>
    <form action="" method="post" enctype="multipart/form-data" id="placeorderFrm">
        <div class="bg-placeorderform" id="bg-placeform">
            <div class="container1">
                <a href="../monitoring/monitoring-point-of-sales-transaction.php" class="close">X</a>
                <h1 class="addnew-title">TRANSACTION DETAILS</h1>
                <?php
                    if (isset($_GET['message'])) {
                        echo '<p class="transaction_success"> '.$_GET['message'].' </p>';
                    }
                ?>
                <form action="#">
                    <div class="main-user-info">
                        <div class="customerName">
                            <label class="customernameLbl">Customer</label>
                            <span class="customer_name"><?php if($transaction['customer_name']){
                                    echo $transaction['customer_name'];
                                    }else{
                                        echo 'GUEST';
                                    }?></span>
                            <div class="datetimeLbl">
                                <label class="createdatLbl"><?= 'DATE :'.' '. $transaction['created_at_date'];?></label>
                                <label class="createdatLbl"><?=  'TIME :'.' '.$transaction['created_at_time'];?></label>
                            </div>
                        </div>
                         
                        <div class="payment-service">
                            <div class="payment-options1">
                                <p class="paymentOptions-text">Payment Option</p>
                                <label class="service-options"><?=$transaction['option_name'];?> </label>
                            </div>
                            <div class="payment-options2">
                                <p class="paymentOptions-text">Service</p>
                                <label class="service-options"><?=$transaction['service_type'];?> </label>
                            </div>
                        </div>
                 
                        <?php
                            }
                        ?>
                         <div class="orderSum-Details">
                            <table class="tableCheckout" id="sumTable">
                                <thead>
                                <tr>
                                    <th>ITEM</th>
                                    <th>Water</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>QTY</th>
                                    <th>TOTAL</th>
                                </tr>
                                </thead>
                                    <?php           
                                            $transaction_process = "SELECT
                                                    transaction_process.item_name, 
                                                    transaction_process.water_type,
                                                    transaction_process.category_type,
                                                    transaction_process.quantity,
                                                    transaction_process.price,
                                                    transaction_process.total_price
                                                    FROM transaction_process
                                                    WHERE transaction_id = '$uuid'";
                                            $transaction_order = mysqli_query($con, $transaction_process);
                                            if(mysqli_num_rows($transaction_order) > 0)
                                            {
                                            foreach($transaction_order as $transactions)
                                            {
                                            ?>

                                            <tbody>
                                            <tr>
                                                <td name="itemname_transaction"> <?php echo $transactions['item_name']; ?></td>
                                                <td name="watertype_transaction"> <?php echo $transactions['water_type']; ?></td>
                                                <td name="categorytype_transaction"> <?php echo $transactions['category_type']; ?></td>
                                                <td name="price_transaction"> <?php echo '&#8369'.' '. $transactions['price']; ?></td>
                                                <td class="quantity-td" > 
                                                    <?php echo $transactions['quantity'];?>
                                                </td>
                                                <td> <?php echo '&#8369'.' '. number_format($transactions['total_price'], '2','.',','); ?></td>
                                            </tr>
                                            <?php } ?>
                                            <?php } else { ?>
                                                <tr id="noRecordTR">
                                                    <td colspan="7">No Order(s) Added</td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        
                                      

                                            <tfoot>
                                           
                                            </tfoot>
                                            
                                </table>
                        </div>
                        <div class="totalamount-Details">
                            <table class="tableCheckout" id="sumTable">
                                <thead>
                                <tr>
                                    <th>Amount Tendered</th>
                                    <th>Change</th>
                                    <th>Previous Balance</th>
                                    <th>Remaining Balance</th>
                                    <th>Unpaid Amount</th>
                                    <th>Date Created</th>
                                </tr>
                                </thead>
                                    <?php           
                                            $transaction_history = "SELECT
                                                    transaction_history.amount_tendered, 
                                                    transaction_history.customer_change,
                                                    transaction_history.remaining_balance,
                                                    transaction_history.previous_balance,
                                                    transaction_history.unpaid_amount,
                                                    transaction_history.created_at
                                                    FROM transaction_history
                                                    WHERE transaction_uuid = '$uuid'";
                                            $transaction_order_history = mysqli_query($con, $transaction_history);
                                            if(mysqli_num_rows($transaction_order_history) > 0)
                                            {
                                            foreach($transaction_order_history as $transactions_history)
                                            {
                                            ?>

                                            <tbody>
                                            <tr>
                                                <td> <?php echo '&#8369'.' '.$transactions_history['amount_tendered']; ?></td>
                                                <td> <?php echo '&#8369'.' '.$transactions_history['customer_change']; ?></td>
                                                <td> <?php echo '&#8369'.' '.$transactions_history['previous_balance']; ?></td>
                                                <td> <?php echo '&#8369'.' '.$transactions_history['remaining_balance']; ?></td>
                                                <td> <?php echo '&#8369'.' '. $transactions_history['unpaid_amount']; ?></td>
                                                <td> <?php echo $transactions_history['created_at']; ?></td>
                                            </tr>
                                            <?php } ?>
                                            <?php } else { ?>
                                                <tr id="noRecordTR">
                                                    <td colspan="5">No Order(s) Added</td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        
                                      

                                            <tfoot>
                                           
                                            </tfoot>
                                            
                                </table>
                        </div>
                        <div class="payment-section">
                            <div class="user-input-box-totalamount">
                            <?php 
                                    $transaction_unpaid = "SELECT
                                    transaction_history.unpaid_amount
                                    FROM transaction_history
                                    WHERE transaction_uuid = '$uuid'
                                    ORDER BY transaction_history.created_at DESC
                                    LIMIT 1";
                                    $transaction_unpaid_history = mysqli_query($con, $transaction_unpaid);
                                    if(mysqli_num_rows($transaction_unpaid_history) > 0)
                                    {
                                        $unpaid_amount = mysqli_fetch_assoc($transaction_unpaid_history)['unpaid_amount'];
                                        $total_paid_amount = $transaction['total_amount'] - $unpaid_amount;
                                ?>
                                <label class="remaining-amountLbl">Remaining Unpaid Amount</label>
                                <span id="remaining-amount2" class="remaining-amount2"><?php echo '&#8369'.' '.number_format($unpaid_amount, '2','.',','); ?></span>
                            </div>
                            <div class="user-input-box-totalamount">
                         
                                <label for="total-amount2">TOTAL PAID AMOUNT</label>
                                <span id="total-amount2" class="total-amount2"><?php echo '&#8369'.' '.number_format($total_paid_amount, '2','.',','); ?></span>
                            </div>
                            
                        </div>
                        <?php } ?>
                        
                        <div class="line"></div>

                        <div class="bot-buttons">
                            <div class="AddButton1">
                                <button type="submit" id="addcustomerBtn" name="save-transaction" onclick="print();">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M15 6H5V3h10Zm-.25 4.5q.312 0 .531-.219.219-.219.219-.531 0-.312-.219-.531Q15.062 9 14.75 9q-.312 0-.531.219Q14 9.438 14 9.75q0 .312.219.531.219.219.531.219Zm-1.25 5v-3h-7v3ZM15 17H5v-3H2V9q0-.833.583-1.417Q3.167 7 4 7h12q.833 0 1.417.583Q18 8.167 18 9v5h-3Z"/></svg>
                                    PRINT
                                </button>
                            </div>
                            <input type="hidden" name="uuid" value="<?php echo $uuid?>">
                            <div class="AddButton2">
                                <button type="submit" id="addcustomerBtn" name="monitoring-pos-unpaid">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M2.5 16q-.625 0-1.062-.438Q1 15.125 1 14.5V6h1.5v8.5h14V16Zm3-3q-.625 0-1.062-.438Q4 12.125 4 11.5v-6q0-.604.438-1.052Q4.875 4 5.5 4h12q.604 0 1.052.448Q19 4.896 19 5.5v6q0 .625-.448 1.062Q18.104 13 17.5 13ZM7 11.5q0-.604-.448-1.052Q6.104 10 5.5 10v1.5Zm9 0h1.5V10q-.625 0-1.062.448Q16 10.896 16 11.5Zm-4.5-.5q1.042 0 1.771-.719Q14 9.562 14 8.5q0-1.042-.729-1.771Q12.542 6 11.5 6q-1.062 0-1.781.729Q9 7.458 9 8.5q0 1.062.719 1.781.719.719 1.781.719Zm-6-4q.604 0 1.052-.438Q7 6.125 7 5.5H5.5Zm12 0V5.5H16q0 .625.438 1.062Q16.875 7 17.5 7Z"/></svg>
                                PAYMENT
                                </button>
                            </div>
                        </div>
                        

                    </div>
                </form>
            </div>
        </div>
    </form> 
    <?php }?>

    </body>
</html>
<script>
    // -----------------------------SIDE MENU
    function addnewuser(){
    // const addBtn = document.querySelector(".add-customer");
const addForm = document.querySelector(".bg-addcustomerform");
    addForm.style.display = 'flex';
}
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
</script>
