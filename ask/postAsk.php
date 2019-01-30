<?php
    session_start();
    $username=$_SESSION["username"];
    $name=$_POST["name"];
    $detail=str_replace(chr(13).chr(10),"<br>",$_POST["detail"]);
    $hourStart=$_POST["hourStart"];
    $minuteStart=$_POST["minuteStart"];
    $hourEnd=$_POST["hourEnd"];
    $minuteEnd=$_POST["minuteEnd"];
    $date=$_POST["date"];
    $ask=json_encode(array("username"=>$username,"name"=>$name,"detail"=>$detail,"hourStart"=>$hourStart,"minuteStart"=>$minuteStart,"hourEnd"=>$hourEnd,"minuteEnd"=>$minuteEnd,"date"=>$date));

    include("../Dao.php");
    $dao=initDao();
    $dao->postAsk($ask);
?>