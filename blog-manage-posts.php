<?php



include 'checkAuthenticated.php';
include 'dbcon.php';
include 'function.php';



$query = "SELECT * FROM post";


if ($results = mysqli_query($con, $query)) {

    if (mysqli_num_rows($results) > 0) {
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

            <div class="col-md-10">

                <div class="card card-primary">


                    <form action="" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Responsive Hover Table</h3>
                                    </div>

                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover text-nowrap">

                                            <tr>
                                                <th>id</th>
                                                <th>title</th>
                                                <th>user_id</th>
                                                <th>Content</th>
                                                <th>created_at</th>
                                                <th>updated_at</th>
                                                <th>status</th>
                                                <th>Action</th>
                                            </tr>

                                            <?php while ($row = mysqli_fetch_assoc($results)) { ?>
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['title'] ?></td>
                                                    <td><?php echo $row['user_id'] ?></td>
                                                    <td><?php echo $row['created_at'] ?></td>
                                                    <td><?php echo $row['updated_at'] ?></td>
                                                    <td><?php echo $row['content'] ?></td>
                                                    <td><?php echo $row['status'] ?></td>
                                                    
                                                    <td>
                                                        <a href="" >View</a>
                                                        <a href="blog-edit-post.php?id=<?php echo $row['id'] ?>" >Edit</a>
                                                        <a href="blog-delete-post.php?id=<?php echo $row['id'] ?>" >Delete</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </form>
                </div>

            </div>



        </div>


    </div>

</section>



<?php include 'footer.php' ?>