<?php
    session_start();
    //有登入
    include("../Dao.php");    
    $dao=new Firebase();
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
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/member.css">
</head>
<div class="member">    
    <table>
        <tbody>
            <tr>
                <td>帳號</td>
                <td><?php echo $username; ?></td>
            </tr>
            <tr>
                <td>密碼</td>
                <td><?php echo $password; ?></td>
            </tr>
            <tr>
                <td>暱稱</td>
                <td><?php echo $name; ?></td>
            </tr>
            <tr>
                <td>電子信箱</td>
                <td><?php echo $email; ?></td>
            </tr> 
            <tr>
                <td>電話</td>
                <td><?php echo $phone; ?></td>
            </tr> <tr>
                <td>地址</td>
                <td><?php echo $address; ?></td>
            </tr>
        </tbody>
     </table>
</div>

        
