<?php
include("include/conn.php");
include("include/function.php");
$login = cekSession();
if ($login == 1)
{
    redirect("index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Your Account</title>
	<link rel="stylesheet" type="text/css" href="login-page/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="login-page/img/wave.png">
	<div class="container">
		<div class="img">
			<img src="login-page/img/bg.svg">
		</div>
		<div class="login-content">
		<form id="login-form">
				<img src="login-page/img/avatar.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" id="username" name="username" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password"  id="password" name="password"class="input">
            	   </div>
            	</div>
            	<a href="#">Forgot Password?</a>
            	<input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="login-page/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function () {
    $('#login-form').submit(function (e) {
        e.preventDefault(); // Prevent the default form submission
        
        // Get the form data
        var formData = {
            username: $('#username').val(),
            password: $('#password').val()
        };

        // Send an AJAX POST request to your PHP script
        $.ajax({
            type: 'POST',
            url: 'function/check-login.php', // Replace with the correct path to your PHP script
            data: formData,
            success: function (response) {
		
                if (response == 'success') {
                    alert('Login Success.');
                    window.location.href = 'index.php';
                } else {
                    // Handle login failure (e.g., show an error message)
                    alert('Login failed.');
                }
            }
        });
    });
});
</script>

</body>
</html>
