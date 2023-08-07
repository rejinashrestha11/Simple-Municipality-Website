<?php 
include 'includes/nav.php';

$name = $address = $ownername = $establisheddate = $wardnumber = "";
$name_error = $address_error = $ownername_error = $establisheddate_error = $wardnumber_error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $name = trim($_POST['name']);
  $address = trim($_POST['address']);
  $ownername = trim($_POST['ownername']);
  $establisheddate = trim($_POST['establisheddate']);
  $wardnumber = trim($_POST['wardnumber']);

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

   require 'includes/connection.php';

    $sql = "INSERT INTO industries (name, address, ownername, establisheddate, wardnumber ) VALUES ( ?, ?, ?, ?, ?)";
    

    if ($statement = $conn-> prepare ($sql)){
    
      $statement->bind_param("sssss", $p_name, $p_address, $p_ownername, $p_establisheddate, $p_wardnumber);

      $p_name = $name;
      $p_address = $address;
      $p_ownername = $ownername;
      $p_establisheddate = $establisheddate;
      $p_wardnumber = $wardnumber;
      

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
 
     
    <!-- Main content -->
<div class="container">
    <div class="row">
      <div class="col-md-6"><br><br><br><br>
        <h3>Industry Registration form</h3>
        <hr>
               <form method = "POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class = "form-group <?= ($name_error != '') ? 'has-error' : ''?>">
                  <label>Name of Industry </label>
                  <input type="text" name="name" class="form-control" placeholder="Name" >
                  <span class="text-danger"><i><?= $name_error; ?></i></span>
                </div>
                <div class = "form-group <?= ($address_error != '') ? 'has-error' : ''?>">
                  <label>Address</label>
                  <input type="text" name="address" class="form-control" placeholder="Address" >
                  <span class= "text-danger"><i><?= $address_error; ?></i></span>
                </div>
                <div class = "form-group <?= ($ownername_error != '') ? 'has-error' : ''?>">
                  <label>Owner Name </label>
                  <input type="text" name="ownername" class="form-control" placeholder="ownername" >
                  <span class="text-danger"><i><?= $ownername_error; ?></i></span>
                </div>
                <div class = "form-group <?= ($establisheddate_error != '') ? 'has-error' : ''?>">
                  <label>Established Date  </label>
                  <input type="text" name="establisheddate" class="form-control" placeholder="establisheddate" >
                  <span class="text-danger"><i><?= $establisheddate_error; ?></i></span>
                </div>               
                <div class = "form-group <?= ($wardnumber_error != '') ? 'has-error' : ''?>">
                  <label>Ward Number </label>
                  <input type="text" name="wardnumber" class="form-control" placeholder="wardnumber" >
                  <span class="text-danger"><i><?= $wardnumber_error; ?></i></span>
                </div>
                <div>
                  <input type="submit" value = "Register" class = "btn btn-primary">
                  <a href = "indlist.php" type="Cancel" class="btn btn-danger">Cancel</a>
                </div>
                <br>
                <br>
                </form>
                </div>
                <div class="col-md-6"><br><br><br><br>
                  <h4>To VIew the list click here:</h4>
                  <a href = "indlist.php"  class="btn btn-secondary">List of Industries</a>
                  <div>
                    <img src="images/ind1.jpg">
                  </div>
                </div>
      </div>   
       </div> 
    </section>
   </div>

<?php require 'includes/footer.php'; ?>
