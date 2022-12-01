<?php
require_once '../service/add-inventory-item.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="../CSS/inventory-details.css">
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
            <?php
            if (isset($_GET['error'])) {
                echo '<p id="myerror" class="error-error"> '.$_GET['error'].' </p>';
            }
            ?>
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

                    <?php
                    $query = "SELECT
                            inventory_item.id,
                            inventory_item.item_name,
                            category_type.name,
                            inventory_item.pos_item,
                            inventory_item.reorder_level,
                            inventory_item.selling_price_item,
                            water_item_refill_price.alkaline_price,
                            water_item_refill_price.mineral_price,
                            inventory_item.image, 
                            status_archive.status, 
                            inventory_item.created_at,
                            users.first_name,
                            users.last_name
                            FROM inventory_item 
                            INNER JOIN category_type  
                            ON inventory_item.category_by_id = category_type.id 
                            INNER JOIN water_item_refill_price  
                            ON inventory_item.alkaline_price_id  = water_item_refill_price.id 
                            INNER JOIN water_item_refill_price  
                            ON inventory_item.mineral_price_id = water_item_refill_price.id 
                            INNER JOIN status_archive 
                            ON inventory_item.status_archive_id = status_archive.id
                            INNER JOIN users
                            ON inventory_item.created_by = users.user_id
                            WHERE inventory_item.status_archive_id = '1'";
                    $result = mysqli_query($con, $query);
                    $inventory = "SELECT * FROM inventory_item";
                    $sql = mysqli_query($con, $inventory);
                    while ($rows = mysqli_fetch_assoc($result)) {?>
                        <tbody>
                        <tr>
                            <td> <?php echo $rows['id']; ?></td>
                            <td> <?php echo $rows['item_name']; ?></td>
                            <td> <?php echo $rows['name']; ?></td>
                            <td> <?php echo $rows['pos_item']; ?></td>
                            <td> <?php echo $rows['reorder_level']; ?></td>
                            <td> <?php echo $rows['selling_price_item']; ?></td>
                            <td> <?php echo $rows['alkaline_price']; ?></td>
                            <td> <?php echo $rows['mineral_price']; ?></td>
                            <td> <img src="<?php echo "../uploaded_image/".$rows['image']; ?>" alt='No Image' width="50px"></td>
                            <td> <?php echo $rows['created_at']; ?></td>
                            <td> <?php echo $rows['first_name'] .' '. $rows['last_name'] ; ?></td>
                            <td>
                                <a href="../inventory/inventory-details-edit.php?edit=<?php echo $rows['id']; ?>" id="edit-action" class="action-btn" name="action">
                                    <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.25 15.75h1.229l7-7-1.229-1.229-7 7Zm11.938-8.208-3.73-3.73 1.021-1.02q.521-.521 1.24-.521t1.239.521l1.25 1.25q.5.5.5 1.239 0 .74-.5 1.24Zm-1.23 1.229L6.229 17.5H2.5v-3.729l8.729-8.729Zm-3.083-.625-.625-.625 1.229 1.229Z"/></svg>
                                </a>
                                <a href="../inventory/inventory-details-archive.php?edit=<?php echo $rows['id']; ?>" id="archive-action" class="action-btn" name="action">
                                    <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.75 17.708Q3.708 17.708 3 17t-.708-1.75V5.375q0-.417.156-.833.156-.417.448-.709l1.125-1.104q.333-.291.76-.489t.844-.198h8.75q.417 0 .844.198t.76.489l1.125 1.104q.292.292.448.709.156.416.156.833v9.875q0 1.042-.708 1.75t-1.75.708Zm0-12.208h10.5l-1-1h-8.5ZM10 14.083l3.375-3.354-1.333-1.375-1.084 1.084V7.354H9.042v3.084L7.958 9.354l-1.333 1.375Z"/></svg>
                                </a>
                            </td>
                        </tr>
                        <tr id="noRecordTR" style="display:none">
                            <td colspan="12">No Record Found</td>
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
            <h1 class="addnew-title">ADD NEW ITEM</h1>
            <form action="#">
                <input type="hidden" required="required" name="status" value="1">
                <div class="main-user-info">
                    <div class="user-input-box">
                        <label for="itemname">Item Name</label>
                        <input type="text"
                               id="itemname"
                               name="item_name"
                               required="required"
                               placeholder="Enter Item Name"/>
                    </div>
                    <div class="usertype-dropdown">
                        <?php
                        $dropdown_query = "SELECT * FROM category_type";
                        $result_category = mysqli_query($con, $dropdown_query);
                        ?>
                        <select class="select" name="category_type" required="" >
                            <option selected disabled value="">SELECT TYPE</option>
                            <?php while($category = mysqli_fetch_array($result_category)):;?>
                                <option value="<?php echo $category['id']?>">
                                    <?php echo $category['name'];?></option>
                            <?php endwhile;?>
                        </select>
                    </div>

                    <div class="user-input-box">
                        <label for="reorder">Reorder Level</label>
                        <input type="number" min='0' onkeypress='return isNumberKey(event)'
                               id="reorder"
                               name="re_order"
                               placeholder='0'
                               required="required"/>
                    </div>

                    <div class="user-input-box">
                        <label for="sellingprice">SRP</label>
                        <input type="number" min='0' onchange='setTwoNumberDecimal' step="0.25"
                               id="sellingprice"
                               class="sellingprice"
                               name="selling_price"
                               placeholder="0.00"
                               required="required"/>
                    </div>
                    <div class="user-input-box">
                        <label for="alkalineprice">Alkaline Price</label>
                        <input type="number" min='0' onchange='setTwoNumberDecimal' step="0.25"
                               id="alkalineprice"
                               class="alkalineprice"
                               name="alkaline_price"
                               placeholder="0.00"
                        />
                    </div>
                    <div class="user-input-box">
                        <label for="mineralprice">Mineral Price</label>
                        <input type="number" min='0' onchange='setTwoNumberDecimal' step="0.25"
                               id="mineralprice"
                               class="mineralprice"
                               name="mineral_price"
                               placeholder="0.00"
                        />
                    </div>
                    <div class="line"></div>
                    <span class="gender-title">Image</span>
                    <div class="choose-profile">
                        <input type="file" id="image-profile" name="image_item" accept="image/jpg, image/png, image/jpeg" >
                    </div>
                    <span class="gender-title">POS ITEM</span>
                    <div class="gender-category" >
                        <input type="radio" name="pos_item" id="Yes" value="Yes" required="required">
                        <label for="Yes">Yes</label>
                        <input type="radio" name="pos_item" id="No" value="No">
                        <label for="No">No</label>
                    </div>
                    <div class="line"></div>

                    <div class="bot-buttons">
                        <div class="CancelButton">
                            <a href="../inventory/inventory-details.php" id="cancel">CANCEL</a>
                        </div>
                        <div class="AddButton">
                            <button type="submit" id="adduserBtn" name="add-inventory">SAVE</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</form>
</div>

</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/d3js/7.6.1/d3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="../javascript/inventory-details.js"></script>
<style>
    .main-account{
        width:100%;
        position: relative;
    }
    .accTitle{
        margin-top: 3.2rem;
        font-size: min(max(1.9rem, 1.1vw), 2rem);
        color: var(--color-main);
        font-family: 'COCOGOOSE', sans-serif;
        letter-spacing: .03rem;
        border-bottom: 2px solid var(--color-main);
        width: 78%;
    }

</style>