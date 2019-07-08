<?php
require("Connect.php");
$id = $_POST["id_kharu"];
$check = $_POST["check"];

if($check == "scan"){
    $sql = "SELECT * FROM imagekharuitem  WHERE kharu_id=:id";
    $ps = $conn->prepare($sql);
    $ps->execute(array("id" => $id));
    $result = $ps->fetch(PDO::FETCH_ASSOC);
    
    if($result == false){
        echo 'Fail_item';
    }else{
        header("Content-type: application/json");
        echo json_encode($result);
    }
}
?>



