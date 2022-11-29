<?php
require "../database/connection-db.php";

$response = array();
if(isset($_POST['update-account'])) {
    if (isset($_POST['user_id'])
        || isset($_POST['lastname'])
        || isset($_POST['firstname'])
        || isset($_POST['middlename'])
        || isset($_POST['contactnum'])
        || isset($_POST['usertypes'])
        || isset($_FILES['profileimage']['name']) && ($_FILES['profileimage']['name'] != "")) {

        $userid = $_POST['user_id'];

        $lastname = $_POST['lastname'];
        $lastname = filter_var($lastname, FILTER_SANITIZE_STRING);

        $firstname = $_POST['firstname'];
        $firstname = filter_var($firstname, FILTER_SANITIZE_STRING);

        $middlename = $_POST['middlename'];
        $middlename = filter_var($middlename, FILTER_SANITIZE_STRING);

        $contact = $_POST['contactnum'];
        $contact = filter_var($contact, FILTER_SANITIZE_STRING);

        $usertype = $_POST['usertypes'];

        $old_image = $_POST['old_image'];
        $image = $_FILES['profileimage']['name'];
        $image_tmp_name = $_FILES['profileimage']['tmp_name'];
        $image_size = $_FILES['profileimage']['size'];
        $image_type = $_FILES['profileimage']['type'];

        $check_user_type = "SELECT * FROM account_type WHERE user_type = '$usertype'";
        $code_result = mysqli_query($con, $check_user_type);

        if (mysqli_num_rows($code_result) > 0) {

            $fetch_data = mysqli_fetch_assoc($code_result);
            $fetch_user_type_id = $fetch_data['id'];

            $result = mysqli_query($con, "UPDATE users SET 
                 last_name='$lastname', 
                 first_name='$firstname', 
                 middle_name='$middlename', 
                 contact_number='$contact',
                 profile_image ='$image',
                 account_type_id = '$fetch_user_type_id'
             WHERE user_id=$userid");

            if ($result) {
                move_uploaded_file($image_tmp_name, "../uploaded_image/$image");
                header("Location: ../accounts/account-success.php?success=Update Account Successful!");
            }
        } else {
            header("Location: ../common/error-page.php?error=" . mysqli_error($con));
        }
    }
}
echo json_encode($response);