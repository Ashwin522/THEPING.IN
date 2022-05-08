<?php
include("../../config/config.php");
include("../classes/User.php");
include("../classes/Notifications.php");

$limit = 15; //number of messages to load

$notification = new Notifications($con,$_REQUEST['userLoggedIn']);
echo $notification->getNotifications($_REQUEST,$limit);

?>