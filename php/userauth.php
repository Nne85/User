<?php

require_once "../config.php";
if(isset($_POST['submit'])){
    $fullnames = $_POST['full_names'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];


}
//register users
function registerUser($fullnames, $email, $password, $gender, $country){
    //create a connection variable using the db function in config.php
    $conn = db();
   //check if user with this email already exist in the database
$result = mysqli_query($conn, "SELECT * FROM Students WHERE email = '".$_POST['email']."'");
if(mysqli_num_rows($result)){
    echo "<script>alertt('The username already exists')</script> ";
    header("refresh: 0.5; url = ../forms/register.php");
}else{
    $query = "INSERT INTO Students (`full_names`, `email`, `password`, `gender`, `country`)
    VALUES ('$fullnames', '$email', '$password', '$gender', '$country')";

if (mysqli_query($conn, $query)){
    echo "<script>alert('User successfully registered')</script>";
    session_start();
    $_SESSION['username'] = $_POST['full_names'];
    header("refresh: 0.5; url = ../dashboard.php");
}

}
}


//login users
function loginUser($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();
   if(isset($_POST['login'])){
    $sql = mysqli_query($conn, "SELECT * FROM Students WHERE  email = '".$_POST['email']."' AND password = '".$_POST['password']."'");   
if (mysqli_num_rows($sql) > 0){
    $row = mysqli_fetch_assoc($sql);
    session_start();
    $_SESSION['username'] = $_POST['full_names'];
    header("Location: ../dashboard.php");

}else {session_unset();
     
    echo '<h3>Sorry Invalid Email and Password<br>
               Please Enter Correct Credentials</br></h3>';
               header("location: ../login.html");
            }
}
   // echo "<h1 style='color: red'> LOG ME IN (IMPLEMENT ME) </h1>";
    //open connection to the database and check if username exist in the database
    //if it does, check if the password is the same with what is given
    //if true then set user session for the user and redirect to the dasbboard
}

/*function logoutUser(){
    if ($_SESSION['username']){
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    }
else{
    header("Location: ../forms/login.php");
}

}*/
function logoutUser(){
    if (isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header("Location: ../index.php");  
    }else{
        header("Location: ../forms/login.php");
    }
}

function resetPassword($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();
   if (isset($_POST['reset'])) {
    $result = mysqli_query($conn, "SELECT * FROM Students WHERE email = '$email'");
    if (mysqli_num_rows($result) >=1){

    $sql = "UPDATE Students set password ='$password' WHERE email = '$email'";}
if ($conn->query($sql)== TRUE) {
    echo "<script>alert('Update Successfully')</script>";
    header("refresh: 0.3; url =../dashboard.php");}
    else{
        echo " Update unsucessful"; 
        header("location: ../resetpassword.html");
    }

}
}

    //echo "<h1 style='color: red'>RESET YOUR PASSWORD (IMPLEMENT ME)</h1>";
    //open connection to the database and check if username exist in the database
    
    //if it does, replace the password with $password given


function getusers(){
    $conn = db();
    $sql = "SELECT * FROM Students";
    $result = mysqli_query($conn, $sql);
    echo"<html>
    <head></head>
    <body>
    <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
    <table border='1' style='width: 700px; background-color: magenta; border-style: none'; >
    <tr style='height: 40px'><th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th></tr>";
    if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_assoc($result)){
            //show data
            echo "<tr style='height: 30px'>".
                "<td style='width: 50px; background: blue'>" . $data['id'] . "</td>
                <td style='width: 150px'>" . $data['Full_names'] .
                "</td> <td style='width: 150px'>" . $data['email'] .
                "</td> <td style='width: 150px'>" . $data['gender'] . 
                "</td> <td style='width: 150px'>" . $data['Country'] . 
                "</td>
                <form action='action.php' method='post'>
                <input type='hidden' name='id'" .
                 "value=" . $data['id'] . ">".
                "<td style='width: 150px'> <button type='submit', name='delete'> DELETE </button>".
                "</tr>";
        }
        echo "</table></table></center></body></html>";
    }
    //return users from the database
    //loop through the users and display them on a table
}

 function deleteaccount($id){
     $conn = db();
     //delete user with the given id from the database
 if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Students WHERE id ='$id'")))
 {
    $sql = "DELETE FROM Students WHERE id= '$id'";
    if (mysqli_query($conn, $sql)){
        echo "<script>alert('Deleted')</script>";
        header("refresh: 0.1; url =../dashboard.php");
    }
 }
 
 
    }
