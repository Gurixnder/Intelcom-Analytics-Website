<?php 
  include 'extras/database_info.php';
  
  session_start();
  $name = $_SESSION["username"];
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"]!= true){
      header("location:login.php");
      exit;
  }
  else{
    $data = array();
    //$performances = array();
    $col = "username";
    
    $sq = "SELECT $col FROM `drivers`";
    $res = mysqli_query($conn, $sq);
    $count = mysqli_num_rows($res);

    
    //$alltables = $row[0];
    for($i = 0; $i < $count; $i++){
      $row = mysqli_fetch_array($res);
      $data[$i] = $row[0];
    }

    $index = 1;
    $x = "date";
    $y = "performance";

    for($i = 0; $i < count($data); $i++){
      $sql = "SELECT $x, $y FROM $data[$i]";
      $result = mysqli_query($conn, $sql);
      
      $c = mysqli_num_rows($result);
      $row = mysqli_fetch_array($result);
      
      ${'data'.$i}[]= $row;
    }
    //echo $data1[0][0];

    
    error_reporting(E_ERROR | E_PARSE);

    $assocda = array(
      "a"=> array(1,2,3),
      "b"=> array(4,5,6)
      
    );

    //echo $assocda["a"][0];


    $assocdata = array();
    for($i=0; $i<count($data); $i++){
      foreach(${'data'.$i} as $index => $innerArray){
        ${'assocdata'.$i}[$index] = array(
            "y"=> $innerArray[0],
            "label" => $innerArray[1]
         );
      }
    }
    
  }
?>
<?php
 
 for($i = 0; $i < count($data); $i++){
  ${'datapoints'.$i} = ${'assocdata'.$i};
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
<!DOCTYPE HTML>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="extras/style.css">
<script>

window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Warehouse Performance"
	},
	axisY: {
		title: "Efficiency",
		valueFormatString: "#0,,.",
		suffix: "%",
	},
	data: [{
		type: "spline",
		markerSize: 5,
		xValueFormatString: "YYYY",
		yValueFormatString: "$#/10000",
		xValueType: "dateTime",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
 
chart.render();
 
}
</script>
</head>
<body>
  <?php 
    require "extras/nav.php"
  ?>
<div class="d-flex flex-column justify-content-center w-100 h-100">

    <div class="d-flex flex-column justify-content-center align-items-center">
      <div id="chartContainer" style="height: 370px; width: 100%;"></div>
      <h3 class="fw-light text-white m-0">Performance of the warehouse based on day to day efficiency. </h3>  
      <a href="#" class="text-decoration-none">
        <h5 id = "bottom"class="fw-light text-white m-0">— Intelcom —</h5>
      </a>
    </div>
    </div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

</body>
</html>      