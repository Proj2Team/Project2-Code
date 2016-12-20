<html>
<head>
<title>Student: Reset Password</title>
<link rel="stylesheet" href="studentstyles.css" type="text/css">
</head>
<body>
<center>

<?php
session_start();

if($_SESSION['confirmedPass'] == true)
  {
    echo("Passwords do not match.");
  }

?>

<form action='resetPassword.php' method='post' class="center-form form-clean space-children-input text-center-input" >

Password: <br><input type='password' name='password' required><p>

Re-enter Password:<br> <input type='password' name='confirmPass' required><p> 


<input type='submit' value='Set Password' name='resetButton' class='button'> <p>

</form>

</center>

</body>