<?php 

  require 'includes/connection.php';

  //sql to create a table
  $sql = "CREATE TABLE school (
      id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(50) NOT NULL,
      address VARCHAR(30),
      Principal_name VARCHAR(50),
      establisheddate VARCHAR(10),
      Levels_of_Education VARCHAR(50)
    )";
  //to execute
  if($conn->query($sql) == TRUE) {
    echo "Table school created successfully.";
  } else {
    echo "Error creating table: " . $conn->error;
  }
  $conn->close();

 ?>