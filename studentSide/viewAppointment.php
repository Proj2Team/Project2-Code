<html>
<head>
<title>View My Appointment</title>
<link rel="stylesheet" href="../styles.css" type="text/css">
</head>
<body id='student'>
This webpage is currently UNDER CONSTRUCTION.
<form action='homescreen.php' method='post' name='editStudent'>
    <input type='submit' value='Back to Home'>
</form><p>
<?php
session_start();
$debug = true;
include('CommonMethods.php');
$COMMON = new Common($debug);
echo "<div>";
$studId = $_SESSION['umbc_ID'];
$sql = "SELECT `appt_id` FROM `student_basic_info` WHERE `umbc_ID`=$studId";

$rs = $COMMON-> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);  

$apptID = $rs;
if($apptID == NULL)
{
	echo "You do not currently have an advising appoinment scheduled.";
}
else
{
	echo "Your Scheduled Appointment: \n";
	echo "(appointment details listed.)";
}
echo "</div>";
?>

</body>
</html>