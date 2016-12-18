<?php
session_start();
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);

//FILE: cancelMeeting.php Main Programmer: Khadijah Wali 
//this is a behind-the-scenes worker page.
//it edits the databases accordingly so that the student
//is no longer associated with a meeting and the number
//of participants of the meeting is decremented
//it then redirects back to homescreen, where the student
//will see they no longer have a meeting scheduled.


//by some error there is no user logged in, redirect
if(!isset($_SESSION['studentID']))
{
	header('Location: newLogin.php');
}
else{

$studentID = $_SESSION['studentID'];

//fetch meeting id from stduent
$sql = "SELECT * FROM students_basic_info WHERE `id` = '$_SESSION[studentID]'";

$rs = $COMMON-> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_assoc($rs);

$meeting = $row['appt_id'];

//get information to compare date and time
$sql = "SELECT * FROM advisor_appts WHERE `m_ID` = '$meeting'";

$rs = $COMMON-> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_assoc($rs);

$currentDate = date('Y-m-d');
$currentHour = date('H');

//don't let student cancel appointment if it's less than 12 hours away
if($row['date'] == $currentDate && ($row['start_time'] - $currentHour) < 12){

 echo('ERROR: Your appointment is less than 12 hours away. It is too close to the specified time to cancel this meeting');

echo('<form action=\'homescreen.php\' method=\'post\'>');
echo('<input type=\'submit\' value=\'Go Back\'>');
echo('</form>');
}

else{

//remove meeting id from stduent
$sql = "UPDATE students_basic_info SET `appt_id` = NULL WHERE `id` = '$studentID'";

$rs = $COMMON-> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

//decrement the number of participants of the meeting to -1
$sql = "UPDATE advisor_appts SET `participants` = `participants`-1 WHERE `m_ID` = '$meeting'";
	
$rs = $COMMON-> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

header('Location: homescreen.php');
}

}

?>