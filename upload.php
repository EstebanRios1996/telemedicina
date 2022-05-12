<?php

/*
  Rui Santos
  Complete project details at https://RandomNerdTutorials.com/esp32-esp8266-mysql-database-php/
  
  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files.
  
  The above copyright notice and this permission notice shall be included in all
  copies or substantial portions of the Software.
*/

$servername = "localhost";

// REPLACE with your Database name
$dbname = "prueba";
// REPLACE with Database user
$username = "esteban";
// REPLACE with Database user password
$password = "intell262";

// Keep this API Key value to be compatible with the ESP32 code provided in the project page. 
// If you change this value, the ESP32 sketch needs to match
$api_key_value1 = 'data1';
$api_key_value2 = 'data2';
$api_key_value3 = 'data3';

$api_key= $sensor = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value1) {
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $sql1 = "select MAX(id) from datos;";
        $result=mysqli_query($conn,$sql1);
	if ($result== true ){
            while($mostrar=mysqli_fetch_array($result)){
                $num = 1;
	    	$userdata = $mostrar['MAX(id)'] + $num;
	    }
	    $sql2 = "CREATE TABLE userval_".$userdata."(id int AUTO_INCREMENT PRIMARY KEY, ppm int);";

	    if ($conn->query($sql2) === TRUE) {
        	echo "new table created";
            } else {
            	echo "error creating table";
            }
        } 

        $conn->close();
    }elseif($api_key == $api_key_value2) {
    	$sensor = test_input($_POST["ppm"]);
    	$conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $sql1 = "select MAX(id) from datos;";
        $result=mysqli_query($conn,$sql1);
	if ($result== true ){
            while($mostrar=mysqli_fetch_array($result)){
                $num = 1;
	    	$userdata = $mostrar['MAX(id)'] + $num;
	    }
	    $sql3 = "INSERT INTO userval_".$userdata."(ppm) VALUES (".$sensor.");";

	    if ($conn->query($sql3) === TRUE) {
	    	echo "New record created successfully";
	    }
        } 
	$conn->close();
    }elseif($api_key == $api_key_value3) {
        $sensor = test_input($_POST["ppm_avg"]);
    	$conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        $sql1 = "select MAX(id) from datos;";
        $result=mysqli_query($conn,$sql1);
	if ($result== true ){
            while($mostrar=mysqli_fetch_array($result)){
                $num = 1;
	    	$userdata = $mostrar['MAX(id)'] + $num;
	    }
	    $sql3 = "INSERT INTO datos(id, spo2_avg, ppm_avg) VALUES (".$userdata.",".$sensor.",".$sensor.");";

	    if ($conn->query($sql3) === TRUE) {
	    	echo "New record created successfully";
	    }
        } 
	$conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }

}
else {

    echo "no data POST";
    echo $api_key;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
