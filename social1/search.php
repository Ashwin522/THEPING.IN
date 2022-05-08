<?php
include("includes/header.php");

if(isset($_GET['q'])) {
	$query = $_GET['q'];

}
else {
	$query = "";
}

if(isset($_GET['type'])) {
	$type = $_GET['type'];

}
else {
	$type = "name";
}

?>

<div class="main_column column" id="main_column">
	<?php  
if($query == "")
	echo "You must enter something in the search box";
else {


    if($type == "username")
	$usersReturnedQuery = mysqli_query($con,"SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");
//If there are 2 words  assume they are first and last name respectively

else {
	$names = explode(" ",$query);

	if(count($names) == 3)
	$usersReturnedQuery = mysqli_query($con,"SELECT * FROM users WHERE (first LIKE '$names[0]%' AND last LIKE '$names[2]%') AND user_closed='no'");
//if query has one word only search first name and last names
	else if(count($names) == 2)
		$usersReturnedQuery = mysqli_query($con,"SELECT * FROM users WHERE (first LIKE '$names[0]%' OR last LIKE '$names[1]%') AND user_closed='no'");
	else
      $usersReturnedQuery = mysqli_query($con,"SELECT * FROM users WHERE (first LIKE '$names[0]%' OR last LIKE '$names[0]%') AND user_closed='no'");

  

}

//check if results were found
if(mysqli_num_rows($usersReturnedQuery) == 0)
	echo "We cant find anyone with a " . $type . " like: " . $query;

else
	echo mysqli_num_rows($usersReturnedQuery) . " results found: <br> <br>";

echo "<p id='grey'>Try searching for:</p>";
echo "<a href='search.php?q=" . $query . "&type=name'>Names</a>, <a href='search.php?q=" . $query . "&type=username'>Usernames</a><br><br><hr id='search_hr'>";

while($row = mysqli_fetch_array($usersReturnedQuery)) {
	$user_obj = new User($con, $user['username']);

	$button = "";
	$button2 = "";
	$mutual_friends = "";
	if($user['username'] != $row['username']) {
	//generate button on friendship status

      if($user_obj->isFriend($row['username']))
		$button = "<input type='submit' name='" . $row['username'] . "' class='danger' value='Remove Friend'>";
	else if($user_obj->didReceiveRequest($row['username']))
		$button = "<input type='submit' name='" . $row['username'] . "' class='warning' value='Respond to Friend Request'>";
	else if($user_obj->didSendRequest($row['username']))
		$button = "<input type='submit' name='" . $row['username'] . "' class='default' value='Request Sent'>";
	else
		$button = "<input type='submit' name='" . $row['username'] . "' class='success' value='Add Friend'>";


	if($user_obj->isCrush($row['username']))
		$button2 = "<input type='submit' name='" . $row['username'] . "' class='danger' value='Remove Friend'>";
	else if($user_obj->didReceiveRequest2($row['username']))
		$button2 = "<input type='submit' name='" . $row['username'] . "' class='warning' value='Respond to Crush Request'>";
	else if($user_obj->didSendRequest2($row['username']))
		$button2 = "<input type='submit' name='" . $row['username'] . "' class='default' value='Request Sent'>";
	else
		$button2 = "<input type='submit' name='" . $row['username'] . "' class='success' value='Add Crush'>";



	$mutual_friends = $user_obj->getMutualFriends($row['username']) . " friends in common";

	//button form
	if(isset($_POST[$row['username']])) {
		if($user_obj->isFriend($row['username'])) {
			$user_obj->removeFriend($row['username']);
			header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		}
		else if($user_obj->didReceiveRequest($row['username'])) {
			header("Location: requests.php");
		}
		else if($user_obj->didSendRequest($row['username'])) {
			//yet to be completed


		} 

		else {
			$user_obj->sendRequest($row['username']);
			header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		}
	}

	if(isset($_POST[$row['username']])) {
		if($user_obj->isCrush($row['username'])) {
			$user_obj->removeCrush($row['username']);
			header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		}
		else if($user_obj->didReceiveRequest2($row['username'])) {
			header("Location: requests2.php");
		}
		else if($user_obj->didSendRequest2($row['username'])) {
			//yet to be completed


		} 

		else {
			$user_obj->sendRequest($row['username']);
			header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
		}
	}

    

}
     echo "<div class='search_result'>
      <div class='searchPageFriendButtons'>
      <form action='' method='POST'>
      " . $button . "
      <br>
      </form>
      </div>

      <div class='result_profile_pic'>
      <a href='" . $row['username'] ."'><img src='". $row['profile_pic'] ."' style='height: 100px; '></a>
      </div>

      <a href='" . $row['username'] ."'> " . $row['first'] . " " . $row['last'] . "
      <p id='grey'>" . $row['username'] . "</p></a>
      <br>

      " . $mutual_friends . "<br>


     </div>
     <hr id='search_hr'>";


} // end while loop



}

	?>
</div>