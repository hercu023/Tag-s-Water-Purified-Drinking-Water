<?php
session_start();
require_once '../service/add-account.php';
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
    <link rel="stylesheet" type="text/css" href="../CSS/account.css">
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
    <div class="block"></div>

    <?php
    include('../common/side-menu.php')
    ?>

    <main>
        <div class="main-account">
            <h1 class="accTitle">ACCOUNT</h1>
            <?php
            if (isset($_GET['error'])) {
                echo '<p id="myerror" class="error-error"> '.$_GET['error'].' </p>';
            }
            ?>
            <div class="sub-tab">
                <div class="user-title">
                    <h2> User Account </h2>
                </div>
                <div class="sub-tab2">
                    <div class="newUser-button">
                        <button type="submit" id="add-userbutton" class="add-account" onclick="addnewuser();">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 14h1.5v-3.25H14v-1.5h-3.25V6h-1.5v3.25H6v1.5h3.25Zm.75 4q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                            <h3>Add New User</h3>
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


            <div class="account-container">
                <table class="table" id="myTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <!-- <th>Address</th> -->
                        <th>Contact Number</th>
                        <th>Role</th>
                        <th>Picture</th>
                        <th>Action</th>
                    </tr>
                    </thead>

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
                    while ($rows = mysqli_fetch_assoc($result))
                    {
                        ?>
                        <tbody>
                        <tr>
                            <td> <?php echo $rows['user_id']; ?></td>
                            <td> <?php echo $rows['first_name'].' '.$rows['middle_name'].' '.$rows['last_name']; ?></td>
                            <td> <?php echo $rows['email']; ?></td>
                            <td> <?php echo $rows['contact_number']; ?></td>
                            <td> <?php echo $rows['user_type']; ?></td>
                            <td> <img src="<?php echo "../uploaded_image/".$rows['profile_image']; ?>" width="50px"></td>
                            <td>
                                <a href="account-edit.php?edit=<?php echo $rows['user_id']; ?>" id="edit-action" class="action-btn" name="action">
                                    <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.521 17.479v-2.437l4.562-4.563 2.438 2.438-4.563 4.562Zm-7-3.958v-2.459h7.271v2.459Zm14.583-1.188-2.437-2.437.666-.667q.355-.354.865-.364.51-.011.864.364l.709.709q.375.354.364.864-.01.51-.364.865ZM2.521 9.75V7.292h9.958V9.75Zm0-3.771V3.521h9.958v2.458Z"/></svg>
                                </a>
                                <a href="../accounts/account-action-change-password.php?edit=<?php echo $rows['user_id']; ?>" id="cpass-action" class="action-btn" name="action">
                                    <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M10 17.708q-1.979 0-3.604-.864-1.625-.865-2.688-2.323l1.73-1.771q.833 1.229 2.02 1.865 1.188.635 2.542.635 2.188 0 3.719-1.531Q15.25 12.188 15.25 10q0-2.188-1.531-3.719Q12.188 4.75 10 4.75q-2.146 0-3.719 1.521t-1.531 3.75v-.125l1.188-1.188L7.208 10l-3.687 3.688L-.167 10l1.271-1.292 1.188 1.209v.125q-.021-1.604.583-3.021.604-1.417 1.656-2.469Q5.583 3.5 7 2.896q1.417-.604 3.021-.604 1.583 0 2.979.604 1.396.604 2.448 1.656T17.104 7q.604 1.396.604 3 0 3.229-2.239 5.469-2.24 2.239-5.469 2.239ZM8.5 13q-.312 0-.531-.219-.219-.219-.219-.531V10q0-.312.219-.531.219-.219.531-.219V8.5q0-.625.438-1.062Q9.375 7 10 7t1.062.438q.438.437.438 1.062v.75q.312 0 .531.219.219.219.219.531v2.25q0 .312-.219.531-.219.219-.531.219Zm.75-3.75h1.5V8.5q0-.312-.219-.531-.219-.219-.531-.219-.312 0-.531.219-.219.219-.219.531Z"/></svg>
                                    <a href="../accounts/account-action-archive.php?edit=<?php echo $rows['user_id']; ?>" id="archive-action" class="action-btn" name="action">
                                        <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.75 17.708Q3.708 17.708 3 17t-.708-1.75V5.375q0-.417.156-.833.156-.417.448-.709l1.125-1.104q.333-.291.76-.489t.844-.198h8.75q.417 0 .844.198t.76.489l1.125 1.104q.292.292.448.709.156.416.156.833v9.875q0 1.042-.708 1.75t-1.75.708Zm0-12.208h10.5l-1-1h-8.5ZM10 14.083l3.375-3.354-1.333-1.375-1.084 1.084V7.354H9.042v3.084L7.958 9.354l-1.333 1.375Z"/></svg>
                                    </a>
                            </td>
                        <tr id="noRecordTR" style="display:none">
                            <td colspan="10">No Record Found</td>
                        </tr>
                        </tbody>
                    <?php } ?>
                </table>
            </div>

        </div>
    </main>

    <?php
    include('../common/top-menu.php')
    ?>

