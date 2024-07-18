<?php 
  $showAlert = false;
  $showAlert2 = false;
  $showError = false;
  $showError2 = false;
  $showError3 = false;

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'extras/database_info.php';
    
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $cpass = $_POST["cpass"];
    $phone = $_POST["phone"];
    $xxy = $username;
    
    $exists = false;
    $unique = true;

     if($name == ""||$email == ""||$pass == ""||$cpass == ""||$phone == "" || $username = ""){
       $showError2 = true;
     }
     else{
      $sql = "SELECT * FROM `drivers` where `username` like '$xxy'";
      $res = mysqli_query($conn, $sql);
      $num_r = mysqli_num_rows($res);

      if($num_r > 0){
            $unique = false;
            $showError3 = true; 
      }
      else{
        $sq = "SELECT * from `drivers` where `email` like '$email'"; 
      $result = mysqli_query($conn, $sq);
      $num = mysqli_num_rows($result);
  
      if($num == 1){
        $showAlert2 = true;
        $exists = true;
      }
      else{
        if(($pass == $cpass) && $exists == false){
          $sql = "INSERT INTO `drivers` (`sno`, `name`, `username`, `email`, `pass`, `phone`) VALUES (NULL, '$name', '$xxy', '$email', '$pass', '$phone')";
            
          $result = mysqli_query($conn, $sql);
          
          $table = "CREATE TABLE $xxy (`sno` INT NOT NULL AUTO_INCREMENT , `date` DATE NOT NULL , `performance` DECIMAL NOT NULL , PRIMARY KEY (`sno`))";
            
          $r = mysqli_query($conn, $table);
          if($result){
            $showAlert = true;
          }
        }
        else{
          $showError = "Passwords don't match.";
        }
      }
    }
  }


}
    
    

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="extras/style.css">
    <style>
      #loginButton{
        background-color: white;
        border-color: black; 
        color: black;
        
      }
      #top{
        padding: 40px;
      }
      #bottom{
        padding:40px;
      }
      body{
        color:white;
      }
      #emailHelp{
        color:white;
      }
      </style>
  </head>
  <body>
    <?php require 'extras/nav.php'?>
    <?php
    if($showAlert){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account with Intelcom has been setup.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if($showError){
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '.$showError.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if($showError2){
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Please enter the data.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    

    if($showAlert2){
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error!</strong> This email is already regsitered.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if($showError3){
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Username already taken.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <div class="container">
      <div class="d-flex flex-column justify-content-center w-100 h-100">

      <div class="d-flex flex-column justify-content-center align-items-center">
        <h1 id = "top"class="fw-light text-white m-0">Lets get you started</h1>
        <form action = "/warehouse_dashboard/signup.php" method = "post">
        <div class="mb-3">
          <label for="inputName"  class="form-label">Name</label>
          <input type="text" name = "name" class="form-control" id="inputName">
        </div>
        <div class="mb-3">
          <label for="inputuserName"  class="form-label">Username</label>
          <input type="text" name = "username" class="form-control" id="inputuserName">
        </div>
        <div class="mb-3">
        <label for="InputEmail1"  class="form-label">Email </label>
          <input type="email" name = "email" class="form-control" id="InputEmail1" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">Your email will be used to login.</div>
        </div>
        <div class="mb-3">
          <label for="InputPassword1"  class="form-label">Password</label>
          <input type="password" name = "pass" class="form-control" id="InputPassword1">
        </div>
        <div class="mb-3">
          <label for="InputPassword2"  class="form-label">Confirm Password</label>
          <input type="password" name = "cpass" class="form-control" id="InputPassword1">
        </div>
        <div class="mb-3">
          <label for="inputPhone" class="form-label">Phone number</label>
          <input type="tel" name = "phone" class="form-control" id="inputPhone">
        </div>
        <button type="submit" id="loginButton" class="btn btn-primary">Signup</button>
      </form>
        <a href="#" class="text-decoration-none">
          <h5 id="bottom"class="fw-light text-white m-0">— Intelcom —</h5>
        </a>
      </div>
      </div>
      </div>
      

    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>