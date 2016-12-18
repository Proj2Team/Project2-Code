<?php
session_start();
include('../studentSide/CommonMethods.php');

$debug = false;
$COMMON = new Common($debug);

$a_id = $_SESSION['username'];
$s_id = $_POST['s_id'];
$s_id = strtoupper($s_id); // uppercase so seach is case insensitive

function FindStudents() {
  global $debug; global $COMMON; global $s_id;

  $sql = "SELECT * FROM `students_basic_info` WHERE upper(`umbc_ID`) = '$s_id'"; // uppercase so seach is case insensitive
  $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

  echo("<table class='table' border='1px'>");
  echo("<tr><th>UMBC ID</th><th>First Name</th><th>Last Name</th><th>Preferred Name</th><th>Email</th><th>Major(s)</th><th>Appointment</th>");
  while ( $row = mysql_fetch_assoc($rs) ) {
    echo("<tr>\n");
      echo("<td>".$row['umbc_ID']."</td>\n");
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
    <title>Search Student Results</title>
    <link rel="stylesheet" href="../styles.css" type="text/css">
  </head>
  <body>
    <h3 class="medium-title">Search result for <?php echo $s_id; ?></h3>
    <?php FindStudents(); ?>
    <br/>
    <h4 class="small-title">Search by UMBC ID:</h4>
    <form class="button-parent" action='processStudentSearch.php' method='post' name='searchStudent'>
      <input class="large-input clean-text-input" style="width: 18em;" type='text' name='s_id' placeholder="UMBC ID"/><br/>
      <input type='submit' name='searchStudent' value='Search for another student'><br/>
    </form>
    <form action="manageStudents.php" method="post" name="backHome">
      <input class="button" type='submit' value='Back to Manage Students'>
    </form>
    <form action="advisorHome.php" method="post" name="backHome">
      <input class="button" type='submit' value='Back to Dashboard'>
    </form>
  </body>
</html>