<?php
    session_start();
    $username=$_SESSION["username"];
    $boardName=$_POST["boardname"];
    $articleName=$_POST["articlename"];
    $articleContent=str_replace(chr(13).chr(10),"<br>",$_POST["articlecontent"]);
    $click=0;
    $time=time();
    $article=array("author"=>$username,"board"=>$boardName,"name"=>$articleName,"content"=>$articleContent,"click"=>$click,"time"=>$time);
    $json=json_encode($article);

    include("../Dao.php");
    $dao=initDao();
    $dao->postArticle($json);
?>