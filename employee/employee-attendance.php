<?php
require_once '../service/add-employee-attendance.php';
require_once "../service/user-access.php";

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
}
.dark-theme{
    --color-white: rgb(48, 48, 48);
    --color-tertiary: hsl(0, 0%, 25%);
    --color-main-2: rgb(60, 128, 60);
    --color-main-3: rgb(93, 163, 93);
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
    max-width: 600px;
    padding: 28px;
    margin: 0 28px;
    border-radius:  0px 0px 20px 20px;
    background-color: var(--color-white);
    box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
    border-top: 10px solid var(--color-solid-gray);
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
main .sub-tab{
    margin-bottom: 3rem;
}
.form-title{
    font-size: 26px;
    font-weight: 600;
    text-align: center;
    padding-bottom: 6px;
    color: white;
    text-shadow: 2px 2px 2px black;
    border-bottom: solid 1px white;
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
    height: 1.32rem;
    margin-bottom: 3rem;
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
    display: flex;
    flex-wrap: wrap;
    width: 48%;
    padding-bottom: 15px;
}
.date{
    font-family: 'Malberg Trial', sans-serif;
    background-color: var(--color-background);
    color: var(--color-solid-gray);
    font-size: .8em;
    border-radius: 5px;
    border: none;
    padding: 10px;
    cursor: pointer;
}

.date:hover{
    background-color: var(--color-solid-gray);
    transition: 0.4s;
    color: var(--color-white);
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
    padding-left: 90px;
    text-decoration: none;
    padding-right: 90px;
    text-align: center;
    width: 15rem;
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

@media(max-width: 600px){
    .container1{
        min-width: 280px;
    }
    .user-input-box .cost{
        position: absolute;
        display: none;
        left: 10.65%;
    }
    .user-input-box .srp{
        position: absolute;
        display: none;
        left: 10.65%;
    }
    .user-input-box{
        margin-bottom: 12px;
        width: 100%;
    }

    .user-input-box:nth-child(2n){
        justify-content: space-between;
    }
    .usertype-dropdown{
        width: 99%;
        margin-bottom: 1rem;
        margin-top: -.3rem;
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
        align-items: center;
        text-align: center;
        margin-top: -6rem;
    }
    .AddButton button:hover{
        background: var(--color-button-hover);

    }
    .CancelButton{
        position: relative;
        align-items: center;
        padding-top: 4rem;
        top: 50%;
    }
    #note-box{
        margin-bottom: 2rem;
    }
    .line{
        margin-bottom: 3rem;
    }
    .AddButton{
        position: relative;
        margin-top: -4rem;
        margin-left: -1em;

    }
    #cancel{
        width: 100rem;
    }

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
#employee{
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
/* -----------------------------------------Add Customer Form------------------------------------------ */
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
.bg-addcustomerform{
    height: 100%;
    width: 100%;
    background: rgba(0,0,0,0.7);
    top: 0;
    position: absolute;
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
.error-error{
    background-color: hsl(0, 100%, 77%);
    color: #ffffff;
    position: relative;
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
/* --------------------------------------DROP DOWN------------------------------------- */

.fa{
    font-family: "Font Awesome 5 Free", sans-serif;
    font-weight: 501;
    font-size: 14px;
}
.actionicon{
    fill:  var(--color-white);
}
#tooltipText{
    font-family: Arial, Helvetica, sans-serif;
    font-size: .7rem;
    color: var(--color-white);
}
a {
    text-decoration: none;
}
.edit-action{
    background: hsl(0, 0%, 37%);
    color: var(--color-white);
    fill: var(--color-white);
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
    fill: var(--color-white);
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
.payroll-action{
    background: rgb(0, 154, 255);
    color: var(--color-white);
    fill: var(--color-white);
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
.payroll-action:hover{
    background: var(--color-main);
    color: var(--color-white);
}

/* ------------------------------------------------------------------------------------ */
.message{
    background-color: hsl(0, 100%, 77%);
    color: #ffffff;
    position: absolute;
    width: 70%;
    display: none;
    max-height: 1rem;
    padding: 11px;
    border-radius: 6px;
    align-items: center;
    text-align: center;
    margin-left: 3.55rem;
    font-size: min(max(9px, 1.2vw), 11px);
    letter-spacing: 0.5px;
    font-family: Helvetica, sans-serif;
}


.profile-picture1 h4{
    display: flex;
    font-size: .9rem;
    position: relative;
    text-align: center;
    font-family: 'Calibri', sans-serif;
    color: var(--color-solid-gray);
    top: -10.5rem;
    margin-left: 2rem;
    width: 26.7rem;
    border-bottom: 2px solid var(--color-solid-gray);
    margin-bottom: -5rem;
}

/* ----------------------------------------MAIN---------------------------------------- */
.main-customer{
    width:100%;
    position: relative;
}
.accTitle{
    margin-top: 2rem;
    font-size: min(max(1.9rem, 1.1vw), 2rem);
    color: var(--color-main);
    font-family: 'COCOGOOSE', sans-serif;
    letter-spacing: .03rem;
    border-bottom: 2px solid var(--color-main);
    display: inline-block;
    width: 78%;
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

/* ----------------------------------------Search BAR---------------------------------------- */
.search{
    position: relative;
    gap: 2rem;
    float: right;
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

.payroll{
    display: flex;
    border: none;
    background-color: var(--color-white);
    align-items: center;
    color: var(--color-button);
    fill: var(--color-button);
    width: 8rem;
    position: relative;
    max-height: 46px;
    border-radius: 20px;
    padding: .68rem 1rem;
    font-family: 'Outfit', sans-serif;
    cursor: pointer;
    gap: 1rem;
    transition: all 300ms ease;
    text-transform: uppercase;
}
.payroll h3{
    font-size: .8rem;
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
    display: inline-block;
    position: relative;
    font-size: .7rem;
    flex-wrap: wrap;
}
.checkall-checkbox{
    display: inline-block;
}
.checkall-label{
    display: inline-block;
    gap: 8px;
}
.newUser-button{
    margin-left: 1rem;
    position: relative;
    display: inline-block;
}

.add-account{
    position: relative;
    border: none;
    background-color: var(--color-white);
    align-items: center;
    color: var(--color-button);
    fill: var(--color-button);
    width: 13rem;
    max-height: 46px;
    border-radius: 20px;
    padding: .68rem 1rem;
    display:flex;
    justify-content: center;
    font-family: 'Outfit', sans-serif;
    cursor: pointer;
    gap: 1rem;
    transition: all 300ms ease;
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
/* ----------------------------------------Customers Table---------------------------------------- */
.customer-container{
    margin-top: -1rem;
    max-height: 650px;
    overflow:auto;
    width: 100%;
    /* position: absolute; */
    box-shadow: 0px 5px 30px 2px var(--color-table-shadow);
    border-top: 8px solid var(--color-table-hover);
    border-radius: 0px 0px 10px 10px;

}
.customer-container table{
    background: var(--color-white);
    font-family: 'Switzer', sans-serif;
    width: 100%;
    font-size: 1rem;
    padding-left: 2.5rem;
    padding-right: 2.5rem;
    text-align: center;
    transition: all 700ms ease;
}
main .customer-container table:hover{
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

    .top-menu{
        width: 370px;
    }
    main .customer-container{
        margin-top: 6rem;
    }
    main  h2{
        margin-left: 10%;
    }
    main .sub-tab{
        margin-bottom: 4rem;
    }
}
@media screen and (max-width: 1400px){
    .container{
        width: 94%;
        grid-template-columns: 7.77rem auto;
    }

    .top-menu{
        width: 370px;
    }
    .main-customer{
        position: relative;
        left: -5%;
    }
    main .customer-container{
        width: 105%;
    }
    main  h2{
        margin-left: 10%;
    }
    main .sub-tab{
        margin-bottom: 4rem;
    }
    .newUser-button{
        left: 2.5%;
    }
    .search{
        right: -5%;
    }
    .search-bar{
        width: 18vw;
    }
}
@media screen and (max-width: 1200px){
    .container{
        width: 94%;
        grid-template-columns: 7.3rem auto;
    }
    .dashTitle{
        width: 74%;
    }
    .top-menu{
        width: 370px;
    }
    .main-customer{
        position: relative;
        left: -5%;
    }
    main  h2{
        margin-left: 10%;
    }
    main .sub-tab{
        margin-bottom: 4rem;
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
    .top-menu{
        width: 370px;
    }
    main .customer-container{
        margin-top: 6rem;
    }
    main  h2{
        margin-left: 10%;
    }
    main .sub-tab{
        margin-bottom: 4rem;
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
    .main-customer{
        position: relative;
        left: -5%;
    }
    main .customer-container{
        width: 105%;
    }
    main  h2{
        margin-left: 10%;
    }
    main .sub-tab{
        margin-bottom: 4rem;
    }
    .newUser-button{
        left: 2.5%;
    }
    .search{
        right: -5%;
    }
    .search-bar{
        width: 18vw;
    }
}
@media screen and (max-width: 1200px){
    .container{
        width: 94%;
        grid-template-columns: 4rem auto;
    }
    .dashTitle{
        width: 74%;
    }
    .top-menu{
        width: 370px;
    }
    .main-customer{
        position: relative;
        left: -5%;
    }
    main  h2{
        margin-left: 10%;
    }
    main .sub-tab{
        margin-bottom: 4rem;
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
    .top-menu .menu-bar .accTitle-top{
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
    .accTitle{
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
    .main-account{
        position: relative;
        left: -5%;
    }
    main .customer-container{
        margin: 2rem 0 0 8.8rem;
        width: 94%;
        position: absolute;
        display:none;
        left: 0;
        margin-left: 50%;
        transform: translateX(-50%);
        margin-top: 3%;
    }
    main .customer-container table{
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
/* .menu-tab a:hover{
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
} */
/* ----------------------------TOP MENU---------------------------- */
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
</style>
<body>

<div class="container">
   
    <?php
    include('../common/side-menu.php')
    ?>
    <main>
        <div class="main-dashboard">
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
            <div class="main-container">
                <div class="customer-container">
                    <form action="../service/payroll-attendance.php" method="post" id="frm">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Employee Name</th>
                                <th>Position</th>
                                <th>Whole Day</th>
                                <th>Date</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Deduction</th>
                                <th>Bonus</th>
                                <th>Note</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Added By</th>
                                <th>Action</th>
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
                        ORDER BY attendance.date DESC";
                            $attendance_run = mysqli_query($con, $attendance);

                            if(mysqli_num_rows($attendance_run) > 0)
                            {
                                foreach($attendance_run as $rows)
                                {
                                    ?>
                                    <tr>
                                        <td  class="select-check"><input type="checkbox" name="select-check[]" id="<?php echo $rows['id']; ?>" value="<?php echo $rows['id']; ?>" ></td>
                                        <td> <?php echo $rows['id']; ?></td>
                                        <td> <?php echo $rows['emp_first_name'].' '.$rows['emp_middle_name'].' '.$rows['emp_first_name'] ; ?></td>
                                        <td> <?php echo $rows['position_type'] ; ?></td>
                                        <td> <?php  if ($rows['whole_day'] == 1) { echo '<span class="instock">YES</span>'; } else echo '<span class="lowstock">NO </span>'; ?></td>
                  
                                        <td> <?php echo $rows['date']; ?></td>
                                        <td> <?php echo $rows['time_in']; ?></td>
                                        <td> <?php echo $rows['time_out']; ?></td>
                                        <td> <?php echo '<span>&#8369;</span>'.' '.$rows['deduction']; ?></td>
                                        <td> <?php echo '<span>&#8369;</span>'.' '.$rows['bonus']; ?></td>
                                        <td> <?php echo $rows['note']; ?></td>
                                        <td> <?php echo '<span>&#8369;</span>'.' '.$rows['total_amount']; ?></td>
                                        <td> 
                                        <?php 
                                            if($rows['payroll_status'] == 0){
                                                echo '<span class="outofstock">Unpaid</span>';
                                            }else{
                                                echo '<span class="instock">Paid</span>';
                                            } ?>
                                        </td>
                                        <td> <?php echo $rows['usr_first_name'].' '.$rows['usr_last_name']; ?></td>

                                        <td class="hrefa">
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
                                <?php } ?>
                            <?php } else { ?>
                                <tr id="noRecordTR">
                                    <td colspan="13">No Record(s) Found</td>
                                </tr>
                            <?php } ?>
                            </tbody>
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
                    <h2 class="Title-top">EMPLOYEE</h2>
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
                    <button type="submit" id="addcustomerBtn" name="submit-payroll-attendance[]">PROCESS</button>
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
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/employee-attendance.js"></script>
<script src="../javascript/settings-data-archive-check-all.js"></script>
</html>
<script>
    //Add New User
    setTimeout(function(){
        $("#myerror").fadeIn(400);
    }, 5000)
    function addnewuser(){
        document.querySelector(".bg-addAttendanceForm").style.display = 'flex';
    }
</script>
