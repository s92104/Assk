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
    $article=json_decode($json);
    $author=$article->username;
    $name=$article->name;
    $content=$article->content;
    echo "作者:".$author."<br>文章名稱:".$name."<br>文章內容".$content;
?>