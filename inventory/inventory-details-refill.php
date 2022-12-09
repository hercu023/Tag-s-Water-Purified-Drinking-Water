<?php
require_once '../database/connection-db.php';
require_once '../service/add-inventory-item.php';
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
                <div class="newUser-button2">
                    <button type="submit" id="add-userbutton" class="add-account2" onclick="addnewuser();">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 14h1.5v-3.25H14v-1.5h-3.25V6h-1.5v3.25H6v1.5h3.25Zm.75 4q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                        <h3>Add Refill Item</h3>
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
                            WHERE category_by_id LIKE '%10' AND inventory_item.status_archive_id = '1'";
                    $result = mysqli_query($con, $query);
                    // $inventory = "SELECT * FROM inventory_item";
                    // $sql = mysqli_query($con, $inventory);
                    while ($rows = mysqli_fetch_assoc($result)) {?>
                        <tbody>
                        <tr>
                            <td> <?php echo $rows['id']; ?></td>
                            <td> <?php echo $rows['item_name']; ?></td>
                            <td> <?php echo $rows['name']; ?></td>
                            <td> <?php echo '<span>&#8369;</span>'.' '.$rows['alkaline_price']; ?></td>
                            <td> <?php echo '<span>&#8369;</span>'.' '.$rows['mineral_price']; ?></td>
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
            <h1 class="addnew-title">ADD REFILL ITEM</h1>
            <form action="#">
                <input type="hidden" required="required" name="status" value="1">
                <!-- <span class="gender-title">POS ITEM</span> -->
                    <div class="gender-category" >
                        <input type="hidden" name="pos_item" id="Yes" value="1" required="required" onclick="mainForm1()">
                    </div>
                    <div class="line"></div>
                <div class="main-user-info">
                    
                    <div class="user-input-box">
                        <label for="itemname">Item Size</label>
                        <input type="text"
                               id="itemname"
                               name="item_name"
                               required="required"
                               placeholder="Enter Item Name"/>
                    </div>
                    <div class="usertype-dropdown">
                        <?php
                        $dropdown_query = "SELECT * FROM category_type WHERE id LIKE '%10'";
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

                    <div class="user-input-box" id="alkalineprice_box">
                        <label for="alkalineprice">Alkaline Price</label>
                        <input type="number" min='0' onchange='setTwoNumberDecimal' step="0.25"
                               id="alkalineprice"
                               class="alkalineprice"
                               name="alkaline_price"
                               placeholder="0.00"
                                />
                    </div>
                    <div class="user-input-box" id="mineralprice_box">
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
                    <div class="line"></div>
                </div>
                    <div class="main-user-info2">
                        <div class="bot-buttons">
                            <div class="CancelButton">
                                <a href="../inventory/inventory-details-refill.php" id="cancel">CANCEL</a>
                            </div>
                            <div class="AddButton">
                                <button type="submit" id="adduserBtn" name="add-refill">SAVE</button>
                            </div>
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
    function mainForm2(){
        mainform.style.display = 'flex';
        srp.style.display = 'none';
        alkaline.style.display = 'none';
        mineral.style.display = 'none';

    }
    function addnewuser2(){
        const addForm2 = document.querySelector(".bg-adduserform2");

        addForm2.style.display = 'flex';
    }
</script>
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

.container1{
width: 100%;
max-width: 600px;
padding: 28px;
margin: 0 28px;
border-radius:  0px 0px 20px 20px;
background-color: var(--color-white);
box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
border-top: 10px solid var(--color-solid-gray);
}

.container2{
width: 100%;
max-width: 600px;
padding: 28px;
margin: 0 28px;
border-radius:  0px 0px 20px 20px;
background-color: var(--color-white);
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
.main-user-info3{
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
/* margin-top: 1rem; */
font-family: 'Calibri', sans-serif;
color: var(--color-solid-gray);
width: 100%;
font-size: 25px;
margin-left: .2rem;
font-family: 'Malberg Trial', sans-serif;
font-weight: 550;

/* border-bottom: 2px solid var(--color-solid-gray); */
}

.gender-category{
margin: 15px 0;
display: none;
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
.addnew-title{
    font-size: min(max(1.9rem, 1.1vw), 2rem);
    color: var(--color-solid-gray);
    font-family: 'Malberg Trial', sans-serif;
    letter-spacing: .09rem;
    display: flex;
    padding-top: 1rem;
    justify-content: center;
    border-bottom: 2px solid var(--color-solid-gray);
    width: 100%;
    padding-bottom: 2px;
}
.bot-buttons{
    width: 100%;
    align-items: center;
    text-align: center;
    display: inline-block;
    margin-top: 1.3rem;
}
.AddButton button{
    font-family: 'COCOGOOSE', sans-serif;
    padding: 10px;
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
    margin-left: 1rem;
}
.AddButton button:hover{
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
    display: none;
    /* justify-content: space-between; */
    width: 100%;
}

.main-user-info{
    max-height: 380px;
    overflow: auto;
    display: none;
}

.main-user-info::-webkit-scrollbar{
    width: 0;
}
.bot-buttons{
    width: 100%;
    align-items: center;
    text-align: center;
    margin-top: 1.3rem;
}
.AddButton button:hover{
    background: var(--color-button-hover);
}
.CancelButton{
    position: relative;
    margin-top: 3rem;
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
/* -----------------------------------------Adduserform------------------------------------------ */
.bg-actionDropdown{
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
        .action{ 
            position: absolute;
            top: 50%;
            align-items: center;
            text-align: center;
            /* display: none; */
            left: 50%;
            height: 13.5rem;
            min-width: 17rem;
            
            transform: translate(-50%, -50%);
            background-color: var(--color-white);
            box-shadow: 5px 7px 30px 0px var(--color-shadow-shadow);
            border-radius: 20px;  
         }
         #close-action{
            position: absolute;
            margin-top: -5.5rem;
            left:87%;
            fill: var(--color-solid-gray);
         }
         #close-action:hover{
            position: absolute;
            margin-top: -5.5rem;
            left:87%;
            fill: #8b0000;
            transition: .2s;
         }
         .action h2{
            padding-bottom: .5rem;
            margin-top: .5rem;
            font-size: min(max(1.9rem, 1.1vw), 2rem);
            color: var(--color-solid-gray);
            font-family: 'Malberg Trial', sans-serif;
            border-bottom:  2px solid var(--color-solid-gray);
            margin-bottom: 1rem;
         }
         .action button{
            padding-left:1rem;
            font-family: 'arial', sans-serif;
            cursor: pointer;
            transition: .5s;
            font-size: 12px;
            display: flex;
            gap: .8rem;
            width: 100%;
            border: none;
            background: var(--color-white);
            align-items: center;
            color: var(--color-solid-gray);
            fill: var(--color-solid-gray);
            border-radius: 20px;  
        }
        .action button:last-child{
            border-top:  2px solid var(--color-solid-gray);
        }
        
        .action button:hover{
            background: linear-gradient(270deg, transparent, var(--color-secondary-main));
            color: var(--color-main);
            fill: var(--color-main);
        }

.bg-adduserform{
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
.bg-adduserform2{
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
        .form1{
            position: relative;
            width: 205px;
            margin-left: 2rem;
            margin-top: -1.0rem;
            top: 15px;
        }
        .form1 input{
            width:100%;
            height: 2.5rem;
            padding: 10px;
            border: 2px solid var(--color-solid-gray);
            border-radius: 15px;
            outline: none;
            font-size: 1em;
            background: var(--color-white);
            color: var(--color-black);
        }
        .form1 span{
            position: absolute;
            left: 0;
            padding: 12px;
            pointer-events: none;
            font-size: 1.2em;
            margin-top: 0.1rem;
            margin-left: .2rem;
            color:var(--color-solid-gray);
        }
        .form1 input:focus{
            border: 2px solid var(--color-main-3);
        }
        .form1 input:valid ~ span,
        .form1 input:focus ~ span{
            color: var(--color-main-3);
            transform: translateX(10px) translateY(1px);
            font-size: 0.9em;
            padding: 0 10px;
            transition: .3s
        }
        .form2{
            position: relative;
            width: 205px;
            height: 17px;
            margin-left: 16rem;
            margin-top: .395rem;
            top: -7.1rem;
        }
        .form2 input{
            width:100%;
            height: 2.5rem;
            padding: 10px;
            border: 2px solid var(--color-solid-gray);
            border-radius: 15px;
            outline: none;
            font-size: 1em;
            background: var(--color-white);
            color: var(--color-black);
        }
        .form2 span{
            position: absolute;
            left: 0;
            padding: 12px;
            pointer-events: none;
            font-size:  1.2em;
            margin-top: 0.1rem;
            margin-left: .2rem;
            color: var(--color-solid-gray);
        }
        .form2 input:focus{
            border: 2px solid var(--color-main-3);
        }
        .form2 input:valid ~ span,
        .form2 input:focus ~ span{
            color:var(--color-main-3);
            transform: translateX(10px) translateY(1px);
            font-size: 0.9em;
            padding: 0 10px;
            transition: .3s
        }
        .form4{
            position: relative;
            width: 205px;
            margin-left: 2rem;
            margin-top: -.895rem;
            top: -5.6rem;
        }
        .form4 input{
            width:100%;
            height: 2.5rem;
            padding: 10px;
            border: 2px solid var(--color-solid-gray);
            border-radius: 15px;
            outline: none;
            font-size: 1em;
            background: var(--color-white);
            color: var(--color-black);
        }
        .form4 span{
            position: absolute;
            left: 0;
            padding: 12px;
            pointer-events: none;
            font-size: 1.2em;
            margin-top: 0.1rem;
            margin-left: .2rem;
            color: var(--color-solid-gray);
        }
        .form4 input:focus{
            border: 2px solid var(--color-main-3);
        }
        .form4 input:valid ~ span,
        .form4 input:focus ~ span{
            color:var(--color-main-3);
            transform: translateX(10px) translateY(1px);
            font-size: 0.9em;
            padding: 0 10px;
            transition: .3s
        }
        .form5{
            position: relative;
            width: 205px;
            margin-left: 15.9rem;
            margin-top: 1rem;
            top: -10.93rem;
            margin-bottom: -5rem;
        }
        .form5 input{
            width:100%;
            height: 2.5rem;
            padding: 10px;
            border: 2px solid var(--color-solid-gray);
            border-radius: 15px;
            outline: none;
            font-size: 1em;
            background: var(--color-white);
            color: var(--color-black);
        }
        .form5 span{
            position: absolute;
            left: 0;
            padding: 12px;
            pointer-events: none;
            font-size: 1.2em;
            margin-top: .1rem;
            margin-left: .2rem;
            color: var(--color-solid-gray);
        }
        .form5 input:focus{
            border: 2px solid var(--color-main-3);
        }
        .form5 input:valid ~ span,
        .form5 input:focus ~ span{
            color:var(--color-main-3);
            transform: translateX(10px) translateY(1px);
            font-size: 0.9em;
            padding: 0 10px;
            transition: .3s
        }
        
        /* --------------------------------------DROP DOWN ACTION------------------------------------- */
        .actionBtn{
            background: var(--color-solid-gray);
            color: var(--color-white);
            font-size: 18px;
            font-family: "Font Awesome 5 Free", sans-serif;
            font-weight: 501;
            border-radius: 50px;
            padding-left: 5px;
            padding-right: 13px;
            padding-top: 10px;
            padding-bottom: 10px;
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
     
        #edit-action{
            background: hsl(0, 0%, 37%);
            color: var(--color-white);
            align-items: center;
            position: relative;
            border-radius: 3px;
            height: 100%;
            width: 70%;
            margin: 1px;
            padding-top: 10px;
            padding-right: 2px;
            padding-left: 2px;
            cursor: pointer;
            transition: 0.3s;
            border: none;
        }
        #edit-action:hover{
            background: var(--color-main);
            color: var(--color-white);
        }
        #cpass-action{
            background:#00aa09;
            position: relative;
            color: var(--color-white);
            align-items: center;
            text-align: center;
            margin: 1px;
            border-radius: 3px;
            height: 100%;
            width: 70%;
            padding-top: 10px;
            padding-right: 2px;
            padding-left: 5px;
            cursor: pointer;
            transition: 0.3s;
            border: none;
        }
        #cpass-action:hover{
            background: var(--color-main);
            color: var(--color-white);
        }
        #archive-action{
            background: hsl(0, 51%, 44%);
            color: var(--color-white);
            align-items: center;
            position: relative;
            margin: 1px;
            border-radius: 3px;
            height: 100%;
            width: 70%;
            padding-top: 10px;
            padding-right: 2px;
            padding-left: 5px;
            cursor: pointer;
            transition: 0.3s;
            border: none;
        }
        #archive-action:hover{
            background: var(--color-main);
            color: var(--color-white);
        }
     
