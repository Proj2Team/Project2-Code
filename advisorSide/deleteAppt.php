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

$sql = "UPDATE `students_basic_info` SET `appt_id` = NULL WHERE `appt_id` = '$m_id'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$sql = "DELETE FROM `advisor_appts` WHERE `m_id` = '$m_id'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
?>

<html>
  <head>
    <link rel="stylesheet" href="../styles.css" type="text/css">
  </head>
  <body>
  	<h3 class="medium-title">Appointment is Deleted</h3>
  	<form action='editAppts.php' method='post' name='formEdit'>
  		<input id='selectedDate' type='hidden' name='selectedDate' value='<?php echo $date; ?>'/>
  		<input class="button" type='submit' value='Back to Appointment View'>
  	</form>
    <form action="advisorHome.php" method="post" name="backHome">
      <input class="button" type='submit' value='Back to Dashboard'>
    </form>
  </body>
</html>
