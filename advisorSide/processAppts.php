<?php
session_start();
var_dump($_POST);
include('../studentSide/CommonMethods.php');

$debug = true;
$COMMON = new Common($debug);

$date = $_POST['selectedDate'];
//$apptTimes = $_POST['apptTimes'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$numStudents = $_POST['numStudents'];
$location = $_POST['location'];
$session_type = $_POST['session_type'];

if ($session_type == "Group") {
  $session_type = 0;
} else {
  $session_type = 1;
}

$session_leader = $_POST['session_leader'];
//$locations = $_POST['locations'];
$email = $_SESSION['email'];

if ( isset($session_type) && isset($start_time) && isset($end_time) ) {
    # Query to get the id number of the advisor based on matching email
    $sql = "SELECT `id` FROM `advisor_info` WHERE `email` = '$email'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

    $row = mysql_fetch_row($rs);
    echo ("Id number is: " . $row['0'] . "<br/>");
    $id = $row['0'];

    # Query to see if day/advisor is already in database
    $sql = "SELECT * FROM `advisor_appts` WHERE `a_id` = '$id' AND `date` = '$date'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    $appt = mysql_fetch_row($rs);

    if ($appt) { // TODO
    	$_SESSION['apptExists'] = true;
    	$_SESSION['updateDate'] = $date;
    	header('Location: updateAppts.php');
    }
    // TODO: if advisor selects individual appt, and selectes over 1 students, check validation somehow
    $query = "INSERT INTO `advisor_appts`(`m_id`, `a_id`, `date`, `start_time`, `end_time`, `num_students`, `location`, `session_type`, `session_leader`) VALUES ('', '$id', '$date', '$start_time', '$end_time', '$numStudents', '$location', '$session_type', '$session_leader')";

    echo $query;
}

$rsAppt = $COMMON->executeQuery($query, $_SERVER["SCRIPT_NAME"]);
echo("Appointments saved.");
header('Location: advisorHome.php');
?>