<?php
session_start();
include('../studentSide/CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

$user = $_SESSION['username'];
$office = $_SESSION['office'];
$email = $_SESSION['email'];
date_default_timezone_set('EST');
$today = date("Y-m-d");

// If processing appointment and appointment already exists, then go to updating appointment page
if ($_SESSION['apptExists'] == true) {
  header('Location: updateAppts.php');
}

// Get id of advisor (user)
$sql = "SELECT `id` FROM `advisor_info` WHERE `email` = '$email'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$id = $row['0'];

// Get all appointments of the date and this advisor, and display them
function getApptTimes($id, $date) {
  global $debug; global $COMMON;

  $sql = "SELECT * FROM `advisor_appts` WHERE `a_id` = '$id' AND `date` = '$date'";
  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

# get number of students that signed up for this date this time this advisor
# compute available openings
#  $sql = "SELECT * FROM `student_appts` WHERE `advisor_ID` = '$advisorID' AND `date` = '$date'";
#  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
#  $matches = mysql_num_rows($rs);
#  echo("$matches matches were found.");

# get student id that signed up for this advisor on this date -- save in array for multiples

  echo("<table border='1px' style='width:35%'>");
  echo("<tr><th>Session Leader</th><th>Start Time</th><th>End Time</th><th>Session Type</th><th>Number of Participants</th><th>Location</th></tr>");
  $index = 0;
  while ( $row = mysql_fetch_assoc($rs) ) {
    echo("<tr>");
      echo("<td>".$row['session_leader']."</td>");
      echo("<td>".$row['start_time']."</td>");
      echo("<td>".$row['end_time']."</td>");
      if ($row['session_type'] == 0) { $sessType = "Group";}
      else {$sessType = "Individual";}
      echo ("<td>".$sessType."</td>");
      echo("<td>".$row['num_students']."</td>");
      echo ("<td>".$row['location']."</td>");
    echo("</tr>");
  }
  return $row;
}

?>
<html>
  <head>
    <title>Edit Appointments</title>
    <style>
      table, th, td {
        border: 1px solid gray;
        border-collapse: collapse;
        font-family:helvetica;
      }

      th, td {
        padding: 10px;
        text-align: left;
      }

      tr:nth-child(even) {
        background-color:#eee;
      }

      tr:nth-child(odd) {
        background-color:#fff;
      }
    </style>
  </head>

  <body>

    <form action='processAppts.php' method='post' name='formEdit'>
      <fieldset class='group'>
        <legend><caption><label for='selectedDate'> Appointment Date: </label><input id='selectedDate' type='date' name='selectedDate' value='<?php echo $today; ?>' min='<?php echo $today; ?>'/></caption></legend>
        <span>Select Appointment Start Time (Hour - Minute - AM/PM): </span><input type="time" name="start_time"><br/>
        <span>Select Appointment End Time (Hour - Minute - AM/PM): </span><input type="time" name="end_time"><br/>
        <span>Number of Students Capacity (1-40): </span><input type="number" name="numStudents" min="1" max="40" value="1"><br/>
        <span>Location (Optional): </span><input type="text" name="location"><br/>
        <span>Session Type: </span><br/>
        <input type="radio" name="session_type" value="Group"> Group <br/>
        <input type="radio" name="session_type" value="Individul"> Individual <br/>
        <span>Session Leader: </span><br/>
        <select name="session_leader">
          <option value="Michelle Bulger">Ms. Michelle Bulger</option>
          <option value="Julie Crosby">Mrs. Julie Crosby</option>
          <option value="Christine Powers">Ms. Christine Powers</option>
          <option value="CNMS Advisors">CNMS Advisors</option>
        </select><br/>
        <?php getApptTimes($id, $today); ?>
        <input type='submit' value='Save Appointments'>
      </fieldset><br/><br/>
    </form>
  </body>
</html>
