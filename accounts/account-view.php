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
    <!-- <link rel="stylesheet" type="text/css" href="../CSS/account.css"> -->
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

                    
                        ?>
                        <tbody>
                        <tr>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>
                                <a href="account-edit.php?edit=" id="edit-action" class="edit-action" name="action">
                                    <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.521 17.479v-2.437l4.562-4.563 2.438 2.438-4.563 4.562Zm-7-3.958v-2.459h7.271v2.459Zm14.583-1.188-2.437-2.437.666-.667q.355-.354.865-.364.51-.011.864.364l.709.709q.375.354.364.864-.01.51-.364.865ZM2.521 9.75V7.292h9.958V9.75Zm0-3.771V3.521h9.958v2.458Z"/></svg>
                                </a>
                                <a href="../accounts/account-action-change-password.php?edit=" id="cpass-action" class="cpass-action" name="action">
                                    <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M10 17.708q-1.979 0-3.604-.864-1.625-.865-2.688-2.323l1.73-1.771q.833 1.229 2.02 1.865 1.188.635 2.542.635 2.188 0 3.719-1.531Q15.25 12.188 15.25 10q0-2.188-1.531-3.719Q12.188 4.75 10 4.75q-2.146 0-3.719 1.521t-1.531 3.75v-.125l1.188-1.188L7.208 10l-3.687 3.688L-.167 10l1.271-1.292 1.188 1.209v.125q-.021-1.604.583-3.021.604-1.417 1.656-2.469Q5.583 3.5 7 2.896q1.417-.604 3.021-.604 1.583 0 2.979.604 1.396.604 2.448 1.656T17.104 7q.604 1.396.604 3 0 3.229-2.239 5.469-2.24 2.239-5.469 2.239ZM8.5 13q-.312 0-.531-.219-.219-.219-.219-.531V10q0-.312.219-.531.219-.219.531-.219V8.5q0-.625.438-1.062Q9.375 7 10 7t1.062.438q.438.437.438 1.062v.75q.312 0 .531.219.219.219.219.531v2.25q0 .312-.219.531-.219.219-.531.219Zm.75-3.75h1.5V8.5q0-.312-.219-.531-.219-.219-.531-.219-.312 0-.531.219-.219.219-.219.531Z"/></svg>
                                    <a href="../accounts/account-action-archive.php?edit=" id="archive-action" class="archive-action" name="action">
                                        <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.75 17.708Q3.708 17.708 3 17t-.708-1.75V5.375q0-.417.156-.833.156-.417.448-.709l1.125-1.104q.333-.291.76-.489t.844-.198h8.75q.417 0 .844.198t.76.489l1.125 1.104q.292.292.448.709.156.416.156.833v9.875q0 1.042-.708 1.75t-1.75.708Zm0-12.208h10.5l-1-1h-8.5ZM10 14.083l3.375-3.354-1.333-1.375-1.084 1.084V7.354H9.042v3.084L7.958 9.354l-1.333 1.375Z"/></svg>
                                    </a>
                            </td>
                        <tr id="noRecordTR" style="display:none">
                            <td colspan="10">No Record Found</td>
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
    if(isset($_GET['view']))
{
    $id = $_GET['view'];
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
        $user = mysqli_fetch_assoc($result);
         ?>

    <div class="bg-adduserform" id="bg-addform">
        <div class="container1">
            <input type="hidden" required="required" name="user_id" value="<?=$user['user_id'];?>">
            <a href="../accounts/account.php" class="close">X</a>
            <div class="profile-pic">
                <img src="../uploaded_image/<?=$user['profile_image'];?>" alt="">
            </div>
            <h1 class="addnew-title"><?=$user['first_name'].' '.$user['middle_name'].' '.$user['last_name'];?></h1>
            <h4 class="addnew-type"><?=$user['user_type'];?></h1>
            <div class="content">
                
                <div class="information">
                    <label class="info">
                        INFORMATION
                    </label>
                    <label class="email">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M14 11h7V6h-7Zm3.5-1.25L15 8V7l2.5 1.75L20 7v1ZM2 21q-.825 0-1.412-.587Q0 19.825 0 19V5q0-.825.588-1.413Q1.175 3 2 3h20q.825 0 1.413.587Q24 4.175 24 5v14q0 .825-.587 1.413Q22.825 21 22 21Zm7-7q1.25 0 2.125-.875T12 11q0-1.25-.875-2.125T9 8q-1.25 0-2.125.875T6 11q0 1.25.875 2.125T9 14Zm-6.9 5h13.8q-1.05-1.875-2.9-2.938Q11.15 15 9 15t-4 1.062Q3.15 17.125 2.1 19Z"/></svg>
                        <?=$user['email'];?>
                    </label>
                    <label class="contactNum">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M19.95 21q-3.225 0-6.287-1.438-3.063-1.437-5.425-3.8-2.363-2.362-3.8-5.425Q3 7.275 3 4.05q0-.45.3-.75t.75-.3H8.1q.35 0 .625.225t.325.575l.65 3.5q.05.35-.012.637-.063.288-.288.513L7 10.9q1.05 1.8 2.625 3.375T13.1 17l2.35-2.35q.225-.225.588-.338.362-.112.712-.062l3.45.7q.35.075.575.337.225.263.225.613v4.05q0 .45-.3.75t-.75.3Z"/></svg>
                        <?=$user['contact_number'];?>
                    </label>
                </div>
            </div>
            <div class="bot-buttons">
                <div class="AddButton">
                    <a href="../accounts/account-edit.php?edit=<?php echo $user['user_id']; ?>" id="addcustomerBtn" name="save-transaction">EDIT DETAILS</a>
                </div>
            </div>
        </div>
    </div>
    <?php 
}} 
?>

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
:root{
    --color-main: rgb(2, 80, 2);
    --color-main-2: rgb(2, 80, 2);
    --color-main-3: rgb(2, 80, 2);
    --color-white: white;
    --color-white-secondary: white;
    --color-tertiary: hsl(0, 0%, 57%);
    --color-black: rgb(49, 49, 49);
    --color-maroon: rgb(136, 0, 0);
    --color-secondary-main: rgb(244, 255, 246);
    --color-background: rgb(235, 235, 235);
    --color-solid-gray: rgb(126, 126, 126);
    --color-td:rgb(100, 100, 100);
    --color-button: rgb(117, 117, 117);
    --color-table-shadow: rgb(244, 255, 246);
    --color-shadow-shadow: rgb(116, 116, 116);
    --color-table-hover: rgb(244, 255, 246);
    --color-aside-mobile-focus: rgb(78, 150, 78);
    --color-aside-mobile-text: hsl(0, 0%, 57%);
    --color-mainbutton: rgb(117, 117, 117);
    --color-button-hover: rgb(39, 170, 63);
    --color-border-bottom: rgb(219, 219, 219);
}
.dark-theme{
    --color-white: rgb(48, 48, 48);
    --color-tertiary: hsl(0, 0%, 25%);
    --color-main-2: rgb(60, 128, 60);
    --color-main-3: rgb(93, 163, 93);
    --color-border-bottom: rgb(104, 104, 104);
    --color-black: white;
    --color-shadow-shadow: rgb(32, 32, 32);
    --color-aside-mobile-focus: rgb(244, 255, 246);
    --color-table-shadow: rgb(131, 131, 131);
    --color-maroon: rgb(255, 130, 130);
    --color-white-secondary: rgb(235, 235, 235);
    --color-main: rgb(244, 255, 246);
    --color-secondary-main: rgb(97, 172, 111);
    --color-background: rgb(80, 80, 80);
    --color-solid-gray: rgb(231, 231, 231);
    --color-td: rgb(231, 231, 231);
    --color-button: rgb(202, 202, 202);
    --color-table-hover: rgb(112, 112, 112);
    --color-aside-mobile-text:hsl(0, 0%, 88%);
}

