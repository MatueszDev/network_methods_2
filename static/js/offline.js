// In the following line, you should include the prefixes of implementations you want to test.
window.indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB;
// DON'T use "var indexedDB = ..." if you're not in a function.
// Moreover, you may need references to some window.IDB* objects:
window.IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction || window.msIDBTransaction || {READ_WRITE: "readwrite"}; // This line should only be needed if it is needed to support the object's constants for older browsers
window.IDBKeyRange = window.IDBKeyRange || window.webkitIDBKeyRange || window.msIDBKeyRange;
// (Mozilla has never prefixed these objects, so we don't need window.mozIDB*)



if (!window.indexedDB) {
    window.alert("Your browser doesn't support a stable version of IndexedDB. Offline poll will not be available.");
}


const pollData = [
    {  date: Date.now(), login: 'Zenek', sex:'men', age: 25, cs:1, lol:1, gw:0 },
];

var db;
var request = window.indexedDB.open("OfflinePoll", 2);


request.onerror = function(event) {
    console.log("error: "+ event);
};
request.onsuccess = function(event) {
    db = request.result;
    console.log("success: " + db);
};


request.onupgradeneeded = function(event){
    var db = event.target.result;
    var objectStore = db.createObjectStore("poll", {autoIncrement:true});

     //objectStore.createIndex("login", "login", { unique: false });

    for(var i in pollData)
    {
        objectStore.add(pollData[i]);
    }
}

function readAll()
{
    var objectStore = db.transaction("poll").objectStore("poll");

    objectStore.openCursor().onsuccess = function(event){
        var cursor = event.target.result;

        if(cursor)
        {
            alert(cursor.key + cursor.value.login);
        }else{
            alert("No more entries");
        }
    }
}

function add()
{
    var loginDoc = document.getElementsByName('login');
    var loginVar = loginDoc[0].value;

    var sexDoc = document.getElementsByName('sex');
    if(sexDoc[0].value == 1)
        var sexVar = "men";
    else
        var sexVar = "women";

    var ageDoc = document.getElementsByName('age');
    var ageVar = parseInt(ageDoc[0].value, 10);

    var gameVotes = document.getElementsByName('game[]');
    var csVar = gameVotes[0].checked ? 1:0;
    var lolVar = gameVotes[1].checked ? 1:0;
    var gwVar = gameVotes[2].checked ? 1:0;

    console.log(loginVar, sexVar, ageVar, csVar, lolVar, gwVar);



    var request = db.transaction(["poll"], "readwrite")
    .objectStore("poll")
    .add({ date: Date.now(), login:loginVar, sex:sexVar, age:ageVar, cs:csVar, lol:lolVar, gw:gwVar});

    request.onsuccess = function(event) {
          console.log("Record added.");
    };

    request.onerror = function(event) {
          console.log("Unable to add data");
    };


}


function remove(record)
{
    var request = db.transaction(["poll"], "readwrite")
    .objectStore("poll")
    .delete(record);

    request.onsuccess = function(event) {
        console.log("records have been removed from your database.");
  };
}

var json;

function get(key)
{

    var transaction = db.transaction(["poll"]);
    var objectStore = transaction.objectStore("poll");
    var request = objectStore.get(key);

    request.onerror = function(event) {
        console.log("Unable to retrieve daa from database!");
    };



    request.onsuccess = function(event) {
       if(request.result)
       {
          var data = {'login':request.result.login, 'age':request.result.age, 'date':request.result.date, 'cs':request.result.cs, 'lol':request.result.lol, 'gw':request.result.gw, 'sex':request.result.sex };
          json = JSON.stringify(data);
          console.log(json);
          //console.log("Name: " + request.result.login + ", Age: " + request.result.age + ", Email: " + request.result.gw);



          return 1;
      }else {
          return "OutOfIndex";
       }
    };


}
