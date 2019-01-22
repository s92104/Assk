<?php
    $boardname=$_GET["board"];

    include("../Dao.php");
    $dao=new Firebase();
    $json=$_GET["articleList"];
    if($json==null)
    {
        $dao->getArticleList($boardname,"articleList.php");
        exit();
    }
?>
<div id="a">
    <script>writeArticleList('<?=$json?>',"a");</script>
</div>
