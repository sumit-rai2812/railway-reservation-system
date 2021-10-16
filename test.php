<?php
  $showalert = false;
  $showerror = false;
  $validation = false;
  $name_error = false;
  $email_error = false;
  $mob_error = false;
  $pass_error = false;
if($_SERVER["REQUEST_METHOD"] == "POST")
{

  include 'connect.php';
  $user_name = $_POST['user_name'];
  $user_email = $_POST['user_email'];
  $user_date_of_birth = $_POST['user_date_of_birth'];
  $user_gender = $_POST['user_gender'];
  $user_mob = $_POST['user_mob'];
  $user_add = $_POST['user_add'];
  $user_pass = $_POST['user_pass'];
  $user_cpass = $_POST['user_cpass'];
  $v_name = false;
  $v_email = false;
  $v_mob = false;
  $v_pass = false;



if(!ctype_alpha(str_replace(' ', '', $user_name)))
{
  $name_error = "Only letters are allowed";
}
else
{
  $v_name = true;
}
if(!filter_var($user_email, FILTER_VALIDATE_EMAIL))
{
  $email_error = "Enter valid Email";
}
else
{
  $v_email = true;
}
if(!preg_match('/^[0-9]{10}+$/', $user_mob))
{
  $mob_error = "Enter correct Mobile Number";
}
else
{
  $v_mob = true;
}


if(!empty($user_pass) && ($user_cpass == $user_pass)) {

    if (strlen($user_pass) < '6') {
        $pass_error = "Password Must Contain 6 Characters!";
    }
    elseif(!preg_match("#[0-9]+#",$user_pass)) {
        $pass_error = "Password Must Contain Number!";
    }
    elseif(!preg_match("#[A-Z]+#",$user_pass)) {
        $pass_error = "Password Must Contain Capital Letter!";
    }
    elseif(!preg_match("#[a-z]+#",$user_pass)) {
        $pass_error = "Password Must Contain Lowercase Letter!";
    }

    else
    {
      $v_pass = true;
    }
}
elseif(!empty($user_pass))
{
    $pass_error = "Please Check You've Confirmed Your Password!";
}
else
{
     $pass_error = "Please enter password   ";
}


if($v_name && $v_email && $v_mob && $v_pass)
{
  $exist = "SELECT * FROM `registration` WHERE userEmail = '$user_email'";
  $result = mysqli_query($conn, $exist);
  $existrow = mysqli_num_rows($result);
      if($existrow > 0)
      {
        $showerror = "The email is already registered!";
      }
      else
      {
        if($user_pass == $user_cpass)
        {
          $hash = password_hash($user_pass, PASSWORD_DEFAULT);
          $sql = "INSERT INTO `registration` (`userName`, `userEmail`, `userDOB`, `userGender`, `userMob`, `userAdd`, `userPass`) VALUES ('$user_name', '$user_email', '$user_date_of_birth', '$user_gender', '$user_mob', '$user_add', '$hash')";
          $result = mysqli_query($conn, $sql);
          if($result)
          {
            $showalert = true;
          }
        }
        else
        {
          $showerror = "Passwords do not match!";
        }
      }
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
        Registration Successful. Now you can login.
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
        <div class="col-lg-7 admin_login_box">
          <form action="test.php" method="post">
            <h1>Railway Reservation System</h1>
            <h4>Register to RRS</h4>
            <div class="row">
              <div class="col-lg-4">
                <input class="register_input" type="text" name="user_name" class="form-control" placeholder="Full Name" required>


              </div>
              <div class="col-lg-4">
                <div class="input-group ">
                  <label class="input-group-text" for="user_gender">Gender</label>
                  <select class="form-select" name="user_gender" id="user_gender" required>
                    <option selected >Male</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                  </select>
                </div>
              </div>
              <?php
              if($name_error)
              {
                echo '  <div class="col-lg-4 " style="  padding: 0 0 0 1%; margin: 0; border: none; border-radius: 4px; color: #842029; background-color: #f8d7da; border-color: #f5c2c7;" >
                    '. $name_error.'
                  </div>';
              }
               ?>

            </div>
            <div class="row">
              <div class="col-lg-4">
                <input class="register_input" type="date" name="user_date_of_birth" class="form-control" placeholder="Date of Birth" required>


              </div>
              <div class="col-lg-4">
                <input class="register_input" type="email" name="user_email" class="form-control" placeholder="Email" required>


              </div>
              <?php
              if($email_error)
              {
                echo '  <div class="col-lg-4 " style="  padding: 0 0 0 1%; margin: 0; border: none; border-radius: 4px; color: #842029; background-color: #f8d7da; border-color: #f5c2c7;">
                    '. $email_error.'
                  </div>';
              }
               ?>

            </div>
            <div class="row">
              <div class="col-lg-4">
                <input class="register_input" type="text" name="user_add" class="form-control" placeholder="Address" required>


              </div>
              <div class="col-lg-4">
                <input class="register_input" type="text" name="user_mob" class="form-control" placeholder="Mobile No." required>


              </div>

              <?php
              if($mob_error)
              {
                echo '  <div class="col-lg-4 " style="  padding: 0 0 0 1%; margin: 0; border: none; border-radius: 4px; color: #842029; background-color: #f8d7da; border-color: #f5c2c7;">
                    '. $mob_error.'
                  </div>';
              }
               ?>
            </div>
            <div class="row">
              <p class="pass_para ">Note: Password must contain Lowercase, Uppercase and Digit.</p>
              <div class="col-lg-4">
                <input class="register_input" type="password" name="user_pass" class="form-control" placeholder="Create password" required>


              </div>
              <div class="col-lg-4">
                <input class="register_input" type="cpassword" name="user_cpass" class="form-control" placeholder="Confirm Password" required>


              </div>
              <?php
              if($pass_error)
              {
                echo '  <div class="col-lg-4 " style="  padding: 0 0 0 1%; margin: 0; border: none; border-radius: 4px; color: #842029; background-color: #f8d7da; border-color: #f5c2c7;" >
                    '. $pass_error.'
                  </div>';
              }
               ?>
            </div>
            <div class="row">
              <div class="col-lg-4">
                <button class="register_btn"4 type="reset" name="button">Reset</button>

              </div>
              <div class="col-lg-4">
                <button class="register_btn" type="submit" name="button">Register</button>


              </div>

            </div>

          </form>
          <p>Admin click here to <a href="admin_login.php">Login</a></p>
          <p>Already have an account? <a href="index.php">Login here</a></p>
        </div>

      </div>

    </div>

  </section>

</body>

</html>
