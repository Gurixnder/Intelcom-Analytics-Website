<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Intelcom</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="extras/style.css">
    <style>
      #top{
        padding: 40px;
      }
      #bottom{
        padding:200px;
      }
      #loginButton{
        border-color: black;
      }

    </style>
  
  </head>
  <body>
    <?php 
        require 'extras/nav.php'
    ?>
    
    <div class="d-flex flex-column justify-content-center w-100 h-100">

    <div class="d-flex flex-column justify-content-center align-items-center">
      <h1 id="top" class="fw-light text-white m-0">Track your order here: </h1>
      <form action = "/warehouse_dashboard/tracking.php" method = "post">
          <div class="mb-3">
          <label for="track"  class="form-label text-white">Tracking ID: </label>
            <input type="text" name = "trackid" class="form-control" id="track" aria-describedby="emailHelp">
            
          </div>
          <button type="submit" id = "loginButton" class="btn btn-primary bg-white text-black">Track Package</button>
        </form>

      <a href="#" class="text-decoration-none">
        <h5 id = "bottom" class="fw-light text-white m-0">— Intelcom —</h5>
      </a>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>