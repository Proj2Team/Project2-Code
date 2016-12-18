<?php
session_start();
?>
<html>
  <head>
    <title>New Advisor Information</title>
    <link rel="stylesheet" href="../styles.css" type="text/css">
  </head>
  <body>

  <?php
  if ($_SESSION['confirmedPass'] == true) {
    echo "<span style='color: red;'>Passwords do not match.</span>";
  }

  if ($_SESSION['advisorExists'] == true) {
    echo "";
    echo "<span style='color: red;'>Advisor already exists.</span>";
  }
  ?>
  <h3 class="medium-title">New Advisor Information</h3>
  <form class="center-form form-clean" action='processNewAdvisor.php' method='post' name='NewAdvisorProfile'>
    <div class="wrap-align-left">
      <span class="small-header">First Name:</span><br/>
      <input type='text' size='25' maxlength='25' name='fname' required><br/>
      <span class="small-header">Last Name:</span><br/>
      <input type='text' size='25' maxlength='25' name='lname' required><br/>
      <span class="small-header">Username:</span><br/>
      <input type='text' size='25' maxlength='25' name='username' required><br/>
      <span class="small-header">Password:</span><br/>
      <input type='password' size='25' maxlength='50' name='pass' required><br/>
      <span class="small-header">Confirm Password:</span><br/>
      <input type='password' size='25' maxlength='50' name='confirmPass' required><br/>
      <span class="small-header">Office Location:</span><br/>
      <input type='text' size='25' maxlength='10' name='office' required><br/>
      <span class="small-header">UMBC Email:</span><br/>
      <input type='email' size='25' maxlength='50' name='email' required><br/><br/>
    </div>
    <span class="medium-header">Select Majors to Advise: (Hold control and click to select multiple)</span><br/><br/>
    <select class="medium-select" name='majors[]' multiple='multiple'>
      <option value='bsci_BA'>Biological Sciences BA</option>
      <option value='bsci_BS'>Biological Sciences BS</option>
      <option value='bchem_BS'>Biochemistry & Molecular Biology BS</option>
      <option value='binf_BS'>Bioinformatics & Computational Biology BS</option>
      <option value='bsciEd_BA'>Biology Education BA</option>
      <option value='chem_BA'>Chemistry BA</option>
      <option value='chem_BS'>Chemistry BS</option>
      <option value='chemEd_BA'>Chemistry Education BA</option>
    </select><br/><br/>
    <input class="button" type='submit' value='Save Profile'>
  </form>
  <form action="advisorHome.php" method="post" name="backHome">
    <input class="button" type='submit' value='Back to Dashboard'>
  </form>

  </body>
</html>
