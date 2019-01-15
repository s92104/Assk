<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-firestore.js"></script>
<script src="../Dao.js"></script>
<?php
    session_start();
    abstract class Dao
    {
        abstract function register($username,$password);        
        abstract function login($username,$password);
        abstract function getMember($username);
    }

    class Firebase extends Dao
    {
        
        //註冊
        function register($username,$password)
        {
            if($username==null || $password==null)
            {
                exception("請填資料","register.html");
            }
            echo "<script>register('$username','$password');</script>";
        }
        //登入
        function login($username,$password)
        {
            if($username==null || $password==null)
            {
                exception("請填資料","login.html");
            }
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