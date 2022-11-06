<?php


function db() {
    //set your configs here
    $host = "127.0.0.1";
    $user = "root";
    $db = "myzuriphp";
    $password = "";
    $conn = mysqli_connect($host, $user, $password, $db);
    if(!$conn){
        echo "<script> alert('Error connecting to the database') </script>";
    } 
    else {
        echo "Connected successfully";
    }
    return $conn;

}
db();

// Database Creation
/*  
$conn = db();
$sql = "CREATE DATABASE myzuriphp";
if(mysqli_query($conn, $sql)){
    echo "Databse successfully created";
} else{
    echo "Error creating database: " . mysqli_error($conn);
}

//Table Creation
//$conn = db();
$sql = "CREATE TABLE Students (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    Full_names VARCHAR(120) NOT NULL,
    Country VARCHAR(32) NOT NULL,
Password VARCHAR(32) NOT NULL,
email VARCHAR(60),
gender VARCHAR(10)
)";
if (mysqli_query($conn, $sql)){
    echo "Table created successfully";
}else {
    echo "Error creating table: " . mysqli_error($conn);
}
mysqli_close($conn
*/