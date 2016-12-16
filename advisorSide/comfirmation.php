<?php
session_start();
$m_id = $_POST['m_id'];

?>

<html>
  <head>
    <link rel="stylesheet" href="../styles.css" type="text/css">
  </head>

  <body>
    <h3> Are you sure to want to delete the meeting?</h3><br>
    <form action="deleteAppt.php" method="post" name="delete">
      <input type='hidden' name='m_id' value='<?php echo $m_id; ?>'>
      <input class="button" type='submit' value='YES'>
    </form>     

     <form action="advisorHome.php" method="post" name="backHome">
      <input class="button" type='submit' value='NO'>
    </form>	
  </body>
</html>
