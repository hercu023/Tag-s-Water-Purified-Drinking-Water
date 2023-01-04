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
   
        <title>Tag's Water Purified Drinking Water</title>
  
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
    margin-top: -2px;
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
    a .status1{
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
    height: 3rem;
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
.customerName{
    align-items:center;
    width: 100%;
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

.bot-buttons{
    width: 100%;
    align-items: center;
    text-align: center;
    display: inline-block;
    margin-top: 1.3rem;
}
.AddButton1 button{
    font-family: 'COCOGOOSE', sans-serif;
    width: 15rem;
    height: 34px;
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
.AddButton1 button:hover{
    background: var(--color-button-hover);
}
.CancelButton{
    display: inline-block;
}
.AddButton1{
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
    display: inline-block;
    width: 80%;
    margin-left: 2rem;
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
.deliverylist-table table td{
    height: 1.8rem;
    color: var(--color-td);
    font-size: .8rem;
    }
    .deliverylist-table table th{
    height: 1.8rem;
    font-size: .7rem;
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
        display: inline-block;
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
        background-color: var(--color-white); 
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
        background-color: var(--color-white); 
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
        background-color: var(--color-white); 
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
   a{
    text-decoration: none;
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
        .menu-btn2{
            display: flex;
        }

    .add-account2{
        width: 50%;
    }
    .add-account1{
        width: 50%;
    }
    .newUser-button2{
        width: 100%;
        display: inline-block;
    }
    .newUser-button1{
        width: 100%;
        display: inline-block;
    }
    .sub-tab-container{
        width: 100%;
        margin-top: 1rem;

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
   
        .customer-container{
            position: relative;
            margin-top:2rem;
            overflow: auto;
            margin-left: -1rem;
            width: 100%;
            max-height: 600px;
            border-top: 5px solid var(--color-solid-gray);
            font-size: 15px;
        }
        .customer-container tbody tr td{
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

        main  h2{
            margin-left: 10%;
            display:none;
        }
        main .sub-tab{
            margin-bottom: 4rem;
        }
    
        .createDelivery{
            width: 100%;
            text-align: center;
        }
     .pickup{
        width: 100%;
        text-align: center;
     }
     .pickuplist{
        width: 90%;
        margin-top: 1rem;

     }
     .batchlist{
        width: 90%;
        margin-top: 1rem;
        
     }
     .day{
        font-size: .8rem;
     }
     .date{
        font-size: .8rem;
     }
     .card{
        height: 3rem;

     }
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
    .bg-editDropdown{
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
    .success-success{
        background-color: #52CC7A;
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
    /* --------------------------------------------------view details------------------------------------------- */
    .datetimeLbl{
        text-align: center;
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
.payment-service{
    width: 100%;
    text-align: center;
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

    .statusLbl{
        font-weight: 1000;
        font-size: 1.8rem;
        width: 3rem;
        text-transform: uppercase;
        border-bottom: 2px solid var(--color-main);
    }
.customernameLbl{
    margin-left: 1rem;
    font-size: .9rem;
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

.main-user-info{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 20px 0;
}
.addnew-title{
    font-size: min(max(1.9rem, 1.1vw), 2rem);
    color: var(--color-solid-gray);
    font-family: 'Malberg Trial', sans-serif;
    letter-spacing: .09rem;
    display: flex;
    padding-top: 1rem;
    margin-bottom: -.3rem;
    justify-content: center;
    border-bottom: 2px solid var(--color-solid-gray);
    width: 100%;
    padding-bottom: 2px;
}
.container2{
    width: 100%;
    max-width: 600px;
    padding: 28px;
    margin: 0 28px;
    border-radius:  0px 0px 20px 20px;
    background-color: var(--color-white);
    box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
    border-top: 10px solid var(--color-solid-gray);
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
    padding: 20px;
    width: 7rem;
    max-height: 60px;
    outline: none;
    border: none;
    gap: .5rem;
    font-size: min(max(9px, 1.1vw), 11px);
    border-radius: 20px;
    color: white;
    background:  var(--color-mainbutton);
    cursor: pointer;
    transition: 0.5s;
    /* margin-left: 1rem; */
    display: flex;
    fill: white;
    background: var(--color-solid-gray);
}
.AddButton button:hover{
    background: var(--color-main);
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
.payment-section{
    width: 100%;
    align-items: center;
    padding: 20px;
    margin-top: 1rem;
    justify-content: center;
    background-color: var(--color-background);
    border: none;
    border-radius: 20px;
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
.user-input-box-totalamount{
    /* display: inline-block; */

}
.user-input-box-cashpayment{
    display: inline-block;
    margin-top: 1rem;
}
.remaining-amount2{
    color: var(--color-black);
    font-family: 'calibri', sans-serif;
    font-size: 15px;
    font-weight: 700;
    margin-left: .5rem;
}
.user-input-box-cashpayment label{
    width: 95%;
    color: var(--color-solid-gray);
    font-size: 12px;
    text-align: right;
    /* margin-left: .2rem; */
    margin-bottom: 0.5rem;
    font-family: 'Malberg Trial', sans-serif;
    font-weight: 550;
    /* margin: 5px 0; */
}
.total-amount2{
    color: var(--color-black);
    font-family: 'calibri', sans-serif;
    font-size: 25px;
    float: right;
}
.user-input-box-cashpayment .cash-payment2{
    display: inline-block;
    text-align: right;
    height: 2.5rem;
    outline: none;
    margin-right: 1rem;
    margin-left: 1rem;
    font-size: .8em;
    color: var(--color-black);
}
.user-input-box-cashpayment .cash-change{
    display: inline-block;
    text-align: right;
    height: 2.5rem;
    margin-left: 1rem;
    outline: none;
    font-size: .8em;
    color: var(--color-black);

}
.quantity-td{
    min-width: 5rem;
    width: 10%;
    gap: 1rem;
    justify-content: center;
}
.payment-options{
    background-color: none;
    /* width: 100%; */
    /* margin-left:.5rem; */
    /* position: absolute; */
    display: inline-block;
    text-align: right;
    /* padding-top: 1rem; */
    /* right: 8%; */
}
.orderSum-Details{
    background-color: var(--color-white);
    padding: 1rem;
    width:100%;
    overflow:auto;
    /* display: inline-block; */
    /* margin-left: 1.1rem; */
    max-height: 12rem;
    height: 12rem;
    margin-top: 1rem;
    /* text-align: right; */
    /* display: flex; */
    border-top: 2px solid var(--color-solid-gray);
    position: relative;
    border-radius: 10px;
}
.nodelivers{
    text-align: center;
    width: 100%;
    margin: 11rem;
    height: 2.8rem;
    color: var(--color-td);
    font-size: .8rem;
    align-items:center;
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
                    if (isset($_GET['success'])) {
                        echo '<p id="myerror" class="success-success"> '.$_GET['success'].' </p>';
                    }
                    ?>
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
                </div>

                    <div class="customer-container" id="customerTable">
                                <br>
                   
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
                            if(mysqli_num_rows($result) > 0)
                            {
                            foreach($result as $rows)
                            {?>
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
                                                        echo '<span class="outofstock">Unpaid</span>';
                                                    }else{
                                                        echo '<span class="instock">Paid</span>';
                                                    } 
                                                ?>
                                            </td>     
                                            <td> 
                                                <?php echo $rows['created_at_date'].' '.$rows['created_at_time']; ?></td>
                                            <td >
                                                <input type="hidden" name="uuid" value="<?php echo $rows['uuid'];?>"/>
                                                <a class="viewTransaction" href="../monitoring/monitoring-delivery-pickup.php?view=<?php echo $rows['uuid'];?>">View Details</a>
                                            </td>
                                   
                            </form>
                        </tbody>
                  <?php  }}else { ?>
                        <tr id="noRecordTR">
                            <td colspan="6">No Delivery/Pick Up Added</td>
                        </tr>
                    <?php } ?>
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
                            <?php 
                            // per customer
                                    $user_id = $_SESSION['user_user_id'];
                            
                                    $transaction_process = "SELECT
                                                customers.customer_name,
                                                customers.id,
                                                sum(transaction.total_amount) AS total
                                                FROM delivery_list
                                                INNER JOIN transaction
                                                ON delivery_list.uuid = transaction.uuid
                                                INNER JOIN customers
                                                ON transaction.customer_name_id = customers.id
                                                WHERE delivery_list.user_id = '$user_id'
                                                AND delivery_list.delivery_status = 1
                                                GROUP BY customers.customer_name";
                                    $transaction_order = mysqli_query($con, $transaction_process);
                                    if(mysqli_num_rows($transaction_order) > 0)
                                    { 
                                        foreach($transaction_order as $transaction_name)
                                        {
                            ?>
                                <table class="tableCheckout" id="sumTable">
                                    <thead>
                                        <tr>
                                            <th class="th-name"><span class="nameTd">Name</span></th>
                                            <td colspan="3"><?php echo $transaction_name['customer_name'];?></td>
                                        </tr>
                                        <tr>
                                            <th class="th-name"><span class="nameTd">Total Amount</span></th>
                                            <td colspan="3"><?php echo $transaction_name['total'];?></td>
                                        </tr>
                                    <?php 
                                    $customer_id = $transaction_name['id'];
                                    $total_unpaid = "SELECT 
                                    t.id,
                                    t.customer_name,
                                    t.contact_number1,
                                    t.address, 
                                    t.balance,
                                    SUM(t.unpaid_amount) as credit
                                    FROM
                                    (SELECT
                                    customers.id,
                                    customers.customer_name,
                                    customers.contact_number1,
                                    customers.address, 
                                    customers.balance,
                                    transaction_history.transaction_uuid,
                                    MIN(transaction_history.unpaid_amount) as unpaid_amount
                                    FROM transaction_history
                                    INNER JOIN transaction
                                    ON transaction.uuid = transaction_history.transaction_uuid
                                    INNER JOIN delivery_list 
                                    ON transaction.uuid = delivery_list.uuid
                                    INNER JOIN customers
                                    on transaction.customer_name_id = customers.id
                                    WHERE customers.status_archive_id = 1
                                    AND delivery_list.delivery_status = 1
                                    AND delivery_list.user_id = '$user_id'
                                    GROUP BY transaction_history.transaction_uuid) 
                                    t 
                                    WHERE t.id = '$customer_id'
                                    GROUP BY t.customer_name
                                    HAVING SUM(t.unpaid_amount) > 0";
                                    $transaction_unpaid_result = mysqli_query($con, $total_unpaid);
                                    if(mysqli_num_rows($transaction_unpaid_result) > 0)
                                     { 
                                    $transaction_unpaid = mysqli_fetch_assoc($transaction_unpaid_result);
                                    ?>
                                    
                                        <tr>
                                            <th class="th-name"><span class="nameTd">Total Unpaid Amount</span></th>
                                            <td colspan="3"><?php echo $transaction_unpaid['credit'];?></td>
                                        </tr>
                                    <?php } ?>
                                    </thead>
                                    <?php  
                                    // per uuid per customer 
                                        $customer_name = $transaction_name['customer_name'];    
                                                $transaction_uuid = "SELECT
                                                        delivery_list.uuid
                                                        FROM delivery_list
                                                        INNER JOIN transaction
                                                        ON delivery_list.uuid = transaction.uuid
                                                        INNER JOIN customers
                                                        ON transaction.customer_name_id = customers.id
                                                        WHERE customers.customer_name = '$customer_name'
                                                        AND delivery_list.delivery_status = 1
                                                        AND delivery_list.user_id = $user_id";
                                                $transaction_uuid_result = mysqli_query($con, $transaction_uuid);
                                                if(mysqli_num_rows($transaction_uuid_result) > 0)
                                                {?>
                                    <tbody>
                                        <?php
                                        foreach($transaction_uuid_result as $transactions_uuid)
                                        {
                                        ?>  
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
                                        <?php
                                            $uuid = $transactions_uuid['uuid'];
                                            $transaction_process = "SELECT
                                            transaction_process.item_name, 
                                            transaction_process.water_type,
                                            transaction_process.category_type,
                                            transaction_process.quantity,
                                            transaction_process.price,
                                            transaction_process.total_price
                                            FROM transaction_process
                                            INNER JOIN transaction
                                            ON transaction_process.transaction_id = transaction.uuid
                                            INNER JOIN delivery_list
                                            ON delivery_list.uuid = transaction.uuid
                                            WHERE transaction_id = '$uuid'
                                            AND delivery_list.delivery_status = 1
                                            AND delivery_list.user_id = '$user_id'";
                                            $transaction_order = mysqli_query($con, $transaction_process);
                                            if(mysqli_num_rows($transaction_order) > 0)
                                            {
                                        foreach($transaction_order as $transactions){
                                        ?>  
                                                    <tr>
                                                        <td name="itemname_transaction"> <?php echo $transactions['item_name']; ?></td>
                                                        <td name="watertype_transaction"> <?php echo $transactions['water_type']; ?></td>
                                                        <td name="categorytype_transaction"> <?php echo $transactions['quantity']; ?></td>
                                                        <td> <?php echo '&#8369'.' '. number_format($transactions['total_price'], '2','.',','); ?></td>
                                                    </tr>
                                                    <?php } ?> 
                                      
                                                    <?php }}}} } else { ?> 
                                                        <tr id="noRecordTR"><td > <span class="nodelivers" >No Deliveries Added</span></td></tr>
                                                    <?php } ?> 

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
                                <button type="submit" name="print-delivery" id="addcustomerBtn" class="confirmOrder-button">
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
                        <?php
                            $dropdown_query2 = "SELECT 
                            transaction.id,
                            transaction.uuid,
                            customers.customer_name,
                            transaction.status_id,
                            transaction.total_amount,
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
                            AND delivery_list.delivery_status = 2
                            ORDER BY transaction.created_at_time";
                        $result4 = mysqli_query($con, $dropdown_query2);
                        if(mysqli_num_rows($result4) > 0)
                        {
                        foreach($result4 as $rows)
                        {?>
                            <tbody>
                            <tr>
                            <!-- <form action="" method="post" enctype="multipart/form-data" id="addorderFrm"> -->
                                <td> <a href="../monitoring/monitoring-delivery-pickup.php?confirm=<?php echo $rows['id'];?>" type="submit" class="status1">ADD AS DELIVERED</a></td>
                                <!-- <input type="hidden" value="<?php echo $rows['uuid'];?>" name="uuid"> -->
                            <!-- </form> -->
                                <td> <?php echo $rows['id']; ?></td>
                                <td> <?php if($rows['customer_name']){
                                    echo $rows['customer_name'];
                                    }else{
                                        echo 'GUEST';
                                    }
                                 ?></td>
                                <td> <a class="viewTransaction" href="../monitoring/monitoring-delivery-pickup.php?view=<?php echo $rows['uuid'];?>">View Details</a></td>
                                <td> <?php echo '<span>&#8369;</span>'.' '.number_format($rows['total_amount'], '2','.',','); ?></td> 
                                <td>         
                                    <?php
                                         if($rows['status_id'] == 0){
                                            echo '<span class="outofstock">Unpaid</span>';
                                        }else{
                                            echo '<span class="instock">Paid</span>';
                                        }
                                    ?>
                                </td>
                                <td> <?php echo $rows['first_name'] .' '. $rows['last_name'] ; ?></td>
                                <td> <?php echo $rows['updated_at'] ?></td>
                                <td>    <a href="../service/delete-transaction-order.php?delete-list=<?php echo $rows['uuid']; ?>" class="delete-rowsButton" class="action-btn" name="action">
                                            X
                                        </a>
                                </td>
            
                            </tbody>
                            <?php  }}else { ?>
                        <tr id="noRecordTR">
                            <td colspan="8">No Ongoing Deliveries Added</td>
                        </tr>
                    <?php } ?>
                    </table>
                </div>
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
if(isset($_GET['confirm']))
{
    $id = $_GET['confirm'];
    $result = mysqli_query($con, "SELECT 
                transaction.id,
                transaction.uuid,
                customers.customer_name
                FROM transaction 
                INNER JOIN delivery_list
                ON transaction.uuid = delivery_list.uuid
                LEFT JOIN customers
                ON transaction.customer_name_id = customers.id
                WHERE transaction.id='$id'");
    if(mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result); ?>

        <form action="" method="post" enctype="multipart/form-data" id="addcustomerFrm">
            <div class="bg-editDropdown" id="edit-bgdrop">
                <div class="container1">
                    <h1 class="addnew-title">DELIVERED CUSTOMER</h1>
                    <form action="#">
                        <input type="hidden" required="required" name="uuid" value="<?=$user['uuid'];?>">
                        <div class="a-header">
                            <label class="archive-header"> Do you want to proceed Customer <?=$user['customer_name'];?> as Delivered ?</label>
                        </div>
                        <div class="bot-buttons">
                            <div class="CancelButton">
                                <a href="../monitoring/monitoring-delivery-pickup.php" id="cancel">CANCEL</a>
                            </div>
                            <div class="AddButton1">
                                <button type="submit" id="addcustomerBtn" name="add-as-delivered">CONFIRM</button>
                            </div>
                        </div>
                </div>
        </form>
    <?php }} ?>

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
                <a href="../monitoring/monitoring-delivery-pickup.php" class="close">X</a>
                <h1 class="addnew-title">TRANSACTION DETAILS</h1>
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
                                <span class="createdatLbl"><?= 'DATE :'.' '. $transaction['created_at_date'];?></span>
                                <span class="createdatLbl"><?=  'TIME :'.' '.$transaction['created_at_time'];?></span>
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
                        <?php $transaction_history = "SELECT
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
                        <div class="payment-section">
                            <div class="user-input-box-totalamount">
                                <label for="total-amount2">TOTAL AMOUNT</label>
                                <span id="total-amount2" class="total-amount2"><?php echo '&#8369'.' '.number_format($transaction['total_amount'], '2','.',','); ?></span>
                            </div>
                            
                            <div class="user-input-box-cashpayment">
                                <label for="cash-payment2">Cash Payment</label>
                                <span id="cash-payment2" class="remaining-amount2"><?php echo '&#8369'.' '.number_format($transactions_history['amount_tendered'], '2','.',','); ?></span>
                            </div>

                            <div class="user-input-box-cashpayment">
                                <label for="cash-payment2">Change</label>
                                <span id="cash-change"class="remaining-amount2"><?php echo '&#8369'.' '.number_format($transactions_history['customer_change'], '2','.',','); ?></span>
                            </div>
                        </div>
                        <?php }} ?>

                        <div class="line"></div>

                        <div class="bot-buttons">
                            <div class="AddButton">
                                <button type="submit" id="addcustomerBtn" name="save-transaction" onclick="print();">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M15 6H5V3h10Zm-.25 4.5q.312 0 .531-.219.219-.219.219-.531 0-.312-.219-.531Q15.062 9 14.75 9q-.312 0-.531.219Q14 9.438 14 9.75q0 .312.219.531.219.219.531.219Zm-1.25 5v-3h-7v3ZM15 17H5v-3H2V9q0-.833.583-1.417Q3.167 7 4 7h12q.833 0 1.417.583Q18 8.167 18 9v5h-3Z"/></svg>
                                    PRINT
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script src="https://code.jquery.com/jquery.min.js"></script>
<script>
     setTimeout(function() {
        $('#myerror').fadeOut('fast');
    }, 10000);

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