</div>
<form action="" method="post" enctype="multipart/form-data" id="adduserFrm">
    <div class="bg-adduserform" id="bg-addform">
        <div class="message"></div>
        <div class="container1">
            <h1 class="addnew-title">ADD NEW ACCOUNT</h1>
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
                    <div class="user-input-box">
                        <label for="email">Email</label>
                        <input type="text"
                               id="email"
                               name="email"
                               required="required"
                               placeholder="Enter Email"/>
                    </div>

                    <div class="user-input-box">
                        <label for="contactnum">Contact Number</label>
                        <input type="text" min='0' onkeypress='return isNumberKey(event)'
                               id="contactnum"
                               name="contact_num"
                               placeholder='0'
                               required="required"/>
                    </div>

                    <div class="usertype-dropdown">
                        <?php
                        $dropdown_query = "SELECT * FROM account_type";
                        $account_type_result = mysqli_query($con, $dropdown_query);
                        ?>
                        <select class="select" name="user_types" required="" >
                            <option selected disabled value="">SELECT ROLE</option>
                            <?php while($account_type = mysqli_fetch_array($account_type_result)):;?>
                                <option value="<?php echo $account_type['id']?>">
                                    <?php echo $account_type['user_type'];?>
                                </option>
                            <?php endwhile;?>
                        </select>
                    </div>
                    <div class="user-input-box">
                        <label for="pass"> Password</label>
                        <input type="password"
                               id="pass-account"
                               name="pass"
                               required="required"
                               placeholder="Create Password"/>
                    </div>
                    <div class="user-input-box">
                        <label for="ecpass">Confirm Password</label>
                        <input type="password"
                               id="cpass-account"
                               name="confirm_pass"
                               required="required"
                               placeholder="Confirm Password"/>
                    </div>
                    <div class="checker">
                        <input type="checkbox" name="" onclick="myFunctionCP()" >
                        <span>Show password</span>
                    </div>
                    <span class="gender-title">Profile Picture</span>
                    <div class="choose-profile">
                        <input type="file" id="image-profile" name="profile_image" accept="image/jpg, image/png, image/jpeg" >
                    </div>
                    <div class="line"></div>

                    <div class="bot-buttons">
                        <div class="CancelButton">
                            <a href="../accounts/account.php" id="cancel">CANCEL</a>
                        </div>
                        <div class="AddButton">
                            <button type="submit" id="adduserBtn" name="add-account">SAVE</button>
                        </div>
                    </div>
            </form>
        </div>
</form>
</div>
</body>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/account.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/d3js/7.6.1/d3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
<script>
    //Add New User
    function addnewuser(){
        document.querySelector(".bg-adduserform").style.display = 'flex';
    }
    setTimeout(function() {
        $('#myerror').fadeOut('fast');
    }, 3000);
    function myFunctionCP(){
    var x = document.getElementById("pass-account");
    var y = document.getElementById("cpass-account");
    if(x.type === 'password'){
        x.type = "text";
        y.type = "text";
    }else{
        x.type = "password";
        y.type = "password";
    }
}

</script>
</html>
<style>
    .user-input-box{
    display: flex;
    flex-wrap: wrap;
    width: 48%;
    padding-bottom: 15px;
}
</style>