body{
    background: var(--color-background);
    margin: 0;
    padding: 0;
    height: 100%;
    overflow-x: hidden;
    font-family: Arial, Helvetica, sans-serif;
    background-position: center;
    background-size: cover;
    background-attachment: fixed;
}
.bot-buttons{
    width: 100%;
    align-items: center;
    text-align: center;
    display: inline-block;
    margin-top: 1.3rem;
    margin-bottom: 1.3rem;
}
.AddButton a{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    max-height: 70px;
    padding-left: 80px;
    padding-right: 80px;
    outline: none;
    border: none;
    font-size: .8rem;
    border-radius: 20px;
    color: white;
    background:  var(--color-mainbutton);
    cursor: pointer;
    transition: 0.5s;
    margin-left: 1rem;
}
.AddButton a:hover{
    background: var(--color-secondary-main);
    box-shadow: 1px 3px 3px 0px var(--color-shadow-shadow);
    color: var(--color-main);
    fill: var(--color-main);
}
.close{
    text-align: right;
    float: right;
    color: var(--color-maroon);
    cursor: pointer;
}

.close:hover{
    filter: brightness(2.5);
}
.profile-pic{
    align-items: center;
    text-align: center;
    justify-content: center;
    margin-top: 1rem;
}
.profile-pic img{
    border-radius: 50%;
    box-shadow: 2px 2px 10px 1px  var(--color-solid-gray);
    width: 200px;
}
.container1{
    width: 100%;
    max-width: 700px;
    padding: 28px;
    align-items: center;
    justify-content: center;
    margin: 0 28px;
    border-radius:  0px 0px 20px 20px;
    background-color: var(--color-background);
    box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
    border-top: 10px solid var(--color-solid-gray);
}
.form-title{
    font-size: 26px;
    font-weight: 600;
    text-align: center;
    padding-bottom: 6px;
    color: white;
    text-shadow: 2px 2px 2px black;
    border-bottom: solid 1px white;
}

