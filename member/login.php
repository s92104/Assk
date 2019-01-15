<?php
    include("../Dao.php");
    $username=$_POST["username"];
    $password=$_POST["password"];
    if($username==null || $password==null)
    {
        exception("請填資料","login.html");
    }
    //資料庫
    $dao=new Firebase();
    $dao->login($username,$password);
?>