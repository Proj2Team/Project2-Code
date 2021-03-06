<?php
session_start();
$email = $_SESSION['email'];
date_default_timezone_set('EST');
$today = date("Y-m-d");
?>
<html>
	<head>
		<title>View All Appointments</title>
		<link rel="stylesheet" href="../styles.css" type="text/css">
	</head>
	<body>
		<form action='processViewAppts.php' method='post' name='ViewAppts'>
			<h3 class="medium-title"> Your Schedule For: </h3>
			<input class="large-input" id='selectedDate' type='date' name='selectedDate' value='<?php echo $today; ?>' min='<?php echo $today; ?>' placeholder="YYYY-MM-DD"/><br/>
			<input class="button" type='submit' value='Select Date'>
		</form>
		<form action="advisorHome.php" method="post" name="backHome">
			<input class="button" type='submit' value='Back to Dashboard'>
		</form>
	</body>
</html>