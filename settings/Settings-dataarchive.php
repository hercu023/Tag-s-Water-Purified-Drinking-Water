<?php
session_start();
include '../connectionDB.php';
if (isset($_POST['email']) && isset($_POST['password'])){

    $email = $_POST['email'];
    $pass = $_POST['password'];

    if (empty($email)){
        // header("Location: login.php?error=Email is required");
    }else if (empty($pass)){
        // header("Location: login.php?error=Password is required");
    }else{
        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() === 1){
            $user = $stmt->fetch();

            $user_id = $user['id'];
            $user_email = $user['email'];
            $user_password = $user['password'];
            $user_first_name = $user['first_name'];
            $user_user_type = $user['user_type'];
            $user_profile_image = $user['profile_image'];
            if ($email === $user_email){
                if (password_verify($pass, $user_password)){
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_email'] = $user_email;
                    $_SESSION['user_first_name'] =  $user_first_name;
                    $_SESSION['user_user_type'] =  $user_user_type;
                    $_SESSION['user_profile_image'] =  $user_profile_image;
                }else{
                    header("Location: login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> The password you've entered is incorrect");
                }
            }else {
                header("Location: login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> The email you entered is not connected to the system");
            }
        }else{
            header("Location: login.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> The email you entered is not connected to the system");
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
    <!-- <link rel="stylesheet" type="text/css" href="../TAG-S-WATER-PURIFIED-DRINKING-WATER/CSS/Dashboard.css"> -->
    <link rel="stylesheet" type="text/css" href="../CSS/settings-dataarchive-main.css">
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/galhau-display" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/malberg-trial" rel="stylesheet">
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
        <div class="main-dashboard">
            <h1 class="dashTitle">SETTINGS</h1>
            <div class="sub-tab">
                <div class="user-title">
                    <h2> Archive </h2>
                </div>
                <div class="sub-tab2">
                    <div class="delivery-options">
                        <select class="select" onchange="window.location.href=this.value;">
                            <option selected disabled value="">SELECT DATA</option>
                            <option value="../settings/Settings-dataarchive-account.php">Account</option>
                            <option value="../settings/Settings-dataarchive-customers.php">Customers</option>
                            <option value="Employee">Employee</option>
                            <option value="../settings/Settings-dataarchive-inventory.php">Inventory</option>
                        </select>
                    </div>
                    <div class="newUser-button">
                        <button type="submit" id="add-userbutton" class="add-account" onclick="selectRestore();">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 13.5h1.5v-3.125l1.188 1.187L13 10.5l-3-3-3 3 1.062 1.062 1.188-1.187ZM6.5 17q-.625 0-1.062-.438Q5 16.125 5 15.5v-10H4V4h4V3h4v1h4v1.5h-1v10q0 .625-.438 1.062Q14.125 17 13.5 17Z"/></svg>
                            <h3>RESTORE</h3>
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
            <div class="main-container">
                <h3 class="word">No Data Selected</h3>
                <div class="customer-container">
                    <table class="table" id="myTable">
                        <thead>
                        <tr>
                            <th class="select-label"><label>SELECT</label></th>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Contact Number 1</th>
                            <th>Contact Number 2</th>
                            <th>Balance</th>
                            <th>Note</th>
                            <th>Added By</th>
                            <th>Date/Time Added</th>
                        </tr>
                        </thead>

                        <?php
                        $query1 = "SELECT customers.id,customers.customer_name,customers.address,customers.contact_number1,customers.contact_number2,customers.balance,customers.note, status_archive.status, customers.created_at, customers.created_by FROM customers INNER JOIN status_archive ON customers.status_archive_id = status_archive.id WHERE customers.status_archive_id = '1'";
                        $result1 = mysqli_query($con, $query1);
                        while ($rows = mysqli_fetch_assoc($result1))
                        {
                            ?>
                            <tbody>
                            <tr>
                                <td  class="select-check"><input type="checkbox" name="select-check"></td>
                                <td> <?php echo $rows['id']; ?></td>
                                <td> <?php echo $rows['customer_name']; ?></td>
                                <td> <?php echo $rows['address']; ?></td>
                                <td> <?php echo $rows['contact_number1']; ?></td>
                                <td> <?php echo $rows['contact_number2']; ?></td>
                                <td> <?php echo $rows['balance']; ?></td>
                                <td> <?php echo $rows['note']; ?></td>
                                <td> <?php echo $rows['created_by']; ?></td>
                                <td> <?php echo $rows['created_at']; ?></td>
                            </tr>
                            <tr id="noRecordTR" style="display:none">
                                <td colspan="6">No Record Found</td>
                            </tr>
                            </tbody>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <?php
    include('../common/top-menu.php')
    ?>

</div>
</body>
</html>
<script>
    // -----------------------------SIDE MENU
    $(document).ready(function(){
        //jquery for toggle sub menus
        $('.sub-btn').click(function(){
            $(this).next('.sub-menu').slideToggle();
            $(this).find('.dropdown').toggleClass('rotate');
        });

        //jquery for expand and collapse the sidebar
        $('.menu-btn').click(function(){
            $('.side-bar').addClass('active');
            $('.menu-btn').css("visibility", "hidden");
        });

        $('.close-btn').click(function(){
            $('.side-bar').removeClass('active');
            $('.menu-btn').css("visibility", "visible");
        });
        $('.menu-btn2').click(function(){
            $('.side-bar').addClass('active');
            $('.menu-btn2').css("visibility", "hidden");
        });

        $('.close-btn').click(function(){
            $('.side-bar').removeClass('active');
            $('.menu-btn2').css("visibility", "visible");
        });
    });
    //    --------------------------------------------------------------------
    const sideMenu = document.querySelector('#aside');
    const closeBtn = document.querySelector('#close-btn');
    const menuBtn = document.querySelector('#menu-button');
    const checkbox = document.getElementById('checkbox');
    const checkbox = document.getElementById('checkbox');
    menuBtn.addEventListener('click', () =>{
        sideMenu.style.display = 'block';
    })

    closeBtn.addEventListener('click', () =>{
        sideMenu.style.display = 'none';
    })
    checkbox.addEventListener( 'change', () =>{
        document.body.classList.toggle('dark-theme');
        //     if(this.checked) {
        //         body.classList.add('dark')
        //     } else {
        //         body.classList.remove('dark')     
        //     }
    });

</script>
