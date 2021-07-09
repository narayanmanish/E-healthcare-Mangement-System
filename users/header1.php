<?php
error_reporting(0);
include("dbconnection.php");
$dt = date("Y-m-d");
$tim = date("H:i:s");
?>

<?php

if(isset($_SESSION[patientid]))
{
include("menu1.php");
}

?>
