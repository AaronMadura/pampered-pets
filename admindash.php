<?php
ob_start();
session_start();
include("actions/connection.php");

if(!$_SESSION['logged']){
header("location: signin.html");
}

$admin_id = $_SESSION['admin'];
$sql = "SELECT * FROM admin_tbl WHERE id = '$admin_id'";
$res = mysqli_query($con,$sql);
$admin = mysqli_fetch_assoc($res);


$sql = "SELECT * FROM admin_tbl";
$adminres = mysqli_query($con,$sql);

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
         integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" 
         crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" 
         integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" 
         crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" 
         integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" 
         crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <title>Dashboard | Admin</title>
  </head>
  <body style="background-color:#EEEEEE;">
    

  <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display: none;"  id="mySidebar">
    <div style="background-color: #0099ff; color:white;">
    <br>
    <button class="w3-bar-item w3-button w3-large" style="text-align: right;"
    onclick="w3_close()"> &times; </button><br>
      
    <div class="text-center">
    <i class="fa fa-user" style="font-size: 30px;"></i>
    <p><b><?php echo($admin['full_name']); ?></b></p></div>
  </div>
    <a href="admindash.php" class="w3-bar-item w3-button">Dashboard</a>
    <a href="adminsignin.html" class="w3-bar-item w3-button">Logout</a>
  </div>

  <div id="main">

  <div class="nav" style="width: 100%; height:55px; background-color: #0099ff;">
    <button id="openNav" class="w3-button  w3-xlarge" onclick="w3_open()" style="color:white">&#9776;</button>
    <div class="w3-container">
  
    </div>
  </div>

  <br><br><br><br><br>
  <div class="w3-container">
    <div class="container">
    <div class="row">
      <div class="col-md-4">
        <div class="text-center callcard">
        <button class="dashmenu">
          <br>
        <img src="images/appointment.svg" style="width:45%;">
            <br><br>
            <p>Scheduled Appointments</p>
        </button>
        </div>
      </div>

      <div class="col-md-4">
          <div class="text-center callcard">
          <button type="button" class="dashmenu" >
          <br>
          <img src="images/groom.svg" style="width:50%;">
          <br><br>
            <p>Grooming Services</p>
          </button>
          </div>
      </div>

      <div class="col-md-4">
          <div class="text-center callcard">
          <button class="dashmenu"  data-toggle="modal" data-target="#admins" >
            <br>
            <img src="images/admins.svg" style="width: 45%;">
            <br><br>
            <p>Administrators</p>
          </button>
          </div>
      </div>

    </div>

    <div class="row">

      <div class="col-md-4">
        <div class="text-center callcard">
        <button class="dashmenu" >
        <br>
          <img src="images/book.svg" style="width:45%;">
          <br><br>
            <p>Pending Appointments</p>
        </button>
        </div>
      </div>

      <div class="col-md-4">
          <div class="text-center callcard">
          <button class="dashmenu">
          <br>
          <img src="images/rooms.svg" style="width:40%;">
          <br><br>
            <p>Room Services</p>
          </button>
          </div>
      </div>

      <div class="col-md-4">
          <div class="text-center callcard">
            <button type="button" class="dashmenu" data-toggle="modal" data-target="#addadmin">
              <br>
              <img src="images/addadmin.svg" style="width: 50%;">
              <br><br>
              <p>Add Administrator</p>
            </button>
          </div>
      </div>

    </div>
    </div>
  </div>


  <!--ADMINISTRATOR--->
  <div class="modal fade" id="admins" tabindex="-1" role="dialog" 
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">
                         Administrators</h3>
                        <!-- The title of the modal -->
                        <button type="button" class="close" data-dismiss="modal" 
                                aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- The content inside the modal box -->
                        <div class="container">
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <td>Admin #</td>
                                  <td>Name</td>
                                  <td>Email</td>
                                </tr>
                              </thead>
                              <tbody>
                                <?php while($admin_det = mysqli_fetch_assoc($adminres)){?>
                                  <tr>
                                    <td><?php echo $admin_det['id']; ?></td>
                                    <td><?php  echo $admin_det['full_name'];  ?></td>
                                    <td><?php  echo $admin_det['email'];  ?></td>
                                  </tr>
                                <?php }?>
                              </tbody>
                            </table>
                          </div>
                        </div>          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!--ADD   ADMINISTRATOR--->
        <div class="modal fade" id="addadmin" tabindex="-1" role="dialog" 
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">
                         Add Administrator</h3>
                        <!-- The title of the modal -->
                        <button type="button" class="close" data-dismiss="modal" 
                                aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- The content inside the modal box -->
                        <div class="container">
                         <form method="POST">
                          <table class="table">
                                  <tr><th>Full Name: </th><td><input type="text" style="width: 100%;" name="fname" required></td></tr>
                                  <tr><th>Username: </th><td><input type="text" style="width: 100%;" name="uname" required></td></tr>
                                  <tr><th>Password: </th><td><input type="password" style="width: 100%;" name="pass" required></td></tr>
                                  <tr><th>Email: </th><td><input type="email" style="width: 100%;" name="email" required></td></tr>
                          </table>
                        </div>          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close</button>
                            <button type="submit" class="btn btn-primary" name="addadmin">
                            Add Administrator</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>





    <!---php for add admin---->
    <?php

    if(isset($_POST['addadmin'])){
      $fname = $_POST['fname'];
      $uname = $_POST['uname'];
      $pass = $_POST['pass'];
      $email = $_POST['email'];

      $sql = "INSERT INTO admin_tbl (full_name,username,password,email) VALUES ('$fname','$uname','$pass','$email')";
      mysqli_query($con,$sql);
      header("refresh:.1");
    }
    ?>              
















<script>
function w3_open() {
 
  var x = window.matchMedia("(max-width: 600px)");
  if(x.matches){
    document.getElementById("main").style.marginLeft = "40%";
  document.getElementById("mySidebar").style.width = "40%";
  }
  else{
    document.getElementById("main").style.marginLeft = "15%";
  document.getElementById("mySidebar").style.width = "15%";
  }
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}

function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}




</script>

<style>
  @media screen and (max-width: 600px) {
   .w3-sidebar{
       width: 40%;
   }
  }
</style>


  </body>
</html>