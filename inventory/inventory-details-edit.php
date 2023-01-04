<?php
require_once '../database/connection-db.php';
require_once '../service/edit-inventory-item.php';
require_once "../service/user-access.php";

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'INVENTORY-ITEM')) {
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
    <link rel="stylesheet" type="text/css" href="../CSS/inventory-details-edit.css">
    <title>Tag's Water Purified Drinking Water</title>
</head>

<body>
<div class="container">
    <div class="block"></div>

    <?php
    include('../common/side-menu.php')
    ?>

    <main>
        <div class="main-account">
            <h1 class="accTitle">INVENTORY</h1>
            <?php
            if (isset($_GET['error'])) {
                echo '<p id="myerror" class="error-error"> '.$_GET['error'].' </p>';
            }
            ?>
            <div class="sub-tab">
                <div class="user-title">
                    <h2> INVENTORY DETAILS </h2>
                </div>
                <div class="sub-tab2">
                    <div class="newUser-button2">
                        <button type="submit" id="add-userbutton" class="add-account" onclick="addnewuser();">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 14h1.5v-3.25H14v-1.5h-3.25V6h-1.5v3.25H6v1.5h3.25Zm.75 4q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                            <h3>Add New Item</h3>
                        </button>
                    </div>
                    <div class="newUser-button3">
                        <a href="../inventory/inventory-details.php" id="add-userbutton" class="add-account3">
                            <h3>ITEM DETAILS</h3>
                        </a>
                    </div>
                    <div class="newUser-button4">
                    <a href="../inventory/inventory-details-refill.php" id="add-userbutton" class="add-account4">
                            <h3>REFILL PRICE</h3>
                        </a>
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
                        <th scope="col">ID</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Type</th>
         
                        <th scope="col">Alkaline Price</th>
                        <th scope="col">Mineral Price</th>
                        <th scope="col">Image</th>
                        <th scope="col">Date/Time Added</th>
                        <th scope="col">Added By</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>

                        <tbody>
                        <tr>
                            <td data-label="ID"> </td>
                            <td data-label="Item Name"> </td>
                            <td data-label="Type"> </td>
         
                            <td data-label="Alkaline Price"> </td>
                            <td data-label="Mineral Price"> </td>
                            <td data-label="Image"> </td>
                            <td data-label="Date/Time Added"></td>
                            <td data-label="Added By"> </td>
                            <td>
                              
                            </td>
                        </tr>
                        <tr id="noRecordTR" style="display:none">
                            <td colspan="12">No Record Found</td>
                        </tr>
                        </tbody>
                </table>
         

        </div>
    </main>

        <div class="top-menu">
                <div class="menu-bar">
                    <div class="menu-btn2">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h2 class="Title-top">INVENTORY</h2>
                    <h4 class="subTitle-top">Inventory Details</h2>
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
if(isset($_GET['edit']))
{
    $id = $_GET['edit'];
    $result = mysqli_query($con, "SELECT inventory_item.id,
                                                inventory_item.item_name,
                                                category_type.name,
                                                inventory_item.pos_item_id,
                                                inventory_item.reorder_level,
                                                inventory_item.selling_price_item,
                                                inventory_item.alkaline_price,
                                                inventory_item.mineral_price,
                                                inventory_item.image, 
                                                inventory_item.created_at,
                                                inventory_item.created_by 
                                                FROM inventory_item 
                                                INNER JOIN category_type  
                                                ON inventory_item.category_by_id = category_type.id
                                                INNER JOIN pos_item  
                                                ON inventory_item.pos_item_id = pos_item.id  
                                                INNER JOIN status_archive 
                                                ON inventory_item.status_archive_id = status_archive.id
                                                WHERE inventory_item.id='$id'");

    if (mysqli_num_rows($result) > 0) {
        $inventory_item = mysqli_fetch_assoc($result); ?>
        <form name="edit" action="" method="post" enctype="multipart/form-data"  id="edituserFrm">
            <div class="bg-editDropdown" id="edit-bgdrop">
                <div class="container1" id="container1">
                    <div class="profile-pic">
                        <img src="../uploaded_image/<?=$inventory_item['image'];?>" alt="">
                    </div>

                    <h1 class="addnew-title">EDIT ITEM</h1>
                    <form action="#">
                        <span class="gender-title">POS ITEM</span>
                        <div class="gender-category" >
                            <input <?php if($inventory_item['pos_item_id'] === '1') echo "checked"; ?>
                                    type="radio" value="1" name="pos_item" id="Yes" required="required" onclick="mainForm1()">
                            <label for="Yes" >Yes</label>
                            <input <?php if($inventory_item['pos_item_id'] === '2') echo "checked"; ?>
                                    type="radio" value="2" name="pos_item" id="No" onclick="mainForm2()">
                            <label for="No" >No</label>
                        </div>
                        <div class="line"></div>
                        <div class="main-user-info">
                            <input type="hidden" required="required" name="id" value="<?=$inventory_item['id'];?>">

                            <div class="user-input-box">
                                <label for="itemname">Item Name</label>
                                <input type="text"
                                       id="itemname"
                                       name="item_name"
                                       required="required"
                                       placeholder="Enter Item Name" value="<?=$inventory_item['item_name'];?>"/>
                            </div>
                            <div class="usertype-dropdown">
                                <?php
                                $dropdown_query = "SELECT * FROM category_type";
                                $result_category = mysqli_query($con, $dropdown_query);
                                ?>
                                <select class="select" name="category_type" required="" value="hello">
                                    <option selected disabled value="">TYPE</option>
                                    <?php while($category = mysqli_fetch_array($result_category)):;?>
                                        <option value="<?php echo $category['id']?>"
                                            <?php
                                            if($inventory_item['name'] === $category['name'])
                                            {
                                                echo 'selected';
                                            }
                                            ?>>
                                            <?php echo $category['name'];?>
                                        </option>
                                    <?php endwhile;?>
                                </select>
                            </div>

                            <div class="user-input-box">
                                <label for="reorder">Reorder Level</label>
                                <input type="number" min='0' onkeypress='return isNumberKey(event)'
                                       id="reorder"
                                       name="re_order"
                                       placeholder='0'
                                       required="required" value="<?=$inventory_item['reorder_level'];?>"/>
                            </div>

                            <div class="user-input-box" id="srpprice_box">
                                <label for="sellingprice">SRP</label>
                                <!-- <span class="srp">PHP</span> -->
                                <input type="number" min='0' onchange='setTwoNumberDecimal' step="0.25"
                                       id="sellingprice"
                                       class="sellingprice"
                                       name="selling_price"
                                       placeholder="0.00"
                                       required="required" value="<?=$inventory_item['selling_price_item'];?>"/>
                            </div>
                            <div class="user-input-box" id="alkalineprice_box">
                                <label for="alkalineprice">Alkaline Price</label>
                                <!-- <span class="srp">PHP</span> -->
                                <input type="number" min='0' onchange='setTwoNumberDecimal' step="0.25"
                                       id="alkalineprice"
                                       class="alkalineprice"
                                       name="alkaline_price"
                                       placeholder="0.00"
                                       required="required" value="<?=$inventory_item['alkaline_price'];?>"/>
                            </div>
                            <div class="user-input-box" id="mineralprice_box">
                                <label for="mineralprice">Mineral Price</label>
                                <!-- <span class="srp">PHP</span> -->
                                <input type="number" min='0' onchange='setTwoNumberDecimal' step="0.25"
                                       id="mineralprice"
                                       class="mineralprice"
                                       name="mineral_price"
                                       placeholder="0.00"
                                       required="required" value="<?=$inventory_item['mineral_price'];?>"/>
                            </div>
                            <div class="line"></div>
                            <span class="gender-title">Image</span>
                            <div class="choose-profile">
                                <input type="file" id="image-profile" name="image_item" accept="image/jpg, image/png, image/jpeg" value="<?php echo "uploaded_image/".$inventory_item['image']; ?>">
                            </div>
                            <div class="line"></div>

                            <div class="bot-buttons">
                                <div class="CancelButton">
                                    <a href="../inventory/inventory-details.php" id="cancel">CANCEL</a>
                                </div>
                                <div class="AddButton">
                                    <button type="submit" id="adduserBtn" name="submit">SAVE</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </form>
        <?php if($inventory_item['pos_item_id'] === '2') {
            echo '<script type="text/javascript"> 
                    const mainform = document.querySelector(".main-user-info");
                    const srp = document.querySelector("#srpprice_box");
                    const alkaline = document.querySelector("#alkalineprice_box");
                    const mineral = document.querySelector("#mineralprice_box");
                    mainform.style.display = "flex";
                    srp.style.display = "none";
                    alkaline.style.display = "none";
                    mineral.style.display = "none";
                                      </script>';
        }
        ?>
    <?php }}else{
           echo '<script> location.replace("../inventory/inventory-details.php"); </script>';
    } ?>
</body>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/inventory-details-edit.js"></script>
</html>
