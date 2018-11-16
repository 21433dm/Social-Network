<?php
include('classes/db.php');
include('classes/Login.php');
include('header2.php');

if (Login::isLoggedIn()) {

		echo '<p /><font color="green">Logged in!</font>';
		
} else {
		echo '<p /><font color="red">Not logged in!</font>';
}

?>

