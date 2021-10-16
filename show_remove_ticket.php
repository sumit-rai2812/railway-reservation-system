<?php
session_start();
if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!=true)
{
 header("location:admin_login.php");
 exit;
}



?>

<!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- My Stylesheet -->
    <link rel="stylesheet" href="css/tablestyle.css">
    <link rel="stylesheet" href="css/styles.css">
    <!-- Bootstrap Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a0399831bf.js" crossorigin="anonymous"></script>

    <title>Home</title>

  </head>
<body class="show_remove_train_body">
  <nav class="navbar user_nav">
    <div class="container-fluid">
      <h2 class="user_brand">Railway Reservation System</h2>
      <a class="user_logout" href="logout_admin.php"><h2>Log Out</h2></a>
    </div>
  </nav>
  <div class="addtrain_center">
    <a  href="admin_home.php"><button style="  outline: none; border: none; height: 36px; width: 200px; background-color: #07689f; color: #fafafa; border-radius: 4px; font-weight: bold; margin-top: 1%;" type="button" name="button">Back</button></a>
  </div>

  <h1>List of Trains</h1>



<div class="center_div">
  <div class="table-responsive">
    <table>
      <thead>
        <tr>
          <th>User Email</th>
          <th>User Mobile No.</th>
          <th>Train Number</th>
          <th>Train Name</th>
          <th>Train From</th>
          <th>Train To</th>
          <th>Train Depart Time</th>
          <th>Passenger Name</th>
          <th>Train Class</th>
          <th>No. of Adult</th>
          <th>No. of Child</th>
          <th>Date</th>
          <th>Amount Paid</th>

          <th>Operation</th>
        </tr>
      </thead>
      <tbody>
        <?php

        include 'connect.php';

        $sql = "select * from booking";
        $result = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($result);

        while($data = mysqli_fetch_array($result))
        {

        ?>
        <tr>

        </tr>
        <td><?php echo "$data[userEmail]"  ?></td>
        <td><?php echo "$data[userMob]"  ?></td>
        <td><?php echo "$data[trainNumber]"  ?></td>
        <td><?php echo "$data[trainName]"  ?></td>
        <td><?php echo "$data[trainFrom]"  ?></td>
        <td><?php echo "$data[trainTo]"  ?></td>
        <td><?php echo "$data[trainDepartTime]"  ?></td>
        <td><?php echo "$data[passengerName]"  ?></td>
        <td><?php echo "$data[trainClass]"  ?></td>
        <td><?php echo "$data[adultPassenger]"  ?></td>
        <td><?php echo "$data[childPassenger]"  ?></td>
        <td><?php echo "$data[trainDate]"  ?></td>
        <td><?php echo "$data[trainRate]"  ?></td>


        <td><a href="deletebooking.php?id=<?php echo "$data[trainNumber]" ?>&email=<?php echo "$data[userEmail]" ?>&passenger=<?php echo "$data[passengerName]" ?>" data-bs-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i></a></td>

  <?php } ?>
      </tbody>
    </table>

  </div>

</div>


</body>

  </html>
