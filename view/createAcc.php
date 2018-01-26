<?php

	session_start();



?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link href="../static/css/main.css" rel="stylesheet" type="text/css"/>
    <title>Main page</title>
</head>
<body>
    <div class="wrapper">
        <div class="log">
          <header>Create account</header>

          <fieldset>
            <?php if(isset($_SESSION['info']))
                  {
                      echo $_SESSION['info'];
                      unset($_SESSION['info']);
                  }
            ?>
              <form action="../soapClient.php" method="post">
                  <label class ="short">Login: </label>
                  <input type='text' name='login' required/></br>
                  <label class="short">Name: </label>
                  <input type='text' name='name' required/></br>
                  <label>Password: </label>
                  <input type='text' name='pass' required/></br>
                  <input type="submit" name='create' value="Create"/>
              </form>

              <a href="../index.php"><p>Return to main page!</p></a>
        </fieldset>
        </div>
        <footer>Techniki internetowe &#169; 2017 </footer>
    </div>
</body>
</html>
