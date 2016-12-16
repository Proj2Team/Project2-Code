<?php
session_start();
include('../studentSide/CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

$user = $_SESSION['username'];
$office = $_SESSION['office'];
$email = $_SESSION['email'];

if (isset($_POST['selectedDate'])) {
  $date = $_POST['selectedDate'];
} else {
  $date = $_GET['selectedDate'];
}
date_default_timezone_set('EST');

// Get id of advisor (user)
$sql = "SELECT `id` FROM `advisor_info` WHERE `email` = '$email'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$id = $row['0'];

// Get all appointments of the date and this advisor, and display them
function getApptTimes($id, $date) {
  global $debug; global $COMMON;

  $sql = "SELECT * FROM `advisor_appts` WHERE `a_id` = '$id' AND `date` = '$date' ORDER BY `start_time` ASC";
  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

  // get student id that signed up for this advisor on this date -- save in array for multiples

  echo("<table class='table' border='1px'>");
  echo("<tr><th>Session Leader</th><th>Start Time</th><th>End Time</th><th>Session Type</th><th>Maximum Capacity</th><th>Number of Participants</th><th>Location</th><th></th><th></th></tr>");
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
      echo "<td><form class='form-fill' action='editMadeAppt.php' method='post' name='formEditMadeAppt'>\n";
      echo "<input type='hidden' name='m_id' value='".$row['m_id']."'>\n";
      echo "<input class='edit-button' type='submit' value='Edit'>\n";
      echo "</form></td>\n";
      echo "<td><form class='form-fill' action='comfirmation.php' method='post' name='formEditMadeAppt'>\n";
      echo "<input type='hidden' name='m_id' value='".$row['m_id']."'>\n";
      echo "<input class='edit-button' type='submit' value='Delete'>\n";
      echo "</form></td>\n";
    echo("</tr>\n");
  }
  echo "</table>";
  return $row;
}

?>
<html>
  <head>
    <title>Edit Appointments</title>
    <link rel="stylesheet" href="../styles.css" type="text/css">
  </head>
  <body>
    <form action="createNewAppt.php" method="post" name="formCreateAppt">
      <input type="hidden" name="date" value="<?php echo $date; ?>">
      <input class="button" type="submit" value="Create New Appointment">
    </form>
    <?php if (isset($_POST['weekView'])) { // weekly view
      $datecopy = $date; // To not affect original date variable
      for ($i = 0; $i < 6; $i++) {
        echo "<h3 class='medium-title'> " . date("l F j, Y", strtotime($datecopy)) . "</h3>\n";
        getApptTimes($id, $datecopy);
        $datecopy = date('Y-m-d', strtotime($datecopy. ' + 1 day'));
        echo "<br/><br/>\n";
      }
    } else {
      echo "<h3 class='medium-title'>Viewing My Appointments for " . date("l F j, Y", strtotime($date)) . "</h3>\n";
      getApptTimes($id, $date);
    } ?>
    <form action='editAppts.php' method='post' name='formEdit'>
        <h3 class="medium-title"> Select another date to view: </h3>
        <input class="large-input" style="margin-bottom: 0.8em;" id='selectedDate' type='date' name='selectedDate' value='<?php echo $date; ?>' placeholder="YYYY-MM-DD"/><br/>
        <input class="large-input" type="checkbox" name="weekView" value="week"><span>Weekly View</span><br/>
        <input class="button" type='submit' value='Select Date'>
    </form>
    <form action="advisorHome.php" method="post" name="backHome">
      <input class="button" type='submit' value='Back to Dashboard'>
    </form>
  </body>
</html>
