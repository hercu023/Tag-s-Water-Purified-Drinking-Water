<?php
require_once 'controllerUserdata.php';
include_once('connectionDB.php');
$query = "SELECT * FROM users";
$result = mysqli_query($con, $query);
    if (isset($_POST['user_id'])){

        $id = $_POST['user_id'];
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE user_id=?");
        $stmt->execute([$id]);
        $fetch_profile = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() === 1){
                $user = $stmt->fetch();
                
                $user_id = $user['user_id'];
                $user_email = $user['email'];
                $user_first_name = $user['first_name'];
                $user_user_type = $user['user_type'];
                $user_profile_image = $user['profile_image'];
                if ($email === $user_email){

                        $_SESSION['user_user_id'] = $user_id;
                        $_SESSION['user_email'] = $user_email;
                        $_SESSION['user_first_name'] =  $user_first_name;
                        $_SESSION['user_user_type'] =  $user_user_type;
                        $_SESSION['user_profile_image'] =  $user_profile_image;
                }
            }
        }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
        <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
        <link href="http://fonts.cdnfonts.com/css/galhau-display" rel="stylesheet">
        <link href="http://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
        <link href="http://fonts.cdnfonts.com/css/outfit" rel="stylesheet">
        <link href="http://fonts.cdnfonts.com/css/malberg-trial" rel="stylesheet">
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Tag's Water Purified Drinking Water</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
        <script src="./index.js"></script>
    </head>
    <body>
    
        <div class="container">
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
                        <img class="tagslogo" src="../Tag-s-Water-Purified-Drinking-Water/Pictures and Icons/tags logo.png" >
                    </div>
                    <div class="close" id="close-btn" onclick="myFunctionhp(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M6.4 19 5 17.6l5.6-5.6L5 6.4 6.4 5l5.6 5.6L17.6 5 19 6.4 13.4 12l5.6 5.6-1.4 1.4-5.6-5.6Z"/></svg>
                    </div>
                </div>
                    <div id="dashboard" class="item"><a href="Dashboard.php"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M13 9V3h8v6ZM3 13V3h8v10Zm10 8V11h8v10ZM3 21v-6h8v6Z"/></svg>
                    DASHBOARD</a></div>
                    <div id="pointofsales" class="item"><a href="Pointofsales.php"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M7 8q-.825 0-1.412-.588Q5 6.825 5 6V4q0-.825.588-1.413Q6.175 2 7 2h10q.825 0 1.413.587Q19 3.175 19 4v2q0 .825-.587 1.412Q17.825 8 17 8Zm0-2h10V4H7v2ZM4 22q-.825 0-1.412-.587Q2 20.825 2 20v-1h20v1q0 .825-.587 1.413Q20.825 22 20 22Zm-2-4 3.475-7.825q.25-.55.738-.863Q6.7 9 7.3 9h9.4q.6 0 1.088.312.487.313.737.863L22 18Zm6.5-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35Q9.7 15 9.5 15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35Q9.7 13 9.5 13h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35Q9.7 11 9.5 11h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm3 4h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm3 4h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Zm0-2h1q.2 0 .35-.15.15-.15.15-.35 0-.2-.15-.35-.15-.15-.35-.15h-1q-.2 0-.35.15-.15.15-.15.35 0 .2.15.35.15.15.35.15Z"/></svg>
                    POINT OF SALES</a></div>
                    <div id="reports" class="item"><a class="sub-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M2 21V3h10v4h10v14Zm2-2h6v-2H4Zm0-4h6v-2H4Zm0-4h6V9H4Zm0-4h6V5H4Zm8 12h8V9h-8Zm2-6v-2h4v2Zm0 4v-2h4v2Z"/></svg>
                    REPORTS<i class="fas fa-angle-right dropdown"></i></a>
                        <div class="sub-menu">
                            <a href="Reports-sales.php" class="sub-item">Sales</a>
                            <a href="Reports-deliverywalkin.php" class="sub-item">Delivery/Walk-in</a>
                            <a href="Reports-datalogs.php" class="sub-item" id="reports-datalogs">Data Logs</a>
                            <a href="Reports-inventory.php" class="sub-item" id="reports-inventory">Inventory</a>
                            <a href="Reports-itemissue.php" class="sub-item" id="reports-itemissue">Item Issue</a>
                            <a href="Reports-inventory.php" class="sub-item" id="reports-attendance">Attendance</a>
                            <a href="Reports-expense.php" class="sub-item" id="reports-expense">Expense</a>
                        </div>
                    </div>
                    <div id="monitoring" class="item"><a class="sub-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M3 21v-2l2-2v4Zm4 0v-6l2-2v8Zm4 0v-8l2 2.025V21Zm4 0v-5.975l2-2V21Zm4 0V11l2-2v12ZM3 15.825V13l7-7 4 4 7-7v2.825l-7 7-4-4Z"/></svg>
                    MONITORING<i class="fas fa-angle-right dropdown"></i></a>
                        <div class="sub-menu">
                            <a href="Monitoring-deliverypickup.php" class="sub-item" id="monitoring-deliverypickup">Delivery/Pick Up</a>
                            <a href="Monitoring-returncontainer.php" class="sub-item" id="monitoring-returncontainer">Return Container</a>
                            <a href="Monitoring-customerbalance.php" class="sub-item" id="monitoring-customerbalance">Customer Balance</a>
                            <a href="Monitoring-scheduling.php" class="sub-item" id="monitoring-scheduling">Scheduling</a>
                            <a href="Monitoring-itemhistory.php" class="sub-item" id="monitoring-itemhistory">Item History</a>
                        </div>
                    </div>
                    <div id="customer" class="item"><a href="Customer.php"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M1 20v-2.8q0-.85.438-1.563.437-.712 1.162-1.087 1.55-.775 3.15-1.163Q7.35 13 9 13t3.25.387q1.6.388 3.15 1.163.725.375 1.162 1.087Q17 16.35 17 17.2V20Zm18 0v-3q0-1.1-.612-2.113-.613-1.012-1.738-1.737 1.275.15 2.4.512 1.125.363 2.1.888.9.5 1.375 1.112Q23 16.275 23 17v3ZM9 12q-1.65 0-2.825-1.175Q5 9.65 5 8q0-1.65 1.175-2.825Q7.35 4 9 4q1.65 0 2.825 1.175Q13 6.35 13 8q0 1.65-1.175 2.825Q10.65 12 9 12Zm10-4q0 1.65-1.175 2.825Q16.65 12 15 12q-.275 0-.7-.062-.425-.063-.7-.138.675-.8 1.037-1.775Q15 9.05 15 8q0-1.05-.363-2.025Q14.275 5 13.6 4.2q.35-.125.7-.163Q14.65 4 15 4q1.65 0 2.825 1.175Q19 6.35 19 8ZM3 18h12v-.8q0-.275-.137-.5-.138-.225-.363-.35-1.35-.675-2.725-1.013Q10.4 15 9 15t-2.775.337Q4.85 15.675 3.5 16.35q-.225.125-.362.35-.138.225-.138.5Zm6-8q.825 0 1.413-.588Q11 8.825 11 8t-.587-1.412Q9.825 6 9 6q-.825 0-1.412.588Q7 7.175 7 8t.588 1.412Q8.175 10 9 10Zm0 8ZM9 8Z"/></svg>
                    CUSTOMER</a></div>
                    <div id="inventory" class="item"><a href="Inventory.php"> <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M11 21H5q-.825 0-1.413-.587Q3 19.825 3 19V5q0-.825.587-1.413Q4.175 3 5 3h4.175q.275-.875 1.075-1.438Q11.05 1 12 1q1 0 1.788.562.787.563 1.062 1.438H19q.825 0 1.413.587Q21 4.175 21 5v5h-2V5h-2v3H7V5H5v14h6Zm4.5-1.075-4.25-4.25 1.4-1.4 2.85 2.85 5.65-5.65 1.4 1.4ZM12 5q.425 0 .713-.288Q13 4.425 13 4t-.287-.713Q12.425 3 12 3t-.712.287Q11 3.575 11 4t.288.712Q11.575 5 12 5Z"/></svg>
                    INVENTORY</a></div>
                    <div id="employee" class="item"><a class="sub-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M4 22q-.825 0-1.412-.587Q2 20.825 2 20V9q0-.825.588-1.413Q3.175 7 4 7h5V4q0-.825.588-1.413Q10.175 2 11 2h2q.825 0 1.413.587Q15 3.175 15 4v3h5q.825 0 1.413.587Q22 8.175 22 9v11q0 .825-.587 1.413Q20.825 22 20 22Zm2-4h6v-.45q0-.425-.238-.788-.237-.362-.662-.562-.5-.225-1.012-.337Q9.575 15.75 9 15.75q-.575 0-1.087.113-.513.112-1.013.337-.425.2-.662.562Q6 17.125 6 17.55Zm8-1.5h4V15h-4ZM9 15q.625 0 1.062-.438.438-.437.438-1.062t-.438-1.062Q9.625 12 9 12t-1.062.438Q7.5 12.875 7.5 13.5t.438 1.062Q8.375 15 9 15Zm5-1.5h4V12h-4ZM11 9h2V4h-2Z"/></svg>
                    EMPLOYEE<i class="fas fa-angle-right dropdown"></i></a>
                        <div class="sub-menu">
                            <a href="Employee-details.php" class="sub-item" id="employee-details">Employee Details</a>
                            <a href="Employee-attendance.php" class="sub-item" id="employee-attendance" >Attendance</a>
                        </div>
                    </div>
                    <div id="expense" class="item"><a class="sub-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M3 20q-.825 0-1.412-.587Q1 18.825 1 18V7h2v11h17v2Zm4-4q-.825 0-1.412-.588Q5 14.825 5 14V6q0-.825.588-1.412Q6.175 4 7 4h14q.825 0 1.413.588Q23 5.175 23 6v8q0 .825-.587 1.412Q21.825 16 21 16Zm2-2q0-.825-.588-1.413Q7.825 12 7 12v2Zm10 0h2v-2q-.825 0-1.413.587Q19 13.175 19 14Zm-5-1q1.25 0 2.125-.875T17 10q0-1.25-.875-2.125T14 7q-1.25 0-2.125.875T11 10q0 1.25.875 2.125T14 13ZM7 8q.825 0 1.412-.588Q9 6.825 9 6H7Zm14 0V6h-2q0 .825.587 1.412Q20.175 8 21 8Z"/></svg>
                    EXPENSE<i class="fas fa-angle-right dropdown"></i></a>
                        <div class="sub-menu">
                            <a href="Expense-expense.php" class="sub-item" id="expense-expense">Expense</a>
                            <a href="Expense-employeesalary.php" class="sub-item" id="employee-salary">Employee Salary</a>
                        </div>
                    </div>
                    <div id="account" class="item"><a class="sub-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M10 12q-1.65 0-2.825-1.175Q6 9.65 6 8q0-1.65 1.175-2.825Q8.35 4 10 4q1.65 0 2.825 1.175Q14 6.35 14 8q0 1.65-1.175 2.825Q11.65 12 10 12Zm-8 8v-2.8q0-.85.425-1.563.425-.712 1.175-1.087 1.5-.75 3.113-1.15Q8.325 13 10 13h.338q.162 0 .312.05-.725 1.725-.588 3.563Q10.2 18.45 11.25 20Zm14 1-.3-1.5q-.3-.125-.563-.262-.262-.138-.537-.338l-1.45.45-1-1.7 1.15-1q-.05-.35-.05-.65 0-.3.05-.65l-1.15-1 1-1.7 1.45.45q.275-.2.537-.338.263-.137.563-.262L16 11h2l.3 1.5q.3.125.563.275.262.15.537.375l1.45-.5 1 1.75-1.15 1q.05.3.05.625t-.05.625l1.15 1-1 1.7-1.45-.45q-.275.2-.537.338-.263.137-.563.262L18 21Zm1-3q.825 0 1.413-.587Q19 16.825 19 16q0-.825-.587-1.413Q17.825 14 17 14q-.825 0-1.412.587Q15 15.175 15 16q0 .825.588 1.413Q16.175 18 17 18Z"/></svg>
                    ACCOUNT<i class="fas fa-angle-right dropdown"></i></a>
                        <div class="sub-menu">
                            <a href="Account-Type.php" class="sub-item" id="account-type">Account Type</a>
                            <a href="Account.php" class="sub-item" id="accounts">User Account</a>
                        </div>            
                    </div>
                    <div id="settings" class="item"><a class="sub-btn"><svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="m9.25 22-.4-3.2q-.325-.125-.612-.3-.288-.175-.563-.375L4.7 19.375l-2.75-4.75 2.575-1.95Q4.5 12.5 4.5 12.337v-.675q0-.162.025-.337L1.95 9.375l2.75-4.75 2.975 1.25q.275-.2.575-.375.3-.175.6-.3l.4-3.2h5.5l.4 3.2q.325.125.613.3.287.175.562.375l2.975-1.25 2.75 4.75-2.575 1.95q.025.175.025.337v.675q0 .163-.05.338l2.575 1.95-2.75 4.75-2.95-1.25q-.275.2-.575.375-.3.175-.6.3l-.4 3.2Zm2.8-6.5q1.45 0 2.475-1.025Q15.55 13.45 15.55 12q0-1.45-1.025-2.475Q13.5 8.5 12.05 8.5q-1.475 0-2.488 1.025Q8.55 10.55 8.55 12q0 1.45 1.012 2.475Q10.575 15.5 12.05 15.5Z"/></svg>
                    SETTINGS<i class="fas fa-angle-right dropdown"></i></a>
                        <div class="sub-menu">
                            <a href="Settings-help.php" class="sub-item" id="settings-help">Help</a>
                            <a href="Settings-dataarchive.php" class="sub-item" id="settings-dataarchive">Archive</a>
                            <a href="Settings-databackup.php" class="sub-item" id="settings-databackup">Backup/Restore</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <main>
                <div class="main-account">
                    <h1 class="accTitle">ACCOUNT</h1> 
                    <div class="sub-tab">
                        <div class="user-title"> 
                            <h2> User Account </h2>
                        </div>
                        <div class="newUser-button"> 
                            <button type="submit" id="add-userbutton" class="add-account" onclick="addnewuser();">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 14h1.5v-3.25H14v-1.5h-3.25V6h-1.5v3.25H6v1.5h3.25Zm.75 4q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                                    <h3>Add New User</h3>
                            </button>
                            
                        </div>
                        <div class="search">
                            <div class="search-bar"> 
                                <input text="text" placeholder="Search" onkeyup='tableSearch()' id="searchInput" name="searchInput"/>
                                <button type="submit" >
                                    <svg id="search-icon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="m15.938 17-4.98-4.979q-.625.458-1.375.719Q8.833 13 8 13q-2.083 0-3.542-1.458Q3 10.083 3 8q0-2.083 1.458-3.542Q5.917 3 8 3q2.083 0 3.542 1.458Q13 5.917 13 8q0 .833-.26 1.583-.261.75-.719 1.375L17 15.938ZM8 11.5q1.458 0 2.479-1.021Q11.5 9.458 11.5 8q0-1.458-1.021-2.479Q9.458 4.5 8 4.5q-1.458 0-2.479 1.021Q4.5 6.542 4.5 8q0 1.458 1.021 2.479Q6.542 11.5 8 11.5Z"/></svg>
                                </button>
                            </div>
                        </div>  
                        <!-- <div class="popup-addAccount">
                            
                        </div> -->
                    </div>
                    <div class="account-container">
                        <table class="table" id="myTable"> 
                            <thead> 
                                <tr>
                                    <th>ID</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Email</th>
                                    <!-- <th>Address</th> -->
                                    <th>Contact Number</th>
                                    <th>Role</th>
                                    <th>Picture</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <?php
                                while ($rows = mysqli_fetch_assoc($result))
                                {
                            ?>
                            <tbody>
                                    <tr>
                                        <td> <?php echo $rows['user_id']; ?></td>
                                        <td> <?php echo $rows['last_name']; ?></td>
                                        <td> <?php echo $rows['first_name']; ?></td>
                                        <td> <?php echo $rows['middle_name']; ?></td>
                                        <td> <?php echo $rows['email']; ?></td>
                                        <td> <?php echo $rows['contact_number']; ?></td>
                                        <td> <?php echo $rows['user_type']; ?></td>
                                        <td> <img src="<?php echo "uploaded_image/".$rows['profile_image']; ?>" width="50px"></td>
                                        <td>
                                            <a href="Account-Action.php?edit=<?php echo $rows['user_id']; ?>" id="edit-action" class="action-btn" name="action">
                                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.521 17.479v-2.437l4.562-4.563 2.438 2.438-4.563 4.562Zm-7-3.958v-2.459h7.271v2.459Zm14.583-1.188-2.437-2.437.666-.667q.355-.354.865-.364.51-.011.864.364l.709.709q.375.354.364.864-.01.51-.364.865ZM2.521 9.75V7.292h9.958V9.75Zm0-3.771V3.521h9.958v2.458Z"/></svg>
                                            </a>
                                            <a href="Account-Action-ChangePassword.php?edit=<?php echo $rows['user_id']; ?>" id="cpass-action" class="action-btn" name="action">
                                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M10 17.708q-1.979 0-3.604-.864-1.625-.865-2.688-2.323l1.73-1.771q.833 1.229 2.02 1.865 1.188.635 2.542.635 2.188 0 3.719-1.531Q15.25 12.188 15.25 10q0-2.188-1.531-3.719Q12.188 4.75 10 4.75q-2.146 0-3.719 1.521t-1.531 3.75v-.125l1.188-1.188L7.208 10l-3.687 3.688L-.167 10l1.271-1.292 1.188 1.209v.125q-.021-1.604.583-3.021.604-1.417 1.656-2.469Q5.583 3.5 7 2.896q1.417-.604 3.021-.604 1.583 0 2.979.604 1.396.604 2.448 1.656T17.104 7q.604 1.396.604 3 0 3.229-2.239 5.469-2.24 2.239-5.469 2.239ZM8.5 13q-.312 0-.531-.219-.219-.219-.219-.531V10q0-.312.219-.531.219-.219.531-.219V8.5q0-.625.438-1.062Q9.375 7 10 7t1.062.438q.438.437.438 1.062v.75q.312 0 .531.219.219.219.219.531v2.25q0 .312-.219.531-.219.219-.531.219Zm.75-3.75h1.5V8.5q0-.312-.219-.531-.219-.219-.531-.219-.312 0-.531.219-.219.219-.219.531Z"/></svg>
                                            <a href="Account-Action-Archive.php?edit=<?php echo $rows['user_id']; ?>" id="archive-action" class="action-btn" name="action">
                                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.75 17.708Q3.708 17.708 3 17t-.708-1.75V5.375q0-.417.156-.833.156-.417.448-.709l1.125-1.104q.333-.291.76-.489t.844-.198h8.75q.417 0 .844.198t.76.489l1.125 1.104q.292.292.448.709.156.416.156.833v9.875q0 1.042-.708 1.75t-1.75.708Zm0-12.208h10.5l-1-1h-8.5ZM10 14.083l3.375-3.354-1.333-1.375-1.084 1.084V7.354H9.042v3.084L7.958 9.354l-1.333 1.375Z"/></svg>
                                            </a>
                                        </td>
                                    <tr id="noRecordTR" style="display:none">
                                        <td colspan="10">No Record Found</td>                         
                                    </tr>
                            </tbody>
                                    <?php
                                }
                                ?>   
                        </table>     
                    </div>
                     
                </div>
            </main>
        
            <div class="top-menu">  
                <div class="menu-bar">
                    <div class="menu-btn2">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h2 class="accTitle-top">ACCOUNT</h2>
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
                        <div class="profile"  onclick="menuToggle();">
                            <img src="uploaded_image/<?= $_SESSION['user_profile_image']; ?>" alt="">
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
                                    <a href="#" class="account">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.917 14.167q1.062-.875 2.364-1.313 1.302-.437 2.719-.437 1.417 0 2.719.437 1.302.438 2.385 1.313.688-.855 1.084-1.907.395-1.052.395-2.26 0-2.75-1.916-4.667Q12.75 3.417 10 3.417T5.333 5.333Q3.417 7.25 3.417 10q0 1.208.406 2.26.406 1.052 1.094 1.907ZM10 10.854q-1.229 0-2.073-.844-.844-.843-.844-2.072 0-1.23.844-2.073.844-.844 2.073-.844t2.073.844q.844.843.844 2.073 0 1.229-.844 2.072-.844.844-2.073.844Zm0 7.479q-1.729 0-3.25-.656t-2.646-1.781q-1.125-1.125-1.781-2.646-.656-1.521-.656-3.25t.656-3.25q.656-1.521 1.781-2.646T6.75 2.323q1.521-.656 3.25-.656t3.25.656q1.521.656 2.646 1.781t1.781 2.646q.656 1.521.656 3.25t-.656 3.25q-.656 1.521-1.781 2.646t-2.646 1.781q-1.521.656-3.25.656Zm.021-1.75q1.021 0 2-.312.979-.313 1.771-.896-.771-.604-1.75-.906-.98-.302-2.042-.302-1.062 0-2.031.302-.969.302-1.761.906.792.583 1.782.896.989.312 2.031.312ZM10 9.104q.521 0 .844-.323.323-.323.323-.843 0-.521-.323-.844-.323-.323-.844-.323-.521 0-.844.323-.323.323-.323.844 0 .52.323.843.323.323.844.323Zm0-1.166Zm0 7.437Z"/></svg>
                                        <h4>My Account</h4>
                                    </a>
                                    <a href="#" class="help">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M10 15q.417 0 .708-.292Q11 14.417 11 14t-.292-.708Q10.417 13 10 13t-.708.292Q9 13.583 9 14t.292.708Q9.583 15 10 15Zm-.75-3.188h1.521q0-.77.135-1.093.136-.323.656-.823.73-.708 1.011-1.208.281-.5.281-1.105 0-1.145-.781-1.864Q11.292 5 10.083 5q-1.062 0-1.843.562-.782.563-1.094 1.521l1.354.563q.188-.584.594-.906.406-.323.948-.323.583 0 .958.333t.375.875q0 .479-.323.854t-.719.729q-.729.667-.906 1.094-.177.427-.177 1.51ZM10 18q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                                        <h4>Help</h4>
                                    </a>
                                    <a href="logout.php" class="logout">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.5 17q-.625 0-1.062-.438Q3 16.125 3 15.5v-11q0-.625.438-1.062Q3.875 3 4.5 3H10v1.5H4.5v11H10V17Zm9-3.5-1.062-1.062 1.687-1.688H8v-1.5h6.125l-1.687-1.688L13.5 6.5 17 10Z"/></svg>
                                        <h4>Log Out</h4>
                                    </a>
                                </div>
                        </div>  
                    </div>     
                </div>
               
            </div>      
  
        </div> 
  
    <form action="" method="post" enctype="multipart/form-data" id="adduserFrm">
        <div class="bg-adduserform" id="bg-addform">
            <div class="message"></div>
            <div class="form-adduser1" id="form-adduser1">
                <h1 class="addnew-title">ADD NEW USER</h1>
            
                <div class="form-adduser2" id="form-adduser2">
                    <div class="form1">  
                        <input type="text" id="fill"class="lastname" required="required" name="lastname">
                        <span>Last Name</span>
                    </div> 
                    <div class="form1">  
                        <input type="text" id="fill"class="firstname" required="required" name="firstname">
                        <span>First Name</span>
                    </div>
                    <div class="form2">  
                        <input type="text" id="fill"class="middlename" required="" name="middlename">
                        <span>Middle Name</span>
                    </div>
                    <div class="form2">  
                        <input type="text" id="fill" class="email" required="required" name="email">
                        <span>Email</span>
                    </div>
                    <div class="form4">  
                        <input type="text" id="fill" class="contactnum" onkeypress="return isNumberKey(event)" required="required" name="contactnum">
                        <span>Contact Number</span>
                    </div>
                    
                    <?php
                        $dropdown_query = "SELECT * FROM account_type";
                        $result1 = mysqli_query($con, $dropdown_query);
                    ?>

                    <div class="usertype-dropdown">
                        <select class="select" name="usertypes" required="" >
                            <option selected disabled value="">ROLE</option>
                            <?php while($row2 = mysqli_fetch_array($result1)):;?>
                            <option><?php echo $row2[1];?></option>
                            <?php endwhile;?>
                            <!-- <option value="Admin">ADMIN</option>
                            <option value="Manager">MANAGER</option>
                            <option value="Cashier">CASHIER</option>
                            <option value="Custom"><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 15v-4.25H5v-1.5h4.25V5h1.5v4.25H15v1.5h-4.25V15Z"/></svg>
                            CUSTOM</option> -->
                        </select>
                    </div>
                    <!-- <div class="usertype-dropdown">
                        <div class="select" id="usertype">
                            <span class="selected">ROLE</span>
                            <div class="caret"></div>
                        </div> 
                        <ul class="menu" name="usertypes" required="required" >
                            <li class="active">Admin</li>
                            <li>Manager</li>
                            <li>Cashier</li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 15v-4.25H5v-1.5h4.25V5h1.5v4.25H15v1.5h-4.25V15Z"/></svg>
                            Custom</li>
                        </ul>
                     -->
                    <div class="form4">  
                        <input type="password" class="password" id="pass" required="required" name="pass">
                        <span>Password</span>
                    </div>
                    <div class="form5">  
                        <input type="password" class="confirm-password" id="cpass" required="required" name="ecpass">
                        <span>Confirm Password</span>
                    </div>
                    <div class="checker">
                        <input type="checkbox" name="" onclick="myFunctionCP()" >
                        <span>Show password</span>
                    </div>
                    <div class="profile-picture1" >
                        <h4 >Profile Picture</h4>
                    </div>
                    <div class="choose-profile">
                        <input type="file" id="image-profile" name="profile_image" accept="image/jpg, image/png, image/jpeg" >
                    </div>
                </div>   
            
                <div class="AddButton">
                    <button type="submit" id="adduserBtn" name="submit">SAVE</button>
                    <!-- <input type="submit" value="ADD USER" name="submit" id="sub" onclick="showalert()"> -->
                </div>
                <div class="CancelButton">
                <!-- <button type="button" id="cancel" data-dismiss="modal" aria-label="Close">CANCEL</button> -->
                <a href="Account.php" id="cancel">CANCEL</a>   

                </div>
            </div>
            <div id="form-registered">
                <div id="container-registered">
                    <div class="content">
                        <div class="verify">
                            <svg class="verified" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                width="916px" height="916px" viewBox="0 0 916 916" style="enable-background:new 0 0 916 916;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M97.65,862.3c4.7,31.3,27.1,53.7,54.7,53.7h616c27.6,0,50-22.4,50-50V50c0-27.6-22.4-50-50-50h-616
                                        c-27.6,0-50,22.4-54.7,46.3V862.3z M712.15,750.2l-62.8,62.8l0,0l-18.3,18.3c-9.8,9.7-25.601,9.7-35.3,0l-18.4-18.3l0,0l-18-17
                                        c-9.8-9.8-9.8-25.6,0-35.4l0.6-0.6c9.801-9.8,25.601-9.8,35.4,0l18,17l62.8-62.8c9.8-9.8,25.601-9.8,35.4,0l0.6,0.6
                                        C721.95,724.6,721.95,740.4,712.15,750.2z M727.55,602.1c0,13.801-11.2,25-25,25H631.95c-13.8,0-25-11.199-25-25V601.2
                                        c0-13.8,11.2-25,25-25h70.601c13.8,0,25,11.2,25,25V602.1z M727.55,470c0,13.8-11.2,25-25,25H631.95c-13.8,0-25-11.2-25-25v-0.9
                                        c0-13.8,11.2-25,25-25h70.601c13.8,0,25,11.2,25,25V470z M702.55,312c13.8,0,25,11.2,25,25v0.9c0,13.8-11.2,25-25,25H631.95
                                        c-13.8,0-25-11.2-25-25V337c0-13.8,11.2-25,25-25H702.55z M302.65,156c0-13.8,11.2-25,25-25h265.4c13.8,0,25,11.2,25,25v0.9
                                        c0,13.8-11.2,25-25,25h-265.4c-13.8,0-25-11.2-25-25V156z M193.15,337c0-13.8,11.2-25,25-25h265.4c13.8,0,25,11.2,25,25v0.9
                                        c0,13.8-11.2,25-25,25h-265.4c-13.8,0-25-11.2-25-25V337L193.15,337z M193.15,469.1c0-13.8,11.2-25,25-25h265.4
                                        c13.8,0,25,11.2,25,25v0.9c0,13.8-11.2,25-25,25h-265.4c-13.8,0-25-11.2-25-25V469.1L193.15,469.1z M193.15,601.2
                                        c0-13.8,11.2-25,25-25h265.4c13.8,0,25,11.2,25,25v0.899c0,13.801-11.2,25-25,25h-265.4c-13.8,0-25-11.199-25-25V601.2
                                        L193.15,601.2z"/>
                                </g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            </svg>
                        </div>  
                        <div class="register">  
                            <h2>Registered Successfully</h2>
                        </div>
                    </div>
                        <div class="pageform">
                            <div class="confirmBtn">
                                <a href="Account.php" id="registered">CONFIRM</a>   
                            </div> 
                        </div>
                </div>
            </div>
        </form>
        </div>
    
