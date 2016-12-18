<?php
session_start();
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);
echo('<link rel="stylesheet" href="../studentstyles.css" type="text/css">');

//File: displayAppointments.php Main programmer: Khadijah Wali (Andrew also helped a lot)
//searchAppointments.php redirects to this page. It takes the search
//criteria defined in searchAppointments and constructs a query to 
//the database. It displays all the availiable appointments that 
//fit in the criteria If the student is not currently signed up 
//for an appointment, it displays a sign up button which redirects 
//to meetingAdd.php if the student DOES have a appointment they are
// signed up for, it only displays meeting information
//but does not allow the student to sign up for a meeting until they cancel
//the meeting they are currently assigned to


//by some error there is no user logged in, redirect
if(!isset($_SESSION['studentID']))
{
	//header('Location: newLogin.php');
}

$sql = "SELECT * FROM students_basic_info WHERE `id` = $_SESSION[studentID]";

$rs = $COMMON-> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_assoc($rs);

//check to see if student already has appointment. If they do, don't display sign up button
if($row['appt_id'] == NULL) 
{
   $signup = true;
}
else{
$signup = false;
}


echo('These are the available appointments with your search terms:');
echo('<p>');

//collect data from form
$insertDate = $_POST['date'];
$insertFromTime = date('H:i:s', strtotime($_POST['fromTime']));
$insertToTime = date('H:i:s', strtotime($_POST['toTime']));

$insertType = $_POST['appointment'];

if($insertType == 'all_appts'){

//sql query to catch all meetings between that time and from the date forward
$sql = "SELECT * FROM advisor_appts WHERE `start_time` >= '$insertFromTime' AND `end_time` <= '$insertToTime' AND `date` >= '$insertDate ' AND `participants` < `num_students` AND `available_for_signup` = 1";

}
elseif($insertType == 'indv_appts'){

//sql query to catch all meetings between that time and from the date forward AND specifies group type
$sql = "SELECT * FROM advisor_appts WHERE `start_time` >= '$insertFromTime' AND `end_time` <= '$insertToTime' AND `session_type`= 1 AND `date` >= '$insertDate' AND `participants` < `num_students`";


}
elseif($insertType == 'grp_appts'){

//sql query to catch all meetings between that time and from the date forward AND specifies group type
$sql = "SELECT * FROM advisor_appts WHERE `start_time` >= '$insertFromTime' AND `end_time` <= '$insertToTime' AND `session_type`= 0 AND `date` >= '$insertDate'  AND `participants` < `num_students`";

}
else{
//if a group type is not specified the user must have gotten to this page by some redirect error. Redirect them to the homepage
    header('Location: homescreen.php');
}

$rs = $COMMON-> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_assoc($rs);

if($row == '') 
{
//display message if no meetings found that fit search criteria
   echo("No meetings found!");
}

while($row)
{
//else, display relevant information about appointment
	echo('Day and Time: ' . $row['date'] .' ' . $row['start_time'] . '-' . $row['end_time'] . '<br>');
	echo('Advisor: ' . $row['session_leader'] . '<br>');

	echo('Meeting Type: ');
	if($row['session_type'] == 0)
		echo( 'Group' . '<br>');
	elseif($row['session_type'] == 1)
		echo('Individual' . '<br>');

//only give sign up button if student does not currently have a meeting they signed up for
if($signup){

	echo('<form action=\'meetingAdd.php\' method=\'post\'>');
  echo('<input name = \'meeting\' type = \'hidden\' value = \'' . $row['m_id'] . '\'>');
  echo('<input name = \'Sign Up\' type = \'submit\' value =\'Sign Up\' class=\'button\'>');
  echo('</form>');
  echo('<p>');
}

	echo('<p>');

	$row = mysql_fetch_assoc($rs);

}

echo('<form action=\'searchAppointments.php\' method=\'post\'>');
echo('<input type=\'submit\' value=\'Back\' class=\'button\'>');
echo('</form>');


?>