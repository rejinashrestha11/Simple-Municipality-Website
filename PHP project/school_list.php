<?php

$name = $address = $Principal_name = $establisheddate = $Levels_of_Education = "";

    //check existence of id parameter before processing further
    if(isset($_POST['id'])&& $_POST['id']){
      //include connection.php
      require 'includes/connection.php';

      //prepare a select statement 
      $sql = "SELECT * FROM school WHERE id=?";
    }
    
require 'includes/nav.php';
?>


<!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->
    <section class="content">
      <h1>
        List of School
      </h1>
      <br>
      <a href = "school.php" class = "btn btn-success">Add School</a>
    </section>
    <br><br>
    <!-- Main content -->
    <section class="content container-fluid">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">All Schools</h3>
        </div>
          <!-- /.box-header -->
            <div class="box-body no-padding">

              <?php 
                //include connection file
                require 'includes/connection.php';

                //attempt select query
                $sql = "SELECT * FROM school";

                if($result = $conn->query($sql)) {
                  if($result->num_rows > 0) {
                    echo "<table class = 'table table-striped'>";
                    echo "<tr><th>#</th><th>Name</th><th>Address</th><th>Principal_name</th><th>Establsiheddate</th><th>Levels_of_Education</th><th>Actions</th></tr>";

                    while($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row['id'] . "</td>";
                      echo "<td>" . $row['name'] . "</td>";
                      echo "<td>" . $row['address'] . "</td>";
                      echo "<td>" . $row['Principal_name'] . "</td>";
                      echo "<td>" . $row['establisheddate'] . "</td>";
                      echo "<td>" . $row['Levels_of_Education'] . "</td>";
                      echo "<td>";
                      echo "<a href = 'schoolview.php?id=" . $row['id'] . "'><i class= 'fa fa-eye'></i></a> | ";
                      echo "<a href = 'sch_edit.php?id=" . $row['id'] . "'><i class= 'fa fa-edit'></i></a> | ";
                      echo "<a href = 'deletesch.php?id=" . $row['id'] . "'><i class= 'fa fa-trash'></i></a> | ";
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
  