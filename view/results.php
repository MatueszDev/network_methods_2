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
          <header>Results</header>
					<nav>
						<a href="poll.php"><div>Poll</div></a>
						<div>Merge with server data </div>
					  <a href="results.php"><div>Show records</div></a>
					</nav>
          <div class="result" id="canv" onclick="sendRequest()">
          1

          </div>
          <a href="../appl/logout.php"><p>Log out!</p></a>
        </div>
        <footer>Techniki internetowe &#169; 2017 </footer>
    </div>
    <!--<script src="../static/js/jquery-3.3.1.min.js" type="text/javascript"></script>-->
    <script src="../static/js/visualData.js" type="text/javascript"></script>
</body>
</html>
