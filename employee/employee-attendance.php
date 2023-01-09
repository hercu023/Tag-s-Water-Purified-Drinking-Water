<?php
require_once '../service/add-employee-attendance.php';
require_once "../service/user-access.php";
require_once '../service/payroll-attendance.php';

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'EMPLOYEE-ATTENDANCE')) {
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
    <!-- <link rel="stylesheet" type="text/css" href="../CSS/employee-attendance.css"> -->
    <link rel="stylesheet" type="text/css" href="../CSS/pagination.css">
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
#payroll-action{
    background: rgb(0, 154, 255);
    color: var(--color-white);
    align-items: center;
    text-align:center;
    justify-content: center;
    float: center;
    position: relative;
    text-decoration: none;
    border-radius: 3px;
    display: flex;
    font-family: 'Outfit', sans-serif;
    width: 100%;
    padding: 5px;
    margin: 5px;
    justify-content: center;
    margin: 1px;
    gap: .3rem;
    cursor: pointer;
    transition: 0.3s;
    border: none;
}
#payroll-action:hover{
    background: var(--color-main);
    color: var(--color-white);
}
.radio-button{
    position: relative;
    align-items: center;
    text-align: center;
    width: 100%;
    color:  var(--color-solid-gray);
    margin-top: 2rem;
    margin-bottom: 1rem;
}
.salary-category{
    margin: 15px 0;
    color:  var(--color-solid-gray);
    align-items: center;
    width: 100%;
    font-size: 20px;
    text-align: center;

    }
    .bg-addAttendanceForm{
        height: 100%;
        width: 100%;
        background: rgba(0,0,0,0.7);
        top: 0;
        position: fixed;
        display: none;
        align-items: center;
        justify-content: center;
        /* display: flex; */
    }
    .payroll{
        display: flex;
        border: none;
        background-color: var(--color-white);
        justify-content: center;
        align-items: center;
        color: var(--color-button);
        fill: var(--color-button);
        width: 10rem;
        max-height: 46px;
        font-size: .7rem;
        border-radius: 20px;
        font-family: 'Outfit', sans-serif;
        cursor: pointer;
        gap: 1rem;
        transition: all 300ms ease;
        position: relative;
        text-transform: uppercase;
    }
    
    .payroll:hover{
        background-color: var(--color-main);
        color: var(--color-white);
        fill: var(--color-white);
        padding-top: -.2px;
        transition: 0.7s;
        border-bottom: 4px solid var(--color-maroon);
    }
    .checkall{
        font-size: .7rem;
        display: inline-block;
        position: relative;
        margin-left: 1rem;
        
    }
    .checkall-checkbox{
        display: inline-block;
    }
    .checkall-label{
        font-family: 'Outfit', sans-serif;
        display: inline-block;
        gap: 8px;
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
.lowstock{
border-radius: 20px;
background-color: rgb(0, 154, 255);
color: #ffffff;
font-size: 10px;
padding: 7px;
font-weight: 700;
padding-right: 9px;
padding-left: 9px;
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
/* -------------------------------------------------------------------------------------------- */
.container1{
    width: 100%;
    overflow:auto;
    max-width: 600px;
    padding: 28px;
    margin: 0 28px;
    border-radius:  0px 0px 20px 20px;
    background-color: var(--color-white);
    box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
    border-top: 10px solid var(--color-solid-gray);
}
.tooltipText{
    font-family: Arial, Helvetica, sans-serif;
    font-size: .7rem;
    display: block;
    color: var(--color-white);
}
.edit-action{
    background: hsl(0, 0%, 37%);
    color: var(--color-white);
    align-items: center;
    text-align:center;
    justify-content: center;
    float: center;
    position: relative;
    text-decoration: none;
    border-radius: 3px;
    display: flex;
    width: 100%;
    padding: 5px;
    margin: 1px;
    gap: .3rem;
    cursor: pointer;
    transition: 0.3s;
    border: none;
}
.edit-action:hover{
    background: var(--color-main);
    color: var(--color-white);
}
.archive-action{
    background: hsl(0, 51%, 44%);
    color: var(--color-white);
    align-items: center;
    text-align:center;
    justify-content: center;
    float: center;
    position: relative;
    text-decoration: none;
    border-radius: 3px;
    display: flex;
    width: 100%;
    padding: 5px;
    margin: 5px;
    justify-content: center;
    margin: 1px;
    gap: .3rem;
    cursor: pointer;
    transition: 0.3s;
    border: none;
}
.archive-action:hover{
    background: var(--color-main);
    color: var(--color-white);
}
.cpass-action{
    background:#00aa09;
    color: var(--color-white);
    align-items: center;
    text-align:center;
    justify-content: center;
    float: center;
    left: 20%;
    position: relative;
    text-decoration: none;
    border-radius: 3px;
    display: flex;
    width: 60%;
    padding: 5px;
    margin: 5px;
    justify-content: center;
    margin: 1px;
    gap: .3rem;
    cursor: pointer;
    transition: 0.3s;
    border: none;
}
.cpass-action:hover{
    background: var(--color-main);
    color: var(--color-white);
}

.main-user-info{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 20px 0;
}
.usertype-dropdown{
    width: 48%;
    margin-top: 1.6rem;
    display: flex;
    flex-wrap: wrap;
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
.action-dropdown{
    position: relative;
    margin-top: .5rem;
    /* left: 10%; */
    margin-bottom: .5rem
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
    width: 48%;
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


.side-bar .menu #employee{
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

.bg-addcustomerform{
    height: 100%;
    width: 100%;
    background: rgba(0,0,0,0.7);
    top: 0;
    position: fixed;
    display: none;
    align-items: center;
    justify-content: center;
    /* display: flex; */
}
.bg-addAttendanceForm{
    height: 100%;
    width: 100%;
    background: rgba(0,0,0,0.7);
    top: 0;
    position: fixed;
    display: none;
    align-items: center;
    justify-content: center;
    /* display: flex; */
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

/* ----------------------------------------Search BAR---------------------------------------- */
.search{
    position: relative;
    gap: 2rem;
    float: right;
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
    margin-left: 1rem;
    position: relative;
    display: inline-block;
}
.newUser-button2{
    margin-left: 1rem;
    position: relative;
    display: inline-block;
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
    margin-bottom: 2rem;
    max-height: 650px;
    overflow:auto;
    width: 100%;
    /* position: absolute; */
    box-shadow: 0px 5px 30px 2px var(--color-table-shadow);
    border-top: 8px solid var(--color-table-hover);
    border-radius: 0px 0px 10px 10px;

}

main .account-container table{
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
.sub-tab{
        margin-bottom: 3rem;
    }
/* ----------------------------------------SIDEBAR 2---------------------------------------- */
@media screen and (max-width: 1600px){
    .container{
        width: 94%;
    }

    .top-menu{
        width: 370px;
    }
    .search-bar{
        width: 18vw;
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
        width: 13rem;
    }
}
@media screen and (max-width: 1200px){
    

  
    .tooltipText{
        display: none;
    }
    .checkall{
        width:6.5rem;
    }
    .add-account{
        width:10.5rem;
    }
    .payroll{
        width:8.5rem;
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
@media screen and (max-width: 968px){
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
        margin-left: 12rem;
        position: absolute;
    }
    .search button{
        position: absolute;
        float: right;
        right: 5%;
    }
    .search{
        position: relative;
        margin-top: 3rem;
        display: inline-block;
        width: 100%;  
    }
    .checkall{
        width: 100%;
        margin-top: .5rem;
        margin-bottom: -2.5rem;
        display: inline-block;
        
        position: relative;
    }
    .search{
       
    }
    .search-bar{
        text-align: center;
        width: 94%;
        margin-bottom: 2rem;
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
    .tooltipText{
        display: none;
    }
  
    .hrefa{
    height: 8rem;
    align-items: center;
    margin-top: 1rem;
    }
    .payroll-action{
        width: 3rem;
        text-align: center;
        float: left;
        position: relative;
        display: inline-block;
    }
    .account-container{
        position: relative;
        margin-top:7rem;
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
    .checkall{
        margin-left: -1rem;
    }
    .newUser-button{
        /* display: flex; */
        display: inline-block;
        width: 100%;  
        margin-left: -1rem;
        left: 0;
    }
    .add-account{
        margin-top: 1rem;
      
        width: 100%;
        justify-content: center;
    }
    .newUser-button2{
        /* display: flex; */
        display: inline-block;
        margin-left: -1rem;
        width: 100%;  
        left: 0;
    }
  
    .payroll{
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
    .AddButton button{
        margin-top: -4.5rem;
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
 @media screen and (max-width: 600px){
    .search{
        width: 95%;
    }


}
/*@media screen and (max-width: 500px){
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
    <div class="block"></div>

    <?php
    include('../common/side-menu.php')
    ?>

    <?php  
                if(isset($_GET['records']) && isset($_GET['page'])) {
                    $per_page_record = $_GET['records'];
                    $page = $_GET['page'];
                } else {
                    $per_page_record = 10;
                    $page = 1;
                }

                $query = "SELECT COUNT(*) FROM attendance 
                WHERE attendance.status_archive_id = 1";     
                $rs_result = mysqli_query($con, $query);     
                $row = mysqli_fetch_row($rs_result);     
                $total_records = $row[0];     
                $page_location = '../employee/employee-attendance.php';
                $start_from = ($page - 1) * $per_page_record;  
                    
            ?>
    <main>
        <div class="main-account">
            <h1 class="accTitle">EMPLOYEE</h1>
            <?php
            if (isset($_GET['error'])) {
                echo '<p id="myerror" class="error-error"> '.$_GET['error'].' </p>';
            }
            ?>
             <div class="sub-tab">
                <div class="user-title">
                    <h2> ATTENDANCE </h2>
                </div>
                <div class="sub-tab2">
                    <div class="newUser-button">
                        <button type="button" id="add-userbutton" class="add-account" onclick="addnewuser();">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 14h1.5v-3.25H14v-1.5h-3.25V6h-1.5v3.25H6v1.5h3.25Zm.75 4q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                            <h3>Add Attendance</h3>
                        </button>
                    </div>
                    <div class="newUser-button">
                        <button type="submit" id="add-payroll" class="payroll" onclick="selectRestore()">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M3.5 10h13V7h-13ZM16 18v-2.5h-2.5V14H16v-2.5h1.5V14H20v1.5h-2.5V18ZM3.5 16q-.604 0-1.052-.438Q2 15.125 2 14.5v-9q0-.625.448-1.062Q2.896 4 3.5 4h13q.604 0 1.052.438Q18 4.875 18 5.5V10h-2.188q-1.666 0-2.739 1.177T12 13.958V16Z"/></svg>
                            <h3>PAYROLL</h3>
                        </button>
                    </div>
                    <div class="checkall">
                        <input type="checkbox" onclick="selectAll()" id="checkall-checkbox" class="checkall-checkbox" name="checkall">
                        <h3 class="checkall-label">CHECK ALL</h3>
                    </div>
                </div>
                <div class="search">
                    <div class="search-bar">
                        <input text="text" placeholder="Search" onkeyup='tableSearch()' id="searchInput" name="searchInput"/>
                        <button type="submit" >
                            <svg id="search-icon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="m15.938 17-4.98-4.979q-.625.458-1.375.719Q8.833 13 8 13q-2.083 0-3.542-1.458Q3 10.083 3 8q0-2.083 1.458-3.542Q5.917 3 8 3q2.083 0 3.542 1.458Q13 5.917 13 8q0 .833-.26 1.583-.261.75-.719 1.375L17 15.938ZM8 11.5q1.458 0 2.479-1.021Q11.5 9.458 11.5 8q0-1.458-1.021-2.479Q9.458 4.5 8 4.5q-1.458 0-2.479 1.021Q4.5 6.542 4.5 8q0 1.458 1.021 2.479Q6.542 11.5 8 11.5Z"/></svg>
                        </button>
                    </div>
                </div>
            </div>
            <form action="" method="post" enctype="multipart/form-data">

            <div class="account-container">
                <table class="table" id="myTable">
                    <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">ID</th>
                                <th scope="col">Employee Name</th>
                                <th scope="col">Position</th>
                                <th scope="col">Whole Day</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time In</th>
                                <th scope="col">Time Out</th>
                                <th scope="col">Deduction</th>
                                <th scope="col">Bonus</th>
                                <th scope="col">Note</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Added By</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $attendance = "SELECT 
                        attendance.id,
                        attendance.whole_day,
                        attendance.date,
                        attendance.time_in,
                        attendance.time_out,
                        attendance.deduction,
                        attendance.bonus, 
                        attendance.note,
                        attendance.total_amount,
                        attendance.payroll_status, 
                        attendance.added_by,
                        employee.first_name as emp_first_name,
                        employee.last_name as emp_last_name,
                        employee.middle_name as emp_middle_name,
                        position_type.name as position_type,
                        users.first_name as usr_first_name,
                        users.last_name as usr_last_name
                        FROM attendance 
                        INNER JOIN employee 
                        ON attendance.employee_id = employee.id
                        INNER JOIN position_type
                        ON employee.position_id = position_type.id
                        INNER JOIN users
                        ON attendance.added_by = users.user_id
                        WHERE attendance.status_archive_id = 1
                        ORDER BY attendance.date DESC
                        LIMIT $start_from, $per_page_record";
                            $attendance_run = mysqli_query($con, $attendance);

                            if(mysqli_num_rows($attendance_run) > 0)
                            {
                                foreach($attendance_run as $rows)
                                {
                                    ?>
                                    <tr>
                                        <td  class="select-check"><input type="checkbox" name="select-check[]" id="<?php echo $rows['id']; ?>" value="<?php echo $rows['id']; ?>" ></td>
                                        <td data-label="ID"> <?php echo $rows['id']; ?></td>
                                        <td data-label="Employee Name"> <?php echo $rows['emp_first_name'].' '.$rows['emp_middle_name'].' '.$rows['emp_first_name'] ; ?></td>
                                        <td data-label="Position"> <?php echo $rows['position_type'] ; ?></td>
                                        <td data-label="Whole Day"> <?php  if ($rows['whole_day'] == 1) { echo '<span class="instock">YES</span>'; } else echo '<span class="lowstock">NO </span>'; ?></td>
                  
                                        <td data-label="Date"> <?php echo $rows['date']; ?></td>
                                        <td data-label="Time In"> <?php echo $rows['time_in']; ?></td>
                                        <td data-label="Time Out"> <?php echo $rows['time_out']; ?></td>
                                        <td data-label="Deduction"> <?php echo '<span>&#8369;</span>'.' '.$rows['deduction']; ?></td>
                                        <td data-label="Bonus"> <?php echo '<span>&#8369;</span>'.' '.$rows['bonus']; ?></td>
                                        <td data-label="Note"> <?php echo $rows['note']; ?></td>
                                        <td data-label="Total"> <?php echo '<span>&#8369;</span>'.' '.$rows['total_amount']; ?></td>
                                        <td data-label="Status"> 
                                        <?php 
                                            if($rows['payroll_status'] == 0){
                                                echo '<span class="outofstock">Unpaid</span>';
                                            }else{
                                                echo '<span class="instock">Paid</span>';
                                            } ?>
                                        </td>
                                        <td data-label="Added By"> <?php echo $rows['usr_first_name'].' '.$rows['usr_last_name']; ?></td>

                                        <td  class="hrefa">
                                            <a href="../employee/employee-attendance-edit.php?edit=<?php echo $rows['id']; ?>" id="edit-action" class="edit-action" name="action">
                                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.521 17.479v-2.437l4.562-4.563 2.438 2.438-4.563 4.562Zm-7-3.958v-2.459h7.271v2.459Zm14.583-1.188-2.437-2.437.666-.667q.355-.354.865-.364.51-.011.864.364l.709.709q.375.354.364.864-.01.51-.364.865ZM2.521 9.75V7.292h9.958V9.75Zm0-3.771V3.521h9.958v2.458Z"/></svg>
                                                <span id="tooltipText">EDIT</span>       
                                            </a>
                                            <a href="../employee/employee-attendance-archive.php?edit=<?php echo $rows['id']; ?>" id="archive-action" class="archive-action" name="action">
                                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.75 17.708Q3.708 17.708 3 17t-.708-1.75V5.375q0-.417.156-.833.156-.417.448-.709l1.125-1.104q.333-.291.76-.489t.844-.198h8.75q.417 0 .844.198t.76.489l1.125 1.104q.292.292.448.709.156.416.156.833v9.875q0 1.042-.708 1.75t-1.75.708Zm0-12.208h10.5l-1-1h-8.5ZM10 14.083l3.375-3.354-1.333-1.375-1.084 1.084V7.354H9.042v3.084L7.958 9.354l-1.333 1.375Z"/></svg>
                                                <span id="tooltipText">ARCHIVE</span>       
                                            </a>
                                            <a href="../employee/employee-attendance-payroll.php?edit=<?php echo $rows['id']; ?>" id="payroll-action" class="payroll-action" name="action">
                                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M3.5 10h13V7h-13ZM16 18v-2.5h-2.5V14H16v-2.5h1.5V14H20v1.5h-2.5V18ZM3.5 16q-.604 0-1.052-.438Q2 15.125 2 14.5v-9q0-.625.448-1.062Q2.896 4 3.5 4h13q.604 0 1.052.438Q18 4.875 18 5.5V10h-2.188q-1.666 0-2.739 1.177T12 13.958V16Z"/></svg>
                                                <span id="tooltipText">PAYROLL</span>       
                                            </a>
                                        </td>
                                    </tr>
                                    <?php }?>
                 
                 <?}else{ ?>
                         <tr class="noRecordTR" style="display:none">
                             <td colspan="9">No Record Found</td>
                         </tr>
                         <?php }?>
                        </tbody>
                </table>
            </div>

        </div>

        <div class="pagination">   
                <div class="page-navigation">
                    <div class="href-pages">   
                        <?php  

                            // Number of pages required.   
                            $total_pages = ceil($total_records / $per_page_record);     
                            $pageLink = "";       
                        
                            if($page>=2){   
                                echo "<a href='".$page_location."?page=".($page-1)."&records=".$per_page_record."'> Prev </a>";   
                            }       
                                    
                            for ($i=1; $i<=$total_pages; $i++) {   
                            if ($i == $page) {   
                                $pageLink .= "<a class = 'active' href='".$page_location."?page=".$i."&records=".$per_page_record."'>".$i." </a>";   
                            }               
                            else  {   
                                $pageLink .= "<a href='".$page_location."?page=".$i."&records=".$per_page_record."'>".$i." </a>";     
                            }   
                            }; 

                            echo $pageLink;   
                    
                            if($page<$total_pages){   
                                echo "<a href='".$page_location."?page=".($page + 1)."&records=".$per_page_record."'>  Next </a>";   
                            }  
                        ?>
                    </div>
                    <div class="dropdown-pages">   
                        <select name="option" class="pages" onchange="location ='<?php echo $page_location ?>' + '?page=1&records=' + this.value;">
                                <option value="5" <?php if($per_page_record == "5") { echo 'selected'; }?>>5</option>
                                <option value="10" <?php if($per_page_record == "10") { echo 'selected'; }?>>10</option>
                                <option value="50" <?php if($per_page_record == "50") { echo 'selected'; }?>>50</option>
                                <option value="100" <?php if($per_page_record == "100") { echo 'selected'; }?>>100</option>
                                <option value="250" <?php if($per_page_record == "250") { echo 'selected'; }?>>250</option>
                                <option value="500" <?php if($per_page_record == "500") { echo 'selected'; }?>>500</option>
                                <option value="1000" <?php if($per_page_record == "1000") { echo 'selected'; }?>>1000</option>
                        </select>
                        <span class="label-number"> No. of Records Per Page </span>  
                    </div>
                    
                    <div class="inline">   
                        <input id="page" type="number" class="input-pages" min="1" max="<?php echo $total_pages?>"   
                        placeholder="<?php echo $page." - ".$total_pages; ?>" required> 

                        <button class="gotopage-btn" onClick="goToPage('<?php echo $page_location.'?records='.$per_page_record?>');">Go to page</button>   
                    </div>    
                </div>
        </div>
            
    </main>

        <div class="top-menu">
                <div class="menu-bar">
                    <div class="menu-btn2">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h2 class="Title-top">EMPLOYEE</h2>
                    <h4 class="subTitle-top">Attendance</h2>
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
    <div class="bg-addcustomerform" id="bg-addform">
        <div class="container1">
            <h1 class="addnew-title">PROCESS PAYROLL</h1>
            <div class="a-header">
                <label class="archive-header"> Are you sure to process the payroll of selected rows?</label>
            </div>
            <div class="bot-buttons">
                <div class="CancelButton">
                    <a href="../employee/employee-attendance.php" id="cancel">CANCEL</a>
                </div>
                <div class="AddButton">
                    <button type="submit" id="addcustomerBtn" name="submit-payroll-attendance">PROCESS</button>
                </div>
            </div>
        </div>
    </div>
    </form>

    <form action="" method="post" enctype="multipart/form-data" id="addAttendanceForm">
        <div class="bg-addAttendanceForm" id="bg-addAttendanceForm">
            <div class="container1">
                <h1 class="addnew-title">ADD ATTENDANCE</h1>
                <form action="#">
                    <div class="main-user-info">
                        <div class="usertype-dropdown">
                            <?php
                            $dropdown_query = "SELECT * FROM employee";
                            $employee_result = mysqli_query($con, $dropdown_query);
                            ?>
                            <select class="select" name="employee_id" required="required" >
                                <option selected disabled value="">SELECT EMPLOYEE</option>
                                <?php while($employee = mysqli_fetch_array($employee_result)):;?>
                                    <option value="<?php echo $employee['id']?>">
                                        <?php echo $employee['first_name'].' '.$employee['middle_name'].' '.$employee['last_name'];?>
                                    </option>
                                <?php endwhile;?>
                            </select>
                        </div>
                        <div class="user-input-box">
                            <label for="dateofattendance">Date of Attendance</label>
                            <input type="date"
                                   class="date"
                                   id="dateofattendance"
                                   name="date_of_attendance"
                                   required="required"
                                   onchange="console.log(this.value);" />
                        </div>
                        <div class="user-input-box">
                            <label for="timein">Time In</label>
                            <input type="time"
                                   class="timein"
                                   id="timein"
                                   name="time_in"
                                   required="required"
                                   onchange="console.log(this.value);" />
                        </div>
                        <div class="user-input-box">
                            <label for="timeout">Time Out</label>
                            <input type="time"
                                   class="timeout"
                                   id="timeout"
                                   name="time_out"
                                   onchange="console.log(this.value);" />
                        </div>
                        <div class="user-input-box">
                            <label for="deduction">Deduction</label>
                            <input min='0' onchange='setTwoNumberDecimal' step="0.25"
                                   id="deduction"
                                   class="deduction"
                                   name="deduction"
                                   placeholder="0.00"/>
                        </div>
                        <div class="user-input-box">
                            <label for="additonalbonus">Addtional Bonus</label>
                            <input min='0' onchange='setTwoNumberDecimal' step="0.25"
                                   id="additonalbonus"
                                   class="additonalbonus"
                                   name="additional_bonus"
                                   placeholder="0.00"/>
                        </div>
                        <div class="user-input-box" id="note-box">
                            <label for="note">Note</label>
                            <input type="text"
                                   id="note" class="note" name="note" placeholder="Enter a Note"/>
                        </div>
                        <div class="radio-button">
                            <div class="salary-cateogory" >
                                <input type="radio" name="is_whole_day" id="Yes" value="Yes" required="required" checked="checked">
                                <label for="Yes">Whole Day</label>
                                <input type="radio" name="is_whole_day" id="No" value="No">
                                <label for="No">Half Day</label>
                            </div>
                        </div>

                        <div class="line"></div>

                        <div class="bot-buttons">
                            <div class="CancelButton">
                                <a href="../employee/employee-attendance.php" id="cancel">CANCEL</a>
                            </div>
                            <div class="AddButton">
                                <button type="submit" id="adduserBtn" name="add-employee-attendance">SAVE</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </form>
</body>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/settings-data-archive-check-all.js"></script>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/employee-attendance.js"></script>
<script src="../javascript/employee-attendance-search.js"></script>
<script src="../javascript/employee-attendance-forms.js"></script>
</html>
<script>
    
    // const addForm1 = document.querySelector(".bg-addAttendanceForm");
    function addnewuser(){
        document.querySelector(".bg-addAttendanceForm").style.display = 'flex';
    }
    function goToPage(reference) {   
    var page = document.getElementById("page").value;   
    page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
    window.location.href = reference + '&page=' + page;   
    } 
</script>
