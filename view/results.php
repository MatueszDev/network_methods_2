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
            <header>Results</header>
  					<nav>
    						<a href="poll.php" class='option'><div>Poll</div></a>
    					  <a href="results.php" class='option'><div>Show records</div></a>
                <div class='option'>Merge with server data </div>
                <div style="clear:both;"></div>
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
