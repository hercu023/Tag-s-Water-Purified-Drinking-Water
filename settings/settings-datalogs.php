<?php
session_start();
require_once '../database/connection-db.php';
require_once "../service/user-access.php";

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'SETTINGS-DATA_LOGS')) {
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
    <link rel="stylesheet" type="text/css" href="../CSS/reports-datalogs.css">
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/galhau-display" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/malberg-trial" rel="stylesheet">
    <title>Tag's Water Purified Drinking Water</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
</head>
<body>
<div class="container">

    <?php
    include('../common/side-menu.php')
    ?>

    <main>
        <div class="main-customer">
            <h1 class="accTitle">SETTINGS - DATA LOGS</h1>
            <div class="sub-tab">
                <div class="search">
                    <div class="search-bar">
                        <input text="text" placeholder="Search" onkeyup='table_reports_data_logs_search()' id="searchInput" name="searchInput"/>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Module</th>
                        <th>Status</th>
                        <th>Data</th>
                        <th>Date/Time Logged</th>
                    </tr>
                    </thead>

                    <?php
                    $query = "SELECT audit_trail.id,
                                module.name,
                                users.first_name,
                                users.last_name,
                                users.email,
                                audit_trail.status,
                                audit_trail.data,
                                audit_trail.date_log
                                FROM audit_trail 
                                INNER JOIN module 
                                ON audit_trail.module_id = module.id
                                INNER JOIN users
                                ON audit_trail.user_id = users.user_id";
                    $result = mysqli_query($con, $query);
                    while ($rows = mysqli_fetch_assoc($result)) {?>
                        <tbody>
                        <tr>
                            <td> <?php echo $rows['id']; ?></td>
                            <td> <?php echo $rows['first_name'] .' '. $rows['last_name']; ?></td>
                            <td> <?php echo $rows['email']; ?></td>
                            <td> <?php echo $rows['name']; ?></td>
                            <td> <?php if ($rows['status'] == 1) {
                                    echo 'Success';
                                } else {
                                    echo 'Failed';
                                } ?>
                            </td>
                            <td> <?php echo $rows['data']; ?></td>
                            <td> <?php echo $rows['date_log']; ?></td>
                        </tr>
                        <tr id="noRecordTR" style="display:none">
                            <td colspan="6">No Record Found</td>
                        </tr>
                        </tbody>
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </main>

    <?php
    include('../common/top-menu.php')
    ?>

</div>
</body>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/reports-datalogs.js"></script>
</html>
