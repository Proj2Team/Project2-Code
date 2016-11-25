<?php
session_start();
$date = $_POST['date'];
date_default_timezone_set('EST');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create New Appointment</title>
	<link rel="stylesheet" href="../styles.css" type="text/css">
</head>
<body>
	<form action='processAppts.php' method='post' name='formEdit'>
	  <fieldset class='group'>
	    <legend><caption><label for='selectedDate'> Creating Appointment for <?php echo date("l Y-m-d", strtotime($date)); ?> </label></caption></legend>
	    <input name='selectedDate' type='hidden' value='<?php echo $date; ?>'/>
	    <span>Select Appointment Start Time (Hour - Minute - AM/PM): </span><input type="time" name="start_time"><br/>
	    <span>Select Appointment End Time (Hour - Minute - AM/PM): </span><input type="time" name="end_time"><br/>
	    <span>Number of Students Capacity (1-40): </span><input type="number" name="numStudents" min="1" max="40" value="1"><br/>
	    <span>Location (Optional): </span><input type="text" name="location"><br/>
	    <span>Session Type: </span><br/>
	    <input type="radio" name="session_type" value="Group" checked> Group <br/>
	    <input type="radio" name="session_type" value="Individul"> Individual <br/>
	    <span>Session Leader: </span><br/>
	    <select name="session_leader">
	      <option value="Michelle Bulger" selected>Ms. Michelle Bulger</option>
	      <option value="Julie Crosby">Mrs. Julie Crosby</option>
	      <option value="Christine Powers">Ms. Christine Powers</option>
	      <option value="CNMS Advisors">CNMS Advisors</option>
	    </select><br/>
	    <input class="button" type='submit' value='Save Appointments'>
	  </fieldset><br/><br/>
	</form>
</body>
</html>