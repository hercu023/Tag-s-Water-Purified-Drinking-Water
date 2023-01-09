<?php
session_start();
require_once '../database/connection-db.php';
require_once "../service/user-access.php";

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'SETTINGS-PAYROLL')) {
    header("Location: ../common/error-page.php?error=You are not authorized to access this page.");
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
    <!-- <link rel="stylesheet" type="text/css" href="../CSS/account.css"> -->
    <title>Tag's Water Purified Drinking Water</title>
</head>
<style>
    :root{
    --color-main: rgb(2, 80, 2);
    --color-main-2: rgb(2, 80, 2);
    --color-main-3: rgb(2, 80, 2);
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
    --color-mainbutton: rgb(117, 117, 117);
    --color-button-hover: rgb(39, 170, 63);
    --color-border-bottom: rgb(219, 219, 219);
}
.dark-theme{
    --color-white: rgb(48, 48, 48);
    --color-tertiary: hsl(0, 0%, 25%);
    --color-main-2: rgb(60, 128, 60);
    --color-main-3: rgb(93, 163, 93);
    --color-border-bottom: rgb(104, 104, 104);
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

body{
    background: var(--color-background);
    margin: 0;
    padding: 0;
    height: 100%;
    overflow-x: auto;
    font-family: Arial, Helvetica, sans-serif;
    background-position: center;
    background-size: cover;
    background-attachment: fixed;
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
/* -------------------------------------------------------------------------------------------- */
.container1{
    overflow:auto;
    padding: 20px;
    margin: 0 28px;
    border-radius:  20px;
    background-color: var(--color-white);
}

.main-user-info{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 20px 0;
}
.user-input-box:nth-child(2n){
    justify-content: end;
}

.checker {
    /* display: flex; */
    flex-wrap: wrap;
    width: 100%;
    padding-bottom: 15px;
    gap: 5px;
    margin-top: -1rem;
    text-align: right;
    align-items: right;
}
.checker span {
    text-decoration: none;
    color: var(--color-solid-gray);
    top: 0;
    font-size: min(max(10px, 1.2vw), 12px);
    font-family: 'Switzer', sans-serif;
}
.user-input-box{
    display: flex;
    flex-wrap: wrap;
    width: 40%;
    padding-bottom: 15px;
}

.user-input-box label{
    width: 100%;
    color: var(--color-solid-gray);
    font-size: 16px;
    /* margin-left: .2rem; */
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
    border: 2px solid var(--color-main-3);
    background: var(--color-white);
}

.user-input-box input{
    height: 40px;
    width: 100%;
    border: 2px solid var(--color-solid-gray);
    border-radius: 15px;
    outline: none;
    font-size: 1em;
    background: var(--color-white);
    color: var(--color-black);
    padding: 0 10px;
}
.line{
    width:100%;
    margin-top: 1rem;
    margin-bottom: 1rem;
    border-bottom: 2px solid var(--color-solid-gray);
}
.profile-picture1 h4{
    display: flex;
    position: relative;
    text-align: center;
    font-size: 1rem;
    font-family: 'Calibri', sans-serif;
    color: var(--color-solid-gray);
    width: 100%;
    border-bottom: 2px solid var(--color-solid-gray);
    /* margin-bottom: -5rem; */
}


.gender-title{
    /* margin-top: rem; */
    font-family: 'Calibri', sans-serif;
    color: var(--color-solid-gray);
    width: 100%;
    font-size: 20px;
    margin-left: .2rem;
    font-family: 'Malberg Trial', sans-serif;
    font-weight: 550;
    /* border-bottom: 2px solid var(--color-solid-gray); */
}

.gender-category{
    margin: 15px 0;
    color:  var(--color-solid-gray);
}

.gender-category label{
    padding: 0 20px 0 5px;
}

.gender-category label,
.gender-category input,
.form-submit-btn input{
    cursor: pointer;
}

.form-submit-btn{
    margin-top: 40px;
}

.form-submit-btn input{
    display: block;
    width: 100%;
    margin-top: 10px;
    font-size: 20px;
    padding: 10px;
    border:none;
    border-radius: 3px;
    color: rgb(209, 209, 209);
    background: rgba(63, 114, 76, 0.7);
}

.form-submit-btn input:hover{
    background: rgba(56, 204, 93, 0.7);
    color: rgb(255, 255, 255);
}
.addnew-title{
    font-size: 2rem;
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


.side-bar .menu #settings{
    background: var(--color-white);
    transition: 0.6s;
    color: var(--color-main);
    fill: var(--color-main);
    margin-left: 0;
    content: "";
    margin-bottom: 6px;
    font-size: 15px;
    border-radius: 0 0 10px 0 ;
    box-shadow: 1px 3px 1px var(--color-background);
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
    width: 30rem;
    max-height: 80px;
    outline: none;
    border: none;
    font-size: 1rem;
    border-radius: 20px;
    color: white;
    background:  var(--color-mainbutton);
    cursor: pointer;
    transition: 0.5s;
    margin-left: 1rem;
}
.AddButton button:hover{
    background: var(--color-button-hover);
}
.CancelButton{
    display: inline-block;
}
.AddButton{
    display: inline-block;

}

#cancel{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    padding-left: 80px;
    text-decoration: none;
    padding-right: 80px;
    text-align: center;
    width: 30rem;
    max-height: 70px;
    outline: none;
    border: none;
    font-size: min(max(9px, 1.1vw), 11px);
    border-radius: 20px;
    color: white;
    background: #c44242;
    cursor: pointer;
    transition: 0.5s;
}
#cancel:hover{
    background-color: rgb(158, 0, 0);
    transition: 0.5s;
}

.block{
    width: 5rem;
    height: 2rem;
    background-color: var(--color-background);
    position: fixed;
    display: flex;
    top: 0;
}
/* -----------------------------------------------Side Menu---------------------------------------- */

.bg-adduserform{
    height: 100%;
    width: 100%;
    top: 0;
    position: fixed;
    align-items: center;
    justify-content: center;
    display: flex;
}
.bg-editDropdown{
    height: 100%;
    width: 100%;
    background: rgba(0,0,0,0.7);
    top: 0;
    position: fixed;
    display: flex;
    align-items: center;
    justify-content: center;
    display: none;
}
#form-registered{
    position: absolute;
    top: 50%;
    display: none;
    left: 50%;
    max-height: 95vh;
    min-width: 400px;
    transform: translate(-50%, -50%);
    background-color: var(--color-white);
    border-top: 10px solid var(--color-main-3);
    box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
    border-radius:  0px 0px 20px 20px;

}
.pageform{
    background-color: var(--color-white);
    border-radius: 0px 0px 10px 10px;
    border-top: 2px solid var(--color-solid-gray);
    box-sizing: border-box;
    padding: 0 30px;
    display: flex;
}
#container-registered .pageform {
    font-size: 20px;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    text-align: center;
}
.register h2 {
    font-family: 'Calibri', sans-serif;
    font-size: 25px;
    align-items: center;
    text-align: center;
    letter-spacing: 2px;
    color: var(--color-black);
    margin-bottom: 5px;
}
.content .verify {
    left: 38.2%;
    padding-top: 1rem;
    margin-bottom: -.5rem;
    align-items: center;
    position: relative;

}
.verified {
    fill: rgb(39, 170, 63);
    width: 80px;
    height: 80px;
}
#registered{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    padding-left: 60px;
    padding-right: 60px;
    text-align: center;
    max-height: 70px;
    outline: none;
    border: none;
    font-size: min(max(9px, 1.1vw), 11px);
    border-radius: 20px;
    color: white;
    background: var(--color-mainbutton);
    cursor: pointer;
    transition: 0.5s;
    display: block;
    margin-top: 2vh;
    margin-bottom: 20px;
    margin-left: 65.5px;
    margin-right: 65.5px;
    width: 5rem;
}
#registered:hover{
    background-color: var(--color-button-hover);
    transition: 0.5s;
}
.form-adduser1{
    width: 500px;
    height: 100%;
    max-height: 480px;
    position: absolute;
    border-radius:  0px 0px 20px 20px;
    background-color: var(--color-white);
    box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
    border-top: 10px solid var(--color-solid-gray);
}
.edit-container{
    width: 500px;
    height: 100%;
    max-height: 520px;
    position: absolute;
    border-radius:  0px 0px 20px 20px;
    background-color: var(--color-white);
    box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
    border-top: 10px solid var(--color-solid-gray);
}
.edit-container2{
    display: flex;
    font-size: .7rem;
    flex-direction: column;
    font-family: 'Malberg Trial', sans-serif;
    gap: 30px;
    min-height: 20vh;
}
.edit-container .EditButton button{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    margin-top: .5vh;
    margin-bottom: 20px;
    margin-left: 20em;
    text-align: center;
    width: 15rem;
    max-height: 60px;
    outline: none;
    border: none;
    font-size: min(max(9px, 1.1vw), 11px);
    border-radius: 20px;
    color: white;
    background:  var(--color-mainbutton);
    cursor: pointer;
    transition: 0.5s;
}
.edit-container .EditButton button:hover{
    background: var(--color-button-hover);
}
.form-adduser2{
    display: flex;
    font-size: .7rem;
    flex-direction: column;
    font-family: 'Malberg Trial', sans-serif;
    gap: 30px;
    min-height: 20vh;
}
.error-error{
    background-color: hsl(0, 100%, 77%);
    color: #ffffff;
    display: relative;
    padding: 11px;
    width: 70%;
    border-radius: 6px;
    align-items: center;
    text-align: center;
    margin-left: 3.55rem;
    font-size: min(max(9px, 1.2vw), 11px);
    letter-spacing: 0.5px;
    font-family: Helvetica, sans-serif;
}
/* --------------------------------------DROP DOWN ACTION------------------------------------- */