.main-user-info{
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 20px 0;
}
.usertype-dropdown{
    width: 48%;
    margin-top: 1.6rem;
    display: flex;
    flex-wrap: wrap;
}
.select{
    background: var(--color-solid-gray);
    color: var(--color-white);
    align-items: center;
    border-radius: 13px;
    padding: 8px 12px;
    height: 40px;
    width: 100%;
    cursor: pointer;
    transition: 0.3s;
}
.action-dropdown{
    position: relative;
    margin-top: .5rem;
    /* left: 10%; */
    margin-bottom: .5rem
}
.user-input-box:nth-child(2n){
    justify-content: end;
}

.checker {
    /* display: flex; */
    flex-wrap: wrap;
    width: 100%;
    padding-bottom: 15px;
    gap: 5px;
    text-align: right;
    align-items: right;
}
.checker span {
    text-decoration: none;
    color: var(--color-solid-gray);
    top: 0;
    font-size: min(max(10px, 1.2vw), 12px);
    font-family: 'Switzer', sans-serif;
}
.user-input-box{
    display: flex;
    flex-wrap: wrap;
    width: 48%;
    padding-bottom: 15px;
}

.user-input-box label{
    width: 100%;
    color: var(--color-solid-gray);
    font-size: 16px;
    /* margin-left: .2rem; */
    margin-bottom: 0.5rem;
    font-family: 'Malberg Trial', sans-serif;
    font-weight: 550;
    /* margin: 5px 0; */
}
.user-input-box label:focus{
    border: 2px solid var(--color-main-3);
    font-size: 17px;
    font-weight: 600;
}
.user-input-box input::placeholder{
    font-size: .8em;
    color:var(--color-solid-gray);
}
/* ::placeholder:focus{
    border: 2px solid var(--color-main-3);
} */
.user-input-box input:focus{
    border: 2px solid var(--color-main-3);
    background: var(--color-white);
}

.user-input-box input{
    height: 40px;
    width: 100%;
    border: 2px solid var(--color-solid-gray);
    border-radius: 15px;
    outline: none;
    font-size: 1em;
    background: var(--color-white);
    color: var(--color-black);
    padding: 0 10px;
}
.line{
    width:100%;
    margin-top: 1rem;
    margin-bottom: 1rem;
    border-bottom: 2px solid var(--color-solid-gray);
}
.profile-picture1 h4{
    display: flex;
    position: relative;
    text-align: center;
    font-size: 1rem;
    font-family: 'Calibri', sans-serif;
    color: var(--color-solid-gray);
    width: 100%;
    border-bottom: 2px solid var(--color-solid-gray);
    /* margin-bottom: -5rem; */
}

.choose-profile{
    /* position: relative; */
    width: 100%;
    height: 1.32rem;
    padding: 10px;
    margin-top: 1rem;
    background: var(--color-solid-gray);
    color: var(--color-white);
    border-radius: 10px;
    transition: 0.5s;
    font-family: 'COCOGOOSE', sans-serif;
    cursor: pointer;
}

#image-profile{
    cursor: pointer;
    text-align: center;
    align-items: center;
}
.gender-title{
    /* margin-top: rem; */
    font-family: 'Calibri', sans-serif;
    color: var(--color-solid-gray);
    width: 100%;
    font-size: 20px;
    margin-left: .2rem;
    font-family: 'Malberg Trial', sans-serif;
    font-weight: 550;
    /* border-bottom: 2px solid var(--color-solid-gray); */
}

.gender-category{
    margin: 15px 0;
    color:  var(--color-solid-gray);
}

.gender-category label{
    padding: 0 20px 0 5px;
}

