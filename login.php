<?php
include "utilities/config.php";
include "utilities/logincommon.php";

if (isset($_SESSION['userId'])) {
    header("location:index.php");
    exit();
}

//check login post request
if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	validateUser($username, $password, 'index.php', false);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login | Friends-Chat</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="images/savage_logo.png" sizes="128x128" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="logincomponent/css/util.css">
	<link rel="stylesheet" type="text/css" href="logincomponent/css/main.css">
</head>

<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(logincomponent/images/animescover1.jpg);">
					<span class="login100-form-title-1" style="letter-spacing: 4px;">
						Log In
					</span>
				</div>
				<form class="login100-form validate-form" action="login.php" method="post">
					<p class="text-danger"><?php echo $error ?? ''; ?></p>
					<div class="wrap-input100 m-b-26">
						<span class="label-input100">Username or Email</span>
						<input class="input100" type="text" name="username" placeholder="Enter username or email" autocomplete="off">
					</div>

					<div class="wrap-input100 m-b-26">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="password" placeholder="Enter password" autocomplete="off">
					</div>

					<div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">

						</div>
						<div>
							<a href="forgot.php" class="txt1">Forgot Password?</a>
						</div>
					</div>
					<div class="row" style=" width:100%">
						<div class="col-sm-6 col-6">
							<div class="form-group">
								<a href="register.php" class="login100-form-btn sign-up-btn">
									Register
								</a>
							</div>
						</div>
						<div class="col-sm-6 col-6">
							<div class="form-group">
								<button class="login100-form-btn" type="submit" name="login">
									Log In
								</button>
							</div>

						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
<style type="text/css">
	a:hover{
		color: #666666 !important;
	}
</style>

</html>