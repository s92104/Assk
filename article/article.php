<?php
    $boardname=$_GET["board"];
    include("../Dao.php");
    $dao=new Firebase();
    $json="";
    if($boardname!="hot")
    {
        $article=$_GET["article"];
        if($article==null)
        {
            $dao->getArticle($boardname,"article.php");
            exit();
        }
        $json=$_GET["article"];
    }
?>
<div id="a">
    <script>writeArticle('<?=$json?>',"a");</script>
</div>
