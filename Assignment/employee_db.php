<?php 

	require 'includes/connection.php';

	//sql to create a table
	$sql = "CREATE TABLE employees (
			id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			Name VARCHAR(50) NOT NULL,
			Email VARCHAR(50),
			Phone VARCHAR(50),
			Password VARCHAR(10)NOT NULL,
			Gender VARCHAR(10)
		)";
	//to execute
	if($conn->query($sql) == TRUE) {
		echo "Table employees created successfully.";
	} else {
		echo "Error creating table: " . $conn->error;
	}
	$conn->close();

 ?>