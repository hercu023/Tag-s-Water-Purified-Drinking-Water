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
    .status{
        font-weight: 800;
        font-size: .9rem;
        padding: .3rem 1rem;
        background-color: var(--color-main);
        color: var(--color-secondary-main);
        font-family: 'outfit', sans-serif;
        text-transform: uppercase;
        border-radius: 3rem;
        cursor: pointer;
    }
    .status:hover{
        background-color: var(--color-solid-gray);
        color: var(--color-secondary-main);
        border-bottom: 5px solid var(--color-main);
        transition: 0.3s;
    }
    .statusLbl{
        font-weight: 1000;
        font-size: 1.8rem;
        width: rem;
        text-transform: uppercase;
        border-bottom: 2px solid var(--color-main);
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
    height: 1.8rem;
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
/* ------------------------------------------------------------------------------------ */
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
    width: 101%;
    border-radius: 10px 10px 10px 10px;
    margin-top: 5rem;
    position: relative;
}
.sub-tab-container{
    display: inline-block;

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
    height: 4.8rem;
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
        margin-left: 2rem;
        display: inline-block;
    }
    .batchlist{
        display: flex;
        border: none;
        background-color: var(--color-solid-gray); 
        align-items: center;
        color: var(--color-secondary-main); 
        fill: var(--color-secondary-main); 
        width: 18rem;
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
        background-color: var(--color-white); 
        align-items: center;
        color: var(--color-button); 
        fill: var(--color-button); 
        width: 30rem;
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
</style>
    <body>
    
        <div class="container">
        <?php
            include('../common/side-menu.php')
        ?>
            <main>
                <div class="main-dashboard">
                    <h1 class="dashTitle">MONITORING</h1> 
                    <div class="sub-tab">
                        <div class="user-title">
                            <h2>DELIVERY/PICK UP</h2>
                        </div>
                        <div class="sub-tab-container">
                            
                            <div class="totals">
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
                </div>
    
                <div class="customer-container" id="customerTable">
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
            <?php
                include('../common/top-menu.php')
            ?>    
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
const addForm = document.querySelector(".bg-addcustomerform");
 function addnewuser(){
    // const addBtn = document.querySelector(".add-customer");
    addForm.style.display = 'flex';
}

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
