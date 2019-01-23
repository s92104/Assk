<?php
    session_start();
    $username=$_SESSION["username"];
    $permission=$_SESSION["permission"];
    $boardname=$_POST["boardname"];
    //把\n換成<br>
    $boarddetail=str_replace(chr(13).chr(10),"<br>",$_POST["boarddetail"]);
    $applyBoard=array("username"=>$username,"permission"=>$permission,"boardname"=>$boardname,"boarddetail"=>$boarddetail);
    $json=json_encode($applyBoard);

    include("../Dao.php");
    $dao=initDao();
    $dao->applyBoard($json);
?>