<?php
    session_start();
    include("../Dao.php");
    if($_SESSION["username"]==null)
        transferParent("../member/login.html");
    $docId=$_GET["docId"];
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/reserveForm.css">
</head>
<html>
    <body>
        <div class="form">
            <form action="reserve.php?docId=<?=$docId?>" method="POST" id="form">
                <div class="title">名稱</div> 
                <input type="text" id="name" name="name">
                <div class="title">詳細</div> 
                <textarea id="detail" name="detail"></textarea>
            </form>
            <div class="time">
                星期<select class="date" name="date"></select>
                <!-- 開始 -->
                <select class="hour" name="hourStart"></select>:
                <select class="minute" name="minuteStart"></select>
                <!-- 結束 -->
                <select class="hour" name="hourEnd"></select>:
                <select class="minute" name="minuteEnd"></select>
                <script>writeTimeOption("date","hour","minute");</script>

                <input type="submit" id="submit">
            </div>
        </div>   
        <div class="right">
            <iframe src=<?php echo "askContent.php?docId=".$docId; ?> frameborder="0"></iframe>
        </div>     
    </body>
</html>