<?php
session_start();

date_default_timezone_set('EST');
$today = date("Y-m-d"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pick Date</title>
</head>
<body>
<form action='editAppts.php' method='post' name='formEdit'>
    <label> Select a date you would like to view: </label><br/>
    <input id='selectedDate' type='date' name='selectedDate' value='<?php echo $today; ?>'/><br/>
    <input type='submit' value='Select Date'>
</form>
</body>
</html>