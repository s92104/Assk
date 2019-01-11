<?php
    $username=$_POST["username"];
    $password=$_POST["password"];

    //資料庫
    include("../Dao.php");
    $dao=new Firebase();
    $dao->register($username,$password);
?>