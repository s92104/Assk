<?php
    include("../Dao.php");
    $dao=initDao();
    $json=$_GET["applyboard"];
    if($json==null)
    {
        $dao->getApplyBoard("applyBoardList.php");
        exit();
    }
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/applyBoardList.css">
</head>
<div class="applyboard" id="applyboard">
    <script>writeApplyBoard(<?=$json?>,"applyboard");</script>
</div>
