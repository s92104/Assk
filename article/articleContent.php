<?php
    $docId=$_GET["docid"];
    
    include("../Dao.php");
    $dao=initDao();
    if($_GET["article"]==null)
    {
        $dao->getArticle($docId,"articleContent.php");
        exit();
    }
    $json=$_GET["article"];
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/articleContent.css">
</head>
<div id="articleContent">
    <script>writeArticle('<?=$json?>','articleContent')</script>
</div>