<?php
require_once '../database/connection-db.php';
require_once '../service/add-inventory-item.php';
require_once "../service/user-access.php";

if (!get_user_access_per_module($con, $_SESSION['user_user_type'], 'INVENTORY-STOCKS')) {
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
        <link rel="stylesheet" type="text/css" href="../CSS/inventory-stocks.css">
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
                            <h2>Inventory Stocks  </h2>
                        </div>
                        <div class="newUser-button"> 
                            <button type="submit" id="add-userbutton" class="add-account" onclick="addnewuser();">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 14h1.5v-3.25H14v-1.5h-3.25V6h-1.5v3.25H6v1.5h3.25Zm.75 4q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                                    <h3>Add Stocks</h3>
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
                        <!-- <div class="popup-addAccount">
                            
                        </div> -->
                    </div>
                    <div class="account-container">
                        <table class="table" id="myTable"> 
                            <thead> 
                                <tr>
                                    <th>ID</th>
                                    <th>Item Name</th>
                                    <th>Type</th>
                                    <th>IN</th>
                                    <th>OUT</th>
                                    <th>On Hand</th>
                                    <th>Total Purchase Amount</th>
                                    <th>Total Retail Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <?php
                            $inventory = "SELECT * FROM inventory_stock"; 
                            $sql = mysqli_query($con, $inventory);
                                while ($rows = mysqli_fetch_assoc($sql))
                                {
                            ?>
                            <tbody>
                                    <tr>
                                        <td> <?php echo $rows['id']; ?></td>
                                        <td> <?php echo $rows['item_name']; ?></td>
                                        <td> <?php echo $rows['name']; ?></td>
                                        <td> <?php echo $rows['in_going']; ?></td>
                                        <td> <?php echo $rows['out_going']; ?></td>
                                        <td> <?php echo $rows['on_hand']; ?></td>
                                        <td> <?php echo $rows['total_purchase_amount']; ?></td>
                                        <td> <?php echo $rows['total_retail_amount']; ?></td>
                                        <td> 
                                            <a href="../inventory/inventory-stocks-edit.php?edit=<?php echo $rows['id']; ?>" id="edit-action" class="action-btn" name="action">
                                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.25 15.75h1.229l7-7-1.229-1.229-7 7Zm11.938-8.208-3.73-3.73 1.021-1.02q.521-.521 1.24-.521t1.239.521l1.25 1.25q.5.5.5 1.239 0 .74-.5 1.24Zm-1.23 1.229L6.229 17.5H2.5v-3.729l8.729-8.729Zm-3.083-.625-.625-.625 1.229 1.229Z"/></svg>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr id="noRecordTR" style="display:none">
                                        <td colspan="9">No Record Found</td>                         
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
  
        <form action="" method="post" enctype="multipart/form-data" id="adduserFrm">
        <div class="bg-adduserform" id="bg-addform">
            <div class="message"></div>
            <div class="container1">
            <h1 class="addnew-title">ADD STOCKS</h1>
            <form action="#">
                <div class="main-user-info">
                    <div class="usertype-dropdown">
                        <?php
                        $dropdown_query = "SELECT inventory_item.id, inventory_item.item_name, category_by_id FROM inventory_item WHERE category_by_id LIKE '%1' OR category_by_id LIKE '%2' OR category_by_id LIKE '%3' OR category_by_id LIKE '%4' OR category_by_id LIKE '%5' OR category_by_id LIKE '%6' OR category_by_id LIKE '%7' OR category_by_id LIKE '%8' OR category_by_id LIKE '%9'";
                        $result_item = mysqli_query($con, $dropdown_query);
                        ?>
                        <select class="select" name="category_type" required="" >
                            <option selected disabled value="">SELECT ITEM</option>
                            <?php while($inventory_item = mysqli_fetch_array($result_item)):;?>
                                <option value="<?php echo $inventory_item['id']?>">
                                    <?php echo $inventory_item['item_name'];?></option>
                            <?php endwhile;?>
                        </select>
                    </div>

                   
                    <div class="user-input-box">
                        <label for="Supplier">Supplier</label>
                        <input type="text"
                                id="Supplier"
                                name="Supplier"
                                placeholder="Enter Supplier"
                                required="required"/>
                    </div>
                    <div class="user-input-box">
                        <label for="Quantity">Quantity</label>
                        <input type="number" min='0' onkeypress='return isNumberKey(event)'
                                id="Quantity"
                                name="Quantity"
                                placeholder="0"
                                required="required"/>
                    </div>
                    <div class="user-input-box">
                        <label for="purchaseamount">Purchase Amount</label>
                        <input type="decimal"
                                id="purchaseamount"
                                name="purchaseamount"
                                placeholder="Enter Purchase Amount"
                                required="required"/>
                    </div>
                    <div class="line"></div>

                    <div class="bot-buttons">
                        <div class="CancelButton">
                            <a href="inventory-stocks.php" id="cancel">CANCEL</a>
                        </div>
                        <div class="AddButton">
                            <button type="submit" id="adduserBtn" name="submit">SAVE</button>
                        </div>
                    </div>
                </div>
            </form>
           
            <div id="form-registered">
                <div id="container-registered">
                    <div class="content">
                        <div class="verify">
                            <svg class="verified" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                width="916px" height="916px" viewBox="0 0 916 916" style="enable-background:new 0 0 916 916;" xml:space="preserve">
                            <g>
                                <g>
                                    <path d="M97.65,862.3c4.7,31.3,27.1,53.7,54.7,53.7h616c27.6,0,50-22.4,50-50V50c0-27.6-22.4-50-50-50h-616
                                        c-27.6,0-50,22.4-54.7,46.3V862.3z M712.15,750.2l-62.8,62.8l0,0l-18.3,18.3c-9.8,9.7-25.601,9.7-35.3,0l-18.4-18.3l0,0l-18-17
                                        c-9.8-9.8-9.8-25.6,0-35.4l0.6-0.6c9.801-9.8,25.601-9.8,35.4,0l18,17l62.8-62.8c9.8-9.8,25.601-9.8,35.4,0l0.6,0.6
                                        C721.95,724.6,721.95,740.4,712.15,750.2z M727.55,602.1c0,13.801-11.2,25-25,25H631.95c-13.8,0-25-11.199-25-25V601.2
                                        c0-13.8,11.2-25,25-25h70.601c13.8,0,25,11.2,25,25V602.1z M727.55,470c0,13.8-11.2,25-25,25H631.95c-13.8,0-25-11.2-25-25v-0.9
                                        c0-13.8,11.2-25,25-25h70.601c13.8,0,25,11.2,25,25V470z M702.55,312c13.8,0,25,11.2,25,25v0.9c0,13.8-11.2,25-25,25H631.95
                                        c-13.8,0-25-11.2-25-25V337c0-13.8,11.2-25,25-25H702.55z M302.65,156c0-13.8,11.2-25,25-25h265.4c13.8,0,25,11.2,25,25v0.9
                                        c0,13.8-11.2,25-25,25h-265.4c-13.8,0-25-11.2-25-25V156z M193.15,337c0-13.8,11.2-25,25-25h265.4c13.8,0,25,11.2,25,25v0.9
                                        c0,13.8-11.2,25-25,25h-265.4c-13.8,0-25-11.2-25-25V337L193.15,337z M193.15,469.1c0-13.8,11.2-25,25-25h265.4
                                        c13.8,0,25,11.2,25,25v0.9c0,13.8-11.2,25-25,25h-265.4c-13.8,0-25-11.2-25-25V469.1L193.15,469.1z M193.15,601.2
                                        c0-13.8,11.2-25,25-25h265.4c13.8,0,25,11.2,25,25v0.899c0,13.801-11.2,25-25,25h-265.4c-13.8,0-25-11.199-25-25V601.2
                                        L193.15,601.2z"/>
                                </g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            </svg>
                        </div>  
                        <div class="register">  
                            <h2>Stocks Added Successfully</h2>
                        </div>
                    </div>
                        <div class="pageform">
                            <div class="confirmBtn">
                                <a href="../inventory/inventory-stocks.php" id="registered">CONFIRM</a>
                            </div> 
                        </div>
                </div>
            </div>
        </form>
        </div>
    
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/d3js/7.6.1/d3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>      
<script src="../javascript/inventory-stocks.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
<style>
.user-input-box{
display: flex;
flex-wrap: wrap;
width: 45%;
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
.usertype-dropdown{
            width: 100%;
            /* margin-top: 1.6rem; */
            display: flex;
            margin-bottom: 1rem;
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
.top-menu{
    margin-top: 1rem;
    position: absolute;
    right: 3%;
}
.user-title{
    position: absolute;
    display: inline-block;
    /* margin-left: 1rem; */
    width: 100%;
}
.newUser-button{
    position: absolute;
    display: inline-block;
    margin-left: 14rem;
}
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
</style>