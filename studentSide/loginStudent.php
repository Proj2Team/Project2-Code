<?php
session_start();
?>
<html>
<head>
<title></title>
</head>
<body>

<?php
if($_SESSION['userValue'] == true)
  {
    echo "Invalid username/password combination.";
  }

$_SESSION['confirmedPass'] = false;
$_SESSION['studentExists'] = false;
?>
<!-- EDITS BY KHADIJAH: neatened up format and changed from email to umbc ID because -->
<!-- the query in processLogin.php was asking for umbc ID in the first place...--> 

<form action='processLogin.php' method='post' name='studentLogin'>
  UMBC ID:<br> <input type='text' name='umbc_ID' placeholder='XZ12345' required><p>
  Password:<br> <input type='password' name='password' required><p>
  <input type='submit' value='Login'>
</form>

<form action='registerStudent.php' method='post' name='registerStudent'>
    <input type='submit' value='Register'>
</form>
</body>
</html>
