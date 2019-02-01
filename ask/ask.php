<?php
    session_start();
    $permission=$_SESSION["permission"];
    
    include("../Dao.php");
    $dao=initDao();
    $json=$_GET["type"];
    if($json==null)
    {
        $dao->getType("ask.php");
        exit();
    }
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
            <!-- 種類選單 -->
            <div class="typecontent">
                <ul id="type" >
                    <script>writeType(<?=$json?>,"type");</script>
                </ul>
            </div>
            <a href="applyTypeForm.php" id="apply">申請種類</a>
            <!-- 管理員 -->
            <?php
                if($permission=="admin")
                    showApplyTypeBtn("menu");
            ?>
        </div>
        <div class="askContent">
            <iframe name="ask" src="askList.php?type=hot" width="100%" height="100%" frameborder="0"></iframe>
        </div>
    </body>
</html>