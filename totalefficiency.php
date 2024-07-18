<?php
include "extras/database_info.php";
    
session_start();
$name = $_SESSION["username"];
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"]!= true){
  header("location:login.php");
  exit;
}
else{
    
    
    $tables = array();
    $names = "SELECT `username` FROM `drivers`";
    $res1 = mysqli_query($conn, $names);
    $num_names = mysqli_num_rows($res1);

    for($i = 0; $i < $num_names; $i++){
        $row = mysqli_fetch_array($res1);
        $data[$i] = $row[0];
        $tables[$i] = $data[$i];
    }
    //echo $tables[0];

    $totalDates=array();
    $names = "SELECT `date` FROM $name";
    $res11 = mysqli_query($conn, $names);
    $num_rows = mysqli_num_rows($res11);

    for($i = 0; $i < $num_rows; $i++){
        $row = mysqli_fetch_array($res11);
        $dates[$i] = $row[0];
        $totalDates[$i] = $dates[$i];
    }
    //echo $totalDates[2];


    $totalperf=array();
    $totalperform = array();
    for($j = 0; $j < count($tables); $j++){
        $per = "SELECT `performance` FROM $tables[$j]";
        $resx = mysqli_query($conn, $per);
        $no = mysqli_num_rows($resx);

        for($i = 0; $i < $no; $i++){
            $row = mysqli_fetch_array($resx);
            $pr[$i] = $row[0];
            $totalperf[$i] = $pr[$i];
        }
        $totalperform[$dates[$j]] = $totalperf;
    }

    $assocarrays =array();
    for($i = 0; $i < count($dates); $i++){
        $assocarrays[$dates[$i]] = array();
        foreach ($totalperform as $x){
            $assocarrays[$dates[$i]] = array("x"=> $dates[$i], "y" => $x);
        }
    }
    //echo $totalperform["2023-11-02"][0];

    
    $finalData=array();
    foreach($dates as $index => $innerArray){
        $finalData[$index] = array(
          "x"=> $innerArray[0],
          "y" => $innerArray[1]
        );
    }
    error_reporting(E_ERROR | E_PARSE);
    
    $dataf = array();
    $avgeffarray = array();
    $ijk = 0;
    foreach($dates as $x){
        $totaleff = 0;
        for($i = 0; $i < count($dates); $i++){
            $totaleff += $totalperform[$x][$i];
        }
        $dataf[$ijk] = array(
            array("x" => $x,
            "y" =>$totaleff/count($dates)));
        $ijk++;
        
    }
    
    foreach($dates as $x){
        echo $dataf[$x]."<br>";
    }

    $dataPoints = $dataf;

    
    // foreach($assocarrays["2023-11-01"][0] => $y){
    //     echo $y;
    // }
    

    


   
    }
    //echo count($perforamnces);
    //$associateData = array();
    //$index=0;
    
    //$y = "performance";
    //$x = "date";
    
    //foreach($dates as $d){
        
        //echo $d."<br>";
        //foreach ($tables as $t) {
            //echo $t."<br>";
            
            // $sql = "SELECT $y FROM $t WHERE $x LIKE $d";
            // $res = mysqli_query($conn, $sql);
            //echo mysqli_num_rows($res);
            //if($res){
                //$perfs =mysqli_fetch_array($res);
                //echo var_dump($perfs);
            
            //}
            
            //$n = mysqli_fetch_array($res); 
            //$perfss += $perfs[0];   
            
        //}
        // $associateData[$d] = $perfs;
        // $index++;
        // $associateData[$d]."<br>";
    //} 

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
     animationEnabled: true,
     title:{
         text: "Warehouse Effeciency"
     },
     axisY: {
         title: "Efficiency",
         valueFormatString: "#0,,.",
         suffix: "%",
     },
     data: [{
         type: "spline",
         markerSize: 5,
         xValueFormatString: "YYYY-MM-DD",
         yValueFormatString: "$#,##0.##",
         xValueType: "date",
         dataPoints: <?php echo json_encode($finalData, JSON_NUMERIC_CHECK); ?>
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
