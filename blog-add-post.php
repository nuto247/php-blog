<?php

include 'checkAuthenticated.php';
include 'dbcon.php';
include 'function.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $title = $_POST['title'];
    $userid = $_SESSION['user_id'];
    $created_at = date('Y-m-d H:m:s');
    $updated_at = date('Y-m-d H:m:s');
    $content = $_POST['content'];
    $status = isset($_POST['status']) && $_POST['status'] == 1 ? 'active' : 'inactive';


    $sql = "INSERT INTO post (title, user_id, created_at, updated_at, content, status) 
                  VALUES ('$title', $userid, '$created_at', '$updated_at', '$content', '$status')";


    if (mysqli_query($con, $sql)) {

        //pre(mysqli_insert_id($con));

      header('location: blog-manage-posts.php');

    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
}

include 'header.php';

?>



<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Blog</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Blog</li>
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
                    <form action="" method="post">
                        <div class="card-body">

                            <div class="form-group">
                                <label>BLOG TITLE</label>
                                <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="">
                            </div>


                            <div class="form-group">

                                <label for="exampleInputEmail1"></label>

                                <textarea name="content" id="content-editor" 
                                    class="form-control" 
                                    id="exampleInputEmail1" placeholder=""></textarea>


                            </div>


        
                            <div class="form-group">
                                <span class="error-message"> </span>
                                <div class="custom-control custom-switch">
                                    <input type="radio" value="1" name="status" class="custom-control-input" id="customSwitch1">
                                    <label class="custom-control-label" for="customSwitch1">Publish</label>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>


        </div>


    </div>



    <!-- /.card-body -->

    </div>

</section>



<?php include 'footer.php' ?>

