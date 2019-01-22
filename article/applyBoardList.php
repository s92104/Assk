<?php
    include("../Dao.php");
    $dao=new Firebase();
    $applyBoard=$_GET["applyboard"];
    if($applyBoard==null)
    {
        $dao->getApplyBoard("applyBoardList.php");
        exit();
    }
?>
<div id="id"></div>
<script>writeApplyBoard('<?=$applyBoard?>',"id");</script>