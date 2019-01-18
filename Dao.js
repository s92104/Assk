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
    //包成JSON
    var member={"password":password,"name":name,"email":email,"phone":phone,"address":address};

    var docRef = firestore.collection("user").doc(username);
    docRef.get().then(function(doc){
        if(doc.exists)
        {
            alert("帳號已存在");
            location.href="register.html";
        }
        else
        {
            alert("註冊成功");
            firestore.collection("user").doc(username).set(member).then(function(){
                location.href="login.html"; 
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
                alert("登入成功");
                location.href="member.php?username="+username;
            }
            else
            {
                alert("密碼錯誤");
                location.href="login.html";
            }
        }
        else
        {
            alert("帳號不存在");
            location.href="login.html";
        }   
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
        //包成JSON
        var member={"password":password,"name":name,"email":email,"phone":phone,"address":address};
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
    //處理圖片
    
    //包成JSON
    var member={"password":password,"name":name,"email":email,"phone":phone,"address":address};

    firestore.collection("user").doc(username).set(member).then(function(){
        location.href="editForm.php?member="+json;
    });    
}
//上傳圖片
function upload(username,id)
{
    var fileButton=document.getElementById(id);
    var file=fileButton.files[0];
    var storageRef=firebase.storage().ref(username+"/"+file.name);
    var task = storageRef.put(file);
    task.on('state_changed',function(snapshot){

    },function(error){

    },function(){
         var url=task.snapshot.downloadURL;
         console.log(url);
    })
}
