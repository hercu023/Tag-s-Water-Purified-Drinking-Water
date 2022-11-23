<?php 
session_start();
require "connectionDB.php";
$email = "";
$name = "";
$lastname= "";
$firstname= "";
$middlename= "";
$email= "";
$contactnum= "";

$status = 0;
// $status_customer = 0;

$errors = array();
$response = array( 'status' => 0); 

 // if(isset($_POST['submit'])){
// // if(isset($_POST['submit'])){
if(isset($_POST['itemname']) || isset($_POST['inventorytype']) || isset($_POST['reorder'])
|| isset($_POST['sellingprice']) || isset($_POST['firstname'])
|| isset($_POST['positem']) || isset($_POST['image_item'])){
    
    // $status = 0;
    
    $itemname = $_POST['itemname'];
    $itemname = filter_var($itemname, FILTER_SANITIZE_STRING);
    $reorder = $_POST['reorder'];
    $reorder = filter_var($reorder, FILTER_SANITIZE_STRING);
    $sellingprice = $_POST['sellingprice'];
    $sellingprice = filter_var($sellingprice, FILTER_SANITIZE_STRING);
    $firstname = $_POST['firstname'];
    $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
    $positem = $_POST['positem'];
    $positem = filter_var($positem, FILTER_SANITIZE_STRING);
    $inventorytype = $_POST['inventorytype'];

   
    $image = $_FILES['image_item']['name'];
    $image_tmp_name = $_FILES['image_item']['tmp_name'];
    $image_size = $_FILES['image_item']['size'];
    $image_folder = 'uploaded_image/'.$image;

    $select = $conn->prepare("SELECT * FROM `inventory_item` WHERE item_name = ?");
    $select->execute([$itemname]);
    
    if($select->rowCount() > 0){
        $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Email already exist! ";
        // header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Email already exist.");
    }else{
        if($image_size > 2000000){
            $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Image is too large.";
            // header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Image is too large.");
        }else{
            $insert = mysqli_query($con, "INSERT INTO inventory_item VALUES('','$itemname', '$inventorytype', '$positem', '$reorder', '$sellingprice', '$image','','','$firstname','')");
            // $insert->execute([$lastname, $firstname, $middlename, $email, $pass, $contact, $address, $image]);
            if($insert){
                $response['status'] = 1;
                // $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Registered Successfully!";
                move_uploaded_file($image_tmp_name, $image_folder);
                // header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Registered successfully.");
            }
        }
    }
}

// if(isset($_POST['pass']) || isset($_POST['ecpass']) || isset($_POST['userid'])){
//     // if(isset($_POST['change'])){
//             // $password = $_POST['password'];
//             // $_SESSION['info'] = "";
//          //    $id = $_POST['id'];
//             $userid = $_POST['userid'];
//             $new_pass = mysqli_real_escape_string($con, $_POST['pass']);
//             $confirm_pass = mysqli_real_escape_string($con, $_POST['ecpass']);
//             $select = $conn->prepare("SELECT * FROM `users` WHERE password = ?");
//             $select->execute([$password]);
            
//             // if($select->rowCount() > 0){
//             //     $response['message'] =  "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Create new password";
//             // }else{
 
//                 if (strlen($_POST['pass']) < 8) {
//                  //    $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Use 8 or more characters with a mix of letters, numbers & symbols";
//                     echo "<div class='message' style='display:block'></div>";
//                  //    echo "<div class='bg-cpassDropdown' style='display:block'></div>";
//                  //   $_SESSION['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Use 8 or more characters with a mix of letters, numbers & symbols";
//                     // header("Location: Account-changepass-error1.php");
//                     // header("Location: Account-Action-ChangePassword.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Use 8 or more characters with a mix of letters, numbers & symbols");
//                 } else {
//                     // $id = $_SESSION['id'];
//                     if($new_pass !== $confirm_pass){
//                         echo "<div class='message' style='display:block'> <i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Password don't matched </div>";
//                      // $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Password don't matched";
//                         // header("Location: Account-Password-Changed.php");
//                     // header("Location: Account-Action-ChangePassword.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Use 8 or more characters with a mix of letters, numbers & symbols");
//                     }else{
//                         $encpass = password_hash($new_pass, PASSWORD_BCRYPT);
//                         $run_query = mysqli_query($con, "UPDATE users SET password = '$encpass' WHERE id = '$userid'");
//                      //    $run_query = mysqli_query($con, $update_pass);
//                         if($run_query){
//                             // header("Location: Account-Password-Changed.php");
//                             header("Location: Account-Password-Changed.php");
//                         }else{
 
//                         }
//                     }   
//                 }   
//             }
// if(isset($_POST['customername']) || isset($_POST['address']) || isset($_POST['contactnum']) || isset($_POST['balance']) 
// || isset($_POST['note'])){

// if(isset($_POST['submitCustomer'])){
// // $status = 0;

// $customername = $_POST['customername'];
// $customername = filter_var($customername, FILTER_SANITIZE_STRING);
// $address = $_POST['address'];
// $address = filter_var($address, FILTER_SANITIZE_STRING);
// $contact = $_POST['contactnum'];
// $contact = filter_var($contactnum, FILTER_SANITIZE_STRING);
// $balance = $_POST['balance'];
// $balance = filter_var($balance, FILTER_SANITIZE_STRING);
// $note = $_POST['note'];


// $selects = $conn->prepare("SELECT * FROM `customers` WHERE customer_name = ?");
// $selects->execute([$customername]);

// if($selects->rowCount() > 0){
//     $response_customer['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Customer already exist! ";
//     // header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Email already exist.");
// }else{
//         $inserts = mysqli_query($con, "INSERT INTO customers VALUES('','$customername', '$address', '$contact', '$balance', '$note')");
//         // $insert->execute([$lastname, $firstname, $middlename, $email, $pass, $contact, $address, $image]);
//         if($inserts){
//             $response_customer['status'] = 1;

//         }
//     }
// }

  
 echo json_encode($response); 
?>