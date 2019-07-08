<?php 

require("Connect.php");

$check = $_POST["check"];
//$check = "scan";

if($check == "scan"){

    $user = $_POST["username"];
    $pass = $_POST["password"];
    
    try {
    
    $sql = "SELECT * FROM account WHERE username = :user AND password = :pass";
            
    $ps = $conn->prepare($sql);
    $ps->execute(array("user" => $user , "pass" => $pass));
    $result = $ps->fetch(PDO::FETCH_ASSOC);
    
    if($result == false){
        echo 'Fail_Select';
    }else{
        header("Content-type: application/json");
        echo json_encode($result);
        }     
    } catch (PDOException $e) {
        echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : ".$e->getMessage();
    }
    
    
}else{
    echo 'null user';
}
?>