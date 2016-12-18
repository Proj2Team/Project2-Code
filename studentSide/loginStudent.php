<?php
session_start();
?>
<html>
<head>
<title>Student: Log in</title>
<link rel="stylesheet" href="../styles.css" type="text/css">
<!--Edit by Syake: added javascript alert-->
<script language="JavaScript">
	function invalidInput(input) {
		if(input == "true")
		{
			alert("Invalid username/password combination.");
		}
	}
	
</script>
</head>
<body id='student'>
<!-- commented out by Syake: use JS instead of echo-->
<?php
if($_SESSION['userValue'] == true)
  {
    echo "Invalid username/password combination.";
	//echo "\n(This is being fixed so that this message \nonly appears when a user types in an incorrect username/password,\n";
	//echo "most likely with a popup window.)\n";
  }


$_SESSION['confirmedPass'] = false;
$_SESSION['confirmedNewPass'] = false;
$_SESSION['studentExists'] = false;
$_SESSION['confirmedNewPass'] = false;

?>

<!-- EDITS BY KHADIJAH: neatened up format and changed from email to umbc ID because -->
<!-- the query in processLogin.php was asking for umbc ID in the first place...--> 

<form class="center-form form-clean space-children-input text-center-input" action='processLogin.php' method='post' name='studentLogin'>
  <div class='field'>
  UMBC ID:<br> <input type='text' name='umbc_ID' placeholder='XZ12345' required><p>
  </div>
  <div class='field'>
  Password:<br> <input type='password' name='password' required><p>
  </div>
  <input class='loginButton' id='student' type='submit' value='Login'> <!--onsubmit="return invalidInput();"--> 
</form>

<form action='registerStudent.php' method='post' name='registerStudent'>
    <input type='submit' value='Register'>
</form>
</body>
</html>
