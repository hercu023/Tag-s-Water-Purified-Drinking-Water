<?php
require_once "../database/connection-db.php";
require_once '../service/add-employee.php';
require_once "../service/user-access.php";

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'EMPLOYEE-LIST')) {
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
    <link rel="stylesheet" type="text/css" href="../CSS/employee-list.css">
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

</head>
<body>
<div class="container">

    <?php
    include('../common/side-menu.php')
    ?>

    <main>
        <div class="main-customer">
            <h1 class="accTitle">EMPLOYEE</h1>
            <?php
            if (isset($_GET['error'])) {
                echo '<p id="myerror" class="error-error"> '.$_GET['error'].' </p>';
            }
            ?>
            <div class="sub-tab">
                <div class="user-title">
                    <h2> EMPLOYEE LIST </h2>
                </div>
                <div class="sub-tab2">
                    <div class="newUser-button">
                        <button type="button" id="add-userbutton" class="add-account" onclick="addnewuser();">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 14h1.5v-3.25H14v-1.5h-3.25V6h-1.5v3.25H6v1.5h3.25Zm.75 4q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                            <h3>Add New Employee</h3>
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
            <div class="customer-container">
                <table class="table" id="myTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Position</th>
                        <th>Daily Rate</th>
                        <th>Date of Birth</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Date/Time Added</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <?php
                    $query = "SELECT 
                                employee.id,
                                employee.first_name,
                                employee.middle_name,
                                employee.last_name,
                                employee.daily_rate,
                                employee.date_of_birth,
                                employee.email_address,
                                employee.contact_number,
                                employee.date_created,
                                position_type.name
                                FROM employee
                                INNER JOIN position_type 
                                ON employee.position_id = position_type.id
                                WHERE employee.status_archive_id = 1";
                    $result = mysqli_query($con, $query);
                    if(mysqli_num_rows($result) > 0)
                    {
                    foreach($result as $rows)
                    {
                    ?>
                    <tbody>
                    <tr>
                        <td> <?php echo $rows['id']; ?></td>
                        <td> <?php echo $rows['first_name'].' '.$rows['middle_name'].' '.$rows['last_name']; ?></td>
                        <td> <?php echo $rows['name']; ?></td>
                        <td> <?php echo '<span>&#8369;</span>' .' '. $rows['daily_rate']; ?></td>
                        <td> <?php echo $rows['date_of_birth']; ?></td>
                        <td> <?php echo $rows['email_address']; ?></td>
                        <td> <?php echo $rows['contact_number']; ?></td>
                        <td> <?php echo $rows['date_created']; ?></td>
                        <td>
                            <a href="../employee/employee-list-edit.php?edit=<?php echo $rows['id']; ?>" id="edit-action" class="action-btn" name="action">
                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.521 17.479v-2.437l4.562-4.563 2.438 2.438-4.563 4.562Zm-7-3.958v-2.459h7.271v2.459Zm14.583-1.188-2.437-2.437.666-.667q.355-.354.865-.364.51-.011.864.364l.709.709q.375.354.364.864-.01.51-.364.865ZM2.521 9.75V7.292h9.958V9.75Zm0-3.771V3.521h9.958v2.458Z"/></svg>
                                <span id="tooltipText">EDIT</span>       
                            </a>
                            <a href="../employee/employee-archive.php?edit=<?php echo $rows['id']; ?>" id="archive-action" class="action-btn" name="action">
                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.75 17.708Q3.708 17.708 3 17t-.708-1.75V5.375q0-.417.156-.833.156-.417.448-.709l1.125-1.104q.333-.291.76-.489t.844-.198h8.75q.417 0 .844.198t.76.489l1.125 1.104q.292.292.448.709.156.416.156.833v9.875q0 1.042-.708 1.75t-1.75.708Zm0-12.208h10.5l-1-1h-8.5ZM10 14.083l3.375-3.354-1.333-1.375-1.084 1.084V7.354H9.042v3.084L7.958 9.354l-1.333 1.375Z"/></svg>
                                <span id="tooltipText">ARCHIVE</span>       
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php } else { ?>
                        <tr id="noRecordTR">
                            <td colspan="15">No Record(s) Found</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <?php
    include('../common/top-menu.php')
    ?>

</div>

<form action="" method="post" enctype="multipart/form-data" id="addcustomerFrm">
    <div class="bg-addcustomerform" id="bg-addform">
        <div class="message"></div>
        <div class="container1">
            <h1 class="addnew-title">ADD NEW EMPLOYEE</h1>
            <form action="#">
                <input type="hidden" required="required" name="status" value="1">
                <div class="main-user-info">
                    <div class="user-input-box">
                        <label for="lastname">Last Name</label>
                        <input type="text"
                               id="lastname"
                               name="last_name"
                               required="required"
                               placeholder="Enter Last Name"/>
                    </div>
                    <div class="user-input-box">
                        <label for="firstname">First Name</label>
                        <input type="text"
                               id="firstname"
                               name="first_name"
                               required="required"
                               placeholder="Enter First Name"/>
                    </div>
                    <div class="user-input-box">
                        <label for="middlename">Middle Name</label>
                        <input type="text"
                               id="middlename"
                               name="middle_name"
                               required="required"
                               placeholder="Enter Middle Name"/>
                    </div>
                    <div class="usertype-dropdown">
                        <?php
                        $dropdown_query = "SELECT * FROM position_type";
                        $position_type_result = mysqli_query($con, $dropdown_query);
                        ?>
                        <select class="select" name="position_types" required="" >
                            <option selected disabled value="">SELECT POSITION</option>
                            <?php while($account_type = mysqli_fetch_array($position_type_result)):;?>
                                <option value="<?php echo $account_type['id']?>">
                                    <?php echo $account_type['name'];?>
                                </option>
                            <?php endwhile;?>
                        </select>
                    </div>
                    <div class="user-input-box">
                        <label for="dateofbirth">Date of Birth</label>
                        <input type="date"
                               class="date"
                               id="dateofbirth",
                               name="date_of_birth"
                               required="required"
                               onchange="console.log(this.value);" />
                    </div>
                    <div class="user-input-box">
                        <label for="dailyrate">Daily Rate</label>
                        <input min='0' onchange='setTwoNumberDecimal' step="0.25"
                               id="dailyrate"
                               class="dailyrate"
                               name="daily_rate"
                               placeholder="0.00"/>
                    </div>
                    <div class="user-input-box">
                        <label for="email">Email Address</label>
                        <input type="text"
                               id="email"
                               name="email"
                               placeholder='Enter Email Address'
                               required="required"/>
                    </div>
                    <div class="user-input-box">
                        <label for="contactnum">Contact Number</label>
                        <input type="text" min='0' onkeypress='return isNumberKey(event)'
                               id="contact_num"
                               name="contact_num"
                               placeholder='Enter Contact Number'
                               required="required"/>
                    </div>
                    <div class="line"></div>

                    <div class="bot-buttons">
                        <div class="CancelButton">
                            <a href="../employee/employee-list.php" id="cancel">CANCEL</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script src="../index.js"></script>
<script src="../javascript/customer.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/d3js/7.6.1/d3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</html>
