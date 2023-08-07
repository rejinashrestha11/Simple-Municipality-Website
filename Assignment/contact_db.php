<?php 

	require 'includes/connection.php';

	//sql to create a table
	$sql = "CREATE TABLE Contact (
			id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			First_name VARCHAR(50) NOT NULL,
			Last_name VARCHAR(50),
			Email VARCHAR(50) NOT NULL,
			Message VARCHAR(70)NOT NULL
			
		)";
	//to execute
	if($conn->query($sql) == TRUE) {
		echo "Table admin created successfully.";
	} else {
		echo "Error creating table: " . $conn->error;
	}
	$conn->close();

 ?>