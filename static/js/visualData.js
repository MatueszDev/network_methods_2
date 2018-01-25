"use strict";


var xmlHttp;

function getRequestObject()
{
    if ( window.ActiveXObject)
    {
        return ( new ActiveXObject("Microsoft.XMLHTTP")) ;
    } else if (window.XMLHttpRequest) {
        return (new XMLHttpRequest())  ;
    } else {
        return (null) ;
    }
}

function sendRequest()
{
    xmlHttp = getRequestObject() ;
    if (xmlHttp) {
        try {
            xmlHttp.onreadystatechange = handleResponse ;
            xmlHttp.open("GET", "../cgi-bin/python/ajax_text.py", true);
            xmlHttp.send(null);
        }catch (e){
            alert ("Nie mozna polaczyc sie z serwerem: " + e.toString()) ;
        }
    } else {
        alert ("Blad") ;
    }
}


function handleResponse()
{
    if (request.readyState == 4)
    {
        alert(request.responseText) ;
    }
}
