<?php
session_start();
include('../studentSide/CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

$m_id = $_POST['m_id'];

$sql = "SELECT * FROM `advisor_appts` WHERE `m_id` = '$m_id'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_assoc($rs);
$date = $row['date'];
$start_time = $row['start_time'];
$end_time = $row['end_time'];
$participants = $row['participants'];
?>

<html>
  <head>
    <link rel="stylesheet" href="../styles.css" type="text/css">
  </head>

  <body>
    <h3 class="medium-title"><?php echo "Are you sure to want to delete the meeting on " . date("l F j, Y", strtotime($date)) . ", from " . date("h:i A", strtotime($start_time)) . " to " . date("h:i A", strtotime($end_time)) . "?"; ?></h3>
    <?php if ($participants > 0) : // If there are students, set warning ?>
      <h3 class="medium-title" style="color: red;">Warning, this meeting has <?php echo $participants; ?> students signed up for it. Deleting the appointment will kick all of these students out.</h3>
    <?php endif ?>
    <form action="deleteAppt.php" method="post" name="delete">
      <input type='hidden' name='m_id' value='<?php echo $m_id; ?>'>
      <input class="button" type='submit' value='Yes'>
    </form>
    <form action='editAppts.php' method='post' name='formEdit'>
      <input id='selectedDate' type='hidden' name='selectedDate' value='<?php echo $date; ?>'/>
      <input class="button" type='submit' value='Just kidding!'>
    </form>
  </body>
</html>
