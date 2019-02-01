<?php    
    $type=$_GET["type"];

    include("../Dao.php");
    $dao=initDao();
    $json=$_GET["ask"];
    if($json==null)
    {
        $dao->getAskList($type,"askList.php");
        exit();
    }
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/askList.css">
</head>
<div id="ask" class="ask">
    <script>writeAskList(<?=$json?>,"ask");</script>
</div>
