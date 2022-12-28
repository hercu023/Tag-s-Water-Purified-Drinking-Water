<?php
session_start();
include '../database/connection-db.php';
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
    <link rel="stylesheet" type="text/css" href="../CSS/settings-dataarchive-account.css">
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
            <?php
            if (isset($_GET['error'])) {
                echo '<p id="myerror" class="error-error"> '.$_GET['error'].' </p>';
            }
            ?>
            <div class="message"> <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> No rows selected.</div>
            <div class="sub-tab">
                <div class="user-title">
                    <h2> Archive </h2>
                </div>
                <div class="sub-tab2">
                    <div class="delivery-options">
                        <select class="select" onchange="window.location.href=this.value;">
                            <option selected disabled value="">SELECT DATA</option>
                            <option value="../settings/settings-data-archive-account.php">Account</option>
                            <option value="../settings/settings-data-archive-customers.php">Customers</option>
                            <option value="../settings/settings-data-archive-employees.php">Employee</option>
                            <option value="../settings/settings-data-archive-inventory.php">Inventory</option>
                            <option value="../settings/settings-data-archive-expense.php">Expense</option>
                            <option value="../settings/settings-data-archive-attendance.php" selected>Attendance</option>
                        </select>
                    </div>
                    <div class="newUser-button">
                        <button type="submit" id="add-userbutton" class="add-account" onclick="selectRestore()">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 13.5h1.5v-3.125l1.188 1.187L13 10.5l-3-3-3 3 1.062 1.062 1.188-1.187ZM6.5 17q-.625 0-1.062-.438Q5 16.125 5 15.5v-10H4V4h4V3h4v1h4v1.5h-1v10q0 .625-.438 1.062Q14.125 17 13.5 17Z"/></svg>
                            <h3>RESTORE</h3>
                        </button>
                    </div>
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
                <h3 class="word">Attendance</h3>
                <div class="customer-container">
                    <form action="../service/restore-settings.php" method="post" id="frm">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Employee Name</th>
                                <th>Position</th>
                                <th>Whole Day</th>
                                <th>Date</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                                <th>Deduction</th>
                                <th>Bonus</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th>Added By</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                            $attendance = "SELECT 
                        attendance.id,
                        attendance.whole_day,
                        attendance.date,
                        attendance.time_in,
                        attendance.time_out,
                        attendance.deduction,
                        attendance.bonus, 
                        attendance.note, 
                        attendance.payroll_status, 
                        attendance.added_by,
                        employee.first_name as emp_first_name,
                        employee.last_name as emp_last_name,
                        employee.middle_name as emp_middle_name,
                        position_type.name as position_type,
                        users.first_name as usr_first_name,
                        users.last_name as usr_last_name
                        FROM attendance 
                        INNER JOIN employee 
                        ON attendance.employee_id = employee.id
                        INNER JOIN position_type
                        ON employee.position_id = position_type.id
                        INNER JOIN users
                        ON attendance.added_by = users.user_id
                        WHERE attendance.status_archive_id = 2
                        ORDER BY attendance.date ASC";
                            $attendance_run = mysqli_query($con, $attendance);

                            if(mysqli_num_rows($attendance_run) > 0)
                            {
                                foreach($attendance_run as $rows)
                                {
                                    ?>
                                    <tr>
                                        <td  class="select-check"><input type="checkbox" name="select-check[]" id="<?php echo $rows['id']; ?>" value="<?php echo $rows['id']; ?>" ></td>
                                        <td> <?php echo $rows['id']; ?></td>
                                        <td> <?php echo $rows['emp_first_name'].' '.$rows['emp_middle_name'].' '.$rows['emp_first_name'] ; ?></td>
                                        <td> <?php echo $rows['position_type'] ; ?></td>
                                        <td> <?php  if ($rows['whole_day'] == 1) { echo 'Yes'; } else echo 'No'; ?></td>
                                        <td> <?php echo $rows['date']; ?></td>
                                        <td> <?php echo $rows['time_in']; ?></td>
                                        <td> <?php echo $rows['time_out']; ?></td>
                                        <td> <?php echo 'PHP '.$rows['deduction']; ?></td>
                                        <td> <?php echo 'PHP '.$rows['bonus']; ?></td>
                                        <td> <?php echo $rows['note']; ?></td>
                                        <td> <?php  if ($rows['payroll_status'] == 1) { echo 'PAID'; } else echo 'UNPAID'; ?></td>
                                        <td> <?php echo $rows['usr_first_name'].' '.$rows['usr_last_name']; ?></td>
                                        <td>
                                            <a href="settings-confirm-restore-attendance.php?edit=<?php echo $rows['id']; ?>" id="archive-action" class="action-btn" name="action">
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
            <h1 class="addnew-title">RESTORE ATTENDANCE</h1>
            <form action="#">
                <div class="a-header">
                    <label class="archive-header"> Are you sure to Restore the selected rows?</label>
                </div>
                <div class="bot-buttons">
                    <div class="CancelButton">
                        <a href="../settings/settings-data-archive-attendance.php" id="cancel">CANCEL</a>
                    </div>
                    <div class="AddButton">
                        <button type="submit" id="addcustomerBtn" name="submit-checkall-attendance[]">RESTORE</button>
                    </div>
                </div>
        </div>
    </div>
</body>
</html>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/settings-data-archive-check-all.js"></script>
<style>

    .message{
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

    .checkall{
        display: inline-block;
        position: relative;
        flex-wrap: wrap;
        margin-left: 12rem;
    }
    .checkall-checkbox{
        display: inline-block;
    }
    .checkall-label{
        display: inline-block;
        gap: 7px;
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
        display: none;
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

</style>