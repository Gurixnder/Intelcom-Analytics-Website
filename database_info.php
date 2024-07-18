<?php 
    $user_name = "root";
    $servername = "localhost";
    $password = "";
    $database = "intelcomdrivers";
    
    $conn = mysqli_connect($servername, $user_name, $password, $database);
    

    if(!$conn){
        echo "SERVER DOWN, SORRY FOR INCONVINIENCE :(";
        die();
    }
?>