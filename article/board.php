<?php
    include("../Dao.php");
    $dao=new Firebase();
    //讀取看板
    if($_GET["board"]==null)
    {
        $dao->getBoard("board.php","board");
        exit();
    }
    $json=$_GET["board"];
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/board.css">
</head>
<ul id="board" >
    <script>writeBoard('<?=$json?>',"board");</script>
</ul>
