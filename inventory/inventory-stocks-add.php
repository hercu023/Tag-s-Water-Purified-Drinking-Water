<?php
require_once '../database/connection-db.php';
require_once '../service/add-stocks.php';
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

<form action="" method="post" enctype="multipart/form-data" id="adduserFrm">
    <div class="bg-adduserform" id="bg-addform">
        <div class="message"></div>
        <div class="container1">
            <h1 class="addnew-title">ADD NEW ITEM</h1>
            <form action="#">
            <div class="main-user-info">
                            <div class="usertype-dropdown">
                                <?php
                                $dropdown_query = "SELECT 
                                inventory_stock.id,
                                inventory_item.id, 
                                inventory_item.item_name, 
                                category_by_id 
                                FROM inventory_stock
                                INNER JOIN inventory_item
                                ON inventory_stock.item_name_id = inventory_item.id
                                INNER JOIN category_type
                                ON inventory_item.category_by_id = category_type.id
                                WHERE category_type.name != 'For Refill'";
                                $result_item = mysqli_query($con, $dropdown_query);
                                ?>
                                <select class="select" name="id" required="" >
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
                                        name="supplier"
                                        placeholder="Enter Supplier"
                                        required="required"/>
                            </div>
                            <div class="user-input-box">
                                <label for="Quantity">Quantity</label>
                                <input type="number" min='0' onkeypress='return isNumberKey(event)'
                                        id="Quantity"
                                        name="quantity"
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
                                    <a href="../inventory/inventory-stocks.php" id="cancel">CANCEL</a>
                                </div>
                                <div class="AddButton">
                                    <button type="submit" id="adduserBtn" name="add-inventory-stocks" >SAVE</button>
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
.bg-adduserform{
    display: flex;
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