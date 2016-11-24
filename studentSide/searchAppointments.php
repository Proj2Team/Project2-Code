<?php
session_start();
?>
<html>
<head>
<!--added title and linked to css-->
<title>Search Appointments</title>

</head>
<body>
<form action='appointmentDisplay.php' method='post'>
UMBC ID: <input type='text' value='umbc_ID'> <!--Is this really necessary???-->
<br><br>

Appointment Date:
<input type='date' name='date'>
<br><br>

Time:
<br>
<input type='checkbox' value='eight'> 8:00am - 8:30am<br/><br/>
<input type='checkbox' value='eight_thirty'> 8:30am - 9:00am<br/><br/>
<input type='checkbox' value='nine'> 9:00am - 9:30am<br><br>
<input type='checkbox' value='nine_thirty'> 9:30am - 10:00am<br><br>
<input type='checkbox' value='ten'> 10:00am - 10:30am<br><br>
<input type='checkbox' value='ten_thirty'> 10:30am - 11:00am<br><br>
<input type='checkbox' value='eleven'> 11:00am - 11:30am<br><br>
<input type='checkbox' value='eleven_thirty'> 11:30am - 12:00pm<br><br>
<input type='checkbox' value='twelve'> 12:00pm - 12:30pm<br><br>
<input type='checkbox' value='twelve_thirty'> 12:30pm - 1:00pm<br><br>
<input type='checkbox' value='one'> 1:00pm - 1:30pm<br><br>
<input type='checkbox' value='one_thirty'> 1:30pm - 2:00pm<br><br>
<input type='checkbox' value='two'> 2:00pm - 2:30pm<br><br>
<input type='checkbox' value='two_thirty'> 2:30pm - 3:00pm<br><br>
<input type='checkbox' value='three'> 3:00pm - 3:30pm<br><br>
<input type='checkbox' value='three_thirty'> 3:30pm - 4:00pm<br><br>
<input type='checkbox' value='four'> 4:00pm - 4:30pm<br><br>

Availability:
<br><br>
<!-- Change to radio buttons - Syake
<select multiple required>
<option value='all_appts'>All Appointments</option>
<option value='indv_appts'>Individual Appointments</option>
<option value='grp_appts'>Group Appointments</option>
-->

<!--default checked-->
<input type='radio' value='all_appts' checked>All Appointments<br>
<input type='radio' value='indv_appts'>Individual Appointments<br>
<input type='radio' value='grp_appts'>Group Appointments<br>

<br/><br/>
<input type='submit' value='Go'>
</form>

</body>
</html>



