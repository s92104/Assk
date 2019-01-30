<?php
    session_start();
    if($_SESSION["username"]==null)
        header("Location:../member/login.html");
    include("../Dao.php");
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
                    名稱<br>
                    <input type="text" id="name" name="name"><br>
                    詳細<br>
                    <textarea id="detail" name="detail"></textarea><br>

                    <input type="submit" id="submit">
                </form>
            </div>
        </div>   
        <div class="right">
            <div>
                星期<select class="date"></select>
                <!-- 開始 -->
                <select class="hour"></select>:
                <select class="minute"></select>
                <!-- 結束 -->
                <select class="hour"></select>:
                <select class="minute"></select>
                <script>writeTimeOption("date","hour","minute");</script>
                <input type="button" onclick="addTime('time','form','date','hour','minute')" value="新增" id="add"> 
            </div>
            <div id="time">
                <!-- 動態 -->
            </div>
        </div>
    </body>
</html>