<?php
    $boardname=$_POST["boardname"];
    //把\n換成<br>
    $boarddetail=str_replace(chr(13).chr(10),"<br>",$_POST["boarddetail"]);
    include("../Dao.php");
    $dao=new Firebase();
    
    $dao->applyBoard($boardname,$boarddetail);
?>