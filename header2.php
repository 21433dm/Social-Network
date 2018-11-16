<?php //header.php

?>

<html>
<head>
	<link href="scripts/layout.css" rel="stylesheet" type-"text/css" />
	<link href="scripts/menu.css" rel="stylesheet" type-"text/css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript">
		function display_c(){
		var refresh=1000; // Refresh rate in milli seconds
		mytime=setTimeout('display_ct()',refresh)
	}
	</script>
	<title>Project Finder</title>
	</head>
	<body>
		<div class="Holder">
			<div class="Header"><img src="images/cclogo.jpg" height="70"></div>
			<div class="NavBar">
				<nav>
					<ul>
						<li><a href="login.php">Login</a></li>
						<li><a href="create-account.php">Register</a></li>
						<li><a href="change-password.php">Change Password</a></li>
						<li><a href="members.php">Members</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</nav>				
			</div>
		</body>
	<html>