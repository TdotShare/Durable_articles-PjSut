<?php 

require("Connect.php");
$check = $_POST["check"];
//$check = "scan";
//$check = "Add";

if($check == "scan"){

    $uid_barcode = $_POST["id"];
    //$uid_barcode = 999;

    try {
        
    $sql = "SELECT count(*) FROM tempkharuitem WHERE id_kharu = :barcode";
    $ps = $conn->prepare($sql);
    $ps->execute(array("barcode" => $uid_barcode));
    //$result = $ps->fetch(PDO::FETCH_ASSOC);
    $number_of_rows = $ps->fetchColumn(); 
    
    echo $number_of_rows;
    
    }catch (PDOException $e) {
            echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : ".$e->getMessage();
    }
}
?>