<?php

require './include.php';

if(isset($_SESSION['user'])) {
	header("Location: ../index.php");
	exit();
}



if (!isset($_POST["submit"])) {
    header("Location: ../login.php?error=Unknown Error");
    exit();
}
    require 'db.php';

    // =========Retreive Values from the form================//
    $username=trim($_POST["username"]);
    $password=trim($_POST["password"]);
    $cpassword=trim($_POST["cpassword"]);
    $contact_number=trim($_POST["contact_number"]);
    // =========Retreive Values from the form================//


    // ================================PHP Validations====================================//
            //=============Checking For the Empty Values=======================//
    if (empty($username) || empty($contact_number) || empty($password) || empty($cpassword)) {
        header("Location: ../login.php?error=Please Fill All Fields");
        exit();
    }
            //=============Checking For the Empty Values=======================//

            //=============Validating username(nothing returns)=======================//
    else if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
        header("Location: ../login.php?error=Invalid Username");
		exit();
    }
            //=============Validating username=======================//


            //=============Confirming Password=======================//
    else if($password !== $cpassword){
        header("Location: ../login.php?error=Passwords Not Match");
        exit();
    }
            //=============Confirming Password=======================//

			//=============Checking Password Strength=======================//

	else if(strlen($password) < 8) {
		header("Location: ../login.php?error=Password must be atleast 8 characters long!");
		exit();
	}

	else if(!preg_match("#[0-9]+#", $password)) {
		header("Location: ../login.php?error=Password must include at least one number!");
		exit();
	}
	else if(!preg_match("#[a-z]+#", $password)) {
		header("Location: ../login.php?error=Password must include at least one lowercase letter!");
		exit();
	}
	else if(!preg_match("#[A-Z]+#", $password)) {
		header("Location: ../login.php?error=Password must include at least one uppercase letter!");
		exit();
	}
	else if(!preg_match("#\W+#", $password)) {
		header("Location: ../login.php?error=Password must include at least one symbol!");
		exit();
	}
		//=============Checking Password Strength=======================//

		//=============Validating Contact Number=======================//
	else if(!preg_match("#[0-9]{10}#", $contact_number)) {
		header("Location: ../login.php?error=Invalid Contact Number");
		exit();
	}
		//=============Validating Contact Number=======================//

    else {
        // ================Checking If User already Exists===================//
        $sql="SELECT username FROM users WHERE username=?";

        $stmt=mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../login.php?error=SqlError1");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck=mysqli_stmt_num_rows($stmt);

            if ($resultCheck > 0) {
                header("Location: ../login.php?error=User Exists");
                exit();
            }
            // ================Checking If User already Exists===================//

            // ================Inserting Data Into Database for New User===================//
            else {
                $sql="INSERT INTO users(username,password,contact_number) VALUES(?,?,?)";

                $stmt=mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt,$sql)) {
                    header("Location: ../login.php?error=SqlError1");
                    exit();
                }
                else {
                    $pwd_hash=password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt,"sss", $username,$pwd_hash,$contact_number);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../index.php?message=Successfully Registered");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
        // ================Inserting Data Into Database===================//
    // ================================PHP Validations====================================//


 ?>
