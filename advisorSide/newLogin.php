<?php
session_start();
?>

<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="../styles.css" type="text/css">
  </head>
  <body>

  <?php
  $_SESSION['advisorExists'] = false;
  $_SESSION['confirmedPass'] = false;
  ?>
    <h1 class="medium-title">UMBC Advisor Login</h1>
    <form class="center-form form-clean space-children-input text-center-input" action='processLogin.php' method='post' name='AdvisorLogin'>
      <div class="wrap-align-left">
        <label for='email'>UMBC Email:</label><br/>
        <input id='email' type='text' size='25' maxlength='50' name='email' required><br/>
      </div>

      <div class="wrap-align-left">
        <label for='passw'>Password:</label><br/>
        <input id='pass' type='password' size='25' maxlength='50' name='pass' required><br/>
      </div>

      <div class='loginButton'>
        <input class="button" type='submit' value='Login'>
      </div>
    </form>

  </body>
</html>
