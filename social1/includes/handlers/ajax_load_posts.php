<?php
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Post1.php");

$limit = 10; //number of posts to be loaded per call

$posts = new Post($con,$_REQUEST['userLoggedIn']);
$posts->loadPostsFriends($_REQUEST, $limit);






?>