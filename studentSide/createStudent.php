<?php
session_start();
include('CommonMethods.php');

$debug = true;
$COMMON = new Common($debug);

$first = $_POST['fname'];
$first = ucfirst($first);
$last = $_POST['lname'];
$last = ucfirst($last);
$pref = $_POST['pname'];
$pref = ucfirst($pref);
$umbc_ID = $_POST['umbc_ID'];
$pass = $_POST['password'];
$encrypted_pass = md5($pass);
$email = $_POST['email'];
$majors = $_POST['majors'];
$_SESSION['studentExists'] = false;
$_SESSION['confirmedPass'] = false;
$_SESSION['confirmedNewPass'] = false;
$_SESSION['umbcEmail'] = false;


# Check to see if student already exists
$sql = "SELECT * FROM `students_basic_info` WHERE `umbc_ID` = '$umbc_ID' AND `lname` = '$last' AND `fname` = '$first'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

//EDIT BY KHADIJAH: createStudent now checks for both the student existing and the passwords
//matching instead of setStudent doing so separately. It also checks if the email is a umbc email
if($row)
  {
    $_SESSION['studentExists'] = true;
    header('Location: registerStudent.php');
  }
elseif($_POST['password'] != $_POST['confirmPass'])
  {
    $_SESSION['confirmedPass'] = true;
    header('Location: registerStudent.php');
  }
elseif(substr_compare($email, '@umbc.edu', -9, 9) != 0){
    $_SESSION['umbcEmail'] = true;
    header('Location: registerStudent.php');
}
else
  {

//EDIT BY KHADIJAH: added preferred name and simply made sure all the data fields matched up
# Set up Insert query to insert info into student basic info table
    $sql = "INSERT INTO `students_basic_info`(`id`, `lname`, `fname`, `pname`, `email`, `umbc_ID`, `password`, `bio_ba`, `bio_bs`, `biochem_bs`, `bioinfo_bs`, `bioedu_ba`, `chem_ba`, `chem_bs`, `chemedu_ba`)" . " VALUES ('', '$last', '$first', '$pref', '$email' , '$umbc_ID', '$encrypted_pass'";

# Array for possible selections of majors
    $cols = array('bio_ba', 'bio_bs', 'biochem_bs', 'bioinfo_bs', 'bioedu_ba', 'chem_ba', 'chem_bs', 'chemedu_ba');

    if(isset($majors))
      {

# Loop that adds on to the sql query a 1 or 0 for each major, depending if it was selected or not
	foreach($cols as $col)
	  {
	    if(in_array($col, $majors))
	      {
		$flag = 1;
	      }
	    else $flag = 0;

	    $sql .= ", $flag";
	  }

# Close the parentheses of the sql query
	$sql .= ')';
	echo $sql;
      }

    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

//fetch recently created student
$sql = "SELECT * FROM `students_basic_info` WHERE `umbc_ID` = '$umbc_ID' AND `lname` = '$last' AND `fname` = '$first'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

$row = mysql_fetch_row($rs);

//CHANGES BY KHADIJAH: createStudent now adds more than just the umbc_ID to the session
    $_SESSION['last'] = $last;
    $_SESSION['first'] = $first;
    $_SESSION['pref'] = $pref;
    $_SESSION['umbc_ID'] = $umbc_ID;
    $_SESSION['studentID'] = $row['0'];
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $pass;
   header('Location: homescreen.php');
  }
?>