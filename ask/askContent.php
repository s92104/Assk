<?php
    session_start();
    $username=$_SESSION["username"];
    $docId=$_GET["docId"];
    
    include("../Dao.php");
    $dao=initDao();
    $json=$_GET["ask"];
    if($json==null)
    {
        $dao->getAsk($docId,"askContent.php");
        exit();
    }
    
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/askContent.css">
</head>
<div id="ask" class="ask">
    <script><?php $dao->writeAsk($username,$docId,$json,"ask"); ?></script>
    <a href="reserveForm.php?docId=<?= $docId ?>">預約</a>
</div>
