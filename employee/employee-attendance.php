<?php
require_once '../service/add-employee-attendance.php';
require_once "../service/user-access.php";
require_once '../service/payroll-attendance.php';

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
    <link rel="stylesheet" type="text/css" href="../CSS/pagination.css">
    <title>Tag's Water Purified Drinking Water</title>
</head>
<!-- <style>
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

</style> -->
<body>
<div class="container">
    <div class="block"></div>

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

                $query = "SELECT COUNT(*) FROM attendance 
                WHERE attendance.status_archive_id = 1";     
                $rs_result = mysqli_query($con, $query);     
                $row = mysqli_fetch_row($rs_result);     
                $total_records = $row[0];     
                $page_location = '../employee/employee-attendance.php';
                $start_from = ($page - 1) * $per_page_record;  
                    
            ?>
    <main>
        <div class="main-account">
            <h1 class="accTitle">EMPLOYEE</h1>
            <?php
            if (isset($_GET['error'])) {
                echo '<p id="myerror" class="error-error"> '.$_GET['error'].' </p>';
            }
            ?>
             <div class="sub-tab">
                <div class="user-title">
                    <h2> ATTENDANCE/PAYROLL </h2>
                </div>
                <div class="sub-tab2">
                    <div class="newUser-button">
                        <button type="button" id="add-userbutton" class="add-account" onclick="addnewuser();">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 14h1.5v-3.25H14v-1.5h-3.25V6h-1.5v3.25H6v1.5h3.25Zm.75 4q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                            <h3>Add Attendance</h3>
                        </button>
                    </div>
                    <div class="newUser-button">
                        <button type="submit" id="add-payroll" class="payroll" onclick="selectRestore()">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M3.5 10h13V7h-13ZM16 18v-2.5h-2.5V14H16v-2.5h1.5V14H20v1.5h-2.5V18ZM3.5 16q-.604 0-1.052-.438Q2 15.125 2 14.5v-9q0-.625.448-1.062Q2.896 4 3.5 4h13q.604 0 1.052.438Q18 4.875 18 5.5V10h-2.188q-1.666 0-2.739 1.177T12 13.958V16Z"/></svg>
                            <h3>PAY SALARY</h3>
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
            <form action="" method="post" enctype="multipart/form-data">

            <div class="account-container">
                <table class="table" id="myTable">
                    <thead>
                            <tr>
                                <th scope="col"></th>
                                <!-- <th scope="col">ID</th> -->
                                <th scope="col">Employee Name</th>
                                <th scope="col">Position</th>
                                <th scope="col">With Uniform</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time In</th>
                                <th scope="col">Time Out</th>
                                <th scope="col">Deduction</th>
                                <th scope="col">Bonus</th>
                                <th scope="col">Note</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Added By</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php
                                $attendance = "SELECT 
                                attendance.id,
                                attendance.with_uniform,
                                attendance.date,
                                attendance.time_in,
                                attendance.time_out,
                                attendance.deduction,
                                attendance.bonus, 
                                attendance.note,
                                attendance.total_amount,
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
                                ORDER BY attendance.date DESC,
                                attendance.id DESC
                                LIMIT $start_from, $per_page_record";
                                $attendance_run = mysqli_query($con, $attendance);

                                if(mysqli_num_rows($attendance_run) > 0)
                                {
                                    foreach($attendance_run as $rows)
                                    {
                            ?>
                                    <tr>
                                        <td  class="select-check"><input type="checkbox" name="select-check[]" id="<?php echo $rows['id']; ?>" value="<?php echo $rows['id']; ?>" ></td>
                                        <!-- <td data-label="ID"> <?php echo $rows['id']; ?></td> -->
                                        <td data-label="Employee Name"> <?php echo $rows['emp_first_name'].' '.$rows['emp_middle_name'].' '.$rows['emp_first_name'] ; ?></td>
                                        <td data-label="Position"> <?php echo $rows['position_type'] ; ?></td>
                                        <td data-label="Whole Day"> <?php  if ($rows['with_uniform'] == 1) { echo '<span class="instock">YES</span>'; } else echo '<span class="lowstock">NO </span>'; ?></td>
                  
                                        <td data-label="Date"> <?php echo $rows['date']; ?></td>
                                        <td data-label="Time In"> <?php echo $rows['time_in']; ?></td>
                                        <td data-label="Time Out"> <?php echo $rows['time_out']; ?></td>
                                        <td data-label="Deduction"> <?php echo '<span>&#8369;</span>'.' '.number_format($rows['deduction'], '2','.',','); ?></td>
                                        <td data-label="Bonus"> <?php echo '<span>&#8369;</span>'.' '.number_format($rows['bonus'], '2','.',','); ?></td>
                                        <td data-label="Note"> <?php echo $rows['note']; ?></td>
                                        <td data-label="Total"> <?php echo '<span>&#8369;</span>'.' '.number_format($rows['total_amount'], '2','.',','); ?></td>
                                        <td data-label="Status"> 
                                        <?php 
                                            if($rows['payroll_status'] == 0){
                                                echo '<span class="outofstock">Unpaid</span>';
                                            }else{
                                                echo '<span class="instock">Paid</span>';
                                            } ?>
                                        </td>
                                        <td data-label="Added By"> <?php echo $rows['usr_first_name'].' '.$rows['usr_last_name']; ?></td>

                                        <td  class="hrefa">
                                            <a href="../employee/employee-attendance-edit.php?edit=<?php echo $rows['id']; ?>" id="edit-action" class="edit-action" name="action">
                                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.521 17.479v-2.437l4.562-4.563 2.438 2.438-4.563 4.562Zm-7-3.958v-2.459h7.271v2.459Zm14.583-1.188-2.437-2.437.666-.667q.355-.354.865-.364.51-.011.864.364l.709.709q.375.354.364.864-.01.51-.364.865ZM2.521 9.75V7.292h9.958V9.75Zm0-3.771V3.521h9.958v2.458Z"/></svg>
                                                <span id="tooltipText">EDIT</span>       
                                            </a>
                                            <a href="../employee/employee-attendance-archive.php?edit=<?php echo $rows['id']; ?>" id="archive-action" class="archive-action" name="action">
                                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.75 17.708Q3.708 17.708 3 17t-.708-1.75V5.375q0-.417.156-.833.156-.417.448-.709l1.125-1.104q.333-.291.76-.489t.844-.198h8.75q.417 0 .844.198t.76.489l1.125 1.104q.292.292.448.709.156.416.156.833v9.875q0 1.042-.708 1.75t-1.75.708Zm0-12.208h10.5l-1-1h-8.5ZM10 14.083l3.375-3.354-1.333-1.375-1.084 1.084V7.354H9.042v3.084L7.958 9.354l-1.333 1.375Z"/></svg>
                                                <span id="tooltipText">ARCHIVE</span>       
                                            </a>
                                            <a href="../employee/employee-attendance-payroll.php?edit=<?php echo $rows['id']; ?>" id="payroll-action" class="payroll-action" name="action">
                                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M3.5 10h13V7h-13ZM16 18v-2.5h-2.5V14H16v-2.5h1.5V14H20v1.5h-2.5V18ZM3.5 16q-.604 0-1.052-.438Q2 15.125 2 14.5v-9q0-.625.448-1.062Q2.896 4 3.5 4h13q.604 0 1.052.438Q18 4.875 18 5.5V10h-2.188q-1.666 0-2.739 1.177T12 13.958V16Z"/></svg>
                                                <span id="tooltipText">PAY SALARY</span>       
                                            </a>
                                            <a href="../employee/employee-attendance-payslip.php?edit=<?php echo $rows['id']; ?>" id="payslip-action" class="payroll-action" name="action">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M15 6H5V3h10Zm-.25 4.5q.312 0 .531-.219.219-.219.219-.531 0-.312-.219-.531Q15.062 9 14.75 9q-.312 0-.531.219Q14 9.438 14 9.75q0 .312.219.531.219.219.531.219Zm-1.25 5v-3h-7v3ZM15 17H5v-3H2V9q0-.833.583-1.417Q3.167 7 4 7h12q.833 0 1.417.583Q18 8.167 18 9v5h-3Z"/></svg>
                                                <span id="tooltipText">PRINT</span>       
                                            </a>
                                        </td>
                                    </tr>
                                    <?php }?>
                 
                 <?}else{ ?>
                         <tr class="noRecordTR" style="display:none">
                             <td colspan="9">No Record Found</td>
                         </tr>
                         <?php }?>
                        </tbody>
                </table>
            </div>

        </div>

        <div class="pagination">   
                <div class="page-navigation">
                    <div class="href-pages">   
                        <?php  

                            // Number of pages required.   
                            $total_pages = ceil($total_records / $per_page_record);     
                            $pageLink = "";       
                        
                            if($page>=2){   
                                echo "<a href='".$page_location."?page=".($page-1)."&records=".$per_page_record."'> Prev </a>";   
                            }       
                                    
                            for ($i=1; $i<=$total_pages; $i++) {   
                            if ($i == $page) {   
                                $pageLink .= "<a class = 'active' href='".$page_location."?page=".$i."&records=".$per_page_record."'>".$i." </a>";   
                            }               
                            else  {   
                                $pageLink .= "<a href='".$page_location."?page=".$i."&records=".$per_page_record."'>".$i." </a>";     
                            }   
                            }; 

                            echo $pageLink;   
                    
                            if($page<$total_pages){   
                                echo "<a href='".$page_location."?page=".($page + 1)."&records=".$per_page_record."'>  Next </a>";   
                            }  
                        ?>
                    </div>
                    <div class="dropdown-pages">   
                        <select name="option" class="pages" onchange="location ='<?php echo $page_location ?>' + '?page=1&records=' + this.value;">
                                <option value="5" <?php if($per_page_record == "5") { echo 'selected'; }?>>5</option>
                                <option value="10" <?php if($per_page_record == "10") { echo 'selected'; }?>>10</option>
                                <option value="50" <?php if($per_page_record == "50") { echo 'selected'; }?>>50</option>
                                <option value="100" <?php if($per_page_record == "100") { echo 'selected'; }?>>100</option>
                                <option value="250" <?php if($per_page_record == "250") { echo 'selected'; }?>>250</option>
                                <option value="500" <?php if($per_page_record == "500") { echo 'selected'; }?>>500</option>
                                <option value="1000" <?php if($per_page_record == "1000") { echo 'selected'; }?>>1000</option>
                        </select>
                        <span class="label-number"> No. of Records Per Page </span>  
                    </div>
                    
                    <div class="inline">   
                        <input id="page" type="number" class="input-pages" min="1" max="<?php echo $total_pages?>"   
                        placeholder="<?php echo $page." - ".$total_pages; ?>" required value="1"> 

                        <span class="gotopage-btn" onClick="goToPage('<?php echo $page_location.'?records='.$per_page_record?>');">Go to page</span>   
                    </div>    
                </div>
        </div>
            
    </main>

        <div class="top-menu">
                <div class="menu-bar">
                    <div class="menu-btn2">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h2 class="Title-top">EMPLOYEE</h2>
                    <h4 class="subTitle-top">Attendance</h2>
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

