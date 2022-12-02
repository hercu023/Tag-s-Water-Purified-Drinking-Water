<?php
require_once '../service/edit-inventory-item.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="../CSS/inventory-details-edit.css">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="../index.js"></script>
</head>
<body>

<div class="container">

    <?php
    include('../common/side-menu.php')
    ?>

    <main>
        <div class="main-account">
            <h1 class="accTitle">INVENTORY</h1>
            <div class="sub-tab">
                <div class="user-title">
                    <h2> Inventory Item </h2>
                </div>
                <div class="newUser-button">
                    <button type="submit" id="add-userbutton" class="add-account" onclick="addnewuser();">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 14h1.5v-3.25H14v-1.5h-3.25V6h-1.5v3.25H6v1.5h3.25Zm.75 4q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                        <h3>Add New Item</h3>
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
                    
                    <h1 class="editnew-title">EDIT ITEM</h1>
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
    <?php }}?>
</body>
</html>
<script>
</script>
<script src="https://ajax.googleapis.com/ajax/libs/d3js/7.6.1/d3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="../javascript/inventory-details-edit.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
<script>
       const mainform = document.querySelector(".main-user-info");
    const srp = document.querySelector("#srpprice_box");
    const alkaline = document.querySelector("#alkalineprice_box");
    const mineral = document.querySelector("#mineralprice_box");

function mainForm1(){
    mainform.style.display = 'flex';
    srp.style.display = 'flex'
    alkaline.style.display = 'flex';
    mineral.style.display = 'flex';
}
// function mainForm2(){
//     mainform.style.display = 'flex';
//     srp.style.display = 'none';
//     alkaline.style.display = 'none';
//     mineral.style.display = 'none';

// }

</script>