.gender-category label,
.gender-category input,
.form-submit-btn input{
    cursor: pointer;
}

.form-submit-btn{
    margin-top: 40px;
}

.form-submit-btn input{
    display: block;
    width: 100%;
    margin-top: 10px;
    font-size: 20px;
    padding: 10px;
    border:none;
    border-radius: 3px;
    color: rgb(209, 209, 209);
    background: rgba(63, 114, 76, 0.7);
}

.form-submit-btn input:hover{
    background: rgba(56, 204, 93, 0.7);
    color: rgb(255, 255, 255);
}
.content{
    text-align: center;
    justify-content: center;
    align-items: center;
    display: flex;
}
.information{
    text-align: center;
    justify-content: center;
    align-items: center;
    width: 70%;
    margin-bottom: 1rem;
    border-radius: 20px;
    background-color: var(--color-white);
    padding-bottom: 40px;
    padding-top: 20px;
    padding-left: 40px;
    padding-right: 40px;
}
.info{
    font-family: 'calibri', sans-serif;
    font-size: 1.8rem;
    color: var(--color-solid-gray);
    fill: var(--color-solid-gray);
    justify-content: center;
    display: flex;
    gap: 1rem;
    border-bottom: 1px solid var(--color-solid-gray);
    text-align: center;
    margin-bottom: 1rem;
}
.email{
    font-family: 'calibri', sans-serif;
    font-size: 1.4rem;
    color: var(--color-solid-gray);
    fill: var(--color-solid-gray);
    justify-content: center;
    display: flex;
    gap: 1rem;
    text-align: center;
}
.contactNum{
    font-family: 'calibri', sans-serif;
    font-size: 1.4rem;
    color: var(--color-solid-gray);
    fill: var(--color-solid-gray);
    justify-content: center;
    display: flex;
    margin-top: 1rem;
    gap: 1rem;
    text-align: center;
}
.addnew-title{
    font-size: min(max(1.9rem, 1.1vw), 2rem);
    color: var(--color-solid-gray);
    font-family: 'Malberg Trial', sans-serif;
    letter-spacing: .09rem;
    display: flex;
    padding-top: 1rem;
    justify-content: center;
}
.addnew-type{
    font-size: 1.5rem;
    color: var(--color-main);
    font-family: 'COCOGOOSE', sans-serif;
    letter-spacing: .09rem;
    display: flex;
    border-top: 2px solid var(--color-main);
    padding-top: 2px;
    justify-content: center;
    margin-top: -.5rem;
    width: 100%;
}

.side-bar .menu #account{
    background: var(--color-white);
    transition: 0.6s;
    color: var(--color-main);
    fill: var(--color-main);
    margin-left: 0;
    padding-left: 1rem;
    content: "";
    margin-bottom: 6px;
    font-size: 15px;
    border-radius: 0 0 10px 0 ;
    box-shadow: 1px 3px 1px var(--color-background);
}
.AddButton a:hover{
    background: var(--color-button-hover);
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
    padding-left: 80px;
    padding-right: 80px;
    text-align: center;
    width: 30rem;
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

@media(max-width: 600px){
    .container1{
        min-width: 280px;
    }
    .user-input-box .cost{
        position: absolute;
        display: none;
        left: 10.65%;
    }
    .user-input-box .srp{
        position: absolute;
        display: none;
        left: 10.65%;
    }
    .user-input-box{
        margin-bottom: 12px;
        width: 100%;
    }

    .user-input-box:nth-child(2n){
        justify-content: space-between;
    }
    .usertype-dropdown{
        width: 95%;
        margin-bottom: 1rem;
        margin-top: -.3rem;
    }
    .gender-category{
        display: flex;
        /* justify-content: space-between; */
        width: 100%;
    }

    .main-user-info{
        max-height: 380px;
        overflow: auto;
    }

    .main-user-info::-webkit-scrollbar{
        width: 0;
    }
    .bot-buttons{
        width: 100%;
        align-items: center;
        text-align: center;
        margin-top: 4.3rem;
    }
    .AddButton button:hover{
        background: var(--color-button-hover);
    }
    .CancelButton{
        position: relative;
        margin-top: 3rem;
        padding-top: 2rem;
        /* padding-right: 2rem; */
    }
    .AddButton{
        position: relative;
        margin-top: -4rem;
        margin-left: -1em;

    }
    /* .CloseButton{
        margin-top: 5.2vh;
        margin-left: 2.4em;
        margin-bottom: -2rem;
    } */
    #cancel{
        width: 100%;
    }
}
.block{
    width: 5rem;
    height: 2rem;
    background-color: var(--color-background);
    position: fixed;
    display: flex;
    top: 0;
}
/* -----------------------------------------------Side Menu---------------------------------------- */

