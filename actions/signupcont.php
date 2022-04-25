<?php 
include("connection.php");

if(isset($_POST['signup'])){

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    $sql = "INSERT INTO client_tbl (first_name,last_name,username,password,email,contact) 
    VALUES('$fname','$lname','$uname','$pass','$email','$contact')";

    if(mysqli_query($con,$sql)){
        header("location:../signin.html");
    }
}

?>