<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Offline poll</title>
</head>
<body>
    <div class="wrapper">
        <div class="offpol">
          <header>Offline poll</header>
          <fieldset>
              <form action="../soapClient.php" method="get">
                  <label>Login: </label>
                  <input type='text' name='login' required/></br>
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
          </fieldset>


          <a href="../index.php"><p>Return to main page!</p></a>
        </div>
        <footer>Techniki internetowe &#169; 2017 </footer>
        <script src="../static/js/offline.js" type="text/javascript"></script>
    </div>
</body>
</html>