.bg-adduserform{
    height: 100%;
    width: 100%;
    background: rgba(0,0,0,0.7);
    top: 0;
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
}
.bg-editDropdown{
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
#form-registered{
    position: absolute;
    top: 50%;
    display: none;
    left: 50%;
    max-height: 95vh;
    min-width: 400px;
    transform: translate(-50%, -50%);
    background-color: var(--color-white);
    border-top: 10px solid var(--color-main-3);
    box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
    border-radius:  0px 0px 20px 20px;

}
.pageform{
    background-color: var(--color-white);
    border-radius: 0px 0px 10px 10px;
    border-top: 2px solid var(--color-solid-gray);
    box-sizing: border-box;
    padding: 0 30px;
    display: flex;
}
#container-registered .pageform {
    font-size: 20px;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    text-align: center;
}
.register h2 {
    font-family: 'Calibri', sans-serif;
    font-size: 25px;
    align-items: center;
    text-align: center;
    letter-spacing: 2px;
    color: var(--color-black);
    margin-bottom: 5px;
}
.content .verify {
    left: 38.2%;
    padding-top: 1rem;
    margin-bottom: -.5rem;
    align-items: center;
    position: relative;

}
.verified {
    fill: rgb(39, 170, 63);
    width: 80px;
    height: 80px;
}
#registered{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    padding-left: 60px;
    padding-right: 60px;
    text-align: center;
    max-height: 70px;
    outline: none;
    border: none;
    font-size: min(max(9px, 1.1vw), 11px);
    border-radius: 20px;
    color: white;
    background: var(--color-mainbutton);
    cursor: pointer;
    transition: 0.5s;
    display: block;
    margin-top: 2vh;
    margin-bottom: 20px;
    margin-left: 65.5px;
    margin-right: 65.5px;
    width: 5rem;
}
#registered:hover{
    background-color: var(--color-button-hover);
    transition: 0.5s;
}
.form-adduser1{
    width: 500px;
    height: 100%;
    max-height: 480px;
    position: absolute;
    border-radius:  0px 0px 20px 20px;
    background-color: var(--color-white);
    box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
    border-top: 10px solid var(--color-solid-gray);
}
.edit-container{
    width: 500px;
    height: 100%;
    max-height: 520px;
    position: absolute;
    border-radius:  0px 0px 20px 20px;
    background-color: var(--color-white);
    box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
    border-top: 10px solid var(--color-solid-gray);
}
.edit-container2{
    display: flex;
    font-size: .7rem;
    flex-direction: column;
    font-family: 'Malberg Trial', sans-serif;
    gap: 30px;
    min-height: 20vh;
}
.edit-container .EditButton button{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    margin-top: .5vh;
    margin-bottom: 20px;
    margin-left: 20em;
    text-align: center;
    width: 15rem;
    max-height: 60px;
    outline: none;
    border: none;
    font-size: min(max(9px, 1.1vw), 11px);
    border-radius: 20px;
    color: white;
    background:  var(--color-mainbutton);
    cursor: pointer;
    transition: 0.5s;
}
.edit-container .EditButton button:hover{
    background: var(--color-button-hover);
}
.form-adduser2{
    display: flex;
    font-size: .7rem;
    flex-direction: column;
    font-family: 'Malberg Trial', sans-serif;
    gap: 30px;
    min-height: 20vh;
}
.error-error{
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
}
/* --------------------------------------DROP DOWN ACTION------------------------------------- */
.actionBtn{
    background: var(--color-solid-gray);
    color: var(--color-white);
    font-size: 18px;
    font-family: "Font Awesome 5 Free", sans-serif;
    font-weight: 501;
    border-radius: 50px;
    padding: 10px;
    height: 2.5em;
    width: 4rem;
    cursor: pointer;
    transition: 0.3s;
}
.fa{
    font-family: "Font Awesome 5 Free", sans-serif;
    font-weight: 501;
    font-size: 14px;
}
.actionicon{
    fill:  var(--color-white);
}

/* --------------------------------------DROP DOWN------------------------------------- */

