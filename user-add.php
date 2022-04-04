<?php

include 'checkAuthenticated.php';
include 'dbcon.php';
include 'function.php';



$e_firstname = '';
$e_lastname = '';
$e_email = '';
$e_password = '';
$e_phone = '';
$e_select = '';
$e_avatar = '';

$address = '';
$gender = '';
$country = '';
$day = '';
$month = '';
$year = '';
$phone2 = '';
$bio = '';


$save_avatar = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $phone = $_POST['phone1'];
  $address = $_POST['address'];
  $gender = $_POST['gender'] ?? '';
  $country = $_POST['country'];
  $day = $_POST['day'];
  $month = $_POST['month'];
  $y = $_POST['year'];
  $phone2 = $_POST['phone2'];
  $bio = $_POST['bio'];


  $select = $_POST['check'] ?? '';



  $file_name = $_FILES["avatar"]["name"];

  if (!empty($file_name)) {

    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], 'uploads/' . $file_name)) {

      $save_avatar = "avatar = '$file_name',";

      echo "The file " . $file_name . " has been uploaded.";
    } else {

      echo "Sorry, there was an error uploading your file.";
    }
  }

 



  if (empty($firstname)) {
    $e_firstname = '* This field is required';
  }


  if (empty($lastname)) {
    $e_lastname = '* This field is required';
  }

  if (empty($email)) {
    $e_email = '* Email is necessary';
  }

  if (empty($password)) {

    $e_password = '* Password required';
  }
  if (empty($phone)) {

    $e_phone = '* Please input your phone number';
  }
  if (empty($select)) {

    $e_select = '* you must agree to the terms and conditions';
  }

  $query = "SELECT email FROM users WHERE email = '$email'";

  if ($results = mysqli_query($con, $query)) {

    if (mysqli_num_rows($results) > 0) {

      $e_email = '* your email has already been used';
    }
  } else {
    echo "Error: " . $query . "<br>" . mysqli_error($con);
  }


  if (empty($e_firstname) && empty($e_lastname) && empty($e_email) && empty($e_password)) {


    $sql = "INSERT INTO users (firstname, lastname, email, password, user_type) 
                  VALUES ('$firstname', '$lastname', '$email', '$password', 2)";

    if (mysqli_query($con, $sql)) {

      header('location: manage-user.php');

      //print_r(mysqli_affected_rows($con));

    } else {

      echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
  }
}



$user_year = $db[0] ?? '';
$user_month = $db[1] ?? '';
$user_day = $db[2] ?? '';

include 'header.php';
?>



