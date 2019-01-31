<?php
    include("../Dao.php");
    $dao=initDao();
    $json=$_GET["applytype"];
    if($json==null)
    {
        $dao->getApplyType("applyTypeList.php");
        exit();
    }
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/applyTypeList.css">
</head>
<div class="applytype" id="applytype">

</div>
<script>writeApplyType(<?=$json?>,"applytype");</script>