#tooltipText{
    font-family: Arial, Helvetica, sans-serif;
    font-size: .7rem;
    color: var(--color-white);
}
#edit-action{
    background: hsl(0, 0%, 37%);
    color: var(--color-white);
    align-items: center;
    text-align:center;
    justify-content: center;
    float: center;
    position: relative;
    border-radius: 3px;
    display: flex;
    width: 60%;
    margin: 1px;
    gap: .3rem;
    left: 20%;
    cursor: pointer;
    transition: 0.3s;
    border: none;
}
#edit-action:hover{
    background: var(--color-main);
    color: var(--color-white);
}
#archive-action{
    background: hsl(0, 51%, 44%);
    color: var(--color-white);
    align-items: center;
    text-align:center;
    justify-content: center;
    float: center;
    position: relative;
    border-radius: 3px;
    display: flex;
    left: 20%;
    width: 60%;
    margin: 5px;
    justify-content: center;
    margin: 1px;
    gap: .3rem;
    cursor: pointer;
    transition: 0.3s;
    border: none;
}
#archive-action:hover{
    background: var(--color-main);
    color: var(--color-white);
}
#cpass-action{
    background:#00aa09;
    color: var(--color-white);
    align-items: center;
    text-align:center;
    justify-content: center;
    float: center;
    left: 20%;
    position: relative;
    border-radius: 3px;
    display: flex;
    width: 60%;
    margin: 5px;
    justify-content: center;
    margin: 1px;
    gap: .3rem;
    cursor: pointer;
    transition: 0.3s;
    border: none;
}
#cpass-action:hover{
    background: var(--color-main);
    color: var(--color-white);
}


/* ------------------------------------------------------------------------------------ */
.message{
    background-color: hsl(0, 100%, 77%);
    color: #ffffff;
    border-radius: 6px;
    width: 25%;
    height: 1.87rem;
    /* margin-left: 3.55rem; */
    letter-spacing: 0.5px;
    font-family: Helvetica, sans-serif;
    top: 16.9%;
    font-size: .7rem;
    padding: 5px 10px;
    padding-top: 1rem;
    position: absolute;
    align-items: center;
    text-align: center;
    /* justify-content: space-between; */
    gap:3.5rem;
    z-index: 1000;
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

.line{
    width:100%;
    margin-top: 1rem;
    margin-bottom: 1rem;
    border-bottom: 2px solid var(--color-solid-gray);
}
.profile-picture1 h4{
    display: flex;
    position: relative;
    text-align: left;
    font-size: 1rem;
    font-family: 'Calibri', sans-serif;
    color: var(--color-solid-gray);
    width: 100%;
    border-bottom: 2px solid var(--color-solid-gray);
    /* margin-bottom: -5rem; */
}

.choose-profile{
    /* position: relative; */
    width: 97%;
    height: 1.32rem;
    padding: 10px;
    margin-top: 1rem;
    background: var(--color-solid-gray);
    color: var(--color-white);
    border-radius: 10px;
    transition: 0.5s;
    font-family: 'COCOGOOSE', sans-serif;
    cursor: pointer;
}

#image-profile{
    cursor: pointer;
    text-align: center;
    align-items: center;
}
.choose-profile:hover{
    background: var(--color-main-2);
    transition: 0.5s;
}

.form-adduser1 .AddButton button{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    margin-top: .5vh;
    margin-bottom: 20px;
    margin-left: 20em;
    text-align: center;
    width: 15rem;
    max-height: 60px;
    outline: none;
    border: none;
    font-size: min(max(9px, 1.1vw), 11px);
    border-radius: 20px;
    color: white;
    background:  var(--color-mainbutton);
    cursor: pointer;
    transition: 0.5s;
}
.form-adduser1 .AddButton button:hover{
    background: var(--color-button-hover);
}
.CancelButton{
    margin-top: -4.9vh;
    margin-left: 2.4em;
}
.CloseButton{
    margin-top: 5.2vh;
    margin-left: 2.4em;
    margin-bottom: -2rem;
}
#cancel{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
    padding-left: 60px;
    padding-right: 60px;
    text-align: center;
    width: 10rem;
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

#action_btn {
    font-family: 'calibri', sans-serif;
    /* padding: 10px;

    margin-bottom: 20px;
    margin-left: 20em; */
    text-align: center;
    margin-top: .5vh;
    margin-bottom: .5vh;
    width: 3rem;
    height: 40px;
    outline: none;
    border: none;
    font-size: min(max(10px, 1.2vw), 12px);
    border-radius: 20px;
    background: var(--color-solid-gray);
    cursor: pointer;
    transition: 0.5s;
}
#action_btn:hover{
    background: var(--color-button-hover);
}

