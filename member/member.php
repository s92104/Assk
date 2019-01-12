<?php
    session_start();
    //從Dao取得username
    if($_GET["username"]!=null)
        $_SESSION["username"]=$_GET["username"];
    //沒登入
    if($_SESSION["username"]==null)
        header('Location: login.html');
    //有登入
    include("../Dao.php");    
    $dao=new Firebase();
    $username=$_SESSION["username"];
    //讀取會員資料
    $dao->getMember($username);
?>

<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/member.css">
</head>
<html>
    <body>
        <div class="page">
            <div class="member">
                <table>
                    <tbody>
                        <tr>
                            <td>帳號</td>
                            <!--getMember-->
                        </tr>
                        <tr>
                            <td>密碼</td>
                            <!--getMember-->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>      
    </body>
</html>
