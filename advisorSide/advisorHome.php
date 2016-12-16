<?php
session_start();
$debug = false;
include('../studentSide/CommonMethods.php');

$COMMON = new Common($debug);
$_SESSION['confirmedPass'] = false;
$_SESSION['apptExists'] = false;
$fname = $_SESSION['first'];

$sql = "select * from `isShutDown`";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$lock = $row['0'];
$text = "";
if ($lock == 1){
	$text = "SHUT DOWN DATABASE";
}else{
	$text = "ACTIVATE DATABASE";
}
?>


<html>
  <head>
    <title>Advisor Home</title>
    <link rel="stylesheet" href="../styles.css" type="text/css">
    <style type="text/css">
      .button-parent input {
        width: 20em;
      }
    </style>
  </head>

  <body>

    <h2 class="big-title">Welcome, <?php echo "$fname";?></h2>
    <form class="button-parent" action='processAdvisorHome.php' method='post' name='advisorHome'>
      <input type='submit' name='next' value='Edit/Create Appointments'><br/>
      <input type='submit' name='next' value='View My Upcoming Appointments'><br/>
      <input type='submit' name='next' value='View All Upcoming Appointments'><br/>
      <input type='submit' name='next' value='Search Appointments'><br/>
      <input type='submit' name='next' value='Edit Your Account Info'><br/>
      <input type='submit' name='next' value='Create New Advisor Account'><br/>
      <input type='submit' name='next' value='<?php echo $text ?>'><br/>
      <input type='submit' name='next' value='Logout'><br/>
    </form>

  </body>
</html>
