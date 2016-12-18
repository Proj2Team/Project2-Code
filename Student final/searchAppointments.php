<?php
session_start();
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);
?>
<html>
<head>

<!--added title and linked to css-->
<title>Search Appointments</title>
<link rel="stylesheet" href="../studentstyles.css" type="text/css">

</head>
<body>
<form action='displayAppointments.php' method='post'>
<!-- UMBC ID: <input type='text' value='umbc_ID'> --> <!--Is this really necessary???-->
<br><br>

<?php


//by some error there is no user logged in, redirect
if(!isset($_SESSION['studentID']))
{
	header('Location: newLogin.php');
}

$sql = "SELECT * FROM students_basic_info WHERE `id` = $_SESSION[studentID]";

$rs = $COMMON-> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_assoc($rs);


//display message if student already has a meeting
if($row['appt_id'] != '') 
{
   echo("NOTE: YOU ALREADY HAVE A MEETING SCHEDULED.");
	echo('<br>');
   echo("You can search for appointments, but you cannot add a meeting until you cancel your current appointment");
   	echo('<p>');
}

?>


<!--EDIT BY KHADIJAH: Added default value for date to be today and a minimum so that a student-->
<!--cannot look at an appointment in the past.-->
Earliest Date:<br>
<input type='date' name='date' value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" placeholder='YYYY-MM-DD' />
<p>

<!--EDIT BY KHADIJAH: Instead of the checkboxes I put in a time for from and to. not sure how-->
<!--easy it'll be to implement (I'll be working on it) but it sure as heck looks neater than-->
<!--the huge list of checkboxes. It'll also won't allow times to be entered outside of specified time-->
Appointment Time:
<br>
From: <input type = 'time' name = 'fromTime' min = "08:00" max = "18:00" step = "1800" value="08:00" placeholder='HH:MM' required> 

To: <input type = 'time' name = 'toTime' min = "08:30" max = "18:30" step = "1800" value="18:30" placeholder='HH:MM' required><p>


Choose Meeting Type:
<br>
<!-- Change to radio buttons - Syake-->
<!--default checked-->
<input type='radio' name = 'appointment' value='all_appts' checked>All Appointments<br>
<input type='radio' name = 'appointment' value='indv_appts'>Individual Appointments<br>
<input type='radio' name = 'appointment' value='grp_appts'>Group Appointments<br>


<br><br>
<input type='submit' class = 'button' value='Go'>
</form>


<form action='homescreen.php' method='post'>
<input type='submit' class ='button' value='Back'>
</form>


</body>
</html>

