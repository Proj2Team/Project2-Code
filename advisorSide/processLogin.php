<?php
session_start();
$debug = false;
include('../studentSide/CommonMethods.php');
$COMMON = new Common($debug);

$_SESSION['email'] = strtolower($_POST['email']);
$_SESSION['pass'] = $_POST['pass'];
$_SESSION['userValue'] = false;

$email = $_SESSION['email'];
$pass = $_SESSION['pass'];
$encrypted_pass = md5($pass);

$sql = "SELECT * FROM `advisor_info` WHERE `email` = '$email' AND `password` = '$encrypted_pass'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_assoc($rs);

if ($row) {
  $_SESSION['username'] = $row['username'];
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