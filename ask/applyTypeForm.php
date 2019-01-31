<?php
    session_start();
    include("../Dao.php");
    if($_SESSION["username"]==null)
    {
        header("Location:../member/login.html");
        exit();
    }
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/applyType.css">
</head>
<div class="title">申請種類</div>
<div class="form">
    <form action="applyType.php" method="post">
        <div class="smalltitle">
            種類名稱
        </div>
        <input type="text" name="typename" id="typename">
        <div class="smalltitle">
            種類敘述
        </div>
        <textarea name="typedetail" id="typedetail"></textarea>
        
        <input type="submit" id="submit">
    </form>
</div>