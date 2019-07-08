<?php

require("Connect.php");

$check = $_POST["check"];

if($check == "notemp"){

    $sql = "SELECT * FROM kharuitem";
    $ps = $conn->query($sql);
    $result = $ps->fetchAll(PDO::FETCH_ASSOC);

    if($result == true){
        header("Content-type: application/json");
        echo json_encode($result);
    }else{
        echo 'null';
    }
    
}else if($check == "scan"){

    $sql = "SELECT * FROM tempkharuitem";
    $ps = $conn->query($sql);
    $result = $ps->fetchAll(PDO::FETCH_ASSOC);

    if($result == true){
        header("Content-type: application/json");
        echo json_encode($result);
    }else{
        echo 'null';
    }
    
}else if($check == "add"){

    $id_kharu = $_POST["id_kharu"];
    $asset_type = $_POST["asset_type"];
    $date_strat = $_POST["date_strat"];
    $date_latest = date("Y/m/d");
	$brand = $_POST["brand"];
    $serial_number = $_POST["sn"];
    $price = $_POST["price"];
    $order_number = $_POST["order"];
    $room = $_POST["room"];
    $status = $_POST["status"];
    $note = $_POST["note"];
    $temp = 0;
    $account_number = $_POST["user"];
    $image = $_POST["image"];
    $caretaker = $_POST["caretaker"];

        $sql = "INSERT INTO kharuitem (
            id_kharu , 
            asset_type , 
            date_start ,
            date_latest ,
            brand ,
            serial_number ,
            price,
            order_number,
            room ,
            status ,
            note ,
            temp ,
            account_number,
            image,
            caretaker) 
        VALUES (:id_kharu 
        , :asset_type 
        , :date_start
        , :date_latest
        , :brand
        , :serial_number
        , :price
        , :order_number
        , :room
        , :status
        , :note
        , :temp
        , :account_number
        , :image
        , :caretaker)";

        $ps = $conn->prepare($sql);

        $ps->execute(array(":id_kharu" => $id_kharu 
        , ":asset_type" => $asset_type
        , ":date_start" => $date_strat
        , ":date_latest" => $date_latest
        , ":brand" => $brand
        , ":serial_number" => $serial_number
        , ":price" => $price
        , ":order_number" => $order_number
        , ":room" => $room
        , ":status" => $status
        , ":note" => $note
        , ":temp" => $temp
        , ":account_number" => $account_number
        , ":image" => $image
        , ":caretaker" =>$caretaker
    ));

    $sql = "DELETE FROM tempkharuitem WHERE id_kharu = :id";
    $ps = $conn->prepare($sql);
    $ps->execute(array(":id" => $id_kharu));

    echo "Suss";

}else if($check == "scanwhere"){

    $id_kharu = $_POST["Idkharu"];
    $asset_type = $_POST["AssetTyp"];
    $ScanDate = $_POST["ScanDate"];
    $Caretaker = $_POST["Caretaker"];

    $sql = "SELECT * FROM kharuitem WHERE id_kharu LIKE '%$id_kharu%' 
    AND asset_type LIKE '%$asset_type%'
    AND date_start LIKE '%$ScanDate%'
    AND caretaker LIKE '%$Caretaker%'";
    $ps = $conn->query($sql);
    $result = $ps->fetchAll(PDO::FETCH_ASSOC);
    header("Content-type: application/json");
    echo json_encode($result);


}else if($check == "scanwhere2"){

    $id_kharu = $_POST["Idkharu"];
    $asset_type = $_POST["AssetTyp"];
    $ScanDate = $_POST["ScanDate"];
    $Caretaker = $_POST["Caretaker"];
    $ScanSave = $_POST["ScanSave"];

    $sql = "SELECT * FROM tempkharuitem WHERE id_kharu LIKE '%$id_kharu%' 
    AND asset_type LIKE '%$asset_type%'
    AND date_start LIKE '%$ScanDate%'
    AND caretaker LIKE '%$Caretaker%'
    AND account_number LIKE '%$ScanSave%'";
    $ps = $conn->query($sql);
    $result = $ps->fetchAll(PDO::FETCH_ASSOC);
    header("Content-type: application/json");
    echo json_encode($result);


}

?>