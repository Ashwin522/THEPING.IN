<?php
require 'config/config.php';
include("includes/classes/Message.php");
include("includes/classes/User.php");
include("includes/classes/Post1.php");
include("includes/classes/Notifications.php");





if(isset($_SESSION['username'])) {
	$userLoggedIn = $_SESSION['username'];
	$user_details_query = mysqli_query($con,"SELECT * FROM users WHERE username='$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);
}
else {
	header("Location: register1.php");
}
?>
<html>
<head>
	<title>Welcome to PING!</title>
	
	<!--javascript links-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 <script src="https://kit.fontawesome.com/71db4d34ca.js"></script>
 <script src="assets/js/ping.js"></script>
 <script src="assets/js/bootbox.min.js"></script>
 <script src="assets/js/jquery.jcrop.js"></script>
<script src="assets/js/jcrop_bits.js"></script>
<script src="assets/js/register.js"></script>




<!--css links-->
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />


</head>
<body>
	<div class="top_bar">

		<div class="logo">
			<a href="index.php">PING!</a>
		</div>
		<div class="search">
			<form action="search.php" method="GET" name="search_form">
				<input type="text" onkeyup="getLiveSearchUsers(this.value,'<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search..." autocomplete="off" id="search_text_input">

				<div class="button_holder">
					<img src="assets/images/icons/magnifying_glass.png">

					

				</div>


				

			</form>

			<div class="search_results">
				

			</div>

			<div class="search_results_footer_empty">
				

			</div>
			
		</div>
<nav>

	<?php
    //unread messages
    $messages = new Message($con,$userLoggedIn);
    $num_messages = $messages->getUnreadNumber();
    
     $notifications = new Notifications($con,$userLoggedIn);
    $num_notifications = $notifications->getUnreadNumber();

     $user_obj = new User($con,$userLoggedIn);
    $num_requests = $user_obj->getNumberFriendRequests();


     $user_obj = new User($con,$userLoggedIn);
    $num_requests2 = $user_obj->getNumberCrushRequests();

    $user_obj = new User($con,$userLoggedIn);
    $num_requests1 = $user_obj->getNumberCrushRequests1();
    
    





	?>
	<a href="<?php echo $userLoggedIn; ?>">
		<?php echo $user['first']; ?>
  
	<a href="#"><i class="fas fa-home"></i></a>
	<a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>','message')"><i class="fas fa-envelope"></i>
		<?php
		if($num_messages > 0)
		echo '<span class="notification_badge" id="unread_messages">' . $num_messages .'</span>';
		?>
	</a>
	<a href="requests2.php"><i class="fas fa-heart"></i>
		 <?php
		if($num_requests2 > 0 && $num_requests1 > 0)
		echo '<span class="notification_badge" id="unread_requests">' . $num_requests1 .'</span>';
	
		?>
	  </a>

	<a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>','notification')"><i class="fas fa-bell"></i>

	<?php
		if($num_notifications > 0)
		echo '<span class="notification_badge" id="unread_notifications">' . $num_notifications .'</span>';
	
		?>
	</a>
	<a href="settings.php"><i class="fas fa-cog"></i></a>
	 
	  <a href="requests.php"><i class="fas fa-users"></i>
      <?php
		if($num_requests > 0)
		echo '<span class="notification_badge" id="unread_requests">' . $num_requests .'</span>';
	
		?>
	  </a>
	   <a href="includes/handlers/logout.php"><i class="fas fa-sign-out-alt"></i></a>



</nav>

<div class="dropdown_data_window" style="height:0px; border:none;"></div>
<input type="hidden" id="dropdown_data_type" value="">



	</div>

	<script>
$(function(){
 
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';
	var inProgress = false;
 
	loadPosts(); //Load first posts
 
    $(window).scroll(function() {
    	var inner_height = $('.dropdown_data_window').innerHeight();
    	var scroll_top = $('.dropdown_data_window').scrollTop();
    	var page = $('.dropdown_data_window').find('.getDropdownData').val();
    	var bottomElement = $(".status_post").last();
    	var noMoreData = $('.dropdown_data_window').find('.noMoreData').val();
 
        // isElementInViewport uses getBoundingClientRect(), which requires the HTML DOM object, not the jQuery object. The jQuery equivalent is using [0] as shown below.
        if (isElementInView(bottomElement[0]) && noMorePosts == 'false') {
            loadPosts();
        }
    });
 
    function loadPosts() {
        if(inProgress) { //If it is already in the process of loading some posts, just return
			return;
		}
		
		inProgress = true;
		$('#loading').show();
 
		var page = $('.posts_area').find('.nextPage').val() || 1; //If .nextPage couldn't be found, it must not be on the page yet (it must be the first time loading posts), so use the value '1'
 
    }
 
    //Check if the element is in view
    function isElementInView (el) {
        var rect = el.getBoundingClientRect();
 
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && //* or $(window).height()
            rect.right <= (window.innerWidth || document.documentElement.clientWidth) //* or $(window).width()
        );
    }

return false;

});//end
 
</script>


	<div class="wrapper">
