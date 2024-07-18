<?php 
  include 'extras/database_info.php';
  
  session_start();
  $name = $_SESSION["username"];
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"]!= true){
      header("location:login.php");
      exit;
  }
  else{
    $data = array(array());
    $x = "performance";
    $y = "date";
    
    $s = "SELECT $x, $y FROM $name";
    
    $date = mysqli_query($conn, $s);
    $count = mysqli_num_rows($date);
      
    while($row = mysqli_fetch_array($date)){
      $data[] = $row;
    }
  }

?>
<?php
 
 $dataPoints = array(
	array("x" => 946665000000, "y" => 3289000),
	array("x" => 978287400000, "y" => 3830000),
	array("x" => 1009823400000, "y" => 2009000),
	array("x" => 1041359400000, "y" => 2840000),
	array("x" => 1072895400000, "y" => 2396000),
	array("x" => 1104517800000, "y" => 1613000),
  array("x" => 1136053800000, "y" => 1821000),
	array("x" => 1167589800000, "y" => 2000000),
	array("x" => 1199125800000, "y" => 1397000),
	array("x" => 1230748200000, "y" => 2506000),
	array("x" => 1262284200000, "y" => 6704000),
	array("x" => 1293820200000, "y" => 5704000),
	array("x" => 1325356200000, "y" => 4009000),
	array("x" => 1356978600000, "y" => 3026000),
	array("x" => 1388514600000, "y" => 2394000),
	array("x" => 1420050600000, "y" => 1872000),
	array("x" => 1451586600000, "y" => 2140000)
);
 
?>
<?php
error_reporting(E_ERROR | E_PARSE);
$assocdata = array();
foreach($data as $index => $innerArray){
  $assocdata[$index] = array(
    "y"=> $innerArray[0],
    "label" => $innerArray[1]
  );
}

$dataPoints = $assocdata;

?>



<!DOCTYPE HTML>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel = "stylesheet" href="extras/style.css"> 
<style>
  #top{
    padding: 40px;
  }
  #bottom{
    padding:20px;
  }
  
</style>

<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Driver Performance"
	},
	axisY: {
		title: "Efficiency"
	},
  axisX:{
    title:"Date"
  },
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<?php 
  require 'extras/nav.php'
  ?>



<div class="d-flex flex-column justify-content-center w-100 h-100">

    <div class="d-flex flex-column justify-content-center align-items-center">
    <div id="chartContainer" style="height: 370px; width: 80%;"></div>
      <h3 id = "top"class="fw-light text-white m-0">The drivers performance is calculated solely based on the efficiency of delivering packages.</h1>
      
      <a href="#" class="text-decoration-none">
        <h5 id = "bottom"class="fw-light text-white m-0">— Intelcom —</h5>
      </a>
    </div>
    </div>
    </div>
 <?php 
?> 
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>     