/* ----------------------------------------MAIN---------------------------------------- */
.main-account{
    width:100%;
    position: relative;
}
.accTitle{
    margin-top: 3rem;
    font-size: min(max(1.9rem, 1.1vw), 2rem);
    color: var(--color-main);
    font-family: 'COCOGOOSE', sans-serif;
    letter-spacing: .03rem;
    border-bottom: 2px solid var(--color-main);
    width: 78%;
}
.sub-tab2{
    display: inline-block;
    /* margin-top: -2rem; */
    margin-left: 1rem;
}
/* ----------------------------------------Sub TAB---------------------------------------- */
.user-title{
    position: relative;
    display: inline-block;
    margin-left: 3rem;
}
main  h2{
    color: var(--color-solid-gray);
    font-size: 1.3rem;
    letter-spacing: .1rem;
    font-family: 'Galhau Display', sans-serif;
}
main .sub-tab{
    margin-bottom: 3rem;
}
/* ----------------------------------------Search BAR---------------------------------------- */
.search{
    position: absolute;
    gap: 2rem;
    align-items: right;
    text-align: right;
    right: 0;
    display: inline-block;
}
.search-bar{
    width: 15vw;
    background: var(--color-white);
    display: flex;
    position: relative;
    align-items: center;
    border-radius: 60px;
    padding: 10px 20px;
    height: 1.8rem;
    backdrop-filter: blur(4px) saturate(180%);
}
.search-bar input{
    background: transparent;
    flex: 1;
    border: 0;
    outline: none;
    padding: 24px 20px;
    font-size: .8rem;
    color: var(--color-black);
    margin-left: -0.95rem;
}
::placeholder{
    color: var(--color-solid-gray);

}
.search-bar button svg{
    width: 20px;
    fill: var(--color-white);
}
.search-bar button{
    border: 0;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    background: var(--color-main);
    margin-right: -0.55rem;
}
/* ----------------------------------------Add Button---------------------------------------- */
.newUser-button{
    position: absolute;
    display: inline-block;
    margin-top: -2rem;
}
.add-account{
    display: flex;
    border: none;
    background-color: var(--color-white);
    align-items: center;
    color: var(--color-button);
    fill: var(--color-button);
    width: 11rem;
    max-height: 46px;
    border-radius: 20px;
    padding: .68rem 1rem;
    font-family: 'Outfit', sans-serif;
    cursor: pointer;
    gap: 1rem;
    transition: all 300ms ease;
    position: absolute;
    text-transform: uppercase;
}
.add-account h3{
    font-size: .8rem;
}
.add-account:hover{
    background-color: var(--color-main);
    color: var(--color-white);
    fill: var(--color-white);
    padding-top: -.2px;
    transition: 0.7s;
    border-bottom: 4px solid var(--color-maroon);
}
/* ----------------------------------------Account Table---------------------------------------- */
main .account-container{
    margin-top: -2rem;
    max-height: 650px;
    overflow:auto;
    width: 100%;
    /* position: absolute; */
    box-shadow: 0px 5px 30px 2px var(--color-table-shadow);
    border-top: 8px solid var(--color-table-hover);
    border-radius: 0px 0px 10px 10px;

}
main .account-container table{
    background: var(--color-white);
    font-family: 'Switzer', sans-serif;
    width: 100%;
    font-size: 1rem;
    padding-left: 2.5rem;
    padding-right: 2.5rem;
    padding-bottom: 2.5rem;
    text-align: center;
    transition: all 700ms ease;
    /* margin-top: -1rem; */
}

main .account-container table:hover{
    box-shadow: none;
    /* border-top: 8px solid var(--color-main); */
}

main table tbody td{
    height: 3.3rem;
    border-bottom: 1px solid var(--color-border-bottom);
    color: var(--color-td);
    font-size: .8rem;
}
th{
    height: 3.3rem;
    color: var(--color-black);
    margin:1rem;
    font-size: 1rem;
    letter-spacing: 0.02rem;
}
tr:hover td{
    color: var(--color-main);
    cursor: pointer;
    background-color: var(--color-table-hover);
}
/* ----------------------------------------ASIDE---------------------------------------- */
.container{
    display: grid;
    width: 96%;
    /* margin: 0 auto; */
    background: var(--color-background);
    gap: 1.8rem;
    grid-template-columns: 16rem auto;
}
#menu-button{
    display: none;
}

