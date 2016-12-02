<?php
session_start();
#var_dump($_POST);

//
//
// Make sure the file you are calling from had CommonMethods.php included!!!!!!!!!!!!!!!!
// This file is not including the CommonMethods!
//
//

# Function that creates advisor, then takes you back to advisorHome.php
# This should only be called by processNewAdvisor.php, unless you call it somewhere else...
# Be sure to pass in the correct arguments!
function createAdvisor($first, $last, $user, $pass, $encrypted_pass, $office, $email, $majors) {
	global $debug; global $COMMON;
	# First query to insert basic advisor info into the advisor_info table
    $sql = "INSERT INTO `advisor_info`(`id`, `username`, `password`, `lname`, `fname`, `office`, `email`) VALUES ('', '$user', '$encrypted_pass', '$last', '$first', '$office', '$email')";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

    if ( isset($majors) ) {
	    # Query to get the id number of the advisor based on matching email
		$sql = "SELECT `id` FROM `advisor_info` WHERE `email` = '$email'";
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		$row = mysql_fetch_row($rs);

		$id = $row['0'];

		# Array for possible selections of majors the advisor could advise
		$cols = array('bsci_BA', 'bsci_BS', 'bchem_BS', 'binf_BS', 'bsciEd_BA', 'chem_BA', 'chem_BS', 'chemEd_BA');

		# Start of the query to insert selected majors into the advisors_majors table
		$query = "INSERT INTO `advisors_majors`(`id`, `bsci_BA`, `bsci_BS`, `bchem_BS`, `binf_BS`, `bsciEd_BA`, `chem_BA`, `chem_BS`, `chemEd_BA`)" . " VALUES ($id";

		# Loop that adds on to the query a 0 or 1 for each major, depending if the advisor selected it or not
		foreach ($cols as $col) {
		    if ( in_array($col, $majors) ) {
				$flag = 1;
		    } else {
		    	$flag = 0;
		    }
		    $query .= ", $flag";
		}
		# Close the parentheses of the query
		$query .= ')';
	}
    $rsMajor = $COMMON->executeQuery($query, $_SERVER["SCRIPT_NAME"]);
    echo("Advisor Profile saved.");
    header('Location: advisorHome.php');
}
?>