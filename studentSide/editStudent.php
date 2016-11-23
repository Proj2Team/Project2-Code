<!-- File: editStudent.php-->
<!-- This page does the actual processing that changes the information in the database -->
<!-- It is very similar to the student creation code (but doesn't allow some changes that creation does-->
<!-- The body is by Khadijah. Any changes by anyone else should be commented -->


<?php
session_start();
include('CommonMethods.php');

$debug = false;
$COMMON = new Common($debug);

$first = $_POST['fname'];
$last = $_POST['lname'];
$pref = $_POST['pname'];
$pass = $_POST['password'];
$encrypted_pass = md5($pass);

$newPass = $_POST['newPass'];

$encrypted_newPass = md5($newPass);
$majors = $_POST['majors'];

$_SESSION['studentExists'] = false; //this is here to prevent an error coming up. since it comes from homepage it SHOULD be impossible for there not to be a student
$_SESSION['confirmedPass'] = false; //password and confirm password fields don't match
$_SESSION['confirmedNewPass'] = false; //new password and confirm new password don't match
$_SESSION['confirmedOldPass'] = false; //password and password in record don't match

//verify password match

if($_POST['password'] != $_POST['confirmPass'])
  {
    $_SESSION['confirmedPass'] = true;
    header('Location: editInformation.php');
  }

//verify password matches old password

elseif($_POST['password'] != $_SESSION['password'])
  {
    $_SESSION['confirmedOldPass'] = true;
    header('Location: editInformation.php');
  }

elseif($_POST['newPass'] != $_POST['confirmNewPass'])
  {
    $_SESSION['confirmedNewPass'] = true;
    header('Location: editInformation.php');
  }
else {
# Array for possible selections of majors
    $cols = array('bio_ba', 'bio_bs', 'biochem_bs', 'bioinfo_bs', 'bioedu_ba', 'chem_ba', 'chem_bs', 'chemedu_ba');

//array to store the values of the corresponding majors (the indexes are in order)	
    $values = array(0, 0, 0, 0, 0, 0, 0, 0);
    $i = 0;

    if(isset($majors))
      {

# Loop that adds on to an array a 1 or 0 for each major, depending if it was selected or not
//Similar to the loop in createStudent except because of the format of the update query it
//cannot add it straight to the query line but rather stores the values in an array
	foreach($cols as $col)
	  {
	    if(in_array($col, $majors))
	      {
		$values[$i] = 1;
	      }
	    else $values[$i] = 0;

	    $i++;
	  }


      }


# Set up update query to change info in the student basic info table
    $sql = "UPDATE `students_basic_info` SET `lname`= '$last',`fname`='$first',`pname`='$pref',";

//only change password if there is a new one
    if($newPass != ''){
    $sql .=  "`password`='$encrypted_newPass',";
	}
    echo($_SESSION['umbc_ID']);
    $sql .= "`bio_ba`=$values[0],`bio_bs`=$values[1],`biochem_bs`=$values[2],`bioinfo_bs`=$values[3],`bioedu_ba`=$values[4],`chem_ba`=$values[5],`chem_bs`=$values[6],`chemedu_ba`=$values[7] WHERE `umbc_ID`='$_SESSION[umbc_ID]'";

    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

//update session variables (email and umbcID are not included because they cannot be changed)
    $_SESSION['first'] = $first;
    $_SESSION['last'] = $last;
    $_SESSION['pref'] = $pref;

    header('Location: homescreen.php');
  }
?>