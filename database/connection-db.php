<?php

$hostName = "localhost";
$userName = "root";
$password = "";
$db_name = "acc_db";

try {
    $conn = new PDO("mysql:host=$hostName;dbname=$db_name", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);

} catch (PDOException $e){
    echo "Connection failed: ". $e->getMessage();
}

$con = mysqli_connect($hostName, $userName, $password, $db_name);

