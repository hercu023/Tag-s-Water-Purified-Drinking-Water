<?php
require_once '../controllerUserdata.php';
include_once('../connectionDB.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="../CSS/account-type.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
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

</head>
<body>

<div class="container">
    <div class="block"></div>
    <?php
    include('../common/side-menu.php')
    ?>
    <main>
        <div class="main-account">
            <h1 class="accTitle">ACCOUNT</h1>
            <div class="sub-tab">
                <div class="user-title">
                    <h2> Account Type</h2>
                </div>
                <div class="newUser-button">
                    <button type="submit" id="add-userbutton" class="add-account" onclick="addnewuser();">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 14h1.5v-3.25H14v-1.5h-3.25V6h-1.5v3.25H6v1.5h3.25Zm.75 4q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                        <h3>ADD ACCOUNT TYPE</h3>
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
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <?php
                    $query = "SELECT * FROM account_type";
                    $result = mysqli_query($con, $query);
                    while ($rows = mysqli_fetch_assoc($result))
                    {
                        ?>
                        <tbody>
                        <tr>
                            <td> <?php echo $rows['id']; ?></td>
                            <td> <?php echo $rows['user_type']; ?></td>
                            <td>
                                <a href="account-edit.php?edit=<?php echo $rows['id']; ?>" id="edit-action" class="action-btn" name="action">
                                    <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.521 17.479v-2.437l4.562-4.563 2.438 2.438-4.563 4.562Zm-7-3.958v-2.459h7.271v2.459Zm14.583-1.188-2.437-2.437.666-.667q.355-.354.865-.364.51-.011.864.364l.709.709q.375.354.364.864-.01.51-.364.865ZM2.521 9.75V7.292h9.958V9.75Zm0-3.771V3.521h9.958v2.458Z"/></svg>
                                </a>
                                <a href="Account-Action-Archive.php?edit=<?php echo $rows['id']; ?>" id="archive-action" class="action-btn" name="action">
                                    <svg class="actionicon" xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M4.75 17.708Q3.708 17.708 3 17t-.708-1.75V5.375q0-.417.156-.833.156-.417.448-.709l1.125-1.104q.333-.291.76-.489t.844-.198h8.75q.417 0 .844.198t.76.489l1.125 1.104q.292.292.448.709.156.416.156.833v9.875q0 1.042-.708 1.75t-1.75.708Zm0-12.208h10.5l-1-1h-8.5ZM10 14.083l3.375-3.354-1.333-1.375-1.084 1.084V7.354H9.042v3.084L7.958 9.354l-1.333 1.375Z"/></svg>
                                </a>
                            </td>
                        <tr id="noRecordTR" style="display:none">
                            <td colspan="10">No Record Found</td>
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
            <h1 class="addnew-title">ADD NEW ACCOUNT</h1>
            <form action="#">
                <div class="main-user-info">
                    <div class="user-input-box">
                        <label for="lastname">Last Name</label>
                        <input type="text"
                               id="lastname"
                               name="lastname"
                               required="required"
                               placeholder="Enter Last Name"/>
                    </div>
                    <div class="dropdown-accountype">
                        <div class="select-btn">
                            <span class="btn-text">Select language</span>
                            <span class="arrow-dwn">
                            <i class="fa-solid fa-chevron-down"></i>
                            </span>
                        </div>
                        
                        <ul class="list-items">
                        <li class="item">
                            <span class="checkbox">
                            <i class="fa-solid fa-check check-icon"></i>
                            </span>
                            <span class="item-text">Item 1</span>
                        </li>
                        <li class="item">
                            <span class="checkbox">
                            <i class="fa-solid fa-check check-icon"></i>
                            </span>
                            <span class="item-text">Bootstrap</span>
                        </li>
                        <li class="item">
                            <span class="checkbox">
                            <i class="fa-solid fa-check check-icon"></i>
                            </span>
                            <span class="item-text">Javascript</span>
                        </li>
                        <li class="item">
                            <span class="checkbox">
                            <i class="fa-solid fa-check check-icon"></i>
                            </span>
                            <span class="item-text">Node.Js</span>
                        </li>
                        <li class="item">
                            <span class="checkbox">
                            <i class="fa-solid fa-check check-icon"></i>
                            </span>
                            <span class="item-text">React.Js</span>
                        </li>
                        <li class="item">
                            <span class="checkbox">
                            <i class="fa-solid fa-check check-icon"></i>
                            </span>
                            <span class="item-text">Mango DB</span>
                        </li>
                        </ul>
                        
                    </div>
                    <div class="line"></div>

                    <div class="bot-buttons">
                        <div class="CancelButton">
                            <a href="account.php" id="cancel">CANCEL</a>
                        </div>
                        <div class="AddButton">
                            <button type="submit" id="adduserBtn" name="add-account">SAVE</button>
                        </div>
                    </div>
            </form>
        </div>
</form>
</div>

</body>
</html>
<script src="../javascript/side-menu-toggle.js"></script>
<script src="../javascript/top-menu-toggle.js"></script>
<script src="../javascript/account-type.js"></script>
<script src="../index.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/d3js/7.6.1/d3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->