<?php

$sName = "localhost";
$uName = "root";
$password = "";
$db_name = "acc_db";

try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Connection failed: ". $e->getMessage();
}
?>