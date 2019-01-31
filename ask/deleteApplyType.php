<?php
    $typename=$_GET["typename"];

    include("../Dao.php");
    $dao=initDao();
    $dao->deleteApplyType($typename);
?>