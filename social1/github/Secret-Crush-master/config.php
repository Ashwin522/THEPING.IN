<?php
ob_start();//turns on output buffering
session_start();
$timezone = date_default_timezone_set("Indian/Maldives");
$con = mysqli_connect("localhost","root","","network");//connection variable
if(mysqli_connect_errno()) 
	echo " FAILED TO CONNECT: " . mysqli_connect_errno();

?>