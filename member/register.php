<?php
    include("../Dao.php");
    $username=$_POST["username"];
    $password=$_POST["password"];
    $name=$_POST["name"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $address=$_POST["address"];
    if($name==null)
        $name="";
    if($phone==null)
        $phone="";
    if($address==null)
        $address="";
    if($email==null)
        $email="";
    //資料庫   
    $dao=new Firebase();
    $dao->register($username,$password,$name,$phone,$address,$email);
?>