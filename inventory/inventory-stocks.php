<?php
require_once '../controllerUserdata.php';
include_once('../connectionDB.php');
$query = "SELECT * FROM users";
$result = mysqli_query($con, $query);
    if (isset($_POST['id'])){

        $id = $_POST['id'];
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
        $stmt->execute([$id]);
        $fetch_profile = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() === 1){
                $user = $stmt->fetch();
                
                $user_id = $user['id'];
                $user_email = $user['email'];
                $user_first_name = $user['first_name'];
                $user_user_type = $user['user_type'];
                $user_profile_image = $user['profile_image'];
                if ($email === $user_email){

                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['user_email'] = $user_email;
                        $_SESSION['user_first_name'] =  $user_first_name;
                        $_SESSION['user_user_type'] =  $user_user_type;
                        $_SESSION['user_profile_image'] =  $user_profile_image;
                }
            }
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
                        <!-- <div class="user-title"> 
                            <h2> User Accounts </h2>
                        </div> -->
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
                                    <th>Total Amount</th>
                                    <th>Supplier</th>
                                    <th>Date/Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <?php
                            $inventory = "SELECT * FROM inventory"; 
                            $sql = mysqli_query($con, $inventory);
                                while ($rows = mysqli_fetch_assoc($sql))
                                {
                            ?>
                            <tbody>
                                    <tr>
                                        <td> <?php echo $rows['id']; ?></td>
                                        <td> <?php echo $rows['item_Name']; ?></td>
                                        <td> <?php echo $rows['type']; ?></td>
                                        <td> <?php echo $rows['stocks']; ?></td>
                                        <td> <?php echo $rows['outgoing']; ?></td>
                                        <td> <?php echo $rows['onhand']; ?></td>
                                        <td> <?php echo $rows['total_amount']; ?></td>
                                        <td> <?php echo $rows['supplier']; ?></td>
                                        <td> <?php echo $rows['DateTime']; ?></td>
                                        <td> 
                                            <a href="../customers/customer-edit.php?edit=<?php echo $rows['id']; ?>" id="edit-action" class="action-btn" name="action">
                                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.25 15.75h1.229l7-7-1.229-1.229-7 7Zm11.938-8.208-3.73-3.73 1.021-1.02q.521-.521 1.24-.521t1.239.521l1.25 1.25q.5.5.5 1.239 0 .74-.5 1.24Zm-1.23 1.229L6.229 17.5H2.5v-3.729l8.729-8.729Zm-3.083-.625-.625-.625 1.229 1.229Z"/></svg>
                                            </a>
                                            <a href="Account-Action-Archive.php?edit=<?php echo $rows['id']; ?>" id="archive-action" class="action-btn" name="action">
                                                <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M6.5 17q-.625 0-1.062-.438Q5 16.125 5 15.5v-10H4V4h4V3h4v1h4v1.5h-1v10q0 .625-.438 1.062Q14.125 17 13.5 17Zm7-11.5h-7v10h7ZM8 14h1.5V7H8Zm2.5 0H12V7h-1.5Zm-4-8.5v10Z"/></svg>
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
            <h1 class="addnew-title">ADD NEW ITEM</h1>
            <form action="#">
                <div class="main-user-info">
                <div class="user-input-box">
                    <label for="fullName">Item Name</label>
                    <input type="text"
                            id="fullName"
                            name="fullName"
                            readonly/>
                    <!-- <div class="usertype-dropdown">
                        <select class="select" name="usertypes" required="" >
                            <option selected disabled value="">TYPE</option>
                            <option value="Admin">Container</option>
                            <option value="Manager">Bottle</option>
                            <option value="Cashier">Seal</option>
                            <option value="Cashier">Filter</option>
                            <option value="Cashier">Caps</option>
                            <option value="Custom">Other</option>
                        </select>
                    </div> -->
                </div>
               
                    <!-- <th>ID</th>
                                    <th>Item Name</th>
                                    <th>Type</th>
                                    <th>POS</th>
                                    <th>Reorder Level</th>
                                    <th>SRP</th>
                                    <th>Cost</th>
                                    <th>Supplier</th>
                                    <th>Image</th>
                                    <th>Date/Time</th>
                                    <th>Action</th> -->
                <!-- <div class="user-input-box">
                    <label for="username">Reorder Level</label>
                    <input type="number" min='0' onkeypress='return isNumberKey(event)'
                            id="username"
                            name="username"
                            placeholder='0'
                            required="required"/>
                </div>
                 -->
                <div class="user-input-box">
                    <label for="Quantity">Quantity</label>
                    <input type="Quantity" min='0' onkeypress='return isNumberKey(event)'
                            id="Quantity"
                            name="Quantity"
                            placeholder="0"
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
            </form>
            </div>
            <!-- <div class="form-adduser1" id="form-adduser1">
                <h1 class="addnew-title">ADD NEW ITEM</h1>
            
                <div class="form-adduser2" id="form-adduser2">
                    <div class="form1">  
                        <input type="text" id="fill"class="lastname" required="required" name="lastname">
                        <span>Item Name</span>
                    </div> 
                    <div class="usertype-dropdown">
                        <select class="select" name="usertypes" required="" >
                            <option selected disabled value="">TYPE</option>
                            <option value="Admin">CONTAINER</option>
                            <option value="Manager">BOTTLE</option>
                            <option value="Cashier">SEAL</option>
                            <option value="Cashier">FILTER</option>
                            <option value="Cashier">CAPS</option>
                            <option value="Custom">OTHER</option>
                        </select>
                    </div>
                    <tr>
                                    <th>ID</th>
                                    <th>Item Name</th>
                                    <th>Type</th>
                                    <th>POS</th>
                                    <th>Reorder Level</th>
                                    <th>SRP</th>
                                    <th>Cost</th>
                                    <th>Supplier</th>
                                    <th>Image</th>
                                    <th>Date/Time</th>
                                    <th>Action</th>
                                </tr>
                    <div class="form2">  
                        <input type="text" id="fill"class="middlename" required="" name="middlename">
                        <span>Middle Name</span>
                    </div>
                    <div class="form2">  
                        <input type="text" id="fill" class="email" required="required" name="email">
                        <span>Email</span>
                    </div>
                    <div class="form4">  
                        <input type="text" id="fill" class="contactnum" onkeypress="return isNumberKey(event)" required="required" name="contactnum">
                        <span>Contact Number</span>
                    </div>
                    
                   <div class="usertype-dropdown">
                        <div class="select" id="usertype">
                            <span class="selected">ROLE</span>
                            <div class="caret"></div>
                        </div> 
                        <ul class="menu" name="usertypes" required="required" >
                            <li class="active">Admin</li>
                            <li>Manager</li>
                            <li>Cashier</li>
                            <li><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 15v-4.25H5v-1.5h4.25V5h1.5v4.25H15v1.5h-4.25V15Z"/></svg>
                            Custom</li>
                        </ul>
                     -->
                    <!-- <div class="form4">  
                        <input type="password" class="password" id="pass" required="required" name="pass">
                        <span>Password</span>
                    </div>
                    <div class="form5">  
                        <input type="password" class="confirm-password" id="cpass" required="required" name="ecpass">
                        <span>Confirm Password</span>
                    </div>
                    <div class="checker">
                        <input type="checkbox" name="" onclick="myFunctionCP()" >
                        <span>Show password</span>
                    </div>
                    <div class="profile-picture1" >
                        <h4 >Profile Picture</h4>
                    </div>
                    <div class="choose-profile">
                        <input type="file" id="image-profile" name="profile_image" accept="image/jpg, image/png, image/jpeg" >
                    </div>
                </div>   
             -->
                <!-- <div class="AddButton">
                    <button type="submit" id="adduserBtn" name="submit">SAVE</button>
                   <input type="submit" value="ADD USER" name="submit" id="sub" onclick="showalert()"> -->
            </div> 
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
                                <a href="inventory-stocks.php" id="registered">CONFIRM</a>
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
    .top-menu{
    margin-top: 1rem;
    position: absolute;
    right: 3%;
}
</style>