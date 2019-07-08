<?php

header('Access-Control-Allow-Origin: *');
header("Content-type: application/json");

require("Connect.php");

$check = $_POST["check"];

if($check == "scan"){

    $sql = "SELECT * FROM account";
    $ps = $conn->query($sql);
    $result = $ps->fetchAll(PDO::FETCH_ASSOC);

    if($result == true){
        header("Content-type: application/json");
        echo json_encode($result);
    }else{
        echo 'null';
    }
    
}

?>