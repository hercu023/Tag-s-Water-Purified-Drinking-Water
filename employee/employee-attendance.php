<?php
require_once '../service/add-employee-attendance.php';
require_once "../service/user-access.php";

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'EMPLOYEE-ATTENDANCE')) {
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
            <div class="message"> <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> No rows selected.</div>
            <h1 class="dashTitle">EMPLOYEE</h1>
            <?php
            if (isset($_GET['error'])) {
                echo '<p id="myerror" class="error-error"> '.$_GET['error'].' </p>';
            }
            ?>
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
                        <button type="submit" id="add-payroll" class="payroll" onclick="selectRestore()">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M3.5 10h13V7h-13ZM16 18v-2.5h-2.5V14H16v-2.5h1.5V14H20v1.5h-2.5V18ZM3.5 16q-.604 0-1.052-.438Q2 15.125 2 14.5v-9q0-.625.448-1.062Q2.896 4 3.5 4h13q.604 0 1.052.438Q18 4.875 18 5.5V10h-2.188q-1.666 0-2.739 1.177T12 13.958V16Z"/></svg>
                            <h3>PAYROLL</h3>
                        </button>
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
                    <form action="../service/payroll-attendance.php" method="post" id="frm">
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
                        WHERE attendance.status_archive_id = 1
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
                                            <a href="../employee/employee-attendance-edit.php?edit=<?php echo $rows['id']; ?>" id="edit-action" class="action-btn" name="action">
                                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.521 17.479v-2.437l4.562-4.563 2.438 2.438-4.563 4.562Zm-7-3.958v-2.459h7.271v2.459Zm14.583-1.188-2.437-2.437.666-.667q.355-.354.865-.364.51-.011.864.364l.709.709q.375.354.364.864-.01.51-.364.865ZM2.521 9.75V7.292h9.958V9.75Zm0-3.771V3.521h9.958v2.458Z"/></svg>
                                            </a>
                                            <a href="../employee/employee-attendance-archive.php?edit=<?php echo $rows['id']; ?>" id="archive-action" class="action-btn" name="action">
                                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.75 17.708Q3.708 17.708 3 17t-.708-1.75V5.375q0-.417.156-.833.156-.417.448-.709l1.125-1.104q.333-.291.76-.489t.844-.198h8.75q.417 0 .844.198t.76.489l1.125 1.104q.292.292.448.709.156.416.156.833v9.875q0 1.042-.708 1.75t-1.75.708Zm0-12.208h10.5l-1-1h-8.5ZM10 14.083l3.375-3.354-1.333-1.375-1.084 1.084V7.354H9.042v3.084L7.958 9.354l-1.333 1.375Z"/></svg>
                                            </a>
                                            <a href="../employee/employee-attendance-payroll.php?edit=<?php echo $rows['id']; ?>" id="archive-action" class="action-btn" name="action">
                                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M3.5 10h13V7h-13ZM16 18v-2.5h-2.5V14H16v-2.5h1.5V14H20v1.5h-2.5V18ZM3.5 16q-.604 0-1.052-.438Q2 15.125 2 14.5v-9q0-.625.448-1.062Q2.896 4 3.5 4h13q.604 0 1.052.438Q18 4.875 18 5.5V10h-2.188q-1.666 0-2.739 1.177T12 13.958V16Z"/></svg>
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
            <h1 class="addnew-title">PROCESS PAYROLL</h1>
            <div class="a-header">
                <label class="archive-header"> Are you sure to process the payroll of selected rows?</label>
            </div>
            <div class="bot-buttons">
                <div class="CancelButton">
                    <a href="../employee/employee-attendance.php" id="cancel">CANCEL</a>
                </div>
                <div class="AddButton">
                    <button type="submit" id="addcustomerBtn" name="submit-payroll-attendance[]">PROCESS</button>
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
                    <div class="main-user-info">
                        <div class="usertype-dropdown">
                            <?php
                            $dropdown_query = "SELECT * FROM employee";
                            $employee_result = mysqli_query($con, $dropdown_query);
                            ?>
                            <select class="select" name="employee_id" required="required" >
                                <option selected disabled value="">SELECT EMPLOYEE</option>
                                <?php while($employee = mysqli_fetch_array($employee_result)):;?>
                                    <option value="<?php echo $employee['id']?>">
                                        <?php echo $employee['first_name'].' '.$employee['middle_name'].' '.$employee['last_name'];?>
                                    </option>
                                <?php endwhile;?>
                            </select>
                        </div>
                        <div class="user-input-box">
                            <label for="dateofattendance">Date of Attendance</label>
                            <input type="date"
                                   class="date"
                                   id="dateofattendance"
                                   name="date_of_attendance"
                                   required="required"
                                   onchange="console.log(this.value);" />
                        </div>
                        <div class="user-input-box">
                            <label for="timein">Time In</label>
                            <input type="time"
                                   class="timein"
                                   id="timein"
                                   name="time_in"
                                   required="required"
                                   onchange="console.log(this.value);" />
                        </div>
                        <div class="user-input-box">
                            <label for="timeout">Time Out</label>
                            <input type="time"
                                   class="timeout"
                                   id="timeout"
                                   name="time_out"
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
                                   name="additional_bonus"
                                   placeholder="0.00"/>
                        </div>
                        <div class="user-input-box" id="note-box">
                            <label for="note">Note</label>
                            <input type="text"
                                   id="note" class="note" name="note" placeholder="Enter a Note"/>
                        </div>
                        <div class="radio-button">
                            <div class="salary-cateogory" >
                                <input type="radio" name="is_whole_day" id="Yes" value="Yes" required="required" checked="checked">
                                <label for="Yes">Whole Day</label>
                                <input type="radio" name="is_whole_day" id="No" value="No">
                                <label for="No">Half Day</label>
                            </div>
                        </div>

                        <div class="line"></div>

                        <div class="bot-buttons">
                            <div class="CancelButton">
                                <a href="../employee/employee-attendance.php" id="cancel">CANCEL</a>
                            </div>
                            <div class="AddButton">
                                <button type="submit" id="adduserBtn" name="add-employee-attendance">SAVE</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </form>
</div>
</body>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/employee-attendance.js"></script>
<script src="../javascript/settings-data-archive-check-all.js"></script>
</html>
<script>
    //Add New User
    function addnewuser(){
        document.querySelector(".bg-addAttendanceForm").style.display = 'flex';
    }
</script>
