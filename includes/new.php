<?php

require 'include.php';									// Importing requires files
require 'db.php';
require 'getKey.php';




if (!isset($_SESSION['user'])) {							// Checking if some is user is logged in
	header("Location: ../index.php");
	exit();
}



if (!isset($_POST["submit"])) {							// Checking if submit button is clicked
	header("Location: ../new.php?error=Unknown Error");
	exit();
}


// Checking if data is received
if (!(isset($_POST['to']) && isset($_POST['subject']) && isset($_POST['body']))) {
	header("Location: ../new.php?error=Please Fill All Fields");
	exit();
}



$to = trim($_POST['to']);										// Retreiving Data
$subject = trim($_POST['subject']);
$body = trim($_POST['body']);
/*
$to=trim("Dhamareshwar");										// Retreiving Data
$subject=trim("Testing");
$body=trim("This is Testing Mail");
*/

// ================Checking If User already Exists===================//
$sql = "SELECT username FROM users WHERE username=?";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
	header("Location: ../new.php?error=SqlError1");
	exit();
} else {
	mysqli_stmt_bind_param($stmt, "s", $to);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	$resultCheck = mysqli_stmt_num_rows($stmt);

	if (!($resultCheck > 0)) {
		header("Location: ../new.php?error=User Doesnt Exists");
		exit();
	}
	// ================Checking If User already Exists===================//

	else {





		//$subject = mysqli_real_escape_string($conn, $subject);
		//$to      = mysqli_real_escape_string($conn, $to);
		//$body    = mysqli_real_escape_string($conn, nl2br(htmlentities($body, ENT_QUOTES, 'UTF-8')));

		//We encrypt then send the message
		$cipher = "AES-128-CBC";
		$ivlen  = openssl_cipher_iv_length($cipher);
		$iv     = openssl_random_pseudo_bytes($ivlen);


		$user = explode("::", $_SESSION['user'])[0];
		$sql = "SELECT ID FROM `users` WHERE username=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo "Mysqli stmt preparation error";
			exit();
		}
		if (!mysqli_stmt_bind_param($stmt, "s", $user)) {
			echo "parameter binding error";
			exit();
		}
		if (!mysqli_stmt_execute($stmt)) {
			echo "mysqli preparation error";
			exit();
		}
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_array($result);
		$userid = $row['ID'];

		$sql = "SELECT ID FROM `users` WHERE username=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo "Mysqli stmt preparation error";
			exit();
		}
		if (!mysqli_stmt_bind_param($stmt, "s", $to)) {
			echo "parameter binding error";
			exit();
		}
		if (!mysqli_stmt_execute($stmt)) {
			echo "mysqli preparation error";
			exit();
		}
		$result = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_array($result);
		$recepientid = $row['ID'];


		$key    = getKey($userid, $recepientid, $conn);


		$ciphertext_raw = openssl_encrypt($body, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
		$hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
		$ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);    // store $cipher, $hmac and $iv for decryption later
		if (mysqli_query($conn, 'insert into messages (subject, sender, recepient, message) values ("' . $subject . '", "' . $userid . '", "' . $recepientid . '", "' . $ciphertext . '")')) {
			header("Location: ../new.php?message=Message Sent Successfull");
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
}
