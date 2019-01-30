<?php
    $boardname=$_GET["board"];

    include("../Dao.php");
    $dao=initDao();
    $json=$_GET["articleList"];
    if($json==null)
    {
        $dao->getArticleList($boardname,"articleList.php");
        exit();
    }
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/articleList.css">
</head>
<div id="articlelist">
    <script>writeArticleList(<?=$json?>,"articlelist");</script>
</div>
