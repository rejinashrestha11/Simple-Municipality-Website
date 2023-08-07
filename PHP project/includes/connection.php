<?php  

	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "sunkoshi_db";

	//create connection
	$conn = new mysqli($servername, $username, $password, $database, "3306");

	//check for connection
	if($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

?>