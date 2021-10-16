<?php
session_start();
if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!=true)
{
 header("location:admin_login.php");
 exit;
}
$showalert = false;
$showerror = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{

  include 'connect.php';
  $train_name = $_POST['train_name'];
  $train_number = $_POST['train_number'];

  $train_dtime = $_POST['train_dtime'];
  $train_atime = $_POST['train_atime'];
  $train_date = $_POST['train_date'];
  $train_from = $_POST['train_from'];
  $train_to = $_POST['train_to'];

  $train_duration = $_POST['train_duration'];
  $train_ss_seat = $_POST['train_ss_seat'];
  $train_s_seat = $_POST['train_s_seat'];
  $train_ac_seat = $_POST['train_ac_seat'];
  $twos_rate = $_POST['twos_rate'];
  $sleeper_rate = $_POST['sleeper_rate'];
  $ac_rate = $_POST['ac_rate'];

  $exist = "SELECT * FROM `train` WHERE trainNumber = '$train_number'";
  $result = mysqli_query($conn, $exist);
  $existrow = mysqli_num_rows($result);
      if($existrow > 0)
      {
        $showerror = "The Train Number already exists!";
      }
      else
      {
        // if(!empty($train_name) && !empty($train_number) && !empty($train_rate)  && !empty($train_dtime)  && !empty($train_atime)  && !empty($train_duration) && !empty($train_date) && !empty($train_from) && !empty($train_to) && !empty($train_ss_seat) && !empty($train_s_seat) && !empty($train_ac_seat))
        // {

          $sql = "INSERT INTO `train` (`trainName`, `trainNumber`, `twosRate`, `sleeperRate`, `acRate`,`trainDtime`,`trainAtime`,`trainDuration`,`trainDate`,`trainFrom`, `trainTo`,`trainSS`,`trainS`,`trainAC`) VALUES ('$train_name', '$train_number', '$twos_rate', '$sleeper_rate', '$ac_rate', '$train_dtime', '$train_atime', '$train_duration', '$train_date', '$train_from', '$train_to', '$train_ss_seat', '$train_s_seat', '$train_ac_seat')";
          $result = mysqli_query($conn, $sql);
          if($result)
          {
            $showalert = true;
          }
        // }
        // else
        // {
        //   $showerror = "Enter Valid Inputs!";
        // }
      }


}
?>

<!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- My Stylesheet -->
    <link rel="stylesheet" href="css/styles.css">
    <!-- Bootstrap Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>


    <title>Add Train</title>

  </head>
<body class="addtrain_body">
  <nav class="navbar user_nav">
    <div class="container-fluid">
      <h2 class="user_brand">Railway Reservation System</h2>
      <a class="user_logout" href="logout_admin.php"><h2>Log Out</h2></a>
    </div>
  </nav>

  <?php
  if($showalert)
  {
    echo '  <div class="alert alert-success" role="alert">
        Train Added Successfully;
      </div>';
  }
  if($showerror)
  {
    echo '  <div class="alert alert-danger" role="alert">
        '. $showerror.'
      </div>';
  }


  ?>
<div class="addtrain_center">
  <a  href="admin_home.php"><button style="  outline: none; border: none; height: 36px; width: 200px; background-color: #07689f; color: #fafafa; border-radius: 4px; font-weight: bold; margin-top: 1%;" type="button" name="button">Back</button></a>
</div>




  <div class="container">
    <div class="row">
      <div class="col-lg-4 addtrain_col">
      <div class="">
        <img class="admin_icon" src="images/admin.png" alt="admin">
      </div>
    <form class="" action="addtrain.php" method="post">


      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="train_name" class="form-control" placeholder="Train Name" required>


      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="train_number" class="form-control" placeholder="Train No." required>


      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="twos_rate" class="form-control" placeholder="2s Class Rate" required>


      </div>
      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="sleeper_rate" class="form-control" placeholder="Sleeper Class Rate" required>


      </div>
      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="ac_rate" class="form-control" placeholder="AC Class Rate" required>


      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="train_dtime" class="form-control" placeholder="Departure Time" onfocus="(this.type='time')" required>


      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="train_atime" class="form-control" placeholder="Arrival Time" onfocus="(this.type='time')" required>


      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" name="train_duration" type="text" placeholder="Duration in 00h 00m" required>

      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" name="train_date" type="text" placeholder="Date" onfocus="(this.type='date')" required>

      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" name="train_from" class="form-control" type="text" placeholder="Source"  required>

      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" name="train_to" class="form-control" type="text" placeholder="Destination"  required>

      </div>





      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="train_ss_seat" class="form-control" placeholder="Maximum Second Seating Seats" required>


      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="train_s_seat" class="form-control" placeholder="Maximum Sleeper Seats" required>


      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="train_ac_seat" class="form-control" placeholder="Maximum AC Seats" required>


      </div>



      <div class="col-lg-4 addtrain_button">
        <button class="register_btn addtrain_center"4 type="reset" name="button">Reset</button>

      </div>
      <div class="col-lg-4 addtrain_button">
        <button class="register_btn addtrain_center" type="submit" name="button">Add Train</button>





      </div>
      </form>
    </div>


  </div>


</body>

  </html>
