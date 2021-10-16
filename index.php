<?php
  $showalert = false;
  $showerror = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{

  include 'connect.php';

  $user_email = $_POST['email'];
  $user_pass = $_POST['password'];

  if(empty($user_email) || empty($user_pass))
  {
    $showerror = "Invalid Email or Password!";
  }


    $sql = "Select * from registration where userEmail='$user_email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
// password_verify($user_pass, $row['userPass'])
    if($num > 0)
    {
      if($row = mysqli_fetch_array($result))
      {
        if($user_pass == $row['userPass'])
        {
          $showalert = true;

          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['useremail'] = $user_email;

          header('location:userhome.php');
        }
        else
        {
          $showerror = "Invalid Email or Password!";
        }
      }

    }
    else
    {
      $showerror = "Invalid Email or Password!";
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


    <title>Login Page</title>

  </head>

  <body class="login_body">
    <?php
    if($showalert)
    {
      echo '  <div class="alert alert-success" role="alert">
          you are logged in
        </div>';
    }
    if($showerror)
    {
      echo '  <div class="alert alert-danger" role="alert">
          '. $showerror.'
        </div>';
    }


    ?>
    <section class="login_section">
      <div class="container login_container">
        <div class="row login_row">
          <div class="col-lg-5 login_div">
            <img class="train1_image img-fluid login_img" src="images/train1.jpg" alt="train">

          </div>
          <div class="col-lg-7 login_box">
  <form class="login_form" action="index.php" method="post">
    <h1>Railway Reservation System</h1>
    <h4>Login to RRS</h4>
    <div class="form-row">
      <div class="col-lg-7">
        <input class="login_input" type="email " name="email" class="form-control" placeholder="Enter your email">


      </div>

    </div>
    <div class="form-row">
      <div class="col-lg-7">
        <input class="login_input" type="password" name="password" class="form-control" placeholder="Enter your password">


      </div>

    </div>
    <div class="form-row">
      <div class="col-lg-7">
        <button class="login_btn" type="submit" name="button">Login</button>


      </div>


    </div>

  </form>
  <p>Admin click here to <a href="admin_login.php">Login</a></p>
  <p>Don't have an account? <a href="register.php">Register here</a></p>
</div>

        </div>

      </div>

    </section>

  </body>

  </html>
