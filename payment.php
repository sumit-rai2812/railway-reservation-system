<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
 header("location:index.php");
 exit;
}




include 'connect.php';
if($_SERVER["REQUEST_METHOD"] == "GET")
{


  include 'connect.php';


$mail = $_SESSION['useremail'];
$train_number = $_GET['id'];
$given_passenger = $_GET['passenger'];
$given_class = $_GET['class'];

$sql1 = "SELECT * FROM `booking` WHERE userEmail = '$mail' AND trainNumber = '$train_number' AND passengerName = '$given_passenger'";
$result1 = mysqli_query($conn, $sql1);
$rows = mysqli_num_rows($result1);

if($rows > 0)
{
  header("location:booking.php?id=$train_number&exist=yes");
}
else
{


$given_adult = $_GET['adult'];
$given_child = $_GET['child'];

$train_number = $_GET['id'];


$sql = "SELECT * FROM `train` WHERE trainNumber = '$train_number'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($result);

$twos_rate = $data['twosRate'];
$sleeper_rate = $data['sleeperRate'];
$ac_rate = $data['acRate'];


if($given_class == "2s")
{
  $percent = $twos_rate/100;


    $rate = $twos_rate;
    if($given_adult == "1")
    {
        $rate = $twos_rate;
    }
    elseif($given_adult == "2")
    {
      $rate = $twos_rate*2;

    }
    elseif($given_adult == "3")
    {
        $rate = $twos_rate*3;
    }
    elseif($given_adult == "4")
    {
        $rate = $twos_rate*4 ;
    }

// ........................................................

    if($given_child == "1")
    {
        $rate = $rate + $percent*70;
    }
    elseif($given_child == "2")
    {
        $rate = $rate + $percent *70 *2;
    }
    elseif($given_child == "3")
    {
        $rate = $rate + $percent *70 *3;
    }
    elseif($given_child == "4")
    {
        $rate = $rate + $percent *70 *4;
    }
    else
    {
        $rate = $rate + 0;
    }

}
elseif($given_class == "sleeper")
{
  $percent = $sleeper_rate/100;


    $rate = $sleeper_rate;
    if($given_adult == "1")
    {
        $rate = $sleeper_rate;
    }
    elseif($given_adult == "2")
    {
      $rate = $sleeper_rate*2;

    }
    elseif($given_adult == "3")
    {
        $rate = $sleeper_rate*3;
    }
    elseif($given_adult == "4")
    {
        $rate = $sleeper_rate*4;
    }

// ........................................................

    if($given_child == "1")
    {
        $rate = $rate + $percent*70;
    }
    elseif($given_child == "2")
    {
        $rate = $rate + $percent *70 *2;
    }
    elseif($given_child == "3")
    {
        $rate = $rate + $percent *70 *3;
    }
    elseif($given_child == "4")
    {
        $rate = $rate + $percent *70 *4;
    }
    else
    {
        $rate = $rate + 0;
    }

}

elseif($given_class == "ac")
{
  $percent = $ac_rate/100;


    $rate = $ac_rate;
    if($given_adult == "1")
    {
        $rate = $ac_rate;
    }
    elseif($given_adult == "2")
    {
      $rate = $ac_rate*2;

    }
    elseif($given_adult == "3")
    {
        $rate = $ac_rate*3;
    }
    elseif($given_adult == "4")
    {
        $rate = $ac_rate*4;
    }

// ........................................................

    if($given_child == "1")
    {
        $rate = $rate + $percent * 70;
    }
    elseif($given_child == "2")
    {
        $rate = $rate + $percent *70 *2;
    }
    elseif($given_child == "3")
    {
        $rate = $rate + $percent *70 *3;
    }
    elseif($given_child == "4")
    {
        $rate = $rate + $percent *70 *4;
    }
    else
    {
        $rate = $rate + 0;
    }

}

}

}
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $total_amount = $_GET['rate'];
  $train_number = $_GET['id'];
  $email = $_SESSION['useremail'];


  $sql = "SELECT * FROM `train` WHERE trainNumber = '$train_number'";
  $result = mysqli_query($conn, $sql);
  $traindata = mysqli_fetch_array($result);

  $train_name = $traindata['trainName'];
  $train_from = $traindata['trainFrom'];
  $train_to = $traindata['trainTo'];
  $train_depart = $traindata['trainDtime'];
  $train_date = $traindata['trainDate'];

  $sql = "SELECT * FROM `registration` WHERE userEmail = '$email'";
  $result = mysqli_query($conn, $sql);
  $userdata = mysqli_fetch_array($result);

  $user_email = $userdata['userEmail'];
  $user_mob = $userdata['userMob'];


  $passenger = $_GET['passenger'];
  $class = $_GET['class'];
  $adult = $_GET['adult'];
  $child = $_GET['child'];



  if(!empty($user_email) && !empty($user_mob) && !empty($train_number) && !empty($train_name) && !empty($train_from) && !empty($train_to) && !empty($train_depart) && !empty($passenger) && !empty($class) && !empty($adult) && !empty($total_amount) && !empty($train_date))
  {

    $sql1 ="INSERT INTO `booking`(`userEmail`, `userMob`, `trainNumber`, `trainName`, `trainFrom`, `TrainTo`, `trainDepartTime`, `passengerName`, `trainClass`, `adultPassenger`, `childPassenger`, `trainDate`, `trainRate`) VALUES ('$user_email','$user_mob','$train_number','$train_name','$train_from','$train_to','$train_depart','$passenger','$class','$adult','$child','$train_date','$total_amount')";
    $result1 = mysqli_query($conn, $sql1);
    if($result1)
    {
      echo "success";
      header("location:successful.php");
    }
    else
    {
      echo "Error";
    }
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


    <title>Home</title>

  </head>
<body class="admin_body">
  <nav class="navbar user_nav">
    <div class="container-fluid">
      <h2 class="user_brand">Railway Reservation System</h2>
      <a class="user_logout" href="logout.php"><h2>Log Out</h2></a>
    </div>
  </nav>

  <div style="text-align: center;">
    <a  href="userhome.php"><button style="  outline: none; border: none; height: 36px; width: 200px; background-color: #07689f; color: #fafafa; border-radius: 4px; font-weight: bold; margin-top: 1%;" type="button" name="button">Home</button></a>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-4 booking_col">
      <div style="margin-bottom: 8%;">
        <h2>Payment:</h2>
        <h3>Total Amount: Rs <?php echo $rate; ?></h3>
      </div>
    <form class="" action="payment.php?id=<?php echo $train_number; ?>&passenger=<?php echo $given_passenger; ?>&class=<?php echo $given_class; ?>&adult=<?php echo $given_adult; ?>&child=<?php echo $given_child; ?>&rate=<?php echo $rate; ?>" method="post">



      <div class="col-lg-8 input-group user_selection">
        <label class="input-group-text" for="user_gender">Select Card</label>
        <select class="form-select" name="user_gender" id="user_gender">
          <option selected>Credit Card</option>

          <option value="Debit Card">Debit Card</option>

        </select>
      </div>
      <div class="col-lg-8 input-group user_selection">
        <label class="input-group-text" for="user_gender">Card Number</label>
        <input pattern="[0-9]{1,60}" class="form-control" type="text" name="" value=""  required>
      </div>
      <div class="col-lg-8 input-group user_selection">
        <label class="input-group-text" for="user_gender">CVV</label>
        <input pattern="[0-9]{1,10}" class="form-control" type="text" name="" value=""  required>
      </div>


      <button style="margin-top:4%;" class="user_submit" type="submit" name="submit">Go for Payment</button>
      </form>
    </div>


  </div>



</body>

  </html>
