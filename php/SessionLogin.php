<?php
session_start();
ob_start();
$result= array();

if(isset($_POST["check"]) == "add"){

    $_SESSION['login'] = $_POST["login"];
    $_SESSION['firstname'] = $_POST["firstname"];
    $_SESSION['surname'] = $_POST["surname"];
    $_SESSION['status'] = $_POST["status"];
    $_SESSION['id'] = $_POST["id"];
    $_SESSION['password'] = $_POST["password"];

}else{

    $logLogin = isset($_SESSION['login']);
    
        if($logLogin == "Success"){
            
            array_push($result,$_SESSION['firstname'],$_SESSION['surname'] , $_SESSION['status'] , $_SESSION['id'] , $_SESSION['password']);
            header("Content-type: application/json");
            echo json_encode($result);
        }else{
            echo 'false';
        }
}
?>