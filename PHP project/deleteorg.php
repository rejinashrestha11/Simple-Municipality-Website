<?php
 session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
  header ("location: login.php");
exit();
}
  //process delete operation after confirmation
if(isset($_POST['id']) && !empty($_POST['id'])) {
  require "includes/connection.php";

  //prepare delete statement
  $sql = "DELETE FROM organization WHERE id = ?";

  if($statement = $conn->prepare($sql)) {
    //bind variable to the prepared statement as parameters
    $statement->bind_param("i", $p_id);

    //set parameter
    $p_id = trim($_POST['id']);

    //attempt to execute the prepared statement
    if($statement->execute()) {
      //record successfully deleted. redirect to index page
      header("location: orglist.php");
      exit();
    } else {
      if(empty($_GET['id'])){
        echo "Oops!! Something went wrong";
      }
      
    }
  }
  $statement->close();
  $conn->close();
}
  require 'includes/nav.php';


?>

<!-- Content Wrapper. Contains page content -->
 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Delete Organization
      </h1>
      <br>
      <a href="orglist.php" class = "btn btn-primary">Back</a>
      
     </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <div class="box">
        <div class="box-header">
        
          <!-- /.box-header -->
            <div class="box-body no-padding">
              <form method="POST" action ="<?= $_SERVER['PHP_SELF']; ?>">
              <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
              <h3>Are you sure you want to delete this record?</h3>
              <input type="submit" value ="Yes" class="btn btn-success">
              <a href="orglist.php" class="btn btn-danger">No</a>
                
              </form>
            </div>
        </div>
      </div>
    </section>
  </div>
<?php require 'includes/footer.php'; ?>