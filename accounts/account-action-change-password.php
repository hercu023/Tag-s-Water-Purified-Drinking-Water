<?php
session_start();
require_once '../service/account-change-password.php';
validate_change_password();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="../CSS/account-action-change-password.css">
    <link href="http://fonts.cdnfonts.com/css/cocogoose" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/phantom-2" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/galhau-display" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/switzer" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/outfit" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/malberg-trial" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
            <h1 class="accTitle">ACCOUNT</h1>
            <div class="sub-tab">
                <div class="user-title">
                    <h2> User Account </h2>
                </div>
                <div class="newUser-button">
                    <button type="submit" id="add-userbutton" class="add-account">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"><path d="M9.25 14h1.5v-3.25H14v-1.5h-3.25V6h-1.5v3.25H6v1.5h3.25Zm.75 4q-1.646 0-3.104-.625-1.458-.625-2.552-1.719t-1.719-2.552Q2 11.646 2 10q0-1.667.625-3.115.625-1.447 1.719-2.541Q5.438 3.25 6.896 2.625T10 2q1.667 0 3.115.625 1.447.625 2.541 1.719 1.094 1.094 1.719 2.541Q18 8.333 18 10q0 1.646-.625 3.104-.625 1.458-1.719 2.552t-2.541 1.719Q11.667 18 10 18Zm0-1.5q2.708 0 4.604-1.896T16.5 10q0-2.708-1.896-4.604T10 3.5q-2.708 0-4.604 1.896T3.5 10q0 2.708 1.896 4.604T10 16.5Zm0-6.5Z"/></svg>
                        <h3>Add New User</h3>
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
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Role</th>
                        <th>Picture</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td></td>
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
    $result = mysqli_query($con, "SELECT * FROM users WHERE user_id='$id'");

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result); ?>
        <form name="cpass" action="" method="post" enctype="multipart/form-data" id="cpassuserFrm">
            <div class="bg-cpassDropdown" id="cpass-bgdrop">
                <div class="container1" id="container1">
                    <h1 class="addnew-title">CHANGE PASSWORD</h1>
                    <form action="#">
                        <?php if (isset($_GET['error'])) { ?>
                            <div class="message"><?php echo $_GET['error']; ?></div>
                        <?php } ?>
                        <p>Create new password that is at least 8 characters long. Mix with numbers and symbols for a strong security.</p>
                        <div class="main-user-info">
                            <input type="hidden" value="<?php echo $id?>" name="id">
                            <div class="user-input-box">
                                <label for="pass">New Password</label>
                                <input type="password" class="newpassword" id="newpass" required="required" name="pass"
                                       placeholder="Create Password"/>
                            </div>
                            <div class="user-input-box">
                                <label for="ecpass">Confirm Password</label>
                                <input type="password" class="confirm-password" id="cpass" required="required" name="confirm_pass"
                                       placeholder="Confirm Password"/>
                            </div>
                            <div class="checker">
                                <input type="checkbox" name="" onclick="myFunctionCP()" >
                                <span>Show password</span>
                            </div>
                            <div class="line"></div>

                            <div class="bot-buttons">
                                <div class="CancelButton">
                                    <a href="../accounts/account.php" id="cancel">CANCEL</a>
                                </div>
                                <div class="AddButton">
                                    <button type="submit" id="cpassuserBtn" name="change-password">SAVE</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </form>
    <?php }} ?>
</body>
<!-- <script src="./index.js"></script> -->
<script src="../javascript/account-action-change-password.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/d3js/7.6.1/d3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/cesiumjs/1.78/Build/Cesium/Cesium.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
</html>

<style>
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


    BODY{
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
        max-width: 550px;
        padding: 28px;
        margin: 0 28px;
        border-radius:  0px 0px 20px 20px;
        background-color: var(--color-white);
        box-shadow: 5px 7px 20px 0px var(--color-shadow-shadow);
        border-top: 10px solid var(--color-solid-gray);
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
        padding: 10px 0;
    }

    .checker {
        /* display: flex; */
        flex-wrap: wrap;
        width: 100%;
        padding-bottom: 15px;
        gap: 5px;
        text-align: right;
        align-items: right;
    }
    .checker span {
        text-decoration: none;
        color: var(--color-solid-gray);
        top: 0;
        font-size: min(max(10px, 1.2vw), 12px);
        font-family: 'Switzer', sans-serif;
    }
    .user-input-box{
        display: flex;
        flex-wrap: wrap;
        width: 48%;
        padding-bottom: 15px;
    }
    .user-input-box .srp{
        position: absolute;
        left: 51%;
        padding: 12px;
        width: 95%;
        pointer-events: none;
        font-weight: 600;
        font-family: 'calibri', sans-serif;
        font-size: .8em;
        margin-top: 1.6rem;
        margin-left: .2rem;
        color: var(--color-solid-gray);
    }
    .user-input-box .cost{
        position: absolute;
        left: 34.65%;
        padding: 12px;
        width: 95%;
        pointer-events: none;
        font-weight: 600;
        font-family: 'calibri', sans-serif;
        font-size: .8em;
        margin-top: 1.6rem;
        margin-left: .2rem;
        color: var(--color-solid-gray);
    }
    /* .user-input-box .sellingprice{
        text-indent: 35px;
    }
    .user-input-box .suppliercost{
        text-indent: 35px;
    } */
    .user-input-box label{
        width: 95%;
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
        width: 95%;
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
        padding-left: 80px;
        padding-right: 80px;
        text-align: center;
        width: 30rem;
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
            display: flex;
            /* justify-content: space-between; */
            width: 100%;
        }

        .main-user-info{
            max-height: 380px;
            overflow: auto;
        }

        .main-user-info::-webkit-scrollbar{
            width: 0;
        }
        .bot-buttons{
            width: 100%;
            align-items: center;
            text-align: center;
            margin-top: 4.3rem;
        }
        .AddButton button:hover{
            background: var(--color-button-hover);
        }
        .CancelButton{
            position: relative;
            margin-top: 3rem;
            padding-top: 2rem;
            /* padding-right: 2rem; */
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
</style>