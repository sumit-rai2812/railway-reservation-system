<?php

session_start();
if(!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin']!=true)
{
 header("location:admin_login.php");
 exit;
}

include 'connect.php';


$getid = $_GET['id'];


$sql1 = "SELECT * FROM `registration` WHERE userEmail = '$getid' ";
$result1 = mysqli_query($conn, $sql1);
$getdata = mysqli_fetch_array($result1);

  $showalert = false;
  $showerror = false;
  $validation = false;
  $name_error = false;
  $email_error = false;
  $mob_error = false;

if($_SERVER["REQUEST_METHOD"] == "POST")
{

  include 'connect.php';
  $user_name = $_POST['user_name'];
  $user_email = $_POST['user_email'];
  $user_date_of_birth = $_POST['user_date_of_birth'];
  $user_gender = $_POST['user_gender'];
  $user_mob = $_POST['user_mob'];
  $user_add = $_POST['user_add'];
  $v_name = false;
  $v_email = false;
  $v_mob = false;




if(!ctype_alpha(str_replace(' ', '', $user_name)) || empty($user_name))
{
  $name_error = "Only letters are allowed";
}
else
{
  $v_name = true;
}
if(!filter_var($user_email, FILTER_VALIDATE_EMAIL) || empty($user_email))
{
  $email_error = "Enter valid Email";
}
else
{
  $v_email = true;
}
if(!preg_match('/^[0-9]{10}+$/', $user_mob) || empty($user_mob))
{
  $mob_error = "Enter correct Mobile Number";
}
else
{
  $v_mob = true;
}





if($v_name && $v_email && $v_mob )
{



          $sql = "UPDATE `registration` SET `userName`='$user_name',`userEmail`='$user_email',`userDOB`='$user_date_of_birth',`userGender`='$user_gender',`userMob`='$user_mob',`userAdd`='$user_add' WHERE userEmail ='$getid'";
          $result = mysqli_query($conn, $sql);
          if($result)
          {
            header("location:show_remove_user.php");
          }
          else
          {
            echo "Error";
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


  <title>Register</title>

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

  <div class="addtrain_center" style="text-align: center; margin-top: 2%;" >
    <a  href="show_remove_user.php"><button style="  outline: none; border: none; height: 36px; width: 200px; background-color: #07689f; color: #fafafa; border-radius: 4px; font-weight: bold; margin-top: 1%;" type="button" name="button">Back</button></a>
  </div>

  <section class="login_section">
    <div class="container login_container">
      <div class="row login_row">
        <div class="col-lg-5 login_div">
          <img class="train1_image img-fluid login_img" src="images/train1.jpg" alt="train">

        </div>
        <div class="col-lg-7 admin_login_box">
          <form action="updateuser.php?id=<?php echo $getid ?>" method="post">
            <h1>Railway Reservation System</h1>
            <h4>Register to RRS</h4>
            <div class="row">
              <div class="col-lg-4">
                <input class="register_input" type="text" name="user_name" class="form-control" placeholder="Full Name" value="<?php echo $getdata['userName'] ?>" required>


              </div>
              <div class="col-lg-4">
                <div class="input-group ">
                  <label class="input-group-text" for="user_gender">Gender</label>
                  <select class="form-select" name="user_gender" id="user_gender" required>
                    <option selected ><?php echo $getdata['userGender'] ?></option>
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
                <input class="register_input" type="text" name="user_date_of_birth" class="form-control" placeholder="Date of Birth" value="<?php echo $getdata['userDOB'] ?>" onfocus="(this.type='date')" required>


              </div>
              <div class="col-lg-4">
                <input class="register_input" type="email" name="user_email" class="form-control" placeholder="Email" value="<?php echo $getdata['userEmail'] ?>" required>


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
                <input class="register_input" type="text" name="user_add" class="form-control" placeholder="Address" value="<?php echo $getdata['userAdd'] ?>" required>


              </div>
              <div class="col-lg-4">
                <input class="register_input" type="text" name="user_mob" class="form-control" placeholder="Mobile No." value="<?php echo $getdata['userMob'] ?>" required>


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
              <div class="col-lg-4">
                <button class="register_btn"4 type="reset" name="button">Reset</button>

              </div>
              <div class="col-lg-4">
                <button class="register_btn" type="submit" name="button">Update</button>


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
