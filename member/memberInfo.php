<?php
    session_start();
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
    $json=$_GET["member"];
    $member=json_decode($json);
    $password=$member->password;
    $name=$member->name;
    $email=$member->email;
    $phone=$member->phone;
    $address=$member->address;
    $image=$member->image;
    if($image!="")
        $image=$member->image;
    else
        $image="img/noImage.png";
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
                        <td><?=$username?></td>
                    </tr>
                    <tr>
                        <td>密碼</td>
                        <td><?=$password?></td>
                    </tr>
                    <tr>
                        <td>暱稱</td>
                        <td><?=$name?></td>
                    </tr>
                    <tr>
                        <td>電子信箱</td>
                        <td><?=$email?></td>
                    </tr> 
                    <tr>
                        <td>電話</td>
                        <td><?=$phone?></td>
                    </tr> <tr>
                        <td>地址</td>
                        <td><?=$address?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="head">
            大頭貼
            <img src="<?=$image?>">
        </div>                
    </body>
</html>


        
