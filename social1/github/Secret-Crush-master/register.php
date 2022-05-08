<?php


session_start();
$timezone = date_default_timezone_set("Indian/Maldives");
$con = mysqli_connect("localhost","root","","network");//connection variable
if(mysqli_connect_errno()) 
	echo " FAILED TO CONNECT: " . mysqli_connect_errno();





$fname ="";

$lastname="";

$em="";

$em2="";

$gen="";

$age="";

$password="";

$password2="";

$date="";

$error_array=array();


//LOGIN BUTTON

if(isset($_POST['login_button'])) {

	$email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL); //sanitize email

	$_SESSION['log_email'] = $email; //Store email into session variable 
	$password = md5($_POST['log_password']); //Get password

	$check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
	$check_login_query = mysqli_num_rows($check_database_query);

	if($check_login_query == 1) {
		$row = mysqli_fetch_array($check_database_query);
		$username = $row['username'];

		$user_closed_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND user_closed='yes'");
		if(mysqli_num_rows($user_closed_query) == 1) {
			$reopen_account = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email'");
		}

		$_SESSION['username'] = $username;
		header("Location: index.php");
		exit();
	}
	else {
		array_push($error_array, "Email or password was incorrect<br>");
	}


}




if(isset($_POST['register_button']))

{

//registration form values



//first name

$fname=strip_tags($_POST['reg_fname']);//remove html tags

$fname=str_replace(' ','',$fname);//remove spaces

$fname=ucfirst(strtolower($fname));//uppercase first letter

$_SESSION['reg_fname'] = $fname;//stores first name into session variable



//last name

$lname=strip_tags($_POST['reg_lname']);//remove html tags

$lname=str_replace(' ','',$lname);//remove spaces

$lname=ucfirst(strtolower($lname));//uppercase first letter

$_SESSION['reg_lname'] = $lname;//stores last name into session variable

//GENDER

$_SESSION['gender'] = $gen;

//AGE
$_SESSION['age'] = $age;





//email

$em=strip_tags($_POST['reg_email']);//remove html tags

$em=str_replace(' ','',$em);//remove spaces

$em=ucfirst(strtolower($em));//uppercase first letter

$_SESSION['reg_email'] = $em;//stores email into session variable



//email2

$em2=strip_tags($_POST['reg_email2']);//remove html tags

$em2=str_replace(' ','',$em2);//remove spaces

$em2=ucfirst(strtolower($em2));//uppercase first letter

$_SESSION['reg_email2'] = $em2;//stores email2 into session variable





//password

$password=strip_tags($_POST['reg_password']);//remove html tags

$password2=strip_tags($_POST['reg_password2']);



$date=date("Y-m-d");//current date

if($em==$em2) {

//check if email is there in valid format

if(filter_var($em,FILTER_VALIDATE_EMAIL)) {



$em = filter_var($em,FILTER_VALIDATE_EMAIL);

//check if email already exists

$e_check=mysqli_query($con,"SELECT EMAIL FROM users WHERE email='$em'");



//count the number of rows returned

$num_rows=mysqli_num_rows($e_check);



if($num_rows > 0)

{

array_push($error_array,"email already in use<br>");

}



}

else

{

array_push($error_array,"INVALID EMAIL FORMAT<br>");

}

}

else {

array_push($error_array,"emails dont match<br>");

}



if(strlen($fname) > 25 || strlen($fname) < 2) {

array_push($error_array,"your first name must be between 2 and 25 characters<br>");

}

if(strlen($lname) > 25 || strlen($lname) < 2) {

array_push($error_array,"your last name must be between 2 and 25 characters<br>");



}
if(isset($_POST['gender']) && $_POST['gender'] == '--select--'){ 
	array_push($error_array,"not selected gender<br>");
}
 else
 {
 empty($error_array);
$gen = $_POST['gender'];
}


if(isset($_POST['age']) && $_POST['age'] == '0'){ 
	array_push($error_array,"not selected age<br>");
}
 else
 {
 empty($error_array);
$age = $_POST['age'];
}




if($password!=$password2) {

array_push($error_array,"your passwords do not match<br>");

}

else

{

if(preg_match('/[^A-Za-z0-9]/',$password)) {

array_push($error_array,"your password can only contain english characters or numbers<br>");

}

}

if(strlen($password)>30||strlen($password)<5) {

array_push($error_array,"your password must be between 5 or 30<br>");



}

if(empty($error_array))


{

$password=md5($password);//encrypt password before sending to database

//generate username by concatenating firstname and lastname

$username =strtolower($fname."_".$lname);

$check_username_query=mysqli_query($con,"SELECT username FROM users WHERE username='$username'");

$i = 0;

//if username existsadd number to username

while(mysqli_num_rows($check_username_query) != 0) {

$i++;//add 1 to i

$username = $username."_".$i;

$check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username='$username'");



}

//profile picture assignment

$rand = rand(1,2);//random number between 1 and 2

if($rand == 1)

$profile_pic = "assets/images/profile_pics/defaults/head_belize_hole";

   else if($rand == 2)

   	$profile_pic = "assets/images/profile_pics/defaults/head_carrot";



$query = mysqli_query($con,"INSERT INTO users VALUES(NULL,'$fname','$lname','$gen','$age','$username','$em','$password','$date','$profile_pic','0','0','no',',')");



   
array_push($error_array,"SIGNUP SUCCESSFULL<br>");


//clear session variables

$_SESSION['reg_fname']="";

$_SESSION['reg_lname']="";

$_SESSION['reg_email']="";

$_SESSION['reg_email2']="";





}





  }





