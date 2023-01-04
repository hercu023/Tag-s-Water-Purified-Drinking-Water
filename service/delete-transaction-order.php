<?php
require_once '../database/connection-db.php';
if(isset($_GET['delete-order'])){
    $id=$_GET['delete-order'];
        // header("Location: ../common/error-page.php?error=". $id);
        // exit();
    $query = "DELETE FROM transaction_process WHERE id='$id'";
        $query_run = mysqli_query($con, $query);
        header("Location: ../pos/point-of-sales.php?update");
}

if(isset($_GET['delete-list'])){
    $uuid=$_GET['delete-list'];
      
    $query = "DELETE FROM delivery_list WHERE uuid='$uuid'";
        $query_run = mysqli_query($con, $query);
        header("Location: ../monitoring/monitoring-delivery-pickup.php");
}
// if(isset($_GET['deduct-quantity']) || isset($_POST['sumquantity']) || isset($_POST['add1'])){
//     $id=$_GET['deduct-quantity'];
    
//     $sumquantity = $_POST['sumquantity'];
//     $add1 = $_POST['add1'];
//     // $deductqty = 1;
    
//     // $add = $_POST['add1'] + $_POST['sumquantity'];
//     $query = mysqli_query($con, "UPDATE transaction_process SET quantity='$add1 + $sumquantity' WHERE id='$id'");
//     // $query_run = mysqli_query($con, $query);
//     header("Location: ../pos/point-of-sales.php?update");

// }

?>