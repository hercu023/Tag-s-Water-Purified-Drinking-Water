<?php
session_start();
require_once '../service/edit-account.php';
require_once "../service/user-access.php";

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'ACCOUNT-USER_ACCOUNT')) {
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
    <link rel="stylesheet" type="text/css" href="../CSS/account-action.css">
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/galhau-display" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/outfit" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/malberg-trial" rel="stylesheet">
    <title>Tag's Water Purified Drinking Water</title>
</head>
<body >

<div class="container">
    <div class="block"></div>

    <?php
    include('../common/side-menu.php')
    ?>

    <main>
        <div class="main-account">
            <h1 class="accTitle">ACCOUNT</h1>
            <div class="sub-tab">
                <div class="user-title">
                    <h2> User Account </h2>
                </div>
                <div class="newUser-button">
                    <button type="submit" id="add-userbutton" class="add-account">
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
                        <th>Contact Number</th>
                        <th>Role</th>
                        <th>Picture</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td>
                            <a href="account-edit.php?edit=" id="edit-action" class="action-btn" name="action">
                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.25 15.75h1.229l7-7-1.229-1.229-7 7Zm11.938-8.208-3.73-3.73 1.021-1.02q.521-.521 1.24-.521t1.239.521l1.25 1.25q.5.5.5 1.239 0 .74-.5 1.24Zm-1.23 1.229L6.229 17.5H2.5v-3.729l8.729-8.729Zm-3.083-.625-.625-.625 1.229 1.229Z"/></svg>
                            </a>
                            <a href="account-action-change-password.php?edit=" id="cpass-action" class="action-btn" name="action">
                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M10 17q-1.688 0-3.104-.719-1.417-.719-2.375-1.927l1.062-1.083q.75 1.021 1.896 1.625Q8.625 15.5 10 15.5q2.271 0 3.885-1.615Q15.5 12.271 15.5 10t-1.615-3.885Q12.271 4.5 10 4.5q-2.292 0-3.917 1.635-1.625 1.636-1.583 3.99l1.188-1.187L6.75 10l-3 3-3-3 1.062-1.062L3 10.146q-.021-1.5.531-2.813.552-1.312 1.511-2.27Q6 4.104 7.281 3.552 8.562 3 10.021 3q1.437 0 2.708.552 1.271.552 2.219 1.5t1.5 2.219Q17 8.542 17 10q0 2.917-2.042 4.958Q12.917 17 10 17Zm-1.5-4q-.312 0-.531-.219-.219-.219-.219-.531V10q0-.312.219-.531.219-.219.531-.219V8.5q0-.625.438-1.062Q9.375 7 10 7t1.062.438q.438.437.438 1.062v.75q.312 0 .531.219.219.219.219.531v2.25q0 .312-.219.531-.219.219-.531.219Zm.75-3.75h1.5V8.5q0-.312-.219-.531-.219-.219-.531-.219-.312 0-.531.219-.219.219-.219.531Z"/></svg>
                            </a>
                            <a href="Account-Action-Archive.php?edit=" id="archive-action" class="action-btn" name="action">
                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M6.5 17q-.625 0-1.062-.438Q5 16.125 5 15.5v-10H4V4h4V3h4v1h4v1.5h-1v10q0 .625-.438 1.062Q14.125 17 13.5 17Zm7-11.5h-7v10h7ZM8 14h1.5V7H8Zm2.5 0H12V7h-1.5Zm-4-8.5v10Z"/></svg>
                            </a>
                        </td>
                    <tr id="noRecordTR" style="display:none">
                        <td colspan="9">No Record Found</td>
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
if(isset($_GET['edit']))
{
    $id = $_GET['edit'];
    $result = mysqli_query($con, "SELECT 
            users.user_id,
            users.last_name,
            users.first_name,
            users.middle_name,
            users.email,
            users.contact_number,
            users.profile_image, 
            account_type.user_type 
            FROM users 
            INNER JOIN account_type 
            ON users.account_type_id = account_type.id
            WHERE user_id='$id'");

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result); ?>

        <form action="" method="post" enctype="multipart/form-data" id="adduserFrm">
            <div class="bg-adduserform" id="bg-addform">
                <div class="message"></div>
                <div class="container1">
                    <div class="profile-pic">
                        <img src="../uploaded_image/<?=$user['profile_image'];?>" alt="">
                    </div>
                    <h1 class="addnew-title">EDIT ACCOUNT</h1>
                    <form action="#">
                        <input type="hidden" required="required" name="status" value="1">
                        <input type="hidden" required="required" name="user_id" value="<?=$user['user_id'];?>">
                        <div class="main-user-info">
                            <div class="user-input-box">
                                <label for="lastname">Last Name</label>
                                <input type="text"
                                       id="lastname"
                                       name="last_name"
                                       required="required"
                                       placeholder="Enter Last Name"value="<?=$user['last_name'];?>">
                            </div>
                            <div class="user-input-box">
                                <label for="firstname">First Name</label>
                                <input type="text"
                                       id="firstname"
                                       name="first_name"
                                       required="required"
                                       placeholder="Enter First Name"value="<?=$user['first_name'];?>">
                            </div>
                            <div class="user-input-box">
                                <label for="middlename">Middle Name</label>
                                <input type="text"
                                       id="middlename"
                                       name="middle_name"
                                       required="required"
                                       placeholder="Enter Middle Name"value="<?=$user['middle_name'];?>">
                            </div>
                            <div class="user-input-box" id="email-box">
                                <label for="email" class="email-label">Email <span class="not-edit">(Not Editable)</span></label>

                                <input type="text"
                                       id="email"
                                       name="email"
                                       required="required"
                                       readonly
                                       placeholder="Enter Email"value="<?=$user['email'];?>"/>
                            </div>

                            <div class="user-input-box">
                                <label for="contactnum">Contact Number</label>
                                <input type="text" min='0' onkeypress='return isNumberKey(event)'
                                       id="contactnum"
                                       name="contact_num"
                                       placeholder='0'
                                       required="required"value="<?=$user['contact_number'];?>">
                            </div>

                            <div class="usertype-dropdown">
                                <?php
                                $dropdown_query = "SELECT * FROM account_type WHERE is_deleted = 0";
                                $account_type_result = mysqli_query($con, $dropdown_query);
                                ?>
                                <select class="select" name="user_types" required="">
                                    <option selected disabled value="">SELECT ROLE</option>
                                    <?php while($account_type = mysqli_fetch_array($account_type_result)):?>
                                        <option value="<?php echo $account_type['id']?>"
                                            <?php
                                            if($user['user_type'] === $account_type['user_type'])
                                            {
                                                echo 'selected';
                                            }
                                            ?>>
                                            <?php echo $account_type['user_type'];?>
                                        </option>
                                    <?php endwhile;?>
                                </select>
                            </div>
                            <span class="gender-title">Profile Picture</span>
                            <div class="choose-profile">
                                <input type="file"value="<?=$user['profile_image'];?>" id="image-profile" name="profile_image" accept="image/jpg, image/png, image/jpeg" >
                            </div>
                            <div class="line"></div>

                            <div class="bot-buttons">
                                <div class="CancelButton">
                                    <a href="account.php" id="cancel">CANCEL</a>
                                </div>
                                <div class="AddButton">
                                    <button type="submit" id="adduserBtn" name="update-account">SAVE</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </form>
        
    <?php }}else{
           echo '<script> location.replace("../accounts/account.php"); </script>';
    } ?>
</body>
</html>
<script src="../javascript/account-type.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/d3js/7.6.1/d3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->