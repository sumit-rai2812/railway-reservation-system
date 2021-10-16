<?php
session_start();
$_SESSION['getinto'] = true;
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
 header("location:index.php");
 exit;
}
$exist = $_GET['exist'];
$train_number = $_GET['id'];
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
<body class="admin_body">
  <nav class="navbar user_nav">
    <div class="container-fluid">
      <h2 class="user_brand">Railway Reservation System</h2>
      <a class="user_logout" href="logout.php"><h2>Log Out</h2></a>
    </div>
  </nav>
<?php
  if($exist == "yes")
  {
    echo '  <div class="alert alert-danger" role="alert">
        Ticket Already Booked.
      </div>';
  }

?>
  <div style="text-align: center;">
    <a  href="userhome.php"><button style="  outline: none; border: none; height: 36px; width: 200px; background-color: #07689f; color: #fafafa; border-radius: 4px; font-weight: bold; margin-top: 1%;" type="button" name="button">Home</button></a>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-4 booking_col">
      <div style="margin-bottom: 8%;">
        <h2>Enter Correct Details:</h2>
      </div>
    <form class="" action="payment.php?id=<?php echo $train_number ?>" method="get">


      <div class="col-lg-8 input-group user_selection">
        <label class="input-group-text" for="passenger">Passenger Name</label>
        <input pattern="[A-Za-z ]{1,60}" class="form-control" type="text" name="passenger" value=""  required>
      </div>
      <div class="col-lg-8 input-group user_selection">
        <label class="input-group-text" for="class">Class</label>
        <select class="form-select" name="class" id="class">
          <option selected>2s</option>

          <option value="sleeper">Sleeper</option>
          <option value="ac">AC</option>
        </select>
      </div>
      <div class="col-lg-8 input-group user_selection">
        <label class="input-group-text" for="adult">No. of Adult</label>
        <select class="form-select" name="adult" id="adult" required>
          <option selected>1</option>

          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
      </div>
      <div class="col-lg-8 input-group user_selection">
        <label class="input-group-text" for="child">No. of Child</label>
        <select class="form-select" name="child" id="child" required>
          <option selected>0</option>

          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
        </select>
      </div>

      <button style="margin-top:4%;" class="user_submit" type="submit" name="id" value="<?php echo $train_number ?>" >Go for Payment</button>
      </form>
    </div>


  </div>


</body>

  </html>
