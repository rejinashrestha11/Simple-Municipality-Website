<?php 
require 'includes/nav.php';
    
    $name = $address = $Principal_name = $establisheddate = $Levels_of_Education = "";
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        //include connection.php
        require "includes/connection.php";

        //prepare a select statement
        $sql = "SELECT * FROM school WHERE id=?";

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
                    $name = $row['name'];
                    $address = $row['address'];
                    $Principal_name = $row['Principal_name'];
                    $establisheddate = $row['establisheddate'];
                    $Levels_of_Education = $row['Levels_of_Education'];                  
                }                
            }
        }
        $statement->close();
        $conn->close();
    }
?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3>  School Details</h3>
            <br>
                <a href = "school_list.php" class = "btn btn-primary">Back</a>
                <hr>
          <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td><?= $name; ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?= $address; ?></td>
                    </tr>
                    <tr>
                        <th>Principal Name </th>
                        <td><?= $Principal_name; ?></td>
                    </tr>
                    <tr>
                        <th>Establihsed Date</th>
                        <td><?= $establisheddate; ?></td>
                    </tr>
                    <tr>
                        <th>Level of Education</th>
                        <td><?= $Levels_of_Education; ?></td>
                    </tr>
                    
                </table>
            </div>
        </div>
</div>
</div>
<?php include 'includes/footer.php' ?>


