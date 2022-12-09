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
?>