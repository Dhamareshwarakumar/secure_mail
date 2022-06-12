<?php

function getKey($user1, $user2,$conn) {
	$link=$conn;

	//Message DataBase. Access data cryptography hardcoded.
	$cipher = "aes-256-cbc";
	$ivlen  = openssl_cipher_iv_length($cipher);
	$iv		= base64_decode("5AIQwo8fWMKaUxDI9R9Ywp"); // hardcoded random iv with 256 bits
	$dbkey  = base64_decode("zT/PiCvCiUYtd96Pwogrwp"); // hardcoded random key with 256 bits

	if ($user1 > $user2) {	// always ensure the same ordering of the users - swap if necessary
		$tmp = $user1;
		$user1 = $user2;
		$user2 = $tmp;
	};

	$req = mysqli_query($link, 'select * from messagekeys where user1="'.$user1.'" and user2="'.$user2.'"');
	$dn  = mysqli_num_rows($req);
	$dat = mysqli_fetch_array($req);

	if($dn ==0)
	{
		$method = openssl_get_cipher_methods();
		if (in_array($cipher, $method)) {
			$key = base64_encode(openssl_random_pseudo_bytes(24)); // generate a new random key (192 bits) in case it is the first message
			$encrypted_key = openssl_encrypt($key, $cipher, $dbkey, 0, $iv);


			mysqli_query($link, 'insert into messagekeys(user1, user2, mskey) values ('.$user1.', "'.$user2.'", "'.$encrypted_key.'")');
		}
		else return false;			
	}				
	else {
		$cryp_key = $dat['mskey'];
					//echo $cryp_key;
		$key = openssl_decrypt($cryp_key, $cipher, $dbkey, 0, $iv);
	}
//	echo $key;
	return $key;	
}

?>
