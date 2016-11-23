<?php
session_start();
?>

<html>
<head>
<title>Student: Log in</title>
</head>
<body>

<?php
$_SESSION['studentExists'] = false;
$_SESSION['confirmedNewPass'] = false; 
$_SESSION['confirmedOldPass'] = false; //some of these are used to prevent errors and are not actually used 
					//until the student goes to certain pages. these are simply ALL the possible errors
$_SESSION['confirmedPass'] = false;
$_SESSION['umbcEmail'] = false;
?>

<!-- EDITS BY KHADIJAH: neatened up format and changed from email to umbc ID because -->
<!-- the query in processLogin.php was asking for umbc ID in the first place...-->

<form action='processLogin.php' method='post' name='studentLogin'>
  <div class='field'>
    <label for='umbc_ID'>UMBC ID:</label><br>
    <input type='text' name='umbc_ID' required placeholder='XZ12345'><p>
  </div>

  <div class='field'>
    <label for='password'>Password:</label><br>
    <input type='password' name='password' required><p>
  </div>

  <div class='loginButton'>
    <input type='submit' value='Login'>
  </div>
</form>

<form action='registerStudent.php' method='post' name='registerStudent'>
  <input type='submit' value='Register'>
</form>
</body>
</html>