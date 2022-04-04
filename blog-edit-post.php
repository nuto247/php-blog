<?php


include 'checkAuthenticated.php';
include 'dbcon.php';
include 'function.php';




$post_id = $_GET['id'] ?? '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $title = $_POST['title'];
    $updated_at = date('Y-m-d H:m:s');
    $content = $_POST['content'];
    $status = isset($_POST['status']) && $_POST['status'] == 1 ? 'active' : 'inactive';

    //print_r('get status : ' . $_POST['status']);


    $sql = "UPDATE post 

            SET title = '$title', 
                updated_at = '$updated_at', 
                content  = '$content', 
                status  = '$status'

            WHERE id = $post_id";


    if (mysqli_query($con, $sql)) {

      //header('location: blog-manage-posts.php');

    print_r(mysqli_affected_rows($con));

    } else {

      echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }


}

$query = "SELECT * FROM post WHERE id = $post_id";

if ($results = mysqli_query($con, $query)) {

    if (mysqli_num_rows($results) > 0) {

        $post = mysqli_fetch_assoc($results);
    }
} else {

    echo "Error: " . $query . "<br>" . mysqli_error($con);
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
                                <input type="text" value="<?php echo $post['title']; ?>" name="title" class="form-control" id="exampleInputEmail1" placeholder="">
                            </div>


                            <div class="form-group">

                                <label for="exampleInputEmail1"></label>

                                <textarea name="content" id="content-editor" class="form-control" id="exampleInputEmail1" placeholder=""><?php echo $post['content']; ?></textarea>


                            </div>

                            

                            <div class="form-group">
                                <span class="error-message"> </span>
                                <div class="custom-control custom-switch">
                                    <input type="radio" value="1" <?php echo $post['status'] == 'active' ? 'checked' : ''; ?> name="status" class="custom-control-input" id="customSwitch1">
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