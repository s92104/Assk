<?php
    $docId=$_GET["docid"];
    $json=$_GET["article"];

    include("../Dao.php");
    $dao=initDao();
    if($json==null)
    {
        $dao->getArticle($docId,"articleContent.php");
        exit();
    }
    
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/articleContent.css">
</head>
<div id="articleContent">
    <script>writeArticle(<?=$json?>,'articleContent')</script>
</div>