?>





















<!DOCTYPE html>

<html>

<head>
		<link rel="stylesheet" href="style.css">

<title>Welcome to PING!</title>

</head>

<body>

	<form action="register.php" method="POST">
		<header><span style = 'color:#DF0425;'>LOG IN</header>
		<input type="email" name="log_email" placeholder="Email Adddress">
		<br>
		<input type="password" name="log_password" placeholder="Enter Password">
		<br>
		<input type="submit" name="login_button" placeholder="Login">
		<br>
		<br>



	</form>	

<form action="register.php" method="post">
<HEADER><span style = 'color:#0514DE;'>SIGN UP</HEADER>
<input type="text" name="reg_fname" placeholder="First Name" value= "<?php

if(isset($_SESSION['reg_fname'])){

echo $_SESSION['reg_fname'];

}  ?>

" required>

<br>



<?php if(in_array("your first name must be between 2 and 25 characters<br>",$error_array))

echo "your first name must be between 2 and 25 characters<br>";



?>



<input type="text" name="reg_lname" placeholder="Last Name"

value= "<?php

if(isset($_SESSION['reg_lname'])){

echo $_SESSION['reg_lname'];

}  ?>

" required>

<br>

<?php if(in_array("your last name must be between 2 and 25 characters<br>",$error_array))

echo "your last name must be between 2 and 25 characters<br>";

if(in_array("you have entered a number<br>",$error_array))
echo "you have entered a number<br>";

?>




<br>

<label for="gender">Gender</label>
						<select id="gender" name="gender" value="<?php

if(isset($_SESSION['gender'])){

echo $_SESSION['gender'];

}  ?>
">
							<option value="--select--">--select--</option>
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>

						<br>
						<?php if(in_array("not selected gender<br>",$error_array)){
							echo "NOT SELECTED GENDER<br>";
						} ?>
						<br>



<label for="age">Age</label>
						<select name="age" value="<?php

if(isset($_SESSION['age'])){

echo $_SESSION['age'];

}  ?>

"  required>">
							<?php
						for ($i=18; $i<50; $i++)
						{
							?>
							<option value="0"></option>
							<option value="<?php echo $i;?>"><?php echo $i;?></option>
							<?php
						}
					?>
						</select>
						<?php if(in_array("not selected age<br>",$error_array)){
							echo "NOT SELECTED AGE<br>";
						} ?>
						<br>




<input type="email" name="reg_email" placeholder="Email"

value= "<?php

if(isset($_SESSION['reg_email'])){

echo $_SESSION['reg_email'];

}  ?>

"  required>

<br>



<input type="email" name="reg_email2" placeholder="Confirm Email"

value= "<?php

if(isset($_SESSION['reg_email2'])){

echo $_SESSION['reg_email2'];

}  ?>"

  required>

<br>

<?php if(in_array("INVALID EMAIL FORMAT<br>",$error_array))

echo "INVALID EMAIL FORMAT<br>";

elseif(in_array("emails dont match<br>",$error_array))

echo " emails dont match<br>";

elseif(in_array("email already in use<br>",$error_array))

echo "EMAIL already in use<br>";

?>



<input type="password" name="reg_password" placeholder="Password"

value= "<?php

if(isset($_SESSION['reg_password'])){

echo $_SESSION['reg_password'];

}  ?>

"  required>

<br>

<input type="password" name="reg_password2" placeholder="Confirm Password"

value= "<?php

if(isset($_SESSION['reg_password2'])){

echo $_SESSION['reg_password2'];

}  ?>" required>

<br>

<?php if(in_array("your passwords do not match<br>",$error_array))

echo "your passwords do not match<br>";

else if(in_array("your password can only contain english characters or numbers<br> ",$error_array))

echo "your password can only contain english characters or numbers<br>";

else if(in_array("your password must be between 5 or 30<br>",$error_array))

echo "your password must be between 5 or 30<br>";

?>



<input type="submit" name="register_button" value="Register">

<br>

<?php



if(in_array("SIGNUP SUCCESSFULL<br>",$error_array))
{

echo "<span style = 'color:#14C800;'>SIGNUP SUCCESSFULL<br></span>";


$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";
		$_SESSION['reg_age']="";
		$_SESSION['reg_gen']="";
}

?>

