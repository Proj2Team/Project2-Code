<?php
session_start();
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);
?>

<html>
<head>
<title>Student Homepage</title>
<link rel="stylesheet" href="../studentstyles.css" type="text/css">
<!-- EDITS BY KHADIJAH: edit so it prints out the student's name as a header. It will print out-->
<!-- preferred name if they have one, but if not it prints out their first name -->

<h1>
Welcome 
<?php

if($_SESSION['pref'] != '')
{
  echo($_SESSION['pref']);
}
elseif($_SESSION['first'] != '')
{
echo($_SESSION['first']);
}
else{
	//checks to see if there's a student at all! If not redirects to login page
   header('Location: newLogin.php');
}
 echo('!');
echo('</h1>');

 echo('<p>');

$sql = "SELECT * FROM students_basic_info WHERE `id` = '$_SESSION[studentID]'";

$rs = $COMMON-> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_assoc($rs);

//by some error there is no user logged in, redirect
if(!$row)
{
	header('Location: newLogin.php');
}

//display message according to whether or not they have signed up for a meeting
if($row['appt_id'] == '') 
{
   echo("You have not yet signed up for a meeting");
}
else{


 echo('Your appointment:');
 echo('<br>');

$sql = "SELECT * FROM advisor_appts WHERE `m_id` = $row[appt_id]";

$rs = $COMMON-> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_assoc($rs);

	echo('Day and Time: ' . $row['date'] .' ' . $row['start_time'] . '-' . $row['end_time'] . '<br>');
	echo('Advisor: ' . $row['session_leader'] . '<br>');

	echo('Meeting Type: ');
	if($row['session_type'] == 0)
		echo( 'Group' . '<br>');
	elseif($row['session_type'] == 1)
		echo('Individual' . '<br>');


echo('<form action=\'cancelMeeting.php\' method=\'post\' name=\'studentHome\'>');
echo('<input type=\'submit\' class = \'button\' name=\'cancel\' value=\'Cancel Meeting\'><p>');
echo('</form>');

}


?>





</head>
<body>


<form action='searchAppointments.php' method='post' name='studentHome'>
<input type='submit' name='next' value="Search for An Appointment" class = 'button'><p>
</form>

<!-- EDITS BY KHADIJAH: Pre-Advising now says "get pre-advising worksheet" and downloads the worksheet pdf-->
<!-- This is most likely temporary and doesn't look good but it works -->

<form>
<button class = 'button'><a href="Pre-Registration Sheet-NEW 2012.pdf" download="Pre-Registration Sheet-NEW 2012">Get Pre-Advising Worksheet</a>
</button>
</form>

<form action='editInformation.php' method='post' name='studentHome'>
<input type='submit' name='next' value="Edit My Information" class = 'button'><p>
</form>


<form action='logout.php' method='post' name='studentHome'>
<input type='submit' name='next' value="Logout" class = 'button'><p>
</form>

</body>
</html>
