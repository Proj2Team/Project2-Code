<?php
session_start();
#var_dump($_POST);
include('../studentSide/CommonMethods.php');

$debug = true;
$COMMON = new Common($debug);

$date = $_POST['selectedDate'];
// convert to 24 hour format
$start_time = date("H:i", strtotime($_POST['start_time']));
$end_time = date("H:i", strtotime($_POST['end_time']));
$numStudents = $_POST['numStudents'];
$location = $_POST['location'];
$session_type = $_POST['session_type'];
$can_signup = $_POST['can_signup'];

if ($session_type == "Group") {
  $session_type = 0;
} else {
  $session_type = 1;
}

if ($can_signup == "true") {
    $can_signup = 1;
} else {
    $can_signup = 0;
}

$session_leader = $_POST['session_leader'];
$email = $_SESSION['email'];

if ( isset($session_type) && isset($start_time) && isset($end_time) ) {
    # Query to get the id number of the advisor based on matching email
    $sql = "SELECT `id` FROM `advisor_info` WHERE `email` = '$email'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    $row = mysql_fetch_row($rs);

    $id = $row['0'];

    // TODO: if advisor selects individual appt, and selectes over 1 students, check validation somehow
    $query = "INSERT INTO `advisor_appts`(`m_id`, `a_id`, `date`, `start_time`, `end_time`, `num_students`, `participants`, `location`, `session_type`, `session_leader`, `available_for_signup`) VALUES ('', '$id', '$date', '$start_time', '$end_time', '$numStudents', '0', '$location', '$session_type', '$session_leader', '$can_signup')";

    echo $query;
}

$rsAppt = $COMMON->executeQuery($query, $_SERVER["SCRIPT_NAME"]);

$headerLocation = 'Location: editAppts.php?selectedDate=' . $date;
header($headerLocation);
?>