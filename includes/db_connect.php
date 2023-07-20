<?php
	$db = mysqli_connect('localhost', 'root', '', 'users_signup');

	// Evaluate connection
	if(mysqli_connect_errno()) {
		echo 'Ops! A problem occured';
		exit();
	}
?>