</body>
</html>
<script>
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
    //SHOW PASSWORD-------------------------------------------------
function myFunctionCP(){
        var x = document.getElementById("pass");
        var y = document.getElementById("cpass");
        if(x.type === 'password'){
            x.type = "text";
            y.type = "text";
        }else{
            x.type = "password";
            y.type = "password";
        }
    }
    // EDIT ACCOUNT--------------------------------------------------
    
    // document.querySelector("#myTable"),addEventListener("click", (e)=>{
    //     target = e.target;
    //     if(target.classList.contains("action-btn")){
    //         selectedRow = target.parentElement.parentElement;
    //         document.querySelector("#lastname").value = selectedRow.children[1].textContent;
    //         document.querySelector("#firstname").value = selectedRow.children[2].textContent;
    //         document.querySelector("#middlename").value = selectedRow.children[3].textContent;
    //         document.querySelector("#email").value = selectedRow.children[4].textContent;
    //         document.querySelector("#contactnum").value = selectedRow.children[5].textContent;
    //         // document.querySelector("#usertype").value = selectedRow.children[6].textContent;
    //         // document.querySelector("#image-profile").value = selectedRow.children[7].textContent;
    //     }
    // });
    // // Get the modal
 
    // // // Get the button that opens the modal
    // // var addbtn = $("#add-userbutton");

    // // // Get the <span> element that closes the modal
    // var cancelbtn = $("#cancel");

    // $(document).ready(function(){
    //     // When the user clicks the button, open the modal 
        // addbtn.on('click', function() {
        //     bgform.show();
        // });
        
    //     // When the user clicks on <span> (x), close the modal
    //     cancelbtn.on('click', function() {
    //         bgform.hide();
    //     });
    // // });

    // Add new User Message ----------------------------------------------------------------------------------
    const regForm = document.querySelector(".form-registered");
    const regBtn = document.querySelector(".AddButton");
    var bgform = $('#form-registered');
    var addform = $('#form-adduser1');
    var addbtn = $("#adduserBtn");
    var message = $(".message");
    
    $(document).ready(function(){
        $('#adduserFrm').submit(function(e){
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: 'controllerUserdata.php',
                data: new FormData(this),
                contentType: false, 
                cache: false,
                processData: false,
                // 'submit=1&'+$form.serialize(),
                dataType: 'json',  
                success: function(response){
                    $(".message").css("display", "block");
                    if(response.status == 1){   
                        bgform.show();  
                        addform.hide(); 
                        message.hide(); 
                        $('#adduserFrm')[0].reset();
                }else{
                    $(".message").html('<p>'+response.message+'<p>');
                }
                    }
                });
            });
        //     $("#image-profile").change(function(){
        //         var file = this.files[0];
        //         var fileType = file.type;
        //         var match = ['image/jpeg', 'image/jpg', 'image/png']

        //         if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]))){
        //             alert("JPEG, JPG, and PNG files only.")
        //             $("#image-profile").val('');
        //             return false;
        //         }
        // });
    });
    
