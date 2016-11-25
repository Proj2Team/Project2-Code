<?php
session_start();
include('../studentSide/CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

// get all info based on passed in m_id to set as placeholder
$m_id = $_POST['m_id'];
$sql = "SELECT * FROM `advisor_appts` WHERE `m_id` = '$m_id'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_assoc($rs);

$date = $row['date'];
$start_time = $row['start_time'];
$end_time = $row['end_time'];
$num_students = $row['num_students'];
$participants = $row['participants'];
$location = $row['location'];
$session_type = $row['session_type'];
$session_leader = $row['session_leader'];
?>
<html>
  <head>
    <title>Edit Appointment Information</title>
    <link rel="stylesheet" href="../styles.css" type="text/css">
  </head>
  <body>
    <form action='processMadeAppt.php' method='post' name='formUpdateAppt'>
      <fieldset class='group'>
        <legend><caption><label for='selectedDate'>Edit Appointment</label></caption></legend>
        <input type="hidden" name="m_id" value="<?php echo $m_id; ?>">
        <span>Select Appointment Start Time (Hour - Minute - AM/PM): </span><input type="time" name="start_time" value="<?php echo $start_time; ?>"><br/>
        <span>Select Appointment End Time (Hour - Minute - AM/PM): </span><input type="time" name="end_time" value="<?php echo $end_time; ?>"><br/>
        <span>Number of Students Capacity (1-40): </span><input type="number" name="num_students" min="1" max="40" value="<?php echo $num_students; ?>"><br/>
        <span>Location (Optional): </span><input type="text" name="location" value="<?php echo $location; ?>"><br/>
        <span>Session Type: </span><br/>
        <input type="radio" name="session_type" value="Group"<?php if ($session_type == 0) { echo " checked"; } ?>> Group <br/>
        <input type="radio" name="session_type" value="Individul"<?php if ($session_type == 1) { echo " checked"; } ?>> Individual <br/>
        <span>Session Leader: </span><br/>
        <select name="session_leader">
          <option value="Michelle Bulger"<?php if ($session_leader == "Michelle Bulger") { echo " selected"; } ?>>Ms. Michelle Bulger</option>
          <option value="Julie Crosby"<?php if ($session_leader == "Julie Crosby") { echo " selected"; } ?>>Mrs. Julie Crosby</option>
          <option value="Christine Powers"<?php if ($session_leader == "Christine Powers") { echo " selected"; } ?>>Ms. Christine Powers</option>
          <option value="CNMS Advisors"<?php if ($session_leader == "CNMS Advisors") { echo " selected"; } ?>>CNMS Advisors</option>
        </select><br/>
        <input class="button" type='submit' value='Save Appointment'>
      </fieldset><br/><br/>
    </form>
  </body>
</html>