.fa{
    font-family: "Font Awesome 5 Free", sans-serif;
    font-weight: 501;
    font-size: 14px;
}
.actionicon{
    fill:  var(--color-white);
}

/* --------------------------------------DROP DOWN------------------------------------- */



/* ------------------------------------------------------------------------------------ */
.message{
    background-color: hsl(0, 100%, 77%);
    color: #ffffff;
    border-radius: 6px;
    width: 25%;
    height: 1.87rem;
    /* margin-left: 3.55rem; */
    letter-spacing: 0.5px;
    font-family: Helvetica, sans-serif;
    top: 16.9%;
    font-size: .7rem;
    padding: 5px 10px;
    padding-top: 1rem;
    position: absolute;
    align-items: center;
    text-align: center;
    /* justify-content: space-between; */
    gap:3.5rem;
    z-index: 1000;
    display: none;
}

.message span{
    color:var(--white);
    font-size: .9rem;
}

.message p{
    color:var(--red);
    font-size: .9rem;
    margin: 0 auto;
    cursor: pointer;
}

.line{
    width:100%;
    margin-top: 1rem;
    margin-bottom: 1rem;
    border-bottom: 2px solid var(--color-solid-gray);
}
.profile-picture1 h4{
    display: flex;
    position: relative;
    text-align: center;
    font-size: 1rem;
    font-family: 'Calibri', sans-serif;
    color: var(--color-solid-gray);
    width: 100%;
    border-bottom: 2px solid var(--color-solid-gray);
    /* margin-bottom: -5rem; */
}

