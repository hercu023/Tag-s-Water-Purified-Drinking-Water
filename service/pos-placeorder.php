<?php
if (isset($_POST['place-order'])) {
    if(isset($_POST['option'])
    ||(isset($_POST['totalAmount']))){
        header("Location: ../pos/point-of-sales-placeorder.php?option=".$_POST['option'].'&totalAmount=' .$_POST['totalAmount']);
        exit();
    }

}
// header("Location: ../common/error-page.php?error=yes");
//     exit();
?>