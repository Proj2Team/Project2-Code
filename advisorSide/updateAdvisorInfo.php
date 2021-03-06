<?php
session_start();
include('../studentSide/CommonMethods.php');

$debug = true;
$COMMON = new Common($debug);

$_SESSION['first'] = $_POST['fname'];
$_SESSION['last'] = $_POST['lname'];
$_SESSION['username'] = $_POST['username'];
$_SESSION['pass'] = $_POST['pass'];
$_SESSION['confirmedPass'] = false;
$_SESSION['advisorExists'] = false;
$_SESSION['office'] = $_POST['office'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['majors'] = $_POST['majors'];

$first = $_SESSION['first'];
$last = $_SESSION['last'];
$user = $_SESSION['username'];
$pass = $_SESSION['pass'];
$encrypted_pass = md5($pass);
$office = $_SESSION['office'];
$email = $_SESSION['email'];
$majors = $_SESSION['majors'];
$advisorID = $_SESSION['advisorID'];

if ($_POST['pass'] == $_POST['confirmPass']) // correctly confirmed password
{
	$sql = "UPDATE `advisor_info` SET `username` = '$username', `password` = '$encrypted_pass', `lname` = '$last', `fname` = '$first', `office` = '$office', `email` = '$email' WHERE `id` = '$advisorID'";
	$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

	if ( isset($majors) ) {
		$sqlMajor = "UPDATE `advisors_majors` SET `bsci_BA` = '$majors[0]', `bsci_BS` = '$majors[1]', `bchem_BS` = '$majors[2]', `binf_BS` = '$majors[3]', `bsciEd_BA` = '$majors[4]', `chem_BA` = '$majors[5]', `chem_BS` = '$majors[6]', `chemEd_BA` = '$majors[7]' WHERE `id` = '$advisorID'";
		$rsMajor = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
	header('Location: advisorHome.php');
}
else // password confirmation failed
{
  $_SESSION['confirmedPass'] = true;
  header('Location: editAdvisorInfo.php');
}
?>