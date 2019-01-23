<?php
    $boardname=$_GET["boardname"];

    include("../Dao.php");
    $dao=initDao();
    $dao->deleteApplyBoard($boardname);
?>