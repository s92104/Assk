<?php
    session_start();
    $username=$_SESSION["username"];
    //資料庫
    include("../Dao.php");
    $dao=new Firebase();
    if($_GET["member"]==null)
    {
        $dao->getMember($username,"editForm.php");
        exit();
    }
    //解析JSON
    $json=$_GET["member"];
    $member=json_decode($json);
    $password=$member->password;
    $name=$member->name;
    $email=$member->email;
    $phone=$member->phone;
    $address=$member->address;
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/member.css">
</head>
<div class="editMember">
    <div class="title">修改資料</div>
    <div class="form">
        <form name="editMember" method="post" action="editMember.php">
            帳號<br>
            <input type="text" name="username" disabled="disabled" class="input" value=<?=$username?>><br>
            密碼<br>
            <input type="password" name="password" required class="input" value=<?=$password?>><br>
            暱稱<br>
            <input type="text" name="name" class="input" value=<?=$name?>><br>
            電子信箱<br>
            <input type="email" name="email" class="input" value=<?=$email?>><br>
            電話<br>
            <input type="tel" name="phone" pattern="\d+" class="input" value=<?=$phone?>><br>
            地址<br>
            <input type="text" name="address" class="input" id="address" value=<?=$address?>><br>
            <input type="submit" value="儲存" id="submit"></form>
        </form>
    </div>                  
</div>