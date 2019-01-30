<?php
    session_start();
    $username=$_SESSION["username"];
    //資料庫
    include("../Dao.php");
    $dao=initDao();
    if($_GET["member"]==null)
    {
        $dao->getMember($username,"editForm.php");
        exit();
    }
    //解析JSON
    $member=$_GET["member"];
    $id=json_encode(array("username"=>"username","password"=>"password","name"=>"name","email"=>"email","phone"=>"phone","address"=>"address","imageUrl"=>"imageUrl","image"=>"image"));
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/editForm.css">
</head>

<div class="editMember">
    <div class="title">修改資料</div>
    <div class="form">
        <form name="editMember" method="post" action="editMember.php">
            帳號<br>
            <input type="text" name="username" disabled="disabled" class="input" id="username"><br>
            密碼<br>
            <input type="password" name="password" required class="input" id="password"><br>
            暱稱<br>
            <input type="text" name="name" class="input" id="name"><br>
            電子信箱<br>
            <input type="email" name="email" class="input" id="email"><br>
            電話<br>
            <input type="tel" name="phone" pattern="\d+" class="input" id="phone"><br>
            地址<br>
            <input type="text" name="address" class="input" id="address"><br>
            <!-- 隱藏欄位 -->
            <input type="hidden" name="image" id="imageUrl">

            <input type="submit" value="儲存" id="submit">
        </form>
        <div class="image">
            大頭貼<br>
            <img id="image">
            <input type="file" id="file"><br>
            <input type="button" onclick=<?php $dao->writeUploadFile($username,"file","image","progress","imageUrl"); ?> value="上傳">
            <progress value="0" max="100" id="progress">0%</progress>
        </div>
    </div>                                
</div>
<script>writeEditMember("<?=$username?>",<?=$member?>,<?=$id?>);</script>
