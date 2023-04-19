<?php 
    //connection parameters
    $serv_name = "localhost";
    $db_name = "wsdi_db";
    $db_user = "root";
    $db_pass = "";

    //connect to the database
    $conn = new mysqli($serv_name, $db_user, $db_pass, $db_name);
    if ($conn->connect_error){
        echo "<script>console.log('Connection failed!')</script>";
        die("Connection failed: " . $conn->connect_error); 
    }else{
        echo "<script>console.log('Connected to $db_name')</script>";
    }
?>	
					