<?php
ob_start();
session_start();
include("actions/connection.php");
if(!$_SESSION['logged']){
header("location: signin.html");
}

$user_id = $_SESSION['id'];
$sql = "SELECT * FROM client_tbl WHERE id = '$user_id'";
$res= mysqli_query($con,$sql);
$user = mysqli_fetch_assoc($res);

$sql = "SELECT * FROM appointment_tbl WHERE user_id = '$user_id'";
$appointres = mysqli_query($con,$sql);

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
    
    <title>Dashboard | Pampered Pets</title>
  </head>
  <body style="background-color:#f2f2f2">
    

  <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display: none;"  id="mySidebar">
    <div style="background-color: #0099ff; color:white;">
    <br>
    <button class="w3-bar-item w3-button w3-large" style="text-align: right;"
    onclick="w3_close()"> &times; </button><br>

    <div class="text-center">
    <i class="fa fa-user" style="font-size: 30px;"></i>
    <p><b><?php echo($user['first_name']." ".$user['last_name']); ?></b></p>
    </div>
  </div>
    <a href="userdash.php" class="w3-bar-item w3-button">Dashboard</a>

    <a href="index.html" class="w3-bar-item w3-button">Logout</a>
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

      <div class="col-md-4 callcard">
        <div class="text-center">
          <button type="button" class="dashmenu" data-toggle="modal" data-target="#appointment">
          <br>
            <img src="images/appointment.svg" style="width:45%;">
            <br><br>
            <p>My Appointments</p>
        </button>
        </div>
      </div>

      <div class="col-md-4">
          <div class="text-center callcard">
            <button type="button" class="dashmenu" data-toggle="modal" data-target="#viewprofile">
            <br>
            <img src="images/prof.svg" style="width:55%;">
            <br><br>
            <p>My Profile</p>
          </button>
          </div>
      </div>

      <div class="col-md-4">
          <div class="text-center callcard">
            <button class="dashmenu">
            <br>
            <img src="images/mypet.svg" style="width:32%;">
            <br><br>
            <p>My Pets</p>
          </button>
          </div>
      </div>
      
    </div>

    <div class="row">

      <div class="col-md-4">
        <div class="text-center callcard">
          <button type="button" class="dashmenu" data-toggle="modal" data-target="#createappointment">
          <br>
          <img src="images/book.svg" style="width:45%;">
          <br><br>
            <p>Create Appointment</p>
          </button>
          
        </div>
      </div>

      <div class="col-md-4">
          <div class="text-center callcard">
            <button type="button" class="dashmenu" data-toggle="modal" data-target="#editprofile">
            <br>
            <img src="images/addprof.svg" style="width:35%;">
            <br><br>
            <p>Edit Profile</p>
          </button>
          </div>
      </div>

      <div class="col-md-4">
          <div class="text-center callcard">
            <button class="dashmenu">
            <br>
            <img src="images/pets.svg" style="width:40%;">
            <br><br>
            <p>Add Pet's Details</p>
          </button>
          </div>
      </div>

    </div>

    </div>
  </div>

  <!--APPOINTMENTS--->
  <div class="modal fade" id="appointment" tabindex="-1" role="dialog" 
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">
                         My Appointments</h3>
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
                              <th>Date</th>
                              <th>Groom Type</th>
                              <th>Room Type</th>
                              <th>Status</th>
                              <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                while($appdet = mysqli_fetch_assoc($appointres)){  
                              ?>

                                  <tr>
                                    <td><?php echo $appdet['date']; ?></td>
                                    <td><?php echo $appdet['groom_type']; ?></td>
                                    <td><?php echo $appdet['room_type']; ?></td>
                                    <td><?php echo $appdet['status']; ?></td>
                                  </tr>
                              <?php } ?>
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

        <!--CREATE APPOINTMENT--->
        <div class="modal fade" id="createappointment" tabindex="-1" role="dialog" 
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">
                         Create Appointment</h3>
                        <!-- The title of the modal -->
                        <button type="button" class="close" data-dismiss="modal" 
                                aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- The content inside the modal box -->
                        <div class="container">
                          <table class="table">
                            <form method="POST">
                            <tr><th>Date Schedule: </th><td><input type="date" name="date" style="width: 100%;" required></td></tr>
                            <tr><th>Room Type: </th><td>
                                                <select name="room_type"style="width: 100%;" required>
                                                <option value="" disabled selected>Select room type</option>
                                                <option value="Ordinary">Ordinary</option>
                                                <option value="Deluxe">Deluxe</option>
                                                <option value="Premium">Premium</option>
                                                <option value="VIP">VIP</option>
                                              </select></td></tr>
                            <tr><th>Groom Type: </th><td>
                                                <select name="groom_type"style="width: 100%;" required>
                                                <option value="" disabled selected>Select groom type</option>
                                                <option value="Basic Groom">Basic Groom</option>
                                                <option value="Full Groom">Full Groom</option>
                                              </select></td></tr>
                          </table>
                        </div>          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close</button>
                            <button type="submit" name="createappointment" class="btn btn-primary">
                            Create Appointment</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>

        <!--------VIEW PROFILE-------->
        <div class="modal fade" id="viewprofile" tabindex="-1" role="dialog" 
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">
                         My Profile</h3>
                        <!-- The title of the modal -->
                        <button type="button" class="close" data-dismiss="modal" 
                                aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- The content inside the modal box -->
                        <div class="container">
                              <div class="text-center">
                              <img src="images/user.svg" style="width:25%;">
                              </div>
                              <br>
                              <table class="table-borderless">
                                  <tr><th>Name: </th><td><?php echo $user['first_name']." ".$user['last_name']; ?></td></tr>
                                  <tr><th>Username: </th><td><?php echo $user['username']; ?></td></tr>
                                  <tr><th>Email: </th><td><?php echo $user['email']; ?></td></tr>
                                  <tr><th>Contact: </th><td><?php echo $user['contact']; ?></td></tr>
                              </table>  
                        </div>          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close</button> 
                    </div>
                </div>
            </div>
        </div>

