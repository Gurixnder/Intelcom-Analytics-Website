<?php 
  $showAlert = false;
  $showError = false;
  $login = false;
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'extras/database_info.php';

    $mail = $_POST["mail"];
    $password = $_POST["password"];
    

    $condition = "SELECT * FROM `drivers` WHERE `email` LIKE '$mail' AND `pass` LIKE '$password'";

    $result =  mysqli_query($conn, $condition);
    $numrows = mysqli_num_rows($result);
    
    if($numrows == 1){
        $login = true;
        session_start();
        $_SESSION["loggedin"] = true;
        $_SESSION["mail"] = $mail;
        $col = "username";
        $email = $_SESSION["mail"];
                    
        $mysql = "SELECT $col FROM `drivers` WHERE `email` LIKE '$email'";
        $res = mysqli_query($conn, $mysql);
                    
        $n = mysqli_fetch_assoc($res);
                    
        $uname = $n["username"];
        $_SESSION["username"] = $uname;
        header("location: welcome.php");

    }
    
    else{
      $showError = "Invalid email or password.";
    }

  }
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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
    ?>
    <div class="container">
      
        <div class="d-flex flex-column justify-content-center w-100 h-100">
        <div class="d-flex flex-column justify-content-center align-items-center">
          <h1 id = "top" class="fw-light text-white m-0">Enter your details to login</h1>
          <form action = "/warehouse_dashboard/login.php" method = "post">
          <div class="mb-3">
          <label for="InputEmail1"  class="form-label ">Email </label>
            <input type="email" name = "mail" class="form-control" id="InputEmail1" aria-describedby="emailHelp">
            
          </div>
          <div class="mb-3">
            <label for="InputPassword1"  class="form-label">Password</label>
            <input type="password" name = "password" class="form-control" id="InputPassword1">
          </div>
          <button type="submit" id = "loginButton" class="btn btn-primary">Login</button>
        </form>  
        </div>
        </div>
        <a href="#" class="text-decoration-none">
          <h5 id ="bottom" class="fw-light text-white m-0 text-center">— Intelcom —</h5>
        </a>
        </div>
    </div>
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>