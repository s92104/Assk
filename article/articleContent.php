<?php
    $docId=$_GET["docid"];

    include("../Dao.php");
    $dao=initDao();
    $json=$_GET["article"];
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