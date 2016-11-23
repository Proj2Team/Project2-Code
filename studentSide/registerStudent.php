<?php
session_start();
?>
<html>
<head>
<title>Student: Create an Account</title>
</head>
<body>

<?php
if($_SESSION['confirmedPass'] == true)
  {
    echo("Passwords do not match. ");
  }

if($_SESSION['studentExists'] == true)
  {
    echo("Student already exists. ");
  }
if($_SESSION['umbcEmail'] == true)
  {
    echo("Please enter a UMBC email.");
  }
?>

<!-- CHANGES BY KHADIJAH: neatened up formatting and added preferred name (following description) -->

<form action='createStudent.php' method='post'>

  *First Name:<br> <input type='varchar' size='25' maxlength='40' name='fname' required><p>

  Preferred Name:<br> <input type='varchar' size='25' maxlength='40' name='pname' placeholder = 'eg. A nickname' ><p>

  *Last Name:<br> <input type='varchar' size='25' maxlength='40' name='lname' required><p>

  *Student ID:<br> <input type='varchar' size='7' maxlength='10' min=7 max=7 name='umbc_ID' placeholder = 'XZ12345' required><p>

  *UMBC Email:<br> <input type='email' name='email' placeholder = 'jDoe@umbc.edu' required><p>

  *Password: <br><input type='password' name='password' required><p>

  *Re-enter Password:<br> <input type='password' name='confirmPass' required><p> 

  *Select Major(s):<br>
  <select name='majors[]' multiple='multiple' required>
  <option value='bio_ba'>Biological Sciences BA</option>
  <option value='bio_bs'>Biological Sciences BS</option>
  <option value='biochem_bs'>Biochemistry & Molecular Biology BS</option>
  <option value='bioinfo_bs'>Bioinformatics & Computational Biology BS</option>
  <option value='bioedu_ba'>Biological Education BA</option>
  <option value='chem_ba'>Chemistry BA</option>
  <option value='chem_bs'>Chemistry BS</option>
  <option value='chemedu_ba'>Chemistry Education BA</option>
  </select><p>


  <input type='submit' value='Register'> <p>

</form>

<!-- EDITS BY KHADIJAH: added *s for required fields and added small note-->
<!-- Also added a link back to log in in case register was clicked by accident-->

<form action='newLogin.php' method='post' name='registerStudent'>
    <input type='submit' value='Back to Log in'>
</form><p>

<sub> *Required field</sub>


</body>
</html>
