<?php 
require 'includes/nav.php';
    
    $name = $address = $ownername = $establisheddate = $wardnumber = "";
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        //include connection.php
        require "includes/connection.php";

        //prepare a select statement
        $sql = "SELECT * FROM organization WHERE id=?";

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
                    $ownername = $row['ownername'];
                    $establisheddate = $row['establisheddate'];
                    $wardnumber = $row['wardnumber'];                  
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
            <h3> Organization Details</h3>
            <br>
                <a href = "orglist.php" class = "btn btn-primary">Back</a>
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
                        <th>Owner Name </th>
                        <td><?= $ownername; ?></td>
                    </tr>
                    <tr>
                        <th>Establihsed Date</th>
                        <td><?= $establisheddate; ?></td>
                    </tr>
                    <tr>
                        <th>Ward Number</th>
                        <td><?= $wardnumber; ?></td>
                    </tr>
                    
                </table>
            </div>
        </div>
</div>
</div>
<?php include 'includes/footer.php' ?>