</div>
    <div class="bg-addcustomerform" id="bg-addform">
        <div class="container1">
            <h1 class="addnew-title">PAY SALARY</h1>
            <div class="a-header">
                <label class="archive-header"> Are you sure to generate salary of selected rows?</label>
            </div>
            <div class="bot-buttons">
                <div class="CancelButton">
                    <a href="../employee/employee-attendance.php" id="cancel">CANCEL</a>
                </div>
                <div class="AddButton">
                    <button type="submit" id="addcustomerBtn" name="submit-payroll-attendance">PROCESS</button>
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
                            <input min='0' onchange='setTwoNumberDecimal' step="0.25" value="0.00"
                                   id="deduction"
                                   class="deduction"
                                   name="deduction"
                                   placeholder="0.00"/>
                        </div>
                        <div class="user-input-box">
                            <label for="additonalbonus">Addtional Bonus</label>
                            <input min='0' onchange='setTwoNumberDecimal' step="0.25" value="0.00"
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
                                <input type="radio" name="is_with_uniform" id="Yes" value="Yes" required="required" checked="checked">
                                <label for="Yes">With Uniform</label>
                                <input type="radio" name="is_with_uniform" id="No" value="No">
                                <label for="No">No Uniform</label>
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
</body>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/settings-data-archive-check-all.js"></script>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/employee-attendance.js"></script>
<script src="../javascript/employee-attendance-search.js"></script>
<script src="../javascript/employee-attendance-forms.js"></script>
</html>
<script>
    
    // const addForm1 = document.querySelector(".bg-addAttendanceForm");
    function addnewuser(){
        document.querySelector(".bg-addAttendanceForm").style.display = 'flex';
    }
    function goToPage(reference) {   
    var page = document.getElementById("page").value;   
    page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
    window.location.href = reference + '&page=' + page;   
    } 
</script>
