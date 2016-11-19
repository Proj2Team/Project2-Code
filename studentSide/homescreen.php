<?php
session_start();
?>

<html>
<head>

<!-- EDITS BY KHADIJAH: edit so it prints out the student's name as a header. It will print out-->
<!-- preferred name if they have one, but if not it prints out their first name -->

<h1>
Welcome 
<?php

if($_SESSION['pref'] != '')
{
  echo($_SESSION['pref']);
}
else
{
echo($_SESSION['first']);
}

?>
!
</h1>


<style>
input[type=submit]{
  background-color: #ffcc00;
  border: none;
  color: #000000;
  text-decoration: none;
  margin: 4px 2px;
  text-transform: uppercase;
 }
</style>
</head>
<body>


<form action='searchAppointments.php' method='post' name='studentHome'>
<input type='submit' name='next' value="Search for An Appointment"><p>
</form>


<form action='viewAppointment.php' method='post' name='studentHome'>
<input type='submit' name='next' value="View My Appointment"><p>
</form>

<!-- EDITS BY KHADIJAH: Pre-Advising now says "get pre-advising worksheet" and downloads the worksheet pdf-->
<!-- This is most likely temporary and doesn't look good but it works -->

<form>
<button><a href="Pre-Registration Sheet-NEW 2012.pdf" download="Pre-Registration Sheet-NEW 2012">Get Pre-Advising Worksheet</a>
</button>
</form>

<form action='editInformation.php' method='post' name='studentHome'>
<input type='submit' name='next' value="Edit My Information"><p>
</form>


<form action='logout.php' method='post' name='studentHome'>
<input type='submit' name='next' value="Logout"><p>
</form>

</body>
</html>