// 
    let btnClear = document.querySelector('#cancel');
    // let btnClear1 = document.querySelector('#registered');
    let inputs = document.querySelectorAll('#fill');
    let pass = document.querySelectorAll('#pass');
    let cpass = document.querySelectorAll('#cpass');
    btnClear.addEventListener('click', () => {
        inputs.forEach(input => input.value = '');
        pass.forEach(input => input.value = '');
        cpass.forEach(input => input.value = '');
    });
    // btnClear1.addEventListener('click', () => {
    //     inputs.forEach(input => input.value = '');
    // });

    function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
    }

    const checkbox = document.getElementById('checkbox');
         checkbox.addEventListener( 'change', () =>{
             document.body.classList.toggle('dark-theme');
         });
  
    // --------------------------------------Action Dropdown-------------------------------------- //
    const actionsForm = document.querySelector(".bg-actionDropdown");
    const actionsBtn = document.querySelector(".action-btn");
        // actionsBtn.addEventListener('click', () =>{
        //     actionsForm.style.display = 'block';
        // })
     function addnewuser(){
        const addBtn = document.querySelector(".add-account");
        addForm.style.display = 'flex';
    }
    function actionFunction(){
        // actionsForm.classList.toggle('bg-actionDropdown')
        actionsForm.style.display = 'flex';
    }
    function closeAction(){
        // actionsForm.classList.toggle('bg-actionDropdown')
        actionsForm.style.display = 'none';
    }
    const editBtn = document.querySelector(".edit");
    const editForm = document.querySelector(".bg-editDropdown");
    
    // editBtn.addEventListener('click', () =>{
    //     editForm.style.display = 'flex';
    //     })
    function editAction(){
        editForm.style.display = 'flex';
        actionsForm.style.display = 'none';
    }
    const sideMenu = document.querySelector("#aside");
    const addForm = document.querySelector(".bg-adduserform");
   
    const closeBtn = document.querySelector("#close-btn");
    const cancelBtn = document.querySelector("#cancel");
    // const addBtn = document.querySelector(".add-account");
    const menuBtn = document.querySelector("#menu-button");
    // const darktheme = document.querySelector('.dark-theme');
    // const checkbox = document.getElementById("checkbox");
        menuBtn.addEventListener('click', () =>{
            sideMenu.style.display = 'block';
        })
        closeBtn.addEventListener('click', () =>{
            sideMenu.style.display = 'none';
        })
        cancelBtn.addEventListener('click', () =>{
            addForm.style.display = 'none';
        })
        // if(email.value === '' || middlename.value === '' || firstname.value === '' || lastname.value === '' || contactnum.value === '' || role.value === '' || password.value === '' || confirmpassword.value === '' || profilepicture.value === ''){ 
        // }else{
            
        // }
        addBtn.addEventListener('click', () =>{
            addForm.style.display = 'flex';
        })
        
        // adduserBtn.addEventListener('click', () =>{
        //     addForm.style.display = 'flex';
        // })
        
        // checkbox.addEventListener( 'change', function() {
        //     localStorage.setItem('dark-theme',this.checked);
        //     if(this.checked) {
        //         body.classList.add('dark-theme')
        //     } else {
        //         body.classList.remove('dark-theme')     
        //     }
        // });
        //     document.body.classList.add('dark-theme');
        // })
            // if(localStorage.getItem('dark-theme')) {
            // body.classList.add('dark-theme');
            // }
      
       
         function menuToggle(){
            const toggleMenu = document.querySelector('.drop-menu');
            toggleMenu.classList.toggle('user2')
        }


        function tableSearch(){
    let input, filter, table, tr, lastname,
     firstname, middlename, email, contactnum, role, i, txtValue;
  
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");


        for(i = 0; i < tr.length; i++){
           
            lastname = tr[i].getElementsByTagName("td")[1];
            firstname = tr[i].getElementsByTagName("td")[2];
            middlename = tr[i].getElementsByTagName("td")[3];
            email = tr[i].getElementsByTagName("td")[4];
            contactnum = tr[i].getElementsByTagName("td")[5];
            role = tr[i].getElementsByTagName("td")[6];
            
            
            if(lastname || firstname || middlename || email || contactnum || role){
                var lastname_value = lastname.textContent || lastname.innerText;
                var firstname_value = firstname.textContent || firstname.innerText;
                var middlename_value = middlename.textContent || middlename.innerText;
                var email_value = email.textContent || email.innerText;
                var contactnum_value = contactnum.textContent || contactnum.innerText;
                var role_value = role.textContent || role.innerText;
                if(role_value.toUpperCase().indexOf(filter) > -1 ||
                contactnum_value.toUpperCase().indexOf(filter) > -1 ||
                email_value.toUpperCase().indexOf(filter) > -1 ||
                middlename_value.toUpperCase().indexOf(filter) > -1 ||
                lastname_value.toUpperCase().indexOf(filter) > -1 ||
                firstname_value.toUpperCase().indexOf(filter) > -1){
                    tr[i].style.display ="";
                }
                else{
                    tr[i].style.display = "none";
                }
                if($('#myTable tbody tr:visible').length === 0) {
                document.getElementById('noRecordTR').style.display = "";
            }else{
                document.getElementById('noRecordTR').style.display = "none";
            }
            }
            if($('#myTable tbody tr:visible').length === 0) {
                document.getElementById('noRecordTR').style.display = "";
            }else{
                document.getElementById('noRecordTR').style.display = "none";
            }
        }   
}
    // $.fn.AddNoRowsFound = function() {
    //     if($(this).find('tbody tr:not([data-no-results-found]):visible').length > 0) {
    //     $(this).find('tbody tr[data-no-results-found]').hide();
    // }
    // else {
    //     $(this).find('tbody tr[data-no-results-found]').show();
    // }
    // };

    // $('#myTable').AddNoRowsFound();

