window.indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB;
// DON'T use "var indexedDB = ..." if you're not in a function.
// Moreover, you may need references to some window.IDB* objects:
window.IDBTransaction = window.IDBTransaction || window.webkitIDBTransaction || window.msIDBTransaction || {READ_WRITE: "readwrite"}; // This line should only be needed if it is needed to support the object's constants for older browsers
window.IDBKeyRange = window.IDBKeyRange || window.webkitIDBKeyRange || window.msIDBKeyRange;
// (Mozilla has never prefixed these objects, so we don't need window.mozIDB*)



if (!window.indexedDB) {
    window.alert("Your browser doesn't support a stable version of IndexedDB. Offline poll will not be available.");
}



function merge(){

  var request = window.indexedDB.open("OfflinePoll", 2);

  request.onerror = function () {
    console.log('error');
  };



  request.onsuccess = function (event) {
    console.log('success');

    var db = event.target.result;

    var request = db.transaction(['poll'], 'readwrite').objectStore('poll').openCursor();

    var storedCollection = [];

    request.onsuccess = function (event) {
        var cursor = event.target.result;

        if (cursor) {
            storedCollection.push(cursor.value);
            cursor.continue();
            return; // exit callback
        }
        console.log(storedCollection);
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                console.log(xhr.status, xhr.responseText);
            }
        };

        xhr.open('POST', '../soapClient.php', false);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded', true);
        xhr.send("json=" + encodeURIComponent(JSON.stringify(storedCollection)));

        for(var i = 0 ; i < 2; i++)
        {
            remove(i+1);
        }
    };
  };
}
