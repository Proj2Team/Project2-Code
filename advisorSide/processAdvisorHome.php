<?php
session_start();
$selectedOption = $_POST['next'];

switch ($selectedOption)
  {
  case "Edit/Create Appointments":
    header('Location: pickDate.php');
    break;
  case "View My Upcoming Appointments":
    header('Location: processViewAppts.php?myAppts=true');
    break;
  case "View All Upcoming Appointments":
    header('Location: processViewAppts.php');
    break;
  case "Search Appointments":
    header('Location: searchAppts.php');
    break;
  case "Manage Students":
    header('Location: manageStudents.php');
    break;
  case "Edit Your Account Info":
    header('Location: editAdvisorInfo.php');
    break;
  case "Create New Advisor Account":
    header('Location: advisorInfo.php');
    break;
  case "Shut Down Database":
    header('Location: shutDown.php');
    break;
  case "Activate Database":
    header('Location: activate.php');
    break;

  case "Logout":
    header('Location: processLogout.php');
    break;
  }

?>
