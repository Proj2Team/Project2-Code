<?php
#Sarah Yake-> NOT FINISHED
#Cancel Appointment (Student Side)
session_start();
include('CommonMethods.php');

$debug = true;
$COMMON = new Common($debug);

#given
$first = $_POST['fname'];
$last = $_POST['lname'];
$pref = $_POST['pname'];
$umbc_ID = $_POST['umbc_ID'];
$pass = $_POST['password'];
$email = $_POST['email'];

/*Not needed
$encrypted_pass = md5($pass);
$majors = $_POST['majors'];
$_SESSION['studentExists'] = false;
$_SESSION['confirmedPass'] = false;
$_SESSION['confirmedNewPass'] = false;
$_SESSION['umbcEmail'] = false;
*/

#Emails
#$CNMSEMAIL = "cnmsadvising@umbc.edu";
#testing...
$CNMSEMAIL = "syake1@umbc.edu";
$studentEmail = $email;
$advisorEmail;

#Names
$studentName = $first + " " + $last;
$advisorName;
$a_first;
$a_last;

#meeting info/ids
$day;
$time;
$meetingID;
$advisorID;
$apptID;
$sleader;

$subject = "Meeting Cancellation Pending";
$message = "";

# get meeting id
$sql = "SELECT appt_id FROM `students_basic_info` WHERE `umbc_ID` = '$umbc_ID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$apptID = mysql_fetch_object($rs);

# get session leader
$sql = "SELECT session_leader FROM `advisor_appts` WHERE `m_id` = '$apptID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$sleader = mysql_fetch_object($rs);

#get meeting info

# Assuming advisor exists, get advisor information
$sql = "SELECT * FROM `advisor_info` WHERE `id` = '$advisorID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$advisorRow = mysql_fetch_row($rs);

#get advisor name and email

#Send General Email to common email
$message = "Greetings!\n\n" + $studentName + " (" + $umbc_ID + ") wishes to cancel an advising meeting previously scheduled for " + $day + " at " 
+ $time + " with " + $advisorName + ". The email for " + $advisorName 
+ " is " + $advisorEmail + " .\n\nHave a great day!\n\nCNMS Advising Website-Bot"; 

#send email
mail($CNMSEMAIL, $subject, $message, "From:" . $CNMSEMAIL);
  
#Send Email to Advisor: Cancellation Request from student
$message = "Hi" + $advisorName + ",\n\n" + $studentName + " (" + $umbc_ID + ") wishes to cancel an advising meeting with you previously scheduled for " + day + " at " 
+ $time + ". The email for " + $studentName 
+ " is " + $studentEmail + " .\n\nHave a great day!\n\nCNMS Advising Website-Bot"; 

#send email
mail($advisorEmail, $subject, $message, "From:" . $CNMSEMAIL);

#Send Email to student: cancellation pending
$message = "Hi " + $pref + 
", \n\n You are cancelling a meeting with " + $advisorName + 
" on " + $day + " at " + $time + ". An email confirming your 
cancellation will be confirmed within the next few days. After 
your meeting has been sucessfully cancelled, please schedule a new 
meeting. \n\nHave a great day!\n\nCNMS Advising Website-Bot\n\nP.S. Please 
do not reply to this email. If you accidentally cancelled your meeting, please contact your advisor and/or CNMS advising ASAP.
\n\nCNMS Advising: " + $CNMSEMAIL + "\n Your Advisor's Email: " + $advisorEmail;

#send email
mail($studentEmail, $subject, $message, "From:" . $CNMSEMAIL);
?>