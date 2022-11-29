<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="../CSS/common.css">
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/galhau-display" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/malberg-trial" rel="stylesheet">
    <title>Tag's Water Purified Drinking Water</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
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
            <div id="dashboard" class="item">
                <a href="../common/dashboard.php"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M13 9V3h8v6ZM3 13V3h8v10Zm10 8V11h8v10ZM3 21v-6h8v6Z"/></svg>
                    DASHBOARDs</a></div>
            <div id="pointofsales" class="item">
                <a href="../pos/Pointofsales.php"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M7 8q-.825 0-1.412-.588Q5 6.825 5 6V4q0-.825.588-1.413Q6.175 2 7 2h10q.825 0 1.413.587Q19 3.175 19 4v2q0 .825-.587 1.412Q17.825 8 17 8Zm0-2h10V4H7v2ZM4 22q-.825 0-1.412-.587Q2 20.825 2 20v-1h20v1q0 .825-.587 1.413Q20.825 22 20 22Zm-2-4 3.475-7.825q.25-.55.738-.863Q6.7 9 7.3 9h9.4q.6 0 1.088.312.487.313.737.863L22 18Zm6.5-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35Q9.7 15 9.5 15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35Q9.7 13 9.5 13h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35Q9.7 11 9.5 11h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm3 4h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm3 4h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Z"/></svg>
                    POINT OF SALES</a></div>
            <div id="reports" class="item">
                <a class="sub-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M2 21V3h10v4h10v14Zm2-2h6v-2H4Zm0-4h6v-2H4Zm0-4h6V9H4Zm0-4h6V5H4Zm8 12h8V9h-8Zm2-6v-2h4v2Zm0 4v-2h4v2Z"/></svg>
                    REPORTS<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <a href="Reports-sales.php" class="sub-item">Sales</a>
                    <a href="Reports-deliverywalkin.php" class="sub-item">Delivery/Walk-in</a>
                    <a href="Reports-datalogs.php" class="sub-item">Data Logs</a>
                    <a href="Reports-inventory.php" class="sub-item">Inventory</a>
                    <a href="Reports-itemissue.php" class="sub-item">Item Issue</a>
                    <a href="Reports-inventory.php" class="sub-item">Attendance</a>
                    <a href="Reports-expense.php" class="sub-item">Expense</a>
                </div>
            </div>
            <div id="monitoring" class="item">
                <a class="sub-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M3 21v-2l2-2v4Zm4 0v-6l2-2v8Zm4 0v-8l2 2.025V21Zm4 0v-5.975l2-2V21Zm4 0V11l2-2v12ZM3 15.825V13l7-7 4 4 7-7v2.825l-7 7-4-4Z"/></svg>
                    MONITORING<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <a href="Monitoring-deliverypickup.php" class="sub-item">Delivery/Pick Up</a>
                    <a href="Monitoring-returncontainer.php" class="sub-item">Return Container</a>
                    <a href="Monitoring-customerbalance.php" class="sub-item">Customer Balance</a>
                    <a href="Monitoring-scheduling.php" class="sub-item">Scheduling</a>
                    <a href="Monitoring-itemhistory.php" class="sub-item">Item History</a>
                </div>
            </div>
            <div id="customer" class="item">
                <a href="../customers/customer.php"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M1 20v-2.8q0-.85.438-1.563.437-.712 1.162-1.087 1.55-.775 3.15-1.163Q7.35 13 9 13t3.25.387q1.6.388 3.15 1.163.725.375 1.162 1.087Q17 16.35 17 17.2V20Zm18 0v-3q0-1.1-.612-2.113-.613-1.012-1.738-1.737 1.275.15 2.4.512 1.125.363 2.1.888.9.5 1.375 1.112Q23 16.275 23 17v3ZM9 12q-1.65 0-2.825-1.175Q5 9.65 5 8q0-1.65 1.175-2.825Q7.35 4 9 4q1.65 0 2.825 1.175Q13 6.35 13 8q0 1.65-1.175 2.825Q10.65 12 9 12Zm10-4q0 1.65-1.175 2.825Q16.65 12 15 12q-.275 0-.7-.062-.425-.063-.7-.138.675-.8 1.037-1.775Q15 9.05 15 8q0-1.05-.363-2.025Q14.275 5 13.6 4.2q.35-.125.7-.163Q14.65 4 15 4q1.65 0 2.825 1.175Q19 6.35 19 8ZM3 18h12v-.8q0-.275-.137-.5-.138-.225-.363-.35-1.35-.675-2.725-1.013Q10.4 15 9 15t-2.775.337Q4.85 15.675 3.5 16.35q-.225.125-.362.35-.138.225-.138.5Zm6-8q.825 0 1.413-.588Q11 8.825 11 8t-.587-1.412Q9.825 6 9 6q-.825 0-1.412.588Q7 7.175 7 8t.588 1.412Q8.175 10 9 10Zm0 8ZM9 8Z"/></svg>
                    CUSTOMER</a></div>
            <div id="inventory" class="item">
                <a class="sub-btn"> <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M11 21H5q-.825 0-1.413-.587Q3 19.825 3 19V5q0-.825.587-1.413Q4.175 3 5 3h4.175q.275-.875 1.075-1.438Q11.05 1 12 1q1 0 1.788.562.787.563 1.062 1.438H19q.825 0 1.413.587Q21 4.175 21 5v5h-2V5h-2v3H7V5H5v14h6Zm4.5-1.075-4.25-4.25 1.4-1.4 2.85 2.85 5.65-5.65 1.4 1.4ZM12 5q.425 0 .713-.288Q13 4.425 13 4t-.287-.713Q12.425 3 12 3t-.712.287Q11 3.575 11 4t.288.712Q11.575 5 12 5Z"/></svg>
                    INVENTORY<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <a href="../inventory/inventory-stocks.php" class="sub-item" id="inventory-stocks">Stocks</a>
                    <a href="../inventory/inventory-details.php" class="sub-item" id="inventory-details">Item</a>
                </div>
            </div>
            <div id="employee" class="item">
                <a class="sub-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M4 22q-.825 0-1.412-.587Q2 20.825 2 20V9q0-.825.588-1.413Q3.175 7 4 7h5V4q0-.825.588-1.413Q10.175 2 11 2h2q.825 0 1.413.587Q15 3.175 15 4v3h5q.825 0 1.413.587Q22 8.175 22 9v11q0 .825-.587 1.413Q20.825 22 20 22Zm2-4h6v-.45q0-.425-.238-.788-.237-.362-.662-.562-.5-.225-1.012-.337Q9.575 15.75 9 15.75q-.575 0-1.087.113-.513.112-1.013.337-.425.2-.662.562Q6 17.125 6 17.55Zm8-1.5h4V15h-4ZM9 15q.625 0 1.062-.438.438-.437.438-1.062t-.438-1.062Q9.625 12 9 12t-1.062.438Q7.5 12.875 7.5 13.5t.438 1.062Q8.375 15 9 15Zm5-1.5h4V12h-4ZM11 9h2V4h-2Z"/></svg>
                    EMPLOYEE<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <a href="Employee-attendance.php" class="sub-item" id="employee-attendance">Attendance</a>
                    <a href="Employee-details.php" class="sub-item" id="employee-details">Employee List</a>
                    <a href="Employee-payroll.php" class="sub-item" id="employee-payroll">Payroll</a>
                </div>
            </div>
            <div id="expense" class="item">
                <a class="sub-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M3 20q-.825 0-1.412-.587Q1 18.825 1 18V7h2v11h17v2Zm4-4q-.825 0-1.412-.588Q5 14.825 5 14V6q0-.825.588-1.412Q6.175 4 7 4h14q.825 0 1.413.588Q23 5.175 23 6v8q0 .825-.587 1.412Q21.825 16 21 16Zm2-2q0-.825-.588-1.413Q7.825 12 7 12v2Zm10 0h2v-2q-.825 0-1.413.587Q19 13.175 19 14Zm-5-1q1.25 0 2.125-.875T17 10q0-1.25-.875-2.125T14 7q-1.25 0-2.125.875T11 10q0 1.25.875 2.125T14 13ZM7 8q.825 0 1.412-.588Q9 6.825 9 6H7Zm14 0V6h-2q0 .825.587 1.412Q20.175 8 21 8Z"/></svg>
                    EXPENSE<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <a href="Expense-expense.php" class="sub-item">Expense</a>
                    <a href="Expense-employeesalary.php" class="sub-item">Employee Salary</a>
                </div>
            </div>
            <div id="account" class="item">
                <a class="sub-btn"> <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M10 12q-1.65 0-2.825-1.175Q6 9.65 6 8q0-1.65 1.175-2.825Q8.35 4 10 4q1.65 0 2.825 1.175Q14 6.35 14 8q0 1.65-1.175 2.825Q11.65 12 10 12Zm-8 8v-2.8q0-.85.425-1.563.425-.712 1.175-1.087 1.5-.75 3.113-1.15Q8.325 13 10 13h.338q.162 0 .312.05-.725 1.725-.588 3.563Q10.2 18.45 11.25 20Zm14 1-.3-1.5q-.3-.125-.563-.262-.262-.138-.537-.338l-1.45.45-1-1.7 1.15-1q-.05-.35-.05-.65 0-.3.05-.65l-1.15-1 1-1.7 1.45.45q.275-.2.537-.338.263-.137.563-.262L16 11h2l.3 1.5q.3.125.563.275.262.15.537.375l1.45-.5 1 1.75-1.15 1q.05.3.05.625t-.05.625l1.15 1-1 1.7-1.45-.45q-.275.2-.537.338-.263.137-.563.262L18 21Zm1-3q.825 0 1.413-.587Q19 16.825 19 16q0-.825-.587-1.413Q17.825 14 17 14q-.825 0-1.412.587Q15 15.175 15 16q0 .825.588 1.413Q16.175 18 17 18Z"/></svg>
                    ACCOUNT<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <a href="../accounts/account-type.php" class="sub-item" id="account-type">Account Type</a>
                    <a href="../accounts/account.php" class="sub-item" id="accounts">User Account</a>
                </div>
            </div>
            <div id="settings" class="item">
                <a class="sub-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="m9.25 22-.4-3.2q-.325-.125-.612-.3-.288-.175-.563-.375L4.7 19.375l-2.75-4.75 2.575-1.95Q4.5 12.5 4.5 12.337v-.675q0-.162.025-.337L1.95 9.375l2.75-4.75 2.975 1.25q.275-.2.575-.375.3-.175.6-.3l.4-3.2h5.5l.4 3.2q.325.125.613.3.287.175.562.375l2.975-1.25 2.75 4.75-2.575 1.95q.025.175.025.337v.675q0 .163-.05.338l2.575 1.95-2.75 4.75-2.95-1.25q-.275.2-.575.375-.3.175-.6.3l-.4 3.2Zm2.8-6.5q1.45 0 2.475-1.025Q15.55 13.45 15.55 12q0-1.45-1.025-2.475Q13.5 8.5 12.05 8.5q-1.475 0-2.488 1.025Q8.55 10.55 8.55 12q0 1.45 1.012 2.475Q10.575 15.5 12.05 15.5Z"/></svg>
                    SETTINGS<i class="fas fa-angle-right dropdown"></i></a>
                <div class="sub-menu">
                    <a href="Settings-help.php" class="sub-item" id="settings-help">Help</a>
                    <a href="Settings-datalogs.php" class="sub-item" id="settings-datalogs">Data Logs</a>
                    <a href="../settings/Settings-dataarchive.php" class="sub-item" id="settings-dataarchive">Archive</a>
                    <a href="Settings-databackup-customers.php" class="sub-item" id="settings-databackup">Backup/Restore</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<!-- <script src="./index.js"></script> -->
<script src="javascript/common.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/d3js/7.6.1/d3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</html>
