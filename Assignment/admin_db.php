<?php 

	require 'includes/connection.php';

	//sql to create a table
	$sql = "CREATE TABLE Admin (
			id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			Email VARCHAR(50) NOT NULL,
			Password VARCHAR(50)NOT NULL
			
		)";
	//to execute
	if($conn->query($sql) == TRUE) {
		echo "Table admin created successfully.";
	} else {
		echo "Error creating table: " . $conn->error;
	}
	$conn->close();

 ?>