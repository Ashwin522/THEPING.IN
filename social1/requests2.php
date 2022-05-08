<?php
include("includes/header.php");
?>

<div class="main_column column" id="main_column">
	<h4>Crush Requests</h4> 
	<?php 


$query = mysqli_query($con,"SELECT user_from FROM crush_requests WHERE user_to='$userLoggedIn'"); 
$query1 = mysqli_query($con,"SELECT user_to FROM crush_requests WHERE user_from='$userLoggedIn'");
$hat = mysqli_fetch_object($query);
$hat1 = mysqli_fetch_object($query1);



if(($hat && $hat1)) {
	

$query1 = mysqli_query($con,"SELECT user_to FROM crush_requests WHERE user_from='$userLoggedIn'");
$query = mysqli_query($con,"SELECT user_from FROM crush_requests WHERE user_to='$userLoggedIn'"); 
$row1 = mysqli_fetch_array($query);
		$user_from = $row1['user_from'];
		$user_from_obj = new User($con,$user_from);

$row = mysqli_fetch_array($query1);
$user_to = $row['user_to'];
		$user_to_obj = new User($con,$user_to);

		echo $user_to_obj->getFirstNameAndLastName() . " also has a CRUSH ON YOU!";

		$user_to_friend_array = $user_to_obj->getCrushArray();

		
		
		

		}
	else
		echo "nothing positive at the moment!";



	
	 
	


 


	 
	



?>


</div>