<?php
session_start();
?>

<html>
  <head>
    <title>Confirm Shutdown</title>
    <link rel="stylesheet" href="../styles.css" type="text/css">
  </head>
  <body>
    <h1 class="big-title">Are you <i>absolutely certain</i> you want to shut down advising?</h3>
    <h4 class="medium-title"><span style="color: red;">This will remove ability for students to sign up for appointments.</span></h4>
    <h4 class="small-title">Students are still able to view information about their appointments. Advisor functionality will not change.</h4>
    <h4 class="small-title">This is <b>reversible</b>, if you change your mind later.</h4>
    <form action="shutDown.php" method="post" name="delete">
      <input class="button" type='submit' value='Yes, shut down advising.'>
    </form>

    <form action='advisorHome.php' method='post' name='formEdit'>
      <input class="button" type='submit' value='Actually, Nevermind!'>
    </form>
  </body>
</html>
