<!-- File: editInformation.php-->
<!-- This page allows a student to edit the information of an already existing student -->
<!-- It is very similar to the registration page (but doesn't allow some changes that registration does-->
<!-- The body is by Khadijah. Any changes by anyone else should be commented -->

<?php
session_start();
?>

<html>
<head>
<title>Student: Edit Information</title>
</head>
<body>

<?php
if($_SESSION['confirmedPass'] == true)
  {
    echo("Passwords do not match.");
  }

if($_SESSION['confirmedOldPass'] == true)
  {
    echo("Incorrect Password.");
  }

if($_SESSION['confirmedNewPass'] == true)
  {
    echo("New Passwords do not match.");
  }
?>

<form action='editStudent.php' method='post'>

  *First Name:<br> <input type='varchar' size='25' maxlength='40' name='fname' value='
<?php
	echo($_SESSION['first']);
?>
' required><p>

  Preferred Name:<br> <input type='varchar' size='25' maxlength='40' name='pname' value='
<?php
	echo($_SESSION['pref']);
?>
' ><p>

  *Last Name:<br> <input type='varchar' size='25' maxlength='40' name='lname' value='
<?php
	echo($_SESSION['last']);
?>
' required><p>

  *Password: <br><input type='password' name='password' required><p>

  *Re-enter Password:<br> <input type='password' name='confirmPass' required><p> 

  New Password: <br><input type='password' name='newPass'> <sub> Optional </sub> <p>

  Re-enter New Password: <br><input type='password' name='confirmNewPass'><p>


  *Select Major(s):<br>
  <select name='majors[]' multiple='multiple'>
  <option value='bio_ba'>Biological Sciences BA</option>
  <option value='bio_bs'>Biological Sciences BS</option>
  <option value='biochem_bs'>Biochemistry & Molecular Biology BS</option>
  <option value='bioinfo_bs'>Bioinformatics & Computational Biology BS</option>
  <option value='bioedu_ba'>Biological Education BA</option>
  <option value='chem_ba'>Chemistry BA</option>
  <option value='chem_bs'>Chemistry BS</option>
  <option value='chemedu_ba'>Chemistry Education BA</option>
  </select><p>



  <input type='submit' value='Apply Changes'> <p>

</form>

<!-- EDITS BY KHADIJAH: added *s for required fields and added small note-->
<!-- Also added a link back to log in in case register was clicked by accident-->

<form action='homescreen.php' method='post' name='editStudent'>
    <input type='submit' value='Back to Home'>
</form><p>

<sub> *Required field</sub><br>

</body>
</html>
