<?php
    include("../Dao.php");
    $dao=initDao();
    //讀取看板
    if($_GET["type"]==null)
    {
        $dao->getType("type.php");
        exit();
    }
    $json=$_GET["type"];
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/type.css">
</head>
<ul id="type" >
    <script>writeType(<?=$json?>,"type");</script>
</ul>
