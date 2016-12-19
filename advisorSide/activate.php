<?php
session_start();
$debug = false;
include('../studentSide/CommonMethods.php');

$COMMON = new Common($debug);

$sql = "UPDATE `isShutDown` SET `switch`= 1";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

header('Location: advisorHome.php');

?>


