<?php
	// include database connection
	include 'db_connect.php';

	if (isset($_POST['email'])) {
 		$response = array();
 		
 		$email = $_POST['email']; // user's email address

        // check if email is already in use
		$check_email = "SELECT * FROM users WHERE email = ?";
		$stmt = mysqli_prepare($db, $check_email);
		mysqli_stmt_bind_param($stmt, "s", $email);
		mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        if (empty(trim($email))) {
        	$response['msg'] = 'Email address is empty';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 			$response['msg'] = 'Email address is invalid';
 		} elseif (mysqli_stmt_num_rows($stmt) == 1) {
 			$response['msg'] = '<b>'.$email.'</b> is already in use';
 		} else {
 			$response['msg'] = '';
 		}
 		
 		echo json_encode($response);
    }
?>