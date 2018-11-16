<?php
include('classes/db.php');
include('header.php');

if (isset($_POST['reset'])) {

	$cstrong = True;
	$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
	$email = $_POST['email'];
	$user_id = DB::query('SELECT id FROM users WHERE email=:email', array(':email'=>$email))[0]['id'];
	DB::query('INSERT INTO password_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
	echo '<p /><font color="green">Email sent!</font>';
	echo'<br />';
	echo $token;
	header("location: change-password.php");
}


?>
<div class="ContentLeft">
<h1>Forgot Password</h1>
<form action="forgot_pass.php" method="post">
		<input class="StyleTxtField" type="text" name="email" value="" placeholder="Email..."><p />
		<input type="submit" name="reset" value="Reset Password">
</form>
</div>