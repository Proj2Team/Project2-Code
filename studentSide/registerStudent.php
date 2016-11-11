<?php
session_start();
?>
<html>
<head>
<title></title>
</head>
<body>

<?php
if($_SESSION['confirmedPass'] == true)
  {
    echo("Passwords do not match.");
  }

if($_SESSION['studentExists'] == true)
  {
    echo("Student already exists.");
  }
?>

<form action='setStudent.php' method='post'>

  *First Name: <input type='varchar' size='25' maxlength='40' name='fname' required><p>

  Preferred Name: <input type='varchar' size='25' maxlength='40' name='pname' placeholder = 'eg. A nickname' ><p>

  *Last Name: <input type='varchar' size='25' maxlength='40' name='lname' required><p>

  *Student ID: <input type='varchar' size='7' maxlength='10' min = 7 max = 7 name='umbc_ID' placeholder = 'XZ12345' required><p>

  *Email: <input type='email' name='email' placeholder = 'jDoe@umbc.edu' required><p>

  *Password: <input type='password' name='password' required><p>

  *Re-enter Password: <input type='password' name='confirmPass' required><p> 

  *Select Major(s):<br/>
  <select name='majors[]' multiple='multiple'>
  <option value='bio_ba'>Biological Sciences BA</option>
  <option value='bio_bs'>Biological Sciences BS</option>
  <option value='biochem_bs'>Biochemistry & Molecular Biology BS</option>
  <option value='bioinfo_bs'>Bioinformatics & Computational Biology BS</option>
  <option value='bioedu_ba'>Biological Education BA</option>
  <option value='chem_ba'>Chemistry BA</option>
  <option value='chem_bs'>Chemistry BS</option>
  <option value='chemedu_ba'>Chemistry Education BA</option>
  </select><br/><br/>


  <input type='submit' value='Register'> <p>

<sub> *Required field</sub>


</form>

</body>
</html>
