<?php
	if(isset($_POST['fullname'])) {
 		$response = array();

 		$fullname = $_POST['fullname']; // user's full name

        if (empty(trim($fullname))) {
        	$response['msg'] = 'Full name is empty';
        } elseif (strlen(preg_replace('/[^a-zA-Z]/m', '', $fullname)) < 3) {
 			$response['msg'] = 'Full name must be greater than 3';
 		} elseif (strlen($fullname) > 20) {
 			$response['msg'] = 'Full name must be less than 20';
 		} elseif (!preg_match("/^[a-zA-Z\s]{3,30}+$/ ", $fullname)) {
 			$response['msg'] = 'Full name must be in letters with either a space';
 		} else {
 			$response['msg'] = '';
 		}
 		
 		echo json_encode($response);
    }
?>