<?php
session_start();
include('../studentSide/CommonMethods.php');

$debug = false;
$COMMON = new Common($debug);

$a_id = $_SESSION['username'];
$searchType = $_POST['searchType'];

function getAllStudents($searchType) {
  global $debug; global $COMMON; global $a_id;

  if ($searchType == "Any Advisor") {
    $sql = "SELECT * FROM `students_basic_info` WHERE `appt_id` IS NOT NULL ORDER BY `umbc_ID` ASC, `lname` ASC";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  } else { // Not signed up yet
    $sql = "SELECT * FROM `students_basic_info` WHERE `appt_id` IS NULL ORDER BY `umbc_ID` ASC, `lname` ASC";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
  }

  echo("<table class='table' border='1px'>");
  echo("<tr><th>UMBC ID</th><th>First Name</th><th>Last Name</th><th>Preferred Name</th><th>Email</th><th>Major(s)</th><th>Appointment</th>");
  while ( $row = mysql_fetch_assoc($rs) ) {
    echo("<tr>\n");
      echo("<td>".strtoupper($row['umbc_ID'])."</td>\n");
      echo("<td>".$row['fname']."</td>\n");
      echo("<td>".$row['lname']."</td>\n");
      echo("<td>".$row['pname']."</td>\n");
      echo ("<td>".$row['email']."</td>\n");
      echo "<td>\n";
      if ($row['bio_ba'] == 1) { echo "Biological Sciences BA<br/>\n"; }
      if ($row['bio_bs'] == 1) { echo "Biological Sciences BS<br/>\n"; }
      if ($row['biochem_bs'] == 1) { echo "Biochemistry & Molecular Biology BS<br/>\n"; }
      if ($row['bioinfo_bs'] == 1) { echo "Bioinformatics & Computational Biology BS<br/>\n"; }
      if ($row['bioedu_ba'] == 1) { echo "Biology Education BA<br/>\n"; }
      if ($row['chem_ba'] == 1) { echo "Chemistry BA<br/>\n"; }
      if ($row['chem_bs'] == 1) { echo "Chemistry BS<br/>\n"; }
      if ($row['chemedu_ba'] == 1) { echo "Chemistry Education BA"; }
      echo "</td>\n";
      echo "<td>\n";
      if ($row['appt_id'] != NULL) {
        echo "<form class='form-fill' action='editMadeAppt.php' method='post' name='formEditMadeAppt'>\n";
        echo "<input type='hidden' name='m_id' value='".$row['appt_id']."'>\n";
        echo "<input type='hidden' name='from_view' value='manageView'>\n";
        echo "<input class='edit-button' type='submit' value='View'>\n";
        echo "</form>\n";
      } else { // Not signed up
        echo "<i>No Appointment</i>";
      }
    echo "</td>\n";
    echo("</tr>\n");
  }
  echo "</table>\n";
  return $row;
}
?>

<html>
  <head>
    <title>View Students</title>
    <link rel="stylesheet" href="../styles.css" type="text/css">
  </head>
  <body>
    <h3 class="medium-title"><?php if ($searchType == "Any Advisor") { echo "Viewing students with any advisor"; } else { echo "Viewing students who have not signed up yet";} ?></h3>
    <?php getAllStudents($searchType); ?>
    <form action="manageStudents.php" method="post" name="backHome">
      <input class="button" type='submit' value='Back to Manage Students'>
    </form>
    <form action="advisorHome.php" method="post" name="backHome">
      <input class="button" type='submit' value='Back to Dashboard'>
    </form>
  </body>
</html>