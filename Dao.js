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
