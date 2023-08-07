<?php

$name = $email  = $address= $profession= $dob= $gender = $phone = "";
    //check existence of id parameter before processing further
    if(isset($_POST['id'])&& $_POST['id']){
      //include connection.php
      require 'includes/connection.php';

      //prepare a select statement 
      $sql = "SELECT * FROM employees WHERE id=?";
    }
    
require 'includes/nav.php';


?>


<!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->
    <section class="content">
      <h1>
        Employees Listing
      </h1>
      <br>
      <a href = "signin.php" class = "btn btn-success">Add Employee</a>
    </section>
    <br><br>
    <!-- Main content -->
    <section class="content container-fluid">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">All Employees</h3>
        </div>
          <!-- /.box-header -->
            <div class="box-body no-padding">

              <?php 
                //include connection file
                require 'includes/connection.php';

                //attempt select query
                $sql = "SELECT * FROM employees";

                if($result = $conn->query($sql)) {
                  if($result->num_rows > 0) {
                    echo "<table class = 'table table-striped'>";
                    echo "<tr><th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Gender</th><th>Actions</th></tr>";

                    while($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row['id'] . "</td>";
                      echo "<td>" . $row['Name'] . "</td>";
                      echo "<td>" . $row['Email'] . "</td>";
                      echo "<td>" . $row['Phone'] . "</td>";
                      echo "<td>" . $row['Gender'] . "</td>";
                      echo "<td>";
                      echo "<a href = 'view.php?id=" . $row['id'] . "'><i class= 'fa fa-eye'></i></a> | ";
                      echo "<a href = 'empedit.php?id=" . $row['id'] . "'><i class= 'fa fa-edit'></i></a> | ";
                      echo "<a href = 'delete_emp.php?id=" . $row['id'] . "'><i class= 'fa fa-trash'></i></a> | ";
                      echo "</td>";
                      echo "</tr>";
                    }
                    echo "</table>";
                  }
                }
              ?>
</div>
              
            </div><br><br><br><br><br><br><br><br><br><br>
            <!-- /.box-body -->
      </div>
          <!-- /.box -->
        
    </section>
    <!-- /.content -->
  </div>
  <?php require 'includes/footer.php'; ?>
  