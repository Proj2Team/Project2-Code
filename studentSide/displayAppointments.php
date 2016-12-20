<?php
session_start();
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);
echo('<link rel="stylesheet" href="studentstyles.css" type="text/css">');

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


echo('<h3 class="medium-title">These are the available appointments with your search terms:</h3>');
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

if($row == '')
{
//display message if no meetings found that fit search criteria
   echo("No meetings found!");
}

echo("<table class='table' border='1px'>");
echo("<tr><th>Session Leader</th><th>Start Time</th><th>End Time</th><th>Session Type</th><th>Location</th><th></th></tr>");
while ( $row = mysql_fetch_assoc($rs) ) {
echo("<tr>\n");
  echo("<td>".$row['session_leader']."</td>\n");
  echo("<td>".date("g:i a", strtotime($row['start_time']))."</td>\n");
  echo("<td>".date("g:i a", strtotime($row['end_time']))."</td>\n");
  if ($row['session_type'] == 0) { $sessType = "Group";}
  else {$sessType = "Individual";}
  echo ("<td>".$sessType."</td>\n");
  if ($row['location'] == '') {
  	echo ("<td>TBA</td>\n");
  } else {
    echo ("<td>".$row['location']."</td>\n");
  }
  echo "<td>\n";
  if ($signup) {
      echo "<form class='form-fill' action='meetingAdd.php' method='post' name='formEditMadeAppt'>\n";
      echo "<input type='hidden' name='meeting' value='".$row['m_id']."'>\n";
      echo "<input class='edit-button' name='Sign Up' type='submit' value='Sign Up'>\n";
      echo "</form>\n";
  }
  echo "</td>\n";
echo("</tr>\n");
}
echo "</table>";

echo('<form action=\'searchAppointments.php\' method=\'post\'>');
echo('<input type=\'submit\' value=\'Back\' class=\'button\'>');
echo('</form>');


?>