<?php
    include("../Dao.php");
    $dao=initDao();
    //讀取看板
    if($_GET["board"]==null)
    {
        $dao->getBoard("board.php");
        exit();
    }
    $json=$_GET["board"];
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/board.css">
</head>
<ul id="board" >
    <script>writeBoard(<?=$json?>,"board");</script>
</ul>
