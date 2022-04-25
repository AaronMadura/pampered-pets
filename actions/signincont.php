<?php
session_start();

include ('connection.php');
if(isset($_POST['signin'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM client_tbl WHERE username = '$user' AND password ='$pass' ";
    $res = mysqli_query($con,$sql);
    $user = mysqli_fetch_assoc($res);
    if(mysqli_num_rows($res) == 1){
        header("location: ../userdash.php");
        $_SESSION['logged']=true;
        $_SESSION['id'] = $user['id'];
        
    }
    else{
        header("location: ../signin.html");
        $_SESSION['logged']=false;
    }
}
?>