<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
 header("location:index.php");
 exit;
}
include 'connect.php';
$go = false;
$email = $_SESSION['useremail'];
$train_number = $_GET['id'];
$passenger = $_GET['passenger'];

$sql = "DELETE FROM `booking` WHERE userEmail = '$email' AND trainNumber = '$train_number' AND passengerName = '$passenger'";
$result = mysqli_query($conn, $sql);

if($result)
{
  $go = true;
}
else
{
  echo "Error Unable To Process";
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
  <?php

  if($go == true)
  {

?>
<body class="admin_body">
  <nav class="navbar user_nav">
    <div class="container-fluid">
      <h2 class="user_brand">Railway Reservation System</h2>
      <a class="user_logout" href="logout.php"><h2>Log Out</h2></a>
    </div>
  </nav>

  <div class="alert alert-info" role="alert">
    <h4 class="alert-heading">Cancellation Successful</h4>
    <p>You had Successfully cancelled Ticket. Your money will be refunded soon. </p>
    <hr>
    <p class="mb-0">To Go Home <a href="userhome.php">Click Here </a> </p>
  </div>

<?php  } ?>
</body>

  </html>