.choose-profile{
    /* position: relative; */
    width: 97%;
    height: 1.32rem;
    padding: 10px;
    margin-top: 1rem;
    background: var(--color-solid-gray);
    color: var(--color-white);
    border-radius: 10px;
    transition: 0.5s;
    font-family: 'COCOGOOSE', sans-serif;
    cursor: pointer;
}

#image-profile{
    cursor: pointer;
    text-align: center;
    align-items: center;
}
.choose-profile:hover{
    background: var(--color-main-2);
    transition: 0.5s;
}



.CloseButton{
    margin-top: 5.2vh;
    margin-left: 2.4em;
    margin-bottom: -2rem;
}



/* ----------------------------------------MAIN---------------------------------------- */
.main-account{
    width:100%;
    position: relative;
}
.accTitle{
     /* margin-top: 2rem; */
     font-size: min(max(1.9rem, 1.1vw), 2rem);
    color: var(--color-main); 
    border-bottom: 2px solid var(--color-main); 
    width: 78%;
    font-weight: 1000;
    margin-top: 3.2rem;
}
.sub-tab2{
    display: inline-block;
    /* margin-top: -2rem; */
    margin-left: 1rem;
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
    margin-bottom: 3rem;
}
/* ----------------------------------------Search BAR---------------------------------------- */
.search{
    position: absolute;
    gap: 2rem;
    align-items: right;
    text-align: right;
    right: 0;
    display: inline-block;
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
.newUser-button{
    position: absolute;
    display: inline-block;
    width: 100%;
    margin-top: -2rem;
}
.add-account{
    display: flex;
    border: none;
    background-color: var(--color-white);
    align-items: center;
    color: var(--color-button);
    fill: var(--color-button);
    width: 12rem;
    justify-content: center;
    max-height: 46px;
    border-radius: 20px;
    padding: .68rem 1rem;
    font-family: 'Outfit', sans-serif;
    cursor: pointer;
    gap: .5rem;
    transition: all 300ms ease;
    position: relative;
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
}
/* ----------------------------------------Account Table---------------------------------------- */
main .account-container{
    margin-top: -2rem;
    max-height: 650px;
    overflow:auto;
    width: 100%;
    /* position: absolute; */
    box-shadow: 0px 5px 30px 2px var(--color-table-shadow);
    background: var(--color-white);
    border-radius: 10px;

}

main .account-container table:hover{
    box-shadow: none;
    /* border-top: 8px solid var(--color-main); */
}

main table tbody td{
    height: 3.3rem;
    border-bottom: 1px solid var(--color-border-bottom);
    color: var(--color-td);
    font-size: .8rem;
}
th{
    height: 3.3rem;
    color: var(--color-black);
    margin:1rem;
    font-size: 1rem;
    letter-spacing: 0.02rem;
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

/* ----------------------------------------SIDEBAR 2---------------------------------------- */
@media screen and (max-width: 1600px){
    .container{
        width: 94%;
    }

    .top-menu{
        width: 370px;
    }

}
@media screen and (max-width: 1400px){
    .container{
        grid-template-columns: 2rem auto;
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

    main .account-container{
        width: 100%;
        margin-bottom: 2rem;
    }

    main .sub-tab{
        margin-bottom: 4rem;
    }
    .tooltipText{
        display: none;
    }
    .search-bar{
        width: 18vw;
    }
}
@media screen and (max-width: 1200px){
    
    .side-bar{
        z-index: 3;
        position: fixed;
        left: -100%;
    }
    .main-account{
        position: relative;
        width: 100%;
        /* margin-left: 2rem; */
    }
    .tooltipText{
        display: none;
    }

    .search{
        width: 100%;
    }
    .search-bar{
        width: 13rem;
        float: right;
    }
}

@media screen and (max-width: 1000px){
    .container{
        grid-template-columns: 1rem auto 2rem;
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
        margin-left: -.7rem;
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
        margin-left: 4rem;
        position: absolute;
    }
    .subTitle-top{
        display: block;
        left: 0;
        margin-left: 11rem;
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
        margin-top: 3rem;
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
    .user-title{
        display: none;
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
    .main-dashboard{
        position: relative;
        text-align: center;
        align-items: center;
    }
    .main-container{
        margin-left: -2.5rem;
        margin-top: 3rem;
        position: relative;
        width: 100%;
        align-items: center;
        background: none;
    }

    .sub-tab-container{
        width: 100%;
        text-align: left;
        align-items: center;
    }
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
    .edit-action{
        display: inline-block;
        position: relative;
        width: 3rem;
        float: left;
        text-align: center;
    }
    .archive-action{
        width: 3rem;
        position: relative;
        text-align: center;
        float: left;
        display: inline-block;
    }
    .cpass-action{
        width: 3rem;
        text-align: center;
        float: left;
        position: relative;
        display: inline-block;
    }
    .account-container{
        position: relative;
        overflow: auto;
        width: 100%;
        border-top: 5px solid var(--color-solid-gray);
        font-size: 15px;
    }

    .sub-tab{
        width: 100%;
        margin-top:8rem;
        align-items: center;
        text-align: center;
    }
    .newUser-button{
        /* display: flex; */
        display: inline-block;
        width: 100%;  
        left: 0;
    }
    .add-account{
        margin-top: 1rem;
      
        width: 100%;
        justify-content: center;
    }

    h3{
        display: block;
    }

    .user-input-box{
        margin-bottom: 12px;
        width: 100%;
        overflow: auto;
    }

    .user-input-box:nth-child(2n){
        justify-content: space-between;
    }
    .usertype-dropdown{
        width: 100%;
        margin-bottom: 1rem;
        margin-top: -.3rem;
    }
    .gender-category{
        display: flex;
        /* justify-content: space-between; */
        width: 100%;
    }

    .main-user-info{
        max-height: 680px;
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
    .AddButton button{
        width: 100%;
        text-align: center;
    }
    .AddButton button:hover{
        background: var(--color-button-hover);
    }
    .CancelButton{
        position: relative;
        margin-top: 3rem;
        width: 100%;
        /* padding-right: 2rem; */
    }
    .AddButton{
        position: relative;
        width: 100%;
    }

    #cancel{
        margin-left: 2.1rem;
        padding-left: 7.3vw;
        text-align: center;
        padding-right: 7.3vw;
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
}
#loading {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 100;
    width: 100%;
    height: 100%;
    background-color: rgba(192, 192, 192, 0.5);
    background-repeat: no-repeat;
    background-position: center;
    align-items: center;
}
.loader {
    border: 16px solid rgb(244, 255, 246); /* Light grey */
    border-top: 16px solid rgb(2, 80, 2); /* Blue */
    border-radius: 50%;
    width: 120px;
    text-align: center;
    left: 46%;
    display: none;
    z-index: 100;
    position: absolute;
    height: 120px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
/* @media screen and (max-width: 600px){
    .search{
        width: 100%;
    }


}
@media screen and (max-width: 500px){
    .search{
        width: 100%;
    }
    .search-bar{
        width: 95%;

    } 
} */
</style>
<body>
<div class="container">

    <?php
    include('../common/side-menu.php')
    ?>
    
    <main>
        <div class="main-account">
            <h1 class="accTitle">SETTINGS</h1>
            <?php
            if (isset($_GET['error'])) {
                echo '<p id="myerror" class="error-error"> '.$_GET['error'].' </p>';
            }
            ?>
            <div class="sub-tab">
                <div class="user-title">
                    <h2> PAYROLL </h2>
                </div>
            </div>
        <div class="account-container">
        <form action="" method="post" enctype="multipart/form-data" id="adduserFrm">
            <h1 class="addnew-title">SET PAYROLL SETTINGS</h1>
                <div class="container1">
                        <input type="hidden" required="required" name="status" value="1">
                        <div class="main-user-info">
                            <div class="user-input-box">
                                <label for="timein">Time IN Schedule</label>
                                <input type="text"
                                    id="timein"
                                    name="time_in"
                                    required="required"
                                    placeholder="Enter Time IN Schedule"/>
                            </div>
                            <div class="user-input-box">
                                <label for="graceperiod">Grace Period Time</label>
                                <input type="text"
                                    id="graceperiod"
                                    name="grace_period"
                                    required="required"
                                    placeholder="Enter Grace Period Time"/>
                            </div>
                            <div class="user-input-box">
                                <label for="deduction">Late Deduction Per Minute</label>
                                <input type="text"
                                    id="deduction"
                                    name="late_deduction"
                                    required="required"
                                    placeholder="Enter Late Deduction Per Minute"/>
                            </div>
                            <div class="user-input-box">
                                <label for="bonus">Over Time Bonus Per Hour</label>
                                <input type="text"
                                    id="bonus"
                                    name="ot_bonus"
                                    required="required"
                                    placeholder="Enter Over Time Bonus Per Hour"/>
                            </div>

                     
                            <div class="bot-buttons">
                                
                                <div class="AddButton">
                                    <button type="submit" id="adduserBtn" name="add-account">SAVE</button>
                                </div>
                            </div>
                </div>
        </form>
    </main>

        <div class="top-menu">
                <div class="menu-bar">
                    <div class="menu-btn2">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h2 class="Title-top">SETTINGS</h2>
                    <h4 class="subTitle-top">PAYROLL</h2>
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

</div>

</div>

</body>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/account.js"></script>
<script src="../javascript/account-search.js"></script>
<script src="../javascript/pagination.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/d3js/7.6.1/d3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
</html>
<script>

function addnewuser(){
    // const addForm = document.querySelector(".bg-adduserform");
    addForm.style.display = 'flex';
}

function goToPage(reference) {   
    var page = document.getElementById("page").value;   
    page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
    window.location.href = reference + '&page=' + page;   
} 
</script>