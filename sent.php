<?php

require "./includes/include.php";
require "./includes/db.php";
require './includes/getKey.php';


if (!isset($_SESSION['user'])) {
	header("Location: ./index.php?error=Please login to continue");
	exit();
}

$user = explode("::", $_SESSION['user'])[0];
$sql="select * from users WHERE username='{$user}'";
$req=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($req);
$current_user_id=$row['ID'];
$sql="SELECT * FROM messages WHERE sender={$current_user_id}";
$req=mysqli_query($conn, $sql);

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
<?php require "./navbar.php" ?>

<div style=" position:absolute;border:1px solid black; width:100vw;height:91vh">
	<img src="./assets/img/bg.jpg" style="opacity:0.3;height:100%; width:100%;" />
</div>
<div class="container d-flex flex-column justify-content-center">
	<div class="row justify-content-center">
		<div class="col-12 col-md-6" >
			<h3 class="text-center">Sent messages (<?php echo intval(mysqli_num_rows($req)); ?>)</h3>
		</div>
	</div>
</div>

<div class="container col-12 col-md-6">
<table class="table table-hover">
	<thead>
	<tr>
    	<th scope="col">Subject</th>
        <th scope="col">To</th>
        <th scope="col">Time</th>
        <th scope="col">Message</th>
    </tr>
	</thead>
	<tbody>

	<?php
	while($row = mysqli_fetch_array($req))
	{
	?>
	<tr>
    	<td  scope='row'><?php echo htmlentities($row['subject'], ENT_QUOTES, 'UTF-8'); ?></td>
    	<td>
			
			<?php $sql2="SELECT * FROM users WHERE ID={$row['recepient']}";
			$req2=mysqli_query($conn, $sql2);
			$row2 = mysqli_fetch_array($req2);
			echo htmlentities($row2['username'], ENT_QUOTES, 'UTF-8'); ?>
		</td>
    	<td><?php echo "1234"; ?></td>
        <td>
		<?php
		$cipher="AES-128-CBC";
		$c = base64_decode($row['message']);
		$ivlen = openssl_cipher_iv_length($cipher);
		$iv = substr($c, 0, $ivlen);
		$hmac = substr($c, $ivlen, $sha2len=32);
		$ciphertext_raw = substr($c, $ivlen+$sha2len);
		$key    = getKey($row['sender'], $row['recepient'], $conn);
		$original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);
		$calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary=true);
		if (hash_equals($hmac, $calcmac))//PHP 5.6+ timing attack safe comparison
		{
			echo htmlentities(nl2br($original_plaintext), ENT_QUOTES, 'UTF-8');
		}
		?>
		</td>
	</tr>
<?php
}

if(intval(mysqli_num_rows($req))==0)
{
?>
	<tr>
    	<td>You have no Send messages.</td>
    </tr>
<?php
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



 


