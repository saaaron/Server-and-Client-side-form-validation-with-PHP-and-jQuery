<?php  
	// includes signup operation
	include "includes/signup.php";

	if (isset($_GET['signup'])) { // if URL = http://localhost/signup_validation/index.php?signup
		if ($_GET['signup'] == null) {
			$signup_msg = ''; // if URL = http://localhost/signup_validation/index.php?signup=
		} elseif ($_GET['signup'] == 'success') {
			$signup_msg = '
			<div class="alert alert-success alert-dismissible fade show">
				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				<strong>Hurray!</strong> Sign up was successful.
			</div>'; // if URL = http://localhost/signup_validation/index.php?signup=success
		} else {
			$signup_msg = ''; // if URL = http://localhost/signup_validation/index.php?signup!==success
		}
	} else {
		$signup_msg = ''; // if URL = http://localhost/signup_validation/index.php
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Server & Client-side form validation with PHP and jQuery</title>
	<link rel="icon" href="img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="container">
		<div class="row p-2">
			<div class="col-lg-1 col-xl-1 col-xxl-1"></div>
			<div class="col-md-6 col-lg-5 col-xl-5 col-xxl-5">
				<div>
					<h5>Server & Client-side Form validation [PHP & jQuery]</h5>
					<div class="card p-3 mb-2 bg-w">
						<div><b>Username</b></div>
						<div>
							Min <span class="badge bg-secondary">2</span>
						</div>
						<div>
							Max <span class="badge bg-secondary">10</span>
						</div>
						<div>
							Chars allowed
							<span class="badge bg-secondary">A-Z</span>
							<span class="badge bg-secondary">a-z</span>
							<span class="badge bg-secondary">0-9</span>
							<span class="badge bg-secondary">_</span>
							<span class="badge bg-secondary">.</span>
						</div>
						<div>
							Username not in use
						</div>
					</div>
					<div class="card p-3 mb-2 bg-w">
						<div><b>Full name</b></div>
						<div>
							Min <span class="badge bg-secondary">3</span>
						</div>
						<div>
							Max <span class="badge bg-secondary">20</span>
						</div>
						<div>
							Chars allowed
							<span class="badge bg-secondary">A-Z</span>
							<span class="badge bg-secondary">a-z</span>
							<span class="badge bg-secondary"> </span>
						</div>
					</div>
					<div class="card p-3 mb-2 bg-w">
						<div><b>Email address</b></div>
						<div>
							Valid email address only e.g. yourname@domain.com
						</div>
						<div>
							Email address not in use
						</div>
					</div>
					<div class="card p-3 mb-2 bg-w">
						<div><b>Password</b></div>
						<div>
							Min <span class="badge bg-secondary">6</span>
						</div>
						<div>
							Max <span class="badge bg-secondary">50</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-5 col-xl-5 col-xxl-5">
				<div class="mt-4">
					<?php echo $signup_msg; ?>
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" name="input-form" enctype="multipart/form-data" accept-charset="utf-8">
						<div class="mb-2">
							<b>Username</b>
							<input class="form-control" type="text" name="username" id="username" value="<?php if (isset($_POST['username'])) { echo $_POST['username']; } ?>" autocomplete="off"></input>
							<span class="text-danger" id="username_val"><?php echo $username_error_msg; ?></span>
						</div>
						<div class="mb-2">
							<b>Full name</b>
							<input class="form-control" type="text" name="fullname" id="fullname" value="<?php if (isset($_POST['fullname'])) { echo $_POST['fullname']; } ?>" autocomplete="off"></input>
							<span class="text-danger" id="fullname_val"><?php echo $full_name_error_msg; ?></span>
						</div>
						<div class="mb-2">
							<b>Email address</b>
							<input class="form-control" type="email" name="email" id="email" value="<?php if (isset($_POST['email'])) { echo $_POST['email']; } ?>" autocomplete="off"></input>
							<span class="text-danger" id="email_val"><?php echo $email_error_msg; ?></span>
						</div>
						<div class="mb-2">
							<b>Password</b>
							<input class="form-control" type="password" name="password" id="password" value="<?php if (isset($_POST['password'])) { echo $_POST['password']; } ?>" autocomplete="off"></input>
							<span class="text-danger" id="password_val"><?php echo $password_error_msg; ?></span>
						</div>
						<div class="d-grid">
							<button type="submit" class="btn btn-outline-success btn-block">Done</button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-1 col-xl-1 col-xxl-1"></div>
		</div>
		<div class="text-center p-2">
			<p>&copy; 2023 Built by <a href="https://saaaron.github.io/" target="_blank"><b>Sa Aaron</b></a>
		</div>
	</div>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery-3.7.0.min.js" type="text/javascript" charset="utf-8" async defer></script>
	<script src="js/form-validation.js" type="text/javascript" charset="utf-8" async defer></script>
</body>
</html>