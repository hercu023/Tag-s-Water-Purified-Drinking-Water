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
$errors = array();
// $response = array();

// if(isset($_POST['customername']) || isset($_POST['address']) || isset($_POST['contactnum']) || isset($_POST['balance']) 
// || isset($_POST['note'])){

    $response = array( 'status' => 0); 

        if(isset($_POST['user_id']) || isset($_POST['customername']) || isset($_POST['address']) || isset($_POST['contactnum']) || isset($_POST['balance']) 
            || isset($_POST['note'])){
        // if(isset($_POST['customername']) || isset($_POST['address']) || isset($_POST['contactnum']) || isset($_POST['balance']) 
        //     || isset($_POST['note'])){
        // $status = 0;
        $userid = $_POST['user_id'];
        $customername = $_POST['customername'];
        $customername = filter_var($customername, FILTER_SANITIZE_STRING);
        $address = $_POST['address'];
        $address = filter_var($address, FILTER_SANITIZE_STRING);
        $contact = $_POST['contactnum'];
        $contact = filter_var($contact, FILTER_SANITIZE_STRING);
        $balance = $_POST['balance'];
        $balance = filter_var($balance, FILTER_SANITIZE_STRING);
        $note = $_POST['note'];
        
        $selects = $conn->prepare("SELECT * FROM `customers` WHERE customer_name = ?");
        $selects->execute([$customername]);
        
        // if($selects->rowCount() > 0){
        //     $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Customer already exist! ";
        //     // header("Location: Account.php?error=<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Email already exist.");
        // }else{
                // $insert = mysqli_query($con, "INSERT INTO customers VALUES('','$customername', '$address', '$contact', '$note', '$balance','')");
                // // $insert->execute([$lastname, $firstname, $middlename, $email, $pass, $contact, $address, $image]);

                $result =mysqli_query($con, "UPDATE customers SET customer_name='$customername', address='$address', 
                contact_number='$contact', note='$note', balance='$balance' WHERE id='$userid'");
                if($result){
                    // $response['status'] = 1;
                    header("Location: Customer-Updated-Success.php");
                }
            }
        // }

  
 echo json_encode($response); 
?>