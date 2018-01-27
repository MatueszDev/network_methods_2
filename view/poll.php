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
    <link href="../static/css/poll.css" rel="stylesheet" type="text/css"/>
    <title>Poll</title>
</head>
<body>
    <div class="wrapper">
        <div class="poll">
          <header>Simple e-sport poll</header>
					<nav>
						<a href="#"><div class='option'>Poll</div></a>
					  <a href="results.php"><div class='option mid'>Show records</div></a>
            <a href="#"><div class='option' onclick="merge()">Merge with server data </div></a>
            <div style="clear:both;"></div>
					</nav>

          <fieldset>
            <?php if(isset($_SESSION['info']))
                  {
                      echo $_SESSION['info'];
                      unset($_SESSION['info']);
                  }
            ?>
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
          <a href="../appl/logout.php"><p class="logout">Log out!</p></a>
        </div>
        <footer>Techniki internetowe &#169; 2017 </footer>
    </div>
    <script src="../static/js/offline.js" type="text/javascript"></script>
    <script src="../static/js/merge.js" type="text/javascript"></script>
</body>
</html>
