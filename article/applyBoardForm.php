<?php
    session_start();
    include("../Dao.php");
    if($_SESSION["username"]==null)
    {
        echo "<script>exception('','../member/login.html');</script>";
        exit();
    }
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/applyBoard.css">
</head>
<div class="title">申請看板</div>
<div class="form">
    <form action="applyBoard.php" method="post">
        <div class="smalltitle">
            看板名稱
        </div>
        <input type="text" name="boardname" id="boardname">
        <div class="smalltitle">
            看板敘述
        </div>
        <textarea name="boarddetail" id="boarddetail"></textarea>
        
        <input type="submit" id="submit">
    </form>
</div>