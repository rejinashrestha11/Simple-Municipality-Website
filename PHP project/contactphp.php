<?php

  require 'includes/connection.php';
  $f_name = $l_name = $email = $message = "";
  $fname_error = $lname_error = $emailError = $messageError = "";

  //process the form
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //check if first name is empty
    if(empty($_POST['f_name'])){
      $emailError = "Please enter first name.";
    } else {
      $email = $_POST['f_name'];
    }
    //check if lastname is empty
    if(empty($_POST['l_name'])){
      $emailError = "Please enter last name.";
    } else {
      $email = $_POST['l_name'];
    }
    //check if email is empty
    if (empty($_POST['email'])) {
      $passwordError = "Please enter Password";
    } else {
      $password = $_POST['email'];
    }

    if(empty($_POST['message'])){
      $emailError = "Please type you message.";
    } else {
      $email = $_POST['message'];
    }

    if (empty($fname_error) && empty($lname_error) && empty($emailError) && empty($messageError)) {
      //prepare a select statement
      $sql = "SELECT * FROM Contact WHERE First_name = ?, Last_name = ?, Email = ? AND Message = ?";

      if ($statement = $conn->prepare($sql)) {
        //bind
        $statement->bind_param("ssss", $p_fname, $p_lname,$p_email, $p_message);

        //set parameters
        $p_fname = $f_name;
        $p_lname = $l_name;
        $p_email = $email;
        $p_message = $message;

       if($statement->execute()) {
        //record successfully created Redirect to list page 
        header ("location: index.php");
        exit();
      } 
      $statement->close();

    }
    //close statement
    $conn->close();
  }
  //connection close
 

}

?>