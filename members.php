<?php //members.php

include('classes/db.php');
include('classes/Login.php');
include('header2.php');


DB::query('SELECT username FROM users');

?>
