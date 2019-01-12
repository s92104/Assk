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
    $member=$_GET["member"];
    if($member==null)
        $dao->getMember($username);
    $password=$_GET["password"];
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
                    <tr>
                        <td>帳號</td>
                        <td>密碼</td>
                    </tr>
                    <tr>
                        <td><?php echo $username ?></td>
                        <td><?php echo $password ?></td>
                    </tr>
                </table>
            </div>
        </div>      
    </body>
</html>
