<?php


session_start();

include 'dbcon.php';


$e_fname = '';
$e_lname = '';
$e_email = '';
$e_password = '';
$e_CHECKpassword = '';

$fname = '';
$lname = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $firstname = $_POST['firstname'] ?? '';
  $lastname = $_POST['lastname'] ?? '';
  $email = $_POST['email'];
  $password = $_POST['password'];
  $check_password = $_POST['check_password'];



  if (empty($firstname)) {
    $e_name = '* First name required';
  }

 if (empty($lastname)) {
    $e_name = '* First name required';
  }


  if (empty($email)) {

    $e_email = '* This field is required';

  } else{

    if (empty($password)) {

    $e_password = '* Password required';
  } elseif (strlen($_POST['password']) < 8) {

    $e_password = '* Your password must be atleast 8 characters';
  }



  if ($password == $check_password) {
  } else {

    $e_CHECKpassword = '* Your password does not match';
  }

  if (empty($e_name) && empty($e_email) && empty($e_password) && empty($e_CHECKpassword)) {


    $sql = "INSERT INTO users (firstname, lastname, email, password, user_type) 
                  VALUES ('$firstname', '$lastname', '$email', '$password', 2)";


    if (mysqli_query($con, $sql)) {

      header('location: login.php');

    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);

  }

    $query = "SELECT email FROM users WHERE email = '$email'";

    if($results = mysqli_query($con, $query)) {

      if(mysqli_num_rows($results) > 0){

        $e_email = '* your email has already been used';

      } 

     // $row = mysqli_fetch_row($result);

    } else {

      echo "Error: " . $query . "<br>" . mysqli_error($con);

    }


  }

  
}



?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="dist/css/custom.css">
</head>

<body class="hold-transition register-page">
  <div class="register-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Register a new membership</p>

        <form action="" method="post">
          <span class="error-message"> <?php echo  $e_fname ?></span>

          <div class="input-group mb-3">
            <input type="text" name="firstname" value="<?php echo  $fname; ?>" class="form-control" placeholder="Full name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <span class="error-message"> <?php echo  $e_lname ?></span>
          <div class="input-group mb-3">
            <input type="text" name="lastname" value="<?php echo  $lname; ?>" class="form-control" placeholder="Full name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <span class="error-message"> <?php echo  $e_email ?></span>
          <div class="input-group mb-3">
            <input type="email" name="email" value="<?php echo  $email; ?>" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <span class="error-message"><?php echo  $e_password ?></span>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <span class="error-message"><?php echo  $e_CHECKpassword ?></span>
          <div class="input-group mb-3">
            <input type="password" name="check_password" class="form-control" placeholder="Retype password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                <label for="agreeTerms">
                  I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center">
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i>
            Sign up using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i>
            Sign up using Google+
          </a>
        </div>

        <a href="login.php" class="text-center">I already have a membership</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>