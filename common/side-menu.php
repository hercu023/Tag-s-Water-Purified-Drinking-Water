<?php
require_once '../database/connection-db.php';
require_once "../service/user-access.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <!-- <link rel="stylesheet" type="text/css" href="../CSS/common.css"> -->
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/galhau-display" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/malberg-trial" rel="stylesheet">
    <title>Tag's Water Purified Drinking Water</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
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
/* -----------------------------------------------Side Menu---------------------------------------- */
.side-bar{
    background: var(--color-table-hover);
    backdrop-filter: blur(15px);
    width: 15.5rem;
    height: 100vh;
    font-family: 'cocogoose', sans-serif;
    position: fixed;
    top: 0;
    display: block;
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
    color: var(--color-solid-gray);
    fill: var(--color-solid-gray);
    font-size: 13px;
    text-decoration: none;
    display: flex;
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
    color: var(--color-solid-gray);
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
.main{
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 50px;
}

.main h1{
    color: rgba(255, 255, 255, 0.8);
    font-size: 60px;
    text-align: center;
    line-height: 80px;
}

/* ----------------------------------------Top bar menu----------------------------------------  */

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
}
@media screen and (max-width: 1200px){
    .container{
        width: 94%;
        grid-template-columns: 1rem auto;
    }
    .main-dashboard{
        position: relative;
    }
}

 @media screen and (max-width: 768px){

        .menu-btn2{
            display: flex;
        }
    
    }

