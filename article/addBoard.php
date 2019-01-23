<?php
    $json=$_GET["board"];

    include("../Dao.php");
    $dao=initDao();
    $dao->addBoard($json);
?>