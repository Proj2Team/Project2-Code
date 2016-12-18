<?php
session_start();
include('../studentSide/CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

// get all info based on passed in m_id to set as placeholder
$m_id = $_POST['m_id'];
$date = $_POST['date'];

$sql = "select `fname`, `lname`, `umbc_ID`, `date`, `start_time`, `end_time`
from `students_basic_info`
join `advisor_appts`
on `appt_id` = `m_id`
where `m_id` = '$m_id'";

$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

echo("<table class='table' border='1px'>");
echo("<tr><th>First Name</th><th>Last Name</th><th>Campus ID</th><th>Date</th><th>Start Time</th><th>End Time</th> </tr>");
while ($row = mysql_fetch_assoc($rs)) {
 echo("<tr>\n");
  echo("<td>".$row['fname']."</td>\n");
  echo("<td>".$row['lname']."</td>\n");
  echo("<td>".$row['umbc_ID']."</td>\n");
  echo("<td>".$row['date']."</td>\n");
  echo("<td>".date("g:i a", strtotime($row['start_time']))."</td>\n");
  echo("<td>".date("g:i a", strtotime($row['end_time']))."</td>\n");
 echo ("</tr>\n");
}
echo("</table>");
?>

<html>
 <head>
    <link rel="stylesheet" href="../styles.css" type="text/css">
  </head>
  <body>
    <button class= 'button'  onclick="printTable()">Print this table</button>
      <script>
        function printTable() {
         window.print();
      }
      </script>

   </form>
    <form action="editAppts.php" method="post" name="backHome">
      <input type='hidden' name='selectedDate' value='<?php echo $date; ?>'>
      <input class="button" type='submit' value='Go Back'>
    </form>
 </body>
</html>
