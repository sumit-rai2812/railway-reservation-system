<?php
session_start();
if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!=true)
{
 header("location:admin_login.php");
 exit;
}

include 'connect.php';

$id = $_GET['id'];
$email = $_GET['email'];
$passenger = $_GET['passenger'];

$sql = "DELETE FROM `booking` WHERE trainNumber = '$id' AND userEmail = '$email' AND passengerName = '$passenger'";
$result = mysqli_query($conn, $sql);
if($result)
{
  header("location:show_remove_ticket.php");
}
else{
  echo "Error";
}


 ?>
