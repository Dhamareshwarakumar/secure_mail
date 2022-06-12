<?php
	require './include.php';

	if(isset($_SESSION['user'])) {
		header("Location: ../index.php");
		exit();
	}

if (!isset($_POST['submit'])) {									// Checking user actually clicked submit and redirect hire not by direct URL
    header("Location: ../login.php?error=Unexpected Error");
    exit();
}

require 'db.php';												// importing database connection code

$username=trim($_POST["username"]);									// retreiving values from the login form
$password=trim($_POST["password"]);

if (empty($username)) {											// Checking if username is empty
    header("Location: ../login.php?error=Please Enter Username");
    exit();
}

if (empty($password)) {											// Checking if password is empty
	header("Location: ../login.php?error=Please Enter Password");
	exit();
}


$sql="SELECT * FROM users WHERE username=?";

$stmt=mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt,$sql)) {
    header("Location: ../login.php?error=SQLerror");
    exit();
}
else {
    mysqli_stmt_bind_param($stmt,"s",$username);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    if ($row=mysqli_fetch_assoc($result)) {
        $pwd_check=password_verify($password,$row['password']);
        if ($pwd_check==false) {
            header("Location: ../login.php?error=Wrong password");
            exit();
        }
        else if($pwd_check==true){
            session_start();
            $_SESSION['user']=$row['username']."::".random_bytes(32);
            header("Location: ../index.php?message=Login Successful");
        }
        else {
            header("Location: ../login.php?error=Wrong Password");
            exit();
        }
    }
    else{
        header("Location: ../login.php?error=User Doesnot Exist");
        exit();
    }
}




 ?>