// function actionToggle(){
//             const toggleAction = document.querySelector('.menu-action');
//             toggleAction.classList.toggle('action-dropdown')
        // }
        // var smodal = document.getElementByClassName('action-dropdown');
    // const dropdowns = document.querySelectorAll(".action-dropdown");
    //     dropdowns.forEach(dropdown =>{
    //         const select = dropdown.querySelector(".select-action");
    //         // const caret = dropdown.querySelector(".caret");
    //         const menu = dropdown.querySelector(".menu-action");   
            // const options = dropdown.querySelectorAll(".menu-action .li");
            // const selected = dropdown.querySelector(".selected-action");

            // select.addEventListener('click', () => {
            //     select.classList.toggle('select-action-clicked');
            //     // caret.classList.toggle('caret-rotate');
            //     menu.classList.toggle('menu-action-open');
                
            // });
          
            // options.forEach(option => {
            //     option.addEventListener('click', () =>{
            //         select.innerText = option.innerText;
            //         select.classList.remove('select-action-clicked');
            //         // caret.classList.remove('caret-rotate');
            //         menu.classList.remove('menu-action-open');

            //         options.forEach(option => {
            //             option.classList.remove('active');
            //         });
            //         option.classList.add('active');
            //     });
            // });
        // });
        // window.onclick = function(e){
        //         if(e.target == smodal){
        //             modal.style.display = "none"
        //         }
        //     }
