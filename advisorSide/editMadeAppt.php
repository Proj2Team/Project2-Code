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
        <input id='selectedDate' type='hidden' name='selectedDate' value='<?php echo $date; ?>'/>
        <span>Select Appointment Start Time (Hour:Minute - AM/PM): </span><input type="text" name="start_time" value="<?php echo date("h:i A", strtotime($start_time)); ?>" placeholder="HR:MN AM/PM" required><br/>
        <span>Select Appointment End Time (Hour:Minute - AM/PM): </span><input type="text" name="end_time" value="<?php echo date("h:i A", strtotime($end_time)); ?>" placeholder="HR:MN AM/PM" required><br/>
        <span>Number of Students Capacity (1-40): </span><input type="number" name="num_students" min="1" max="40" value="<?php echo $num_students; ?>" required><br/>
        <span>Location (Optional): </span><input type="text" name="location" value="<?php echo $location; ?>"><br/>
        <span>Session Type: </span><br/>
        <input type="radio" name="session_type" value="Group"<?php if ($session_type == 0) { echo " checked"; } ?> required> Group <br/>
        <input type="radio" name="session_type" value="Individul"<?php if ($session_type == 1) { echo " checked"; } ?>> Individual <br/>
        <span>Session Leader: </span><br/>
        <select name="session_leader">
          <?php
          // Generate all options based on array of advisors, so that it is easily changed
          // $advisors is echoed in the value attribute
          $advisors = array("Michelle Bulger", "Julie Crosby", "Christine Powers", "CNMS Advisors");
          // $advisor name is echoed in the actual drop down, aka what the user will see
          $advisor_name = array("Ms. Michelle Bulger", "Mrs. Julie Crosby", "Ms. Christine Powers", "CNMS Advisors");
          $i = 0;
          while ($i < sizeof($advisors)) { ?>
            <option value="<?php echo $advisors[$i]; ?>" <?php if ($session_leader == $advisors[$i]) { echo " selected"; } ?>><?php echo $advisor_name[$i]; ?></option>
          <?php $i++;
          } ?>
        </select><br/>
        <input class="button" type='submit' value='Save Appointment'>
      </fieldset><br/><br/>
    </form>
    <form action='editAppts.php' method='post' name='formEdit'>
        <input id='selectedDate' type='hidden' name='selectedDate' value='<?php echo $date; ?>'/>
        <input class="button" type='submit' value='Back to Appointment View'>
    </form>
    <form action="advisorHome.php" method="post" name="backHome">
      <input class="button" type='submit' value='Back to Dashboard'>
    </form>
  </body>
</html>