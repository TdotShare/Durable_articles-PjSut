<?php 
require("Connect.php");
$check = $_POST["check"];
//$check = "scan";
//$check = "Add";

if($check == "scan"){

    $uid_barcode = $_POST["id"];
    //$uid_barcode = '7440-001-01/59/00001-3070000';

    try {
    $sql = "SELECT MAX(id) as id FROM tempkharuitem WHERE id_kharu = :id";
    $ps = $conn->prepare($sql);
    $ps->execute(array("id" => $uid_barcode));
    
    while($row = $ps->fetch()) {
			$setid = $row['id'];
    }
    
    $sql = "SELECT * FROM tempkharuitem WHERE id_kharu = :id AND id=:setid";
    $ps = $conn->prepare($sql);
    $ps->execute(array("id" => $uid_barcode , "setid" => $setid));
    $result = $ps->fetch(PDO::FETCH_ASSOC);
    
    if($result == false){
        
        $sql = "SELECT * FROM kharuitem WHERE id_kharu = :id";
        $ps = $conn->prepare($sql);
        $ps->execute(array("id" => $uid_barcode));
        $result = $ps->fetch(PDO::FETCH_ASSOC);
        
        if($result == false){
            
            echo 'Fail_item';
            
        }else{
            
            header("Content-type: application/json");
           echo json_encode($result);
        }
        
    }else{
        
        header("Content-type: application/json");
        echo json_encode($result);
        
    }
    
    }catch (PDOException $e) {
            echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : ".$e->getMessage();
    }
    
}else if($check == "Add"){
    
    $No_Image = 0;
    
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
    $temp = 1;
    $account_number = $_POST["user"];
    $image;
    
    $caretaker = $_POST["caretaker"];
    
    $path;
    $folderImage ="uploads/";
    
    if (!empty($_FILES["image"]['name']))
    {
        $image = $_FILES["image"]['name'];
        $path =  $folderImage . $image;
        $allowed=array('jpeg','png' ,'jpg');
        $ext=pathinfo($image, PATHINFO_EXTENSION); 

        if(in_array($ext,$allowed)){

            move_uploaded_file($_FILES['image'] ['tmp_name'] ,"../".$path);

        }else{
            echo 'ErrorIMAGE';
            return;
        }

    }else{

        $No_Image = 1;
        $image = 'null';

    }
    
    try{
        
        $sql = "INSERT INTO tempkharuitem (
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
        , ":caretaker" => $caretaker
    ));

    echo "Success";

    }catch (PDOException $e) {
        echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : ".$e->getMessage();
    }
}
?>