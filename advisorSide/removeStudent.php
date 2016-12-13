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

$sql = "UPDATE `advisor_appts` SET `num_students` = `num_students`-1 where `m_id` = '$m_id' and `num_students` > 0";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

?>

<html>
  <head>
    <link rel="stylesheet" href="../styles.css" type="text/css">
  </head>

  <body>
     <form action="advisorHome.php" method="post" name="backHome">
      <input class="button" type='submit' value='Back to Dashboard'>
    </form>	
  </body>
</html>
