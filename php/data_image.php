<?php 

require("Connect.php");
$check = $_POST["check"];

if($check == "Add"){ 

//$idku = "7440-001-01/59/00001-3070000";
$idku = $_POST["id_kharu"];
$image = $_FILES['image']['name']; 
$folder ="uploads/"; 
$path = $folder . $image ; 
$target_file=$folder.basename($_FILES["image"]["name"]);
$imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
$allowed=array('jpeg','png' ,'jpg'); $filename=$_FILES['image']['name']; 
$ext=pathinfo($filename, PATHINFO_EXTENSION);

    if(!in_array($ext,$allowed)) 
    { 
        echo "Sorry, only JPG, JPEG, PNG & GIF  files are allowed.";
    }
    else{ 
        
        move_uploaded_file( $_FILES['image'] ['tmp_name'], $path);
        $sql = "INSERT into imagekharuitem (image , kharu_id)values('$image' , '$idku' )";
        $ps = $conn->prepare($sql);
        $ps->execute();
        
        echo 'InsertSuccess';
    } 
}
else if($check == "Update"){
    $idku = $_POST["id_kharu"];
    $image = $_FILES['image']['name']; 
    $folder ="uploads/"; 
    $path = $folder . $image ; 
    $target_file=$folder.basename($_FILES["image"]["name"]);
    $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
    $allowed=array('jpeg','png' ,'jpg'); $filename=$_FILES['image']['name']; 
    $ext=pathinfo($filename, PATHINFO_EXTENSION);

    if(!in_array($ext,$allowed)) 
    { 
        echo "Sorry, only JPG, JPEG, PNG & GIF  files are allowed.";
    }
    else{ 
        move_uploaded_file( $_FILES['image'] ['tmp_name'],"../". $path);
        
        $sql = "UPDATE imagekharuitem SET image='$image' WHERE kharu_id='$idku' ";
        $ps = $conn->prepare($sql);
        $ps->execute();
        
        echo 'UpdateSuccess';
    } 
} 
?>