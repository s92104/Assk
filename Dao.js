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
function exceptionParent(message,link)
{
    alert(message);
    parent.location.href=link;
}
//轉址
function transferParent(link)
{
    parent.location.href=link;
}

//----------Member----------
//註冊
function register(json)
{
    var member=json;
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
        var permission=data.permission;
        //包成JSON
        var member={"password":password,"name":name,"email":email,"phone":phone,"address":address,"image":image,"permission":permission};
        var json=JSON.stringify(member);
        location.href=link+"?member="+json;
    });
}
//寫入會員資料
function writeMember(username,member,id)
{
    document.getElementById(id.username).textContent=username;
    document.getElementById(id.password).textContent=member.password;
    document.getElementById(id.permission).textContent=member.permission;
    document.getElementById(id.name).textContent=member.name;
    document.getElementById(id.email).textContent=member.email;
    document.getElementById(id.phone).textContent=member.phone;
    document.getElementById(id.address).textContent=member.address;
    if(member.image!="")
        document.getElementById(id.image).src=member.image;
    else
        document.getElementById(id.image).src="img/noImage.png";
}
//修改資料
function editMember(username,json)
{
    var member=json;
    var password=member.password;
    var name=member.name;
    var email=member.email;
    var phone=member.phone;
    var address=member.address;
    var image=member.image;
    //包成Object
    var member={"password":password,"name":name,"email":email,"phone":phone,"address":address,"image":image};

    firestore.collection("user").doc(username).update(member).then(function(){
        alert("修改成功");
        getMember(username,"editForm.php");
    });    
}
//寫入修改資料
function writeEditMember(username,member,id)
{
    document.getElementById(id.username).value=username;
    document.getElementById(id.password).value=member.password;
    document.getElementById(id.name).value=member.name;
    document.getElementById(id.email).value=member.email;
    document.getElementById(id.phone).value=member.phone;
    document.getElementById(id.address).value=member.address;
    document.getElementById(id.imageUrl).value=member.image;
    if(member.image!="")
        document.getElementById(id.image).src=member.image;
    else
        document.getElementById(id.image).src="img/noImage.png";
}
//上傳圖片
function uploadFileFirebase(username,fileId,imageId,progressId,inputId)
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
//----------Article----------
//讀取看板
function getBoard(link)
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
    var board=json;
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
function addBoard(json)
{
    var applyBoard=json;
    var username=applyBoard["username"];
    var permission=applyBoard["permission"];
    var boardname=applyBoard["boardname"];
    var boarddetail=applyBoard["boarddetail"];
    //版主資料
    var mod=[];
    if(permission=="user")
    {
        mod.push(username);
    }
    var board={"moderator":mod,"detail":boarddetail,"announcement":""};

    firestore.collection("board").doc(boardname).set(board).then(function(){
        //刷新Board
        parent.board.location.href="board.php";
        firestore.collection("applyboard").doc(boardname).delete().then(function(){
            //給版主
            if(permission=="user")
            {
                firestore.collection("user").doc(username).update({"permission":boardname}).then(function(){
                    exception("新增成功","applyBoardList.php");
                });
            }
            else
                exception("新增成功","applyBoardList.php");
        });   
    });
}
//請求看板
function applyBoard(json)
{
    var applyBoard=json;
    var username=applyBoard.username;
    var permission=applyBoard.permission;
    var boardname=applyBoard.boardname;
    var boarddetail=applyBoard.boarddetail;

    var board={"username":username,"permission":permission,"detail":boarddetail};
    firestore.collection("applyboard").doc(boardname).set(board).then(function(){
        exception("請求成功","article.php");
    });
}
//顯示看板請求按鈕
function showApplyBoardBtn(id)
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
            var data=doc.data();
            var username=data.username;
            var permission=data.permission;
            var boardname=doc.id;
            var boarddetail=data.detail;
            var board={"username":username,"permission":permission,"boardname":boardname,"boarddetail":boarddetail};
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
    var applyBoard=json;
    for(var i=0;i<applyBoard.length;i++)
    {
        var boardname=applyBoard[i].boardname;
        var boarddetail=applyBoard[i].boarddetail;
        var board=JSON.stringify(applyBoard[i]);

        //boardname
        var name=document.createElement("div");
        name.className="boardname";
        //content
        var content=document.createElement("div");
        content.className="content";
        content.textContent=boardname;
        name.appendChild(content);
        //add
        var add=document.createElement("a");
        add.className="add";
        add.textContent="新增";
        add.href="addBoard.php?board="+board;
        name.appendChild(add);
        //delete
        var del=document.createElement("a");
        del.className="delete";
        del.textContent="刪除";
        del.href="deleteApplyBoard.php?boardname="+boardname;
        name.appendChild(del);
        div.appendChild(name);
        //boarddetail
        var detail=document.createElement("div");
        detail.className="boarddetail";
        detail.innerHTML=boarddetail
        div.appendChild(detail);
    }
}
//刪除看板請求
function deleteApplyBoard(boardname)
{
    firestore.collection("applyboard").doc(boardname).delete().then(function(){
        exception("刪除成功","applyBoardList.php");
    });
}
//寫入選擇看板
function writeSelectBoard(json,id)
{
    var board=json;
    var select=document.getElementById(id);
    for(var i=0;i<board.length;i++)
    {
        var option=document.createElement("option");
        option.value=board[i];
        option.textContent=board[i];
        select.appendChild(option);
    }
}
//發文
function postArticle(json)
{
    var article=json;
    firestore.collection("article").add(article).then(function(){
        exception("發文成功","articleList.php?board="+article.board);
    });
}
//讀取文章
function getArticleList(boardname,link)
{
    if(boardname=="hot")
    {
        firestore.collection("article").orderBy("click","desc").get().then(function(querySnapshot){
            var articleList=[];

             querySnapshot.forEach(function(doc){
                var data=doc.data();
                var name=data.name;
                var docId=doc.id;
                articleList.push({"name":name,"docid":docId});
            });
            var json=JSON.stringify(articleList);
    
            location.href=link+"?articleList="+json;
        });
    }
    else if(boardname=="all")
    {
        firestore.collection("article").orderBy("time","desc").get().then(function(querySnapshot){
            var articleList=[];

             querySnapshot.forEach(function(doc){
                var data=doc.data();
                var name=data.name;
                var docId=doc.id;
                articleList.push({"name":name,"docid":docId});
            });
            var json=JSON.stringify(articleList);
    
            location.href=link+"?articleList="+json;
        });
    }
    else
    {
        firestore.collection("article").where("board","==",boardname).orderBy("time","desc").get().then(function(querySnapshot){
            var articleList=[];
            querySnapshot.forEach(function(doc){
                var data=doc.data();
                var name=data.name;
                var docId=doc.id;
                articleList.push({"name":name,"docid":docId});
            });
            var json=JSON.stringify(articleList);
    
            location.href=link+"?articleList="+json;
        });
    }  
}
//寫入文章列表
function writeArticleList(json,id)
{
    var div=document.getElementById(id);
    var articleList=json;   
    for(var i=0;i<articleList.length;i++)
    {
        var name=articleList[i].name;
        var docId=articleList[i].docid;

        var a=document.createElement("a");
        a.href="articleContent.php?docid="+docId;
        a.textContent=name;
        div.appendChild(a);
    }
}
//讀取文章
function getArticle(docId,link)
{
    firestore.collection("article").doc(docId).get().then(function(doc){
        var data=doc.data();
        var author=data.author;
        var name=data.name;
        var content=data.content;
        var click=data.click;
        var time=data.time;
        var article={"author":author,"name":name,"content":content,"time":time};
        var json=JSON.stringify(article);

        firestore.collection("article").doc(docId).update({"click":click+1}).then(function(){
            location.href=link+"?article="+json;
        });
    });
}
//寫入文章
function writeArticle(json,id)
{
    var article=json;
    var author=article.author;
    var name=article.name;
    var content=article.content;
    //timestamp轉date
    var time=new Date(article.time*1000);
    //取得時間資料
    var year=time.getFullYear();
    var month=time.getMonth()+1;
    var date=time.getDate();
    var hour=time.getHours();
    if(hour<10)
        hour="0"+hour;
    var minute=time.getMinutes();
    if(minute<10)
        minute="0"+minute;
    var second=time.getSeconds();
    if(second<10)
        second="0"+second;

    //div
    var div=document.getElementById(id);
    //author
    var authorDiv=document.createElement("div");
    authorDiv.textContent="作者:"+author;
    div.appendChild(authorDiv);
    //name
    var nameDiv=document.createElement("div");
    nameDiv.textContent="標題:"+name;
    div.appendChild(nameDiv);
    //time
    var timeDiv=document.createElement("div");
    timeDiv.textContent="時間:"+year+"/"+month+"/"+date+" "+hour+":"+minute+":"+second;
    div.appendChild(timeDiv);
    //content
    var contentDiv=document.createElement("div");
    contentDiv.className="content";
    contentDiv.innerHTML=content;
    div.appendChild(contentDiv);
}
//----------Ask----------
//寫入時間選項
function writeTimeOption(dateClass,hourClass,minuteClass)
{
    var date=document.getElementsByClassName(dateClass);
    var hour=document.getElementsByClassName(hourClass);
    var minute=document.getElementsByClassName(minuteClass);
    //date
    for(var i=1;i<8;i++)
    {
        var option=document.createElement("option");
        option.textContent=i;
        option.value=i;
        date[0].appendChild(option);
    }
    //hour
    for(var i=0;i<24;i++)
    {
        for(var j=0;j<2;j++)
        {
            var option=document.createElement("option");
            option.textContent=i;
            option.value=i;
            hour[j].appendChild(option);
        }
    }
    //minute
    for(var i=0;i<60;i++)
    {
        for(var j=0;j<2;j++)
        {
            var option=document.createElement("option");
            option.textContent=i;
            option.value=i;
            minute[j].appendChild(option);
        }
    }
}
//寫入選擇時間
function addTime(divId,formId,dateClass,hourClass,minuteClass)
{
    var form=document.getElementById(formId);
    var date=document.getElementsByClassName(dateClass);
    var hour=document.getElementsByClassName(hourClass);
    var minute=document.getElementsByClassName(minuteClass);
    // 顯示
    var div=document.getElementById(divId);
    var block=document.createElement("div");
    block.className="block";
    block.textContent="星期"+date[0].value+" "+hour[0].value+":"+minute[0].value+"~"+hour[1].value+":"+minute[1].value;
    var button=document.createElement("input");
    button.type="button";
    button.value="刪除";
    // 刪除
    button.onclick=function(){
        button.parentNode.parentNode.removeChild(block);
        hiddenDate.parentNode.removeChild(hiddenDate);
        hourStart.parentNode.removeChild(hourStart);
        minuteStart.parentNode.removeChild(minuteStart);
        hourEnd.parentNode.removeChild(hourEnd);
        minuteEnd.parentNode.removeChild(minuteEnd);
    }
    block.appendChild(button);
    div.appendChild(block);
    // 加入隱藏欄位
    var hiddenDate=document.createElement("input");
    hiddenDate.type="hidden";
    hiddenDate.value=date[0].value;
    hiddenDate.name="date[]";
    form.appendChild(hiddenDate);
    // 開始時間
    var hourStart=document.createElement("input");
    hourStart.type="hidden";
    hourStart.value=hour[0].value;
    hourStart.name="hourStart[]";
    form.appendChild(hourStart);
    var minuteStart=document.createElement("input");
    minuteStart.type="hidden";
    minuteStart.value=minute[0].value;
    minuteStart.name="minuteStart[]";
    form.appendChild(minuteStart);
    // 結束時間
    var hourEnd=document.createElement("input");
    hourEnd.type="hidden";
    hourEnd.value=hour[1].value;
    hourEnd.name="hourEnd[]";
    form.appendChild(hourEnd);
    var minuteEnd=document.createElement("input");
    minuteEnd.type="hidden";
    minuteEnd.value=minute[1].value;
    minuteEnd.name="minuteEnd[]";
    form.appendChild(minuteEnd);
}
//刊登諮商
function postAsk(ask)
{
    firestore.collection("ask").add(ask).then(function(){
        location.href="ask.html";
    });
}
//讀取諮商列表
function getAskList(link)
{
    var askList=[];
    firestore.collection("ask").get().then(function(querySnapshot){
        querySnapshot.forEach(function(doc){
            var data=doc.data();
            var username=data.username;
            var name=data.name;
            var detail=data.detail;
            var docId=doc.id;
            var ask={"username":username,"name":name,"detail":detail,"docId":docId};
            askList.push(ask);
        });
        var json=JSON.stringify(askList);
        location.href=link+"?ask="+json;
    });
}
//寫入諮商列表
function writeAskList(ask,divId)
{
    var div=document.getElementById(divId);
    for(var i=0;i<ask.length;i++)
    {
        var username=ask[i].username;
        var name=ask[i].name;
        var detail=ask[i].detail;
        var docId=ask[i].docId;
        var block=document.createElement("a");
        block.className="block";
        block.innerHTML="刊登者:"+username+"<br>名稱:"+name+"<br>詳細:<br>"+detail;
        block.href="askContent.php?docId="+docId;
        div.appendChild(block);
    }
    
}
//讀取諮商
function getAsk(docId,link)
{
    firestore.collection("ask").doc(docId).get().then(function(doc){
        var data=doc.data();
        var username=data.username;
        var name=data.name;
        var detail=data.detail;
        var date=data.date;
        var hourStart=data.hourStart;
        var minuteStart=data.minuteStart;
        var hourEnd=data.hourEnd;
        var minuteEnd=data.minuteEnd;
        var ask={"docId":docId,"username":username,"name":name,"detail":detail,"date":date,"hourStart":hourStart,"minuteStart":minuteStart,"hourEnd":hourEnd,"minuteEnd":minuteEnd}
        var json=JSON.stringify(ask);
        location.href=link+"?ask="+json;
    });
}
//寫入諮商
function writeAskFirebase(docId,ask,divId)
{
    var div=document.getElementById(divId);
    var username=ask.username;
    var name=ask.name;
    var detail=ask.detail;
    var date=ask.date;
    var hourStart=ask.hourStart;
    var minuteStart=ask.minuteStart;
    var hourEnd=ask.hourEnd;
    var minuteEnd=ask.minuteEnd;

    // 刊登者
    var usernameDiv=document.createElement("div");
    usernameDiv.textContent="刊登者:"+username;
    usernameDiv.className="username";
    div.appendChild(usernameDiv);
    // 名稱
    var nameDiv=document.createElement("div");
    nameDiv.textContent="名稱:"+name;
    nameDiv.className="name";
    div.appendChild(nameDiv);
    // 詳細
    var detailDiv=document.createElement("div");
    detailDiv.innerHTML=detail;
    detailDiv.className="detail";
    div.appendChild(detailDiv);
    // 時間
    var timeDiv=document.createElement("div");
    timeDiv.className="timeBlock";
    timeDiv.textContent="時間:"
    for(var i=0;i<date.length;i++)
    {
        var time=document.createElement("div")
        time.className="time";
        time.textContent="星期"+date[i]+" "+hourStart[i]+":"+minuteStart[i]+"~"+hourEnd[i]+":"+minuteEnd[i];
        timeDiv.appendChild(time);
    }
    div.appendChild(timeDiv);
    // 已預約
    var reserveDiv=document.createElement("div");
    reserveDiv.className="reserveBlock";
    reserveDiv.innerHTML="已預約:";
    firestore.collection("reserve").where("docId","==",docId).get().then(function(querySnapshot){
        querySnapshot.forEach(function(doc)
        {
            var data=doc.data();
            var date=data.date;
            var hourStart=data.hourStart;
            var minuteStart=data.minuteStart;
            var hourEnd=data.hourEnd;
            var minuteEnd=data.minuteEnd;
            
            var reserve=document.createElement("div");
            reserve.className="reserve";
            reserve.textContent="星期"+date+" "+hourStart+":"+minuteStart+"~"+hourEnd+":"+minuteEnd;
            reserveDiv.appendChild(reserve);
        });
    });
    div.appendChild(reserveDiv);           
}
//預約諮商
function reserve(docId,ask)
{
    firestore.collection("reserve").add(ask).then(function(){
        location.href="askContent.php?docId="+docId;
    });
}
