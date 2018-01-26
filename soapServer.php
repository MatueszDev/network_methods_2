<?php


include 'appl/Auth.php';
include 'appl/Survey.php';


function printAll()
{
    $db = new Auth();
    $data = Auth::listAll();
    $res = "";
    foreach ($data as $key) {
        $res.="Name: ".$key['name']." Login: ".$key['login']."</br>";
    }
    return $res;
}

function login($user, $password)
{
    $db = new Auth($user, $password);
    try{
        $result = $db->check_user_existance();
        if($result[0]['name'] == $user && $result[0]['password'] == $password )
            return 'ok';
        else
            return 'User doesnt exists';
    }catch(Exception $exc){
        return $exc;
    }
}

function createUser($user, $password, $name)
{
    $db = new Auth($user, $password);
    $result = $db->check_user_existance();
    if($result[0]['name'] == '')
        return 'login_exist';
    $re = $db->addNewUser($name);
    return $re;
}

function test() {
    return "Test serwisu SOAP 1.2";
}

function addNewRecord($login, $sex, $age, $cs, $lol, $gw)
{
    $db = new Survey($login);
    $re = $db->addNewRecord( $age, $sex, $cs, $lol, $gw);
    return $re ;

}

function numberOfUserRecords($login)
{
    $db = new Survey($login);
    $numOfAllRec = $db->countNumberOfRecords();
    $numOfMen = $db->countNumberOfMen();
    $gameCS = $db->countGameVotes('cs');
    $gameLOL = $db->countGameVotes('lol');
    $gameGW = $db->countGameVotes('gw');
    $zeroVotes = $db->countZeroVotes();
    $numOfAllRec = (int)$numOfAllRec['count(*)'];
    $numOfMen = (int)$numOfMen['count(*)'];
    $gameCS = (int)$gameCS['count(*)'];
    $gameGW = (int)$gameGW['count(*)'];
    $gameLOL = (int)$gameLOL['count(*)'];
    $zeroVotes = (int)$zeroVotes['count(*)'];
    $Data = array('all' => $numOfAllRec, 'men' => $numOfMen, 'cs' => $gameCS, 'gw' => $gameGW, 'lol' => $gameLOL, 'zeroVt' => $zeroVotes);
    return $Data;
}


   $server = new SoapServer(null, array(
      'uri' => "http://localhost/proj2",
      'soap_version' => SOAP_1_2));
   $server->addFunction(array(
     "test",
     "printAll",
     "login",
     "createUser",
     "addNewRecord",
     "numberOfUserRecords",
   ));
   $server->handle();

?>
