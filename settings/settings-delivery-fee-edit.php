<?php
session_start();
require_once '../database/connection-db.php';
require_once "../service/user-access.php";
require_once "../service/settings-delivery.php";

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'SETTINGS-DELIVERY_FEE')) {
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
    <link rel="stylesheet" type="text/css" href="../CSS/settings-delivery-fee.css">
    <link rel="stylesheet" type="text/css" href="../CSS/pagination.css">
    <title>Tag's Water Purified Drinking Water</title>
</head>
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
                    $per_page_record = 5;
                    $page = 1;
                }

                $query = "SELECT COUNT(*) FROM delivery_fee";     
                $rs_result = mysqli_query($con, $query);     
                $row = mysqli_fetch_row($rs_result);     
                $total_records = $row[0];     
                $page_location = '../accounts/account.php';
                $start_from = ($page - 1) * $per_page_record;  
                    
            ?>
    <main>
        <div class="main-account">
            <h1 class="accTitle">SETTINGS</h1>
            <?php
            if (isset($_GET['error'])) {
                echo '<p id="myerror" class="error-error"> '.$_GET['error'].' </p>';
            }
            ?>
            <div class="sub-tab">
                <div class="user-title">
                    <h2> DELIVERY FEE </h2>
                </div>
                <div class="sub-tab2">
                    <div class="newUser-button">
                        <button type="submit" id="add-userbutton" class="add-account" onclick="addnewuser();">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 14h1.5v-3.25H14v-1.5h-3.25V6h-1.5v3.25H6v1.5h3.25Zm.75 4q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                            <h3>Add Delivery Fee</h3>
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
                        <tr class='table-heading'>
                            <th scope="col">Delivery Fee</th>
                            <th scope="col">Location/Distance</th>
                            <!-- <th>Address</th> -->
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                        <tbody>
                        <tr>
                        </tr>
                        <tr class="noRecordTR" style="display:none">
                            <td colspan="3">No Record Found</td>
                        </tr>
                        </tbody>
                </table>
            </div>
        </div>

        <div class="pagination">   
            <br>
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

                <br><br>
                <select name="option" onchange="location ='<?php echo $page_location ?>' + '?page=1&records=' + this.value;">
                        <option value="5" <?php if($per_page_record == "5") { echo 'selected'; }?>>5</option>
                        <option value="10" <?php if($per_page_record == "10") { echo 'selected'; }?>>10</option>
                        <option value="50" <?php if($per_page_record == "50") { echo 'selected'; }?>>50</option>
                        <option value="100" <?php if($per_page_record == "100") { echo 'selected'; }?>>100</option>
                        <option value="250" <?php if($per_page_record == "250") { echo 'selected'; }?>>250</option>
                        <option value="500" <?php if($per_page_record == "500") { echo 'selected'; }?>>500</option>
                        <option value="1000" <?php if($per_page_record == "1000") { echo 'selected'; }?>>1000</option>
                </select>
                <span> No. of Records Per Page </span>  
                
            </div>
            <div></div>

            <div class="inline">   
                <input id="page" type="number" min="1" max="<?php echo $total_pages?>"   
                placeholder="<?php echo $page."/".$total_pages; ?>" required> 

                <button onClick="goToPage('<?php echo $page_location.'?records='.$per_page_record?>');">Go to page</button>   
            </div>    
    </main>

        <div class="top-menu">
                <div class="menu-bar">
                    <div class="menu-btn2">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h2 class="Title-top">ACCOUNT</h2>
                    <h4 class="subTitle-top">User Account</h2>
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
<?php 
if(isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $get_delivery_fee = mysqli_query($con, "SELECT * from delivery_fee WHERE id = $id");

    if(mysqli_num_rows($get_delivery_fee) > 0) {
        $delivery_fee = mysqli_fetch_assoc($get_delivery_fee);

?>
<form action="" method="post" enctype="multipart/form-data" id="adduserFrm">
    <div class="bg-adduserform" id="bg-addform">
        <div class="message"></div>
        <div class="container1">
            <h1 class="addnew-title">EDIT DELIVERY FEE</h1>
            <form action="#">
                <input type="hidden" required="required" name="id" value="<?= $id ?>">
                <div class="main-user-info">
                    
                <div class="user-input-box1">
                    <span class="gender-title">FEE</span>
                        <input type="number"
                               id="lastname"
                               name="fee"
                               required="required"
                               class="fee"
                               placeholder="0.00"
                               value = <?=$delivery_fee['fee'] ?>>
                </div>
                    <span class="gender-title">Description</span>
                    <div class="user-input-box">
                        <input type="text"
                               name="description"
                               required="required"
                               value = "<?=$delivery_fee['description'] ?>">
                    </div>
                    <div class="line"></div>

                    <div class="bot-buttons">
                        <div class="CancelButton">
                            <a href="../settings/settings-delivery-fee.php" id="cancel">CANCEL</a>
                        </div>
                        <div class="AddButton">
                            <button type="submit" id="adduserBtn" name="edit-delivery-settings">SAVE</button>
                        </div>
                    </div>
            </form>
        </div>
</form>
<?php }
else {
    echo '<script> location.replace("../settings/settings-payroll.php"); </script>';
} }?>
</div>

</body>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/account.js"></script>
<script src="../javascript/account-search.js"></script>
<script src="../javascript/pagination.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/d3js/7.6.1/d3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
</html>
<script>
const addForm = document.querySelector(".bg-adduserform");
addForm.style.display = 'flex';

function goToPage(reference) {   
    var page = document.getElementById("page").value;   
    page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
    window.location.href = reference + '&page=' + page;   
} 
</script>