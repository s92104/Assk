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

//註冊
function register(username,password)
{
    var docRef = firestore.collection("user").doc(String(username));
    docRef.get().then(function(doc){
        if(doc.exists)
        {
            alert("帳號已存在");
            location.href="register.html";
        }
        else
            firestore.collection("user").doc(String(username)).set({password:password});
    });
}
//登入
function login(username,password)
{
    var docRef = firestore.collection("user").doc(String(username));
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
function getMember(username)
{
    var docRef = firestore.collection("user").doc(String(username));
    docRef.get().then(function(doc){
        writeMember(doc);
    });
}
//寫入Html
function writeMember(doc)
{  
    var username=doc.id;
    var data=doc.data(); 
    var password=data.password;
    const member=document.querySelector("#member");
    let td_username=document.createElement("td");
    let td_password=document.createElement("td");
    td_username.textContent=username;
    td_password.textContent=password;
    member.appendChild(td_username);
    member.appendChild(td_password);
}