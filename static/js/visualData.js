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
            xmlHttp.open("GET", "../soapClient.php?fun=1", true);
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
    if (xmlHttp.readyState == 4)
    {
        var voteData = JSON.parse(xmlHttp.responseText);
        var canv = document.getElementById('canv');
        /*for(var key in voteData )
        {
            console.log(key, voteData[key]);
        }*/
        var text = "<p style='text-align:center;'>Number of people which voted:" + voteData['all'] + "<br/>";
        text += 'Men: ' + voteData['men'] + ' women: ' + (voteData['all'] - voteData['men']) + "<br/>";
        text += 'Number of people which know particulat e-sport games: <br/>';
        text += 'cs: ' + voteData['cs'] + ' lol: ' + voteData['lol'] + ' gw: ' + voteData['gw'] + "<br/>";
        text += 'People who dont know any of this game:<br/>';
        text +=  voteData['zeroVt'];

        canv.innerHTML = text;
    }
}
