<?php
session_start();
include('../studentSide/CommonMethods.php');
$debug = false;
$COMMON = new Common($debug);

$a_id = $_POST['a_id'];
?>

<html>
 <head>
    <link rel="stylesheet" href="../styles.css" type="text/css">
  </head>
  <body>
  <h3 class="medium-title">Students signed up</h3>
  <?php
  $sql = "select `m_id` from `advisor_appts` where `a_id` = '$a_id' order by `date` ASC, `start_time` ASC";
  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

  echo("<table class='table' border='1px'>");
  echo("<tr><th>First Name</th><th>Last Name</th><th>Campus ID</th><th>Date</th><th>Start Time</th><th>End Time</th> </tr>");

  while ($i = mysql_fetch_array($rs) ){
   $id = $i[0];
   $sql_1 = "select `fname`, `lname`, `umbc_ID`, `date`, `start_time`, `end_time`
  from `students_basic_info`
  join `advisor_appts`
  on `appt_id` = `m_id`
  where `m_id` = '$id'";

   $rs_1 = $COMMON->executeQuery($sql_1, $_SERVER["SCRIPT_NAME"]);
   while ($row = mysql_fetch_assoc($rs_1)) {
     echo("<tr>\n");
      echo("<td>".$row['fname']."</td>\n");
      echo("<td>".$row['lname']."</td>\n");
      echo("<td>".$row['umbc_ID']."</td>\n");
      echo("<td>".$row['date']."</td>\n");
      echo("<td>".date("g:i a", strtotime($row['start_time']))."</td>\n");
      echo("<td>".date("g:i a", strtotime($row['end_time']))."</td>\n");
     echo ("</tr>\n");
    }
  }
  echo("</table>"); ?>
    <button class= 'button'  onclick="printTable()">Print this table</button>
      <script>
        function printTable() {
         window.print();
      }
      </script>

   </form>
    <form action="processViewAppts.php" method="post" name="backHome">
      <input type='hidden' name='a_id' value='<?php echo $a_id; ?>'>
      <input id='myView' type='hidden' name='myView' value='myView'/>
      <input class="button" type='submit' value='Go Back'>
    </form>
 </body>
</html>
