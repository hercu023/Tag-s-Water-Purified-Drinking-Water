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
$ids = $_GET['edit'];
// $ids = $_GET['delete'];
$sql="Select * From users WHERE id=$ids";
$results=mysqli_query($con,$sql);
$rows = mysqli_fetch_assoc($results);
$lastname=$rows['last_name'];
$firstname=$rows['first_name'];
 $middlename=$rows['middle_name']; 
 $email=$rows['email']; 
 $contact=$rows['contact_number']; 
 $usertype=$rows['user_type']; 
 $image=$rows['profile_image'];
 
 
// if(isset($_POST['delete'])){
//     $sql = "DELETE from `users` WHERE  id=$id";
//     $results =mysqli_query($con,$sql);
//     if($results){

//     }
// }
if(isset($_POST['edit'])){

    $lastname = $_POST['lastname'];
    $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
    $firstname = $_POST['firstname'];
    $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
    $middlename = $_POST['middlename'];
    $middlename = filter_var($middlename, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $contact = $_POST['contactnum'];
    $contact = filter_var($contact, FILTER_SANITIZE_STRING);
    $usertype = $_POST['usertypes'];

    $sql ="UPDATE users SET last_name='$lastname', first_name='$firstname', middle_name='$middlename', email='$email', contact_num='$contact', user_type='$usertype'
    WHERE id=$id";
    $results =mysqli_query($con,$sql);
    if($results){
        header('location:Account.php');
        $response['status'] = 1;
    }
    else{
        die(mysqli_error($con));
        $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Database error.";
    }

    $old_image = $_POST['old_image'];
    $image = $_FILES['profile_image']['last_name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['profile_image']['size'];
    $image_folder = 'uploaded_image/'.$image;
 
    if(!empty($image)){

        if($image_size > 2000000){
            $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i>image size is too large";
        }else{
        $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
        $update_image->execute([$image, $user_id]);

            if($update_image){
                move_uploaded_file($image_tmp_name, $image_folder);
                unlink('uploaded_image/'.$old_image);
                $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Image updated! ";
            }
        }
}
}
// $id = $_GET['id'];
// $user_id = $_SESSION['user_id'];
// if(isset($_POST['update'])){

//     $lastname = $_POST['lastname'];
//     $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
//     $firstname = $_POST['firstname'];
//     $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
//     $middlename = $_POST['middlename'];
//     $middlename = filter_var($middlename, FILTER_SANITIZE_STRING);
//     $email = $_POST['email'];
//     $email = filter_var($email, FILTER_SANITIZE_STRING);
//     $contact = $_POST['contactnum'];
//     $contact = filter_var($contact, FILTER_SANITIZE_STRING);
//     $usertype = $_POST['usertypes'];

//     $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
//     $update_profile->execute([$lastname, $firstname, $middlename, $email, $contact, $usertype, $image, $user_id]);
 
//     $old_image = $_POST['old_image'];
//     $image = $_FILES['image']['name'];
//     $image_tmp_name = $_FILES['image']['tmp_name'];
//     $image_size = $_FILES['image']['size'];
//     $image_folder = 'uploaded_image/'.$image;
    
    
    // if(!empty($image)){

    //     if($image_size > 2000000){
    //         $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i>image size is too large";
    //     }else{
    //     $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
    //     $update_image->execute([$image, $user_id]);

    //         if($update_image){
    //             move_uploaded_file($image_tmp_name, $image_folder);
    //             unlink('uploaded_image/'.$old_image);
    //             $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Image updated! ";
    //         }
    //     }

    //  }
    //     $sql = "UPDATE users SET last_name ='$lastname', first_name ='$firstname', middle_name ='$middlename', email ='$email',
    //     contact_number ='$contact', user_type ='$usertype', profile_image ='$image' WHERE id=$id";

    //     $result = mysqli_query($conn, $sql);

    //     if($result){
    //         $response['message'] = "<i class='fas fa-exclamation-triangle' style='font-size:14px'></i> Record Updated";
    //     }
//         }
// }
//  if(isset($_GET['edit'])){
//     $id = $_GET['edit'];
//     $result = $mysqli->query("SELECT * FROM users WHERE id=$id") or die(mysqli->error());
//     if (count($result)==1){
//         $row = $result->fetch_array();
//         $email = $row['email'];
//         $lastname= $row['last_name'];
//         $firstname= $row['first_name'];
//         $middlename= $row['middle_name'];
//         $contactnum= $row['contact_number'];
//     }
// }
 // if(isset($_POST['submit'])){
if(isset($_POST['login-now'])){
    header('Location: login.php');
}
$response = array(); 

echo json_encode($response); 
?>