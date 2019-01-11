<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-firestore.js"></script>
<script src="../Dao.js"></script>
<?php
    abstract class Dao
    {
        abstract function register($username,$password);        
        abstract function login($username,$password);
    }

    class Firebase extends Dao
    {
        //註冊
        function register($username,$password)
        {
            echo "<script>register($username,$password);</script>";
        }
        //登入
        function login($username,$password)
        {
            echo "<script>login($username,$password);</script>";
        }
    }
?>