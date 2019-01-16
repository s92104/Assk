<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-firestore.js"></script>
<script src="../Dao.js"></script>
<?php
    session_start();
    abstract class Dao
    {
        abstract function register($json);        
        abstract function login($username,$password);
        abstract function getMember($username,$link);
        abstract function editMember($username,$json);
    }

    class Firebase extends Dao
    {        
        //註冊
        function register($json)
        {
            echo "<script>register('$json');</script>";
        }
        //登入
        function login($username,$password)
        {
            echo "<script>login('$username','$password');</script>";
        }
        //會員資料
        function getMember($username,$link)
        {
            echo "<script>getMember('$username','$link');</script>";    
        }
        //修改資料
        function editMember($username,$json)
        {
            echo "<script>editMember('$username','$json');</script>";
        }
    }

    //警告+轉址
    function exception($message,$link)
    {
        echo "<script>exception('$message','$link');</script>";
    }
?>