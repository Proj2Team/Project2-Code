<?php
session_start();
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);
?>

<html>
<head>
<title>Student: Log in</title>
<link rel="stylesheet" href="studentstyles.css" type="text/css">
</head>
<body>

<?php
//EDITS BY KHADIJAH: added more error checking
//some of these are used to prevent errors and are not actually used 
//until the student goes to certain pages. these are simply ALL the possible errors
$_SESSION['studentExists'] = false;
$_SESSION['confirmedNewPass'] = false; 
$_SESSION['confirmedOldPass'] = false; 
$_SESSION['confirmedPass'] = false;
$_SESSION['umbcEmail'] = false;
$_SESSION['userValue'] = false;
$_SESSION['emailExists'] = false;


$sql = "SELECT * FROM isShutDown WHERE 1";

$rs = $COMMON-> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

if($row[0] == 0){

echo('The session for this semester is closed! Please come back next semester to schedule an appointment');
}
else{

?>

<!-- EDITS BY KHADIJAH: neatened up format and changed from email to umbc ID because -->
<!-- the query in processLogin.php was asking for umbc ID in the first place...-->
<center>
<form style="margin-bottom: 0;" class="center-form form-clean text-center-input" action='processLogin.php' method='post' name='studentLogin'>

    <label for='umbc_ID'>UMBC ID:</label><br>
    <input type='text' name='umbc_ID' required placeholder='XZ12345' required><br/>

    <label for='password'>Password:</label><br>
    <input type='password' name='password' required><br/>
    <input type='submit' class='button' value='Login'>
</form>

<form style="margin-top: 0;" class="center-form form-clean space-children-input text-center-input" action='registerStudent.php' method='post' name='registerStudent'>
  <input type='submit' value='Register' class='button'>
</form>
</center>
<a href = 'forgotPassword.php'>
  Forgot Your Password?
</a>
<br>
<sub><b>NOTE:</b> It is recommended you use Google Chrome. Firefox and other browsers may have issues viewing these webpages</sub>
</body>
</html>

<?php
}
?>