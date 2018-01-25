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
    <title>Main page</title>
</head>
<body>
    <div class="wrapper">
        <div class="log">
          <header>Welcome in E-sport Poll</header>
          <?php if(isset($_SESSION['info']))
                {
                    echo $_SESSION['info'];
                    unset($_SESSION['info']);
                }
          ?>
          <fieldset>
              <form action="soapClient.php" method="post">
                  <label>Login: </label>
                  <input type='text' name='login' required/></br>
                  <label>Password: </label>
                  <input type='text' name='pass' required/></br>
                  <input type="submit" name="log" value="Sign in"/>
              </form>
              <a href="view/createAcc.php"><p>You dont have account? Create one very fast!</p></a>
          </fieldset>

          <p>Create polls in offline mod!</p>
        </div>
        <footer>Techniki internetowe &#169; 2017 </footer>
    </div>
</body>
</html>
