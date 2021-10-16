<?php
session_start();
if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!=true)
{
 header("location:admin_login.php");
 exit;
}

include 'connect.php';


$getid = $_GET['id'];


$sql1 = "SELECT * FROM `train` WHERE trainNumber = '$getid' ";
$result1 = mysqli_query($conn, $sql1);
$getdata = mysqli_fetch_array($result1);

$showalert = false;
$showerror = false;


if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $id = $_GET['id'];

  $train_name = $_POST['train_name'];
  $train_number = $_POST['train_number'];
  $twos_rate = $_POST['twosRate'];
  $sleeper_rate= $_POST['sleeperRate'];
  $ac_rate = $_POST['acRate'];
  $train_dtime = $_POST['train_dtime'];
  $train_atime = $_POST['train_atime'];
  $train_duration = $_POST['train_duration'];
  $train_date = $_POST['train_date'];
  $train_from = $_POST['train_from'];
  $train_to = $_POST['train_to'];
  $train_ss_seat = $_POST['trainSS'];
  $train_s_seat = $_POST['trainS'];
  $train_ac_seat = $_POST['trainAC'];


        if(!empty($train_name) && !empty($train_number) && !empty($twos_rate) && !empty($sleeper_rate) && !empty($ac_rate) && !empty($train_dtime) && !empty($train_atime) && !empty($train_duration) && !empty($train_date) && !empty($train_from) && !empty($train_to) && !empty($train_ss_seat) && !empty($train_s_seat) && !empty($train_ac_seat) )
        {

          $sql = "UPDATE `train` SET `trainName`='$train_name',`trainNumber`='$train_number',`twosRate`='$twos_rate',`sleeperRate`='$sleeper_rate',`acRate`='$ac_rate',`trainDtime`='$train_dtime',`trainAtime`='$train_atime',`trainDuration`='$train_duration',`trainDate`='$train_date',`trainFrom`='$train_from',`trainTo`='$train_to',`trainSS`='$train_ss_seat',`trainS`='$train_s_seat',`trainAC`='$train_ac_seat', WHERE trainNumber = '$id'";
          $result = mysqli_query($conn, $sql);
          if($result)
          {
            header("location:show_remove_train.php");
          }
        }
        else
        {
          $showerror = "Enter Valid Inputs!";
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
        Data Updated Successfully;
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
  <a  href="show_remove_train.php"><button style="  outline: none; border: none; height: 36px; width: 200px; background-color: #07689f; color: #fafafa; border-radius: 4px; font-weight: bold; margin-top: 1%;" type="button" name="button">Back</button></a>
</div>




  <div class="container">
    <div class="row">
      <div class="col-lg-4 addtrain_col">
      <div class="">
        <img class="admin_icon" src="images/admin.png" alt="admin">
      </div>
    <form class="" action="updatetrain.php?id=<?php echo $getid ?>" method="post">


      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="train_name" class="form-control" placeholder="Train Name" value="<?php echo $getdata['trainName']?>" required>


      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="train_number" class="form-control" placeholder="Train No." value="<?php echo $getdata['trainNumber']?>" required>


      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="twos_rate" class="form-control" placeholder="2s Class Rate" value="<?php echo $getdata['twosRate']?>" required>


      </div>
      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="sleeper_rate" class="form-control" placeholder="Sleeper Class Rate" value="<?php echo $getdata['sleeperRate']?>" required>


      </div>
      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="ac_rate" class="form-control" placeholder="AC Class Rate" value="<?php echo $getdata['acRate']?>" required>


      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="train_dtime" class="form-control" placeholder="Departure Time" value="<?php echo $getdata['trainDtime']?>" onfocus="(this.type='time')"  required>


      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="train_atime" class="form-control" placeholder="Arrival Time" value="<?php echo $getdata['trainAtime']?>" onfocus="(this.type='time')" required>


      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" name="train_duration" type="text" placeholder="Duration in 00h 00m" value="<?php echo $getdata['trainDuration']?>" required>

      </div>
      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" name="train_date" type="text" placeholder="Date" value="<?php echo $getdata['trainDate']?>" onfocus="(this.type='date')" required>

      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" name="train_from" class="form-control" type="text" placeholder="Source" value="<?php echo $getdata['trainFrom']?>"  required>

      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" name="train_to" class="form-control" type="text" placeholder="Destination" value="<?php echo $getdata['trainTo']?>"  required>

      </div>





      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="train_ss_seat" class="form-control" placeholder="Maximum Second Seating Seats" value="<?php echo $getdata['trainSS']?>" required>


      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="train_s_seat" class="form-control" placeholder="Maximum Sleeper Seats" value="<?php echo $getdata['trainS']?>" required>


      </div>

      <div class="col-lg-8 addtrain_center">
        <input class="addtrain_input" type="text" name="train_ac_seat" class="form-control" placeholder="Maximum AC Seats" value="<?php echo $getdata['trainAC']?>" required>


      </div>



      <div class="col-lg-4 addtrain_button">
        <button class="register_btn addtrain_center"4 type="reset" name="button">Reset</button>

      </div>
      <div class="col-lg-4 addtrain_button">
        <button class="register_btn addtrain_center" type="submit" name="button">Update</button>





      </div>
      </form>
    </div>


  </div>


</body>

  </html>
