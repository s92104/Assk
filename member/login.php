<?php
    include("../Dao.php");
    $username=$_POST["username"];
    $password=$_POST["password"];
    //資料庫
    $dao=new Firebase();
    $dao->login($username,$password);
?>