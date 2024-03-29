<?php
include('classes/db.php');
include('header.php');

if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {

				if (password_verify($password, DB::query('SELECT password FROM users WHERE username=:username', array(':username'=>$username))[0]['password'])) {
						echo '<p /><font color="red">Logged in!</font>';

						$cstrong = True;
						$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
						$user_id = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$username))[0]['id'];
						DB::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));

						setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
						setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
						header("location: profile.php?username=$username");

				} else {
						echo '<p /><font color="red">Incorrect Password!</font>';
				}

		} else {
				echo'<p /><font color="red">User not registered!</fomt>';
		}
	}

if (isset($_POST['forgot'])) {
		header("location: forgot_pass.php");
}
?>
<div class="ContentLeft">
<h1>Login to your account</h1>
<form action="login.php" method="post">
<input class="StyleTxtField" type="text" name="username" value="" placeholder="Username..."><p />
<input class="StyleTxtField" type="password" name="password" value="" placeholder="Password..."><p />
<input type="submit" name="login" value="Login"><p />
</form>
</div>