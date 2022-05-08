<?php 
include("../../config/config.php");
include("../../includes/classes/User.php");

$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

$names = explode(" ",$query);

// if query contains an underscore  assume user is searching for usernames
if(strpos($query, '_') !== false)
	$usersReturnedQuery = mysqli_query($con,"SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");
//If there are 2 words  assume they are first and last name respectively

else if(count($names) == 2)

$usersReturnedQuery = mysqli_query($con,"SELECT * FROM users WHERE (first LIKE '$names[0]%' AND last LIKE '$names[1]%') AND user_closed='no' LIMIT 8");
//if query has one word only search first name and last names
else
	$usersReturnedQuery = mysqli_query($con,"SELECT * FROM users WHERE (first LIKE '$names[0]%' OR last LIKE '$names[0]%') AND user_closed='no' LIMIT 8");

if($query != "") {
   while($row = mysqli_fetch_array($usersReturnedQuery)) {
   	$user = new User($con, $userLoggedIn);

   	if($row['username'] != $userLoggedIn)
   		$mutual_friends = $user->getMutualFriends($row['username']) . " friends in common";

   	else
   		$mutual_friends = "";

   	echo "<div class='resultDisplay'>
   	<a href='" . $row['username'] . "' style='color: #1485BD'>
   	<div class='liveSearchProfilePic'>
   	<img src='" . $row['profile_pic'] ."'>
   	</div>

   	<div class='liveSearchText'>
   	" . $row['first'] . " " . $row['last'] . "
   	<p>" . $row['username'] ."</p>
   	<p id='grey'>" . $mutual_friends . "</p>
   	</div>
   	</a>
   	</div>";


   }

}




?>