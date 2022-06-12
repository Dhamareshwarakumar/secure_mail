<?php
	require 'includes/include.php';

	if(isset($_SESSION['user'])) {
		header("Location: ./index.php");
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Login | Capstone</title>

	<!--=================Bootstrap==============-->
	<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" />  
	<!--=================Bootstrap==============-->

	<!--=================Sweet Alert==============-->
	<script src="node_modules/sweetalert/dist/sweetalert.min.js"></script>
	<!--=================Sweet Alert==============-->

	<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:600'><link rel="stylesheet" href="./css/login_style.css">
	
	<style>
			body {
			background-image: url("./assets/img/bg.jpg");
			background-repeat: no-repeat;
			background-size: cover;
			background-position: fit;
			position:relative;
		}
	</style>
</head>
<body>
<!-- partial:index.partial.html -->
<?php require "./navbar.php"; ?>
<div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
		<div class="login-form">
			<div class="sign-in-htm">
				<form method="POST" action="./includes/login.php">
					<div class="group">
						<label for="user" class="label">Username</label>
						<input id="user" type="text" class="input" name="username">
					</div>
					<div class="group">
						<label for="pass" class="label">Password</label>
						<input id="pass" type="password" class="input" data-type="password" name="password">
					</div>
					<div class="group">
						<input type="submit" class="button" value="Sign In" name="submit">
					</div>
					<!--div class="hr"></div>
					<div class="foot-lnk">
						<a href="#forgot">Forgot Password?</a>
					</div -->
				</form>
			</div>
			<div class="sign-up-htm">
				<form action="./includes/signup.php" method="POST">
					<div class="group">
						<label for="user" class="label">Username</label>
						<input id="user" type="text" class="input" name="username">
					</div>
					<div class="group">
						<label for="pass" class="label">Password</label>
						<input id="pass" type="password" class="input" data-type="password" name="password">
					</div>
					<div class="group">
						<label for="pass" class="label">Repeat Password</label>
						<input id="pass" type="password" class="input" data-type="password" name="cpassword">
					</div>
					<div class="group">
						<label for="pass" class="label">Contact Number</label>
						<input id="pass" type="text" class="input" name="contact_number">
					</div>
					<div class="group">
						<input type="submit" class="button" value="Sign Up" name="submit">
					</div>
					<div class="hr"></div>
					<div class="foot-lnk">
						<label for="tab-1">Already Member?</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- partial -->

<?php
	if(isset($_GET["error"])) {
		$error=$_GET["error"];
		echo "<script>swal('Error', '{$error}', 'error');</script>";
	}
?>
  
<?php
	if(isset($_GET["message"])) {
		$message=$_GET["message"];
		echo "<script>swal('Success', '{$message}', 'success');</script>";
	}
?>
<!--=================Bootstrap==============-->
<script src="./node_modules/jquery/dist/jquery.slim.min.js"></script>
<script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<!--=================Bootstrap==============-->



</body>
</html>
