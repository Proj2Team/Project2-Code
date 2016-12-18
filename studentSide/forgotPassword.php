<?php
session_start();

//File: forgotPassword Main programmer: Khadijah Wali
//This file handles if a student forgot their password
//it asks for their email and if their email is for an
//account that exists, it sends the student an email
//which provides a link that allows them to reset their
//password

?>
<html>
<head>
<title>Restart Password</title>
</head>
<body>

<?php
if(isset($_SESSION['emailExists'])){
if($_SESSION['emailExists'] == true){
echo('Email not found.');
echo('<br>');
echo('Are you sure you have already made an account?');
echo('<br>');
echo('<a href = \'registerStudent.php\'>');
echo('Go here to create an account');
echo('</a>');
}
}
?>

<form action='resetPassword.php' method='post' name='studentLogin'>

Enter Email:<br>
<input type='email' name='email' placeholder = 'jDoe@umbc.edu' required><p>

<input type='submit' value='Reset Password' name='resetButton'>
</form>

<form action='newLogin.php' method='post'>
<input type='submit' value='Back'>
</form>


</body>