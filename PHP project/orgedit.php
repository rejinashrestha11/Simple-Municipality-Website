<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
  header ("location: login.php");
exit();
}
include 'includes/connection.php';

$name = $address = $ownername = $establisheddate = $wardnumber = "";
$name_error = $address_error = $ownername_error = $establisheddate_error = $wardnumber_error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $name = trim($_POST['name']);
  $address = trim($_POST['address']);
  $ownername = trim($_POST['ownername']);
  $establisheddate = trim($_POST['establisheddate']);
  $wardnumber = trim($_POST['wardnumber']);
  $id = trim($_POST['id']);

  if($name == ""){
    $name_error = "Name is required";
  }
  if($address == ""){
    $address_error == "Address is required";
  }
  if($ownername == "" ){
    $ownername_error == "Owner Name is required ";
  }
  if($establisheddate == ""){
    $establisheddate_error = "Established Date is required";
  }
  if($wardnumber == ""){
    $wardnumber_error = "Ward Number is necessary";
  }


  if ($name_error == "" && $address_error == "" && $ownername_error == "" && $establisheddate_error == "" && $wardnumber_error == ""){

		
		//now we update data into database

		$sql = "UPDATE organization SET name = ? , address = ?, ownername = ?, establisheddate = ?, wardnumber = ? WHERE id = ?";

if ($statement = $conn-> prepare ($sql)){
    
      $statement->bind_param("sssssi", $p_name, $p_address, $p_ownername, $p_establisheddate, $p_wardnumber, $p_id);

      $p_name = $name;
      $p_address = $address;
      $p_ownername = $ownername;
      $p_establisheddate = $establisheddate;
      $p_wardnumber = $wardnumber;
      $p_id = $id;
      

       if($statement->execute()) {
        //record successfully created Redirect to list page 
        header ("location: orglist.php");
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
		$sql = "SELECT * FROM organization WHERE id = ?";

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

					$name = $row['name'];
					$address = $row['address'];
					$ownername = $row['ownername'];
					$establisheddate = $row['establisheddate'];
					$wardnumber = $row['wardnumber'];
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
        Update Organization
      </h1>
      
     </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Edit Org Info</h3>
        </div>
          <!-- /.box-header -->
            <div class="box-body no-padding">
            	<div class="col-md-6">
            	<form method = "POST" action="<?php echo $_SERVER['REQUEST_URI']; //REQUEST_URI = to make id visible in url?>">
            	  <div class = "form-group <?= ($name_error != '') ? 'has-error' : ''?>">
                  <label>Name of Organization </label>
                  <input type="text" name="name" class="form-control" value="<?= $name; ?>" >
                  <span class="text-danger"><i><?= $name_error; ?></i></span>
                </div>
                <div class = "form-group <?= ($address_error != '') ? 'has-error' : ''?>">
                  <label>Address</label>
                  <input type="text" name="address" class="form-control" value="<?= $address; ?> ">
                  <span class= "text-danger"><i><?= $address_error; ?></i></span>
                </div>
                <div class = "form-group <?= ($ownername_error != '') ? 'has-error' : ''?>">
                  <label>Owner Name </label>
                  <input type="text" name="ownername" class="form-control" value="<?= $ownername; ?>" >
                  <span class="text-danger"><i><?= $ownername_error; ?></i></span>
                </div>
                <div class = "form-group <?= ($establisheddate_error != '') ? 'has-error' : ''?>">
                  <label>Established Date  </label>
                  <input type="text" name="establisheddate" class="form-control" value="<?= $establisheddate; ?>" >
                  <span class="text-danger"><i><?= $establisheddate_error; ?></i></span>
                </div>               
                <div class = "form-group <?= ($wardnumber_error != '') ? 'has-error' : ''?>">
                  <label>Ward Number </label>
                  <input type="text" name="wardnumber" class="form-control" value="<?= $wardnumber; ?> ">
                  <span class="text-danger"><i><?= $wardnumber_error; ?></i></span>
                </div>
                <div>
            			<input type="hidden" name="id" value="<?= "$id";?>">
            			<input type="submit" value = "Update organization" class = "btn btn-primary">
            			<a href = "orglist.php" class="btn btn-danger">Cancel</a>
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