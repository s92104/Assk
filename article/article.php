<!DOCTYPE html>
<?php
    session_start();
    $permission=$_SESSION["permission"];
    include("../Dao.php");
    $dao=initDao();
    //讀取看板
    $json=$_GET["board"];
    if($json==null)
    {
        $dao->getBoard("article.php");
        exit();
    }  
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/article.css">
</head>
<html>
    <body>
        <div class="page">
            <div class="board" id="board">
                <div class="boardcontent">
                    <ul id="boardcontent" >
                        <script>writeBoard(<?=$json?>,"boardcontent");</script>
                    </ul>
                </div>
                <a href="applyBoardForm.php" id="apply">申請看板</a>
                <!-- 管理員 -->
                <?php
                    if($permission=="admin")
                        showApplyBoardBtn("board");
                ?>
            </div>
            <div class="article">
                <div class="menu">
                    <a href="articleList.php?board=hot" target="article">熱門</a>
                    <a href="articleList.php?board=all" target="article">全部</a>
                    <a href="articleList.php?board=trace" target="article">追蹤</a>
                    <a href="postArticleForm.php" target="article" id="post">發文</a>
                </div>
                <div class="articlecontent">
                    <iframe src="articleList.php?board=hot" width="100%" height="100%" frameborder="0" name="article">article</iframe>
                </div>
            </div>
            <div class="image">
                <img src="img/1.png" alt="">
                <img src="img/2.jpg" alt="">
                <img src="img/3.jpg" alt="">
            </div>
        </div>
    </body>
</html>