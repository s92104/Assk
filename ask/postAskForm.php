<?php
    session_start();
    include("../Dao.php");
    if($_SESSION["username"]==null)
    {
        transferParent("../member/login.html");
        exit();
    }
    
    $dao=initDao();
   if($_GET["type"]==null)
    {
        $dao->getType("postAskForm.php");
        exit();
    }
    $json=$_GET["type"];
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/postAskForm.css">
</head>
<html>
    <body>
        <div class="left">
            <div class="form">
                <form action="postAsk.php" method="POST" id="form">
                    <div class="title">諮商種類</div>
                    <select name="type" id="type">
                        <script>writeSelectType(<?=$json?>,'type');</script>
                    </select> 
                    <div class="title">名稱</div> 
                    <input type="text" id="name" name="name">
                    <div class="title">詳細</div> 
                    <textarea id="detail" name="detail"></textarea>

                    <input type="submit" id="submit">
                </form>
            </div>
        </div>   
        <div class="right">
            <div>
                星期
                <select class="date"></select>
                <!-- 開始 -->
                <select class="hour"></select>:
                <select class="minute"></select>
                <!-- 結束 -->
                <select class="hour"></select>:
                <select class="minute"></select>
                <script>writeTimeOption("date","hour","minute");</script>
                <input type="button" onclick="addTime('time','form','date','hour','minute')" value="新增" id="add"> 
            </div>
            <div class="time" id="time">
                <!-- 動態 -->
            </div>
        </div>
    </body>
</html>