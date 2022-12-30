<?php
require_once '../database/connection-db.php';
require_once "../service/user-access.php";
require_once "../service/save-weekly-schedule.php";
require_once "../service/save-date-schedule.php";

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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>
        <link rel='stylesheet' href='https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.css' />
        <script src='//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js'></script>
        <script src='//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.js'></script>
        <script src="../index.js"></script>
        <title>Tag's Water Purified Drinking Water</title>

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
        --color-mainbutton: rgb(117, 117, 117);
        --color-solid-gray: rgb(126, 126, 126);
        --color-td:rgb(100, 100, 100);
        --color-button: rgb(117, 117, 117);
        --color-table-shadow: rgb(244, 255, 246);
        --color-shadow-shadow: rgb(116, 116, 116);
        --color-table-hover: rgb(244, 255, 246);
        --color-aside-mobile-focus: rgb(78, 150, 78);
        --color-button-hover: rgb(39, 170, 63);
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
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        background-position: center;
        background-size: cover;
        background-attachment: fixed;
    }  
    /* --------------------------------toggle button-------------------- */
    .user-checkbox{
    flex-wrap: wrap;
    display: inline-block;
    width: 30%;
    padding-bottom: 15px;
}

.dateofattendance{
    width: 100%;
    color: var(--color-solid-gray);
    font-size: 16px;
    margin-right: 1rem;
    margin-bottom: 1rem;
    font-family: 'Malberg Trial', sans-serif;
    font-weight: 550;
    /* margin: 5px 0; */
}
    .user-checkbox input{
    height: 40px;
    border: 2px solid var(--color-solid-gray);
    border-radius: 10px;
    font-size: 1.5em;
    background: var(--color-white);
    color: var(--color-black);
    padding: 0 10px;
}
.monday{
    font-size: 13px;
    font-family: 'Malberg Trial', sans-serif;
    margin-left: .5rem;
    color: var(--color-solid-gray);
    display: inline-block;
}
    .switch {
    position: relative;
    display: inline-block;
    width: 33px;
    height: 18px;
    }

    .switch input { 
    opacity: 0;
    width: 0;
    height: 0;
    }

    .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
    }

    .slider:before {
    position: absolute;
    content: "";
    height: 10px;
    width: 10px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
    }

    input:checked + .slider {
    background-color: var(--color-main);
    }

    input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
    -webkit-transform: translateX(15px);
    -ms-transform: translateX(15px);
    transform: translateX(15px);
    }

    /* Rounded sliders */
    .slider.round {
    border-radius: 34px;
    }

    .slider.round:before {
    border-radius: 50%;
    }
    /* -------------------------------------------------------------------- */
    .statusLbl{
        font-weight: 1000;
        font-size: 1.5rem;
        text-transform: uppercase;
        border-bottom: 2px solid var(--color-main);
    }
    .hr{
        margin-top: 1rem;
        margin-bottom: 1rem;
    }
    .fc-event-container {
        position: relative;
        width: 100%;
        text-align: center;
    }
    .fc-event {
        border-radius: 0;
    }
    .fc-day-grid-event {
        margin: 0;
    }
    .main-user-info{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 20px 0;
}
.customerName{
    align-items:center;
    width: 100%;
    margin-top: -2rem;
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
    flex-wrap: wrap;
}
.select{
    background: var(--color-solid-gray);
    color: var(--color-white);
    align-items: center;
    border-radius: 13px;
    padding: 8px 12px;
    height: 40px;
    width: 96%;
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
    flex-wrap: wrap;
    text-align: center;
    justify-content: center;
    width: 96%;
    padding-bottom: 15px;
}

