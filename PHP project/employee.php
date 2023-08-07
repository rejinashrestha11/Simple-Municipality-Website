<?php 
include 'includes/nav.php';

$name = $email = $phone = $password =$c_password = $gender = "";
$name_error = $email_error = $phone_error = $password_error = $c_password_error = $gender_error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $phone = trim($_POST['phone']);
  $password = trim($_POST['password']);
  $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

  if($name == ""){
    $name_error = "Name is required";
  }
  if($email == ""){
    $email_error == "Email is required";
  }
  if($phone == "" ){
    $phone_error == "phone is required ";
  }
  if($password == ""){
    $password_error = "Password is required";
  }
   if($c_password == ""){
    $c_password_error = "Confirm Password is required";
  }
  if($gender == ""){
    $gender_error = "Gender is necessary";
  }


  if ($name_error == "" && $email_error == "" && $phone_error == "" && $password_error == "" && $c_password_error == "" && $gender == ""){

   require 'includes/connection.php';

    $sql = "INSERT INTO emp (name, email,phone, password, gender ) VALUES ( ?, ?, ?, ?, ?)";
    

    if ($statement = $conn-> prepare ($sql)){
    
      $statement->bind_param("sssss", $p_name, $p_address, $p_pname, $p_establisheddate, $p_lofedu);

      $p_name = $name;
      $p_email = $email;
      $p_phone = $phone;
      $p_password = $password;
      $gender = $gender;
      

       if($statement->execute()) {
        //record successfully created Redirect to list page 
        header ("location: list.php");
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
 
     
    <!-- Main content -->
<div class="container">
    <div class="row">
      <div class="col-md-6"><br><br>
        <h3>Employee Registration form</h3>
        <hr>
               <form method = "POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class = "form-group <?= ($name_error != '') ? 'has-error' : ''?>">
                  <label>Name of School </label>
                  <input type="text" name="name" class="form-control" placeholder="Name" >
                  <span class="text-danger"><i><?= $name_error; ?></i></span>
                </div>
                <div class = "form-group <?= ($email_error != '') ? 'has-error' : ''?>">
                  <label>Email</label>
                  <input type="text" name="email" class="form-control" placeholder="Email" >
                  <span class= "text-danger"><i><?= $email_error; ?></i></span>
                </div>
                <div class = "form-group <?= ($phone_error != '') ? 'has-error' : ''?>">
                  <label>Phone </label>
                  <input type="text" name="phone" class="form-control" placeholder="phone" >
                  <span class="text-danger"><i><?= $phone_error; ?></i></span>
                </div>
                <div class = "form-group <?= ($password_error != '') ? 'has-error' : ''?>">
                  <label>Password </label>
                  <input type="password" name="password" class="form-control" placeholder="password" >
                  <span class="text-danger"><i><?= $password_error; ?></i></span>
                </div>               
                <div class = "form-group <?= ($c_password_error != '') ? 'has-error' : ''?>">
                  <label>Confirm Password</label>
                  <input type="password" name="c_password" class="form-control" value="<?= $c_password; ?>">
                  <span class="text-danger"><i><?= $c_password_error; ?></i></span>
                </div>
                <div class = "form-group <?= ($gender_error != '') ? 'has-error' : ''?>">
                  <label>Gender</label><br>
                  <label>
                  <input type="radio" name="gender" value = "Male" <?= ($gender == "Male") ? "checked" : ""; ?>> Male
                  </label>
                  <label>
                  <input type="radio" name="gender" value = "Female" <?= ($gender == "Female") ? "checked" : ""; ?>> Female
                  </label>
                  <label>
                  <input type="radio" name="gender" value = "Others" <?= ($gender == "Others") ? "checked" : ""; ?>> Others
                  </label> <br>
                  <span class="text-danger"><i><?= $gender_error; ?></i></span>
                </div>
                <div>
                  <input type="submit" value = "Register" class = "btn btn-primary">
                  <a href = "index.php" type="Cancel" class="btn btn-danger">Cancel</a>
                </div>
                <br>
                <br>
                </form>
                </div>
               <div class="col-md-6"><br>
                  <h4>To View list of employees click here:</h4>
                  <a href = "list.php"  class="btn btn-secondary">List of Employees</a>
                  <br><br><br>
        <img src="images/map.png" class="img-fluid">
      </div>
      </div>   
       </div> 
    
   </div>

<?php require 'includes/footer.php'; ?>
