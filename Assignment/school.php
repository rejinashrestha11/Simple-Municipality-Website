<?php 
include 'includes/nav.php';

$name = $address = $Principal_name = $establisheddate = $Levels_of_Education = "";
$name_error = $address_error = $pname_error = $establisheddate_error = $lofedu_error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $name = trim($_POST['name']);
  $address = trim($_POST['address']);
  $Principal_name = trim($_POST['p_name']);
  $establisheddate = trim($_POST['establisheddate']);
  $Levels_of_Education = trim($_POST['lofedu']);

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

   require 'includes/connection.php';

    $sql = "INSERT INTO school (name, address,Principal_name, establisheddate, Levels_of_Education ) VALUES ( ?, ?, ?, ?, ?)";
    

    if ($statement = $conn-> prepare ($sql)){
    
      $statement->bind_param("sssss", $p_name, $p_address, $p_pname, $p_establisheddate, $p_lofedu);

      $p_name = $name;
      $p_address = $address;
      $p_pname = $Principal_name;
      $p_establisheddate = $establisheddate;
      $p_lofedu = $Levels_of_Education;
      

       if($statement->execute()) {
        //record successfully created Redirect to list page 
        header ("location: school_list.php");
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
        <h3>School Registration form</h3>
        <hr>
               <form method = "POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class = "form-group <?= ($name_error != '') ? 'has-error' : ''?>">
                  <label>Name of School </label>
                  <input type="text" name="name" class="form-control" placeholder="Name" >
                  <span class="text-danger"><i><?= $name_error; ?></i></span>
                </div>
                <div class = "form-group <?= ($address_error != '') ? 'has-error' : ''?>">
                  <label>Address</label>
                  <input type="text" name="address" class="form-control" placeholder="Address" >
                  <span class= "text-danger"><i><?= $address_error; ?></i></span>
                </div>
                <div class = "form-group <?= ($ownername_error != '') ? 'has-error' : ''?>">
                  <label>Principal Name </label>
                  <input type="text" name="p_name" class="form-control" placeholder="principal_name" >
                  <span class="text-danger"><i><?= $pname_error; ?></i></span>
                </div>
                <div class = "form-group <?= ($establisheddate_error != '') ? 'has-error' : ''?>">
                  <label>Established Date  </label>
                  <input type="text" name="establisheddate" class="form-control" placeholder="establisheddate" >
                  <span class="text-danger"><i><?= $establisheddate_error; ?></i></span>
                </div>               
                <div class = "form-group <?= ($wardnumber_error != '') ? 'has-error' : ''?>">
                  <label>Level of Education Available</label>
                  <input type="text" name="lofedu" class="form-control" placeholder="level" >
                  <span class="text-danger"><i><?= $lofedu_error; ?></i></span>
                </div>
                <div>
                  <input type="submit" value = "Register" class = "btn btn-primary">
                  <a href = "index.php" type="Cancel" class="btn btn-danger">Cancel</a>
                </div>
                <br>
                <br>
                </form>
                </div>
                <div class="col-md-6"><br><br>
                  <h4>To View the list of school click here:</h4>
                  <a href = "school_list.php"  class="btn btn-primary">List of Schools</a>
                  <div>
                    <img src="images/school.png">
                  </div>
                </div>
      </div>   
       </div> 
    
   </div>

<?php require 'includes/footer.php'; ?>
