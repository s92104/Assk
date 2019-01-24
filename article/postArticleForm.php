<?php
    include("../Dao.php");
    $dao=initDao();

   if($_GET["board"]==null)
    {
        $dao->getBoard("postArticleForm.php");
        exit();
    }
    $json=$_GET["board"];
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/postArticle.css">
</head>
<div class="title">發文</div>
<div class="form">
    <form action="postArticle.php" method="post">
        <div class="smalltitle">
            看板名稱
        </div>
        <select name="boardname" id="boardname">
            <script>writeSelectBoard('<?=$json?>','boardname');</script>
        </select>
        <div class="smalltitle">
            文章名稱
        </div>            
        <input type="text" name="articlename" id="articlename">       
        <div class="smalltitle">
            文章內容
        </div>
        <textarea name="articlecontent" id="articlecontent"></textarea>

        <input type="submit" id="submit">
    </form>
</div>