<?php
include('classes/db.php');
include('header.php');

if (isset($_POST['createaccount'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];

		if (!DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {

				if(strlen($username) >= 3 && strlen($username) <= 32) {

						if (preg_match('/[a-zA-Z0-9_]+/', $username)) {

								if(strlen($password) >= 6 && strlen($password) <= 60) {

										if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

												if(!DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))) {

											DB::query('INSERT INTO users VALUES (\'\', :username, :password, :email)', array(':username'=>$username, ':password'=>password_hash($password, PASSWORD_BCRYPT), ':email'=>$email));
												echo"Success!";
												header("location: login.php");
											} else {
												echo '<p /><font color="red">Email in use!</font>';
											}

										} else {
												echo '<p /><font color="red">Invalid email!</font>';
										}
								} else {
										echo '<p /><font color="red">Invalid password!</font>';
								}
								} else {
										echo '<p /><font color="red">Invalid username!</font>';
								}
						} else {
								echo '<p /><font color="red">Invalid username!</font>';
						}
				} else {
						echo '<p /><font color="red">User already exists!</font>';
				}

}
?>
<div class="ContentLeft">
<h1>Register</h1>
<form class="create-account.php" method="post">
<input class="StyleTxtField" type="text" name="username" value="" placeholder="Username..."><p />
<input class="StyleTxtField" type="password" name="password" value="" placeholder="Password..."><p />
<input class="StyleTxtField" type="text" name="email" value="" placeholder="someone@somesite.com..."><p />
<input type="submit" name="createaccount" value="Create Account">
</form>
</div>