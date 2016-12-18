<?php
session_start();
$debug = true;
include('CommonMethods.php');
$COMMON = new Common($debug);

//FILE: meetingAdd.php Main Programmer: Khadijah Wali (Andrew McLamb also helped a lot)
//the user never should see this page, it simply performes the queries required to edit
//information in the database to assign a meeting to a student. Students are directed
//to this page from displayAppointments when they hit the sign up button for a meeting


//by some error there is no user logged in, redirect
if(!isset($_SESSION['studentID']))
{
	header('Location: newLogin.php');
}

$studentID = $_SESSION['studentID'];
$meeting = $_POST['meeting']; //this post comes from a hidden html field which contains the meeting id

//assign meeting id to a student
$sql = "UPDATE students_basic_info SET `appt_ID` = '$meeting' WHERE `id` = '$studentID'";
	
$rs = $COMMON-> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

//increment the number of participants of the meeting to +1
$sql = "UPDATE advisor_appts SET `participants` = `participants`+1 WHERE `m_ID` = '$meeting'";
	
$rs = $COMMON-> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

//return to homepage
    header('Location: homescreen.php');

?>