<?php
    $docId=$_GET["docId"];

    include("../Dao.php");
    $dao=initDao();
    if($_GET["ask"]==null)
    {
        $dao->getAsk($docId,"askContent.php");
        exit();
    }
    $json=$_GET["ask"];
    $docId=json_decode($json)->docId;
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/askContent.css">
</head>
<div id="ask" class="ask">
    <script><?php $dao->writeAsk($docId,$json,"ask"); ?></script>
    <a href="reserveForm.php?docId=<?= $docId ?>">預約</a>
</div>
