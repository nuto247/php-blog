<?php

session_start();

include 'dbcon.php';

$e_email = '';
$e_password = '';

$email = '';

$login_error = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $email = $_POST['email'];
  $password = $_POST['password'];


  if (empty($email)) {
    $e_email = '* This field is required';
  }

  if (empty($password)) {

    $e_password = '* Password required';

  } elseif ( strlen($_POST['password']) < 8 )  {

    $e_password = '* your password must be atleast 8 characters';

  }


  if (empty($e_email) && empty($e_password)) {


    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password' ";

    if($results = mysqli_query($con, $query)) {

      if(mysqli_num_rows($results) > 0){

       $data = mysqli_fetch_assoc($results);

       print_r('your email is :: ' . $data['email']);
       print_r('your password is :: ' .  $data['password']);

        $_SESSION['user_id'] = $data['id'];

        header('location: index.php');

      } else {

        $login_error = 'Your email or password is not correct';

      }

     // $row = mysqli_fetch_row($result);

    } else {

      echo "Error: " . $query . "<br>" . mysqli_error($con);

    }



   // $_SESSION['user_id'] = 5;

   // header('location: index.php');

  }


}




?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in (v2)</title>

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

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="" method="post">

        <span class="error-message"> <?php echo  $login_error; ?></span>

          <span class="error-message"> <?php echo  $e_email ?></span>
          <div class="input-group mb-3">


            <input type="email" name="email" value="<?php echo  $email ?>" class="form-control" placeholder="Email">
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
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>



        <p class="mb-1">
          <a href="forgot-password.php">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="register.php" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>