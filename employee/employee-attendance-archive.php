<?php
require_once '../service/archive-employee-attendance.php';
require_once "../service/user-access.php";

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'EMPLOYEE-ATTENDANCE')) {
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
    <link rel="stylesheet" type="text/css" href="../CSS/employee-archive.css">
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
            <div class="sub-tab">
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
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php
    include('../common/top-menu.php')
    ?>

</div>

<?php
if(isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = mysqli_query($con, "SELECT * FROM attendance WHERE id = '$id'");

    if (mysqli_num_rows($result) > 0) {
        $attendance = mysqli_fetch_assoc($result); ?>

        <form action="" method="post" enctype="multipart/form-data" id="addcustomerFrm">
            <div class="bg-addcustomerform" id="bg-addform">
                <div class="message"></div>
                <div class="container1">
                    <h1 class="addnew-title">ARCHIVE ATTENDANCE</h1>
                    <form action="#">
                        <input type="hidden" required="required" name="id" value="<?=$attendance['id'];?>">

                        <div class="a-header">
                            <label class="archive-header"> Do you want to Archive Attendance with id: <?=$attendance['id'];?> ?</label>
                        </div>
                        <div class="bot-buttons">
                            <div class="CancelButton">
                                <a href="../employee/employee-attendance.php" id="cancel">CANCEL</a>
                            </div>
                            <div class="AddButton">
                                <button type="submit" id="addcustomerBtn" name="archive-employee-attendance">ARCHIVE</button>
                            </div>
                        </div>
                </div>
        </form>
    <?php }}?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/d3js/7.6.1/d3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script src="../index.js"></script>
<script src="../javascript/customer-edit.js"></script>
</html>
