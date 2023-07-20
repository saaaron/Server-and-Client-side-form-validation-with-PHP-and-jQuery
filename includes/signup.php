<?php  
	// include database connection
	include "includes/db_connect.php";

	// variables
	$username_error = $username_error_msg = $full_name_error = $full_name_error_msg = $email_error = $email_error_msg = $password_error = $password_error_msg = $signup_msg = ""; 
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// username validation
		if (empty(trim($_POST["username"]))) {
			$username_error_msg = 'Username is empty'; // username error message
			$username_error = true;
		} elseif (strlen(preg_replace('/[^a-zA-Z]/m', '', $_POST["username"])) < 2) {
			$username_error_msg = 'Username must have at least 2 letters';
			$username_error = true;
		} elseif (strlen($_POST["username"]) > 10) {
			$username_error_msg = 'Username must be less than 10 characters';
			$username_error = true;
		} elseif (!preg_match("/^[a-zA-Z0-9_.]{2,10}+$/ ", $_POST["username"])) {
			$username_error_msg = 'Username must be in letters with either a number(0-9), underscore(_) or dot(.)';
			$username_error = true;
		} else {
			// prepare select statement
			$check_uname = "SELECT * FROM users WHERE name = ?";
			if ($stmt = mysqli_prepare($db, $check_uname)) {

				// bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // set parameters
                $param_username = $_POST["username"];

                // attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){

                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                      	$username_error_msg = '<b>'.$_POST["username"].'</b> is already in use';
                      	$username_error = true;
                    } else {
                        $username = $_POST["username"];
                        $username_error = false;
                    }
                } else {
                    $username_error_msg = '<b>Oops!</b> Something went wrong. Please try again later';
                    $username_error = true;
                }
			}

			// close statement
            mysqli_stmt_close($stmt);
		}

		// full name validation
		if (empty(trim($_POST["fullname"]))) {
			$full_name_error_msg = "Full name is empty"; // full name error message
			$full_name_error = true;
		} elseif (strlen(preg_replace('/[^a-zA-Z]/m', '', $_POST["fullname"])) < 3) {
			$full_name_error_msg = 'Full name must be greater than 3';
			$full_name_error = true;
		} elseif (strlen($_POST["fullname"]) > 20) {
			$full_name_error_msg = 'Full name must be less than 20';
			$full_name_error = true;
		} elseif (!preg_match("/^[a-zA-Z\s]{3,30}+$/ ", $_POST["fullname"])) {
			$full_name_error_msg = 'Full name must be in letters with either a space';
			$full_name_error = true;
		} else {
			$full_name = ucwords($_POST['fullname']);
			$full_name_error = false;
		}

		// email validation
		if (empty(trim($_POST["email"]))) {
			$email_error_msg = 'Email address is empty'; // email address error message
			$email_error = true;
		} elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
			$email_error_msg = 'Email address is invalid';
			$email_error = true;
		} else {
			// prepare select statement
			$check_email = "SELECT * FROM users WHERE email = ?";
			if($stmt = mysqli_prepare($db, $check_email)) {

				// bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);

                // set parameters
                $param_email = $_POST["email"];

                // attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){

                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1){
                      	$email_error_msg = '<b>'.$_POST["email"].'</b> is already in use';
                      	$email_error = true;
                    } else{
                        $email = $_POST["email"];
                        $email_error = false;
                    }
                } else{
                    $email_error_msg = '<b>Oops!</b> Something went wrong. Please try again later';
                    $email_error = true;
                }
			}
		}

		// password validation
		if (empty($_POST['password'])) {
			$password_error_msg = "Password is empty"; // password error message
			$password_error = true;
		} elseif (strlen($_POST['password']) < 6) {
			$password_error_msg = 'Password must be greater than 6 characters';
			$password_error = true;
		} elseif (strlen($_POST['password']) > 50) {
			$password_error_msg = 'Password must be less than 50 characters';
			$password_error = true;
		} else {
			$password = $_POST['password'];
			$password_error = false;
		}

		// check errors are all false before inserting into database
		if ($username_error == false && $full_name_error == false && $email_error == false && $password_error == false) {

			// PREPARE INSERT STATEMENT
			// `users`
			$insert = "INSERT INTO users(name, full_name, email, password) VALUES(?, ?, ?, ?)";

			if ($stmt = mysqli_prepare($db, $insert)) {

				// SET PARAMETERS
				$param_username = $username; // user's name
				$param_full_name = $full_name; // user's full name
                $param_email = $email; // user's email address
                $param_password = password_hash($password, PASSWORD_DEFAULT); // user's password (hashed)

                // `users`
				$insert = "INSERT INTO users(name, full_name, email, password) VALUES(?, ?, ?, ?)";
				$stmt = mysqli_prepare($db, $insert);
	            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_full_name, $param_email, $param_password);
	            mysqli_stmt_execute($stmt);

				
				// run Post Redirect Get (PRG) pattern for successful signup
                header("location: includes/prg.php");
						
			} else {
				// signup failed message
				$signup_msg = '
				<div class="alert alert-danger alert-dismissible fade show">
					<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					<strong>Ops!</strong> Sign up was unsuccessful.
				</div>';		
			} 
            // close statement
            mysqli_stmt_close($stmt);
		}
		// close db connection
        mysqli_close($db);
    }
?>