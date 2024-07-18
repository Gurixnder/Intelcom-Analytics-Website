<?php 
    include 'extras/database_info.php';
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"]!= true){
        header("location:login.php");
        exit;
    }
    else{
        $showAlert = false;
        $showError1 = false;
        $showError2 = false;
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            $recieved = $_POST["recievedPackages"];
            $delivered = $_POST["deliveredPackages"];
            
            if($recieved == "" || $delivered == ""){
                $showError1 = true;
            }
            else{
                if($recieved<0 && ($delivered > $recieved) && $delivered < 0){
                    $showError2;
                }
                else{
                    $performance = ($delivered / $recieved)*100;
                    
                    $col = "username";
                    $email = $_SESSION["mail"];
                    
                    $mysql = "SELECT $col FROM `drivers` WHERE `email` LIKE '$email'";
                    $res = mysqli_query($conn, $mysql);
                    
                    $n = mysqli_fetch_assoc($res);
                    
                    $uname = $n["username"];
                    $_SESSION["username"] = $uname;
                    $date = date("y-m-d");

                    $sql = "INSERT INTO $uname(`date`, `performance`) VALUES ('$date', '$performance')";
                    $rslt = mysqli_query($conn, $sql);

                    if($rslt){
                      $showAlert = true;
                    }else
                    {
                      $showError2 = true;
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
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="extras/style.css">
    
    <style>
      #top1{
        padding:40px;
      }
      #bottom{
        padding:40px;
      }
      #top2{
        padding:40px;
      }
      #loginButton{
        border-color:black;
      }
    </style>


  </head>
  <body>
    <?php require 'extras/nav.php'?>
    <?php
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Success!</strong> The data has been posted.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        if($showError1){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Error!</strong> Please enter the data.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        if($showError2){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
              <strong>Error!</strong> Invalid values.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    ?>
    <?php 
    ?>
    <div class="container">
    <div class="d-flex flex-column justify-content-center w-100 h-100">

    <div class="d-flex flex-column justify-content-center align-items-center">
      <h1 id = "top1"class="fw-light text-white m-0">Welcome!</h1>
      <h3 id = "top2" class="fw-light text-white m-0">Enter the package details below:</h3>
      <form action = "/warehouse_dashboard/welcome.php" method = "post">
        <div class="mb-3">
          <label for="inputName"  class="form-label text-white">Packages recieved:</label>
          <input type="number" name = "recievedPackages" class="form-control" id="inputName">
        </div>
        <div class="mb-3">
        <label for="InputEmail1"  class="form-label text-white">Packages delivered today:</label>
          <input type="number" name = "deliveredPackages" class="form-control" id="InputEmail1" aria-describedby="emailHelp">
        </div>
        <button type="submit" class="btn btn-primary bg-white text-black">Submit</button>
      </form>
      <a href="#" class="text-decoration-none">
        <h5 id = "bottom"class="fw-light text-white m-0">— Intelcom —</h5>
      </a>
    </div>
    </div>
    </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>