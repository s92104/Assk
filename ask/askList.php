<?php    
    include("../Dao.php");
    $dao=initDao();
    if($_GET["ask"]==null)
    {
        $dao->getAskList("askList.php");
        exit();
    }
    $json=$_GET["ask"];
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/askList.css">
</head>
<div id="ask" class="ask">
    <script>writeAskList(<?=$json?>,"ask");</script>
</div>
