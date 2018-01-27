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
    						<a href="poll.php" ><div class='option'>Poll</div></a>
    					  <a href="results.php" ><div class='option'>Show records</div></a>
                <a href="#"><div class='option' onclick="merge()">Merge with server data </div></a>
                <div style="clear:both;"></div>
  					</nav>
            <div class="result" id="canv" onclick="sendRequest()">


            </div>
            <a href="../appl/logout.php"><p class="logout">Log out!</p></a>
        </div>
        <footer>Techniki internetowe &#169; 2017 </footer>
    </div>
    <!--<script src="../static/js/jquery-3.3.1.min.js" type="text/javascript"></script>-->
    <script src="../static/js/visualData.js" type="text/javascript"></script>
    <script src="../static/js/jquery-3.3.1.min.js"></script>
    <script src="../static/js/merge.js" type="text/javascript"></script>
    <script>
        $( document ).ready(function() {
            sendRequest();
        });
    </script>
</body>
</html>
