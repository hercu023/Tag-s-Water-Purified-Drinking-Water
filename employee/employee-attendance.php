<?php
session_start();
include '../database/connection-db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="../CSS/employee-attendance.css">
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
            <h1 class="dashTitle">EMPLOYEE</h1>
            <div class="sub-tab">
                <div class="user-title">
                    <h2> Attendance </h2>
                </div>
                <div class="sub-tab2">
                    <div class="newUser-button">
                        <button type="button" id="add-userbutton" class="add-account" onclick="addnewuser();">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 14h1.5v-3.25H14v-1.5h-3.25V6h-1.5v3.25H6v1.5h3.25Zm.75 4q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                            <h3>Add Attendance</h3>
                        </button>
                        <button type="submit" id="add-payroll" class="payroll" >
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M3.5 10h13V7h-13ZM16 18v-2.5h-2.5V14H16v-2.5h1.5V14H20v1.5h-2.5V18ZM3.5 16q-.604 0-1.052-.438Q2 15.125 2 14.5v-9q0-.625.448-1.062Q2.896 4 3.5 4h13q.604 0 1.052.438Q18 4.875 18 5.5V10h-2.188q-1.666 0-2.739 1.177T12 13.958V16Z"/></svg>
                            <h3>PAYROLL</h3>
                        </button>
                    </div>
                    <div class="newUser-button-2">
                        
                    </div>
                </div>

                <div class="sub-tab2">
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
                    <form action="../service/restore-settings.php" method="post" id="frm">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Employee Name</th>
                                <th>Position</th>
                                <th>Date</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Deduction</th>
                                <th>Bonus</th>
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $customers = "SELECT 
                        customers.id,
                        customers.customer_name,
                        customers.address,
                        customers.contact_number1,
                        customers.contact_number2,
                        customers.balance,
                        customers.note, 
                        status_archive.status, 
                        customers.created_at, 
                        customers.created_by 
                        FROM customers 
                        INNER JOIN status_archive 
                        ON customers.status_archive_id = status_archive.id 
                        WHERE customers.status_archive_id = '2'";

                            $customer_run = mysqli_query($con, $customers);

                            if(mysqli_num_rows($customer_run) > 0)
                            {
                                foreach($customer_run as $rows)
                                {
                                    ?>
                                    <tr>
                                        <td  class="select-check"><input type="checkbox" name="select-check[]" id="<?php echo $rows['id']; ?>" value="<?php echo $rows['id']; ?>" ></td>
                                        <td> <?php echo $rows['id']; ?></td>
                                        <td> <?php echo $rows['customer_name']; ?></td>
                                        <td> <?php echo $rows['address']; ?></td>
                                        <td> <?php echo $rows['contact_number1']; ?></td>
                                        <td> <?php echo $rows['contact_number2']; ?></td>
                                        <td> <?php echo $rows['balance']; ?></td>
                                        <td> <?php echo $rows['note']; ?></td>
                                        <td> <?php echo $rows['created_by']; ?></td>
                                        <td> <?php echo $rows['created_at']; ?></td>
                                        <td>
                                            <a href="../settings/settings-confirm-restore-customers.php?edit=<?php echo $rows['id']; ?>" id="archive-action" class="action-btn" name="action">
                                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M10 14q1.458 0 2.479-1.021Q13.5 11.958 13.5 10.5q0-1.458-1.021-2.479Q11.458 7 10 7q-.792 0-1.49.344t-1.177.906V7h-1v3h3V9H8q.354-.458.875-.729Q9.396 8 10 8q1.042 0 1.771.729.729.729.729 1.771 0 1.042-.729 1.771Q11.042 13 10 13q-.604 0-1.125-.271T8 12H6.854q.417.896 1.25 1.448Q8.938 14 10 14Zm-4.5 4q-.625 0-1.062-.438Q4 17.125 4 16.5v-13q0-.625.438-1.062Q4.875 2 5.5 2H12l4 4v10.5q0 .625-.438 1.062Q15.125 18 14.5 18Z"/></svg>
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

    <?php
    include('../common/top-menu.php')
    ?>
                <div class="bg-addcustomerform" id="bg-addform">
                    <div class="container1">
                        <h1 class="addnew-title">RESTORE CUSTOMERS</h1>
                        <div class="a-header">
                            <label class="archive-header"> Are you sure to Restore the selected rows?</label>
                        </div>
                        <div class="bot-buttons">
                            <div class="CancelButton">
                                <a href="Settings-data-archive-customers.php" id="cancel">CANCEL</a>
                            </div>
                            <div class="AddButton">
                                <button type="submit" id="addcustomerBtn" name="submit-checkall-customers[]">RESTORE</button>
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
                    <input type="hidden" required="required" name="status" value="1">
                    <div class="main-user-info">
                        <div class="usertype-dropdown">
                            <?php
                            $dropdown_query = "SELECT * FROM account_type";
                            $account_type_result = mysqli_query($con, $dropdown_query);
                            ?>
                            <select class="select" name="user_types" required="" >
                                <option selected disabled value="">SELECT EMPLOYEE</option>
                                <?php while($account_type = mysqli_fetch_array($account_type_result)):;?>
                                    <option value="<?php echo $account_type['id']?>">
                                        <?php echo $account_type['user_type'];?>
                                    </option>
                                <?php endwhile;?>
                            </select>
                        </div>
                        <div class="user-input-box">
                            <label for="dateofattendance">Date of Attendance</label>
                            <input type="date" 
                                class="date" 
                                id="dateofattendance" 
                                required="required" 
                                onchange="console.log(this.value);" />
                        </div>
                        <div class="user-input-box">
                            <label for="timein">Time In</label>
                            <input type="time" 
                                class="timein" 
                                id="timein" 
                                required="required" 
                                onchange="console.log(this.value);" />
                        </div>
                        <div class="user-input-box">
                            <label for="timeout">Time Out</label>
                            <input type="time" 
                                class="timeout" 
                                id="timeout" 
                                required="required" 
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
                                name="additonalbonus"
                                placeholder="0.00"/>
                        </div>
                        <div class="user-input-box" id="note-box">
                            <label for="note">Note</label>
                            <input type="text"
                                id="note" class="note" name="note" placeholder="Enter a Note"/>
                        </div>
                        <div class="radio-button" >
                            <div class="salary-cateogory" >
                                <input type="radio" name="pos_item" id="Yes" value="Yes" required="required">
                                <label for="Yes">Whole Day</label>
                                <input type="radio" name="pos_item" id="No" value="No">
                                <label for="No">Half Day</label>
                            </div>
                        </div>

                        <div class="line"></div>

                        <div class="bot-buttons">
                            <div class="CancelButton">
                                <a href="../employee/employee-attendance.php" id="cancel">CANCEL</a>
                            </div>
                            <div class="AddButton">
                                <button type="submit" id="adduserBtn" name="add-employee">SAVE</button>
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
</html>
<!-- <script src="../javascript/settings-data-archive-check-all.js"></script> -->
<!-- <script src="../javascript/settings-data-archive-customer.js"></script> -->
