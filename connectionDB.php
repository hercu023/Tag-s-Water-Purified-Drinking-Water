<?php
// $db_name = "mysql:host=localhost;dbname=acc_db";
// $username = "root";
// $password = "";

// $conn = new PDO($db_name, $username, $password);


?>
<?php
$sName = "localhost";
$uName = "root";
$password = "";
$db_name = "acc_db";
// $sName = "sql313.epizy.com";
// $uName = "epiz_32835917";
// $password = "eO1IGue7ihE";
// $db_name = "epiz_32835917";

try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Connection failed: ". $e->getMessage();
}
?>
<?php 
$con = mysqli_connect('localhost', 'root', '', 'acc_db');
?>