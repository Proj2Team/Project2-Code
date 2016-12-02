<?php
session_start();
$debug = false;
include('../studentSide/CommonMethods.php');
$COMMON = new Common($debug);

$_SESSION['username'] = ($_POST['username']);
$_SESSION['pass'] = ($_POST['pass']);
$_SESSION['userValue'] = false;

$user = $_SESSION['username'];
$pass = $_SESSION['pass'];
$encrypted_pass = md5($pass);

$sql = "SELECT * FROM `advisor_info` WHERE `username` = '$user' AND `password` = '$encrypted_pass'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_assoc($rs);

if ($row) {
  $advisorID = $row['id'];
  $last = $row['lname'];
  $first = $row['fname'];
  $office = $row['office'];
  $email = $row['email'];
  $_SESSION['advisorID'] = $advisorID;
  $_SESSION['last'] = $last;
  $_SESSION['first'] = $first;
  $_SESSION['office'] = $office;
  $_SESSION['email'] = $email;
  header('Location: advisorHome.php');
} else {
  $_SESSION['userValue'] = true;
  header('Location: login.php');
}

?>