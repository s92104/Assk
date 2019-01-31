<?php
    session_start();
    $username=$_SESSION["username"];
    $permission=$_SESSION["permission"];
    $typename=$_POST["typename"];
    //把\n換成<br>
    $typedetail=str_replace(chr(13).chr(10),"<br>",$_POST["typedetail"]);
    $applyType=array("username"=>$username,"permission"=>$permission,"typename"=>$typename,"typedetail"=>$typedetail);
    $json=json_encode($applyType);

    include("../Dao.php");
    $dao=initDao();
    $dao->applyType($json);
?>