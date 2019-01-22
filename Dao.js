// Initialize Firebase
var config = {
    apiKey: "AIzaSyDoVJRV8Dbel4kSqqj2MNgH_yeoXzq3L1M",
    authDomain: "assk-cd176.firebaseapp.com",
    databaseURL: "https://assk-cd176.firebaseio.com",
    projectId: "assk-cd176",
    storageBucket: "assk-cd176.appspot.com",
    messagingSenderId: "21425071919"
};
firebase.initializeApp(config);
// Initialize Cloud Firestore through Firebase
var firestore = firebase.firestore();
// Disable deprecated features
firestore.settings({
  timestampsInSnapshots: true
});

//警告+轉址
function exception(message,link)
{
    alert(message);
    location.href=link;
}

//註冊
function register(json)
{
    var member=JSON.parse(json);
    var username=member.username;
    var password=member.password;
    var name=member.name;
    var email=member.email;
    var phone=member.phone;
    var address=member.address;
    var image=member.image;
    var permission=member.permission;
    //包成Object
    var member={"password":password,"name":name,"email":email,"phone":phone,"address":address,"image":image,"permission":permission};

    var docRef = firestore.collection("user").doc(username);
    docRef.get().then(function(doc){
        if(doc.exists)
            exception("帳號已存在","register.html");
        else
        {
            firestore.collection("user").doc(username).set(member).then(function(){
                exception("註冊成功","login.html");
            });  
        }
    });
}
//登入
function login(username,password)
{
    var docRef = firestore.collection("user").doc(username);
    docRef.get().then(function(doc){
        if(doc.exists)
        {
            //比對密碼
            if(doc.data().password==password)
            {
                var data=doc.data();
                var permission=data.permission;
                exception("登入成功","login.php?username="+username+"&permission="+permission);
            }
            else
                exception("密碼錯誤","login.html");
        }
        else
            exception("帳號不存在","login.html");
    });
}
//會員資料
function getMember(username,link)
{
    firestore.collection("user").doc(username).get().then(function(doc){
        var data=doc.data();
        var password=data.password;
        var name=data.name;
        var email=data.email;
        var phone=data.phone;
        var address=data.address;
        var image=escape(data.image);
        //包成JSON
        var member={"password":password,"name":name,"email":email,"phone":phone,"address":address,"image":image};
        var json=JSON.stringify(member);
        location.href=link+"?member="+json;
    });
}
//修改資料
function editMember(username,json)
{
    var member=JSON.parse(json);
    var password=member.password;
    var name=member.name;
    var email=member.email;
    var phone=member.phone;
    var address=member.address;
    var image=member.image;
    //包成JSON
    var member={"password":password,"name":name,"email":email,"phone":phone,"address":address,"image":image};

    firestore.collection("user").doc(username).update(member).then(function(){
        alert("修改成功");
        getMember(username,"editForm.php");
    });    
}
//上傳圖片
function uploadFile(username,fileId,imageId,progressId,inputId)
{
    var fileButton=document.getElementById(fileId);
    //獲取檔案
    var file=fileButton.files[0];
    if(file==null)
        return;
    var storageRef=firebase.storage().ref(username+"/"+file.name);
    var task = storageRef.put(file);
    var progress=document.getElementById(progressId);
    task.on('state_changed',function(snapshot){
        //顯示進度
        var percentage=(snapshot.bytesTransferred/snapshot.totalBytes)*100;  
        progress.value=percentage;
    },function(error){
        alert("error");
    },function(){ 
        task.snapshot.ref.getDownloadURL().then(function(downloadURL) {
            alert("上傳成功");
            //讀取圖片
            var image=document.getElementById(imageId);
            image.src=downloadURL;   
            //丟給隱藏欄位
            var input=document.getElementById(inputId);
            input.value=downloadURL;
        });
    }); 
}
//讀取看板
function getBoard(link,id)
{
    var board=[];

    firestore.collection("board").get().then(function(querySnapshot){
        querySnapshot.forEach(function(doc){
            board.push(doc.id);
        });
        var json=JSON.stringify(board);
        location.href=link+"?board="+json;
    });
}
//寫入看板
function writeBoard(json,id)
{
    var board=JSON.parse(json);
    var ul=document.getElementById(id);
    for(var i=0;i<board.length;i++)
    {
        var li=document.createElement("li");
        var a=document.createElement("a");
        a.textContent=board[i];
        a.href="articleList.php?board="+board[i];
        a.target="article";
        li.appendChild(a);
        ul.appendChild(li);
    }
}
//新增看板
function addBoard(boardname,boarddetail)
{
    var board={"detail":boarddetail};
    firestore.collection("board").doc(boardname).set(board).then(function(){
        exception("新增成功","article.php");
    });
}
//請求看板
function applyBoard(boardname,boarddetail)
{
    var board={"detail":boarddetail};
    firestore.collection("applyboard").doc(boardname).set(board).then(function(){
        exception("請求成功","article.php");
    });
}
//顯示看板請求按鈕
function showApplyBoardList(id)
{
    var div=document.getElementById(id);
    var a=document.createElement("a");
    a.textContent="看板請求";
    a.href="applyBoardList.php";
    a.target="article";
    div.appendChild(a);
}
//讀取看板請求
function getApplyBoard(link)
{
    var applyBoard=[];
    firestore.collection("applyboard").get().then(function(querySnapshot){
        querySnapshot.forEach(function(doc){
            var board={"name":doc.id,"detail":doc.data().detail};
            applyBoard.push(board);
        });
        var json=JSON.stringify(applyBoard);
        location.href=link+"?applyboard="+json;
    });
}
//寫入看板請求
function writeApplyBoard(json,id)
{
    var div=document.getElementById(id);
    var applyBoard=JSON.parse(json);
    for(var i=0;i<applyBoard.length;i++)
    {
        var name=applyBoard[i].name;
        var detail=applyBoard[i].detail;
        div.innerHTML+=name+":"+detail+"<br>";
    }
}
//讀取文章
function getArticleList(boardname,link)
{
    if(boardname=="hot")
    {
        
    }
    else if(boardname=="all")
    {
        firestore.collection("article").get().then(function(querySnapshot){
            var articleList=[];

             querySnapshot.forEach(function(doc){
                var data=doc.data();
                var name=data.name;
                articleList.push(name);
            });
            var json=JSON.stringify(articleList);
    
            location.href=link+"?articleList="+json;
        });
    }
    else
    {
        firestore.collection("article").where("board","==",boardname).get().then(function(querySnapshot){
            var articleList=[];
            querySnapshot.forEach(function(doc){
                var data=doc.data();
                var name=data.name;
                articleList.push(name);
            });
            var json=JSON.stringify(articleList);
    
            location.href=link+"?articleList="+json;
        });
    }  
}
//寫入文章
function writeArticleList(json,id)
{
    var div=document.getElementById(id);
    var articleList=JSON.parse(json);   
    for(var i=0;i<articleList.length;i++)
    {
        var name=articleList[i];
        div.innerHTML+=name+"<br>";
    }
}