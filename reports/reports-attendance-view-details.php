<?php
require_once '../database/connection-db.php';
require_once "../service/user-access.php";
require_once "../service/filter-reports.php";

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'REPORTS-ATTENDANCE')) {
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
    <link rel="stylesheet" type="text/css" href="../CSS/pagination.css">
    <title>Tag's Water Purified Drinking Water</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

</head>
<style>
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

    .total-deliveries{
        font-family: 'ARIAL', sans-serif;
        color: var(--color-black); 
        font-size: .9rem;
    }
    .total-transactions{
        font-family: 'ARIAL', sans-serif;
        font-weight: 900;
        color: var(--color-black); 
        font-size: 1rem;
    }

    .add-account1{
        display: flex;
        border: none;
        background-color: var(--color-background); 
        align-items: center;
        color: var(--color-button); 
        fill: var(--color-button); 
        width: 15rem;
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
        margin-right: 1rem;
    }

    .add-account2{
        display: flex;
        border: none;
        background-color: var(--color-background); 
        align-items: center;
        color: var(--color-button); 
        fill: var(--color-button); 
        width: 15rem;
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
        border-bottom: 4px solid #008B8B;
    }
    .add-account2 h3{
        font-size: .8rem;
        margin-right: 1rem;
    }
    .add-account3{
        display: flex;
        border: none;
        background-color: var(--color-background); 
        align-items: center;
        color: var(--color-button); 
        fill: var(--color-button); 
        width: 15rem;
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
        border-bottom: 4px solid #A52A2A;
    }
    .add-account3 h3{
        font-size: .8rem;
        margin-right: 1rem;
    }
    .add-account4{
        display: flex;
        border: none;
        background-color: var(--color-background); 
        align-items: center;
        color: var(--color-button); 
        fill: var(--color-button); 
        width: 15rem;
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
        border-bottom: 4px solid #FF8C00;
    }
    .add-account4 h3{
        font-size: .8rem;
        margin-right: 1rem;
    }
    .newUser-button4{
        display: inline-block;
        margin-right: 1rem;
    }
    .newUser-button3{
        display: inline-block;
        margin-right: 1rem;
    }
    .newUser-button2{
        display: inline-block;
        margin-right: 1rem;
    }
    .newUser-button1{
        display: inline-block;
        margin-right: 1rem;
    }
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
    font-family: 'galhau-display', sans-serif;
    background-position: center;
    background-size: cover;
    background-attachment: fixed;
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
.for-date{
    position: relative;
    margin-left: 1rem;
    color: var(--color-solid-gray);
    font-size: 1.3rem;
    display: inline-block;
}
.date{
    font-family: 'century gothic', sans-serif;
    display: inline-block;
    font-size: 1.7rem;
    margin-left: .9rem;
    color: var(--color-black);
}
.user-title{
    position: relative;
    display: inline-block;
    margin-left: 3rem;
    border-right: 1px var(--color-solid-gray) solid;
    padding-right: 1rem;
}
.user-title2{
    position: relative;
    display: inline-block;
    padding-right: 1rem;
}
main  h2{
    color: var(--color-solid-gray);
    font-size: 1.3rem;
    text-transform: uppercase;
    letter-spacing: .1rem;
    font-family: 'Galhau Display', sans-serif;
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
    font-family: 'COCOGOOSE', sans-serif;
    letter-spacing: .03rem;
    border-bottom: 2px solid var(--color-main); 
    width: 78%;
    margin-top: 3.2rem;
}
/* ----------------------------------------Customers Table---------------------------------------- */
.main-container{
    /* height: 600px; */
    background: var(--color-white);
    width: 100%;
    margin-top: 2rem;
    border-radius: 10px 10px 0 0;
    position: relative;
}
.sub-tab-container{
    padding: 2rem;
    display: block;
}
.customer-container{
    /* margin-top: 2rem; */
    max-height: 650px;
    overflow:auto;
    width: 100%;
    /* position: absolute; */
    /* box-shadow: 0px 5px 30px 2px var(--color-table-shadow); */
    border-top: 2px solid var(--color-solid-gray);
    border-radius: 0px 0px 10px 10px;

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
.bot-buttons{
    display: inline-block;
}
.sub-title{
    display: block;
}
.addnew-title{
    width: 100%;
    margin-bottom: -.6rem;
    display: none;
    text-align: center;
}
.address{
    width: 100%;
    display: none;
    text-align: center;
}
.header-title{
    display: none;
}
@media print {
    .header-title{
        display: block;
    }
    .addnew-title{
        width: 52rem;
        display: block;
        text-align: center;
    }
    .address{
        width: 52rem;
        display: block;
        text-align: center;
    }
    .sub-tab-container{
        display: none;
    }
    .top-menu{
        display: none;
    }
    .menu{
        display: none;
    }
    #myTable {
        overflow: hidden;
        text-align: center;
        display: block;
        width: 90rem;
    }
    table td{
        width: 9rem;
    }
    .customer-container{
        overflow: hidden;
        width: 50rem;
        margin-right: 5rem;
    }
    .user-title2{
        display: inline-block;
        width: 50rem;

    }
    .sub-title{
        width: 100%;
    }
    .user-title{
        display: inline-block;
        width: 40rem;
        border-right: none;
    }
}

</style>
<body>
<div class="container">
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

                if(isset($_GET['view']) && !isset($_GET['month']) && !isset($_GET['year'])) {
                    $date = $_GET['view'];
                    $query = "SELECT *
                        FROM attendance 
                        INNER JOIN employee 
                        ON attendance.employee_id = employee.id
                        WHERE attendance.status_archive_id = 1
                        AND attendance.payroll_status = 1
                        AND attendance.date = '$date'
                        ORDER BY attendance.date DESC";
                        $rs_result = mysqli_query($con, $query);     
                        $row = mysqli_fetch_row($rs_result);     
                        $page_location = '../reports/reports-attendance-view-details.php?view='.$date;
                        $total_records = mysqli_num_rows($rs_result); 
                } else if (!isset($_GET['view']) && isset($_GET['month']) && isset($_GET['year'])) {
                    $month = $_GET['month'];
                    $year = $_GET['year'];
                    $query = "SELECT *
                            FROM attendance 
                            INNER JOIN employee 
                            ON attendance.employee_id = employee.id
                            WHERE attendance.status_archive_id = 1
                            AND attendance.payroll_status = 1
                            AND MONTHNAME(attendance.date) = '$month'
                            AND YEAR(attendance.date) = '$year'
                            ORDER BY attendance.date DESC";

                            $rs_result = mysqli_query($con, $query);     
                            $row = mysqli_fetch_row($rs_result);     
                            $page_location = '../reports/reports-attendance-view-details.php?month='.$month.'&year='.$year;
                            $total_records = mysqli_num_rows($rs_result); 

                } else if (!isset($_GET['view']) && !isset($_GET['month']) && isset($_GET['year'])) {
                    $year = $_GET['year'];
                    $query = "SELECT *
                            FROM attendance 
                            INNER JOIN employee 
                            ON attendance.employee_id = employee.id
                            WHERE attendance.status_archive_id = 1
                            AND attendance.payroll_status = 1
                            AND YEAR(attendance.date) = '$year'
                            ORDER BY attendance.date DESC";
                             $rs_result = mysqli_query($con, $query);     
                             $row = mysqli_fetch_row($rs_result);     
                             $page_location = '../reports/reports-attendance-view-details.php?year='.$year;
                             $total_records = mysqli_num_rows($rs_result); 
                } else {
                    $total_records = 0;     
                }
 
                $start_from = ($page - 1) * $per_page_record;  
                    
            ?>
    <main>
            <div class="header-title">
                <h1 class="addnew-title">TAG'S WATER</h1>
                <h1 class="addnew-title">PURIFIED DRINKING WATER</h1>
                <p class="address">17 M. Santos St., Brgy. San Jose, Antipolo City<p>
            </div>
        <div class="main-dashboard">
           
            <h1 class="dashTitle">REPORTS</h1>
            <?php
            if (isset($_GET['error'])) {
                echo '<p id="myerror" class="error-error" > '.$_GET['error'].' </p>';
            }
            ?>
            <div class="sub-tab">
                <div class="sub-title">
                    <div class="user-title">
                        <h2> ATTENDANCE REPORTS </h2>
                    </div>
                    <div class="user-title2">
                    <?php if(isset($_GET['view']) && !isset($_GET['month']) && !isset($_GET['year'])) { ?>
                        <h3 class="for-date"> For Date <h2 class="date"><?php echo $_GET['view']?></h3></h2>

                    <?php } else if (!isset($_GET['view']) && isset($_GET['month']) && isset($_GET['year'])) { ?>
                        <h3 class="for-date"> For Month <h2 class="date"><?php echo $_GET['month'] .' '. $_GET['year']?></h3></h2>

                    <?php } else if (!isset($_GET['view']) && !isset($_GET['month']) && isset($_GET['year'])) { ?>
                        <h3 class="for-date"> For Year <h2 class="date"><?php echo $_GET['year']?></h3></h2>

                    <?php } else { echo '<script> location.replace("../reports/reports-attendance.php"); </script>'; } ?>
                    </div>
                </div>
                
                <div class="main-container">
                        <div class="sub-tab-container">
                            <div class="totals">
                            <div class="newUser-button1"> 
                                <div id="add-userbutton" class="add-account1">
                            <?php
                                $attendance_count = "";
                                if(isset($_GET['view']) && !isset($_GET['month']) && !isset($_GET['year'])) {
                                    $date = $_GET['view'];
                                    $attendance_count = "SELECT attendance.id
                                    FROM attendance
                                    WHERE attendance.status_archive_id = 1
                                    AND attendance.payroll_status = 1
                                    AND attendance.date = '$date'";
                                } else if (!isset($_GET['view']) && isset($_GET['month']) && isset($_GET['year'])) {
                                    $month = $_GET['month'];
                                    $year = $_GET['year'];
                                    $attendance_count = "SELECT attendance.id
                                    FROM attendance
                                    WHERE attendance.status_archive_id = 1
                                    AND attendance.payroll_status = 1
                                    AND MONTHNAME(attendance.date) = '$month'
                                    AND YEAR(attendance.date) = '$year'";
                                } else if (!isset($_GET['view']) && !isset($_GET['month']) && isset($_GET['year'])) {
                                    $year = $_GET['year'];
                                    $attendance_count = "SELECT attendance.id
                                    FROM attendance
                                    WHERE attendance.status_archive_id = 1
                                    AND attendance.payroll_status = 1
                                    AND YEAR(attendance.date) = '$year'";
                                } else {
                                    echo '<script> location.replace("../reports/reports-attendance.php"); </script>';
                                }
                                    
                                    if($attendance_count_result = mysqli_query($con, $attendance_count))
                                    $rowcount = mysqli_num_rows($attendance_count_result);
                                    ?>
                                    <h3 class="deliveries">Attendance Record</h3>
                                    <span class="total-deliveries"><?php echo $rowcount;?></span>
                                </div>
                            </div>
                            <div class="newUser-button2"> 
                                <div id="add-userbutton" class="add-account2">
                                <?php
                                $bonus_total = "";
                                if(isset($_GET['view']) && !isset($_GET['month']) && !isset($_GET['year'])) {
                                    $date = $_GET['view'];
                                    $bonus_total = "SELECT 
                                    SUM(attendance.bonus) as total
                                    FROM attendance
                                    WHERE attendance.status_archive_id = 1
                                    AND attendance.payroll_status = 1
                                    AND attendance.date = '$date'";
                                } else if (!isset($_GET['view']) && isset($_GET['month']) && isset($_GET['year'])) {
                                    $month = $_GET['month'];
                                    $year = $_GET['year'];
                                    $bonus_total = "SELECT 
                                    SUM(attendance.bonus) as total
                                    FROM attendance
                                    WHERE attendance.status_archive_id = 1
                                    AND attendance.payroll_status = 1
                                    AND MONTHNAME(attendance.date) = '$month'
                                    AND YEAR(attendance.date) = '$year'";
                                } else if (!isset($_GET['view']) && !isset($_GET['month']) && isset($_GET['year'])) {
                                    $year = $_GET['year'];
                                    $bonus_total = "SELECT
                                    SUM(attendance.bonus) as total
                                    FROM attendance
                                    WHERE attendance.status_archive_id = 1
                                    AND attendance.payroll_status = 1
                                    AND YEAR(attendance.date) = '$year'";
                                } else {
                                    echo '<script> location.replace("../reports/reports-attendance.php"); </script>';
                                }
                                    if($bonus_total_result = mysqli_query($con, $bonus_total))
                                    $bonus_result = mysqli_fetch_assoc($bonus_total_result);
                                    ?>
                                    <h3 class="deliveries">Bonuses</h3>
                                    <span class="total-deliveries"><?php echo 'Php '.$bonus_result['total'];?></span>
                                </div>
                            </div>  
                            <div class="newUser-button3"> 
                                <div id="add-userbutton" class="add-account3">
                                <?php
                                $deductions_total = "";
                                if(isset($_GET['view']) && !isset($_GET['month']) && !isset($_GET['year'])) {
                                    $date = $_GET['view'];
                                    $deductions_total = "SELECT 
                                    SUM(attendance.deduction) as total
                                    FROM attendance
                                    WHERE attendance.status_archive_id = 1
                                    AND attendance.payroll_status = 1
                                    AND attendance.date = '$date'";
                                } else if (!isset($_GET['view']) && isset($_GET['month']) && isset($_GET['year'])) {
                                    $month = $_GET['month'];
                                    $year = $_GET['year'];
                                    $deductions_total = "SELECT 
                                    SUM(attendance.deduction) as total
                                    FROM attendance
                                    WHERE attendance.status_archive_id = 1
                                    AND attendance.payroll_status = 1
                                    AND MONTHNAME(attendance.date) = '$month'
                                    AND YEAR(attendance.date) = '$year'";
                                } else if (!isset($_GET['view']) && !isset($_GET['month']) && isset($_GET['year'])) {
                                    $year = $_GET['year'];
                                    $deductions_total = "SELECT
                                    SUM(attendance.deduction) as total
                                    FROM attendance
                                    WHERE attendance.status_archive_id = 1
                                    AND attendance.payroll_status = 1
                                    AND YEAR(attendance.date) = '$year'";
                                } else {
                                    echo '<script> location.replace("../reports/reports-attendance.php"); </script>';
                                }
                                    if($deductions_total_result = mysqli_query($con, $deductions_total))
                                    $deductions_result = mysqli_fetch_assoc($deductions_total_result);
                                    ?>
                                    <h3 class="deliveries">Deductions</h3>
                                    <span class="total-deliveries"><?php echo 'Php '.$deductions_result['total'];?></span>
                                </div>
                            </div>  
                            <div class="newUser-button4"> 
                                <div id="add-userbutton" class="add-account4">
                                <?php
                                $payroll_total = "";
                                if(isset($_GET['view']) && !isset($_GET['month']) && !isset($_GET['year'])) {
                                    $date = $_GET['view'];
                                    $payroll_total = "SELECT 
                                    SUM(attendance.total_amount) as total
                                    FROM attendance
                                    WHERE attendance.status_archive_id = 1
                                    AND attendance.payroll_status = 1
                                    AND attendance.date = '$date'";
                                } else if (!isset($_GET['view']) && isset($_GET['month']) && isset($_GET['year'])) {
                                    $month = $_GET['month'];
                                    $year = $_GET['year'];
                                    $payroll_total = "SELECT 
                                    SUM(attendance.total_amount) as total
                                    FROM attendance
                                    WHERE attendance.status_archive_id = 1
                                    AND attendance.payroll_status = 1
                                    AND MONTHNAME(attendance.date) = '$month'
                                    AND YEAR(attendance.date) = '$year'";
                                } else if (!isset($_GET['view']) && !isset($_GET['month']) && isset($_GET['year'])) {
                                    $year = $_GET['year'];
                                    $payroll_total = "SELECT
                                    SUM(attendance.total_amount) as total
                                    FROM attendance
                                    WHERE attendance.status_archive_id = 1
                                    AND attendance.payroll_status = 1
                                    AND YEAR(attendance.date) = '$year'";
                                } else {
                                    echo '<script> location.replace("../reports/reports-attendance.php"); </script>';
                                }
                                    if($payroll_total_result = mysqli_query($con, $payroll_total))
                                    $payroll_result = mysqli_fetch_assoc($payroll_total_result);
                                    ?>
                                    <h3 class="deliveries">Payroll</h3>
                                    <span class="total-deliveries"><?php echo 'Php '.$payroll_result['total'];?></span>
                                </div>
                            </div>  
                            
                            <div class="bot-buttons">
                                    <div class="AddButton1">
                                        <button type="submit" id="addcustomerBtn" onclick="print();">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M15 6H5V3h10Zm-.25 4.5q.312 0 .531-.219.219-.219.219-.531 0-.312-.219-.531Q15.062 9 14.75 9q-.312 0-.531.219Q14 9.438 14 9.75q0 .312.219.531.219.219.531.219Zm-1.25 5v-3h-7v3ZM15 17H5v-3H2V9q0-.833.583-1.417Q3.167 7 4 7h12q.833 0 1.417.583Q18 8.167 18 9v5h-3Z"/></svg>
                                            PRINT
                                        </button>
                                    </div>
                            </div>
                        </div>
                        </div>
                </div>
                <div class="customer-container">
                    <table class="table" id="myTable">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee Name</th>
                            <th>Deduction</th>
                            <th>Bonus</th>
                            <th>Payroll Amount</th>
                        </tr>
                        </thead>

                        <?php
                        $query = "";
                        if(isset($_GET['view']) && !isset($_GET['month']) && !isset($_GET['year'])) {
                            $date = $_GET['view'];
                            $query = "SELECT 
                                attendance.date,
                                attendance.deduction,
                                attendance.bonus, 
                                attendance.total_amount,
                                employee.first_name as emp_first_name,
                                employee.last_name as emp_last_name,
                                employee.middle_name as emp_middle_name
                                FROM attendance 
                                INNER JOIN employee 
                                ON attendance.employee_id = employee.id
                                WHERE attendance.status_archive_id = 1
                                AND attendance.payroll_status = 1
                                AND attendance.date = '$date'
                                ORDER BY attendance.date DESC
                                LIMIT $start_from, $per_page_record";
                        } else if (!isset($_GET['view']) && isset($_GET['month']) && isset($_GET['year'])) {
                            $month = $_GET['month'];
                            $year = $_GET['year'];
                            $query = "SELECT 
                                    attendance.date,
                                    attendance.deduction,
                                    attendance.bonus, 
                                    attendance.total_amount,
                                    employee.first_name as emp_first_name,
                                    employee.last_name as emp_last_name,
                                    employee.middle_name as emp_middle_name
                                    FROM attendance 
                                    INNER JOIN employee 
                                    ON attendance.employee_id = employee.id
                                    WHERE attendance.status_archive_id = 1
                                    AND attendance.payroll_status = 1
                                    AND MONTHNAME(attendance.date) = '$month'
                                    AND YEAR(attendance.date) = '$year'
                                    ORDER BY attendance.date DESC
                                    LIMIT $start_from, $per_page_record";
                        } else if (!isset($_GET['view']) && !isset($_GET['month']) && isset($_GET['year'])) {
                            $year = $_GET['year'];
                            $query = "SELECT 
                                    attendance.date,
                                    attendance.deduction,
                                    attendance.bonus, 
                                    attendance.total_amount,
                                    employee.first_name as emp_first_name,
                                    employee.last_name as emp_last_name,
                                    employee.middle_name as emp_middle_name
                                    FROM attendance 
                                    INNER JOIN employee 
                                    ON attendance.employee_id = employee.id
                                    WHERE attendance.status_archive_id = 1
                                    AND attendance.payroll_status = 1
                                    AND YEAR(attendance.date) = '$year'
                                    ORDER BY attendance.date DESC
                                    LIMIT $start_from, $per_page_record";
                        } else {
                            echo '<script> location.replace("../reports/reports-attendance.php"); </script>';
                        }
                        
                        $result = mysqli_query($con, $query);

                        if(mysqli_num_rows($result) <= 0) { ?>
                        <tbody>
                        <tr id="noRecordTR">
                                <td colspan="5">No Record Found</td>
                        </tr>
                        </tbody>
                        <?php } else {
                            while ($rows = mysqli_fetch_assoc($result)) { ?>
                            <tbody>
                            <tr>
                                <td>
                                    <?php echo $rows['date']; ?>
                                </td>
                                <td>
                                     <?php echo $rows['emp_first_name'].' '.$rows['emp_last_name']; ?>
                                </td>
                                <td>
                                     <?php echo $rows['deduction']; ?>
                                </td>
                                <td>
                                    <?php echo $rows['bonus']; ?>
                                </td>
                                <td>
                                     <?php echo 'PHP ' . $rows['total_amount']; ?>
                                </td>       
                            </tr>
                            </tbody>
                        <?php }} ?>
                    </table>
                </div>
            </div>
            <div class="header-title">
                <p class="address">CREATED BY: <?php echo ' '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name']; ?><p>
                <p class="address">DATE: <?php echo date("F j, Y")?> - TIME:<?php echo date("h-i-s-A")?><p>
            </div>

            <div class="pagination">   
            <br>
                <?php  
                if($total_records > 0) {

                    // Number of pages required.   
                    $total_pages = ceil($total_records / $per_page_record);     
                    $pageLink = "";       
                    if($page>=2){   
                        echo "<a href='".$page_location."&page=".($page-1)."&records=".$per_page_record."'> Prev </a>";   
                    }       
                            
                    for ($i=1; $i<=$total_pages; $i++) {   
                    if ($i == $page) {   
                        $pageLink .= "<a class = 'active' href='".$page_location."&page=".$i."&records=".$per_page_record."'>".$i." </a>";   
                    }               
                    else  {   
                        $pageLink .= "<a href='".$page_location."&page=".$i."&records=".$per_page_record."'>".$i." </a>";     
                    }   
                    }; 

                    echo $pageLink;   

                    if($page<$total_pages){   
                        echo "<a href='".$page_location."&page=".($page + 1)."&records=".$per_page_record."'>  Next </a>";   
                    }  
               

                ?>


                <br><br>
                <select name="option" onchange="location ='<?php echo $page_location ?>' + '&page=1&records=' + this.value;">
                        <option value="5" <?php if($per_page_record == "5") { echo 'selected'; }?>>5</option>
                        <option value="10" <?php if($per_page_record == "10") { echo 'selected'; }?>>10</option>
                        <option value="50" <?php if($per_page_record == "50") { echo 'selected'; }?>>50</option>
                        <option value="100" <?php if($per_page_record == "100") { echo 'selected'; }?>>100</option>
                        <option value="250" <?php if($per_page_record == "250") { echo 'selected'; }?>>250</option>
                        <option value="500" <?php if($per_page_record == "500") { echo 'selected'; }?>>500</option>
                        <option value="1000" <?php if($per_page_record == "1000") { echo 'selected'; }?>>1000</option>
                </select>
                <span> No. of Records Per Page </span>  
                
            </div>
           

            <div></div>

            <div class="inline">   
                <input id="page" type="number" min="1" max="<?php echo $total_pages?>"   
                placeholder="<?php echo $page."/".$total_pages; ?>" required> 

                <button onClick="goToPage('<?php echo $page_location.'&records='.$per_page_record?>');">Go to page</button>   
            </div>    
            <?php }?>
    </main>
    <?php
    include('../common/top-menu.php')
    ?>

</div>
</body>
</html>
<script>
    function goToPage(reference) {   
    var page = document.getElementById("page").value;   
    page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
    window.location.href = reference + '&page=' + page;   
} 
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/reports-sales.js"></script>
<script src="../index.js"></script>
