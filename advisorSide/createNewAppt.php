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
	    <span>Select Appointment Start Time (Hour:Minute AM/PM): </span><input type="time" name="start_time"><br/>
	    <span>Select Appointment End Time (Hour:Minute AM/PM): </span><input type="time" name="end_time"><br/>
	    <span>Number of Students Capacity (1-40): </span><input type="number" name="numStudents" min="1" max="40" value="1"><br/>
	    <span>Location (Optional): </span><input type="text" name="location"><br/>
	    <span>Session Type: </span><br/>
	    <input type="radio" name="session_type" value="Group" checked> Group <br/>
	    <input type="radio" name="session_type" value="Individul"> Individual <br/>
	    <span>Session Leader: </span><br/>
	    <select name="session_leader">
	      <?php
	      	// Generate all options based on array of advisors, so that it is easily changed
	      	// $advisors is echoed in the value attribute
	      	$advisors = array("Michelle Bulger", "Julie Crosby", "Christine Powers", "CNMS Advisors");
	      	// $advisor name is echoed in the actual drop down, aka what the user will see
	      	$advisor_name = array("Ms. Michelle Bulger", "Mrs. Julie Crosby", "Ms. Christine Powers", "CNMS Advisors");
	      	 $i = 0; ?>
	      	<option value="<?php echo $advisors[$i]; ?>" selected><?php echo $advisor_name[$i]; ?></option>
	      	<?php $i++;
	      	while ($i < sizeof($advisors)) { ?>
				<option value="<?php echo $advisors[$i]; ?>"><?php echo $advisor_name[$i]; ?></option>
			<?php $i++;
			}
	      ?>
	    </select><br/>
	    <input class="button" type='submit' value='Save Appointments'>
	  </fieldset><br/><br/>
	</form>
	<form action='editAppts.php' method='post' name='formEdit'>
        <input id='selectedDate' type='hidden' name='selectedDate' value='<?php echo $date; ?>'/><br/>
        <input class="button" type='submit' value='Back to Appointment View'>
    </form>
	<form action="advisorHome.php" method="post" name="backHome">
      <input class="button" type='submit' value='Back to Dashboard'>
    </form>
</body>
</html>