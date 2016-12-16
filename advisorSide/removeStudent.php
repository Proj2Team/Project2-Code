<?php
session_start();
include('../studentSide/CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

// get all info based on passed in m_id to set as placeholder
$m_id = $_POST['m_id'];
$s_id = $_POST['s_id'];
$sql = "UPDATE `students_basic_info` SET `appt_id` = 'NULL' where `id` = '$s_id'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$sql = "UPDATE `advisor_appts` SET `participants` = `participants`-1 where `m_id` = '$m_id' and `participants` > 0";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

$sql = "SELECT * FROM `students_basic_info` WHERE `id` = '$s_id'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_assoc($rs);
?>

<html>
  <head>
    <link rel="stylesheet" href="../styles.css" type="text/css">
  </head>
  <body>
  	<h3 class="medium-title">Removed <?php echo $row['fname'] . " " . $row['lname'] . " (" . $row['umbc_ID'] . ")"; ?> from appointment.</h3>
  	<form action='editMadeAppt.php' method='post' name='formEdit'>
      <input type='hidden' name='m_id' value='<?php echo $m_id; ?>'/>
      <input class="button" type='submit' value='Back to Appointment'>
    </form>
    <form action="advisorHome.php" method="post" name="backHome">
      <input class="button" type='submit' value='Back to Dashboard'>
    </form>
  </body>
</html>
