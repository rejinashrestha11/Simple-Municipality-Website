<?php 
include 'includes/nav.php';


$email = $password  = "";
$email_error = $password_error = $c_password_error = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$c_password = trim($_POST['c_password']);
	

	
	if($email == ""){
		$email_error = "Email is required";
	}

	
	if($password == ""){
		$password_error = "Password is required";
	}
	if($c_password == ""){
		$c_password_error = "Confirm password is required";
	}
	
	if($password != $c_password){
		$password_error = "The password and confirm password must match";
	}

	if($email_error == "" && $password_error == "" && $c_password_error == "" ){

		require 'includes/connection.php';
		//now we insert data into database

		$sql = "INSERT INTO Admin (email, password) VALUES (?, ?)";

		if($statement = $conn->prepare($sql)) {
			//bind variables to the prepared statement as parameter
			$statement->bind_param("ss", $p_email, $p_pass);
			//set parameter
			
			$p_email = $email;
			$p_pass = $password;
			

			//attempt to execute the prepared statement
			if($statement->execute()) {
				//record successfully created Redirect to list page 
				header ("location: index.php");
				exit();
			} 
		}
		//close statement
		$statement->close();

	}
	//connection close
	$conn->close();

}

?>

<div class="container">
		<div class="row">
			<div class="col-md-6">
			<h3>Admin Credentials</h3>
				<hr>
            	<form method = "POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            		
            		<div class = "form-group <?= ($email_error != '') ? 'has-error' : ''?>">
            			<label>Email</label>
            			<input type="email" name="email" class="form-control" value="<?= $email; ?>">
            			<span class="text-danger"><i><?= $email_error; ?></i></span>
            		</div>
            		
            		<div class = "form-group <?= ($password_error != '') ? 'has-error' : ''?>">
            			<label>Password</label>
            			<input type="password" name="password" class="form-control">
            			<span class="text-danger"><i><?= $password_error; ?></i></span>
            		</div>
            		<div class = "form-group <?= ($c_password_error != '') ? 'has-error' : ''?>">
            			<label>Confirm Password</label>
            			<input type="password" name="c_password" class="form-control">
            			<span class="text-danger"><i><?= $c_password_error; ?></i></span>
            		</div>
            		
            		<div>
            			<input type="submit" value = "Register" class = "btn btn-primary">
            			<a href = "index.php" class="btn btn-danger">Cancel</a>
            		</div>
            		<br>
            		<br>
              	</form>
              	</div>
              	<div class="col-md-6">
				<img src="images/map.png" class="img-fluid">
			</div>
 			</div>   
       </div> 
    </div>
   </div>
<?php include 'includes/footer.php' ?>
