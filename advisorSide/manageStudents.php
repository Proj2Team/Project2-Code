<?php
session_start();
?>
<html>
	<head>
		<title>Manage Students</title>
		<link rel="stylesheet" href="../styles.css" type="text/css">
		<style type="text/css">
			.button-parent input {
				width: 18em;
			}
		</style>
	</head>
	<body>
		<h3 class="medium-title">Please select a method of finding students</h3><br/>
		<form class="button-parent" action='processStudentSearch.php' method='post' name='searchStudent'>
			<h3 class="small-title">Search by UMBC ID:</h3>
			<input class="large-input clean-text-input" type='text' name='s_id' placeholder="UMBC ID"/><br/>
			<input type='submit' name='searchStudent' value='Search for a student'><br/>
	    </form><br/>
	    <form class="button-parent" action='processStudentFilter.php' method='post' name='searchStudent'>
			<h3 class="small-title" style="margin-bottom: 0;">View all students who have an appointment with:</h3>
			<input type='submit' name='searchType' value='Any Advisor'><br/>
			<input type='submit' name='searchType' value='Have not yet signed up'><br/>
	    </form>
	    <form action="advisorHome.php" method="post" name="backHome">
			<input class="button" type='submit' value='Back to Dashboard'>
		</form>
	</body>
</html>