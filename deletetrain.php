<?php
session_start();
if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!=true)
{
 header("location:admin_login.php");
 exit;
}

include 'connect.php';

$id = $_GET['id'];

$sql = "DELETE FROM `train` WHERE trainNumber = '$id'";
$result = mysqli_query($conn, $sql);
if($result)
{
  header("location:show_remove_train.php");
}
else{
  echo "Error";
}


 ?>
