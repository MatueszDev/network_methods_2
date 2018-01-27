<?php
    session_start();

    $debug  = 0;
    $client = new SoapClient(null, array(
        'location' => "http://localhost/proj2/soapServer.php",
        'uri'      => "http://localhost/proj2",
        'soap_version' => SOAP_1_2,
        'trace'    => $debug ));


    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        /*try{
            $respond = $client->__soapCall("printAll",array("") );
            echo $respond;
        }catch(Exception $exc){
            echo "<p> Error </p>".$exc;
        }*/

        if(isset($_GET['sex']) && isset($_GET['age']) )
        {
            $flag = True;

            if($_GET['sex'] == 'women' || $_GET['sex'] == 'men')
            {
                $sex = $_GET['sex'];
            }else{
                $flag = False;
            }
            echo $sex;
            if(isset($_GET['game']))
            {
                $game = $_GET['game'];
                foreach ($game as $var)
                {
                    if($var == 'cs')
                        $cs = 1;
                    else if($var == 'lol')
                        $lol = 1;
                    else if($var == 'gw')
                        $gw = 1;
                }
            }
            if($cs != 1)
                $cs = 0;
            if($lol != 1)
                $lol = 0;
            if($gw != 1)
                $gw = 0;
            $age = htmlentities($_GET['age'], ENT_QUOTES, "UTF-8");
            $age = (int)$age;
            if($age < 0 || $age > 110)
                $flag = False;

            if($flag)
            {
              try{
                  $data = array("login"=>$_SESSION['login'], 'sex'=> $sex, 'age'=> $age, 'cs'=> $cs, 'lol'=> $lol, 'gw'=> $gw );
                  $respond = $client->__soapCall("addNewRecord", $data );
                  if($respond)
                  {
                      $_SESSION['Record'] = '<p>You succesfully added new opinion</p>';
                      header('Location: view/poll.php');

                      exit();
                  }else{

                    $_SESSION['Record'] = '<p>Something went wrong :(</p>';
                    header('Location: view/poll.php');

                    exit();
                  }
              }catch(Exception $exc){
                  echo "<p> Error </p>".$exc;
              }
            }else{
                $_SESSION['info'] = '<p style="color:red;">Wrong data!</p>'.$login;
                header('Location: view/poll.php');
                exit();
            }

        }


        if(isset($_GET['fun']) && $_GET['fun'] == 1)
        {
          try{
              $respond = $client->__soapCall("numberOfUserRecords", array('login'=> $_SESSION['login']));
              echo json_encode($respond);

          }catch(Exception $exc){
              echo "<p> Error </p>".$exc;
          }
        }

    }

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      if(isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['log']))
      {
          try{
              $login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
              $password = htmlentities($_POST['pass'], ENT_QUOTES, "UTF-8");
              $respond = $client->__soapCall("login",array("user"=>$login, "password"=>$password) );
              echo $respond;

              if($respond == 'ok')
              {
                $_SESSION['logged'] = true;
                $_SESSION['login'] = $login;
                header('Location: view/poll.php');
            		exit();
              }else{
                $_SESSION['logged'] = false;
                $_SESSION['info'] = '<p style="color:red;">Wrong username or password!</p>';
                header('Location: index.php');
            		exit();
              }
          }catch(Exception $exc){
              echo "<p> Error </p>".$exc;
          }
      }
      if(isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['create']) && isset($_POST['name']))
      {
        try{
            $login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
            $password = htmlentities($_POST['pass'], ENT_QUOTES, "UTF-8");
            $name = htmlentities($_POST['name'], ENT_QUOTES, "UTF-8");
            $respond = $client->__soapCall("createUser",array("user"=>$login, "password"=>$password, "name"=>$name) );
            echo $respond;
            if($respond == 'ok')
            {
              $_SESSION['info'] = "<p><i> You can log to our service know!</i></p>";
              header('Location: index.php');
              exit();
            }else if($respond == 'login_exist'){
              $_SESSION['info'] = '<p style="color:red;">This login already exists!</p>';
              header('Location:view/createAcc.php');
              exit();
            }else{
              $_SESSION['info'] = '<p style="color:red;">Unhandled error occur!</p>';
              header('Location:view/createAcc.php');
              exit();
            }
        }catch(Exception $exc){
            echo "<p> Error </p>".$exc;
        }
      }

      if(isset($_POST['json']))
      {

          $json = json_decode($_POST["json"], true);
          foreach ($json as $var)
          {
              $data = array("login"=> $var['login'], 'sex'=> $var['sex'], 'age'=> $var['age'], 'cs'=> $var['cs'], 'lol'=> $var['lol'], 'gw'=> $var['gw']);
              $respond = $client->__soapCall("addNewRecord", $data );

          }

      }


    }









if ( $debug == 1 ) {
    echo ("<pre>");
    echo("\nDumping request headers:\n"
       .$client->__getLastRequestHeaders());

    echo("\nDumping request:\n".$client->__getLastRequest());

    echo("\nDumping response headers:\n"
       .$client->__getLastResponseHeaders());

    echo("\nDumping response:\n".$client->__getLastResponse());
    echo "</pre>";
   }

?>