<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">settings</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">settings</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">

      <div class="col-md-6">

        <div class="card card-primary">

          <!-- form start -->
          <form action="" method="post" enctype="multipart/form-data">
            <div class="card-body">

              <div class="row">

                <div class="col">
                  <div class="form-group">
                    <label for="exampleInputEmail1">first name</label><br>
                    <span class="error-message"> <?php echo  $e_firstname ?></span>
                    <input type="text" name="firstname" class="form-control" id="exampleInputEmail1" placeholder="Enter first name">
                  </div>
                </div>

                <div class="col">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Last name</label><br>
                    <span class="error-message"> <?php echo  $e_lastname ?></span>
                    <input type="text" name="lastname" class="form-control" id="exampleInputEmail1" placeholder="Enter last name">

                  </div>

                </div>

              </div>


              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label><br>
                <span class="error-message"> <?php echo  $e_email ?></span>

                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label><br>
                <span class="error-message"> <?php echo  $e_password ?></span>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>


              <div class="form-group">

                <label>Gender: </label>

                <div class="row">
                  <div class="col-md-2">
                    <input type="radio" name="gender" value="male"> <label>male</label>
                  </div>

                  <div class="col-md-2">
                    <input type="radio" name="gender" value="female"> <label>Female</label>

                  </div>
                </div>
              </div>



              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Country</label>
                    <select name="country" class="form-control">
                      <option value=""> Select your country</option>
                      <option>NIGERIA</option>
                      <option>USA </option>
                      <option>GHANA</option>
                      <option>GERMANY</option>
                      <option>NETHERLANDS</option>
                    </select>
                  </div>

                </div>

              </div>


              <div class="form-group">
                <label>Date Of Birth:</label>

                <div class="row">
                  <div class="col-md-2" style="margin-right: 10px;">
                    <label>Day</label>
                    <select name="day" class="form-control" style="width: 100px;">
                      <?php foreach (range(1, 31) as $d) : ?>

                        <option <?php echo $user_day == $d ? 'selected="selected"' : ''; ?> value="<?php echo $d; ?>"><?php echo $d; ?>
                        </option>

                      <?php endforeach ?>

                    </select>
                  </div>
                  <div class="col-md-2" style="margin-right: 10px;">
                    <label>Month</label>
                    <select name="month" class="form-control" style="width: 100px;">
                      <?php foreach (range(1, 12) as $m) : ?>

                        <option <?php echo $user_month == $m ? 'selected="selected"' : ''; ?> value="<?php echo $m; ?>"><?php echo $m; ?></option>

                      <?php endforeach ?>

                    </select>
                  </div>
                  <div class="col-md-2" style="margin-right: 10px;">
                    <label>Year</label>

                    <select name="year" class="form-control" style="width: 100px;">

                      <?php foreach (range(1990, 2021) as $year) : ?>

                        <option <?php echo $user_year == $year ? 'selected="selected"' : ''; ?> value="<?php echo $year; ?>"><?php echo $year; ?></option>

                      <?php endforeach ?>


                    </select>

                  </div>
                </div>


                <div class="form-group">
                  <label>Phone 1:</label><br>
                  <span class="error-message"></span>
                  <div class="input-group">

                    <div class="input-group-prepend">
                      <span class="input-group-text"></span>
                    </div>

                    <input type="text" name="phone1" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- phone mask -->
                <div class="form-group">
                  <label>Phone 2</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" name="phone2" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- IP mask -->
                <div class="form-group">
                  <label>IP address:</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                    </div>
                    <input type="text" name="address" class="form-control" data-inputmask="'alias': 'ip'" data-mask>
                  </div>
                  <!-- /.input group -->
                </div>

                <div class="form-group">
                  <label>Select Three(3)hobbies</label>
                  <div class="custom-control custom-checkbox">
                    <input name="hobby[]" class="custom-control-input" type="checkbox" id="customCheckbox1" value="soccer">
                    <label for="customCheckbox1" class="custom-control-label">soccer</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input name="hobby[]" class="custom-control-input" type="checkbox" id="customCheckbox2" value="Tennis">
                    <label for="customCheckbox2" class="custom-control-label">Tennis</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input name="hobby[]" class="custom-control-input" type="checkbox" id="customCheckbox3" value="Playing">
                    <label for="customCheckbox3" class="custom-control-label">playing</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input name="hobby[]" class="custom-control-input" type="checkbox" id="customCheckbox4" value="Rugby">
                    <label for="customCheckbox4" class="custom-control-label">Rugby</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input name="hobby[]" class="custom-control-input" type="checkbox" id="customCheckbox5" value="Singing">
                    <label for="customCheckbox5" class="custom-control-label">singing</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input name="hobby[]" class="custom-control-input" type="checkbox" id="customCheckbox6" value="Dancing">
                    <label for="customCheckbox6" class="custom-control-label">dancing</label>
                  </div>
                </div>




                <div class="row">
                  <div class="col-md-10">
                    <!-- textarea -->
                    <div class="form-group">
                      <label>Bio</label>
                      <textarea name="bio" class="form-control" rows="3" placeholder="Enter bio..."></textarea>
                    </div>
                  </div>
                </div>
                <div class="form-group" style="width: 400px;">
                  <label for="exampleInputFile">Avatar</label>
                  <div class="input-group">
                    <div class="custom-file">

                      <input name="avatar" type="file" class="custom-file-input" id="exampleInputFile">

                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>

                  </div>
                </div>

                <!-- /.form group -->
                <div class="form-group">
                  <span class="error-message"> <?php echo  $e_select ?></span>
                  <div class="custom-control custom-switch">
                    <input type="checkbox" name="check" class="custom-control-input" id="customSwitch1">
                    <label class="custom-control-label" for="customSwitch1">I Agree to the Terms and Conditions</label>
                  </div>
                </div>
              </div>
              <!-- /.input group -->
            </div>
            <!-- /.form group -->


            <!-- phone mask -->
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>

    </div>

    <!-- /.card-body -->

  </div>

</section>



<?php include 'footer.php' ?>