<html>
<head>
<title>Student: Log in</title>
<link rel="stylesheet" href="../studentstyles.css" type="text/css">
</head>
<body>
You have indicated that you plan to pursue a major <b>other</b> than one of the following, beginning next semester:
<p> 
Biological Sciences B.A.
<br> Biological Sciences B.S.
<br> Biochemistry & Molecular Biology B.S. 
<br> Bioinformatics & Computational Biology B.S. 
<br> Biology Education B.A. 
<br> Chemistry B.A. 
<br> Chemistry B.S. 
<br> Chemistry Education B.A. 
<p> In order to obtain the BEST advice about course selection, degree progress, and academic policy, please meet with a representative of the department that administers your NEW major. 
<p>
You can find advising contact information for your new major on the <a href ='http://advising.umbc.edu/departmental-advising/'>  Office for Academic and Pre-Professional Advising Office’s Departmental Advising page</a>
<p>
That contact person/office will be able to give you instructions on how to schedule an advising appointment with someone in that area.  
<br>Good luck with your new major! 
<p> 
If you selected “Other” in error, click the button to return to the previous screen

<?php
session_start();
//determine whether the student came from register page or edit information page

$type = $_SESSION['origin'];

if($type == 'Edit'){

echo('<form action=\'editInformation.php\' method=\'post\'>');
echo('<input type=\'submit\' value=\'Back\' class=\'button\'>');
echo('</form>');

}
elseif($type == 'Register'){

echo('<form action=\'registerStudent.php\' method=\'post\'>');
echo('<input type=\'submit\' value=\'Back\' class=\'button\'>');
echo('</form>');

}
else{
	header('Location: newLogin.php');
}

?>

</body>
</html>