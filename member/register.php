<?php
    include("../Dao.php");
    $username=$_POST["username"];
    $password=$_POST["password"];
    $name=$_POST["name"];
    $phone=$_POST["phone"];
    $address=$_POST["address"];
    if($username==null || $password==null)
    {
        exception("請填資料","register.html");
    }
    if($name==null)
        $name="";
    if($phone==null)
        $phone="";
    if($address==null)
        $address="";
    //資料庫   
    $dao=new Firebase();
    $dao->register($username,$password,$name,$phone,$address);
?>