<?php
session_start();
include('../studentSide/CommonMethods.php');

$debug = false;
$COMMON = new Common($debug);

$user = $_SESSION['username'];
$office = $_SESSION['office'];
$email = $_SESSION['email'];

$searchType = $_POST['next'];

date_default_timezone_set('EST');

function getApptTimes() {
  global $debug; global $COMMON; global $searchType;

  if ($searchType == "My Upcoming Open")
  {
    $a_id = $_SESSION['advisorID'];
    $sql = "SELECT * FROM `advisor_appts` WHERE `a_id` = '$a_id' AND `date` >= CURDATE() AND `participants` < `num_students` ORDER BY `date` ASC, `start_time` ASC";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  }
  elseif ($searchType == "All Upcoming Open")
  {
    $a_id = $_SESSION['advisorID'];
    $sql = "SELECT * FROM `advisor_appts` WHERE `date` >= CURDATE() AND `participants` < `num_students` ORDER BY `date` ASC, `start_time` ASC";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  }
  elseif ($searchType == "My Upcoming Closed")
  {
    $a_id = $_SESSION['advisorID'];
    $sql = "SELECT * FROM `advisor_appts` WHERE `a_id` = '$a_id' AND `date` >= CURDATE() AND `participants` >= `num_students` ORDER BY `date` ASC, `start_time` ASC";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  }
  elseif ($searchType == "All Upcoming Closed")
  {
    $a_id = $_SESSION['advisorID'];
    $sql = "SELECT * FROM `advisor_appts` WHERE `date` >= CURDATE() AND `participants` >= `num_students` ORDER BY `date` ASC, `start_time` ASC";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  }
  elseif ($searchType == "All Appointments (All Time)") {
    $a_id = $_SESSION['advisorID'];
    $sql = "SELECT * FROM `advisor_appts` ORDER BY `date` ASC, `start_time` ASC";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  }

  echo("<table class='table' border='1px'>");
  echo("<tr><th>Session Leader</th><th>Date</th><th>Start Time</th><th>End Time</th><th>Session Type</th><th>Maximum Capacity</th><th>Number of Participants</th><th>Location</th><th>Edit</th></tr>");
  while ( $row = mysql_fetch_assoc($rs) ) {
    echo("<tr>\n");
      echo("<td>".$row['session_leader']."</td>\n");
      echo("<td>".$row['date']."</td>\n");
      echo("<td>".date("g:i a", strtotime($row['start_time']))."</td>\n");
      echo("<td>".date("g:i a", strtotime($row['end_time']))."</td>\n");
      if ($row['session_type'] == 0) { $sessType = "Group";}
      else {$sessType = "Individual";}
      echo ("<td>".$sessType."</td>\n");
      echo("<td>".$row['num_students']."</td>\n");
      echo("<td>".$row['participants']."</td>\n");
      echo ("<td>".$row['location']."</td>\n");
      echo "<td><form class='form-fill' action='editMadeAppt.php' method='post' name='formEditMadeAppt'>\n";
      echo "<input type='hidden' name='m_id' value='".$row['m_id']."'>\n";
      echo "<input type='hidden' name='from_view' value='";
      if ( isset($_GET['myAppts']) ) { // Trying to view only MY appointments
        echo "myView'>\n";
      } else { // Trying to view ALL appointments ever made
        echo "allView'>\n";
      }
      echo "<input class='edit-button' type='submit' value='Edit'>\n";
      echo "</form></td>\n";
    echo("</tr>\n");
  }
  echo "</table>";
  return $row;
}
?>

<html>
  <head>
    <title>View Appointments</title>
    <link rel="stylesheet" href="../styles.css" type="text/css">
  </head>
  <body>
    <h3 class="medium-title">Viewing <?php echo $searchType; ?></h3>
    <?php getApptTimes(); ?>
    <form action='searchAppts.php' method='post' name='searchGroup'>
      <input class="button" type='submit' value='Back to Appointment Search'>
    </form>
    <form action="advisorHome.php" method="post" name="backHome">
      <input class="button" type='submit' value='Back to Dashboard'>
    </form>
  </body>
</html>
