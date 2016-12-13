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

// Generate table of students for given appointment ID, and give option to kick students off
function getStudents($m_id) {
global $debug; global $COMMON;
$sql = "SELECT * FROM `students_basic_info` WHERE `appt_id` = '$m_id'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  echo "<h3 class='medium-title'>Registered Students</h3>";
  echo("<table class='table' border='1px'>");
  echo("<tr><th>First Name</th><th>Last Name</th><th>Preferred Name</th><th>Email</th><th>UMBC ID</th><th>Major(s)</th><th></th></tr>");
  while ( $row = mysql_fetch_assoc($rs) ) {
    echo("<tr>\n");
      echo("<td>".$row['fname']."</td>\n");
      echo ("<td>".$row['lname']."</td>\n");
      echo("<td>".$row['pname']."</td>\n");
      echo("<td>".$row['email']."</td>\n");
      echo ("<td>".$row['umbc_ID']."</td>\n");
      echo "<td>";
      if ($row['bio_ba'] == 1) { echo "Biological Sciences BA<br/>\n"; }
      if ($row['bio_bs'] == 1) { echo "Biological Sciences BS<br/>\n"; }
      if ($row['biochem_bs'] == 1) { echo "Biochemistry & Molecular Biology BS<br/>\n"; }
      if ($row['bioinfo_bs'] == 1) { echo "Bioinformatics & Computational Biology BS<br/>\n"; }
      if ($row['bioedu_ba'] == 1) { echo "Biology Education BA<br/>\n"; }
      if ($row['chem_ba'] == 1) { echo "Chemistry BA<br/>\n"; }
      if ($row['chem_bs'] == 1) { echo "Chemistry BS<br/>\n"; }
      if ($row['chemedu_ba'] == 1) { echo "Chemistry Education BA"; }
      echo "</td>\n";
      echo "<td><form class='form-fill' action='removeStudentAppt.php' method='post' name='formEditMadeAppt'>\n";
      echo "<input type='hidden' name='m_id' value='".$m_id."'>\n";
      echo "<input type='hidden' name='s_id' value='".$row['id']."'>\n";
      echo "<input class='edit-button' type='submit' value='Remove'>\n";
      echo "</form></td>\n";
    echo("</tr>\n");
  }
  echo "</table>";
  return $row;
}
?>
<html>
  <head>
    <title>Edit Appointment Information</title>
    <link rel="stylesheet" href="../styles.css" type="text/css">
  </head>
  <body>
    <form class="center-form-large form-clean space-children-input text-center-input" action='processMadeAppt.php' method='post' name='formUpdateAppt'>
      <h3 class="medium-title">Edit Appointment on <?php echo date("l F m, Y", strtotime($date)); ?></h3>
      <input type="hidden" name="m_id" value="<?php echo $m_id; ?>">
      <input id='selectedDate' type='hidden' name='selectedDate' value='<?php echo $date; ?>'/>
      <span class="medium-header">Select Appointment Start Time (Hour:Minute AM/PM): </span><br/>
      <input type="text" name="start_time" value="<?php echo date("h:i A", strtotime($start_time)); ?>" placeholder="HR:MN AM/PM" required><br/>
      <span class="medium-header">Select Appointment End Time (Hour:Minute AM/PM): </span><br/>
      <input type="text" name="end_time" value="<?php echo date("h:i A", strtotime($end_time)); ?>" placeholder="HR:MN AM/PM" required><br/>
      <span class="medium-header">Number of Students Capacity (1-40): </span><br/>
      <input type="number" name="num_students" min="1" max="40" value="<?php echo $num_students; ?>" required><br/>
      <span class="medium-header">Location (Optional): </span><br/>
      <input type="text" name="location" value="<?php echo $location; ?>"><br/>
      <span class="medium-header">Session Type: </span><br/>
      <div class="wrap-align-left-small">
        <input class="form-clean-disable" type="radio" name="session_type" value="Group"<?php if ($session_type == 0) { echo " checked"; } ?> required><span class="medium-header">Group</span><br/>
        <input class="form-clean-disable" type="radio" name="session_type" value="Individul"<?php if ($session_type == 1) { echo " checked"; } ?>><span class="medium-header">Individual</span><br/>
      </div><br/>
      <span class="medium-header">Session Leader: </span><br/>
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
      </select><br/><br/>
      <input class="button" type='submit' value='Save Appointment'><br/>
    </form>
    <?php getStudents($m_id);
    // If coming from processViewAppts.php
    if (isset($_POST['from_view']) && $_POST['from_view'] == "myView") { ?>
      <form action='processViewAppts.php' method='post' name='formEdit'>
        <input type="hidden" name="myView" value="myView">
        <input class="button" type='submit' value='Back to My Appointments'>
      </form>
    <?php } elseif (isset($_POST['from_view']) && $_POST['from_view'] == "allView") { ?>
      <form action='processViewAppts.php' method='post' name='formEdit'>
        <input class="button" type='submit' value='Back to All Appointments'>
      </form>
    <?php } else {
    // If coming from editAppts.php
    ?>
      <form action='editAppts.php' method='post' name='formEdit'>
          <input id='selectedDate' type='hidden' name='selectedDate' value='<?php echo $date; ?>'/>
          <input class="button" type='submit' value='Back to Appointment View'>
      </form>
    <?php } ?>
    <form action="advisorHome.php" method="post" name="backHome">
      <input class="button" type='submit' value='Back to Dashboard'>
    </form>
  </body>
</html>