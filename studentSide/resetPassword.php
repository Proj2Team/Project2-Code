<?php
session_start();
$debug = false;
include('CommonMethods.php');
$COMMON = new Common($debug);

//File: resetPassword Main programmer: Khadijah Wali
//this file comes from forgotPassword
//it sends the student an email with a link that allows
//them to set a new password




$type = $_POST['resetButton'];

if($type == 'Reset Password'){ 


$_SESSION['confirmedPass'] = false;

$_SESSION['email'] = $_POST['email'];

$sql = "SELECT * FROM students_basic_info WHERE `email` = '$_SESSION[email]'";

$rs = $COMMON-> executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_assoc($rs);

if(!$row){
	$_SESSION['emailExists'] = true;

	header('Location: forgotPassword.php');
}
else{

	$email = $_POST['email'];

	$_SESSION['email'] = $email;

	$subject = $row['fname'] . '-Reset your Password';

	$body = 'We have been notified that you wanted to reset your password. If you did not request this, ignore this message.\n' . 'If you did request this, please click this link to reset your password.\n' . 'https://swe.umbc.edu/~kwali2/CMSC331/phpCode/Project%202/studentSide/studentReset.php';

	$status = mail($email,$subject,$body);

echo('<a href=\'https://swe.umbc.edu/~kwali2/CMSC331/phpCode/Project%202/studentSide/studentReset.php\'> Link </a>');
echo('<br>');	

	echo('A message has been sent to your email. Please check your inbox and reset your password.');


}
}


if($type == 'Set Password'){

$pass = $_POST['password'];
$encrypted_pass = md5($pass);

if($_POST['password'] != $_POST['confirmPass'])
  {
    $_SESSION['confirmedPass'] = true;
    header('Location: studentReset.php');
  }
else{

 $sql = "UPDATE `students_basic_info` SET `password`= '$encrypted_pass' WHERE `email`='$_SESSION[email]'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

    header('Location: newLogin.php');

}

}
 
?>