</style>
<body>
<div class="menu">
    <div class="menu-btn">
        <i class="fas fa-bars"></i>
    </div>
    <div class="side-bar">
        <div class="close-btn">
            <i class="fas fa-times"></i>
        </div>
        <div class="menu">
            <div class="title">
                <div class="titlelogo">
                    <img class="tagslogo" src="../Pictures and Icons/tags logo.png" >
                </div>
                <div class="close" id="close-btn" onclick="myFunctionhp(this)">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M6.4 19 5 17.6l5.6-5.6L5 6.4 6.4 5l5.6 5.6L17.6 5 19 6.4 13.4 12l5.6 5.6-1.4 1.4-5.6-5.6Z"/></svg>
                </div>
            </div>
            <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'DASHBOARD')) {?>
                <div id="dashboard" class="item">
                    <a href="../common/dashboard.php"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M13 9V3h8v6ZM3 13V3h8v10Zm10 8V11h8v10ZM3 21v-6h8v6Z"/></svg>
                        DASHBOARD</a></div>
            <?php } ?>
            <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'POS')) {?>
                <div id="pointofsales" class="item">
                    <a href="../pos/point-of-sales.php"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M7 8q-.825 0-1.412-.588Q5 6.825 5 6V4q0-.825.588-1.413Q6.175 2 7 2h10q.825 0 1.413.587Q19 3.175 19 4v2q0 .825-.587 1.412Q17.825 8 17 8Zm0-2h10V4H7v2ZM4 22q-.825 0-1.412-.587Q2 20.825 2 20v-1h20v1q0 .825-.587 1.413Q20.825 22 20 22Zm-2-4 3.475-7.825q.25-.55.738-.863Q6.7 9 7.3 9h9.4q.6 0 1.088.312.487.313.737.863L22 18Zm6.5-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35Q9.7 15 9.5 15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35Q9.7 13 9.5 13h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35Q9.7 11 9.5 11h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm3 4h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm3 4h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Z"/></svg>
                        POINT OF SALES</a></div>
            <?php } ?>

            <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'MONITORING-DELIVERY_PICKUP')
                || get_user_access_per_module($con, $_SESSION['user_user_type'], 'MONITORING-RETURN_CONTAINER')
                || get_user_access_per_module($con, $_SESSION['user_user_type'], 'MONITORING-CUSTOMER_BALANCE')
                || get_user_access_per_module($con, $_SESSION['user_user_type'], 'MONITORING-SCHEDULING')
                || get_user_access_per_module($con, $_SESSION['user_user_type'], 'MONITORING-ITEM_HISTORY')) { ?>
                <div id="monitoring" class="item">
                    <a class="sub-btn"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.5 17q-.625 0-1.062-.438Q3 16.125 3 15.5v-11q0-.625.438-1.062Q3.875 3 4.5 3h11q.625 0 1.062.438Q17 3.875 17 4.5v11q0 .625-.438 1.062Q16.125 17 15.5 17Zm0-1.5h11V6h-11v9.5Zm5.5-1.75q-1.542 0-2.75-.844T5.5 10.75q.542-1.312 1.75-2.156Q8.458 7.75 10 7.75t2.75.844q1.208.844 1.75 2.156-.542 1.312-1.75 2.156-1.208.844-2.75.844Zm0-1q1.104 0 2-.531.896-.531 1.396-1.469-.5-.938-1.396-1.469-.896-.531-2-.531t-2 .531q-.896.531-1.396 1.469.5.938 1.396 1.469.896.531 2 .531Zm0-.75q-.521 0-.885-.365-.365-.364-.365-.885t.365-.885Q9.479 9.5 10 9.5t.885.365q.365.364.365.885t-.365.885Q10.521 12 10 12Z"/></svg>
                        MONITORING<i class="fas fa-angle-right dropdown"></i></a>
                    <div class="sub-menu">
                        <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'MONITORING-POINT_OF_SALES_TRANSACTION')) {?>
                            <a href="../monitoring/monitoring-point-of-sales-transaction.php" class="sub-item">POS Transaction</a>
                        <?php } ?>
                        <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'MONITORING-DELIVERY_PICKUP')) {?>
                            <a href="../monitoring/monitoring-delivery-pickup.php" class="sub-item">Delivery/Pick Up</a>
                        <?php } ?>
                        <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'MONITORING-CUSTOMER_BALANCE')) {?>
                            <a href="../monitoring/monitoring-customer-balance.php" class="sub-item">Customer Balance</a>
                        <?php } ?>
                        <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'MONITORING-SCHEDULING')) {?>
                            <a href="../monitoring/monitoring-scheduling.php" class="sub-item">Scheduling</a>
                        <?php } ?>
                        <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'MONITORING-ITEM_HISTORY')) {?>
                            <a href="../monitoring/monitoring-item-history.php" class="sub-item">Item History</a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
                            
            <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'INVENTORY-STOCKS')
                || get_user_access_per_module($con, $_SESSION['user_user_type'], 'INVENTORY-ITEM')) { ?>
                <div id="inventory" class="item">
                    <a class="sub-btn"> <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M11 21H5q-.825 0-1.413-.587Q3 19.825 3 19V5q0-.825.587-1.413Q4.175 3 5 3h4.175q.275-.875 1.075-1.438Q11.05 1 12 1q1 0 1.788.562.787.563 1.062 1.438H19q.825 0 1.413.587Q21 4.175 21 5v5h-2V5h-2v3H7V5H5v14h6Zm4.5-1.075-4.25-4.25 1.4-1.4 2.85 2.85 5.65-5.65 1.4 1.4ZM12 5q.425 0 .713-.288Q13 4.425 13 4t-.287-.713Q12.425 3 12 3t-.712.287Q11 3.575 11 4t.288.712Q11.575 5 12 5Z"/></svg>
                        INVENTORY<i class="fas fa-angle-right dropdown"></i></a>
                    <div class="sub-menu">
                        <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'INVENTORY-STOCKS')) {?>
                            <a href="../inventory/inventory-stocks.php" class="sub-item" id="inventory-stocks">Stocks</a>
                        <?php } ?>
                        <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'INVENTORY-ITEM')) {?>
                            <a href="../inventory/inventory-details.php" class="sub-item" id="inventory-details">Item Master Data</a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            
            <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'REPORTS-SALES')
                || get_user_access_per_module($con, $_SESSION['user_user_type'], 'REPORTS-DELIVERY')
                || get_user_access_per_module($con, $_SESSION['user_user_type'], 'REPORTS-INVENTORY')
                || get_user_access_per_module($con, $_SESSION['user_user_type'], 'REPORTS-ITEM_ISSUE')
                || get_user_access_per_module($con, $_SESSION['user_user_type'], 'REPORTS-ATTENDANCE')
                || get_user_access_per_module($con, $_SESSION['user_user_type'], 'REPORTS-EXPENSE')) { ?>

            <div id="reports" class="item">
                <a class="sub-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M2 21V3h10v4h10v14Zm2-2h6v-2H4Zm0-4h6v-2H4Zm0-4h6V9H4Zm0-4h6V5H4Zm8 12h8V9h-8Zm2-6v-2h4v2Zm0 4v-2h4v2Z"/></svg>
                    REPORTS<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'REPORTS-SALES')) {
                        echo '<a href="../reports/reports-sales.php" class="sub-item">Sales</a>';
                    }
                    ?>
                    <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'REPORTS-DELIVERY')) {
                        echo '<a href="../reports/reports-delivery.php" class="sub-item">Delivery</a>';
                    }
                    ?>
                    <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'REPORTS-INVENTORY')) {
                        echo '<a href="../reports/reports-inventory.php" class="sub-item">Inventory</a>';
                    }
                    ?>
                    <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'REPORTS-ITEM_ISSUE')) {
                        echo '<a href="../reports/reports-item-issue.php" class="sub-item">Item Issue</a>';
                    }
                    ?>
                    <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'REPORTS-ATTENDANCE')) {
                        echo '<a href="../reports/reports-attendance.php" class="sub-item">Attendance</a>';
                    }
                    ?>
                    <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'REPORTS-EXPENSE')) {
                        echo '<a href="../reports/reports-expense.php" class="sub-item">Expenses</a>';
                    }
                    ?>
                </div>
            </div>
            <?php } ?>




          

            <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'CUSTOMER')) { ?>
                <div id="customer" class="item">
                    <a href="../customers/customer.php"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M1 20v-2.8q0-.85.438-1.563.437-.712 1.162-1.087 1.55-.775 3.15-1.163Q7.35 13 9 13t3.25.387q1.6.388 3.15 1.163.725.375 1.162 1.087Q17 16.35 17 17.2V20Zm18 0v-3q0-1.1-.612-2.113-.613-1.012-1.738-1.737 1.275.15 2.4.512 1.125.363 2.1.888.9.5 1.375 1.112Q23 16.275 23 17v3ZM9 12q-1.65 0-2.825-1.175Q5 9.65 5 8q0-1.65 1.175-2.825Q7.35 4 9 4q1.65 0 2.825 1.175Q13 6.35 13 8q0 1.65-1.175 2.825Q10.65 12 9 12Zm10-4q0 1.65-1.175 2.825Q16.65 12 15 12q-.275 0-.7-.062-.425-.063-.7-.138.675-.8 1.037-1.775Q15 9.05 15 8q0-1.05-.363-2.025Q14.275 5 13.6 4.2q.35-.125.7-.163Q14.65 4 15 4q1.65 0 2.825 1.175Q19 6.35 19 8ZM3 18h12v-.8q0-.275-.137-.5-.138-.225-.363-.35-1.35-.675-2.725-1.013Q10.4 15 9 15t-2.775.337Q4.85 15.675 3.5 16.35q-.225.125-.362.35-.138.225-.138.5Zm6-8q.825 0 1.413-.588Q11 8.825 11 8t-.587-1.412Q9.825 6 9 6q-.825 0-1.412.588Q7 7.175 7 8t.588 1.412Q8.175 10 9 10Zm0 8ZM9 8Z"/></svg>
                        CUSTOMER</a></div>
            <?php } ?>

    

            <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'EMPLOYEE-ATTENDANCE')
                || get_user_access_per_module($con, $_SESSION['user_user_type'], 'EMPLOYEE-LIST')) { ?>
                <div id="employee" class="item">
                    <a class="sub-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M4 22q-.825 0-1.412-.587Q2 20.825 2 20V9q0-.825.588-1.413Q3.175 7 4 7h5V4q0-.825.588-1.413Q10.175 2 11 2h2q.825 0 1.413.587Q15 3.175 15 4v3h5q.825 0 1.413.587Q22 8.175 22 9v11q0 .825-.587 1.413Q20.825 22 20 22Zm2-4h6v-.45q0-.425-.238-.788-.237-.362-.662-.562-.5-.225-1.012-.337Q9.575 15.75 9 15.75q-.575 0-1.087.113-.513.112-1.013.337-.425.2-.662.562Q6 17.125 6 17.55Zm8-1.5h4V15h-4ZM9 15q.625 0 1.062-.438.438-.437.438-1.062t-.438-1.062Q9.625 12 9 12t-1.062.438Q7.5 12.875 7.5 13.5t.438 1.062Q8.375 15 9 15Zm5-1.5h4V12h-4ZM11 9h2V4h-2Z"/></svg>
                        EMPLOYEE<i class="fas fa-angle-right dropdown"></i></a>
                    <div class="sub-menu">
                        <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'EMPLOYEE-ATTENDANCE')) {?>
                            <a href="../employee/employee-attendance.php" class="sub-item" id="employee-attendance">Attendance/Payroll  </a>
                        <?php } ?>
                        <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'EMPLOYEE-LIST')) {?>
                            <a href="../employee/employee-list.php" class="sub-item" id="employee-details">Employee List</a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

            <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'EXPENSE')) {?>
                <div id="expense" class="item">
                    <a href="../expense/expense.php"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M3 20q-.825 0-1.412-.587Q1 18.825 1 18V7h2v11h17v2Zm4-4q-.825 0-1.412-.588Q5 14.825 5 14V6q0-.825.588-1.412Q6.175 4 7 4h14q.825 0 1.413.588Q23 5.175 23 6v8q0 .825-.587 1.412Q21.825 16 21 16Zm2-2q0-.825-.588-1.413Q7.825 12 7 12v2Zm10 0h2v-2q-.825 0-1.413.587Q19 13.175 19 14Zm-5-1q1.25 0 2.125-.875T17 10q0-1.25-.875-2.125T14 7q-1.25 0-2.125.875T11 10q0 1.25.875 2.125T14 13ZM7 8q.825 0 1.412-.588Q9 6.825 9 6H7Zm14 0V6h-2q0 .825.587 1.412Q20.175 8 21 8Z"/></svg>
                        EXPENSES</a></div>
            <?php } ?>

            <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'ACCOUNT-ACCOUNT_TYPE')
                || get_user_access_per_module($con, $_SESSION['user_user_type'], 'ACCOUNT-USER_ACCOUNT')) { ?>
                <div id="account" class="item">
                    <a class="sub-btn"> <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M10 12q-1.65 0-2.825-1.175Q6 9.65 6 8q0-1.65 1.175-2.825Q8.35 4 10 4q1.65 0 2.825 1.175Q14 6.35 14 8q0 1.65-1.175 2.825Q11.65 12 10 12Zm-8 8v-2.8q0-.85.425-1.563.425-.712 1.175-1.087 1.5-.75 3.113-1.15Q8.325 13 10 13h.338q.162 0 .312.05-.725 1.725-.588 3.563Q10.2 18.45 11.25 20Zm14 1-.3-1.5q-.3-.125-.563-.262-.262-.138-.537-.338l-1.45.45-1-1.7 1.15-1q-.05-.35-.05-.65 0-.3.05-.65l-1.15-1 1-1.7 1.45.45q.275-.2.537-.338.263-.137.563-.262L16 11h2l.3 1.5q.3.125.563.275.262.15.537.375l1.45-.5 1 1.75-1.15 1q.05.3.05.625t-.05.625l1.15 1-1 1.7-1.45-.45q-.275.2-.537.338-.263.137-.563.262L18 21Zm1-3q.825 0 1.413-.587Q19 16.825 19 16q0-.825-.587-1.413Q17.825 14 17 14q-.825 0-1.412.587Q15 15.175 15 16q0 .825.588 1.413Q16.175 18 17 18Z"/></svg>
                        ACCOUNT<i class="fas fa-angle-right dropdown"></i></a>
                    <div class="sub-menu">
                        <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'ACCOUNT-ACCOUNT_TYPE')) {?>
                            <a href="../accounts/account-type.php" class="sub-item" id="account-type">Account Type</a>
                        <?php } ?>
                        <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'ACCOUNT-USER_ACCOUNT')) {?>
                            <a href="../accounts/account.php" class="sub-item" id="accounts">User Account</a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

            <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'SETTINGS-HELP')
                || get_user_access_per_module($con, $_SESSION['user_user_type'], 'SETTINGS-DATA_LOGS')
                || get_user_access_per_module($con, $_SESSION['user_user_type'], 'SETTINGS-ARCHIVES')
                || get_user_access_per_module($con, $_SESSION['user_user_type'], 'SETTINGS-BACKUP_RESTORE')
                || get_user_access_per_module($con, $_SESSION['user_user_type'], 'SETTINGS-DELIVERY_FEE')
                || get_user_access_per_module($con, $_SESSION['user_user_type'], 'SETTINGS-PAYROLL')) { ?>
            <div id="settings" class="item">
                <a class="sub-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="m9.25 22-.4-3.2q-.325-.125-.612-.3-.288-.175-.563-.375L4.7 19.375l-2.75-4.75 2.575-1.95Q4.5 12.5 4.5 12.337v-.675q0-.162.025-.337L1.95 9.375l2.75-4.75 2.975 1.25q.275-.2.575-.375.3-.175.6-.3l.4-3.2h5.5l.4 3.2q.325.125.613.3.287.175.562.375l2.975-1.25 2.75 4.75-2.575 1.95q.025.175.025.337v.675q0 .163-.05.338l2.575 1.95-2.75 4.75-2.95-1.25q-.275.2-.575.375-.3.175-.6.3l-.4 3.2Zm2.8-6.5q1.45 0 2.475-1.025Q15.55 13.45 15.55 12q0-1.45-1.025-2.475Q13.5 8.5 12.05 8.5q-1.475 0-2.488 1.025Q8.55 10.55 8.55 12q0 1.45 1.012 2.475Q10.575 15.5 12.05 15.5Z"/></svg>
                    SETTINGS<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'SETTINGS-HELP')) {?>
                    <a href="../settings/settings-help.php" class="sub-item" id="settings-help">Help</a>
                    <?php } ?>
                    <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'SETTINGS-DATA_LOGS')) {?>
                    <a href="../settings/settings-datalogs.php" class="sub-item">Data Logs</a>
                    <?php } ?>
                    <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'SETTINGS-ARCHIVES')) {?>
                    <a href="../settings/settings-data-archive.php" class="sub-item" id="settings-dataarchive">Archives</a>
                    <?php } ?>
                    <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'SETTINGS-BACKUP_RESTORE')) {?>
                    <a href="../settings/settings-databackup.php" class="sub-item" id="settings-databackup">Back Up/Restore</a>
                    <?php } ?>
                    <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'SETTINGS-DELIVERY_FEE')) {?>
                    <a href="../settings/settings-delivery-fee.php" class="sub-item" id="settings-databackup">Delivery Fee</a>
                    <?php } ?>
                    <?php if(get_user_access_per_module($con, $_SESSION['user_user_type'], 'SETTINGS-PAYROLL')) {?>
                    <a href="../settings/settings-payroll.php" class="sub-item" id="settings-databackup">Payroll</a>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script src="https://ajax.googleapis.com/ajax/libs/d3js/7.6.1/d3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</html>
