<?php
session_start();
if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!=true)
{
 header("location:admin_login.php");
 exit;
}

include 'connect.php';

$id = $_GET['id'];

$sql = "DELETE FROM `registration` WHERE userEmail = '$id'";
$result = mysqli_query($conn, $sql);
if($result)
{
  header("location:show_remove_user.php");
}
else{
  echo "Error";
}


 ?>
