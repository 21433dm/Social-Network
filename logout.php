<?php
include('classes/db.php');
include('classes/Login.php');
include('header.php');

if (!Login::isLoggedIn()){
		die("<p /><font color='red'>Not logged in</font>");
}

if(isset($_POST['confirm'])) {

		DB::query('DELETE FROM login_tokens WHERE user_id=:user_id', array(':user_id'=>Login::isLoggedIn()));

		if(isset($_COOKIE['SNID'])) {
		DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
		}
		setcookie('SNID', '1', time()-3600);
		setcookie('SNID_', '1', time()-3600);
		header("location: index.php");
		}
?>
<div class="ContentLeft">
<h1>Logout of your account?</h1>
<p>Are you sure you'd like to logout?</p>
<form action="logout.php" method="post">
		<!--p /><input type="checkbox" name="alldevices" value="alldevices">Logout of all devices?<br /><br /-->
		<input class="Button" type="submit" name="confirm" value="Confirm">
</form>
</div>