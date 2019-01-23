<?php
    include("../Dao.php");
    $dao=initDao();
    $applyBoard=$_GET["applyboard"];
    if($applyBoard==null)
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

</div>
<script>writeApplyBoard('<?=$applyBoard?>',"applyboard");</script>