<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.8.0/firebase-storage.js"></script>
<script src="../Dao.js"></script>
<?php
    //初始化
    function initDao()
    {
        return new Firebase();
    }
    //警告+轉址
    function exception($message,$link)
    {
        echo "<script>exception('$message','$link');</script>";
    }
    function exceptionParent($message,$link)
    {
        echo "<script>exceptionParent('$message','$link');</script>";
    }
    //父頁框轉址
    function transferParent($link)
    {
        echo "<script>transferParent('$link');</script>";
    }
    //顯示看板請求按鈕
    function showApplyBoardBtn($id)
    {
        echo "<script>showApplyBoardBtn('$id')</script>";
    }
    //顯示諮商請求按鈕
    function showApplyTypeBtn($id)
    {
        echo "<script>showApplyTypeBtn('$id')</script>";
    }   

    abstract class Dao
    {
        abstract function register($json);        
        abstract function login($username,$password);
        abstract function getMember($username,$link);
        abstract function editMember($username,$json);
        abstract function writeUploadFile($username,$file,$image,$progress,$imageUrl);
        abstract function getBoard($link);
        abstract function addBoard($json);
        abstract function applyBoard($json);
        abstract function getApplyBoard($link);
        abstract function deleteApplyBoard($boardname);
        abstract function postArticle($json);
        abstract function getArticleList($boardname,$link);
        abstract function getArticle($docId,$link);
        abstract function postAsk($ask);
        abstract function getAskList($type,$link);
        abstract function getAsk($docId,$link);
        abstract function reserve($docId,$ask);
        abstract function writeAsk($username,$docId,$json,$id);
        abstract function applyType($json);
        abstract function getApplyType($link);
        abstract function deleteApplyType($typename);
        abstract function addType($json);
        abstract function getType($link);
    }

    class Firebase extends Dao
    {        
        //註冊
        function register($json)
        {
            echo "<script>register(".$json.");</script>";
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
            echo "<script>editMember('$username',".$json.");</script>";
        }
        //寫入上傳按鈕
        function writeUploadFile($username,$file,$image,$progress,$imageUrl)
        {
            echo "uploadFileFirebase('$username','$file','$image','$progress','$imageUrl')";
        }
        //讀取看板
        function getBoard($link)
        {
            echo "<script>getBoard('$link');</script>";
        }
        //新增看板
        function addBoard($json)
        {
            echo "<script>addBoard(".$json.");</script>";
        }
        //請求看板
        function applyBoard($json)
        {
            echo "<script>applyBoard(".$json.");</script>";
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
        //發文
        function postArticle($json)
        {
            echo "<script>postArticle(".$json.");</script>";
        }
        //讀取文章
        function getArticleList($boardname,$link)
        {
            echo "<script>getArticleList('$boardname','$link');</script>";
        }
        //讀取文章
        function getArticle($docId,$link)
        {
            echo "<script>getArticle('$docId','$link');</script>";
        }   
        //刊登諮商
        function postAsk($ask)
        {
            echo "<script>postAsk(".$ask.");</script>";
        }    
        //讀取諮商列表
        function getAskList($type,$link)
        {
            echo "<script>getAskList('$type','$link');</script>";
        }
        //讀取諮商
        function getAsk($docId,$link)
        {
            echo "<script>getAsk('$docId','$link');</script>";
        }
        //預約諮商
        function reserve($docId,$ask)
        {
            echo "<script>reserve('$docId',".$ask.");</script>";
        }
        //寫入諮商
        function writeAsk($username,$docId,$json,$id)
        {
            echo "writeAskFirebase('$username','$docId',".$json.",'$id');";
        }
        //請求種類
        function applyType($json)
        {
            echo "<script>applyType(".$json.");</script>";
        }
        //讀取看板請求
        function getApplyType($link)
        {
            echo "<script>getApplyType('$link');</script>";
        }
        //刪除看板請求
        function deleteApplyType($typename)
        {
            echo "<script>deleteApplyType('$typename');</script>";
        }
        //新增種類
        function addType($json)
        {
            echo "<script>addType(".$json.");</script>";
        }     
        //讀取種類
        function getType($link)
        {
            echo "<script>getType('$link');</script>";
        }
    }
?>