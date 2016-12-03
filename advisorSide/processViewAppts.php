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

function getApptTimes($id, $date) {
  global $debug; global $COMMON;

  $sql = "SELECT * FROM `advisor_appts` WHERE `a_id` = '$id' AND `date` = '$date' ORDER BY `start_time` ASC";
  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

  // get student id that signed up for this advisor on this date -- save in array for multiples

  echo("<table class='table' border='1px'>");
  echo("<tr><th>Session Leader</th><th>Start Time</th><th>End Time</th><th>Session Type</th><th>Maximum Capacity</th><th>Number of Participants</th><th>Location</th></tr>");
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
    <h3 class="medium-title">Viewing Appointments for <?php echo date("l Y-m-d", strtotime($date)); ?></h3>
    <?php getApptTimes($id, $date); ?>
    <form action='processViewAppts.php' method='post' name='formEdit'>
        <h3 class="medium-title"> Select another date to view: </h3>
        <input class="large-input" id='selectedDate' type='date' name='selectedDate' value='<?php echo $date; ?>' placeholder="YYYY-MM-DD"/><br/>
        <input class="button" type='submit' value='Select Date'>
    </form>
    <form action="advisorHome.php" method="post" name="backHome">
      <input class="button" type='submit' value='Back to Dashboard'>
    </form>
  </body>
</html>
