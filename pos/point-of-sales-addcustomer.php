<?php
include '../database/connection-db.php';
require_once '../service/pos-add-customer.php';

date_default_timezone_set("Asia/Manila");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="../CSS/point-of-sales-addcustomer.css">
    <title>Tag's Water Purified Drinking Water</title>
</head>
<body>

<div class="container">

    <?php
    include('../common/side-menu.php')
    ?>
  <main>
        <div class="main-pos">
            <h1 class="posTitle">POINT OF SALES</h1>
        </div>
    </main>
            <div class="top-menu">
                <div class="menu-bar">
                    <div class="menu-btn2">
                        <i class="fas fa-bars"></i>
                    </div>
                    <h2 class="Title-top">POINT OF SALES</h2>
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
                                <input type="checkbox" class="checkbox" id="checkbox">
                                <label for="checkbox" class="theme-dark">
                                    <svg class="moon" xmlns="http://www.w3.org/2000/svg" height="18" width="18"><path d="M10 17q-2.917 0-4.958-2.042Q3 12.917 3 10q0-2.917 2.042-4.958Q7.083 3 10 3q.271 0 .531.021.261.021.531.062-.812.605-1.291 1.5-.479.896-.479 1.917 0 1.771 1.218 2.99 1.219 1.218 2.99 1.218 1.021 0 1.917-.479.895-.479 1.5-1.291.041.27.062.531.021.26.021.531 0 2.917-2.042 4.958Q12.917 17 10 17Z"/></svg>
                                    <svg class="sun" xmlns="http://www.w3.org/2000/svg" height="18" width="18"><path d="M10 14q-1.667 0-2.833-1.167Q6 11.667 6 10q0-1.667 1.167-2.833Q8.333 6 10 6q1.667 0 2.833 1.167Q14 8.333 14 10q0 1.667-1.167 2.833Q11.667 14 10 14Zm-8.25-3.25q-.312 0-.531-.219Q1 10.312 1 10q0-.312.219-.531.219-.219.531-.219h2q.312 0 .531.219.219.219.219.531 0 .312-.219.531-.219.219-.531.219Zm14.5 0q-.312 0-.531-.219-.219-.219-.219-.531 0-.312.219-.531.219-.219.531-.219h2q.312 0 .531.219Q19 9.688 19 10q0 .312-.219.531-.219.219-.531.219ZM10 4.5q-.312 0-.531-.219-.219-.219-.219-.531v-2q0-.312.219-.531Q9.688 1 10 1q.312 0 .531.219.219.219.219.531v2q0 .312-.219.531-.219.219-.531.219ZM10 19q-.312 0-.531-.219-.219-.219-.219-.531v-2q0-.312.219-.531.219-.219.531-.219.312 0 .531.219.219.219.219.531v2q0 .312-.219.531Q10.312 19 10 19ZM5.042 6.104 4 5.042q-.229-.209-.229-.511 0-.302.229-.531.208-.229.521-.229.312 0 .521.229l1.062 1.042q.229.229.229.531 0 .302-.229.531-.208.229-.521.229-.312 0-.541-.229ZM14.958 16l-1.062-1.042q-.229-.229-.229-.531 0-.302.229-.531.208-.229.521-.229.312 0 .541.229L16 14.958q.229.209.229.511 0 .302-.229.531-.229.229-.521.229-.291 0-.521-.229Zm-1.062-9.896q-.229-.208-.229-.521 0-.312.229-.541L14.958 4q.23-.229.521-.219.292.011.521.219.229.229.229.521 0 .291-.229.521l-1.042 1.062q-.229.229-.531.229-.302 0-.531-.229ZM4 16q-.229-.208-.229-.521 0-.312.229-.521l1.042-1.062q.229-.208.531-.208.302 0 .531.208.229.229.219.531-.011.302-.219.531L5.042 16q-.209.229-.511.229-.302 0-.531-.229Z"/></svg>
                                    <div class="ball"></div>
                                </label>
                                </input>
                                <a href="#" class="account">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.917 14.167q1.062-.875 2.364-1.313 1.302-.437 2.719-.437 1.417 0 2.719.437 1.302.438 2.385 1.313.688-.855 1.084-1.907.395-1.052.395-2.26 0-2.75-1.916-4.667Q12.75 3.417 10 3.417T5.333 5.333Q3.417 7.25 3.417 10q0 1.208.406 2.26.406 1.052 1.094 1.907ZM10 10.854q-1.229 0-2.073-.844-.844-.843-.844-2.072 0-1.23.844-2.073.844-.844 2.073-.844t2.073.844q.844.843.844 2.073 0 1.229-.844 2.072-.844.844-2.073.844Zm0 7.479q-1.729 0-3.25-.656t-2.646-1.781q-1.125-1.125-1.781-2.646-.656-1.521-.656-3.25t.656-3.25q.656-1.521 1.781-2.646T6.75 2.323q1.521-.656 3.25-.656t3.25.656q1.521.656 2.646 1.781t1.781 2.646q.656 1.521.656 3.25t-.656 3.25q-.656 1.521-1.781 2.646t-2.646 1.781q-1.521.656-3.25.656Zm.021-1.75q1.021 0 2-.312.979-.313 1.771-.896-.771-.604-1.75-.906-.98-.302-2.042-.302-1.062 0-2.031.302-.969.302-1.761.906.792.583 1.782.896.989.312 2.031.312ZM10 9.104q.521 0 .844-.323.323-.323.323-.843 0-.521-.323-.844-.323-.323-.844-.323-.521 0-.844.323-.323.323-.323.844 0 .52.323.843.323.323.844.323Zm0-1.166Zm0 7.437Z"/></svg>
                                    <h4>My Account</h4>
                                </a>
                                <a href="#" class="help">
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
    <form action="" method="post" enctype="multipart/form-data" id="addcustomerFrm">
        <div class="bg-addcustomerform" id="bg-addform">
            <div class="container1">
                <h1 class="addnew-title">ADD NEW CUSTOMER</h1>
                <form action="#">
                    <div class="main-user-info">
                        <div class="user-input-box">
                            <label for="customer_name">Customer Name</label>
                            <input type="text"
                                id="customer_name"
                                name="customer_name"
                                required="required"
                                placeholder="Enter Customer Name"/>
                        </div>
                        <div class="user-input-box" id="address-box">
                            <label for="address">Address</label>
                            <input type="text"
                                id="address"
                                class="address"
                                required="required" name="address" placeholder="Enter Address"/>
                        </div>
                        <div class="user-input-box" >
                            <label for="contact_num1">Contact Number 1</label>
                            <input type="text" id="contact_num1" class="contactnum1" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode))) return false;" required="required" name="contact_num1" placeholder="Enter Contact Number"/>
                        </div>
                        <div class="user-input-box">
                            <label for="contact_num2">Contact Number 2</label>
                            <input type="text" id="contact_num2"class="contactnum2" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode))) return false;"name="contact_num2" placeholder="Enter Contact Number"/>
                        </div>

                        <div class="user-input-box" id="note-box">
                            <label for="note">Note</label>
                            <input type="text"
                                id="note" class="note" name="note" placeholder="Enter a Note"/>
                        </div>
                        <div class="line"></div>

                        <div class="bot-buttons">
                            <div class="CancelButton-add">
                            <a href="../pos/point-of-sales.php" id="cancel" name="cancel-add-customer" >CANCEL</a>

                            </div>
                            <div class="AddButton">
                                <button type="submit" id="addcustomerBtn" name="save-customer">SAVE</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="bg-selectcustomerform" id="bg-selectform">
            <div class="container2">
                <div class="close" id="close-btn" onclick="close(this)">
                    <a href="../pos/point-of-sales.php" class="close-a">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24"><path d="M6.4 19 5 17.6l5.6-5.6L5 6.4 6.4 5l5.6 5.6L17.6 5 19 6.4 13.4 12l5.6 5.6-1.4 1.4-5.6-5.6Z"/></svg>
                    </a>
                </div>
                <h1 class="selectnew-title">SELECT CUSTOMER</h1>
                <button class="guest-button" id="guest-button" value="Guest" onclick='guestCustomer()'>Guest</button>
                <input type="button" onclick='guestCustomer()'class="guest-button" id="guest-button" value="Guest" />
                <div class="search">
                    <div class="search-bar">
                        <input text="text" placeholder="Search" onkeyup='tableSearch()' id="searchInput" name="searchInput"/>
                        <button type="submit" >
                            <svg id="search-icon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="m15.938 17-4.98-4.979q-.625.458-1.375.719Q8.833 13 8 13q-2.083 0-3.542-1.458Q3 10.083 3 8q0-2.083 1.458-3.542Q5.917 3 8 3q2.083 0 3.542 1.458Q13 5.917 13 8q0 .833-.26 1.583-.261.75-.719 1.375L17 15.938ZM8 11.5q1.458 0 2.479-1.021Q11.5 9.458 11.5 8q0-1.458-1.021-2.479Q9.458 4.5 8 4.5q-1.458 0-2.479 1.021Q4.5 6.542 4.5 8q0 1.458 1.021 2.479Q6.542 11.5 8 11.5Z"/></svg>
                        </button>
                    </div> 
                </div>
                <form action="#">
                    <div class="customer-container">
                        <table class="table" id="customerTable">
                            <thead>
                            <tr>
                                <th class="select-label">SELECT</th>
                                <th>ID</th>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>Contact Number 1</th>
                                <th>Contact Number 2</th>
                                <th>Balance</th>
                                <th>Note</th>
                            </tr>
                            </thead>

                            <?php
                            $query = "SELECT customers.id,
                                        customers.customer_name,
                                        customers.address,
                                        customers.contact_number1,
                                        customers.contact_number2,
                                        customers.balance,
                                        customers.note, 
                                        status_archive.status, 
                                        customers.created_at,
                                        users.first_name,
                                        users.last_name
                                        FROM customers 
                                        INNER JOIN status_archive 
                                        ON customers.status_archive_id = status_archive.id 
                                        INNER JOIN users
                                        ON customers.created_by = users.user_id
                                        WHERE customers.status_archive_id = '1'";
                            $result = mysqli_query($con, $query);
                            if(mysqli_num_rows($result) > 0)
                            {
                            foreach($result as $rows)
                            {
                            ?>
                            <tbody>
                            <tr>
                                <td> <button  class="selectCus" id="selectCus" onclick='selectCus()'><svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="m8.229 14.062-3.521-3.541L5.75 9.479l2.479 2.459 6.021-6L15.292 7Z"/></svg></button> </td>
                                <td> <?php echo $rows['id']; ?></td>
                                <td> <?php echo $rows['customer_name']; ?></td>
                                <td> <?php echo $rows['address']; ?></td>
                                <td> <?php echo $rows['contact_number1']; ?></td>
                                <td> <?php echo $rows['contact_number2']; ?></td>
                                <td> <?php echo '<span>&#8369;</span>'.' '.$rows['balance']; ?></td>
                                <td> <?php echo $rows['note']; ?></td>
                            </tr>
                            <?php } ?>
                            <?php } else { ?>
                                <tr id="noRecordTR">
                                    <td colspan="7">No Record(s) Found</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </form>
</body>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/point-of-sales-addcustomer.js"></script>

</html>
