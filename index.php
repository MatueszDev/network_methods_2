<?php

	session_start();

	if ((isset($_SESSION['logged'])) && ($_SESSION['logged']==true))
	{
		header('Location: view/poll.php');
		exit();
	}

?>

<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link href="static/css/main.css" rel="stylesheet" type="text/css"/>
    <title>Main page</title>
</head>
<body>
    <div class="wrapper">
        <div class="log">
          <header>Welcome in E-sport Poll</header>

          <fieldset>
              <?php if(isset($_SESSION['info']))
                    {
                        echo $_SESSION['info'];
                        unset($_SESSION['info']);
                    }
              ?>
              <form action="soapClient.php" method="post">
                  <label class="short">Login:</label>
                  <input type='text' name='login' required/></br>
                  <label>Password: </label>
                  <input type='text' name='pass' required/></br>
                  <input type="submit" name="log" value="Sign in"/>
              </form>
              <a href="view/createAcc.php"><p>You dont have account? Create one very fast!</p></a>
          </fieldset>

        <a href="view/offlinePoll.php"><div class="offline"> <p>Create polls in offline mod!</p></div></a>
        </div>
        <footer>Techniki internetowe &#169; 2017 </footer>
    </div>
</body>
</html>
