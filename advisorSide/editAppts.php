<?php
session_start();
include('../studentSide/CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

$user = $_SESSION['username'];
$office = $_SESSION['office'];
$email = $_SESSION['email'];
$date = $_POST['selectedDate'];
date_default_timezone_set('EST');

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

  // get student id that signed up for this advisor on this date -- save in array for multiples

  echo("<table border='1px' style='width:35%'>");
  echo("<tr><th>Session Leader</th><th>Start Time</th><th>End Time</th><th>Session Type</th><th>Maximum Capacity</th><th>Number of Participants</th><th>Location</th><th></th></tr>");
  $index = 0;
  while ( $row = mysql_fetch_assoc($rs) ) {
    echo("<tr>\n");
      echo("<td>".$row['session_leader']."</td>\n");
      echo("<td>".date("g:i a", strtotime($row['start_time']))."</td>\n");
      echo("<td>".date("g:i a", strtotime($row['end_time']))."</td>\n");
      if ($row['session_type'] == 0) { $sessType = "Group";}
      else {$sessType = "Individual";}
      echo ("<td>".$sessType."</td>\n");
      echo("<td>".$row['num_students']."</td>\n");
      echo("<td>".$row['participants']."</td>\n");
      echo ("<td>".$row['location']."</td>\n");
      echo "<td><form action='editMadeAppt.php' method='post' name='formEditMadeAppt'>\n";
      echo "<input type='hidden' name='m_id' value='".$row['m_id']."'>\n";
      echo "<input type='submit' value='Edit'>\n";
      echo "</form></td>\n";
    echo("</tr>\n");
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
    <form action="createNewAppt.php" method="post" name="formCreateAppt">
      <input type="hidden" name="date" value="<?php echo $date; ?>">
      <input type="submit" value="Create New Appointment">
    </form>
    <span> Viewing Appointments for <?php echo date("l Y-m-d", strtotime($date)); ?></span>
    <?php getApptTimes($id, $date); ?>
  </body>
</html>
