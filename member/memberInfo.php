<?php
    session_start();
    //沒登入
    if($_SESSION["username"]==null)
    {
        header('Location: login.html');
        exit();
    }
    //有登入
    include("../Dao.php");    
    $dao=initDao();
    $username=$_SESSION["username"];
    //讀取會員資料
    if($_GET["member"]==null)
    {
        $dao->getMember($username,"memberInfo.php");
        exit();
    }
    //解析JSON
    $member=$_GET["member"];
    $id=json_encode(array("username"=>"username","password"=>"password","permission"=>"permission","name"=>"name","email"=>"email","phone"=>"phone","address"=>"address","image"=>"image"));
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/memberInfo.css">
</head>
<html>
    <body>
        <div class="member">    
            <table>
                <tbody>
                    <tr>
                        <td>帳號</td>
                        <td id="username"></td>
                    </tr>
                    <tr>
                        <td>密碼</td>
                        <td id="password"></td>
                    </tr>
                    <tr>
                        <td>權限</td>
                        <td id="permission"></td>
                    </tr>
                    <tr>
                        <td>暱稱</td>
                        <td id="name"></td>
                    </tr>
                    <tr>
                        <td>電子信箱</td>
                        <td id="email"></td>
                    </tr> 
                    <tr>
                        <td>電話</td>
                        <td id="phone"></td>
                    </tr> <tr>
                        <td>地址</td>
                        <td id="address"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="head">
            大頭貼
            <img id="image">
        </div>                
    </body>
</html>
<script>writeMember("<?=$username?>",<?=$member?>,<?=$id?>)</script>


        
