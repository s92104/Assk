<?php
    session_start();
    $permission=$_SESSION["permission"];
    include("../Dao.php");
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/ask.css">
</head>
<html>
    <body>
        <div class="menu" id="menu">
            <a href="postAskForm.php" id="post" target="ask">刊登諮詢</a>
            <a href="askList.php?type=all" target="ask" id="all">全部</a>
            <a href="askList.php?type=hot" target="ask" id="hot">熱門</a>
            <a href="askList.php?type=trace" target="ask" id="trace">追蹤</a>
            <div class="typecontent">
                <iframe src="type.php" width="100%" frameborder="0" name="type"></iframe>
            </div>
            <a href="applyTypeForm.php">申請種類</a>
            <!-- 管理員 -->
            <?php
                if($permission=="admin")
                    showApplyTypeBtn("menu");
            ?>
        </div>
        <div class="askContent">
            <iframe name="ask" src="askList.php?type=hot" frameborder="0"></iframe>
        </div>
    </body>
</html>