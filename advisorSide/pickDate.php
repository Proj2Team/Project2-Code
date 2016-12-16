<?php
session_start();

date_default_timezone_set('EST');
$today = date("Y-m-d"); ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Pick Date</title>
		<link rel="stylesheet" href="../styles.css" type="text/css">
	</head>
	<body>
		<form action='editAppts.php' method='post' name='formEdit'>
		    <h3 class="medium-title"> Select a date you would like to view: </h3>
		    <input class="large-input" style="margin-bottom: 0.8em;" id='selectedDate' type='date' name='selectedDate' value='<?php echo $today; ?>' placeholder="YYYY-MM-DD"/><br/>
		    <input class="large-input" type="checkbox" name="weekView" value="week"><span>Weekly View</span><br/>
		    <input class="button" type='submit' value='Select Date'>
		</form>
		<form action="advisorHome.php" method="post" name="backHome">
			<input class="button" type='submit' value='Back to Dashboard'>
		</form>
	</body>
</html>