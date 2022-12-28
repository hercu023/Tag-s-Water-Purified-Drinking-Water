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
    <link rel="stylesheet" type="text/css" href="../CSS/settings-dataarchive-inventory.css">
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
            <div class="message"> <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> No rows selected.</div>
            <div class="sub-tab">

                <div class="user-title">
                    <h2> Archive </h2>
                </div>

                <div class="sub-tab2">
                    <div class="delivery-options">
                        <select class="select" onchange="window.location.href=this.value;" >
                            <option selected disabled value="">SELECT DATA</option>
                            <option value="../settings/settings-data-archive-account.php">Account</option>
                            <option value="../settings/settings-data-archive-customers.php">Customers</option>
                            <option value="../settings/settings-data-archive-employees.php">Employee</option>
                            <option value="../settings/settings-data-archive-inventory.php" selected>Inventory</option>
                            <option value="../settings/settings-data-archive-expense.php">Expense</option>
                            <option value="../settings/settings-data-archive-attendance.php">Attendance</option>
                        </select>
                    </div>
                    <div class="newUser-button">
                        <button type="submit" name="" id="add-userbutton" class="add-account" onclick="selectRestore()" >
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
                <h3 class="word">Inventory</h3>
                <div class="customer-container">
                    <form action="../service/restore-settings.php" method="post" id="frm">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Item Name</th>
                                <th>Type</th>
                                <th>POS</th>
                                <th>Reorder Level</th>
                                <th>SRP</th>
                                <th>Alkaline Price</th>
                                <th>Mineral Price</th>
                                <th>Image</th>
                                <th>Date/Time Added</th>
                                <th>Added By</th>
                                <th class="select-label">RESTORE</th>
                            </tr>
                            </thead>


                            <tbody>
                            <?php
                            $inventory = "SELECT
                            inventory_item.id,
                            inventory_item.item_name,
                            category_type.name,
                            pos_item.pos_type,
                            inventory_item.reorder_level,
                            inventory_item.selling_price_item,
                            inventory_item.alkaline_price,
                            inventory_item.mineral_price,
                            inventory_item.image,
                            status_archive.status,
                            inventory_item.created_at,
                            users.first_name,
                            users.last_name
                            FROM inventory_item
                            INNER JOIN category_type
                            ON inventory_item.category_by_id = category_type.id
                            INNER JOIN pos_item
                            ON inventory_item.pos_item_id = pos_item.id
                            INNER JOIN status_archive
                            ON inventory_item.status_archive_id = status_archive.id
                            INNER JOIN users
                            ON inventory_item.created_by = users.user_id
                            WHERE inventory_item.status_archive_id = '2'";
                            $inventory_run = mysqli_query($con, $inventory);

                            if(mysqli_num_rows($inventory_run) > 0)
                            {
                                foreach($inventory_run as $rows)
                                {
                                    ?>
                                    <tr >
                                        <td class="select-check"><input type="checkbox" name="select-check[]" id="<?php echo $rows['id']; ?>" value="<?php echo $rows['id']; ?>" ></td>
                                        <td> <?php echo $rows['id']; ?></td>
                                        <td> <?php echo $rows['item_name']; ?></td>
                                        <td> <?php echo $rows['name']; ?></td>
                                        <td> <?php echo $rows['pos_item']; ?></td>
                                        <td> <?php echo $rows['reorder_level']; ?></td>
                                        <td> <?php echo $rows['selling_price_item']; ?></td>
                                        <td> <?php echo $rows['alkaline_refill_price']; ?></td>
                                        <td> <?php echo $rows['mineral_refill_price']; ?></td>
                                        <td> <img src="<?php echo "../uploaded_image/".$rows['image']; ?>" alt='No Image' width="50px"></td>
                                        <td> <?php echo $rows['created_at']; ?></td>
                                        <td> <?php echo $rows['first_name'] .' '. $rows['last_name'] ; ?></td>
                                        <td>
                                            <a href="settings-confirm-restore-inventory.php?edit=<?php echo $rows['id']; ?>" id="archive-action" class="action-btn" name="action">
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
            <h1 class="addnew-title">RESTORE INVENTORY</h1>
            <form action="#">
                <div class="a-header">
                    <label class="archive-header"> Are you sure to Restore the selected rows?</label>
                </div>
                <div class="bot-buttons">
                    <div class="CancelButton">
                        <a href="../settings/settings-data-archive-inventory.php" id="cancel">CANCEL</a>
                    </div>
                    <div class="AddButton">
                        <button type="submit" id="addcustomerBtn" name="submit-checkall-inventory[]">RESTORE</button>
                    </div>
                </div>
        </div>
    </div>
</body>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/settings-data-archive-check-all.js"></script>
</html>

