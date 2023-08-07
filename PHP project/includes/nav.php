<!DOCTYPE html>
<html>
<head>
  <title>Municipality Website</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <!-- Font Awesome -->
<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@200&display=swap" rel="stylesheet">
</head>
<body style="bg-dark">
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">
    <img src="images/Sunkoshi-Rural-Municipality,-Sindhuli.png" height="75" alt="logo">
  </a>
  <a class="navbar-brand" href="index.php">Sunkoshi Rural Municipality<br></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="services.php">Services</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="about.php">About Us</a>
      </li>
        <li class="nav-item">
        <a class="nav-link" href="registration.php">Registration</a>
      </li>
      
      
      <li class="nav-item">
        <a class="nav-link" href="gallery.php">Gallery</a>
        <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        View List
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="list.php">List of employee</a>
        <a class="dropdown-item" href="orglist.php">List of Organization</a>
        <a class="dropdown-item" href="indlist.php">List of Industry</a>
        <a class="dropdown-item" href="school_list.php">List of School</a>
      </div>
    </li>
      </li>
      
           <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact us</a>
      </li>
       <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Login as Admin
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="login.php">Log In</a>
        <a class="dropdown-item" href="logout.php">Log Out</a>
        
      </div>
    </li>
      
    </ul>
    
  </div>
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>