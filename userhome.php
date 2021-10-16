<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
 header("location:index.php");
 exit;
}

include 'connect.php';


$sql1 = "SELECT * FROM `train`";
$result1 = mysqli_query($conn, $sql1);

while($getfrom = mysqli_fetch_array($result1))
{
  $exist = "SELECT * FROM `source` WHERE trainFrom = '$getfrom[trainFrom]'";
  $result = mysqli_query($conn, $exist);
  $existrow = mysqli_num_rows($result);
  if($existrow > 0)
  {
    continue;
  }
  else
  {
    $sql = "INSERT INTO `source`(`trainFrom`) VALUES ('$getfrom[trainFrom]')";
    $result = mysqli_query($conn, $sql);

  }


}

$sql1 = "SELECT * FROM `train`";
$result1 = mysqli_query($conn, $sql1);

while($getto = mysqli_fetch_array($result1))
{

  $exist = "SELECT * FROM `destination` WHERE trainTo = '$getto[trainTo]'";
  $result = mysqli_query($conn, $exist);
  $existrow = mysqli_num_rows($result);
  if($existrow > 0)
  {
    continue;
  }
  else
  {
    $sql = "INSERT INTO `destination`(`trainTo`) VALUES ('$getto[trainTo]')";
    $result = mysqli_query($conn, $sql);

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


        <title>Welcome</title>

      </head>
    <body class="user_body">
      <nav class="navbar user_nav">
        <div class="container-fluid">
          <h2 class="user_brand">Railway Reservation System</h2>
          <a class="user_logout" href="logout.php"><h2>Log Out</h2></a>
        </div>
      </nav>

      <div class="container user_container">
        <div class="row">
          <div class="col-lg-4 user_buttons">
            <h2> Select any option:</h2>
            <a href="userhome.php"><button class="user_btn" type="button" name="button">Book Ticket</button></a>
            <a href="train_enquiry.php"><button class="user_btn" type="button" name="button">Train Enquiry</button></a>
            <a href="cancel_ticket.php"><button class="user_btn" type="button" name="button">Cancel Ticket</button></a>
            <a href="reservation_status.php"><button class="user_btn" type="button" name="button">Reservation Status</button></a>

          </div>
          <div class="col-lg-4">
            <h2>Book Ticket:</h2>
            <hr class="user_hr">
            <form class="" action="searchtrain.php" method="post">
              <div class="input-group user_selection">
                <label class="input-group-text" for="given_from">From</label>
                <select class="form-select" name="given_from" >
                  <!-- <option selected>option</option> -->
                  <?php

                  $sql1 = "SELECT * FROM `source`";
                  $result1 = mysqli_query($conn, $sql1);

                  while($getfrom = mysqli_fetch_array($result1))
                  { ?>

                    <option value="<?php echo $getfrom['trainFrom'] ?>"><?php echo $getfrom['trainFrom'] ?></option>
                  <?php } ?>




                </select>
              </div>
              <div class="input-group user_selection">
                <label class="input-group-text" for="given_to">To</label>
                <select class="form-select" name="given_to" >

                  <?php

                  $sql1 = "SELECT * FROM `destination`";
                  $result1 = mysqli_query($conn, $sql1);

                  while($getto = mysqli_fetch_array($result1))
                  { ?>

                    <option value="<?php echo $getto['trainTo'] ?>"><?php echo $getto['trainTo'] ?></option>
                  <?php } ?>



                </select>
              </div>
              <div class="input-group user_selection">
                <label class="input-group-text" for="given_date">Date</label>
              <input class="user_date" type="date" name="given_date" value="">
              </div>
              <!-- <div class="input-group user_selection">
                <label class="input-group-text" for="user_gender">No. of Adult</label>
                <select class="form-select" name="user_gender" id="user_gender">
                  <option selected>option</option>
                  <option value="Male">1</option>
                  <option value="Female">2</option>
                  <option value="Other">3</option>
                </select>
              </div>
              <div class="input-group user_selection">
                <label class="input-group-text" for="user_gender">No. of Child</label>
                <select class="form-select" name="user_gender" id="user_gender">
                  <option selected>option</option>
                  <option value="Male">1</option>
                  <option value="Female">2</option>
                  <option value="Other">3</option>
                </select>
              </div> -->
              <button class="user_submit" type="submit" name="submit">Search Trains</button>

            </div>
            </form>
          <div class="col-lg-4 ">
              <img src="images/train3.jpg" alt="train" class="img-fluid" style="height: 295px;">
          </div>

        </div>

      </div>

    </body>

      </html>