.user-input-box label{
    color: var(--color-solid-gray);
    font-size: 16px;
    margin-right: 1rem;
    border-bottom: 2px solid var(--color-main);
    margin-bottom: 1rem;
    padding-bottom: .4rem;
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
    height: 40px;
    width: 100%;
    border: 2px solid var(--color-solid-gray);
    display: inline-block;
    border-radius: 10px;
    text-align: left;
    align-items: left;
    font-size: 1.5em;
    background: var(--color-white);
    color: var(--color-solid-gray);
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
    width: 12rem;
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
/* .CloseButton{
    margin-top: 5.2vh;
    margin-left: 2.4em;
    margin-bottom: -2rem;
} */
#cancel{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    padding-left: 50px;
    padding-right: 50px;
    text-align: center;
    width: 10rem;
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
        margin-top: 1.3rem;
    }
    .AddButton button:hover{
        background: var(--color-button-hover);

    }
    .CancelButton{
        position: relative;
        align-items: center;
        /* padding-top: 4rem; */
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
    .actionicon{
    fill:  var(--color-white);
}
#edit-action{
    background: hsl(0, 0%, 37%);
    color: var(--color-white);
    align-items: center;
    position: relative;
    border-radius: 3px;
    height: 100%;
    width: 70%;
    margin: 1px;
    padding-top: 10px;
    padding-right: 2px;
    padding-left: 2px;
    cursor: pointer;
    transition: 0.3s;
    border: none;
}
#edit-action:hover{
    background: var(--color-main);
    color: var(--color-white);
}
#archive-action{
    background: hsl(0, 51%, 44%);
    color: var(--color-white);
    align-items: center;
    position: relative;
    margin: 1px;
    border-radius: 3px;
    height: 100%;
    width: 70%;
    padding-top: 10px;
    padding-right: 2px;
    padding-left: 5px;
    cursor: pointer;
    transition: 0.3s;
    border: none;
}
#archive-action:hover{
    background: var(--color-main);
    color: var(--color-white);
}
.newUser-button{
    display: inline-block;
}
    .add-customer1{
    display: flex;
    border: none;
    background-color: var(--color-white);
    align-items: center;
    color: var(--color-button);
    fill: var(--color-button);
    width: 12.8rem;
    max-height: 46px;
    border-radius: 20px;
    padding: .68rem 1rem;
    font-family: 'Outfit', sans-serif;
    cursor: pointer;
    gap: 1rem;
    position: relative;
    height: 3.9rem;
    transition: all 300ms ease;
    margin-left: 15rem;
    text-transform: uppercase;
}
.add-customer1 h3{
    font-size: .8rem;
}
.add-customer1:hover{
    background-color: var(--color-main);
    color: var(--color-white);
    fill: var(--color-white);
    padding-top: -.2px;
    transition: 0.7s;
    border-bottom: 4px solid var(--color-maroon);
}
.add-customer2{
    display: flex;
    border: none;
    background-color: var(--color-white);
    align-items: center;
    color: var(--color-button);
    fill: var(--color-button);
    margin-left: 1rem;
    width: 11.4rem;
    max-height: 46px;
    border-radius: 20px;
    padding: .68rem 1rem;
    font-family: 'Outfit', sans-serif;
    cursor: pointer;
    gap: 1rem;
    position: relative;
    height: 3.9rem;
    transition: all 300ms ease;
    text-transform: uppercase;
}
.add-customer2 h3{
    font-size: .8rem;
}
.add-customer2:hover{
    background-color: var(--color-main);
    color: var(--color-white);
    fill: var(--color-white);
    padding-top: -.2px;
    transition: 0.7s;
    border-bottom: 4px solid var(--color-maroon);
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
.container2{
    width: 100%;
    max-width: 450px;
    padding: 28px;
    margin: 0 28px;
    border-radius:  0px 0px 20px 20px;
    background-color: var(--color-white);
    box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
    border-top: 10px solid var(--color-solid-gray);
}
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
#form-registered1{
    position: absolute;
    top: 50%;
    display: none;
    left: 50%;
    max-height: 90vh;
    min-width: 400px;
    transform: translate(-50%, -50%);
    background-color: var(--color-white);
    border-top: 10px solid var(--color-main-3);
    box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
    border-radius:  0px 0px 20px 20px;
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
    height: 670px;
    overflow: auto;
    max-height: 670px;
    background: var(--color-white);
    width: 101%;
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
    margin-bottom:1.5rem;
}
.customer-container{
    /* margin-top: 2rem; */
    max-height: 550px;
    overflow:auto;
    background-color: var(--color-white);
    width: 101%;
    margin-bottom: 1rem;
    /* position: absolute; */
    box-shadow: 5px 5px 15px 0px var(--color-solid-gray);
    border-top: 2px solid var(--color-solid-gray);
    border-radius: 10px 10px 10px 10px;

}
.customer-container table{
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
tr:hover td{
    color: var(--color-main);
    cursor: pointer;
    background-color: var(--color-table-hover);
}
.select-dropdown{
    display: inline-block;
    margin-left: 1rem;
    position: relative;
    max-height: 50px;
}
.select{
    background-color: var(--color-solid-gray);
    color: var(--color-white);
    /* align-items: center; */
    border-radius: 5px;
    padding: .80rem 1rem;
    width: 20.8vw;
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
        margin-left: 3rem;
    }
    main  h2{
        margin-bottom: -2.2rem;
        position: relative;
        margin-top: 1rem;
        color: var(--color-solid-gray);
        font-size: 1.3rem;
        letter-spacing: .1rem;
        font-family: 'Galhau Display', sans-serif;
    }
    main .sub-tab{
        margin-bottom: 2rem;
        margin-top: 3rem;
    }
    /* ----------------------------------------Search BAR---------------------------------------- */
    .search{
        position: absolute;
        display: inline-block;
        gap: 2rem;
        right: 3%;
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
    .search::placeholder{
        color: var(--color-solid-gray);
        font-size: .8rem;
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
    .totals{
        display: inline-block;
        margin-left: 1rem;
        position: relative;
    }
    .newUser-button1{
        position: relative;
        margin-left: 3rem;
        display: inline-block;
    }
    .newUser-button2{
        margin-left: 1rem;
        position: relative;
        display: inline-block;
    }
    .add-account1{
        display: flex;
        border: none;
        background-color: var(--color-secondary-main); 
        align-items: center;
        color: var(--color-button); 
        fill: var(--color-button); 
        width: 20rem;
        text-align: center;
        justify-content: center;
        height: 3rem;
        border-radius: 10px;
        padding: .68rem 1rem;
        font-family: 'calibri', sans-serif;
        transition: all 300ms ease;
        position: relative; 
        text-transform: uppercase;
        border-left: 4px solid var(--color-solid-gray);
        border-right: 4px solid var(--color-solid-gray);
    }
    .add-account1 h3{
        font-size: 1rem;
        margin-right: 1.5rem;
    }
   
  
    .total-deliveries{
        font-family: 'ARIAL', sans-serif;
        color: var(--color-button); 
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
                            <h2>SCHEDULING</h2>
                        </div>
                        <div class="newUser-button">
                            <button type="button" id="add-userbutton" class="add-customer1" onclick="addnewuser1();">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M6.75 11.5q-.312 0-.531-.219Q6 11.062 6 10.75q0-.312.219-.531Q6.438 10 6.75 10q.312 0 .531.219.219.219.219.531 0 .312-.219.531-.219.219-.531.219Zm3.25 0q-.312 0-.531-.219-.219-.219-.219-.531 0-.312.219-.531Q9.688 10 10 10q.312 0 .531.219.219.219.219.531 0 .312-.219.531-.219.219-.531.219Zm3.25 0q-.312 0-.531-.219-.219-.219-.219-.531 0-.312.219-.531.219-.219.531-.219.312 0 .531.219.219.219.219.531 0 .312-.219.531-.219.219-.531.219ZM4.5 18q-.625 0-1.062-.448Q3 17.104 3 16.5v-11q0-.604.438-1.052Q3.875 4 4.5 4H6V2h1.5v2h5V2H14v2h1.5q.625 0 1.062.448Q17 4.896 17 5.5v11q0 .604-.438 1.052Q16.125 18 15.5 18Zm0-1.5h11V9h-11v7.5Z"/></svg>
                                <h3>WEEKLY SCHEDULE</h3>
                            </button>
                        </div>
                        <div class="newUser-button">
                            <button type="button" id="add-userbutton" class="add-customer2" onclick="addnewuser2();">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M12 15q-.833 0-1.417-.583Q10 13.833 10 13q0-.833.583-1.417Q11.167 11 12 11q.833 0 1.417.583Q14 12.167 14 13q0 .833-.583 1.417Q12.833 15 12 15Zm-7.5 3q-.625 0-1.062-.448Q3 17.104 3 16.5v-11q0-.604.438-1.052Q3.875 4 4.5 4H6V2h1.5v2h5V2H14v2h1.5q.625 0 1.062.448Q17 4.896 17 5.5v11q0 .604-.438 1.052Q16.125 18 15.5 18Zm0-1.5h11V9h-11v7.5Z"/></svg>
                                <h3>DATE SCHEDULE</h3>
                            </button>
                        </div>
                        <div class="newUser-button1"> 
                                <div id="add-userbutton" class="add-account1">
                                    <h3 class="deliveries">Today's Scheduled Delivery</h3>
                                    <span class="total-deliveries">0</span>
                                </div>
                            </div>
                    </div> 
                </div>
                    
                <div class="customer-container" id="customerTable">
                            <br>
                            <form method="POST" action="">
                                <div class="select-dropdown">
                                    <select name="option" class="select" onchange="this.form.submit()">
                                        <option selected disabled value="">SELECT DAY</option>
                                        <option value="ALL" <?php if(isset($_POST['option']) && $_POST['option'] == "ALL") { echo 'selected'; }?>>ALL</option>
                                        <option value="MONDAY" <?php if(isset($_POST['option']) && $_POST['option'] == "MONDAY") { echo 'selected'; }?>>MONDAY</option>
                                        <option value="TUESDAY" <?php if(isset($_POST['option']) && $_POST['option'] == "TUESDAY") { echo 'selected'; }?>>TUESDAY</option>
                                        <option value="WEDNESDAY" <?php if(isset($_POST['option']) && $_POST['option'] == "WEDNESDAY") { echo 'selected'; }?>>WEDNESDAY</option>
                                        <option value="THURSDAY" <?php if(isset($_POST['option']) && $_POST['option'] == "THURSDAY") { echo 'selected'; }?>>THURSDAY</option>
                                        <option value="FRIDAY" <?php if(isset($_POST['option']) && $_POST['option'] == "FRIDAY") { echo 'selected'; }?>>FRIDAY</option>
                                        <option value="SATURDAY" <?php if(isset($_POST['option']) && $_POST['option'] == "SATURDAY") { echo 'selected'; }?>>SATURDAY</option>
                                        <option value="SUNDAY" <?php if(isset($_POST['option']) && $_POST['option'] == "SUNDAY") { echo 'selected'; }?>>SUNDAY</option>
                                    </select>
                                </div>
                            </form>
         
                            <header class="previous-transaction-header">SCHEDULED DATE OF DELIVERY(DAY OF THE WEEK)</header>
                            <hr>
                            <table class="table" id="myTable">
                            <thead>
                            <tr>
                        <th><span class="statusLbl">DAY(s) of DELIVERY</span></th>
                        <th>Customer Name</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                    </tr>
                    </thead>

                    <?php

                    if(isset($_POST['option']) && $_POST['option'] != 'ALL') {
                       $day = $_POST['option'];
                       $query = "SELECT 
                            weekly_scheduling.day,
                            customers.customer_name,
                            customers.contact_number1,
                            customers.address, 
                            customers.balance
                            FROM customers
                            INNER JOIN weekly_scheduling
                            ON customers.id = weekly_scheduling.customer_id
                            WHERE weekly_scheduling.day = '$day'
                            AND customers.status_archive_id = 1";
                    
                    } else {
                        $query = "SELECT 
                        weekly_scheduling.day,
                        customers.customer_name,
                        customers.contact_number1,
                        customers.address, 
                        customers.balance
                        FROM customers
                        INNER JOIN weekly_scheduling
                        ON customers.id = weekly_scheduling.customer_id
                        WHERE customers.status_archive_id = 1";
                    }
                    
                    $result = mysqli_query($con, $query);
                    if(mysqli_num_rows($result) > 0)
                    {
                    foreach($result as $rows)
                    {
                    ?>
                    <tbody>
                    <tr>
                        <td> <?php echo $rows['day']; ?></td>
                        <td> <?php echo $rows['customer_name']; ?></td>
                        <td> <?php echo $rows['contact_number1']; ?></td>
                        <td> <?php echo $rows['address']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php } else { ?>
                        <tr id="noRecordTR">
                            <td colspan="15">No Record(s) Found</td>
                        </tr>
                    <?php } ?>
                            </tbody>
                            
                            </table>
                        </div>
                        <hr>
                        <div class="customer-container" id="customerTable">
                            <br>
                            
                            <header class="previous-transaction-header">SCHEDULED DATE OF DELIVERY</header>
                            <hr>
                            <table class="table" id="myTable">
                            <thead>
                            <tr>
                        <th><span class="statusLbl">DATE of DELIVERY</span></th>
                        <th>Customer Name</th>
                        <th>Contact Number</th>
                        <th>Address</th>
                        <th>Balance</th>
                    </tr>
                    </thead>

                    <?php
                    $query = "SELECT 
                            date_scheduling.date,
                            customers.id,
                            customers.customer_name,
                            customers.contact_number1,
                            customers.address, 
                            customers.balance
                            FROM customers
                            INNER JOIN date_scheduling
                            ON customers.id = date_scheduling.customer_id
                            WHERE customers.status_archive_id = 1
                            ORDER BY date_scheduling.date ASC";
                    $result = mysqli_query($con, $query);
                    if(mysqli_num_rows($result) > 0)
                    {
                    foreach($result as $rows)
                    {
                    ?>
                    <tbody>
                    <tr>
                        <td> <?php echo $rows['date']; ?></td>
                        <td> <?php echo $rows['customer_name']; ?></td>
                        <td> <?php echo $rows['contact_number1']; ?></td>
                        <td> <?php echo $rows['address']; ?></td>
                        <td> <?php echo '<span>&#8369;</span>'.' '.$rows['balance']; ?></td>
                    </tr>
                    <?php } ?>
                    <?php } else { ?>
                        <tr id="noRecordTR">
                            <td colspan="15">No Record(s) Found</td>
                        </tr>
                    <?php } ?>
                            </tbody>
                            
                            </table>
                        </div>
            </main>
            <?php
                include('../common/top-menu.php')
            ?>    
        </div> 
        
    <div class="bg-addcustomerform" id="bg-addform">
        <div class="container1">
        <form action="" method="post" enctype="multipart/form-data" id="addcustomerFrm">
            <h1 class="addnew-title">DATE SCHEDULE</h1>
            <form action="#">
                <div class="main-user-info">
                        <div class="customerName">
                                <label for="contact_num2">Customer Name</label>
                                <div class="usertype-dropdown">
                                    <?php
                                    $dropdown_customers = "SELECT * FROM customers";
                                    $result_customers = mysqli_query($con, $dropdown_customers);
                                    ?>
                                    <select id="chosen1" class="select-customer" name="customername" required="">
                                        <option selected disabled value="">SELECT CUSTOMER</option>
                                        <?php while($customers = mysqli_fetch_array($result_customers)){?>
                                            <option value="<?php echo $customers['id']?>">
                                                <?php echo $customers['customer_name'];?>                                        
                                            </option>
                                        <?php }?>
                                    </select>
                                </div>
                        </div>
                    <div class="user-input-box">
                        <label class="monday">DATE of Delivery</label>
                        <input type="date"
                               class="date"
                               id="dateofattendance"
                               name="date_schedule"
                               required="required"
                               onchange="console.log(this.value);" />
                    </div>
                    <div class="line"></div>

                    <div class="bot-buttons">
                        <div class="CancelButton">
                            <a href="../monitoring/monitoring-scheduling.php" id="cancel">CANCEL</a>
                        </div>
                        <div class="AddButton">
                            <button type="submit" id="addcustomerBtn" name="save-date-schedule">SAVE</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>            
            <div class="container2">
            <?php 
            $customer_id = 0;
            if(isset($_POST['customer_id'])) {
                    echo '<script type="text/JavaScript"> 
                    const addForm = document.querySelector(".bg-addcustomerform");
                    const container1 = document.querySelector(".container1");
                    const container2 = document.querySelector(".container2");

                    addForm.style.display = "flex";
                    container2.style.display = "block";
                    container1.style.display = "none";
                    </script>';
                    $customer_id = $_POST['customer_id'];
            }
            
            ?>
            <form action="" method="post" enctype="multipart/form-data" id="addcustomerFrm">
                <h1 class="addnew-title">WEEKLY SCHEDULE</h1>
                <form action="#">
                    <div class="main-user-info">
                            <div class="customerName">
                            <form method="POST" action="">
                                <label for="contact_num2">Customer Name</label>
                                <div class="usertype-dropdown">
                                    <?php
                                    $dropdown_customers = "SELECT * FROM customers";
                                    $result_customers = mysqli_query($con, $dropdown_customers);
                                    ?>
                                    <select id="chosen2" class="select-customer" name="customer_id" required="" onchange="this.form.submit()">
                                        <option selected disabled value="">SELECT CUSTOMER</option>
                                        <?php while($customers = mysqli_fetch_array($result_customers)){?>
                                            <option 
                                            <?php if(isset($_POST['customer_id']) && $customers['id'] == $_POST['customer_id']) echo 'selected'; ?>
                                            value="<?php echo $customers['id']?>">
                                                <?php echo $customers['customer_name'];?>                                        
                                            </option>
                                        <?php }?>
                                    </select>
                                </div>
                            </form>
                            </div>
                        <label class="dateofattendance">SELECT DAY(S)</label>
                        <?php 
                        $has_monday = false;
                        $has_tuesday = false;
                        $has_wednesday = false;
                        $has_thursday = false;
                        $has_friday = false;
                        $has_saturday = false;
                        $has_sunday = false;
                        if(isset($_POST['customer_id'])) {
                            $has_monday = has_day($con, 'MONDAY', $customer_id);
                            $has_tuesday = has_day($con, 'TUESDAY', $customer_id);
                            $has_wednesday = has_day($con, 'WEDNESDAY', $customer_id);
                            $has_thursday = has_day($con, 'THURSDAY', $customer_id);
                            $has_friday = has_day($con, 'FRIDAY', $customer_id);
                            $has_saturday = has_day($con, 'SATURDAY', $customer_id);
                            $has_sunday = has_day($con, 'SUNDAY', $customer_id);
                            echo '<input type="hidden" name="customername" value="'.$_POST['customer_id'].'">';
                        }
                        ?>

                        <div class="user-checkbox">
                            <label class="switch">
                                <input type="checkbox" name="monday" <?php if($has_monday) echo 'checked'?>>
                                <span class="slider round"></span>
                            </label>
                            <label class="monday">MONDAY</label>
                        </div>
                        <div class="user-checkbox">
                            <label class="switch">
                                <input type="checkbox" name="tuesday" <?php if($has_tuesday) echo 'checked'?>>
                                <span class="slider round"></span>
                            </label>
                            <label class="monday">TUESDAY</label>
                        </div>
                        <div class="user-checkbox">
                            <label class="switch">
                                <input type="checkbox" name="wednesday" <?php if($has_wednesday) echo 'checked'?>>
                                <span class="slider round"></span>
                            </label>
                            <label class="monday">WEDNESDAY</label>
                        </div>
                        <div class="user-checkbox">
                            <label class="switch">
                                <input type="checkbox" name="thursday" <?php if($has_thursday) echo 'checked'?>>
                                <span class="slider round"></span>
                            </label>
                            <label class="monday">THURSDAY</label>
                        </div>
                        <div class="user-checkbox">
                            <label class="switch">
                                <input type="checkbox" name="friday" <?php if($has_friday) echo 'checked'?>>
                                <span class="slider round"></span>
                            </label>
                            <label class="monday">FRIDAY</label>
                        </div>
                        <div class="user-checkbox">
                            <label class="switch">
                                <input type="checkbox" name="saturday" <?php if($has_saturday) echo 'checked'?>>
                                <span class="slider round"></span>
                            </label>
                            <label class="monday">SATURDAY</label>
                        </div>
                        <div class="user-checkbox">
                            <label class="switch">
                                <input type="checkbox" name="sunday" <?php if($has_sunday) echo 'checked'?>>
                                <span class="slider round"></span>
                            </label>
                            <label class="monday">SUNDAY</label>
                        </div>

                        <div class="line"></div>

                        <div class="bot-buttons">
                            <div class="CancelButton">
                                <a href="../monitoring/monitoring-scheduling.php" id="cancel">CANCEL</a>
                            </div>
                            <div class="AddButton">
                                <button type="submit" id="addcustomerBtn" name="save-weekly-schedule">SAVE</button>
                            </div>
                        </div>
                    </div>
            </div>     
        </form>
    </body>
</html>
<script>
    // ------------------------------SCHEDULING-----------------------------=
 
    // ///////////////////////////////////////////////////////////////////////
const addForm = document.querySelector(".bg-addcustomerform");
const container1 = document.querySelector(".container1");
const container2 = document.querySelector(".container2");
 function addnewuser1(){
    // const addBtn = document.querySelector(".add-customer");
    addForm.style.display = 'flex';
    container2.style.display = 'block';
    container1.style.display = 'none';
}
function addnewuser2(){
    // const addBtn = document.querySelector(".add-customer");
    addForm.style.display = 'flex';
    container2.style.display = 'none';
    container1.style.display = 'block';
}
new TomSelect("#chosen1",{
            create: false,
            sortField: {
            field: "text",
            direction: "asc"
        }
    });
    new TomSelect("#chosen2",{
            create: false,
            sortField: {
            field: "text",
            direction: "asc"
        }
    });
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
