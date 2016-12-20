<?php
session_start();
?>
<html>
	<head>
		<title>Appointment Search</title>
		<link rel="stylesheet" href="../styles.css" type="text/css">
		<style type="text/css">
			.button-parent input {
				width: 18em;
			}
		</style>
	</head>
	<body>
		<h3 class="medium-title">How would you like to filter your appointment search?</h3>
	    <form class="button-parent" action='processSearch.php' method='post' name='searchGroup'>
			<input type='submit' name='searchType' value='My Upcoming Open'><br/>
			<input type='submit' name='searchType' value='All Upcoming Open'><br/>
			<input type='submit' name='searchType' value='My Upcoming Full'><br/>
			<input type='submit' name='searchType' value='All Upcoming Full'><br/>
			<input type='submit' name='searchType' value='All Appointments (All Time)'><br/>
	    </form>
	    <form action="advisorHome.php" method="post" name="backHome">
			<input class="button" type='submit' value='Back to Dashboard'>
		</form>
	</body>
</html>