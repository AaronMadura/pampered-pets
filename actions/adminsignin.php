<?php
session_start();
include("connection.php");

if(isset($_POST['signin'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM admin_tbl WHERE username = '$user' AND password ='$pass' ";
    $res = mysqli_query($con,$sql);
    

    if(mysqli_num_rows($res)==1){
        header("location: ../admindash.php");
        $_SESSION['logged']=true;
        $admin = mysqli_fetch_assoc($res);
        $_SESSION['admin'] = $admin['id'];
    } 
    
    else{
        header("location: ../adminsignin.html");
        $_SESSION['logged']=false;
    }
    
}

?>