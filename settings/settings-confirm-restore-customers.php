<?php
require_once '../service/restore-settings.php';
require_once "../service/user-access.php";

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'SETTINGS-ARCHIVES')) {
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
            <h1 class="dashTitle">SETTINGS</h1>
            <div class="sub-tab">
                <div class="user-title">
                    <h2> Archive </h2>
                </div>
                <div class="sub-tab2">
                    <div class="delivery-options">
                        <select class="select" onchange="window.location.href=this.value;">
                            <option selected disabled value="">SELECT DATA</option>
                            <option value="../settings/Settings-dataarchive-account.php">Account</option>
                            <option value="../settings/Settings-dataarchive-customers.php">Customers</option>
                            <option value="Employee">Employee</option>
                            <option value="Inventory">Inventory</option>
                        </select>
                    </div>
                    <div class="newUser-button">
                        <button type="submit" id="add-userbutton" class="add-account" onclick="selectRestore();">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 13.5h1.5v-3.125l1.188 1.187L13 10.5l-3-3-3 3 1.062 1.062 1.188-1.187ZM6.5 17q-.625 0-1.062-.438Q5 16.125 5 15.5v-10H4V4h4V3h4v1h4v1.5h-1v10q0 .625-.438 1.062Q14.125 17 13.5 17Z"/></svg>
                            <h3>RESTORE</h3>
                        </button>
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
                <h3 class="word">Customer</h3>
                <div class="customer-container">

                    <table class="table" id="myTable">
                        <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Contact Number 1</th>
                            <th>Contact Number 2</th>
                            <th>Balance</th>
                            <th>Note</th>
                            <th>Added By</th>
                            <th>Date/Time Added</th>
                            <th class="select-label">RESTORE</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>


    <?php
    include('../common/top-menu.php')
    ?>
    <?php
    if(isset($_GET['edit']))
    {
        $customer_id = $_GET['edit'];
        ?>
        <form action="" method="post" enctype="multipart/form-data" id="addcustomerFrm">
            <div class="bg-addcustomerform" id="bg-addform">
                <div class="message"></div>
                <div class="container1">
                    <h1 class="addnew-title">RESTORE CUSTOMER</h1>
                    <form action="#">
                        <input type="hidden" required="required" name="id" value="<?=$customer_id;?>">

                        <div class="a-header">
                            <label class="archive-header"> Are you sure to Restore customer with id: <?=$customer_id;?> ?</label>
                        </div>
                        <div class="bot-buttons">
                            <div class="CancelButton">
                                <a href="settings-data-archive-customers.php" id="cancel">CANCEL</a>
                            </div>
                            <div class="AddButton">
                                <button type="submit" id="addcustomerBtn" name="restore-customer">RESTORE</button>
                            </div>
                        </div>
                </div>
        </form>
    <?php } ?>
</div>
</body>
</html>
<script src="javascript/settings-dataarchive-customer.js"></script>

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
        --color-select-customer:rgb(9, 138, 107);
        --color-new-customer:rgb(169, 109,5);
        --color-return-container:rgb(54, 85, 225);
        --color-table-title:rgb(0, 197, 145);
        --color-table-border:rgb(226, 226, 229);
        --color-secondary-background:rgb(244, 244, 244);
        --color-lightest-gray:rgb(250,250,250);

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
    .container1{
        width: 100%;
        max-width: 500px;
        padding: 28px;
        margin: 0 28px;
        border-radius:  0px 0px 20px 20px;
        background-color: var(--color-white);
        box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
        border-top: 10px solid var(--color-tertiary);
    }
    .bg-addcustomerform{
        height: 100%;
        width: 100%;
        background: rgba(0,0,0,0.7);
        top: 0;
        position: absolute;
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
        color: var(--color-tertiary);
        font-family: 'Malberg Trial', sans-serif;
        letter-spacing: .09rem;
        display: flex;
        padding-top: 1rem;
        justify-content: center;
        border-bottom: 2px solid var(--color-tertiary);
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
        background:  var(--color-tertiary);
        cursor: pointer;
        transition: 0.5s;
        margin-left: rem;
    }
    .AddButton button:hover{
        background: var(--color-main);
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
    .block{
        width: 5rem;
        height: 2rem;
        background-color: var(--color-background);
        position: fixed;
        display: flex;
        top: 0;
    }
    .action-btn{
        background: var(--color-solid-gray);
        color: var(--color-white);
        align-items: center;
        border-radius: 20px;
        height: 1rem;
        width: 1rem;
        padding-top: 10px;
        /* padding-bottom: 5px; */
        padding-left: 10px;
        padding-right: 10px;
        cursor: pointer;
        transition: 0.3s;
        border: none;
        margin-bottom: 6rem
    }
    .action-btn:hover{
        background: var(--color-main);
        color: var(--color-white);
    }
    .fa{
        font-family: "Font Awesome 5 Free", sans-serif;
        font-weight: 501;
        font-size: 14px;
    }
    .actionicon{
        fill:  var(--color-white);
    }
    #archive-action{
        background: hsl(0, 51%, 44%);
        color: var(--color-white);
        align-items: center;
        position: relative;
        margin: 1px;
        border-radius: 3px;
        height: 50%;
        width: 50%;
        cursor: pointer;
        transition: 0.3s;
        border: none;
    }
    #archive-action:hover{
        background: var(--color-main);
        color: var(--color-white);
    }
    .select-label{
        font-family: 'outfit', sans-serif;
        font-size: 12px;
        color: var(--color-main);
    }

    /* ----------------------------------------MAIN---------------------------------------- */
    .main-dashboard{
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
    .sub-tab2{
        display: inline-block;
        /* margin-top: -2rem; */
        margin-left: 10rem;
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
        margin-bottom: 5rem;
    }
    /* ----------------------------------------Search BAR---------------------------------------- */
    .search{
        position: absolute;
        display: inline-block;
        gap: 2rem;
        align-items: right;
        text-align: right;
        right: 0;
        margin-left: 39vw;
    }
    .search-bar{
        /* width: 15vw; */
        background: var(--color-white);
        /* display: flex; */
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
        width: 30px;
        height: 30px;
        background: var(--color-main);
    }
    /* ----------------------------------------Add Button---------------------------------------- */
    .delivery-options{
        /* display: inline-block; */
        display: inline-block;
        /* left: 2%; */
        margin-left: -6rem;
        max-height: 50px;
        /* position: absolute; */
    }
    .select{
        background-color: var(--color-white);
        color: var(--color-tertiary);
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
        background: var(--color-tertiary);
        color: var(--color-white);
    }

    .newUser-button{
        position: absolute;
        display: inline-block;
        margin-top: .-2rem;
        margin-left: 2rem;
    }
    .add-account{
        display: flex;
        border: none;
        background-color: var(--color-white);
        align-items: center;
        color: var(--color-button);
        fill: var(--color-button);
        width: 8.5rem;
        max-height: 43px;
        border-radius: 20px;
        padding: .68rem 1rem;
        font-family: 'Outfit', sans-serif;
        cursor: pointer;
        gap: 1rem;
        transition: all 300ms ease;
        position: absolute;
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
    /* ----------------------------------------Dashboard Table---------------------------------------- */
    .main-container{
        height: 650px;
        background: var(--color-white);
        width: 100%;
        margin-top: -4rem;
        border-radius: 10px;
    }
    .word{
        padding-top: 2rem;
        font-family: 'Switzer', sans-serif;
        font-size:1.5rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding-left: 4rem;
        padding-bottom: -1rem;
        border-bottom: 2px solid var(--color-tertiary);
        color: var(--color-tertiary);
    }
    .main-container .customer-container{
        /* margin-top: .5rem; */
        max-height: 650px;
        overflow:auto;
        width: 100%;
        border-radius: 0px 0px 10px 10px;
    }
    .main-container .customer-container table{
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
    .main-container .customer-container table:hover{
        box-shadow: none;
        /* border-top: 8px solid var(--color-main); */
    }

    .main-container table tbody td{
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
    td:focus {
        color: var(--color-main);
        cursor: pointer;
        background-color: var(--color-table-hover);
    }
    /* ----------------------------------------ASIDE---------------------------------------- */
    .container{
        display: grid;
        width: 97%;
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