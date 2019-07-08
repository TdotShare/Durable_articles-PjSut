<?php 

require("Connect.php");
$check = $_POST["check"];
//$check = "scan";
//$check = "Add";

if($check == "scan"){

    $uid_barcode = $_POST["id"];
    //$uid_barcode = "7440-001-01/59/00001-3070000";

    try {

    $sql = "SELECT * FROM maintenance WHERE kharu_id = :barcode";

    $ps = $conn->prepare($sql);
    $ps->execute(array("barcode" => $uid_barcode));
    $result = $ps->fetchAll(PDO::FETCH_ASSOC);

    if($result == false){
        echo 'Fail_item';
    }else{
        header("Content-type: application/json");
        echo json_encode($result);
    } 

    }catch (PDOException $e) {
            echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้ : ".$e->getMessage();
    }
}else if($check == "Add"){
    //echo 'null check';
    
    $defective = $_POST["defective"];
    $informer = $_POST["informer"];
    $result = $_POST["result"];
    $companyfixed = $_POST["companyfixed"];
	$datefixed = $_POST["datefixed"];
	$datermainten = $_POST["datermainten"];
    $datereturn = $_POST["datereturn"];
    $date_latest = date("Y/m/d");
    $kharu_id = $_POST["kharu_id"];
    
    $image;
    
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
        $sql = "INSERT INTO maintenance (
            defective, 
            informer, 
            result,
            companyfixed,
            datefixed,
            datereturn,
            datermainten,
            date_latest ,
            temp ,
            kharu_id,
            image
            ) 
        VALUES (:defective 
        , :informer 
        , :result
        , :companyfixed
        , :datefixed
        , :datereturn
        , :datermainten
        , :date_latest
        , :temp
        , :kharu_id
        , :image)";

    $ps = $conn->prepare($sql);

    $ps->execute(array(
        ":defective" => $defective 
        , ":informer" => $informer
        , ":result" => $result
        , ":companyfixed" => $companyfixed
        , ":datefixed" => $datefixed
        , ":datereturn" => $datereturn
        , ":datermainten" => $datermainten
        , ":date_latest" => $date_latest
        , "temp" => 0
        , ":kharu_id" => $kharu_id
        , ":image" => $image
        ));

    echo "Success";

    }catch (PDOException $e) {
        echo "Fail to Insert + $e";
    }
}else if($check == "Edit"){

    $defective = $_POST["defective"];
    $informer = $_POST["informer"];
    $result = $_POST["result"];
    $companyfixed = $_POST["companyfixed"];
	$datefixed = $_POST["datefixed"];
	$datermainten = $_POST["datermainten"];
    $datereturn = $_POST["datereturn"];
    $date_latest = date("Y/m/d"); 
    //$kharu_id = $_POST["kharu_id"];
    $id = $_POST["id"];
    
    $image;
    
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
        
        $sql = "UPDATE maintenance SET defective=:defective
        ,informer=:informer
        ,result=:result 
        ,companyfixed=:companyfixed
        ,datefixed=:datefixed 
        ,datereturn=:datereturn
        ,datermainten = :datermainten
        ,date_latest = :date_latest
        ,image = :image
        WHERE id = :id";
        
        $ps = $conn->prepare($sql);

        $ps->execute(array(":defective" => $defective 
        , ":informer" => $informer
        , ":result" => $result
        , ":companyfixed" => $companyfixed
        , ":datefixed" => $datefixed
        , ":datereturn" => $datereturn
        , ":datermainten" => $datermainten
        , ":date_latest" => $date_latest
        , ":id" => $id
        , ":image" => $image
    ));

        echo "EditSuss";

    }catch (PDOException $e) {

        echo "Fail_Edit";

    }
}else if($check == "Delete"){
    
    $id = $_POST["id"];
    try{
        
        $sql = "DELETE FROM maintenance WHERE id = :id";
        $ps = $conn->prepare($sql);
        $ps->execute(array(":id" => $id));
        
        echo "DeleteSuss";
        
    }catch (PDOException $e) {

        echo "Fail_Delete";

    }
    
}

?>