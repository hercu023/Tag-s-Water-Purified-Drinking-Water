<?php
require_once '../database/connection-db.php';
require_once "../service/user-access.php";
require_once "../service/add-delivery.php";
require_once "../service/delete-transaction-order.php";

date_default_timezone_set("Asia/Manila");

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
        <!-- <link rel="stylesheet" type="text/css" href="../TAG-S-WATER-PURIFIED-DRINKING-WATER/CSS/Dashboard.css"> -->
        <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
        <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
        <link href="http://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
           <link href="http://fonts.cdnfonts.com/css/galhau-display" rel="stylesheet">
        <link href="http://fonts.cdnfonts.com/css/malberg-trial" rel="stylesheet">
        <title>Tag's Water Purified Drinking Water</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>
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
        --color-blue-button: rgb(62, 178, 255);
        
    }
    .dark-theme{
        --color-white: rgb(48, 48, 48);
        --color-tertiary: hsl(0, 0%, 25%);
        --color-black: white;
        --color-blue-button: rgb(164, 219, 255);
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
    .td-input{
        border: none;
        background: none;
        color: var(--color-td);
        font-size: .67rem;
    }
    .dateandtime{
        position: relative;
        justify-content: center;
        width: 100%;
        align-items: center;
        text-align: center;
        margin-left: 1rem;
        display: inline-block;
    }
    .card-live {
        display: inline-block;
        border-radius: 0.1rem;
        height: 1rem;
        margin-left: .5rem;
        border: transparent;
        font-family: 'Rajdhani', sans-serif;

    }
    .time{
        /* background-color: var(--color-black); */
        color: var(--color-solid-gray);
        font-size: .8rem;
        font-weight: 500;
        text-align: center;
        display: inline-block;
    }
    .date-Text{
        font-weight: 900;
        font-size: 13px;
        /* margin-left: 2rem; */
        /* margin-top:1.7rem; */
        color: var(--color-black);
        display: inline-block;
        text-align: center;
        position: relative;
    }
    .date-live {
        color: var(--color-solid-gray);
        text-align: center;
        font-size: .8rem;
        font-weight: 500;
        display: inline-block;
    }

    .dash{
        display: inline-block;
        color: var(--color-tertiary);
    }
    .nameTd{
        font-size: .9rem;
        font-family: 'Century Gothic', sans-serif;
        color: var(--color-solid-gray);
        float: left;
        border-left: 1px solid var(--color-solid-gray);
        padding-left: 1rem;
    }
    .th-name{
        height: 2rem;
    }
    .td-name{
        font-size: 1.2rem;
        height: 2rem;
        font-weight: 600;
        font-family: 'arial', sans-serif;
        color: var(--color-main);
    }
    .form3{
    /* margin-top: -39rem; */
    width: 100%;
    max-height: 10%;
    margin-bottom: 1rem;
    /* display: inline-block;
    position: relative; */
}
.todeliver-transaction{
    background-color: var(--color-white);
    padding-left: 2rem;
    padding-right: 2rem;
    width: 97%;
    max-height: 20%;
    border-color: var(--color-table-border);
    /* position: relative; */
    overflow:auto;
    border-top: 8px solid var(--color-table-hover);
    border-radius: 0px 0px 20px 20px;
}
.todeliver-transaction-header{
    color: var(--color-black);
    font-weight: bold;
    font-size: 1rem;
    text-align: center;
    margin-left: 1rem;
    text-transform: uppercase;
    font-family: 'COCOGOOSE', sans-serif;
    letter-spacing: 1px;
    /* margin-bottom:1.5rem; */
}

.todeliver-transaction-table th{
    height: 4rem;
    /* padding: 1rem; */
    color: var(--color-black);
    /* margin:1rem; */
    font-size: .8rem;
    letter-spacing: 0.02rem;
    border: none;
}
table{
    background: var(--color-white);
    font-family: 'Switzer', sans-serif;
    width: 100%;
    font-size: 0.8rem;
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
    height: 2.8rem;
    border-bottom: 1px solid var(--color-solid-gray);
    color: var(--color-td);
    font-size: .67rem;
}
    .receipt-buttons{
    text-align: center;
    margin-top: 1.3rem;
    justify-content: center;
    align-items: center;
}

.confirmOrder-button{
    font-family: 'COCOGOOSE', sans-serif;
    gap: 1rem;
    padding: 10px;
    display: flex;
    /* padding-bottom: -70px; */
    text-align: center;
    justify-content: center;
    outline: none;
    color: var(--color-white);
    fill: var(--color-white);
    cursor: pointer;
    transition: 0.5s;
    background: var(--color-solid-gray);
    border-radius:  .5rem .5rem 0rem 0rem;
    font-size: .8rem;
    border: none;
    position: relative;
    width: 100%;
    text-transform: uppercase;

}
.confirmOrder-button:hover{
    filter: brightness(120%);
    background: var(--color-tertiary);
    transition: 0.5s;
}
.confirmOrder-button2{
    font-family: 'COCOGOOSE', sans-serif;
    gap: 1rem;
    padding: 10px;
    display: flex;
    /* padding-bottom: -70px; */
    text-align: center;
    justify-content: center;
    outline: none;
    color: var(--color-white);
    fill: var(--color-white);
    cursor: pointer;
    transition: 0.5s;
    background: var(--color-main);
    font-size: .8rem;
    border: none;
    position: relative;
    width: 100%;
    text-transform: uppercase;

}
.confirmOrder-button2:hover{
    filter: brightness(120%);
    background: var(--color-tertiary);
    transition: 0.5s;
}
.totaldelivery1{
    /* align-items: left; */
    float: left;
    display: inline-block;
    margin-left: 1rem;
    /* margin-bottom: */
}
.total-amount{
    float: right;
    display: inline-block;
    /* margin-right: 1rem; */
}
#totalAmount_order{
    background-color: var(--color-total-amount);
    /* padding-left: 20px;*/
    margin-right: 20px; 
    text-align: center;
    border-radius: 1rem;
    width: 10rem;
    font-family: 'century-gothic', sans-serif;
    font-size: 1.5rem;
    color: var(--color-black);
}

