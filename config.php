<?php

require './env.php';

$servername = $MYSQL_DB_HOST;
$username = $MYSQL_DB_USER;
$password = $MYSQL_DB_PASSWORD;


$conn = mysqli_connect($servername, $username, $password);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}



// Create a Database
$createdb = "CREATE DATABASE capstone";
if (mysqli_query($conn, $createdb)) {
  echo "- capstone database is created<br>";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}


$conn = mysqli_connect($servername, $username, $password, 'capstone');

if (!$conn) {
  die("Connection Failed: " . mysqli_connect_error());
}



$createtb1 = "CREATE TABLE `messagekeys` (`user1` tinytext NOT NULL,`user2` tinytext NOT NULL,`mskey` mediumtext NOT NULL)";
if (mysqli_query($conn, $createtb1)) {
  echo "- Message Keys table is created<br>";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

$createtb2 = "CREATE TABLE `messages` (
  `ID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `subject` text NOT NULL,
  `sender` tinytext NOT NULL,
  `recepient` tinytext NOT NULL,
  `message` longtext NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
if (mysqli_query($conn, $createtb2)) {
  echo "- Messages table created is created<br>";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

$createtb3 = "CREATE TABLE `users` (
  `ID` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `contact_number` bigint(20) NOT NULL
)";
if (mysqli_query($conn, $createtb3)) {
  echo "- User table is created<br>";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

$insertusers = "INSERT INTO `users` (`ID`, `username`, `password`, `contact_number`) VALUES
(6, 'Dhamareshwar', '$2y$10$g5/a3HpmhveU7Dn3L3NMl.h005Qnnvdyr8GANHBSPGenJyHZ5yA1.', 7661979943),
(7, 'Nagraj', '$2y$10$4EwLR5RZG3DeezSmG1x9TuBbIVPxLGDk4MGsgHG7P6wadJoSNlmA2', 9876543210);";
if (mysqli_query($conn, $insertusers)) {
  echo "- Users added<br>
  &nbsp;&nbsp;&nbsp;&nbsp;- Username: Dhamareshwar password: Ch3pp@nu<br>
  &nbsp;&nbsp;&nbsp;&nbsp;- Username: Nagraj password: Nag@1234<br>";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}


echo "<a href='./index.php'><button>Go to Home Page</button></a>";
