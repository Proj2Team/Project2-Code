<?php
session_start();
$selectedOption = $_POST['next'];

switch ($selectedOption)
  {
  case "Edit Appointments":
    header('Location: pickDate.php');
    break;
  case "View All Appointments":
    header('Location: processViewAppts.php');
    break;
  case "Search Appointments":
    header('Location: searchAppts.php');
    break;
  case "Edit Your Account Info":
    header('Location: editAdvisorInfo.php');
    break;
  case "Create New Advisor Account":
    header('Location: advisorInfo.php');
    break;
  case "Logout":
    header('Location: processLogout.php');
    break;
  }

?>