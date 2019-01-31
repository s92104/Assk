<?php
    $json=$_GET["type"];

    include("../Dao.php");
    $dao=initDao();
    $dao->addType($json);
?>