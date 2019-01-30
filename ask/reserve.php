<?php
    session_start();
    include("../Dao.php");
    $docId=$_GET["docId"];
    $username=$_SESSION["username"];
    $name=$_POST["name"];
    $detail=str_replace(chr(13).chr(10),"<br>",$_POST["detail"]);
    $hourStart=$_POST["hourStart"];
    $minuteStart=$_POST["minuteStart"];
    $hourEnd=$_POST["hourEnd"];
    $minuteEnd=$_POST["minuteEnd"];
    $date=$_POST["date"];
    $ask=json_encode(array("docId"=>$docId,"username"=>$username,"name"=>$name,"detail"=>$detail,"hourStart"=>$hourStart,"minuteStart"=>$minuteStart,"hourEnd"=>$hourEnd,"minuteEnd"=>$minuteEnd,"date"=>$date));
    
    $dao=initDao();
    $dao->reserve($docId,$ask);
?>