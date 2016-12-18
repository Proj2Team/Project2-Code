<?php
session_start();
include('../studentSide/CommonMethods.php');

$debug = true;
$COMMON = new Common($debug);

// Grab the changes made from the edit page
$m_id = $_POST['m_id'];
$date = $_POST['selectedDate'];
// convert to 24 hour format
$start_time = date("H:i", strtotime($_POST['start_time']));
$end_time = date("H:i", strtotime($_POST['end_time']));
$num_students = $_POST['num_students'];
$participants = $_POST['participants'];
$location = $_POST['location'];
$session_type = $_POST['session_type'];
$session_leader = $_POST['session_leader'];

$sql = "UPDATE `advisor_appts` SET `date` = '$date', `start_time` = '$start_time', `end_time` = '$end_time', `num_students` = '$num_students', `participants` = '$participants', `location` = '$location', `session_type` = '$session_type', `session_leader` = '$session_leader' WHERE `m_id` = '$m_id'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

// Now choose where to go
$from_view = $_POST['from_view'];
if ($from_view == "myView") { // Viewing all my appointments
	$headerLocation = 'Location: processViewAppts.php?myAppts=true';
} elseif ($from_view == "allView") { // Viewing all appointments
	$headerLocation = 'Location: processViewAppts.php';
} elseif ($from_view == "manageView") { // From manage filter
	$headerLocation = 'Location: manageStudents.php';
} elseif ($from_view == "editAppts") {
	$headerLocation = 'Location: editAppts.php?selectedDate=' . $date;
}

header($headerLocation);

?>