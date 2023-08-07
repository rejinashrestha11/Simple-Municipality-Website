<?php
require 'includes/nav.php';
  session_start();
  require 'includes/connection.php';
  $email = $password = "";
  $emailError = $passwordError = $loginError = "";

  //process the form
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //check if email is empty
    if(empty($_POST['email'])){
      $emailError = "Please enter email address.";
    } else {
      $email = $_POST['email'];
    }

    //check if password is empty
    if (empty($_POST['password'])) {
      $passwordError = "Please enter Password";
    } else {
      $password = $_POST['password'];
    }

    if (empty($emailError) && empty($passwordError)) {
      //prepare a select statement
      $sql = "SELECT * FROM Admin WHERE email = ? AND password = ?";

      if ($statement = $conn->prepare($sql)) {
        //bind
        $statement->bind_param("ss", $p_email, $p_pass);

        //set parameters
        $p_email = $email;
        $p_pass = $password;

        //attempt to execute
        if ($statement->execute()) {
          $result = $statement->get_result();

          if ($result->num_rows == 1) {
            $data = $result->fetch_assoc(); 

            //store the data in session
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $data["id"];
            $_SESSION["email"] = $data["email"];
            $_SESSION["name"] = $data["name"];
            
            header("location: index.php");

          } else {
           $loginError = "Username or Password doesnot match.";
          }
      }
    }
    }
  }
?>

<div class="container">
    <div class="row">
      <div class="col-md-6">
        <h3>Sign in As ADMIN</h3>
        <hr>
        <?php if($loginError != "") { ?>
          <div class="alert alert-danger"><?= $loginError; ?></div><?php } ?>
              <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                
                <div class = "form-group <?= ($email_error != '') ? 'has-error' : ''?>">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Email">
                  <span class="text-danger"><?= $emailError; ?></span>
                </div>
                
                <div class = "form-group <?= ($password_error != '') ? 'has-error' : ''?>">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Password">
                  <span class="text-danger"><?= $passwordError; ?></span>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <br>
                <br>
                </form>
                </div>
                <div class="col-md-6">
        <img src="images/Sunkoshi-Rural-Municipality,-Sindhuli.png" class="img-fluid">
      </div>
    </div>
  </div>

<?php require 'includes/footer.php'?>