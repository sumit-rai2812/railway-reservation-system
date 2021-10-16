<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
 header("location:index.php");
 exit;
}
$train_number = $_GET['id'];
$passenger = $_POST['passenger'];
$class = $_POST['class'];
$adult = $_POST['adult'];
$child = $_POST['child'];

$given_class = $_POST['class'];

$given_adult = $_POST['adult'];
$given_child = $_POST['child'];
if($_SESSION['getinto'] = true)
{
  header("location:payment.php?id=<?php echo $train_number; ?>");
}
?>
