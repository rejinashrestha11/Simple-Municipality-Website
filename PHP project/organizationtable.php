<?php 

  require 'includes/connection.php';

  //sql to create a table
  $sql = "CREATE TABLE organization (
      id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      name VARCHAR(50) NOT NULL,
      address VARCHAR(30),
      ownername VARCHAR(50),
      establisheddate VARCHAR(10),
      wardnumber VARCHAR(50)
    )";
  //to execute
  if($conn->query($sql) == TRUE) {
    echo "Table organization created successfully.";
  } else {
    echo "Error creating table: " . $conn->error;
  }
  $conn->close();

 ?>