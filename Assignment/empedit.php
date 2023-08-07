<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
  header ("location: login.php");
exit();
}
require 'includes/connection.php';

$name = $email = $password = $c_password = $gender = $phone = "";
$name_error = $email_error = $password_error = $c_password_error = $gender_error = $phone_error = "";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);
	$password = trim($_POST['password']);
	$c_password = trim($_POST['c_password']);
	$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
	$id = trim($_POST['id']);

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

		
		//now we insert data into database

		$sql = "UPDATE employees SET name = ?, email = ?, phone = ?, password = ?, gender = ? WHERE id = ?";

		if($statement = $conn->prepare($sql)) {
			//bind variables to the prepared statement as parameter
			$statement->bind_param("sssssi", $p_name, $p_email, $p_phone, $p_pass, $p_gender, $p_id);
			//set parameter
			$p_name = $name;
			$p_email = $email;
			$p_phone = $phone;
			$p_pass = $password;
			$p_gender = $gender;
			$p_id = $id;

			//attempt to execute the prepared statement
			if($statement->execute()) {
				//record successfully created Redirect to list page 
				header ("location: list.php");
				exit();
			} 
			//close statement
		$statement->close();
		}
		
		//close connection
		$conn->close();

	}

} else {
	//check existence of id parameter
	if(isset($_GET['id']) && !empty($_GET["id"])) {
		//get url parameter
		$id = $_GET['id'];

		//prepare a select statement
		$sql = "SELECT * FROM employees WHERE id = ?";

		if($statement = $conn->prepare($sql)) {
			//bind parameters
			$statement->bind_param("i", $p_id);

			//set parameter
			$p_id = trim($_GET['id']);

			//attempt to execute
			if($statement->execute()) {
				$result = $statement->get_result();

				if($result->num_rows == 1) {
					//fetch result
					$row = $result->fetch_assoc();

					$name = $row['Name'];
					$email = $row['Email'];
					$phone = $row['Phone'];
					$gender = $row['Gender'];
				} else {
					//send error
				}
			} else {
				//send error
			}
		}
		$statement->close();
		$conn->close();
	}
}
require 'includes/nav.php';

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Update Employee
      </h1>
      
     </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Edit Employee Info</h3>
        </div>
          <!-- /.box-header -->
            <div class="box-body no-padding">
            	<div class="col-md-6">
            	<form method = "POST" action="<?php echo $_SERVER['REQUEST_URI']; //REQUEST_URI = to make id visible in url?>">
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
            			<input type="hidden" name="id" value="<?= "$id";?>">
            			<input type="submit" value = "Update employee" class = "btn btn-primary">
            			<a href = "list.php" class="btn btn-danger">Cancel</a>
            		</div>
            		<br>
            		<br>
              	</form>
              	</div>
 			</div>   
       </div> 
    </section>
   </div>

<?php require 'includes/footer.php'; ?>