<?php
require "./includes/include.php"; 
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>New Mail | Capstone</title>

	<!--=================Bootstrap==============-->
	<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" />  
	<!--=================Bootstrap==============-->

	<!--=================Sweet Alert==============-->
	<script src="node_modules/sweetalert/dist/sweetalert.min.js"></script>
	<!--=================Sweet Alert==============-->

</head>

<body>
<?php require "./navbar.php" ?>

<div style=" position:absolute;border:1px solid black; width:100vw;height:91vh">
	<img src="./assets/img/bg.jpg" style="opacity:0.3;height:100%; width:100%;" />
</div>

<form action="./includes/new.php" method="POST" class="col-12 col-md-8">
	<div class="form-group">
		<label for="to" >To Address:</label>
		<input type="text" class="form-control" name="to" id="to" placeholder="Enter To user">
	</div>
	<div class="form-group">
		<label for="subject">Subject:</label>
		<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" />
	</div>
	<div class="form-group">
		<label for="body">Message:</label>
		<textarea name="body" id="body" class="form-control" placeholder="Message" rows="6" ></textarea>
	</div>

	<input type="submit" name="submit" value="Send" class="btn btn-primary">
</form>



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