<!--------EDIT PROFILE-------->
<div class="modal fade" id="editprofile" tabindex="-1" role="dialog" 
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="exampleModalLabel">
                         Edit Profile</h3>
                        <!-- The title of the modal -->
                        <button type="button" class="close" data-dismiss="modal" 
                                aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- The content inside the modal box -->
                        <div class="container">
                              <div class="text-center">
                              <img src="images/user.svg" style="width:25%;">
                              </div>
                              <br>
                              <table class="table">
                                <form method="POST">
                                  <tr><th>First Name: </th><td><input type="text" value="<?php echo $user['first_name'];?>" style="width: 100%;" placeholder="First Name" name="fname" required>  </td></tr>
                                  <tr><th>Last Name: </th><td><input type="text" value="<?php echo $user['last_name'];?>" style="width: 100%;" placeholder="Last Name" name="lname"  required>  </td></tr>
                                  <tr><th>Username: </th><td> <input type="text" value="<?php echo $user['username'];?>" style="width: 100%;" placeholder="Username" name="uname"  required> </td></tr>
                                  <tr><th>Password: </th><td> <input type="password" style="width: 100%;" placeholder="New Password" name="pass"  required> </td></tr>
                                  <tr><th>Email: </th><td> <input type="email" value="<?php echo $user['email'];?>" style="width: 100%;" placeholder="Email" name="email"  required> </td></tr>
                                  <tr><th>Contact </th><td> <input type="number" 
                                  value="<?php echo $user['contact'];?>" style="width: 100%;" placeholder="Contact" name="contact"  required> </td></tr>
                              </table>  
                        </div>          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Close</button> 
                            <button type="submit" name="editprof" class="btn btn-primary">
                            Save Changes</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>





<!---PHP SCRIPT FOR CREATE APPOINTMENT--->
<?php
  if(isset($_POST['createappointment'])){
    $date = $_POST['date'];
    $room = $_POST['room_type'];
    $groom = $_POST['groom_type'];
    $status = "Pending";
    $owner = $user_id;

    $sql = "INSERT INTO appointment_tbl (user_id,date,room_type,groom_type,status) VALUES ('$owner','$date','$room','$groom','$status')";
    mysqli_query($con,$sql);
    header("refresh:.1");
  }
?>

<!---PHP SCRIPT FOR EDIT PROFILE--->
<?php

  if(isset($_POST['editprof'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    $sql = "UPDATE client_tbl SET first_name = '$fname',last_name = '$lname', username = '$uname', password = '$pass', 
    email = '$email', contact = '$contact' ";

    mysqli_query($con,$sql);
    header("refresh:.01");
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