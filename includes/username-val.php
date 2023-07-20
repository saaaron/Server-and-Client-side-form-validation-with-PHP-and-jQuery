<?php
	// include database connection
	include 'db_connect.php';

	if (isset($_POST['username'])) {
 		$response = array();
 		
 		$username = $_POST['username']; // user's name

        // check if username is already in use
		$check_username = "SELECT * FROM users WHERE name = ?";
		$stmt = mysqli_prepare($db, $check_username);
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        if (empty(trim($username))) {
        	$response['msg'] = 'Username is empty';
        } elseif (mysqli_stmt_num_rows($stmt) == 1) {
 			$response['msg'] = '<b>'.$username.'</b> is already in use';
 		} elseif (strlen(preg_replace('/[^a-zA-Z]/m', '', $username)) < 2) {
 			$response['msg'] = 'Username must have at least 2 letters';
 		} elseif (strlen($username) > 10) {
 			$response['msg'] = 'Username must be less than 10 characters';
 		} elseif (!preg_match("/^[a-zA-Z0-9_.]{2,10}+$/ ", $username)) {
 			$response['msg'] = 'Username must be in letters with either a number(0-9), underscore(_) or dot(.)';
 		} else {
 			$response['msg'] = '';
 		}
 		
 		echo json_encode($response);
    }
?>