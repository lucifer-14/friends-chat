<?php
include "admin/config.php";
include "logincommon.php";

if (isset($_POST['recovery'])) {
	$username = $_POST['username'];
	validateRecovery($username, 'recover.php?url='.$_GET['url'], false);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Account Recovery | Savage Anime</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="admin/images/savage_logo.png" sizes="128x128" />
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
						Account Recovery
					</span>
				</div>
				<form class="login100-form validate-form" action="forgot.php?url=<?php echo str_replace("url=","",$_SERVER["QUERY_STRING"]) ?>" method="post">
					<input hidden name="url" value="<?php echo str_replace("url=","",$_SERVER["QUERY_STRING"]) ?>" />
					<p class="text-danger"><?php echo $error ?? ''; ?></p>
					<div class="wrap-input100 m-b-26">
						<span class="label-input100">Username or Email</span>
						<input class="input100" type="username" name="username" placeholder="Enter username or email" autocomplete="off">
					</div>


					<div class="row" style=" width:100%">
						<div class="col-sm-6 col-6">
							<div class="form-group">
								<a href="login.php?url=<?php echo str_replace("url=","",$_SERVER["QUERY_STRING"])?>" class="login100-form-btn sign-up-btn">
									Cancel
								</a>
							</div>
						</div>
						<div class="col-sm-6 col-6">
							<div class="form-group">
								<button class="login100-form-btn" type="submit" name="recovery">
									Recover Password
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