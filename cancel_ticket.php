<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
 header("location:index.php");
 exit;
}
include 'connect.php';

$email = $_SESSION['useremail'];




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
<body class="search_train_body">
  <nav class="navbar user_nav">
    <div class="container-fluid">
      <h2 class="user_brand">Railway Reservation System</h2>
      <a class="user_logout" href="logout.php"><h2>Log Out</h2></a>
    </div>
  </nav>

  <div style="text-align: center;">
    <a  href="userhome.php"><button style="  outline: none; border: none; height: 36px; width: 200px; background-color: #07689f; color: #fafafa; border-radius: 4px; font-weight: bold; margin-top: 1%;" type="button" name="button">Back</button></a>
  </div>


<?php
$sql1 = "SELECT * FROM `booking` WHERE userEmail = '$email'";
$result1 = mysqli_query($conn, $sql1);
$rows = mysqli_num_rows($result1);

if($rows > 0)
{ ?>

  <div class="search_train_h1">
    <h1 >Cancel Ticket :</h1>
  </div>
  <?php
  $sql = "SELECT * FROM `booking` WHERE userEmail = '$email'";
  $result = mysqli_query($conn, $sql);

  while($data = mysqli_fetch_array($result))
  { ?>
    <div class=" search_train_col">

      <div class="card-body search_train_card" style="border:1px solid;">
        <h5 class="card-title"><?php echo $data['trainNumber'] ?> - <?php echo $data['trainName'] ?></h5>
        <p class="card-text"> <?php echo $data['trainFrom'] ?> To <?php echo $data['trainTo'] ?></p>
        <p>Passenger Name : <?php echo $data['passengerName']; ?></p>
        <p>Date : <?php echo $data['trainDate']; ?></p>
        <p>Departure Time : <?php echo $data['trainDepartTime']; ?></p>
        <p>Class : <?php echo $data['trainClass']; ?></p>
        <p>No. of Adult : <?php echo $data['adultPassenger']; ?></p>
        <p>No. of Child : <?php echo $data['childPassenger']; ?></p>
        <p>Amount Paid : Rs <?php echo $data['trainRate'];?> /-</p>
        <p>Status : Booked</p>
        <a onclick="return confirm('Are you sure you want to Cancel Booking')" href="cancelled.php?id=<?php echo $data['trainNumber']; ?>&passenger=<?php echo $data['passengerName']; ?>" class="btn btn-primary">Cancel Booking</a>

      </div>

    </div>


  <?php } ?>
<?php
}
else
{
  ?>

<div class="no_train_found col-lg-6 alert-danger">
    <h1>No Train Found</h1>
</div>

<?php } ?>








</body>

  </html>
