<?php

	session_start();

	if (!isset($_SESSION['logged']))
	{
		header('Location: ../index.php');
		exit();
	}

?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Poll</title>
</head>
<body>
    <div class="wrapper">
        <div class="poll">
          <header>Simple e-sport poll</header>
					<nav>
						<div>Poll</div>
						<div>Merge with server data </div>
					  <a href="results.php"><div>Show records</div></a>
					</nav>
          <?php if(isset($_SESSION['info']))
                {
                    echo $_SESSION['info'];
                    unset($_SESSION['info']);
                }
          ?>
          <fieldset>
              <form action="../soapClient.php" method="get">
                  <label>Men</label>
                  <input type='radio' name='sex' value="men" required/></br>
                  <label>Women</label>
                  <input type='radio' name='sex' value="women" required/></br>
                  <label>Age</label>
                  <input type='text' name='age' required/></br>
                  <label>Which games do you know?</label></br>
                  <label><input type="checkbox" name="game[]" value="cs"/>Counter Strike:Global Offensive</label>
                  <label><input type="checkbox" name="game[]" value="lol"/>Leauge of Legends</label>
                  <label><input type="checkbox" name="game[]" value="gw"/>Gwent: Witcher card Game</label></br>
                  <input type="submit" value="save"/>
              </form>
              <?php
                  if(isset($_SESSION['Record']))
                  {
                      echo $_SESSION['Record'];
                      unset($_SESSION['Record']);
                  }
              ?>
          </fieldset>
          <a href="../appl/logout.php"><p>Log out!</p></a>
        </div>
        <footer>Techniki internetowe &#169; 2017 </footer>
    </div>
</body>
</html>
