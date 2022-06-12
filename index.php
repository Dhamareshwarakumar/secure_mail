<?php
require "./includes/include.php"; 
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Home | Capstone</title>

	<!--=================Bootstrap==============-->
	<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" />  
	<!--=================Bootstrap==============-->

	<!--=================Sweet Alert==============-->
	<script src="node_modules/sweetalert/dist/sweetalert.min.js"></script>
	<!--=================Sweet Alert==============-->

	<style>
		@font-face {
			font-family: Texturina;
			src: url("./assets/fonts/Texturina/Texturina-Italic-VariableFont_opsz,wght.ttf");
			font-weight: bold;
			font-style: italic;
		}


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
<?php require "./navbar.php" ?>
<div class="container d-flex flex-column justify-content-center align-items-center" style="width:100vw; height:91vh;">
	<div class="row " >
		<div class="col-12">
			<h1 class="text-white" style="font-family: 'Texturina', serif;font-size:60px;">Welcome to <span style="color:yellow">Secure Mail</span></h1>
		</div>
	</div>
	<div class="row " >
		<div class="col-12">
			<h2 class="text-white p-3" style="font-family: 'Texturina', serif;font-size:45px;">
				<?php if(isset($_SESSION['user'])) {
					$user=explode("::", $_SESSION['user'])[0];
					echo "Hello <span style='color:yellow'>{$user}</span>";
				}
				else echo "Please login to Continue";
				?>
			</h2>
		</div>
	</div>
</div>

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
