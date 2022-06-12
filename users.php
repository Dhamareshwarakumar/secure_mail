<?php

require './includes/include.php';
require "./includes/db.php"; 


if(!isset($_SESSION['user'])) {
	header("Location: ./index.php");
	exit();
}

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


</head>

<body>

	<?php require "./navbar.php";?>

<div style=" position:absolute;border:1px solid black; width:100vw;height:91vh">
	<img src="./assets/img/bg.jpg" style="opacity:0.3;height:100%; width:100%;" />
</div>
	
	<div class="container" >
		<div class="row d-flex justify-content-center">
			<div class="col-12 col-md-8">
				<h1 class="text-center">Secure Mail Users</h1>
				<hr />
			</div>
		</div>
	</div>

	<div class="container col-12 col-md-6">
		<table class="table table-hover">
			<thead>
				<tr>
					<th scope="col">S.no</th>
					<th scope="col">Username</th>
				</tr>
			</thead>
			<tbody>

		<?php
		$count=0;
		$sql="SELECT username FROM users";
		$result = mysqli_query($conn, $sql);


		while($row = mysqli_fetch_assoc($result)) {
			$count =$count + 1;
			echo "<tr>";
			echo "<th scope='row'>{$count}</th>";
			echo "<td>".htmlentities($row['username'], ENT_QUOTES, 'UTF-8')."</td>";
			echo "</tr>";
		}

		?>
		</tbody>
		</table>
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