// ///////////////////////////////////////////////////////////////////////////////////////////////////
// $(document).ready(function(){
//     $("#actionsSelect").on("change", function() {
//         $(".bg-editDropdown").hide();
//         $("#" + $(this).val()).fadeIn(200);
//     }).change();
// });
// $(document).ready(function(){
//     $('#actionsSelect').on('change', function(){
//     	var demovalue = $(this).val(); 
//         // $("div.bg-editDropdown").hide();
//         $("#edit-bgdrop").show();
//     });
// });
// $("#actionsSelect").on("change", function() {
//         $("#" + $(this).val()).show().siblings();
//     })
</script>
<script src="https://ajax.googleapis.com/ajax/libs/d3js/7.6.1/d3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>      

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
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
    #account{
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
    /* -----------------------------------------Adduserform------------------------------------------ */
    .bg-actionDropdown{
        height: 100%; 
        width: 100%;
        background: rgba(0,0,0,0.7);
        top: 0;
        position: absolute;
        display: flex;
        align-items: center; 
        justify-content: center;
        display: none;
    }
            .action{ 
                position: absolute;
                top: 50%;
                align-items: center;
                text-align: center;
                /* display: none; */
                left: 50%;
                height: 13.5rem;
                min-width: 17rem;
                
                transform: translate(-50%, -50%);
                background-color: var(--color-white);
                box-shadow: 5px 7px 30px 0px var(--color-shadow-shadow);
                border-radius: 20px;  
             }
             #close-action{
                position: absolute;
                margin-top: -5.5rem;
                left:87%;
                fill: var(--color-solid-gray);
             }
             #close-action:hover{
                position: absolute;
                margin-top: -5.5rem;
                left:87%;
                fill: #8b0000;
                transition: .2s;
             }
             .action h2{
                padding-bottom: .5rem;
                margin-top: .5rem;
                font-size: min(max(1.9rem, 1.1vw), 2rem);
                color: var(--color-solid-gray);
                font-family: 'Malberg Trial', sans-serif;
                border-bottom:  2px solid var(--color-solid-gray);
                margin-bottom: 1rem;
             }
             .action button{
                padding-left:1rem;
                font-family: 'arial', sans-serif;
                cursor: pointer;
                transition: .5s;
                font-size: 12px;
                display: flex;
                gap: .8rem;
                width: 100%;
                border: none;
                background: var(--color-white);
                align-items: center;
                color: var(--color-solid-gray);
                fill: var(--color-solid-gray);
                border-radius: 20px;  
            }
            .action button:last-child{
                border-top:  2px solid var(--color-solid-gray);
            }
            
            .action button:hover{
                background: linear-gradient(270deg, transparent, var(--color-secondary-main));
                color: var(--color-main);
                fill: var(--color-main);
            }

    .bg-adduserform{
        height: 100%; 
        width: 100%;
        background: rgba(0,0,0,0.7);
        top: 0;
        position: absolute;
        display: flex;
        align-items: center; 
        justify-content: center;
        display: none;
    }
    .bg-editDropdown{
        height: 100%; 
        width: 100%;
        background: rgba(0,0,0,0.7);
        top: 0;
        position: absolute;
        display: flex;
        align-items: center; 
        justify-content: center;
        display: none;
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
            .form1{
                position: relative;
                width: 205px;
                margin-left: 2rem;
                margin-top: -1.0rem;
                top: 15px;
            }
            .form1 input{
                width:100%;
                height: 2.5rem;
                padding: 10px;
                border: 2px solid var(--color-solid-gray);
                border-radius: 15px;
                outline: none;
                font-size: 1em;
                background: var(--color-white);
                color: var(--color-black);
            }
            .form1 span{
                position: absolute;
                left: 0;
                padding: 12px;
                pointer-events: none;
                font-size: 1.2em;
                margin-top: 0.1rem;
                margin-left: .2rem;
                color:var(--color-solid-gray);
            }
            .form1 input:focus{
                border: 2px solid var(--color-main-3);
            }
            .form1 input:valid ~ span,
            .form1 input:focus ~ span{
                color: var(--color-main-3);
                transform: translateX(10px) translateY(1px);
                font-size: 0.9em;
                padding: 0 10px;
                transition: .3s
            }
            .form2{
                position: relative;
                width: 205px;
                height: 17px;
                margin-left: 16rem;
                margin-top: .395rem;
                top: -7.1rem;
            }
            .form2 input{
                width:100%;
                height: 2.5rem;
                padding: 10px;
                border: 2px solid var(--color-solid-gray);
                border-radius: 15px;
                outline: none;
                font-size: 1em;
                background: var(--color-white);
                color: var(--color-black);
            }
            .form2 span{
                position: absolute;
                left: 0;
                padding: 12px;
                pointer-events: none;
                font-size:  1.2em;
                margin-top: 0.1rem;
                margin-left: .2rem;
                color: var(--color-solid-gray);
            }
            .form2 input:focus{
                border: 2px solid var(--color-main-3);
            }
            .form2 input:valid ~ span,
            .form2 input:focus ~ span{
                color:var(--color-main-3);
                transform: translateX(10px) translateY(1px);
                font-size: 0.9em;
                padding: 0 10px;
                transition: .3s
            }
            .form4{
                position: relative;
                width: 205px;
                margin-left: 2rem;
                margin-top: -.895rem;
                top: -5.6rem;
            }
            .form4 input{
                width:100%;
                height: 2.5rem;
                padding: 10px;
                border: 2px solid var(--color-solid-gray);
                border-radius: 15px;
                outline: none;
                font-size: 1em;
                background: var(--color-white);
                color: var(--color-black);
            }
            .form4 span{
                position: absolute;
                left: 0;
                padding: 12px;
                pointer-events: none;
                font-size: 1.2em;
                margin-top: 0.1rem;
                margin-left: .2rem;
                color: var(--color-solid-gray);
            }
            .form4 input:focus{
                border: 2px solid var(--color-main-3);
            }
            .form4 input:valid ~ span,
            .form4 input:focus ~ span{
                color:var(--color-main-3);
                transform: translateX(10px) translateY(1px);
                font-size: 0.9em;
                padding: 0 10px;
                transition: .3s
            }
            .form5{
                position: relative;
                width: 205px;
                margin-left: 15.9rem;
                margin-top: 1rem;
                top: -10.93rem;
                margin-bottom: -5rem;
            }
            .form5 input{
                width:100%;
                height: 2.5rem;
                padding: 10px;
                border: 2px solid var(--color-solid-gray);
                border-radius: 15px;
                outline: none;
                font-size: 1em;
                background: var(--color-white);
                color: var(--color-black);
            }
            .form5 span{
                position: absolute;
                left: 0;
                padding: 12px;
                pointer-events: none;
                font-size: 1.2em;
                margin-top: .1rem;
                margin-left: .2rem;
                color: var(--color-solid-gray);
            }
            .form5 input:focus{
                border: 2px solid var(--color-main-3);
            }
            .form5 input:valid ~ span,
            .form5 input:focus ~ span{
                color:var(--color-main-3);
                transform: translateX(10px) translateY(1px);
                font-size: 0.9em;
                padding: 0 10px;
                transition: .3s
            }
            
            /* --------------------------------------DROP DOWN ACTION------------------------------------- */
            .actionBtn{
                background: var(--color-solid-gray);
                color: var(--color-white);
                font-size: 18px;
                font-family: "Font Awesome 5 Free", sans-serif;
                font-weight: 501;
                border-radius: 50px;
                padding: 10px;
                height: 2.5em;
                width: 4rem;
                cursor: pointer;
                transition: 0.3s;
            }
            .fa{
                font-family: "Font Awesome 5 Free", sans-serif;
                font-weight: 501;
                font-size: 14px;
            }
            .actionicon{
                fill:  var(--color-white);
            }
          
            /* --------------------------------------DROP DOWN------------------------------------- */
            .usertype-dropdown{
                width: 20em;
                position: relative;
                margin-top: 1rem;
                top: -10.9rem;
                left: 51%;
                margin-bottom: -5.39rem;
            }
            .select{
                background: var(--color-solid-gray);
                color: var(--color-white);
                align-items: center;
                border-radius: 13px;
                padding: 8px 12px;
                height: 2.9em;
                width: 12.8rem;
                cursor: pointer;
                transition: 0.3s;
            }
            .action-dropdown{
                position: relative;
                margin-top: .5rem;
                /* left: 10%; */
                margin-bottom: .5rem
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
                padding-left: 3px;
                cursor: pointer;
                transition: 0.3s;
                border: none;
            }
            #edit-action:hover{
                background: var(--color-main);
                color: var(--color-white);
            }
            #cpass-action{
                background:#00aa09;
                position: relative;
                color: var(--color-white);
                align-items: center;
                text-align: center;
                margin: 1px;
                border-radius: 3px;
                height: 100%;
                width: 70%;
                padding-top: 10px;
                padding-right: 1px;
                padding-left: 5px;
                cursor: pointer;
                transition: 0.3s;
                border: none;
            }
            #cpass-action:hover{
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
                padding-right: 4px;
                padding-left: 4px;
                cursor: pointer;
                transition: 0.3s;
                border: none;
            }
            #archive-action:hover{
                background: var(--color-main);
                color: var(--color-white);
            }
         
    .checker {
        text-align: right;
        align-items: right;
        margin-right: 3rem;
        margin-top: -7.5rem;
        margin-bottom: 5rem;
    }
    .checker span {
        text-decoration: none;
        color: var(--color-solid-gray);
        top: 0;
        font-size: min(max(10px, 1.2vw), 12px);
        font-family: 'Switzer', sans-serif;
    }
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
    .profile-picture1 h4{
        display: flex;
        font-size: .9rem;
        position: relative;
        text-align: center;
        font-family: 'Calibri', sans-serif;
        color: var(--color-solid-gray);
        top: -8rem;
        margin-left: 2rem;
        width: 26.7rem;
        border-bottom: 2px solid var(--color-solid-gray);
        margin-bottom: -5rem;
     }   
       
    .choose-profile{
        position: relative;
        width: 20rem;
        height: 1.32rem;
        text-align: right;
        padding: 10px;
        margin-left: 5rem; 
        background: var(--color-solid-gray);
        color: var(--color-white);
        top: -6.4rem;
        margin-bottom: -7.6em;
        border-radius: 10px;
        transition: 0.5s;
        font-family: 'COCOGOOSE', sans-serif;
        cursor: pointer;
    }
    #image-profile{
        cursor: pointer;
    }
    .choose-profile:hover{
        background: var(--color-main-2);
        transition: 0.5s;
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
        margin: 15px;
        padding-bottom: 10px;
    }
   
    .form-adduser1 .AddButton button{
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
    .form-adduser1 .AddButton button:hover{
        background: var(--color-button-hover);
    }
    .CancelButton{
        margin-top: -4.9vh;
        margin-left: 2.4em;
    }
    .CloseButton{
        margin-top: 5.2vh;
        margin-left: 2.4em;
        margin-bottom: -2rem;
    }
    #cancel{
        font-family: 'COCOGOOSE', sans-serif;
        padding: 10px;
        padding-left: 60px;
        padding-right: 60px;
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

    #action_btn {
        font-family: 'calibri', sans-serif;
        /* padding: 10px;
        
        margin-bottom: 20px;
        margin-left: 20em; */
        text-align: center;
        margin-top: .5vh;
        margin-bottom: .5vh;
        width: 3rem;
        height: 40px;
        outline: none;
        border: none;
        font-size: min(max(10px, 1.2vw), 12px);
        border-radius: 20px;
        background: var(--color-solid-gray);
        cursor: pointer; 
        transition: 0.5s;
    }
    #action_btn:hover{
        background: var(--color-button-hover);
    }
  
     /* ----------------------------------------Top bar menu----------------------------------------  */
    .top-menu{
        margin-top: .7rem;
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
        width: 7vw;
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
    .profile-pic{
        align-items: center;
        text-align: center;
        justify-content: center;
        margin-top: 1rem;
    }
    .profile-pic img{
        background: var(--color-solid-gray); 
        border-radius: 50%;
        width: 100px;
        padding: 3px;
    }
    .editnew-title{
        font-size: min(max(1.9rem, 1.1vw), 2rem);
        color: var(--color-solid-gray);
        font-family: 'Malberg Trial', sans-serif;
        letter-spacing: .09rem;
        display: flex;
        padding-top: .5rem;
        justify-content: center;
        border-bottom: 2px solid var(--color-solid-gray);
        margin: 15px;
        padding-bottom: 10px;
    }
   
    #menu-button{
        border: none;
        background: none;
    }
    /* .bg-shadow{
        position: absolute;
        bottom: 0%; 
        width: 100%;
     }
    #shadow{
        background: rgb(219, 219, 219);
        opacity: .2;
        display: flex;
        display: none;
        overflow-y: hidden;
        position: relative;
        height: 100%;
        background-attachment: fixed;
        bottom: 0%;
        width: 100%;
    } */
    /* .user{
        text-align: right;
        align-items: right;
    } */
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
        right: 10px;
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
        right: 15px;
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
    /* ----------------------------------------MAIN---------------------------------------- */
    .main-account{
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
        width: 78%;
    }
   
        /* ----------------------------------------Sub TAB---------------------------------------- */
        .user-title{
            position: relative;
            display: inline-block;
            width: 100%;
        }
        main  h2{
            margin-bottom: -2.2rem;
            margin-top: 1rem;
            color: var(--color-solid-gray);
            font-size: 1.3rem;
            margin-left: 3%;
            letter-spacing: .1rem;
            font-family: 'Galhau Display', sans-serif;
        }
        main .sub-tab{
            margin-bottom: 7rem;
        }
        /* ----------------------------------------Search BAR---------------------------------------- */
        .search{
            position: absolute;
            gap: 2rem;
            align-items: right;
            text-align: right;
            right: 0;
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
        /* ----------------------------------------Add Button---------------------------------------- */
        .newUser-button{
            position: absolute;
            left: 15%;
        }
        .add-account{
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
            height: 3.9rem;
            transition: all 300ms ease;
            position: relative; 
            margin-top: .2rem;
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
    
      /* ----------------------------------------SIDEBAR 2---------------------------------------- */
      @media screen and (max-width: 1600px){
        .container{
            width: 94%;
            grid-template-columns: 16rem auto;
        }
        .top-menu{
            width: 370px;
        }
        main .account-container{
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
        .main-account{
            position: relative;
            left: -5%;
        }
        main .account-container{
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
        .accTitle{
            width: 74%;
        }
        .top-menu{
            width: 370px;
        }
        .main-account{
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
    </style>