/* ----------------------------------------SIDEBAR 2---------------------------------------- */
@media screen and (max-width: 1600px){
    .container{
        width: 94%;
        grid-template-columns: 16rem auto;
    }
    .top-menu{
        width: 370px;
    }
    main .account-container{
        margin-top: 6rem;
    }
    main  h2{
        margin-left: 10%;
    }
    main .sub-tab{
        margin-bottom: 4rem;
    }
}
@media screen and (max-width: 1400px){
    .container{
        width: 94%;
        grid-template-columns: 4rem auto;
    }
    .side-bar{
        z-index: 3;
        position: fixed;
        left: -100%;
    }
    .close-btn{
        display: flex;
    }

    .top-menu{
        width: 370px;
    }
    .main-account{
        position: relative;
        left: -5%;
    }
    main .account-container{
        width: 105%;
    }
    main  h2{
        margin-left: 10%;
    }
    main .sub-tab{
        margin-bottom: 4rem;
    }
    .newUser-button{
        left: 2.5%;
    }
    .search{
        right: -5%;
    }
    .search-bar{
        width: 18vw;
    }
}
@media screen and (max-width: 1200px){
    .container{
        width: 94%;
        grid-template-columns: 4rem auto;
    }
    .accTitle{
        width: 74%;
    }
    .top-menu{
        width: 370px;
    }
    .main-account{
        position: relative;
        left: -5%;
    }
    main  h2{
        margin-left: 10%;
    }
    main .sub-tab{
        margin-bottom: 4rem;
    }
    .search-bar{
        width: 20vw;
    }
    .user2 .drop-menu{
        right: 13px;
        margin-top: 2px;
    }
    .user2 .drop-menu::before{
        right: 25px;
    }
    .drop-menu .ul{
        width: 8.5rem;
        height: 5rem;
    }
    .drop-menu .ul a{
        width: 8.5rem;
    }
}

@media screen and (max-width: 768px){
    .containter{
        width: 100%;
    }
    .menu-btn2{
        display: flex;
    }
    .top-menu{
        width: 94%;
        margin: 0 auto 4rem;
    }
    .top-menu .menu-bar{
        position: fixed;
        top: 0;
        left: 0;
        align-items: center;
        padding: 0 0.8rem;
        height: 4rem;
        background: var(--color-white);
        width: 100%;
        margin: 0;
        z-index: 2;
        box-shadow: 0px 1px 14px var(--color-shadow-shadow);
    }
    .top-menu .menu-bar .accTitle-top{
        display: block;
        left: 0;
        margin-left: 4rem;
        position: absolute;
    }
    .profile{
        margin-right: 1.4rem;
    }
    .top-menu .menu-bar .user1{
        display: none;
    }
    .drop-menu .ul .user-type3{
        display: block;
        left:22.5%;
        position: absolute;
        margin-top: -2.3rem;
        margin-bottom: 1.9rem;
    }
    .accTitle{
        display:none;
    }
    .user2 .drop-menu{
        right: 40px;
        height: 9.3rem;
        margin-top: 2px;
    }
    .user2 .drop-menu::before{
        right: 17px;
    }
    .drop-menu .ul{
        width: 8.5rem;
        height: 5rem;
    }
    .drop-menu .ul .theme-dark{
        margin-top: -.3rem;
    }

    .drop-menu .ul a{
        width: 8.5rem;
    }
    .main-account{
        position: relative;
        left: -5%;
    }
    main .account-container{
        margin: 2rem 0 0 8.8rem;
        width: 94%;
        position: absolute;
        display:none;
        left: 0;
        margin-left: 50%;
        transform: translateX(-50%);
        margin-top: 3%;
    }
    main .account-container table{
        width: 80vw;
        padding-left:30px;
        padding-right:30px;
    }
    main  h2{
        margin-left: 10%;
        display:none;
    }
    main .sub-tab{
        margin-bottom: 4rem;
    }
    .newUser-button{
        left: 137%;
        display:none;
    }
    .search{
        left: 77%;
        display:none;
    }
    .search-bar{
        width: 20vw;
    }
}

.menu-tab p{
    font-size: 20px;
    font-weight: lighter;
    margin-left: 10px;
}

.menu-tab img{
    width: 15px;
    margin-right: 10px;
    margin-left: 20px;
}
/* .menu-tab a:hover{
    background:  rgb(250, 255, 251);
    transition: 0.6s;
    margin-left: 0rem;
    color: rgb(187, 187, 187);
    fill: rgb(187, 187, 187);
    font-weight: bold;
    padding-left: 1rem;
    content: "";
    margin-bottom: 6px;
    font-size: 9px;
    border-radius: 0 10px 10px 0 ;
    box-shadow: 1px 1px 1px rgb(224, 224, 224);
} */
</style>

