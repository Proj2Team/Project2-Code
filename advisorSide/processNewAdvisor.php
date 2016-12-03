<?php
//session_start();
include('../studentSide/CommonMethods.php');
include('createAdvisor.php');

$debug = true;
$COMMON = new Common($debug);

$new_fname = $_POST['fname'];
$new_lname = $_POST['lname'];
$new_username = $_POST['username'];
$new_pass = $_POST['pass'];
$encrypted_pass = md5($new_pass);
$_SESSION['confirmedPass'] = false;
$_SESSION['advisorExists'] = false;
$new_office = $_POST['office'];
$new_email = strtolower($_POST['email']);
$new_major = $_POST['majors'];

$sql = "SELECT * FROM `advisor_info` WHERE `username` = '$new_username' AND `lname` = '$new_lname' AND `fname` = '$new_fname'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

if ($_POST['pass'] == $_POST['confirmPass']) { // correctly confirmed password
  createAdvisor($new_fname, $new_lname, $new_username, $new_pass, $encrypted_pass, $new_office, $new_email, $new_major);
} elseif ($_POST['pass'] != $_POST['confirmPass']) { // password confirmation failed
  $_SESSION['confirmedPass'] = true;
  header('Location: advisorInfo.php');
} elseif ($row) { // advisor already exists
  $_SESSION['advisorExists'] = true;
  header('Location: advisorInfo.php');
}

?>