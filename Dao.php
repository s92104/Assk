<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-firestore.js"></script>
<script src="../Dao.js"></script>
<?php
    session_start();
    abstract class Dao
    {
        abstract function register($username,$password,$name,$phone,$address);        
        abstract function login($username,$password);
        abstract function getMember($username);
    }

    class Firebase extends Dao
    {        
        //註冊
        function register($username,$password,$name,$phone,$address)
        {
            echo "<script>register('$username','$password','$name','$phone','$address');</script>";
        }
        //登入
        function login($username,$password)
        {
            echo "<script>login('$username','$password');</script>";
        }
        //會員資料
        function getMember($username)
        {
            echo "<script>getMember('$username');</script>";    
        }
    }

    //警告+轉址
    function exception($message,$link)
    {
        echo "<script>exception('$message','$link');</script>";
    }
?>