<?php
    session_start();
    //沒登入
    if($_SESSION["username"]==null)
        header('Location: login.html');
?>

<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/member.css">
</head>
<html>
    <body>
        <div class="page">
            <!--選單-->
            <div class="menu">
                <a href="memberInfo.php" target="memberContent">會員資料</a>
                <a href="editForm.php" target="memberContent">修改資料</a>
            </div>
            <!--內容-->
            <iframe name="memberContent" src="memberInfo.php" width="100%" frameborder="0"></iframe>
        </div>      
    </body>
</html>