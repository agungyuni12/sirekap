<?php
$servername = "localhost";
$username = "n1607753_agungys";
$password = "kelayu1998";
$database = "n1607753_seleksimitra";
// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>