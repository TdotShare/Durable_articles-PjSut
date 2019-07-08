<?php
//$dbname = "u242523620_ydt";
//$servername = "localhost";
//$username = "u242523620_rayu";
//$password = "crorag2539";
$dbname = "u242523620_ydt";
$servername = "localhost";
$username = "root";
$password = "";
$options = array (
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);


$log;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password , $options);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
    //$log = 10;
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>