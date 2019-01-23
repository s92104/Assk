<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.8.0/firebase-storage.js"></script>
<script src="../Dao.js"></script>
<?php
    session_start();
    //初始化
    function initDao()
    {
        return new Firebase();
    }

    abstract class Dao
    {
        abstract function register($json);        
        abstract function login($username,$password);
        abstract function getMember($username,$link);
        abstract function editMember($username,$json);
        abstract function getBoard($link,$id);
        abstract function addBoard($json);
        abstract function applyBoard($json);
        abstract function getApplyBoard($link);
        abstract function deleteApplyBoard($boardname);
        abstract function getArticleList($boardname,$link);
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
        //讀取看板
        function getBoard($link,$id)
        {
            echo "<script>getBoard('$link','$id');</script>";
        }
        //新增看板
        function addBoard($json)
        {
            echo "<script>addBoard('$json');</script>";
        }
        //請求看板
        function applyBoard($json)
        {
            echo "<script>applyBoard('$json');</script>";
        }
        //讀取看板請求
        function getApplyBoard($link)
        {
            echo "<script>getApplyBoard('$link');</script>";
        }
        //刪除看板請求
        function deleteApplyBoard($boardname)
        {
            echo "<script>deleteApplyBoard('$boardname');</script>";
        }
        //讀取文章
        function getArticleList($boardname,$link)
        {
            echo "<script>getArticleList('$boardname','$link');</script>";
        }
    }
?>