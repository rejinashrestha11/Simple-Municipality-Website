<?php
// session_start();
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
//   header ("location: login.php");
// exit();
// }
include 'includes/connection.php';

$name = $address = $Principal_name = $establisheddate = $Levels_of_Education = "";
$name_error = $address_error = $pname_error = $establisheddate_error = $lofedu_error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $name = trim($_POST['name']);
  $address = trim($_POST['address']);
  $Principal_name = trim($_POST['p_name']);
  $establisheddate = trim($_POST['establisheddate']);
  $Levels_of_Education = trim($_POST['lofedu']);
  $id = trim($_POST['id']);

if($name == ""){
    $name_error = "Name is required";
  }
  if($address == ""){
    $address_error == "Address is required";
  }
  if($Principal_name == "" ){
    $pname_error == "Principal's Name is required ";
  }
  if($establisheddate == ""){
    $establisheddate_error = "Established Date is required";
  }
  if($Levels_of_Education == ""){
    $lofedu_error = "Levels_of_Education is necessary";
  }


  if ($name_error == "" && $address_error == "" && $pname_error == "" && $establisheddate_error == "" && $lofedu_error == ""){

		
		//now we update data into database

		$sql = "UPDATE school SET name = ? , address = ?, Principal_name = ?, establisheddate = ?, Levels_of_Education = ? WHERE id = ?";

if ($statement = $conn-> prepare ($sql)){
    
      $statement->bind_param("sssssi", $p_name, $p_address, $p_pname, $p_establisheddate, $p_lofedu, $p_id);

      $p_name = $name;
      $p_address = $address;
      $p_pname = $Principal_name;
      $p_establisheddate = $establisheddate;
      $p_lofedu = $Levels_of_Education;
      $p_id = $id;
      

       if($statement->execute()) {
        //record successfully created Redirect to list page 
        header ("location: school_list.php");
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
		$sql = "SELECT * FROM school WHERE id = ?";

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
					$Principal_name = $row['Principal_name'];
					$establisheddate = $row['establisheddate'];
					$Levels_of_Education = $row['Levels_of_Education'];
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
        Update School
      </h1>
      
     </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Edit School Info</h3>
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
                <div class = "form-group <?= ($pname_error != '') ? 'has-error' : ''?>">
                  <label>Principal Name </label>
                  <input type="text" name="p_name" class="form-control" value="<?= $Principal_name; ?>" >
                  <span class="text-danger"><i><?= $pname_error; ?></i></span>
                </div>
                <div class = "form-group <?= ($establisheddate_error != '') ? 'has-error' : ''?>">
                  <label>Established Date  </label>
                  <input type="text" name="establisheddate" class="form-control" value="<?= $establisheddate; ?>" >
                  <span class="text-danger"><i><?= $establisheddate_error; ?></i></span>
                </div>               
                <div class = "form-group <?= ($lofedu_error != '') ? 'has-error' : ''?>">
                  <label>Level of Education</label>
                  <input type="text" name="lofedu" class="form-control" value="<?= $Levels_of_Education; ?> ">
                  <span class="text-danger"><i><?= $lofedu_error; ?></i></span>
                </div>
                <div>
                  <input type="hidden" name="id" value="<?= "$id";?>">
                  <input type="submit" value = "Update school" class = "btn btn-primary">
                  <a href = "school_list.php" class="btn btn-danger">Cancel</a>
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