<?php
function dbconnect() {
	$database = "fitnesstimerapi";
	$servername = "localhost";
	$username = "root";
	$password = "";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $database);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	else {
		return $conn;
	}
}

function dbdisconnect( $conn ) {
	mysqli_close( $conn );
}
?>