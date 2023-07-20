<?php
	if(isset($_POST['password'])) {
 		$response = array();

 		$password = $_POST['password']; // user's password

        if (empty(trim($password))) {
        	$response['msg'] = 'Password is empty';
        } elseif (strlen($password) < 6) {
 			$response['msg'] = 'Password must be greater than 6 characters';
 		} elseif (strlen($password) > 50) {
 			$response['msg'] = 'Password must be less than 50 characters';
 		} else {
 			$response['msg'] = '';
 		}
 		
 		echo json_encode($response);
    }
?>