.checker {
    text-align: right;
    align-items: right;
    margin-right: 3rem;
    margin-top: -7.5rem;
    margin-bottom: 5rem;
}
.checker span {
    text-decoration: none;
    color: var(--color-solid-gray);
    top: 0;
    font-size: min(max(10px, 1.2vw), 12px);
    font-family: 'Switzer', sans-serif;
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

.choose-profile:hover{
    background: var(--color-main-2);
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

/* ----------------------------------------Sub TAB---------------------------------------- */
.user-title{
    position: absolute;
    display: inline-block;
    width: 100%;
}
main  h2{
    /* margin-bottom: -2.2rem; */
    margin-top: 1rem;
    color: var(--color-solid-gray);
    font-size: 1.3rem;
    margin-left: 3%;
    letter-spacing: .1rem;
    font-family: 'Galhau Display', sans-serif;
}
main .sub-tab{
    margin-bottom: 3rem;
}
/* ----------------------------------------Search BAR---------------------------------------- */
.search{
    position: absolute;
    display: inline-block;
    gap: 2rem;
    align-items: right;
    text-align: right;
    right: 0;
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
    display: inline-block;
    position: relative;
    /* left: 15%; */
}
.newUser-button2{
    position: relative;
    display: inline-block;
    left: 16%;
}
.newUser-button3{
    position: relative;
    display: inline-block;
    left: 17%;
}
.newUser-button4{
    position: relative;
    display: inline-block;
    left: 17%;
}
.add-account{
    display: flex;
    border: none;
    background-color: var(--color-white);
    align-items: center;
    color: var(--color-button);
    fill: var(--color-button);
    width: 10.5rem;
    max-height: 46px;
    border-radius: 20px;
    padding: .68rem 1rem;
    font-family: 'Outfit', sans-serif;
    cursor: pointer;
    gap: 1rem;
    height: 3.9rem;
    transition: all 300ms ease;
    position: relative;
    margin-top: .2rem;
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
.add-account2{
    display: flex;
    border: none;
    background-color: var(--color-white);
    align-items: center;
    color: var(--color-button);
    fill: var(--color-button);
    width: 11.5rem;
    max-height: 46px;
    border-radius: 20px;
    padding: .68rem 1rem;
    font-family: 'Outfit', sans-serif;
    cursor: pointer;
    gap: 1rem;
    height: 3.9rem;
    transition: all 300ms ease;
    position: relative;
    margin-top: .2rem;
    text-transform: uppercase;
}
.add-account2 h3{
    font-size: .8rem;
}
.add-account2:hover{
    background-color: var(--color-main);
    color: var(--color-white);
    fill: var(--color-white);
    padding-top: -.2px;
    transition: 0.7s;
    border-bottom: 4px solid var(--color-maroon);
}
.add-account3{
    display: flex;
    border: none;
    background-color: var(--color-solid-gray);
    align-items: center;
    color: var(--color-white);
    /* width: 11.5rem; */
    max-height: 25px;
    border-radius: 5px;
    padding: .68rem 1rem;
    font-family: 'Outfit', sans-serif;
    cursor: pointer;
    gap: 1rem;
    font-weight: 900;
    height: 3.9rem;
    transition: all 300ms ease;
    position: relative;
    /* margin-top: rem; */
    text-transform: uppercase;
}
.add-account3 h3{
    font-size: .8rem;
}
.add-account3:hover{
    background-color: var(--color-secondary-main);
    color: var(--color-main);
    padding-top: -.2px;
    transition: 0.3s;
    
}
.add-account4{
    display: flex;
    border: none;
    background-color: var(--color-main);
    align-items: center;
    color: var(--color-secondary-main);
    /* width: 11.5rem; */
    max-height: 25px;
    border-radius: 5px;
    padding: .68rem;
    font-family: 'Outfit', sans-serif;
    cursor: pointer;
    gap: 1rem;
    height: 3.9rem;
    transition: all 300ms ease;
    position: relative;
    /* margin-top: .2rem; */
    text-transform: uppercase;
    border-left: 7px solid var(--color-tertiary);
}
.add-account4 h3{
    font-size: .8rem;
}
.add-account4:hover{
   
    padding-top: -.2px;
    transition: 0.3s;
}
     /* ----------------------------------------Account Table---------------------------------------- */
            .pagination{
                background-color: var(--color-white);
                display: flex;
                position: relative;
                overflow: hidden;
                border-radius: 50px;
                width: 40rem;
                align-items: center;
                text-align: center;
                margin: auto;
            }

            .pagination a{
                width: 80px;
                height: 60px;
                line-height: 60px;
                text-align: center;
                color: #333;
                font-size: 12px;
                font-weight: 700;
                transition: .3s linear;
                font-family: 'Poppins', sans-serif;

            }

            .pagination a:hover{
                color: #fff;
                background-color: #5271e9;
            }

            .bottom_bar{
                position: absolute;
                width: 80px;
                height: 4px;
                background-color: #000;
                bottom: 0;
                left: -100px;
                transition: .4s;
            }

main .account-container{
    margin-top: -1rem;
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