#total_order1{
    /* background-color: #FFCFCF; */
    /* padding-left: 20px; */
    padding-right: 20px;
    font-size:1.5rem;
    font-family: 'century-gothic', sans-serif;
    color: var(--color-black);
}
.totalAmount-text{
    color: var(--color-black);
    font-weight: bolder;
    font-size: 1rem;    
    margin-top: 1rem;
    margin-left: 1rem;
    font-size: 1rem;
    display: inline-block;
}
.delete-rowsButton{
    border: none;
    background-color: var(--color-maroon);
    color: var(--color-white);
    /* align-items: center; */
    fill: var(--color-white);
    gap: .5rem;
    padding:5px;
    
    font-size: 15px;
    font-weight: 500;
    border-radius: 5px;
    font-family: 'calibri', sans-serif;
    cursor: pointer;
}
.delete-rowsButton:hover{
    filter: brightness(1.8);
    transition: 0.2s;
    /* border-bottom: 5px solid var(--color-tertiary); */
}
    .status3{
        font-weight: 800;
        font-size: .8rem;
        margin-bottom: .5rem;
        padding: .3rem 1rem;
        background-color: var(--color-main);
        color: var(--color-secondary-main);
        font-family: 'outfit', sans-serif;
        text-transform: uppercase;
        border-radius: 3rem;
        cursor: pointer;
        border: none;
    }
    .status3:hover{
        background-color: var(--color-solid-gray);
        color: var(--color-secondary-main);
        border-bottom: 5px solid var(--color-main);
        transition: 0.3s;
    }
    .status2{
        font-weight: 800;
        font-size: .8rem;
        margin-bottom: .5rem;
        padding: .3rem 1rem;
        background-color: yellow;
        color: var(--color-solid-gray);
        font-family: 'outfit', sans-serif;
        text-transform: uppercase;
        border-radius: 3rem;
        cursor: pointer;
        border: none;
    }
    .status2:hover{
        background-color: var(--color-solid-gray);
        color: var(--color-secondary-main);
        border-bottom: 5px solid var(--color-main);
        transition: 0.3s;
    }
    .status1{
        font-weight: 800;
        font-size: .8rem;
        padding: .3rem 1rem;
        background-color: #87CEFA;
        color: var(--color-secondary-main);
        font-family: 'outfit', sans-serif;
        text-transform: uppercase;
        border-radius: 3rem;
        cursor: pointer;
    }
    .status1:hover{
        background-color: var(--color-solid-gray);
        color: var(--color-secondary-main);
        border-bottom: 5px solid #87CEFA;
        transition: 0.3s;
    }
    .statusLbl{
        font-weight: 1000;
        font-size: 1.8rem;
        text-transform: uppercase;
        border-bottom: 2px solid var(--color-main);
    }
    .card {
    display: inline-block;
    /* padding-bottom: 1rem; */
    /* padding-bottom: 1.6rem; */
    /* box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15), 0 3px 6px rgba(0, 0, 0, 0.2); */
    border-radius: 0.1rem;
    height: 1rem;
    float: right;
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
    font-weight: 900;
    display: inline-block;
    text-transform: uppercase;
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
    .add-customer{
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
    position: absolute;
    height: 3.9rem;
    transition: all 300ms ease;
    margin-top: .2rem;
    margin-left: 18rem;
    text-transform: uppercase;
}
.add-customer h3{
    font-size: .8rem;
}
.add-customer:hover{
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
    /* height: 600px; */
    background: var(--color-white);
    margin-top: 5rem;
    width: 101%;
    border-radius: 10px 10px 10px 10px;
    margin-bottom: 2rem;
    position: relative;
}
.sub-tab-container{
    padding: 1.8rem;
}
.delivery-container{
    height: 600px;
    border-top: 2px solid var(--color-solid-gray);
    width: 28.3%;
    margin-left: 1rem;
    overflow: auto;
    background-color: var(--color-white);
    box-shadow: 5px 5px 15px 0px var(--color-solid-gray);
    border-radius: 10px 10px 10px 10px;
    display: inline-block;
    position: absolute;
}
.delivery-details{
    position: relative;
    width: 100%;
    margin-top: 2rem;
    text-align: center; 
}
.deliveryboys{
    width: 100%;
    text-align: center;
    position: relative;
}
.deliveryLbl{
    width: 100%;
    margin-bottom: 3rem;
    position: relative;
    text-align: center;
}
.deliveryID{
    position: relative;
    display: inline-block;
}
.delivery-section1 h3{
    position: relative;
    display: inline-block;
}
.delivery-section2 h3{
    position: relative;
    display: inline-block;
}
.delivery-section1{
    position: relative;
    display: inline-block;
}
.delivery-section2{
    position: relative;
    display: inline-block;
}
.deliverysection1-label{
    display: inline-block;
    margin-left: 1rem;
}
.deliverysection2-label{
    display: inline-block;
    margin-right: 1rem;
    float: right;
}
.delivery1{
    display: inline-block;
    position: relative;
}
.delivery1 h3{
    display: inline-block;
    position: relative;
}
.deliveryID1{
    display: inline-block;
    position: relative;
    font-family: 'calibri', sans-serif;
    color: var(--color-solid-gray);
    font-size: 1rem;
    margin-right: 6rem;
}
.delivery2{
    position: relative;
    display: inline-block;
}
.delivery2 h3{
    display: inline-block;
    position: relative;
}
.deliveryID2{
    display: inline-block;
    position: relative; 
    font-family: 'calibri', sans-serif;
    color: var(--color-solid-gray);
    font-size: 1rem;
}
.delivery3{
    position: relative;
    display: inline-block;
}
.delivery3 h3{
    display: inline-block;
    position: relative;
}
.deliveryID3{
    display: inline-block;
    position: relative;
    font-family: 'calibri', sans-serif;
    color: var(--color-solid-gray);
    font-size: 1rem;
}
.deliverylist-table{
        background-color: var(--color-white);
        padding: 1rem;
        height: 20rem;
        max-height: 20rem;
        overflow: auto;
        margin-top: 1rem;
        border-top: 1px solid var(--color-solid-gray);
        position: relative;
    }
.createDelivery{
    margin-left: 2rem;   
    margin-right: 2rem;   
    float: right;
    position: relative;
    display: inline-block;
    }
.createDelivery-button{
    width: 100%;
    display: flex;
    gap: 1rem;
    height: 5rem;
    font-family: 'outline', sans-serif;
    font-size: 1.3rem;
    text-transform: uppercase;
    font-weight: 700;
    border-radius: 15px;
    border: none;
    align-items: center;
    justify-content: center;
    box-shadow: 2px 2px 5px 0px var(--color-solid-gray);
    cursor: pointer;
    color: var(--color-white);
    fill: var(--color-white);
    background-color: var(--color-blue-button);
}
.createDelivery-button:hover{
    background-color: var(--color-solid-gray);
    border: 5px solid var(--color-blue-button);
    transition: 0.3s;
}
.pickup{
    margin-left: 2rem;   
    margin-right: 2rem;   
    float: right;
    position: relative;
    display: inline-block;
    }
.pickup-button{
    width: 100%;
    display: flex;
    gap: 1rem;
    height: 5rem;
    font-family: 'outline', sans-serif;
    font-size: 1.3rem;
    text-transform: uppercase;
    font-weight: 700;
    border-radius: 15px;
    border: none;
    text-align: center;
    align-items: center;
    justify-content: center;
    box-shadow: 2px 2px 5px 0px var(--color-solid-gray);
    cursor: pointer;
    color: var(--color-white);
    fill: var(--color-white);
    background-color: var(--color-blue-button);
}
.pickup-button:hover{
    background-color: var(--color-solid-gray);
    border: 5px solid var(--color-blue-button);
    transition: 0.3s;
}
.pickuplist{
        display: flex;
        border: none;
        background-color: var(--color-solid-gray); 
        align-items: center;
        color: var(--color-secondary-main); 
        fill: var(--color-secondary-main); 
        width: 9rem;
        padding:.7rem;
        padding-left:1.7rem;
        text-align: center;
        justify-content: center;
        height: 1.7rem;
        gap: 1rem;
        font-weight: 700;
        border-radius: 20px;
        font-family: 'ARIAL', sans-serif;
        transition: all 300ms ease;
        position: relative; 
        margin-top: .2rem;
        text-transform: uppercase;
        cursor: pointer;
    }
    .pickuplist h3{
        font-size: .8rem;
        margin-right: 1.5rem;
    }
    .pickuplist:hover{
        background-color: #8FBC8F;
        color: white;
        fill: white;
    }
    .batchlist{
        display: flex;
        border: none;
        background-color: var(--color-solid-gray); 
        align-items: center;
        color: var(--color-secondary-main); 
        fill: var(--color-secondary-main); 
        width: 16rem;
        padding:.7rem;
        padding-left:1.7rem;
        text-align: center;
        justify-content: center;
        height: 1.7rem;
        gap: 1rem;
        font-weight: 700;
        border-radius: 20px;
        font-family: 'ARIAL', sans-serif;
        transition: all 300ms ease;
        position: relative; 
        margin-top: .2rem;
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
.customer-container{
    /* margin-top: 2rem; */
    height: 600px;
    overflow:auto;
    background-color: var(--color-white);
    width: 65%;
    margin-bottom: 1rem;
    /* position: absolute; */
    box-shadow: 5px 5px 15px 0px var(--color-solid-gray);
    border-top: 2px solid var(--color-solid-gray);
    position: relative;
    display: inline-block;
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

.deliveryboys h4{
    display: inline-block;
    margin-right: 1rem;
}
.select-dropdown{
    display: inline-block;
    margin-right: 23%;
    position: relative;
    float: right;
}
.select{
    background-color: var(--color-white);
    color: var(--color-solid-gray);
    /* align-items: center; */
    border-radius: 5px;
    padding: .80rem 1rem;
    width: 10.8vw;
    font-size: 14px;
    height: 3rem;
    cursor: pointer;
    transition: 0.3s;
    border: none;
}
.select:hover{
    background:  var(--color-solid-gray);
    color: var(--color-white);
}
.usertype-dropdown1{
    display: inline-block;

}
.select1{
    background-color: var(--color-solid-gray);
    color: var(--color-white);
    /* align-items: center; */
    padding: 5px;
    border-radius: 5px;
    width: 10.8vw;
    font-size: 14px;
    height: 2rem;
    cursor: pointer;
    transition: 0.3s;
    border: none;
}
.select1:hover{
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
    .remaining{
        position: relative;
        display: inline-block;
    }
    .newUser-button1{
        position: relative;
        margin-left: 1rem;
        display: inline-block;
    }
    .newUser-button2{
        margin-left: 1rem;
        position: relative;
        display: inline-block;
    }
    .newUser-button3{
        margin-left: 20rem;
        position: relative;
        display: inline-block;
    }
    .newUser-button4{
        margin-left: 2rem;
        position: relative;
        display: inline-block;
    }

    .add-account1{
        display: flex;
        border: none;
        background-color: var(--color-background); 
        align-items: center;
        color: var(--color-button); 
        fill: var(--color-button); 
        width: 10rem;
        text-align: center;
        justify-content: center;
        height: 1.7rem;
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
    .add-account2{
        display: flex;
        border: none;
        background-color: var(--color-background); 
        align-items: center;
        color: var(--color-button); 
        fill: var(--color-button); 
        width: 10rem;
        text-align: center;
        justify-content: center;
        height: 1.7rem;
        border-radius: 10px;
        padding: .68rem 1rem;
        font-family: 'Outfit', sans-serif;
        transition: all 300ms ease;
        position: relative; 
        margin-top: .2rem;
        text-transform: uppercase;
        border-bottom: 4px solid #008B8B;
    }
    .add-account2 h3{
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
        width: 22rem;
        text-align: center;
        justify-content: center;
        height:3.5rem;
        border-radius: 0px 5px 5px 0px;
        padding: .68rem 1rem;
        font-family: 'Outfit', sans-serif;
        transition: all 300ms ease;
        position: relative; 
        margin-bottom: .9rem;
        margin-top: .2rem;
        text-transform: uppercase;
        border-left: 7px solid #A9A9A9;
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
                        <div class="select-dropdown">
                                <select class="select">
                                    <option selected disabled value="">SELECT SERVICE</option>
                                    <option value="All">All</option>
                                    <option value="Delivery">Delivery</option>
                                    <option value="Delivery/Pick Up">Delivery/Pick Up</option>
                                </select>
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
                </div>
                <div class="main-container">
                    <div class="sub-tab-container">
                        <div class="newUser-button2"> 
                            <div id="add-userbutton" class="add-account2">
                                <?php
                                    $delivery_query = "SELECT 
                                    count(transaction.id) as count
                                    FROM transaction
                                    WHERE transaction.service_type = 'Delivery'
                                    AND transaction.uuid NOT IN (SELECT uuid FROM delivery_list)";
                                    $delivery_result = mysqli_query($con, $delivery_query);
                                    $delivery = mysqli_fetch_assoc($delivery_result);
                                    $count_of_for_delivery = $delivery['count'];
                                
                                ?>
                                <h3 class="deliveries">For Delivery</h3>
                                <span class="total-deliveries"><?php echo $count_of_for_delivery ?></span>
                            </div>
                        </div>
                        <div class="newUser-button1"> 
                            <div id="add-userbutton" class="add-account1">
                                <?php
                                    $delivery_pickup_query = "SELECT 
                                    count(transaction.id) as count
                                    FROM transaction
                                    WHERE transaction.service_type = 'Delivery/Pick Up'
                                    AND transaction.uuid NOT IN (SELECT uuid FROM delivery_list)";
                                    $delivery_pickup_result = mysqli_query($con, $delivery_pickup_query);
                                    $delivery_pickup = mysqli_fetch_assoc($delivery_pickup_result);
                                    $count_of_for_delivery_pickup = $delivery_pickup['count'];
                                
                                ?>
                                <h3 class="deliveries">For Pick Up</h3>
                                <span class="total-deliveries"><?php echo $count_of_for_delivery_pickup ?></span>
                            </div>
                        </div>
                        <div class="createDelivery">
                            <a href="../monitoring/monitoring-delivery-pickup-delivered.php" id="add-userbutton" class="batchlist">
                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M5 16q-1.042 0-1.771-.729Q2.5 14.542 2.5 13.5H1V5q0-.625.438-1.062Q1.875 3.5 2.5 3.5H14v3h2.5L19 10v3.5h-1.5q0 1.042-.729 1.771Q16.042 16 15 16q-1.042 0-1.771-.729-.729-.729-.729-1.771h-5q0 1.042-.729 1.771Q6.042 16 5 16Zm0-1.5q.417 0 .708-.292Q6 13.917 6 13.5t-.292-.708Q5.417 12.5 5 12.5t-.708.292Q4 13.083 4 13.5t.292.708q.291.292.708.292Zm10 0q.417 0 .708-.292.292-.291.292-.708t-.292-.708Q15.417 12.5 15 12.5t-.708.292Q14 13.083 14 13.5t.292.708q.291.292.708.292Zm-1-4 3.5-.021L15.729 8H14Z"/></svg>
                                <h3 class="deliveries">DELIVERED CUSTOMERS LIST</h3>
                            </a>
                        </div>
                        <div class="pickup">
                            <a href="../monitoring/monitoring-delivery-pickup-list.php" id="add-userbutton" class="pickuplist">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="m7 16.5-1.062-1.062 2.187-2.188H2v-1.5h6.125L5.938 9.562 7 8.5l4 4Zm6-5-4-4 4-4 1.062 1.062-2.187 2.188H18v1.5h-6.125l2.187 2.188Z"/></svg>
                                <h3 class="deliveries">PICK UP LIST</h3>
                            </a>
                        </div>
                    </div>
                </div>
                    <div class="customer-container" id="customerTable">
                                <br>
                                <div class="newUser-button4"> 
                                    <button id="add-userbutton" class="add-account3">
                                        <h3 class="deliveries">TOTAL PENDING DELIVERY/PICK UP</h3>
                                        <span class="total-deliveries">0</span>
                                    </button>
                                </div>
                                <div class="card">
                                     <h1 class="day"><?php echo date("l")?></h1>
                                    <h1 class="dash">-</h1>
                                    <h1 class="date"><?php echo ' '.date("F j, Y")?></h1>
                                </div>
                                <hr>
                                <table class="table" id="myTable">
                                <thead>
                                        <tr>
                                            <th><span class="statusLbl">STATUS</span></th>
                                            <th>ID</th>
                                            <th>Customer Name</th>
                                            <!-- <th>Address</th>
                                            <th>Contact Number</th> -->
                                            <th>Payment Status</th>
                                            <th>Date/Time Listed</th>
                                            <th>Transaction Details</th>
                                        </tr>
                                </thead>
                            <?php
                            $dropdown_query2 = "SELECT 
                            transaction.id,
                            transaction.uuid,
                            customers.customer_name,
                            transaction.status_id,
                            users.first_name,
                            users.last_name,
                            transaction.created_at_date,
                            transaction.service_type,
                            transaction.created_at_time
                            FROM transaction
                            INNER JOIN users
                            ON transaction.created_by_id = users.user_id
                            INNER JOIN payment_option
                            ON transaction.payment_option = payment_option.id
                            LEFT JOIN customers
                            ON transaction.customer_name_id = customers.id
                            WHERE transaction.service_type != 'Walk In'
                            AND transaction.uuid NOT IN (SELECT uuid FROM delivery_list)
                            ORDER BY transaction.created_at_time";
                            $result = mysqli_query($con, $dropdown_query2);
                            while ($rows = mysqli_fetch_assoc($result))
                                {
                            ?>
                        <tbody>
                            <form action="" method="post" enctype="multipart/form-data" id="addorderFrm">
                                <td>
                                    <?php 
                                        if($rows['service_type'] == 'Delivery/Pick Up'){
                                    ?>
                                        <button type="submit" name="add-for-pickup" class="status2">ADD FOR PICK UP</button>
                                    <?php
                                        }else{
                                    ?>
                                            <button type="submit" name="add-for-delivery" class="status3">ADD FOR DELIVERY</button>
                                    <?php
                                        }
                                    ?>
                                </td>
                                <td> <?php echo $rows['id']; ?></td>
                                            <td >
                                                <input type="hidden" name="customername" value="<?php echo $rows['customer_name']; ?>"/>
                                                <?php echo $rows['customer_name'];?>
                                            </td>

                                            <td >
                                                <input type="hidden" name="status" value="<?php echo $rows['status_id']; ?>"/>
                                                <?php
                                                    if($rows['status_id'] == 0){
                                                        echo 'Unpaid';
                                                    }else{
                                                        echo 'Paid';
                                                    } 
                                                ?>
                                            </td>     
                                            <td> 
                                                <?php echo $rows['created_at_date'].' '.$rows['created_at_time']; ?></td>
                                            <td >
                                                <input type="hidden" name="uuid" value="<?php echo $rows['uuid'];?>"/>
                                                <a class="viewTransaction" href="../monitoring/monitoring-delivery-pickup-viewdetails.php?view=<?php echo $rows['uuid'];?>">View Details</a>
                                            </td>
                                        <tr id="noRecordTR" style="display:none">
                                            <td colspan="10">No Record Found</td>
                                        </tr>
                            </form>
                        </tbody>
                                <?php
                            }
                            ?>
                                </table>
                    </div>

                        <div class="delivery-container" id="customerTable">
                        
                            <div class="dateandtime">
                                <p class="date-Text">Date and Time:</p>
                                <div class="card-live">
                                    <h1 id="time" class="time">00:00:00</h1>
                                    <h1 class="dash">-</h1>
                                    <h1 id="date" class="date-live">00/00/0000</h1>
                                </div>
                            </div>
                            <hr>
                            <div class="deliveryLbl">
                                <h2>- DELIVERY LIST -</h2>
                            </div>
                    <form action="" method="post" enctype="multipart/form-data" id="addorderFrm">
                            <div class="deliveryboys">
                                <h4>COURIER</h4>
                                <div class="usertype-dropdown1">
                                    <?php
                                    $dropdown_query = "SELECT * FROM employee WHERE position_id LIKE '%2'";
                                    $result_category = mysqli_query($con, $dropdown_query);
                                    ?>
                                    <select class="select1" name="delivery_boy" required="" >
                                        <option selected disabled value="">SELECT DELIVERY BOY</option>
                                        <?php while($category = mysqli_fetch_array($result_category)):;?>
                                            <option value="<?php echo $category['id']?>">
                                                <?php echo $category['first_name'].' '.$category['last_name'];?></option>
                                        <?php endwhile;?>
                                    </select>
                                </div>
                            </div>
        
                            <div class="deliverylist-table">

                                <table class="tableCheckout" id="sumTable">
                                    <thead>
                                        <tr>
                                            <th class="th-name"><span class="nameTd">Name</span></th>
                                            <td colspan="3"></td>
                                        </tr>
                                        <tr>
                                            <th class="th-name"><span class="nameTd">Total Amount</span></th>
                                            <td colspan="3"></td>
                                        </tr>
                                    </thead>

                                    <tbody>
 
                                        <thead>
                                            <tr>
                                                <th>ORDER</th>
                                                <th>WATER</th>
                                                <th>QTY</th>
                                                <th>AMOUNT</th>
                                                <th>     
                                                    <a href="../service/delete-transaction-order.php?delete-list=<?php echo $transactions_uuid['uuid']; ?>" class="delete-rowsButton" class="action-btn" name="action">
                                                        X
                                                    </a>
                                                </th>
                                            </tr>
                                        </thead> 

                                                    <tr>
                                                        <td name="itemname_transaction"> </td>
                                                        <td name="watertype_transaction"> </td>
                                                        <td name="categorytype_transaction"> </td>
                                                        <td> </td>
                                                    </tr>
                                                        <tr id="noRecordTR"><td colspan="4">No Deliveries Added</td></tr>
                                                </tbody>
                                                
                                </table>
                            </div>
                            <div>
                            <?php
                            $transaction_order1 = mysqli_query($con, "SELECT sum(transaction.total_amount) 
                            AS total
                            FROM transaction
                            INNER JOIN delivery_list 
                            ON transaction.uuid = delivery_list.uuid
                            WHERE delivery_list.user_id = '$user_id'
                            AND delivery_list.delivery_status = 1"); 
                                                
                                                $transactions1 = mysqli_fetch_assoc($transaction_order1);

                                                            ?>

                            <hr>
                                <div class="totaldelivery1"><p class="totalAmount-text">TOTAL PAYMENTS</p></div>
                                <div class="total-amount">
                                    <label id="total_order1">&#8369</label>
                                    <input type="text" name="totalAmount" readonly id="totalAmount_order" value="<?php echo number_format($transactions1['total'], '2','.',','); ?>">
                                </div>
                            </div>
                            
        
                            <div class="receipt-buttons">
                                <button type="submit" class="confirmOrder-button" name="print" onclick="print();">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M15 6H5V3h10Zm-.25 4.5q.312 0 .531-.219.219-.219.219-.531 0-.312-.219-.531Q15.062 9 14.75 9q-.312 0-.531.219Q14 9.438 14 9.75q0 .312.219.531.219.219.531.219Zm-1.25 5v-3h-7v3ZM15 17H5v-3H2V9q0-.833.583-1.417Q3.167 7 4 7h12q.833 0 1.417.583Q18 8.167 18 9v5h-3Z"/></svg>
                                    Print
                                </button>
                                <button type="submit" class="confirmOrder-button2" name="deliver">
                                    DELIVER
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="form3">
                <div class="todeliver-transaction">
                    <br>
                    <header class="todeliver-transaction-header">ONGOING DELIVERY ORDERS</header>
                    <hr>
                    <table class="todeliver-transaction-table">
                        <thead>
                        <tr>
                            <th><span class="statusLbl">STATUS</span></th>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Order Details</th>
                            <th>Total Amount</th>
                            <th>Payment Status</th>
                            <th>Delivery Boy</th>
                            <th>Date/Time Added</th>
                        </tr>
                        </thead>
                            <tbody>
                            <tr>
                            <form action="" method="post" enctype="multipart/form-data" id="addorderFrm">
                                <td> <button type="submit" name="add-as-delivered" class="status1">ADD AS DELIVERED</button></td>
                                <input type="hidden" value="" name="uuid">
                            </form>
                                <td> </td>
                                <td> </td>
                                <td></td>
                                <td> </td> 
                                <td> </td>
                                <td></td>
                                <td> </td>
                                <td> 
                                </td>
                            <tr id="noRecordTR" style="display:none">
                                <td colspan="7">No Record Found</td>
                            </tr>
                            </tbody>
                        
                    </table>
                </div>
            </div>
            </main>
            <?php
                include('../common/top-menu.php')
            ?>    
        </div> 
        

    </body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script src="https://code.jquery.com/jquery.min.js"></script>
<script>
const addForm = document.querySelector(".bg-addcustomerform");
 function addnewuser(){
    // const addBtn = document.querySelector(".add-customer");
    addForm.style.display = 'flex';
}

var today = new Date();
var day = today.getDate();
var month = today.getMonth() + 1;

function appendZero(value) {
    return "0" + value;
}

function theTime() {
    var d = new Date();
    document.getElementById("time").innerHTML = d.toLocaleTimeString("en-US");
}

if (day < 10) {
    day = appendZero(day);
}

if (month < 10) {
    month = appendZero(month);
}

today = day + "/" + month + "/" + today.getFullYear();

document.getElementById("date").innerHTML = today;

var myVar = setInterval(function () {
    theTime();
}, 1000);

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
        
// -----------------------------date and time

</script>
