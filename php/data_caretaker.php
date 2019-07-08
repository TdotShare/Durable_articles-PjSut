<?php 

require("Connect.php");

$check = $_POST["check"];

if($check == "scan"){
    
    $sql = "SELECT * FROM caretaker";
    $ps = $conn->query($sql);
    $result = $ps->fetchAll(PDO::FETCH_ASSOC);
    
    header("Content-type: application/json");
    echo json_encode($result);
}

?>