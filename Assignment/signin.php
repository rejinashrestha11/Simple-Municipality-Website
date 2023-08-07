<?php 
include 'includes/nav.php';


$name = $email = $password = $c_password = $gender = $phone = "";
$name_error = $email_error = $password_error = $c_password_error = $gender_error = $phone_error = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = ($_POST['name']);
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);
	$password = trim($_POST['password']);
	$c_password = trim($_POST['c_password']);
	$gender = isset($_POST['gender']) ? $_POST['gender'] : '';

	if($name == ""){
		$name_error = "Name is required";
	}

	if($email == ""){
		$email_error = "Email is required";
	}

	if($phone == ""){
		$phone_error = "Phone is required";
	}
	if($password == ""){
		$password_error = "Password is required";
	}
	if($c_password == ""){
		$c_password_error = "Confirm password is required";
	}
	if($gender == ""){
		$gender_error = "Gender is required";
	}

	if($password != $c_password){
		$password_error = "The password and confirm password must match";
	}

	if($name_error == "" && $email_error == "" && $phone_error == "" && $password_error == "" && $c_password_error == "" && $gender_error == ""){

		require 'includes/connection.php';
		//now we insert data into database

		$sql = "INSERT INTO employees (name, email, phone, password, gender) VALUES (?, ?, ?, ?, ?)";

		if($statement = $conn->prepare($sql)) {
			//bind variables to the prepared statement as parameter
			$statement->bind_param("sssss", $p_name, $p_email, $p_phone, $p_pass, $p_gender);
			//set parameter
			$p_name = $name;
			$p_email = $email;
			$p_phone = $phone;
			$p_pass = $password;
			$p_gender = $gender;

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
			<div class="col-md-6"><br>
				<h3>Employee Registration form</h3>
				<hr>
            	<form method = "POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            		<div class = "form-group <?= ($name_error != '') ? 'has-error' : ''?>">
            			<label>Name</label>
            			<input type="text" name="name" class="form-control" value="<?= $name; ?>">
            			<span class="text-danger"><i><?= $name_error; ?></i></span>
            		</div>
            		<div class = "form-group <?= ($email_error != '') ? 'has-error' : ''?>">
            			<label>Email</label>
            			<input type="email" name="email" class="form-control" value="<?= $email; ?>">
            			<span class="text-danger"><i><?= $email_error; ?></i></span>
            		</div>
            		<div class = "form-group <?= ($phone_error != '') ? 'has-error' : ''?>">
            			<label>Phone</label>
            			<input type="text" name="phone" class="form-control" value="<?= $phone; ?>">
            			<span class="text-danger"><i><?= $phone_error; ?></i></span>
            		</div>
            		<div class = "form-group <?= ($password_error != '') ? 'has-error' : ''?>">
            			<label>Password</label>
            			<input type="password" name="password" class="form-control" value="<?= $password; ?>">
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
            			<a href = "index.php" class="btn btn-danger">Cancel</a>
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

<?php include 'includes/footer.php' ?>
