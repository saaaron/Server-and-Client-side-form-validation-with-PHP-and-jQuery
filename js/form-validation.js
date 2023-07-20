$(document).ready(function() {
	// username validation
 	$('#username').keyup(function() {
 		var username_val = $(this).val();
 		$.post("includes/username-val.php", {username: username_val} , function(undata) {
 			$('#username_val').html(undata.msg);
 		},'json');
 	});

 	// full name validation
 	$('#fullname').keyup(function() {
 		var fullname_val = $(this).val();
 		$.post("includes/fullname-val.php", {fullname: fullname_val} , function(fndata) {
 			$('#fullname_val').html(fndata.msg);
 		},'json');
 	});

 	// email validation
 	$('#email').keyup(function() {
 		var email_val = $(this).val();
 		$.post("includes/email-val.php", {email: email_val} , function(eddata) {
 			$('#email_val').html(eddata.msg);
 		},'json');
 	});

 	// password validation
 	$('#password').keyup(function() {
 		var password_val = $(this).val();
 		$.post("includes/password-val.php", {password: password_val} , function(pwdata) {
 			$('#password_val').html(pwdata.msg);
 		},'json');
 	});
});