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
<link rel="stylesheet" href="../studentstyles.css" type="text/css">
</head>
<body>
<center>

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

<form class="center-form form-clean space-children-input text-center-input" action='resetPassword.php' method='post' name='studentLogin'>

Enter Email:<br>
<input type='email' name='email' placeholder = 'jDoe@umbc.edu' required><p>

<input type='submit' value='Reset Password' name='resetButton' class='button'>
</form>

<form action='newLogin.php' method='post'>
<input type='submit' value='Back' class='button'>
</form>
</center>

</body>