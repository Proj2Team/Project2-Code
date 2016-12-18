<html>
<head>
<title>Student: Reset Password</title>
</head>
<body>

<?php
session_start();

if($_SESSION['confirmedPass'] == true)
  {
    echo("Passwords do not match.");
  }

?>

<form action='resetPassword.php' method='post'>

Password: <br><input type='password' name='password' required><p>

Re-enter Password:<br> <input type='password' name='confirmPass' required><p> 


<input type='submit' value='Set Password' name='resetButton'> <p>

</form>

</body>