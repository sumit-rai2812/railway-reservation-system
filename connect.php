<?php


// DTABASE CONNECTION
$server = "localhost";
$username = "root";
$password = "";
$database = "test1";

$conn = mysqli_connect($server,$username,$password,$database);
if($conn)
{
  // echo "budhfi";
}
else
{
  die("Error:".mysqli_connect_error());
}
  ?>
