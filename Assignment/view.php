<?php
    
    //check existence of id parameter before processing further 
    $name = $email = $phone = $gender = ""; 
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        //include connection.php
        require "includes/connection.php";

        //prepare a select statement
        $sql = "SELECT * FROM employees WHERE id=?";

        if($statement = $conn->prepare($sql)) {
            //bind the variable to the prepared statement as parameter
            $statement->bind_param("i", $p_id);

            //set parameter
            $p_id = trim($_GET['id']);

            //attempt to execute the prepared statement
            if($statement->execute()) {
                $result = $statement->get_result();

                if($result->num_rows == 1) {
                    //fetch result as an associative array.
                    //Since the result set contains only one row, we don't need to use while loop
                    
                    $row = $result->fetch_assoc();

                    //retrive the inndividual field
                    $name = $row['Name'];
                    $email = $row['Email'];
                    $phone = $row['Phone'];
                    $gender = $row['Gender'];

                }

                
            }
        }
        $statement->close();
        $conn->close();
    }

require 'includes/nav.php';

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Employees Detail
      </h1>
      <br>
      <a href = "list.php" class = "btn btn-primary">Back</a>
      <br>
      <br>
      <hr>
    </section>

    <!-- Main content -->

          <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td><?= $name; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $email; ?></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><?= $phone; ?></td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td><?= $gender; ?></td>
                    </tr>
                </table>
            </div>
        </div>
  </div>
<?php include 'includes/footer.php'; ?>